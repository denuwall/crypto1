<?php
/*
title: [en_US:]Qiwi new[:en_US][ru_RU:]Qiwi new[:ru_RU]
description: [en_US:]Qiwi new automatic payouts[:en_US][ru_RU:]авто выплаты Qiwi new[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_qiwinew')){
	class paymerchant_qiwinew extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			
			$map = array(
				'BUTTON', 'API_TOKEN_KEY', 'API_WALLET',
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
						
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}			

			$options['qiwi_pay_method'] = array(
				'view' => 'select',
				'title' => __('Transaction type','pn'),
				'options' => array('0'=>'Qiwi Wallet','1963'=>'Visa(RU)','21013'=>'MasterCard(RU)','22351'=>'QIWI Visa Card'),
				'default' => is_isset($data, 'qiwi_pay_method'),
				'name' => 'qiwi_pay_method',
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
				is_deffin($this->m_data,'API_TOKEN_KEY') 
				and is_deffin($this->m_data,'API_WALLET')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			$purses = array(
				$this->name.'_1' => 'RUB',
			);	
			return $purses;
		}
		
		function reserv_place_list($list){	
		
			$purses = $this->get_reserve_lists();
			
			foreach($purses as $k => $v){
				$v = trim($v);
				if($v){
					$list[$k] = 'Qiwi - '. $v .' ['. $this->name .']';
				}
			}
			
			return $list;
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if(!$ind){
				if($this->check_reserv_list($key)){
					
					$purses = $this->get_reserve_lists();
					$purse = trim(is_isset($purses, $key));
					if($purse){
						
						try{
												
							$class = new AP_QIWI_API(is_deffin($this->m_data,'API_WALLET'), is_deffin($this->m_data,'API_TOKEN_KEY'), 0);
							$balances = $class->get_balances();					
					
							$rezerv = '-1';
								
							foreach($balances as $pursename => $amount){
								if( $pursename == $purse ){
									$rezerv = trim((string)$amount);
									break;
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
			if(!$ind){
				if($this->check_reserv_list($key)){
					
					$purses = $this->get_reserve_lists();
					$purse = trim(is_isset($purses, $key));
					if($purse){
						try{
								
							$class = new AP_QIWI_API(is_deffin($this->m_data,'API_WALLET'), is_deffin($this->m_data,'API_TOKEN_KEY'), 0);
							$balances = $class->get_balances();					
					
							$rezerv = '-1';
								
							foreach($balances as $pursename => $amount){
								if( $pursename == $purse ){
									$rezerv = trim((string)$amount);
									break;
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
			
			$currency = mb_strtoupper($item->currency_code_get);
			$currency = str_replace('RUR','RUB',$currency);
					
			$enable = array('RUB');
			if(!in_array($currency, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}		

			$account = '+'.str_replace('+','',$item->account_get);
						
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);	
			$minsum = '1';
			if($sum < $minsum){
				$error[] = sprintf(__('Minimum payment amount is %s','pn'), $minsum);
			}			
				
			$qiwi_pay_method = intval(is_isset($paymerch_data, 'qiwi_pay_method'));
			if(!$qiwi_pay_method){ $qiwi_pay_method = 99; }
				
			if(count($error) == 0){
					
				$result = $this->set_ap_status($item);	
				if($result){
					
					$notice = get_text_paymerch($this->name, $item);
					$notice = trim(pn_maxf($notice,100));
						
					try {

						$class = new AP_QIWI_API(is_deffin($this->m_data,'API_WALLET'), is_deffin($this->m_data,'API_TOKEN_KEY'), is_isset($paymerch_data ,'show_error'));
						$res = $class->send_money($account, $sum, $qiwi_pay_method, $notice);
						
						if($res['error'] == 1){
							$error[] = __('Payout error','pn');
							$pay_error = 1;
						} else {
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
					
				$params = array(
					'trans_out' => $trans_id,
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				if($qiwi_pay_method == 99){
					the_merchant_bid_status('success', $item_id, $params, 1);
				} else {
					the_merchant_bid_status('coldsuccess', $item_id, $params, 1);
				}
							
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 
							
			}								
		}
		
		function myaction_merchant_cron(){
		global $wpdb;
			
			$m_out = $this->name;
			
			$paymerch_data = get_paymerch_data($this->name);
			
			$orders = array();
			
			try {
				$class = new AP_QIWI_API(is_deffin($this->m_data,'API_WALLET'), is_deffin($this->m_data,'API_TOKEN_KEY'), is_isset($paymerch_data,'show_error'));
				$orders = $class->get_history(date('c',strtotime('-30 days')),date('c',strtotime('+1 day')));
			}
			catch( Exception $e ) {
										
			}	

			if(is_array($orders)){
				$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'coldsuccess' AND m_out='$m_out'");
				foreach($items as $item){
					$currency = mb_strtoupper($item->currency_code_get);
					$trans_id = trim($item->trans_out);
					if($trans_id){
						if(isset($orders[$trans_id])){
							$check_status = mb_strtolower($orders[$trans_id]['status']);
							if($check_status == 'success'){
								$params = array(
									'system' => 'system',
									'ap_place' => 'site',
									'm_place' => 'cron ' .$this->name,
								);
								the_merchant_bid_status('success', $item->id, $params, 1);														
							} 
						}
					}
				}
			}
			
			_e('Done','pn');
		}		
						
	}
}

new paymerchant_qiwinew(__FILE__, 'Qiwi new');