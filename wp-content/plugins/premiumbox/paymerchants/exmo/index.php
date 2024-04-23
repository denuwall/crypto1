<?php 
/*
title: [en_US:]ExMo[:en_US][ru_RU:]ExMo[:ru_RU]
description: [en_US:]ExMo automatic payouts[:en_US][ru_RU:]авто выплаты ExMo[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_exmo')){
	class paymerchant_exmo extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'KEY', 'SECRET', 
			);
			parent::__construct($file, $map, $title, 'BUTTON');
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('list_user_notify',array($this,'user_mailtemp')); 
			add_filter('list_notify_tags_exmo_paycoupon',array($this,'mailtemp_tags_paycoupon'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}
		
		function security_list(){
			return array('show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['note'])){
				unset($options['note']);
			}		
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}			
			
			return $options;
		}		
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'KEY') 
				and is_deffin($this->m_data,'SECRET')  
			){
				$text = '';
			}
			
			return $text;
		}
		
		function user_mailtemp($places_admin){
			
			$places_admin['exmo_paycoupon'] = sprintf(__('%s automatic payout','pn'), 'ExMo');
			
			return $places_admin;
		}

		function mailtemp_tags_paycoupon($tags){
			
			$tags['id'] = __('Coupon code','pn');
			$tags['bid_id'] = __('Order ID','pn');
			
			return $tags;
		}		

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => 'USD',
				$this->name.'_2' => 'EUR',
				$this->name.'_3' => 'RUB',
				$this->name.'_4' => 'BTC',
				$this->name.'_5' => 'DOGE',
				$this->name.'_6' => 'DASH',
				$this->name.'_7' => 'ETH',				
				$this->name.'_8' => 'LTC',
				$this->name.'_9' => 'UAH',
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$list[$k] = 'ExMo '. $v.' ['. $this->name .']';
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
							$oClass = new AP_ExmoApi(is_deffin($this->m_data,'KEY'),is_deffin($this->m_data,'SECRET'));
							$res = $oClass->get_balans();
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
			if(!$ind){
				if($this->check_reserv_list($key)){
					$purses = $this->get_reserve_lists();
					$purse = trim(is_isset($purses, $key));
					if($purse){						
						try{	
							$oClass = new AP_ExmoApi(is_deffin($this->m_data,'KEY'),is_deffin($this->m_data,'SECRET'));
							$res = $oClass->get_balans();
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
			$trans_id = 0;			
			$coupon = '';			

			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace('RUR','RUB',$vtype);
					
			$enable = array('USD','EUR','RUB','BTC','DOGE','DASH','ETH','LTC','UAH');		
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
			if (!is_email($account)) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}				
					
			$sum = is_paymerch_sum($this->name, $item, $paymerch_data);
					
			$two = array('USD','EUR','RUR','UAH');
			if(in_array($vtype, $two)){
				$sum = is_sum($sum, 8);
			} else {
				$sum = is_sum($sum);
			}
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);				
				if($result){				
					
					try{
						$res = new AP_ExmoApi(is_deffin($this->m_data,'KEY'),is_deffin($this->m_data,'SECRET'));
						$res = $res->make_voucher($sum, $vtype);
						if($res['error'] == 1){
							$error[] = __('Payout error','pn');
							$pay_error = 1;
						} else {
							$coupon = $res['coupon'];
							$trans_id = $res['trans_id'];
						}								 	
					}
					catch (Exception $e)
					{
						$error[] = $e->getMessage();
						$pay_error = 1;
					}

				} else {
					$error[] = 'Database error';
				}						
									
			}
					
			if(count($error) > 0){
						
				$this->reset_ap_status($error, $pay_error, $item, $place);
						
			} else {
						
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[id]'] = $coupon;
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags = apply_filters('notify_tags_exmo_paycoupon', $notify_tags);		

					$user_send_data = array(
						'user_email' => $account,
						'user_phone' => '',
					);
					$result_mail = apply_filters('premium_send_message', 0, 'exmo_paycoupon', $notify_tags, $user_send_data, $item->bid_locale);									
						
				$coupon_data = array(
					'coupon' => $coupon,
				);
				do_action('merchant_create_coupon', $coupon_data, $item, 'exmo', $place);
						
				$params = array(
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

new paymerchant_exmo(__FILE__, 'ExMo');