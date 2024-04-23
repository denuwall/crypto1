<?php
/*
title: [en_US:]Coinpayments[:en_US][ru_RU:]Coinpayments[:ru_RU]
description: [en_US:]Coinpayments automatic payouts[:en_US][ru_RU:]авто выплаты Coinpayments[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_coinpayments')){
	class paymerchant_coinpayments extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'PUBLIC_KEY', 'PRIVAT_KEY',
				'BTC','LTC','XRP','DASH','DOGE','ETC','ETH','NMC','PPC','USDT','WAVES','XMR','ZEC','USDT','BCH','NEO','QTUM','BCC',
			);
			parent::__construct($file, $map, $title, 'BUTTON');
			
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
						
			if(isset($options['note'])){
				unset($options['note']);
			}			
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}
			
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
			
			$options['addtxfee'] = array(
				'view' => 'select',
				'title' => __('Exchanger pays transaction fee','pn'),
				'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
				'default' => is_isset($data, 'addtxfee'),
				'name' => 'addtxfee',
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
				is_deffin($this->m_data,'PUBLIC_KEY') and is_deffin($this->m_data,'PRIVAT_KEY')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$keys = array('BTC','LTC','XRP','DASH','DOGE','ETC','ETH','NMC','PPC','USDT','WAVES','XMR','ZEC','USDT','BCH','NEO','QTUM','BCC');
			$purses = array();
			$r = 0;
			foreach($keys as $key){ $r++;
				$key = trim($key);
				if($key){
					$purses[$this->name.'_'.$r] = $key;
				}	
			}
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){ 
				$list[$k] = 'Coinpayments '. $v .':'. is_deffin($this->m_data, $v).' ['. $this->name .']';
			}
			
			return $list;						
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					$purses = $this->get_reserve_lists();
					$api = trim(is_isset($purses, $key));
					if($api){
						
						try {
							$PUBLIC_KEY = is_deffin($this->m_data,'PUBLIC_KEY');
							$PRIVAT_KEY = is_deffin($this->m_data,'PRIVAT_KEY');
							
							$class = new AP_CoinPaymentsAPI($PRIVAT_KEY, $PUBLIC_KEY);
							$result = $class->get_balans();
					
							$rezerv = '-1';
					
							if(isset($result['error']) and $result['error'] == 'ok'){
								$res = $result['result'];
								if(is_array($res)){
									foreach($res as $k => $v){
										if($api == $k){
											$rezerv = $res[$k]['balancef'];
										}
									}
								}
							}	
							
							if($rezerv != '-1'){
								pm_update_vr($currency_id, $rezerv);
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
	
					$api = trim(is_isset($purses, $key));
					if($api){
						
						try {
							$PUBLIC_KEY = is_deffin($this->m_data,'PUBLIC_KEY');
							$PRIVAT_KEY = is_deffin($this->m_data,'PRIVAT_KEY');
							
							$class = new AP_CoinPaymentsAPI($PRIVAT_KEY, $PUBLIC_KEY);
							$result = $class->get_balans();
					
							$rezerv = '-1';
					
							if(isset($result['error']) and $result['error'] == 'ok'){
								$res = $result['result'];
								if(is_array($res)){
									foreach($res as $k => $v){
										if($api == $k){
											$rezerv = $res[$k]['balancef'];
										}
									}
								}
							}	
							
							if($rezerv != '-1'){
								pm_update_nr($direction_id, $rezerv);
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

			$trans_id = 0;			
			$item_id = $item->id;
			$vtype = mb_strtoupper($item->currency_code_get);
					
			$addtxfee = intval(is_isset($paymerch_data, 'addtxfee'));		
					
			$enable = array('BTC','LTC','XRP','DASH','DOGE','ETC','ETH','NMC','PPC','USDT','WAVES','XMR','ZEC','USDT','BCH','NEO','QTUM','BCC');		
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}					
					
			$account = $item->account_get;
			if (!$account) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}				
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data));
			$minsum = '0.0004';
			if($sum < $minsum){
				$error[] = sprintf(__('Minimum payment amount is %s','pn'), $minsum);
			}		
					
			$PUBLIC_KEY = is_deffin($this->m_data,'PUBLIC_KEY');
			$PRIVAT_KEY = is_deffin($this->m_data,'PRIVAT_KEY');
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);				
				if($result){				
					try{
						$class = new AP_CoinPaymentsAPI($PRIVAT_KEY, $PUBLIC_KEY);
						$auto_confirm = 1;
						
						$params = array();
						if($addtxfee){
							$params['add_tx_fee'] = 1;
						}
						$dest_tag = trim(is_isset($unmetas,'dest_tag'));
						if($dest_tag){
							$params['dest_tag'] = $dest_tag;
						}
	
						$result = $class->get_transfer($sum, $vtype, $account, $auto_confirm, $params);
						if(isset($result['result']) and isset($result['result']['id'])){
							$trans_id = $result['result']['id'];
						} else {
							$error[] = $result['error'];
							$pay_error = 1;
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
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('coldsuccess', $item_id, $params, 1); 					
						 
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 
			}
							
		}

		function myaction_merchant_cron(){
		global $wpdb;
			
			$m_out = $this->name;
			
			$data = get_paymerch_data($this->name);
			$error_status = is_status_name(is_isset($data, 'error_status'));
			if(!$error_status){ $error_status = 'realpay'; }
			
			$PUBLIC_KEY = is_deffin($this->m_data,'PUBLIC_KEY');
			$PRIVAT_KEY = is_deffin($this->m_data,'PRIVAT_KEY');
			
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'coldsuccess' AND m_out='$m_out'");
			foreach($items as $item){
				$currency = mb_strtoupper($item->currency_code_get);
				$trans_id = trim($item->trans_out);
				if($trans_id){
					try {
						$class = new AP_CoinPaymentsAPI($PRIVAT_KEY, $PUBLIC_KEY);
						$result = $class->get_transfer_info($trans_id);
						if(isset($result['result']) and isset($result['result']['status'])){
							$check_status = intval($result['result']['status']);
							$txt_id = pn_strip_input($result['result']['send_txid']);
							if($check_status == 2){
								$params = array(
									'trans_out' => $txt_id,
									'system' => 'system',
									'ap_place' => 'site',
									'm_place' => 'cron ' .$this->name,
								);
								the_merchant_bid_status('success', $item->id, $params, 1);														
							} elseif($check_status == '-1') {
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
			
			_e('Done','pn');
		}		
		
	}
}
new paymerchant_coinpayments(__FILE__, 'Coinpayments');