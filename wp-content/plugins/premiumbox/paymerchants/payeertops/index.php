<?php
/*
title: [en_US:]Payeer (withdraw to PS)[:en_US][ru_RU:]Payeer (вывод на ПС)[:ru_RU]
description: [en_US:]Payeer (withdraw to PS) automatic payouts[:en_US][ru_RU:]авто выплаты Payeer (вывод на платежные системы, карты и т.п.)[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_payeertops')){
	class paymerchant_payeertops extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'AP_BUTTON', 'ACCOUNT_NUMBER', 'API_ID', 'API_KEY',
			);
			parent::__construct($file, $map, $title, 'AP_BUTTON');
			
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
			
			try {
				$types = array();
				$types[0] = '--' . __('No','pn') . '--';
				$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
				$res = array();
				if ($payeer->isAuth())
				{
					$res = $payeer->getPaySystems();
						if(isset($res['list']) and is_array($res['list'])){
						foreach($res['list'] as $res_id => $res_data){
							$types[$res_id] = is_isset($res_data,'name') . ' [' . $res_id . ']';
						}
					}
				}
				$options[] = array(
					'view' => 'select',
					'title' => __('Transaction type','pn'),
					'options' => $types,
					'default' => is_isset($data, 'payment_type'),
					'name' => 'payment_type',
					'work' => 'input',
				);		
				/* 				
				$options['help_payment_type'] = array(
					'view' => 'help',
					'title' => __('More info','pn'),
					'default' => print_r($res, true),
				); 
				*/				
			}
			catch (Exception $e)
			{
				$options[] = array(
					'view' => 'textfield',
					'title' => '',
					'default' => $e,
				);							
			}			
			
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
				is_deffin($this->m_data,'ACCOUNT_NUMBER') 
				and is_deffin($this->m_data,'API_ID') 
				and is_deffin($this->m_data,'API_KEY') 
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => 'EUR',
				$this->name.'_2' => 'USD',
				$this->name.'_3' => 'RUB',
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$list[$k] = 'Payeer to PS '. $v .' ('. is_deffin($this->m_data,'ACCOUNT_NUMBER') .')'.' ['. $this->name .']';
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
					
							$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
							if ($payeer->isAuth())
							{
								$rezerv = '-1';
								
								$arBalance = $payeer->getBalance();
								$rezerv = trim((string)$arBalance['balance'][$purse]['BUDGET']);
								
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
					
							$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
							if ($payeer->isAuth())
							{
								$rezerv = '-1';
								
								$arBalance = $payeer->getBalance();
								$rezerv = trim((string)$arBalance['balance'][$purse]['BUDGET']);
								
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
			$vtype = str_replace(array('RUR'),'RUB',$vtype);
					
			$enable = array('USD','RUB','EUR');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
					
			$account = $item->account_get;
			if (!$account) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}					
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data));
					
			$payment_type = is_sum(is_isset($paymerch_data, 'payment_type'));
			if($payment_type == 0){
				$error[] = __('Transaction type is not selected','pn');
			}
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){				
					try {
						$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
						if ($payeer->isAuth()){
									
							$arr = array();
							$arr['ps'] = $payment_type;
							$arr['curIn'] = $vtype;
							$arr['sumOut'] = $sum;
							$arr['curOut'] = $vtype;
							$arr['param_ACCOUNT_NUMBER'] = $account;
							$arTransfer = $payeer->output($arr);
									
							if (empty($arTransfer['errors']) and isset($arTransfer['historyId'])){
								$trans_id = $arTransfer['historyId'];
							} else {
								$error[] = __('Payout error','pn');
								$pay_error = 1;
							}								 
								
						} else {
							$pay_error = 1;
							$error[] = 'Error interfaice';
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
					'from_account' => is_deffin($this->m_data,'ACCOUNT_NUMBER'),
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('coldsuccess', $item_id, $params,1); 					
						 
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
			
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'coldsuccess' AND m_out='$m_out'");
			foreach($items as $item){
				$trans_id = trim($item->trans_out);
				if($trans_id){
					try {
						$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
						if($payeer->isAuth()){
							$arTransfer = $payeer->getHistoryInfo($trans_id);
							if (empty($arTransfer['errors']) and isset($arTransfer['info'])){
								$check_status = trim(is_isset($arTransfer['info'],'status'));
								if($check_status == 'execute'){
									$params = array(
										'system' => 'system',
										'ap_place' => 'site',
										'm_place' => 'cron ' .$this->name,
									);
									the_merchant_bid_status('success', $item->id, $params, 1);														
								} elseif($check_status != 'process' and $check_status != 'wait'){
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
					}
					catch( Exception $e ) {
										
					}
				}
			}
			
			/*
			execute - выполнен (конечный статус)
			process - в процессе выполнения (изменится на execute, cancel или hold)
			cancel - отменен (конечный статус)
			wait - в ожидании (например в ожидании оплаты) (изменится на execute, cancel или hold)
			hold - приостановлен (изменится на execute, cancel)
			black_list - операция остановлена из-за попадание под фильтр блэк-листа (может измениться на execute, cancel или hold)
			*/			
			
			_e('Done','pn');
		}		
		
	}
}
new paymerchant_payeertops(__FILE__, 'Payeer to ps');