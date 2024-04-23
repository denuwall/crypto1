<?php
/*
title: [en_US:]NixMoney[:en_US][ru_RU:]NixMoney[:ru_RU]
description: [en_US:]NixMoney automatic payouts[:en_US][ru_RU:]авто выплаты NixMoney[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_nixmoney')){
	class paymerchant_nixmoney extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'AP_NIXMONEY_BUTTON', 'AP_NIXMONEY_ACCOUNT', 'AP_NIXMONEY_PASSWORD', 
				'AP_NIXMONEY_USD', 'AP_NIXMONEY_EUR', 'AP_NIXMONEY_BTC',
				'AP_NIXMONEY_LTC', 'AP_NIXMONEY_PPC', 'AP_NIXMONEY_FTC',
				'AP_NIXMONEY_CRT', 'AP_NIXMONEY_GBC', 'AP_NIXMONEY_DOGE',
			);
			parent::__construct($file, $map, $title, 'AP_NIXMONEY_BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}

		function security_list(){
			return array('show_error','checkpay');
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
			
			return $noptions;
		}	
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'AP_NIXMONEY_ACCOUNT') 
				and is_deffin($this->m_data,'AP_NIXMONEY_PASSWORD')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => is_deffin($this->m_data,'AP_NIXMONEY_USD'),
				$this->name.'_2' => is_deffin($this->m_data,'AP_NIXMONEY_EUR'),
				$this->name.'_3' => is_deffin($this->m_data,'AP_NIXMONEY_BTC'),
				$this->name.'_4' => is_deffin($this->m_data,'AP_NIXMONEY_LTC'),
				$this->name.'_5' => is_deffin($this->m_data,'AP_NIXMONEY_PPC'),
				$this->name.'_6' => is_deffin($this->m_data,'AP_NIXMONEY_FTC'),
				$this->name.'_7' => is_deffin($this->m_data,'AP_NIXMONEY_CRT'),
				$this->name.'_8' => is_deffin($this->m_data,'AP_NIXMONEY_GBC'),
				$this->name.'_9' => is_deffin($this->m_data,'AP_NIXMONEY_DOGE'),
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$v = trim($v);
				if($v){
					$list[$k] = 'NixMoney '. $v.' ['. $this->name .']';
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
					
							$oClass = new AP_NixMoney( is_deffin($this->m_data,'AP_NIXMONEY_ACCOUNT'), is_deffin($this->m_data,'AP_NIXMONEY_PASSWORD') );
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
					
							$oClass = new AP_NixMoney( is_deffin($this->m_data,'AP_NIXMONEY_ACCOUNT'), is_deffin($this->m_data,'AP_NIXMONEY_PASSWORD') );
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
			$trans_id = 0;
				
			$vtype = mb_strtoupper($item->currency_code_get);
					
			$enable = array('USD','EUR','BTC','LTC','PPC','FTC','CRT','GBC','DOGE');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
			$account = mb_strtoupper($account);				
					
			$site_purse = '';
			if($vtype == 'USD'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_USD');
			} elseif($vtype == 'EUR'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_EUR');
			} elseif($vtype == 'BTC'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_BTC');
			} elseif($vtype == 'LTC'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_LTC');
			} elseif($vtype == 'PPC'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_PPC');
			} elseif($vtype == 'FTC'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_FTC');
			} elseif($vtype == 'CRT'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_CRT');
			} elseif($vtype == 'GBC'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_GBC');
			} elseif($vtype == 'DOGE'){
				$site_purse = is_deffin($this->m_data,'AP_NIXMONEY_DOGE');					
			} 
					
			$site_purse = mb_strtoupper($site_purse);
			if (!$site_purse) {
				$error[] = __('Your account set on website does not match with currency code','pn');
			}			

			$sum = is_paymerch_sum($this->name, $item, $paymerch_data);
					
			$two = array('USD','EUR');
			if(in_array($vtype, $two)){
				$sum = is_sum($sum, 2);
			} else {
				$sum = is_sum($sum);
			}
					
			$check_history = intval(is_isset($paymerch_data, 'checkpay'));
			if($check_history == 1){
					
				try {
					$class = new AP_NixMoney( is_deffin($this->m_data,'AP_NIXMONEY_ACCOUNT'), is_deffin($this->m_data,'AP_NIXMONEY_PASSWORD') );
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
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,100));
						
					try{
						
						$oClass = new AP_NixMoney( is_deffin($this->m_data,'AP_NIXMONEY_ACCOUNT'), is_deffin($this->m_data,'AP_NIXMONEY_PASSWORD') );
						$res = $oClass->SendMoney($site_purse, $account, $sum, $item_id, $notice);
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

new paymerchant_nixmoney(__FILE__, 'NixMoney');