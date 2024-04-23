<?php
/*
title: [en_US:]E-Pay[:en_US][ru_RU:]E-Pay[:ru_RU]
description: [en_US:]E-Pay merchant[:en_US][ru_RU:]мерчант E-Pay[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_epay')){
	class merchant_epay extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'PAYEE_ACCOUNT', 'PAYEE_NAME', 'API_KEY',
			);
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_fail', array($this,'myaction_merchant_fail'));
			add_action('myaction_merchant_'. $this->name .'_success', array($this,'myaction_merchant_success'));
			add_action('myaction_merchant_'. $this->name .'_status', array($this,'myaction_merchant_status'));
		}

		function security_list(){
			return array('show_error','enableip','check_api');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			
			$text = '
			<strong>RETURN URL:</strong> <a href="'. get_merchant_link($this->name.'_status') .'" target="_blank">'. get_merchant_link($this->name.'_status') .'</a><br />
			<strong>SUCCESS URL:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a><br />
			<strong>FAIL URL:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a>				
			';

			$options['text'] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);			
			
			return $options;	
		}							
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'PAYEE_ACCOUNT') 
				or is_deffin($this->m_data,'PAYEE_NAME') 
				or is_deffin($this->m_data,'API_KEY') 
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
		
		function merchant_bidform($temp, $pay_sum, $item, $direction){

			$currency = pn_strip_input($item->currency_code_give);
			$pay_sum = is_sum($pay_sum,2);				
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
			
			$PAYEE_ACCOUNT = is_deffin($this->m_data,'PAYEE_ACCOUNT');
			$PAYEE_NAME = is_deffin($this->m_data,'PAYEE_NAME');
			$PAYMENT_AMOUNT = $pay_sum;
			$PAYMENT_UNITS = $currency;
			$PAYMENT_ID = $item->id;
			$API_KEY = is_deffin($this->m_data,'API_KEY');
			$V2_HASH = MD5($PAYEE_ACCOUNT.':'.$PAYMENT_AMOUNT.':'.$PAYMENT_UNITS.':'.$API_KEY);			
				
			$temp = '
			<form method="post" action="https://api.epay.com/paymentApi/merReceive" >
				<input name="PAYEE_ACCOUNT" type="hidden" value="'. $PAYEE_ACCOUNT .'" />
				<input name="PAYEE_NAME" type="hidden" value="'. $PAYEE_NAME .'" />
				<input name="PAYMENT_AMOUNT" type="hidden" value="'. $PAYMENT_AMOUNT .'" />
				<input name="PAYMENT_UNITS" type="hidden" value="'. $PAYMENT_UNITS .'" />
				<input name="PAYMENT_ID" type="hidden" value="'. $PAYMENT_ID .'" />
				<input name="STATUS_URL" type="hidden" value="'. get_merchant_link($this->name.'_status') . '" />
				<input name="PAYMENT_URL" type="hidden" value="'. get_merchant_link($this->name.'_success') .'" />
				<input name="NOPAYMENT_URL" type="hidden" value="'. get_merchant_link($this->name.'_fail') .'" />
				<input name="BAGGAGE_FIELDS" type="hidden" value="" />
				<input name="KEY_CODE" type="hidden" value="" />
				<input name="BATCH_NUM" type="hidden" value="" />
				<input name="SUGGESTED_MEMO" type="hidden" value="'. $text_pay .'" />
				<input name="FORCED_PAYER_ACCOUNT" type="hidden" value="" />
				<input name="INTERFACE_LANGUAGE" type="hidden" value="" />
				<input name="CHARACTER_ENCODING" type="hidden" value="" />
				<input name="V2_HASH" type="hidden" value="'. $V2_HASH .'" />
				<input type="submit" formtarget="_top" value="'. __('Make a payment','pn') .'" />	
			</form>								
			';				
				
			return $temp;				
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('PAYMENT_ID');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('PAYMENT_ID');
			the_merchant_bid_success($id);
		}

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$PAYEE_ACCOUNT = is_deffin($this->m_data,'PAYEE_ACCOUNT');
			$PAYEE_NAME = is_deffin($this->m_data,'PAYEE_NAME');
			$API_KEY = is_deffin($this->m_data,'API_KEY');	
	
			$sPayeeAccount = is_param_post('PAYEE_ACCOUNT');
			$iPaymentID = is_param_post('PAYMENT_ID');
			$dPaymentAmount = is_param_post('PAYMENT_AMOUNT');
			$currency = is_param_post('PAYMENT_UNITS');
			$iPaymentBatch = is_param_post('ORDER_NUM');
			$sPayerAccount = is_param_post('PAYER_ACCOUNT');
			$sTimeStampGMT = is_param_post('TIMESTAMPGMT');
			$sV2Hash2 = is_param_post('V2_HASH2');
			$Now_status = is_param_post('STATUS');

			$V2_HASH2= MD5($iPaymentID.':'. $iPaymentBatch .':'. $sPayeeAccount .':'. $dPaymentAmount .':'. $currency .':'. $sPayerAccount .':'. $Now_status .':'. $sTimeStampGMT .':'. $API_KEY);
			
			if($V2_HASH2 != $sV2Hash2){
				die( 'Invalid control signature' );
			}			
			
			$check_history = intval(is_isset($m_data, 'check_api'));
			$show_error = intval(is_isset($m_data, 'show_error'));
			if($check_history == 1){
				try {
					$class = new EPay( $PAYEE_ACCOUNT, $PAYEE_NAME, $API_KEY );
					$hres = $class->getHistory( $iPaymentBatch, 'prihod' );
					if($hres['error'] == 0){
						$histories = $hres['responce'];
						if(isset($histories[$iPaymentBatch])){
							$h = $histories[$iPaymentBatch];
							$sPayerAccount = trim($h['PAYER']); //счет плательщика
							$sPayeeAccount = trim($h['PAYEE']); //счет получателя
							$dPaymentAmount = trim($h['AMOUNT']); //сумма платежа
							$currency = trim($h['CURRENCY']); //валюта платежа
							$Now_status = trim($h['STATUS']); //статус платежа
						} else {
							die( 'Wrong pay' );
						}
					} else {
						die( 'Error history' );
					}
				}
				catch( Exception $e ) {
					if($show_error){
						die( 'Фатальная ошибка: '.$e->getMessage() );
					} else {
						die( 'Фатальная ошибка');
					}
				}		
			}
			
			if( $sPayeeAccount != $PAYEE_ACCOUNT ){
				die( 'Invalid the seller s account' );
			}		

			if(check_trans_in($this->name, $iPaymentBatch, $iPaymentID)){
				die('Error!');
			}
			
			$id = $iPaymentID;
			$data = get_data_merchant_for_id($id);
				
			$in_sum = $dPaymentAmount;	
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
				
			$pay_purse = is_pay_purse($sPayerAccount, $m_data, $bid_m_id);
				
			$bid_currency = $data['currency'];
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));			
			
			$pending_arr = array('10','60','61','70');
			
			if($bid_status == 'new' or $bid_status == 'coldpay'){
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
									
								if($Now_status == 1){
										
									$params = array(
										'pay_purse' => $pay_purse,
										'sum' => $in_sum,
										'bid_sum' => $bid_sum,
										'bid_corr_sum' => $bid_corr_sum,
										'to_account' => $sPayeeAccount,
										'trans_in' => $iPaymentBatch,
										'currency' => $currency,
										'bid_currency' => $bid_currency,
										'invalid_ctype' => $invalid_ctype,
										'invalid_minsum' => $invalid_minsum,
										'invalid_maxsum' => $invalid_maxsum,
										'invalid_check' => $invalid_check,
										'm_place' => $bid_m_id,
									);
									the_merchant_bid_status('realpay', $id, $params, 0); 
										
								} elseif(in_array($Now_status, $pending_arr)) {
										
									$params = array(
										'pay_purse' => $pay_purse,
										'sum' => $in_sum,
										'bid_sum' => $bid_sum,
										'bid_corr_sum' => $bid_corr_sum,
										'to_account' => $sPayeeAccount,
										'trans_in' => $iPaymentBatch,
										'currency' => $currency,
										'bid_currency' => $bid_currency,
										'invalid_ctype' => $invalid_ctype,
										'invalid_minsum' => $invalid_minsum,
										'invalid_maxsum' => $invalid_maxsum,
										'invalid_check' => $invalid_check,	
										'm_place' => $bid_m_id,
									);
									the_merchant_bid_status('coldpay', $id, $params, 0);
										
								}

								die('Completed');
									
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

new merchant_epay(__FILE__, 'E-Pay');