<?php
/*
title: [en_US:]AskBTC[:en_US][ru_RU:]AskBTC[:ru_RU]
description: [en_US:]AskBTC automatic payouts[:en_US][ru_RU:]авто выплаты AskBTC[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_askbtc')){
	class paymerchant_askbtc extends AutoPayut_Premiumbox {
		
		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'API_KEY', 'API_SECRET',
				'BCH','BTC','LTC','DSH','ETH','ZEC','USDT',
			);
			parent::__construct($file, $map, $title, 'BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));			
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
			add_action('myaction_merchant_ap_'. $this->name .'_status' . get_hash_result_url($this->name, 'ap'), array($this,'myaction_merchant_status'));
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

			$text = '
			<strong>CALLBACK (TXID):</strong> <a href="'. get_merchant_link('ap_'. $this->name .'_status' . get_hash_result_url($this->name, 'ap')) .'" target="_blank">'. get_merchant_link('ap_'. $this->name .'_status' . get_hash_result_url($this->name, 'ap')) .'</a>
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
				is_deffin($this->m_data,'API_KEY') 
				and is_deffin($this->m_data,'API_SECRET')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			$keys = array('BTC','LTC','DSH','ETH','ZEC','BCH', 'USDT');
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
				$list[$k] = 'AskBTC '. $v .':'. is_deffin($this->m_data, $v).' ['. $this->name .']';
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
							$API_KEY = is_deffin($this->m_data,'API_KEY');
							$API_SECRET = is_deffin($this->m_data,'API_SECRET');
							
							$class = new AP_AskBtc($API_KEY, $API_SECRET);
							$res = $class->get_balans();
							$api = mb_strtolower($api);
					
							$rezerv = '-1';
					
							if(is_array($res)){
								foreach($res as $k => $v){
									if($api == $k){
										$rezerv = $v;
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
						
						try{
					
							$API_KEY = is_deffin($this->m_data,'API_KEY');
							$API_SECRET = is_deffin($this->m_data,'API_SECRET');
							
							$class = new AP_AskBtc($API_KEY, $API_SECRET);
							$res = $class->get_balans();
							$api = mb_strtolower($api);
					
							$rezerv = '-1';
					
							if(is_array($res)){
								foreach($res as $k => $v){
									if($api == $k){
										$rezerv = $v;
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
			$vtype_api = mb_strtolower($item->currency_code_get);
			$vtype_api = str_replace('dash','dsh',$vtype_api);
					
			$enable = array('BTC','LTC','DSH','ETH','ZEC','BCH', 'USDT');		
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
			if (!$account) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data));
										
			$API_KEY = is_deffin($this->m_data,'API_KEY');
			$API_SECRET = is_deffin($this->m_data,'API_SECRET');
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){
					try{
						$class = new AP_AskBtc($API_KEY, $API_SECRET);
						$res = $class->send_money($vtype_api, $account, $sum);
						if($res['error'] == 1){
							$error[] = __('Payout error','pn');
							$pay_error = 1;
						} else {
							$trans_id = $res['trans_id'];
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
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);

				the_merchant_bid_status('coldsuccess', $item_id, $params, 1);	
						 
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 	
						
			}
		}

		function myaction_merchant_status(){
		global $wpdb;

			$m_out = $this->name;
			
			$address = pn_strip_input(is_param_req('address')); 
			$txid = pn_strip_input(is_param_req('txid'));
			$askTxId = pn_strip_input(is_param_req('askTxId'));
			$currency = mb_strtoupper(pn_strip_input(is_param_req('currency')));
			$in_sum = is_sum(is_param_req('volume'));		
			
			if($askTxId){				
				$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'coldsuccess' AND m_out='$m_out'");
				foreach($items as $item){
					$item_currency = mb_strtoupper($item->currency_code_get);
					$trans_id = trim($item->trans_out);
					if($trans_id and $trans_id == $askTxId){
						$params = array(
							'trans_out' => $txid,
							'system' => 'system',
							'm_place' => 'status ' .$this->name,
						);
						the_merchant_bid_status('success', $item->id, $params, 1);														
					}
				}			
			}
			
			_e('Done','pn');			
		}
		
	}
}

new paymerchant_askbtc(__FILE__, 'AskBTC');