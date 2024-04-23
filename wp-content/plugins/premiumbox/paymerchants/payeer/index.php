<?php
/*
title: [en_US:]Payeer[:en_US][ru_RU:]Payeer[:ru_RU]
description: [en_US:]Payeer automatic payouts[:en_US][ru_RU:]авто выплаты Payeer[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_payeer')){
	class paymerchant_payeer extends AutoPayut_Premiumbox{
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
			
			return $noptions;
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
				$list[$k] = 'Payeer '. $v .' ('. is_deffin($this->m_data,'ACCOUNT_NUMBER') .')'.' ['. $this->name .']';
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
			$account = mb_strtoupper($account);
			if (!$account) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}							

			$trans_sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);
			$sum = 0;
			if($trans_sum > 0){
				$sum = $trans_sum / 0.9905;
			}		
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,100));
						
					try{
						
						$payeer = new AP_Payeer(is_deffin($this->m_data,'ACCOUNT_NUMBER'), is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_KEY'));
						if ($payeer->isAuth()){
									
							$arTransfer = $payeer->transfer(array(
								'curIn' => $vtype,
								'sum' => $sum,
								'curOut' => $vtype,
								//'to' => 'richkeeper@gmail.com',
								//'to' => '+01112223344',
								'to' => $account,
								'comment' => $notice,
								//'anonim' => 'Y',
								//'protect' => 'Y',
								//'protectPeriod' => '3',
								//'protectCode' => '12345',
							));								
									
							if (empty($arTransfer['errors']) and isset($arTransfer['historyId'])) {
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
				the_merchant_bid_status('success', $item_id, $params, 1); 						
						
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				}  
						
			}
		}				
		
	}
}

new paymerchant_payeer(__FILE__, 'Payeer');