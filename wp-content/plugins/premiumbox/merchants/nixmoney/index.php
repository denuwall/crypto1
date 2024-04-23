<?php
/*
title: [en_US:]Nixmoney[:en_US][ru_RU:]Nixmoney[:ru_RU]
description: [en_US:]Nixmoney merchant[:en_US][ru_RU:]мерчант Nixmoney[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_nixmoney')){
	class merchant_nixmoney extends Merchant_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'NIXMONEY_PASSWORD', 'NIXMONEY_ACCOUNT',
				'NIXMONEY_USD', 'NIXMONEY_EUR', 
				'NIXMONEY_BTC', 'NIXMONEY_LTC', 'NIXMONEY_PPC', 
				'NIXMONEY_FTC','NIXMONEY_CRT', 'NIXMONEY_GBC','NIXMONEY_DOGE',
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
		
		function get_merchant_admin_options($options, $data){ 
			
			$text = '
			<strong>FAIL url:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a><br />
			<strong>STATUS url:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
			<strong>SUCCESS url:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a>
			';

			$noptions = array();
			foreach($options as $key => $val){
				if($key == 'bottom_title'){
					$noptions['text'] = array(
						'view' => 'textfield',
						'title' => '',
						'default' => $text,
					);					
				}
				$noptions[$key] = $val;
			}				
			
			return $noptions;	
		}		

		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'NIXMONEY_PASSWORD') 
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
			
			$PAYEE_ACCOUNT = 0;
					
			if($currency == 'USD'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_USD');
			} elseif($currency == 'EUR'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_EUR');
			} elseif($currency == 'BTC'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_BTC');
			} elseif($currency == 'LTC'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_LTC');
			} elseif($currency == 'PPC'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_PPC');
			} elseif($currency == 'FTC'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_FTC');	
			} elseif($currency == 'CRT'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_CRT');	
			} elseif($currency == 'GBC'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_GBC');
			} elseif($currency == 'DOGE'){
				$PAYEE_ACCOUNT = is_deffin($this->m_data,'NIXMONEY_DOGE');					
			}		
				
			$pay_sum = is_sum($pay_sum,2);				
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
						
			$temp = '
			<form action="https://nixmoney.com/merchant.jsp" method="post" target="_blank">
				<input type="hidden" name="PAYEE_ACCOUNT" value="'. $PAYEE_ACCOUNT .'" />
				<input type="hidden" name="PAYEE_NAME" value="'. $text_pay .'" />
				<input type="hidden" name="PAYMENT_AMOUNT" value="'. $pay_sum .'" />
				<input type="hidden" name="PAYMENT_URL" value="'. get_merchant_link($this->name.'_success') .'" />
				<input type="hidden" name="NOPAYMENT_URL" value="'. get_merchant_link($this->name.'_fail') .'" />
				<input type="hidden" name="BAGGAGE_FIELDS" value="PAYMENT_ID" />
				<input type="hidden" name="PAYMENT_ID" value="'. $item->id .'" />
				<input type="hidden" name="STATUS_URL" value="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) . '?psh=' . get_personal_secret($this->name, $item->id .':'. $pay_sum .':'. $currency) .'" />
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
	
			if(!isset($_POST['PAYMENT_ID'])){
				die('no id');
			}
			if(!isset($_POST['V2_HASH'])){
				die('no hash');
			}

			$string= $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.$_POST['PAYMENT_BATCH_NUM'].':'.$_POST['PAYER_ACCOUNT'].':'.strtoupper(md5(is_deffin($this->m_data,'NIXMONEY_PASSWORD'))).':'.$_POST['TIMESTAMPGMT'];
			 
			$v2key = $_POST['V2_HASH'];
			$hash=strtoupper(md5($string));
		  
			if($hash != $v2key){
				die( 'Invalid control signature' );
			}

			if(!check_personal_secret($this->name, $_POST['PAYMENT_ID'], $_POST['PAYMENT_AMOUNT'], $_POST['PAYMENT_UNITS'])){
				die( 'Invalid control signature' );
			}			
				
			$iPaymentBatch = $_POST['PAYMENT_BATCH_NUM'];
			$iPaymentID = $_POST['PAYMENT_ID'];
			$dPaymentAmount = $_POST['PAYMENT_AMOUNT'];
			$sPayerAccount = $_POST['PAYER_ACCOUNT'];
			$currency = strtoupper($_POST['PAYMENT_UNITS']);
			$sPayeeAccount = $_POST['PAYEE_ACCOUNT'];
				
			$check_history = intval(is_isset($m_data, 'check_api'));
			$show_error = intval(is_isset($m_data, 'show_error'));
			if($check_history == 1){
				
				try {
					$class = new NixMoney( is_deffin($this->m_data,'NIXMONEY_ACCOUNT'), is_deffin($this->m_data,'NIXMONEY_PASSWORD') );
					$hres = $class->getHistory( date( 'd.m.Y', strtotime( '-2 day' ) ), date( 'd.m.Y', strtotime( '+2 day' ) ), 'batchid', 'prihod' );
					if($hres['error'] == 0){
						$histories = $hres['responce'];
						if(isset($histories[$iPaymentBatch])){
							$h = $histories[$iPaymentBatch];
							$sPayerAccount = trim($h['sender']); //счет плательщика
							$sPayeeAccount = trim($h['receiver']); //счет получателя
							$dPaymentAmount = trim($h['amount']); //сумма платежа
							$currency = trim($h['currency']); //валюта платежа (USD/EUR/OAU)	
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
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
				
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));				
			
			if($bid_status == 'new'){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
					
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
		
								die( 'ok' );
								
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

new merchant_nixmoney(__FILE__, 'Nixmoney');