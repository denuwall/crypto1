<?php
/*
title: [en_US:]E-Pay[:en_US][ru_RU:]E-Pay[:ru_RU]
description: [en_US:]E-Pay automatic payouts[:en_US][ru_RU:]авто выплаты E-Pay[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_epay')){
	class paymerchant_epay extends AutoPayut_Premiumbox{
		
		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'PAYEE_ACCOUNT', 'PAYEE_NAME', 'API_KEY',
			);
			parent::__construct($file, $map, $title, 'BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));			
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}		
		
		function security_list(){
			return array('show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
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
			
			if(isset($noptions['checkpay'])){
				unset($noptions['checkpay']);
			}
			if(isset($noptions['resulturl'])){
				unset($noptions['resulturl']);
			}						
			$opt = array(
				'0' => __('E-Pay','pn'),
				'1' => __('Perfect Money','pn'),
				'2' => __('Webmoney','pn'),
				//'3' => __('Okpay','pn'),
				'4' => __('Payeer','pn'),
				'5' => __('AdvCash','pn'),
				'7' => __('PayPal','pn'),
				'8' => __('FasaPay','pn'),
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
				is_deffin($this->m_data,'PAYEE_ACCOUNT') 
				and is_deffin($this->m_data,'PAYEE_NAME') 
				and is_deffin($this->m_data,'API_KEY')			
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => 'USD',
				$this->name.'_2' => 'EUR',
				$this->name.'_3' => 'HKD',
				$this->name.'_4' => 'GBP',
				$this->name.'_5' => 'JPY',
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$list[$k] = 'E-Pay '. is_deffin($this->m_data,'PAYEE_ACCOUNT') .' '. $v.' ['. $this->name .']';
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
					
							$class = new AP_EPay(is_deffin($this->m_data,'PAYEE_ACCOUNT'),is_deffin($this->m_data,'PAYEE_NAME'),is_deffin($this->m_data,'API_KEY'));
							$res = $class->getBalans();
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
					
							$class = new AP_EPay(is_deffin($this->m_data,'PAYEE_ACCOUNT'),is_deffin($this->m_data,'PAYEE_NAME'),is_deffin($this->m_data,'API_KEY'));
							$res = $class->getBalans();
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
			
			$variant = intval(is_isset($paymerch_data,'variant'));
			
			$vtype = mb_strtoupper($item->currency_code_get);
					
			$enable = array('USD', 'EUR', 'HKD', 'GBP', 'JPY');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
					
			if (!$account){
				$error[] = __('Client wallet type does not match with currency code','pn');						
			}
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);					
					
			$pay_status = 0;
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);	
				if($result){
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,100));
						
					try{
						
						$class = new AP_EPay(is_deffin($this->m_data,'PAYEE_ACCOUNT'),is_deffin($this->m_data,'PAYEE_NAME'),is_deffin($this->m_data,'API_KEY'));
						if($variant == 0){
							$res = $class->SendMoney($vtype, $account, $sum, $item_id, $notice);
						} else {
							$res = $class->ESendMoney($vtype, $account, $sum, $item_id, $notice, $variant);
						}
						if($res['error'] == 1){
							$error[] = __('Payout error','pn');
							$pay_error = 1;
						} else {
							$trans_id = $res['trans_id'];
							$pay_status = $res['trans_status'];
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
					'from_account' => is_deffin($this->m_data,'PAYEE_ACCOUNT'),
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);						
						
				if($pay_status == 1){
					the_merchant_bid_status('success', $item_id, $params, 1); 
					if($place == 'admin'){
						pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
					}							
				} else {
					the_merchant_bid_status('coldsuccess', $item_id, $params, 1);
					if($place == 'admin'){
						pn_display_mess(__('Payment is successfully created. Waiting for confirmation from E-pay.','pn'),__('Payment is successfully created. Waiting for confirmation from E-pay.','pn'),'true');
					}							
				}
						
			}
		}				
		
	}
}
new paymerchant_epay(__FILE__, 'E-Pay');