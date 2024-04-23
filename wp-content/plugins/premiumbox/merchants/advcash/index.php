<?php
/*
title: [en_US:]AdvCash[:en_US][ru_RU:]AdvCash[:ru_RU]
description: [en_US:]AdvCash merchant[:en_US][ru_RU:]мерчант AdvCash[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_advcash')){
	class merchant_advcash extends Merchant_Premiumbox {
		function __construct($file, $title)
		{
			$map = array(
				'ACCOUNT_EMAIL', 'SCI_NAME', 'SCI_SECRET',
				'API_NAME','API_PASSWORD',
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'. $this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_fail', array($this,'myaction_merchant_fail'));
			add_action('myaction_merchant_'. $this->name .'_success', array($this,'myaction_merchant_success'));
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
		}
		
		function merchants_settingtext($text){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'ACCOUNT_EMAIL') 
				and is_deffin($this->m_data,'SCI_NAME') 
				and is_deffin($this->m_data,'SCI_SECRET') 
			){
				$text = '';
			}
			return $text;
		}	

		function merchant_formstep_autocheck($autocheck, $m_id){
			if($m_id and $m_id == $this->name){
				$autocheck = 1;
			}
			return $autocheck;
		}	

		function security_list(){
			return array('resulturl','show_error', 'enableip','check_api');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			
			$text = '
			<strong>Status URL:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
			<strong>Success URL:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a><br />
			<strong>Fail URL:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a>			
			';

			$options['text'] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);			
			
			return $options;	
		}

		function merchant_bidform($temp, $pay_sum, $item, $direction){

			$amount = is_sum($pay_sum,2);
			$text_pay = get_text_pay($this->name, $item, $amount);		
			
			$currency = pn_strip_input(str_replace('RUB','RUR',$item->currency_code_give));
			$orderId = $item->id;
			$ac_account_email = is_deffin($this->m_data,'ACCOUNT_EMAIL');
			$ac_sci_name = is_deffin($this->m_data,'SCI_NAME');
			$sign = hash('sha256', $ac_account_email . ":" . $ac_sci_name . ":" . $amount . ":" . $currency . ":" . is_deffin($this->m_data,'SCI_SECRET') . ":" . $orderId);
									
			$temp = '
			<form name="MerchantPay" action="https://wallet.advcash.com/sci/" method="post">
				<input type="hidden" name="ac_account_email" value="'. $ac_account_email .'" /> 
				<input type="hidden" name="ac_sci_name" value="'. $ac_sci_name .'" />  
				<input type="hidden" name="ac_order_id" value="'. $orderId .'" /> 
				<input type="hidden" name="ac_sign" value="'. $sign .'" />			
						
				<input type="hidden" name="ac_amount" value="'. $amount .'" />
				<input type="hidden" name="ac_currency" value="'. $currency .'" />
				<input type="hidden" name="ac_comments" value="'. $text_pay .'" />
						
				<input type="submit" value="'. __('Make a payment','pn') .'" />
			</form>												
			';				
			
			return $temp;
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('ac_order_id');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('ac_order_id');
			the_merchant_bid_success($id);
		}
	
		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$transactionId = is_param_req('ac_transfer');
			$paymentDate = is_param_req('ac_start_date');
			$sciName = is_param_req('ac_sci_name');
			$payer = is_param_req('ac_src_wallet');
			$destWallet = is_param_req('ac_dest_wallet');
			$orderId = is_param_req('ac_order_id');
			$amount = is_param_req('ac_amount');
			$currency = is_param_req('ac_merchant_currency');
			$hash = is_param_req('ac_hash'); 
			$pay_status = is_param_req('ac_transaction_status');
			
			if( $hash != strtolower( hash('sha256', $transactionId.':'.$paymentDate.':'.$sciName.':'.$payer.':'.$destWallet.':'.$orderId.':'.$amount.':'.$currency.':'. is_deffin($this->m_data,'SCI_SECRET') ) ) ){
				die( 'Неверная контрольная подпись' );	
			}	
			
			$next = 1;
			
			$check_history = intval(is_isset($m_data, 'check_api'));
			$show_error = intval(is_isset($m_data, 'show_error'));
			if($check_history == 1){
				
				$next = 0;
				
				try {
					$merchantWebService = new MerchantWebService();
					$arg0 = new authDTO();
					$arg0->apiName = is_deffin($this->m_data,'API_NAME');
					$arg0->accountEmail = is_deffin($this->m_data,'ACCOUNT_EMAIL');
					$arg0->authenticationToken = $merchantWebService->getAuthenticationToken(is_deffin($this->m_data,'API_PASSWORD'));

					$arg1 = $transactionId;

					$findTransaction = new findTransaction();
					$findTransaction->arg0 = $arg0;
					$findTransaction->arg1 = $arg1;
					
					$findTransactionResponse = $merchantWebService->findTransaction($findTransaction);
					if(isset($findTransactionResponse->return)){
						$result = $findTransactionResponse->return;
						
						$next = 1;
						
						$payer = is_isset($result, 'walletSrcId');
						$destWallet = is_isset($result, 'walletDestId');
						$orderId = is_isset($result, 'orderId');
						$amount = is_isset($result, 'amount');
						$currency = is_isset($result, 'currency');
						$pay_status = is_isset($result,'status');						
					}
				}
				catch( Exception $e ) {
					if($show_error){
						die($e->getMessage());
					}
				}		
			
			}			
			
			if($next != 1){
				die( 'Ошибка проверки по истории!' );
			}
			
			if(check_trans_in($this->name, $transactionId, $orderId)){
				die('Error!');
			}
			
			$id = $orderId;
			$data = get_data_merchant_for_id($id);
			
			$in_sum = $amount;
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
			
			$pay_purse = is_pay_purse($payer, $m_data, $bid_m_id);
			
			$bid_currency = $data['currency'];
			$bid_currency = str_replace('RUB','RUR',$bid_currency);
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));
			
			/*
			PENDING, PROCESS, CONFIRMED, COMPLETED, CANCELED
			*/
			$en_status = array('new','techpay','coldpay');
			if(in_array($bid_status, $en_status)){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
								$now_status = '';
								if($pay_status == 'PENDING'){
									$now_status = 'coldpay';
								} elseif($pay_status == 'PROCESS'){
									$now_status = 'coldpay';
								} elseif($pay_status == 'COMPLETED'){
									$now_status = 'realpay';
								}
								if($now_status){	
									$params = array(
										'sum' => $in_sum,
										'bid_sum' => $bid_sum,
										'bid_corr_sum' => $bid_corr_sum,
										'pay_purse' => $pay_purse,
										'to_account' => $destWallet,
										'trans_in' => $transactionId,
										'currency' => $currency,
										'bid_currency' => $bid_currency,
										'invalid_ctype' => $invalid_ctype,
										'invalid_minsum' => $invalid_minsum,
										'invalid_maxsum' => $invalid_maxsum,
										'invalid_check' => $invalid_check,
										'm_place' => $bid_m_id,
									);
									the_merchant_bid_status($now_status, $id, $params, 0);
								}
								
								die( 'Completed' );
							} else {
								die('The payment amount is less than the provisions');
							}
						} else {
							die('Wrong type of currency');
						}
					} else {
						die('At the direction of off merchant');
					}
				} else {
					die( 'The application does not exist or the wrong ID' );
				}
			} else {
				die( 'In the application the wrong status' );
			}			
		}		
	}
}

new merchant_advcash(__FILE__, 'AdvCash');		