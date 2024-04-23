<?php 
/*
title: [en_US:]LiveCoin[:en_US][ru_RU:]LiveCoin[:ru_RU]
description: [en_US:]LiveCoin automatic payouts[:en_US][ru_RU:]авто выплаты LiveCoin[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_livecoin')){
	class paymerchant_livecoin extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'AP_LIVECOIN_BUTTON', 'AP_LIVECOIN_KEY', 'AP_LIVECOIN_SECRET', 
			);
			parent::__construct($file, $map, $title, 'AP_LIVECOIN_BUTTON');
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('list_user_notify',array($this,'user_mailtemp')); 
			add_filter('list_notify_tags_livecoin_paycoupon',array($this,'mailtemp_tags_paycoupon'));
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}

		function security_list(){
			return array('show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}			
			
			$noptions = array();
			foreach($options as $key => $val){
				$noptions[$key] = $val;
				if($key == 'note'){
					$noptions[] = array(
						'view' => 'warning',
						'default' => sprintf(__('Use only latin symbols in payment notes. Maximum: %s characters.','pn'), 100),
					);						
				}
			}

			$opt = array(
				'0' => __('to Coupon','pn'),
				'1' => __('to Crypto currency','pn'),
				'2' => __('to Payeer','pn'),
				'3' => __('to Capitalist','pn'),
				'4' => __('to Bank card','pn'),
				//'5' => __('to Okpay','pn'),
				'6' => __('to Perfect Money','pn'),
			);
			$noptions[] = array(
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
				is_deffin($this->m_data,'AP_LIVECOIN_KEY') 
				and is_deffin($this->m_data,'AP_LIVECOIN_SECRET')  
			){
				$text = '';
			}
			
			return $text;
		}
		
		function user_mailtemp($places_admin){
			
			$places_admin['livecoin_paycoupon'] = sprintf(__('%s automatic payout','pn'), 'LiveCoin');
			
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
				$this->name.'_3' => 'RUR',
				$this->name.'_4' => 'BTC',
				$this->name.'_5' => 'LTC',
				$this->name.'_6' => 'EMC',
				$this->name.'_7' => 'DASH',
				$this->name.'_8' => 'DOGE',
				$this->name.'_9' => 'MONA',
				$this->name.'_10' => 'PPC',
				$this->name.'_11' => 'NMC',
				$this->name.'_12' => 'CURE',
				$this->name.'_13' => 'ETH',
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$list[$k] = 'LiveCoin '. $v.' ['. $this->name .']';
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
							$oClass = new AP_LiveCoin(is_deffin($this->m_data,'AP_LIVECOIN_KEY'),is_deffin($this->m_data,'AP_LIVECOIN_SECRET'));
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
							$oClass = new AP_LiveCoin(is_deffin($this->m_data,'AP_LIVECOIN_KEY'),is_deffin($this->m_data,'AP_LIVECOIN_SECRET'));
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

			$variant = intval(is_isset($paymerch_data, 'variant'));
				
			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace('RUB','RUR',$vtype);
					
			$enable = array('USD','EUR','RUR','BTC','LTC','EMC','DASH','DOGE','MONA','PPC','NMC','CURE','ETH');		
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}	
					
			$account = $item->account_get;
			if (!is_email($account) and $variant == 0) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}				
					
			$sum = is_paymerch_sum($this->name, $item, $paymerch_data);
					
			$two = array('USD','EUR','RUR');
			if(in_array($vtype, $two)){
				$sum = is_sum($sum, 2);
			} else {
				$sum = is_sum($sum);
			}
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);				
				if($result){				
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('Order ID %s','pn'), $item->id); }
					$notice = trim(substr($notice,0,100));
						
					try{
						
						$class = new AP_LiveCoin(is_deffin($this->m_data,'AP_LIVECOIN_KEY'),is_deffin($this->m_data,'AP_LIVECOIN_SECRET'));
						if($variant == 0){
							$coupon = $class->make_voucher($sum, $vtype, $notice);
							if(!$coupon){
								$error[] = __('Payout error','pn');
								$pay_error = 1;
							} 	
						} else {
							if($variant == 1){ // '1' => __('Crypto currency','pn'),
								$data_params = array(
									'wallet' => $account,
								);
								$method = 'coin';
							} elseif($variant == 2){ // '2' => __('Payeer','pn'),
								$data_params = array(
									'wallet' => $account,
								);			
								$method = 'payeer';
							} elseif($variant == 3){ // '3' => __('Capitalist','pn'),
								$data_params = array(
									'wallet' => $account,
								);		
								$method = 'capitalist';
							} elseif($variant == 4){ // '4' => __('Bank card','pn'),
								$data_params = array(
									'card_number' => is_isset($unmetas,'card_number'),
									'expiry_month' => is_isset($unmetas,'expiry_month'),
									'expiry_year' => is_isset($unmetas,'expiry_year'),
								);	
								$method = 'card';
							} elseif($variant == 5){ // '5' => __('Okpay','pn'),
								$data_params = array(
									'wallet' => $account,
								);	
								$method = 'okpay';
							} elseif($variant == 6){ // '6' => __('Perfectmoney','pn'),	
								$data_params = array(
									'wallet' => $account,
								);	
								$method = 'perfectmoney';
							}
									
							$res = $class->get_transfer($method, $sum, $vtype, $data_params);
							$trans_id = intval(is_isset($res,'id'));
							if(!$trans_id){
								$error[] = __('Payout error','pn');
								$pay_error = 1;
							} 									
									
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
						
				if($variant == 0){
					
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[id]'] = $coupon;
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags = apply_filters('notify_tags_livecoin_paycoupon', $notify_tags);		

					$user_send_data = array(
						'user_email' => $account,
						'user_phone' => '',
					);
					$result_mail = apply_filters('premium_send_message', 0, 'livecoin_paycoupon', $notify_tags, $user_send_data, $item->bid_locale);

					$coupon_data = array(
						'coupon' => $coupon,
					);							
					do_action('merchant_create_coupon', $coupon_data, $item, 'livecoin', $place);
				}						
						
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

new paymerchant_livecoin(__FILE__, 'LiveCoin');