<?php
/*
title: [en_US:]Perfect Money[:en_US][ru_RU:]Perfect Money[:ru_RU]
description: [en_US:]Perfect Money merchant[:en_US][ru_RU:]мерчант Perfect Money[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_perfectmoney')){
	class merchant_perfectmoney extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'PM_ACCOUNT_ID', 'PM_PHRASE', 'PM_U_ACCOUNT', 
				'PM_E_ACCOUNT', 'PM_G_ACCOUNT', 'PM_B_ACCOUNT', 
				'PM_PAYEE_NAME', 'PM_ALTERNATE_PHRASE',
			);
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_fail', array($this,'myaction_merchant_fail'));
			add_action('myaction_merchant_'. $this->name .'_success', array($this,'myaction_merchant_success'));
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
		}

		function security_list(){
			return array('resulturl','show_error','enableip','check_api','personal_secret');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			$options['private_line'] = array(
				'view' => 'line',
				'colspan' => 2,
			);			
			
			$options['paymethod'] = array(
				'view' => 'select',
				'title' => __('Payment method','pn'),
				'options' => array('0'=>__('All','pn'), '1'=>__('Account','pn'), '2'=>__('E-Voucher','pn'), '3'=>__('SMS','pn'), '4'=>__('Wire','pn')),
				'default' => is_isset($data, 'paymethod'),
				'name' => 'paymethod',
				'work' => 'int',
			);			
			
			$text = '
			<strong>RETURN URL:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
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
				is_deffin($this->m_data,'PM_U_ACCOUNT') 
				or is_deffin($this->m_data,'PM_E_ACCOUNT') 
				or is_deffin($this->m_data,'PM_G_ACCOUNT')
				or is_deffin($this->m_data,'PM_B_ACCOUNT')
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
			$currency = str_replace('GLD','OAU',$currency);
				
			$PAYEE_ACCOUNT = 0;
				
			if($currency == 'USD'){
				$PAYMENT_UNITS = 'USD';
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'PM_U_ACCOUNT');
			} elseif($currency == 'EUR'){
				$PAYMENT_UNITS = 'EUR';
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'PM_E_ACCOUNT');
			} elseif($currency == 'OAU'){
				$PAYMENT_UNITS = 'OAU';
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'PM_G_ACCOUNT');			
			} elseif($currency == 'BTC'){
				$PAYMENT_UNITS = 'BTC';
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'PM_B_ACCOUNT');			
			}		

			$pay_sum = is_sum($pay_sum,2);				
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
			
			$data = get_merch_data($this->name);
			$paymethod = intval(is_isset($data, 'paymethod'));
			$AVAILABLE_PAYMENT_METHODS = 'all';
			if($paymethod == 1){
				$AVAILABLE_PAYMENT_METHODS = 'account';
			} elseif($paymethod == 2){
				$AVAILABLE_PAYMENT_METHODS = 'voucher';
			} elseif($paymethod == 3){
				$AVAILABLE_PAYMENT_METHODS = 'sms';
			} elseif($paymethod == 4){			
				$AVAILABLE_PAYMENT_METHODS = 'wire';
			}
					
			$temp = '
			<form name="MerchantPay" action="https://perfectmoney.is/api/step1.asp" method="post">
				<input name="SUGGESTED_MEMO" type="hidden" value="'. $text_pay .'" />
				<input name="sEmail" type="hidden" value="'. is_email($item->user_email) .'" />
				<input name="PAYMENT_AMOUNT" type="hidden" value="'. $pay_sum .'" />
				<input name="PAYEE_ACCOUNT" type="hidden" value="'. $PAYEE_ACCOUNT .'" />								
									
				<input type="hidden" name="AVAILABLE_PAYMENT_METHODS" value="'. $AVAILABLE_PAYMENT_METHODS .'" />					
				<input type="hidden" name="PAYEE_NAME" value="'. is_deffin($this->m_data,'PM_PAYEE_NAME') .'" />
				<input type="hidden" name="PAYMENT_UNITS" value="'. $PAYMENT_UNITS .'" />
				<input type="hidden" name="PAYMENT_ID" value="'. $item->id .'" />
				<input type="hidden" name="STATUS_URL" value="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) . '?psh=' . get_personal_secret($this->name, $item->id .':'. $pay_sum .':'. $PAYMENT_UNITS) .'" />
				<input type="hidden" name="PAYMENT_URL" value="'. get_merchant_link($this->name.'_success') .'" />
				<input type="hidden" name="PAYMENT_URL_METHOD" value="POST" />
				<input type="hidden" name="NOPAYMENT_URL" value="'. get_merchant_link($this->name.'_fail') .'" />
				<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST" />
				<input type="hidden" name="SUGGESTED_MEMO_NOCHANGE" value="1" />
				<input type="hidden" name="BAGGAGE_FIELDS" value="sEmail" />

				<input type="submit" value="'. __('Make a payment','pn') .'" />
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
	
			$sPayeeAccount = isset( $_POST['PAYEE_ACCOUNT'] ) ? trim( $_POST['PAYEE_ACCOUNT'] ) : null;
			$iPaymentID = isset( $_POST['PAYMENT_ID'] ) ? $_POST['PAYMENT_ID'] : null;
			$dPaymentAmount = isset( $_POST['PAYMENT_AMOUNT'] ) ? trim( $_POST['PAYMENT_AMOUNT'] ) : null;
			$sPaymentUnits = isset( $_POST['PAYMENT_UNITS'] ) ? trim( $_POST['PAYMENT_UNITS'] ) : null;
			$iPaymentBatch = isset( $_POST['PAYMENT_BATCH_NUM'] ) ? trim( $_POST['PAYMENT_BATCH_NUM'] ) : null;
			$sPayerAccount = isset( $_POST['PAYER_ACCOUNT'] ) ? trim( $_POST['PAYER_ACCOUNT'] ) : null;
			$sTimeStampGMT = isset( $_POST['TIMESTAMPGMT'] ) ? trim( $_POST['TIMESTAMPGMT'] ) : null;
			$sV2Hash = isset( $_POST['V2_HASH'] ) ? trim( $_POST['V2_HASH'] ) : null;
			
			if( !in_array( $sPaymentUnits, array( 'USD', 'EUR', 'OAU', 'BTC' ) ) ){
				die( 'Invalid currency of payment' );
			}

			if( $sV2Hash != strtoupper( md5( $iPaymentID.':'.$sPayeeAccount.':'.$dPaymentAmount.':'.$sPaymentUnits.':'.$iPaymentBatch.':'.$sPayerAccount.':'.strtoupper( md5( is_deffin($this->m_data,'PM_ALTERNATE_PHRASE') ) ).':'.$sTimeStampGMT ) ) ){
				die( 'Invalid control signature' );
			}

			$constant = is_deffin($this->m_data,'PM_'.substr( $sPayeeAccount, 0, 1 ).'_ACCOUNT');
			if( $sPayeeAccount != $constant ){
				die( 'Invalid the seller s account' );
			}
			
			if(!check_personal_secret($this->name, $iPaymentID, $dPaymentAmount, $sPaymentUnits)){
				die( 'Invalid control signature' );
			}			
			
			$check_history = intval(is_isset($m_data, 'check_api'));
			$show_error = intval(is_isset($m_data, 'show_error'));
			if($check_history == 1){
				try {
					$class = new PerfectMoney( is_deffin($this->m_data,'PM_ACCOUNT_ID'), is_deffin($this->m_data,'PM_PHRASE') );
					$hres = $class->getHistory( date( 'd.m.Y', strtotime( '-2 day' ) ), date( 'd.m.Y', strtotime( '+2 day' ) ), 'batchid', 'prihod' );
					if($hres['error'] == 0){
						$histories = $hres['responce'];
						if(isset($histories[$iPaymentBatch])){
							$h = $histories[$iPaymentBatch];
							$sPayerAccount = trim($h['sender']); //счет плательщика
							$sPayeeAccount = trim($h['receiver']); //счет получателя
							$dPaymentAmount = trim($h['amount']); //сумма платежа
							$sPaymentUnits = trim($h['currency']); //валюта платежа (USD/EUR/OAU/BTC)
							$iPaymentID = trim($h['payment_id']); //id заявки
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
			$bid_currency = str_replace(array('GLD'),'OAU',$bid_currency);
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
				
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));				
			
			if($bid_status == 'new'){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $sPaymentUnits or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
						
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'bid_corr_sum' => $bid_corr_sum,
									'to_account' => $sPayeeAccount,
									'trans_in' => $iPaymentBatch,
									'currency' => $sPaymentUnits,
									'bid_currency' => $bid_currency,
									'invalid_ctype' => $invalid_ctype,
									'invalid_minsum' => $invalid_minsum,
									'invalid_maxsum' => $invalid_maxsum,
									'invalid_check' => $invalid_check,
									'm_place' => $bid_m_id,
								);
								the_merchant_bid_status('realpay', $id, $params, 0);	 								
			
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

new merchant_perfectmoney(__FILE__, 'Perfect Money');