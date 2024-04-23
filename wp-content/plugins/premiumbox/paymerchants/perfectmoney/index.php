<?php
/*
title: [en_US:]PerfectMoney[:en_US][ru_RU:]PerfectMoney[:ru_RU]
description: [en_US:]PerfectMoney automatic payouts[:en_US][ru_RU:]авто выплаты PerfectMoney[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_perfectmoney')){
	class paymerchant_perfectmoney extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'ACCOUNT_ID', 'PHRASE', 
				'U_ACCOUNT', 'E_ACCOUNT', 'G_ACCOUNT', 'B_ACCOUNT',
			);
			parent::__construct($file, $map, $title, 'BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('list_user_notify',array($this,'user_mailtemp')); 
			add_filter('list_notify_tags_perfectmoney_paycoupon',array($this,'mailtemp_tags_paycoupon'));			
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}

		function security_list(){
			return array('show_error','checkpay');
		}		
		
		function user_mailtemp($places_admin){
			
			$places_admin['perfectmoney_paycoupon'] = sprintf(__('%s automatic payout','pn'), 'Perfectmoney E-Vouchers');
			
			return $places_admin;
		}

		function mailtemp_tags_paycoupon($tags){
			
			$tags['id'] = __('Coupon code','pn');
			$tags['num'] = __('Activation code','pn');
			$tags['bid_id'] = __('Order ID','pn');
			
			return $tags;
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}			
			$noptions = array();
			foreach($options as $key => $val){
				$noptions[$key] = $val;
				if($key == 'note'){
					$noptions['warning'] = array(
						'view' => 'warning',
						'default' => sprintf(__('Use only latin symbols in payment notes. Maximum: %s characters.','pn'), 100),
					);						
				}
			}
						
			$opt = array(
				'0' => __('Account','pn'),
				'1' => __('E-Vouchers','pn'),
			);
			$noptions['variant'] = array(
				'view' => 'select',
				'title' => __('Transaction type','pn'),
				'options' => $opt,
				'default' => intval(is_isset($data, 'variant')),
				'name' => 'variant',
				'work' => 'int',
			);					
			
			return $noptions;
		}			
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'ACCOUNT_ID') 
				and is_deffin($this->m_data,'PHRASE')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => is_deffin($this->m_data,'U_ACCOUNT'),
				$this->name.'_2' => is_deffin($this->m_data,'E_ACCOUNT'),
				$this->name.'_3' => is_deffin($this->m_data,'G_ACCOUNT'),
				$this->name.'_4' => is_deffin($this->m_data,'B_ACCOUNT'),
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$v = trim($v);
				if($v){
					$list[$k] = 'PerfectMoney '. $v.' ['. $this->name .']';
				}
			}
			
			return $list;
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					$purses = $this->get_reserve_lists();
					
					$purse = trim(is_isset($purses, $key));
					if($purse){
						
						try{
					
							$oClass = new AP_PerfectMoney( is_deffin($this->m_data,'ACCOUNT_ID'), is_deffin($this->m_data,'PHRASE') );
							$res = $oClass->getBalans();
							if(is_array($res)){
								
								$rezerv = '-1';
								
								foreach($res as $pursename => $amount){
									if( $pursename == $purse ){
										$rezerv = trim((string)$amount);
										break;
									}
								}
								
								if($rezerv != '-1'){
									pm_update_vr($currency_id, $rezerv);
								}						
								
							} 
						
						}
						catch (Exception $e)
						{
							
						} 				
						
						return 1;
					}
				
				}
			}
			
			return $ind;
		}

		function update_direction_reserv($ind, $key, $direction_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					$purses = $this->get_reserve_lists();
					
					$purse = trim(is_isset($purses, $key));
					if($purse){
						
						try{
					
							$oClass = new AP_PerfectMoney( is_deffin($this->m_data,'ACCOUNT_ID'), is_deffin($this->m_data,'PHRASE') );
							$res = $oClass->getBalans();
							if(is_array($res)){
								
								$rezerv = '-1';
								
								foreach($res as $pursename => $amount){
									if( $pursename == $purse ){
										$rezerv = trim((string)$amount);
										break;
									}
								}
								
								if($rezerv != '-1'){
									pm_update_nr($direction_id, $rezerv);
								}						
								
							} 
						
						}
						catch (Exception $e)
						{
							
						} 				
						
						return 1;
					}
				
				}
			}
			
			return $ind;
		}		

		function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
			
			$item_id = $item->id;			
			$coupon = '';
			$coupon_num = '';
			$trans_id = 0;				
			
			$variant = intval(is_isset($paymerch_data,'variant'));
			
			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace(array('GLD','OAU'),'G',$vtype);
			$vtype = str_replace(array('USD'),'U',$vtype);
			$vtype = str_replace(array('EUR'),'E',$vtype);
			$vtype = str_replace(array('BTC'),'B',$vtype);
					
			$enable = array('G','U','E','B');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
					
			if($variant == 0){
				$account = mb_strtoupper($account);
				if (!preg_match("/^{$vtype}[0-9]{0,20}$/", $account, $matches )) {
					$error[] = __('Client wallet type does not match with currency code','pn');
				}
			} else {
				if (!is_email($account)) {
					$error[] = __('Client wallet type does not match with currency code','pn');
				}						
			}
					
			$site_purse = '';
			if($vtype == 'G'){
				$site_purse = is_deffin($this->m_data,'G_ACCOUNT');
			} elseif($vtype == 'U'){
				$site_purse = is_deffin($this->m_data,'U_ACCOUNT');
			} elseif($vtype == 'E'){
				$site_purse = is_deffin($this->m_data,'E_ACCOUNT');
			} elseif($vtype == 'B'){
				$site_purse = is_deffin($this->m_data,'B_ACCOUNT');						
			} 
					
			$site_purse = mb_strtoupper($site_purse);
			if (!preg_match("/^{$vtype}[0-9]{0,20}$/", $site_purse, $matches )) {
				$error[] = __('Your account set on website does not match with currency code','pn');
			}			

			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);
					
			$check_history = intval(is_isset($paymerch_data, 'checkpay'));
			if($check_history == 1){
					
				try {
					$class = new AP_PerfectMoney( is_deffin($this->m_data,'ACCOUNT_ID'), is_deffin($this->m_data,'PHRASE') );
					$hres = $class->getHistory( date( 'd.m.Y', strtotime( '-2 day' ) ), date( 'd.m.Y', strtotime( '+2 day' ) ), 'paymentid', 'rashod' );
					if($hres['error'] == 0){
						$histories = $hres['responce'];
						if(isset($histories[$item_id])){
							$error[] = sprintf(__('Payment ID %s has already been paid','pn'), $item_id);	
						} 
					} else {
						$error[] = __('Failed to retrieve payment history','pn');
					}							
				}
				catch( Exception $e ) {
					$error[] = $e->getMessage();
				}		
					
			}					
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('Order ID %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,100));
						
					try{
						
						$oClass = new AP_PerfectMoney( is_deffin($this->m_data,'ACCOUNT_ID'), is_deffin($this->m_data,'PHRASE') );
						if($variant == 0){
							$res = $oClass->SendMoney($site_purse, $account, $sum, $item_id, $notice);
						} else {
							$res = $oClass->CreateVaucher($site_purse, $sum);
						}
						if($res['error'] == 1){
							$error[] = __('Payout error','pn');
							$pay_error = 1;
						} else {
							$trans_id = $res['trans_id'];
							if($variant == 1){
								$coupon = $res['code'];
								$coupon_num = $res['num'];
							}
						}
						
					}
					catch (Exception $e)
					{
						$error[] = $e;
						$pay_error = 1;
					} 
							
				} else {
					$error[] = 'Database error';
				}
									
			}
					
			if(count($error) > 0){
				$this->reset_ap_status($error, $pay_error, $item, $place);
			} else {
						
				if($variant == 1){
						
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[id]'] = $coupon;
					$notify_tags['[num]'] = $coupon_num;
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags = apply_filters('notify_tags_perfectmoney_paycoupon', $notify_tags);		

					$user_send_data = array(
						'user_email' => $account,
						'user_phone' => '',
					);
					$result_mail = apply_filters('premium_send_message', 0, 'perfectmoney_paycoupon', $notify_tags, $user_send_data, $item->bid_locale);												
							
					$coupon_data = array(
						'coupon' => $coupon,
						'coupon_code' => $coupon_num,
					);							
					do_action('merchant_create_coupon', $coupon_data, $item, 'perfectmoney', $place);						
							
				}	
						
				$params = array(
					'from_account' => $site_purse,
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('success', $item_id, $params, 1); 						
						
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 
						
			}
		}				
		
	}
}

new paymerchant_perfectmoney(__FILE__, 'PerfectMoney');