<?php
/*
title: [en_US:]Privat24[:en_US][ru_RU:]Privat24[:ru_RU]
description: [en_US:]Privat24 automatic payouts[:en_US][ru_RU:]авто выплаты Privat24[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_privatbank')){
	class paymerchant_privatbank extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'AP_PRIVAT24_BUTTON', 'AP_PRIVAT24_MERCHANT_ID_UAH', 'AP_PRIVAT24_MERCHANT_KEY_UAH', 
				'AP_PRIVAT24_MERCHANT_CARD_UAH', 'AP_PRIVAT24_MERCHANT_ID_USD', 'AP_PRIVAT24_MERCHANT_KEY_USD',
				'AP_PRIVAT24_MERCHANT_CARD_USD', 'AP_PRIVAT24_MERCHANT_ID_EUR', 'AP_PRIVAT24_MERCHANT_KEY_EUR',
				'AP_PRIVAT24_MERCHANT_CARD_EUR', 
			);
			parent::__construct($file, $map, $title, 'AP_PRIVAT24_BUTTON');
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
			add_action('myaction_merchant_ap_'.$this->name.'_cron' . get_hash_result_url($this->name, 'ap'), array($this,'myaction_merchant_cron'));
		}

		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}			

			$opt = array(
				'0' => __('Privat24','pn'),
				'1' => __('Privat24 Visa','pn'),
			);
			$options['variant'] = array(
				'view' => 'select',
				'title' => __('Transaction type','pn'),
				'options' => $opt,
				'default' => intval(is_isset($data, 'variant')),
				'name' => 'variant',
				'work' => 'int',
			);			
			
			$statused = apply_filters('bid_status_list',array());
			if(!is_array($statused)){ $statused = array(); }

			$error_status = trim(is_isset($data, 'error_status'));
			if(!$error_status){ $error_status = 'realpay'; }
			$options[] = array(
				'view' => 'select',
				'title' => __('API status error','pn'),
				'options' => $statused,
				'default' => $error_status,
				'name' => 'error_status',
				'work' => 'input',
			);				
			
			$text = '
			<strong>CRON:</strong> <a href="'. get_merchant_link('ap_'. $this->name .'_cron' . get_hash_result_url($this->name, 'ap')) .'" target="_blank">'. get_merchant_link('ap_'. $this->name .'_cron' . get_hash_result_url($this->name, 'ap')) .'</a>
			';
			$options[] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);			
			
			return $options;
		}		
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_UAH') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_UAH') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_UAH')
				or is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_USD') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_USD') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_USD')
				or is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_EUR') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_EUR') and is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_EUR')
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_UAH'),
				$this->name.'_2' => is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_USD'),
				$this->name.'_3' => is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_EUR'),
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$v = trim($v);
				if($v){
					$list[$k] = 'PrivatBank '. $v.' ['. $this->name .']';
				}
			}
			
			return $list;						
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					if($key == $this->name.'_1'){
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_UAH');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_UAH');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_UAH');
					} elseif($key == $this->name.'_2'){
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_USD');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_USD');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_USD');				
					} elseif($key == $this->name.'_3'){	
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_EUR');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_EUR');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_EUR');				
					}

					if($merchant_id and $merchant_pass and $card){
						
						try{
					
							$oClass = new AP_PrivatBank($merchant_id,$merchant_pass);
							$res = $oClass->get_balans($card);
							if(is_array($res)){
								
								$rezerv = '-1';
								
								foreach($res as $pursename => $amount){
									if( $pursename == $card ){
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
				
					if($key == $this->name.'_1'){
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_UAH');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_UAH');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_UAH');
					} elseif($key == $this->name.'_2'){
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_USD');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_USD');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_USD');				
					} elseif($key == $this->name.'_3'){	
						$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_EUR');
						$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_EUR');
						$card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_EUR');				
					}

					if($merchant_id and $merchant_pass and $card){
						
						try{
					
							$oClass = new AP_PrivatBank($merchant_id,$merchant_pass);
							$res = $oClass->get_balans($card);
							if(is_array($res)){
								
								$rezerv = '-1';
								
								foreach($res as $pursename => $amount){
									if( $pursename == $card ){
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
				
			$vtype = mb_strtoupper($item->currency_code_get);

			$enable = array('UAH','USD','EUR');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}		
					
			$account = $item->account_get;
			$account = mb_strtoupper($account);
			if (!preg_match("/^[0-9]{7,25}$/", $account, $matches )) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}		
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);			
					
			$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_'.$vtype);
			$merchant_pass = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_'.$vtype);
			$merchant_card = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_CARD_'.$vtype);
					
			if(!$merchant_id or !$merchant_pass){
				$error[] = 'Error interfaice';
			}
					
			$variant = intval(is_isset($paymerch_data, 'variant'));
			if($variant == 1){
				$fio = array($item->last_name, $item->first_name, $item->second_name);
				$fio = array_unique($fio);
				$fio_str = trim(join(' ',$fio));
				if(!$fio_str){
					$error[] = 'Error FIO';
				}						
			}
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);			
				if($result){				
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,150));
						
					try {
						
						$oClass = new AP_PrivatBank($merchant_id,$merchant_pass);
						if($variant == 0){
							$res = $oClass->make_order($item_id, $account, $sum, $vtype, $notice);
						} else {
							$res = $oClass->make_order_visa($item_id, $account, $sum, $vtype, $notice, $fio_str);
						}
						if($res['error'] == 1){
							$error[] = __('Payment error','pn');
							$pay_error = 1;
						} else {
							$trans_id = $res['id'];
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
						
				$params = array(
					'from_account' => $merchant_card,
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('coldsuccess', $item_id, $params, 1);	 					
						
				if($place == 'admin'){
					pn_display_mess(__('Payment is successfully created. Waiting for confirmation from Privat24.','pn'),__('Payment is successfully created. Waiting for confirmation from Privat24.','pn'),'true');
				} 
						
			}
		}

		function myaction_merchant_cron(){
		global $wpdb;
			
			$m_out = $this->name;
			
			$data = get_paymerch_data($this->name);
			$error_status = is_status_name(is_isset($data, 'error_status'));
			if(!$error_status){ $error_status = 'realpay'; }
			
			$en_currency = array('USD', 'EUR', 'UAH');
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'coldsuccess' AND m_out='$m_out'");
			foreach($items as $item){
				
				$currency = mb_strtoupper($item->currency_code_get);
				if(in_array($currency, $en_currency)){
				
					$merchant_id = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_ID_'.$currency);
					$merchant_key = is_deffin($this->m_data,'AP_PRIVAT24_MERCHANT_KEY_'.$currency);
				
					if($merchant_id and $merchant_key){
				
						try {
						
							$oClass = new AP_PrivatBank($merchant_id,$merchant_key);
							$res = $oClass->check_order($item->id);
							if(isset($res['status'])){
								if($res['status'] == 'ok'){
									$params = array(
										'system' => 'system',
										'ap_place' => 'site',
										'm_place' => 'cron ' .$this->name,
									);
									the_merchant_bid_status('success', $item->id, $params, 1);														
								} elseif($res['status'] != 'snd') {
									send_paymerchant_error($item->id, __('Your payment is declined','pn'));
									update_bids_meta($item->id, 'ap_status', 0);
									update_bids_meta($item->id, 'ap_status_date', current_time('timestamp'));
									$arr = array(
										'status'=> $error_status,
										'edit_date'=> current_time('mysql'),
									);									
									$wpdb->update($wpdb->prefix.'exchange_bids', $arr, array('id'=>$item->id));
								}
							}
						
						}
						catch( Exception $e ) {
									
						}
					
					}
				
				}
				
			}
			_e('Done','pn');
		}		
		
	}
}

new paymerchant_privatbank(__FILE__, 'Privat24');