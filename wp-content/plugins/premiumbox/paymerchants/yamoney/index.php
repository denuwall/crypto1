<?php
/*
title: [en_US:]Yandex money[:en_US][ru_RU:]Yandex money[:ru_RU]
description: [en_US:]Yandex money automatic payouts[:en_US][ru_RU:]авто выплаты Yandex money[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_yamoney')){
	class paymerchant_yamoney extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'AP_YANDEX_MONEY_BUTTON', 'AP_YANDEX_MONEY_ACCOUNT', 'AP_YANDEX_MONEY_APP_ID', 
				'AP_YANDEX_MONEY_APP_KEY', 
			);
			parent::__construct($file, $map, $title, 'AP_YANDEX_MONEY_BUTTON');
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_action('before_paymerchant_admin',array($this,'before_paymerchant_admin'));
			add_action('myaction_merchant_ap_'.$this->name.'_verify', array($this,'myaction_merchant_verify'));
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
			$text = '
			<strong>'. __('Enter address to create new application','pn') .':</strong> <a href="https://money.yandex.ru/myservices/new.xml" target="_blank">https://money.yandex.ru/myservices/new.xml</a>.<br />
			<strong>Redirect URI:</strong> <a href="'. get_merchant_link('ap_'. $this->name .'_verify') .'" target="_blank">'. get_merchant_link('ap_'. $this->name .'_verify') .'</a>				
			';
			$options['text'] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);			
			
			return $options;
		}			
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT')
			){
				$text = '';
			}
			
			return $text;
		}
		
		function before_paymerchant_admin($m_id){
			if($m_id and $m_id == $this->name){
			
				echo '<div class="premium_reply theerror">'. sprintf(__('You have to pass <a href="%s" target="_blank">application authorization</a> in order to proceed.','pn'), get_merchant_link('ap_'. $this->name .'_verify')) .'</div>';
					
			}			
		}
		
		function myaction_merchant_verify(){
			
			if(current_user_can('administrator') or current_user_can('pn_merchants')){
				
				if(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID')){

					if( isset( $_GET['code'] ) ) {
						
						$oClass = new AP_YaMoney(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID'), is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_KEY'), $this->name);
						$token = $oClass->auth();
						if($token){
							
							$res = $oClass->accountInfo($token);
							if(!isset($res['account'])){
								pn_display_mess(__('No data received from the payment system','pn'));
							} elseif($res['account'] != is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT') ){
								pn_display_mess(sprintf(__('Authorization can me made from account %s','pn'), is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT')));
							} else {
								$oClass->update_token($token);
								wp_redirect(admin_url('admin.php?page=pn_data_paymerchants&m_id='. $this->name .'&reply=true'));
								exit;
							}
							
						} else {
							
							pn_display_mess(__('Retry','pn'));
							
						}
						
					} else {
						
						$oClass = new AP_YaMoney(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID'), is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_KEY'), $this->name);
						$res = $oClass->accountInfo();

						if( !isset( $res['account'] ) or $res['account'] != is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT') ){
							
							header( 'Location: https://money.yandex.ru/oauth/authorize?client_id='. is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID') .'&response_type=code&redirect_uri='. urlencode( get_merchant_link('ap_'. $this->name .'_verify') ) .'&scope=account-info operation-history operation-details payment-p2p ');
							exit();
							
						} else {
							
							pn_display_mess(__('Payment system is configured','pn'), __('Payment system is configured','pn'),'true');
							
						}
						
					}
				}
				
			} else {
				pn_display_mess(__('Error! Insufficient privileges','pn'));	
			}
		}		

		function reserv_place_list($list){
			
			$list[$this->name.'_1'] = 'Yandex Money '. is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT') .' ['. $this->name .']';
			
			return $list;									
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($key == $this->name.'_1'){	
					try{
					
						$oClass = new AP_YaMoney(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID'), is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_KEY'), $this->name);
						$res = $oClass->accountInfo();
						if(is_array($res) and isset($res['balance'])){
								
							$rezerv = trim((string)$res['balance']);
							pm_update_vr($currency_id, $rezerv);						
								
						} 
						
					}
					catch (Exception $e)
					{
							
					} 				
						
					return 1;
				}
			}
			
			return $ind;			
		}

		function update_direction_reserv($ind, $key, $direction_id){
			$ind = intval($ind);
			if($ind == 0){
				if($key == $this->name.'_1'){	
					try{
					
						$oClass = new AP_YaMoney(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID'), is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_KEY'), $this->name);
						$res = $oClass->accountInfo();
						if(is_array($res) and isset($res['balance'])){
								
							$rezerv = trim((string)$res['balance']);
							pm_update_nr($direction_id, $rezerv);						
								
						} 
						
					}
					catch (Exception $e)
					{
							
					} 				
						
					return 1;
				}
			}
			
			return $ind;			
		}		

		function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
			$item_id = $item->id;
			$trans_id = 0;			
			
			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace('RUR','RUB',$vtype);
					
			$enable = array('RUB');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
			$account = mb_strtoupper($account);
			if (!preg_match("/^[0-9]{5,20}$/", $account, $matches )) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}							

			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);				
				if($result){				
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,150));
						
					try{
						
						$oClass = new AP_YaMoney(is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_ID'), is_deffin($this->m_data,'AP_YANDEX_MONEY_APP_KEY'), $this->name);
						$reguest_id = $oClass->addPay($account, $sum, $notice, $item->id);
						if($reguest_id){
							$res = $oClass->processPay($reguest_id);
							if($res['error'] == 1){
								$error[] = __('Payout error','pn');
								$pay_error = 1;
							}	
							$trans_id = $reguest_id;
						} else {
							$error[] = 'Error interfaice';
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
					'from_account' => is_deffin($this->m_data,'AP_YANDEX_MONEY_ACCOUNT'),
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

new paymerchant_yamoney(__FILE__, 'Yandex money');