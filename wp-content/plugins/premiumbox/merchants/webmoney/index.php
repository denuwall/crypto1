<?php
/*
title: [en_US:]Webmoney[:en_US][ru_RU:]Webmoney[:ru_RU]
description: [en_US:]webmoney merchant[:en_US][ru_RU:]мерчант webmoney[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_webmoney')){
	class merchant_webmoney extends Merchant_Premiumbox{
		
		function __construct($file, $title)
		{
			$map = array(
				'WEBMONEY_WMZ_PURSE', 'WEBMONEY_WMZ_KEY', 
				'WEBMONEY_WMR_PURSE', 'WEBMONEY_WMR_KEY',
				'WEBMONEY_WME_PURSE', 'WEBMONEY_WME_KEY', 
				'WEBMONEY_WMU_PURSE', 'WEBMONEY_WMU_KEY',
				'WEBMONEY_WMB_PURSE', 'WEBMONEY_WMB_KEY', 
				'WEBMONEY_WMY_PURSE', 'WEBMONEY_WMY_KEY',
				'WEBMONEY_WMG_PURSE', 'WEBMONEY_WMG_KEY', 
				'WEBMONEY_WMX_PURSE', 'WEBMONEY_WMX_KEY',
				'WEBMONEY_WMK_PURSE', 'WEBMONEY_WMK_KEY',
				'WEBMONEY_WML_PURSE', 'WEBMONEY_WML_KEY',
				'WEBMONEY_WMH_PURSE', 'WEBMONEY_WMH_KEY',
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
			return array('show_error','enableip');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			$text = '
			<strong>Result URL:</strong> <a href="'. get_merchant_link($this->name.'_status') .'" target="_blank">'. get_merchant_link($this->name.'_status') .'</a><br />
			<strong>Success URL:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a><br />
			<strong>Fail URL:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a>			
			';

			$options['text'] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);

			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}			
			
			return $options;	
		}		
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'WEBMONEY_WMZ_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMZ_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMR_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMR_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WME_PURSE') and is_deffin($this->m_data,'WEBMONEY_WME_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMU_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMU_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMB_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMB_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMY_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMY_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMG_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMG_KEY')
				or is_deffin($this->m_data,'WEBMONEY_WMX_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMX_KEY') 
				or is_deffin($this->m_data,'WEBMONEY_WMK_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMK_KEY')
				or is_deffin($this->m_data,'WEBMONEY_WML_PURSE') and is_deffin($this->m_data,'WEBMONEY_WML_KEY')
				or is_deffin($this->m_data,'WEBMONEY_WMH_PURSE') and is_deffin($this->m_data,'WEBMONEY_WMH_KEY')
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
			$currency = str_replace(array('WMZ'),'USD',$currency);
			$currency = str_replace(array('RUR','WMR'),'RUB',$currency);
			$currency = str_replace(array('WME'),'EUR',$currency);
			$currency = str_replace(array('WMU'),'UAH',$currency);
			$currency = str_replace(array('WMB'),'BYR',$currency);
			$currency = str_replace(array('WMY'),'UZS',$currency);
			$currency = str_replace(array('WMG'),'GLD',$currency);
			$currency = str_replace(array('WMX'),'BTC',$currency);
			$currency = str_replace(array('WMK'),'KZT',$currency);
			$currency = str_replace(array('WML'),'LTC',$currency);
			$currency = str_replace(array('WMH'),'BCH',$currency);
					
			$LMI_PAYEE_PURSE = 0;
					
			if($currency == 'USD'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMZ_PURSE');
			} elseif($currency == 'RUB'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMR_PURSE');
			} elseif($currency == 'EUR'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WME_PURSE');
			} elseif($currency == 'UAH'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMU_PURSE');
			} elseif($currency == 'BYR'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMB_PURSE');
			} elseif($currency == 'UZS'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMY_PURSE');	
			} elseif($currency == 'GLD'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMG_PURSE');
			} elseif($currency == 'BTC'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMX_PURSE');
			} elseif($currency == 'KZT'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMK_PURSE');			
			} elseif($currency == 'LTC'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WML_PURSE');
			} elseif($currency == 'BCH'){
				$LMI_PAYEE_PURSE = is_deffin($this->m_data,'WEBMONEY_WMH_PURSE');				
			}		


			$pay_sum = is_sum($pay_sum,2);		
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
						
			$temp = '
			<form name="MerchantPay" action="https://merchant.webmoney.ru/lmi/payment.asp" method="post" accept-charset="windows-1251">
				<input type="hidden" name="LMI_RESULT_URL" value="'. get_merchant_link($this->name.'_status') .'" />
				<input type="hidden" name="LMI_SUCCESS_URL" value="'. get_merchant_link($this->name.'_success') .'" />
				<input type="hidden" name="LMI_SUCCESS_METHOD" value="POST" />
				<input type="hidden" name="LMI_FAIL_URL" value="'. get_merchant_link($this->name.'_fail') .'" />
				<input type="hidden" name="LMI_FAIL_METHOD" value="POST" />			    
				<input name="LMI_PAYMENT_NO" type="hidden" value="'. $item->id .'" />
				<input name="LMI_PAYMENT_AMOUNT" type="hidden" value="'. $pay_sum .'" />
				<input name="LMI_PAYEE_PURSE" type="hidden" value="'. $LMI_PAYEE_PURSE .'" />
				<input name="LMI_PAYMENT_DESC" type="hidden" value="'. $text_pay .'" />
				<input name="sEmail" type="hidden" value="'. is_email($item->user_email) .'" />				

				<input type="submit" value="Pay" />
			</form>			
			';				
			
			return $temp;
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('LMI_PAYMENT_NO');
			the_merchant_bid_delete($id);	
		}

		function myaction_merchant_success(){	
			$id = get_payment_id('LMI_PAYMENT_NO');
			the_merchant_bid_success($id);	
		}

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$dPaymentAmount = trim(is_param_post('LMI_PAYMENT_AMOUNT'));
			$iPaymentID = trim(is_param_post('LMI_PAYMENT_NO'));
			$bPaymentMode = trim(is_param_post('LMI_MODE'));
			$iPayerWMID = trim(is_param_post('LMI_PAYER_WM'));
			$sPayerPurse = trim(is_param_post('LMI_PAYER_PURSE'));
			$sEmail = trim(is_param_post('sEmail'));

			if( $bPaymentMode != 0 ) {
				die( 'Payments are not permitted in test mode' );
			}

			if( isset( $_POST['LMI_PREREQUEST'] ) ){
				die( 'YES' );
			}

			$iSysInvsID = trim(is_param_post('LMI_SYS_INVS_NO'));
			$iSysTransID = trim(is_param_post('LMI_SYS_TRANS_NO'));
			$sSignature = trim(is_param_post('LMI_HASH'));
			$sSysTransDate = trim(is_param_post('LMI_SYS_TRANS_DATE'));

			if(!$sPayerPurse){
				die('Purse empty');
			}
	
			$constant = is_deffin($this->m_data,'WEBMONEY_WM'. substr( $sPayerPurse, 0, 1 ) .'_PURSE');
			$constant2 = is_deffin($this->m_data,'WEBMONEY_WM'. substr( $sPayerPurse, 0, 1 ) .'_KEY');
	
			if( $sSignature != strtoupper( hash( 'sha256', implode(  '', array( $constant, $dPaymentAmount, $iPaymentID, $bPaymentMode, $iSysInvsID, $iSysTransID, $sSysTransDate, $constant2, $sPayerPurse, $iPayerWMID ) ) ) ) ) {
				die( 'Invalid control signature' );
			}

			// $iPaymentID - номер заказа
			// $dPaymentAmount - сумма платежа
			// $iPayerWMID - WMID плательщика
			// $sPayerPurse - кошелек плательщика
			// $sEmail - E-mail адрес плательщика
			// $iSysInvsID - уникальный номер счета
			// $iSysTransID - уникальный номер транзакции
	
			if(check_trans_in($this->name, $iSysTransID, $iPaymentID)){
				die('Error!');
			}	
	
			$id = $iPaymentID;
			$data = get_data_merchant_for_id($id);
			
			$in_sum = $dPaymentAmount;	
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
			
			$pay_purse = is_pay_purse($sPayerPurse, $m_data, $bid_m_id);
			
			$bid_currency = $data['currency'];
			$bid_currency = str_replace(array('WMZ','USD'),'Z',$bid_currency);
			$bid_currency = str_replace(array('RUR','WMR','RUB'),'R',$bid_currency);
			$bid_currency = str_replace(array('WME','EUR'),'E',$bid_currency);
			$bid_currency = str_replace(array('WMU','UAH'),'U',$bid_currency);
			$bid_currency = str_replace(array('WMB','BYR'),'B',$bid_currency);
			$bid_currency = str_replace(array('WMY','UZS'),'Y',$bid_currency);
			$bid_currency = str_replace(array('WMG','GLD'),'G',$bid_currency);
			$bid_currency = str_replace(array('WMX','BTC'),'X',$bid_currency);
			$bid_currency = str_replace(array('WMK','KZT'),'K',$bid_currency);	
			$bid_currency = str_replace(array('WML','LTC'),'L',$bid_currency);	
			$bid_currency = str_replace(array('WMH','BCH'),'H',$bid_currency);	
	
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
	
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));	
	
			$fl = substr($sPayerPurse, 0, 1 );
	
			if($bid_status == 'new'){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $fl or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
					
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'bid_corr_sum' => $bid_corr_sum,
									'to_account' => $constant,
									'trans_in' => $iSysTransID,
									'currency' => $fl,
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

new merchant_webmoney(__FILE__, 'Webmoney');