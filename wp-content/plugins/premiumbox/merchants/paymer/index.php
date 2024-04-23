<?php
/*
title: [en_US:]Paymer[:en_US][ru_RU:]Paymer[:ru_RU]
description: [en_US:]Paymer merchant[:en_US][ru_RU:]мерчант Paymer[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_paymer')){
	class merchant_paymer extends Merchant_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'PAYMER_MERCHANT_ID', 'PAYMER_SECRET_KEY',
				'PAYMER_LOGIN','PAYMER_PASSWORD','PAYMER_WMZ_PURSE','PAYMER_WMR_PURSE','PAYMER_WME_PURSE',
				'PAYMER_WMU_PURSE','PAYMER_WMB_PURSE','PAYMER_WMY_PURSE','PAYMER_WMG_PURSE',
				'PAYMER_WMX_PURSE','PAYMER_WMK_PURSE',				
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
			return array('resulturl','enableip');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			$options['private_line'] = array(
				'view' => 'line',
				'colspan' => 2,
			);			
			
			$options['redeem'] = array(
				'view' => 'select',
				'title' => __('Automatic redemption','pn'),
				'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
				'default' => is_isset($data, 'redeem'),
				'name' => 'redeem',
				'work' => 'int',
			);			
			
			$text = '
			<strong>RETURN URL:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
			<strong>SUCCESS URL:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a><br />
			<strong>FAIL URL:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a>			
			';
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}
			if(isset($options['show_error'])){
				unset($options['show_error']);
			}			
			$options[] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);					
			
			return $options;	
		}				
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'PAYMER_MERCHANT_ID') 
				and is_deffin($this->m_data,'PAYMER_SECRET_KEY') 
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
			$currency = str_replace('USD','WMZ',$currency);
			$currency = str_replace(array('RUR','RUB'),'WMR',$currency);
			$currency = str_replace('EUR','WME',$currency);
			$currency = str_replace('UAH','WMU',$currency);
			
			$pay_sum = is_sum($pay_sum,2);					
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
					
			$temp = '
			<form action="https://www.paymer.com/merchant/pay/merchant.aspx?lang=ru-RU" method="post" target="_blank">
				<input name="PM_PAYMERCH_ID" type="hidden" value="'. is_deffin($this->m_data,'PAYMER_MERCHANT_ID') .'" />
				<input name="PM_PAYMENT_NO" type="hidden" value="'. $item->id .'" />
				<input name="PM_PAYMENT_AMOUNT" type="hidden" value="'. $pay_sum .'" />
				<input name="PM_PAYMENT_ATYPE" type="hidden" value="'. $currency .'" />
				<input name="PM_PAYMENT_DESC" type="hidden" value="'. $text_pay .'"  />
				<input type="submit" value="'. __('Make a payment','pn') .'" />
			</form>													
			';				
		
			return $temp;				
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('PM_PAYMENT_NO');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('PM_PAYMENT_NO');
			the_merchant_bid_success($id);
		}

		function redeem_request($vtype, $trans_id){
			$reply = 0;
			$post_data = array();
			$post_data['PMS_LOGIN'] = is_deffin($this->m_data,'PAYMER_LOGIN');
			$post_data['PMS_PASSWORD'] = is_deffin($this->m_data,'PAYMER_PASSWORD');
			$post_data['PMS_TRANS_NO'] = $trans_id;
			$post_data['PMS_PURSE'] = is_deffin($this->m_data,'PAYMER_'. $vtype .'_PURSE');
			
			$c_options = array(
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $post_data,
			);
			$result = get_curl_parser('https://www.paymer.com/merchant/pay/redeem.aspx', $c_options, 'merchant', 'paymer');
			
			$err  = $result['err'];
			$out = $result['output'];
			if(!$err){
				if(strstr($out,'<pms.response>')){
					$object = @simplexml_load_string($out);
					if(is_object($object) and isset($object->error)){
						$error = intval($object->error);
						if($error < 1){
							$reply = 1;
						}
					}
				}
			} 		
				return $reply;
		}
		
		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$iOrderID = isset( $_POST['PM_PAYMENT_NO'] ) ? $_POST['PM_PAYMENT_NO'] - 0 : 0;
			$iMerchantID = isset( $_POST['PM_PAYMERCH_ID'] ) ? $_POST['PM_PAYMERCH_ID'] - 0 : 0;
			$currency = isset( $_POST['PM_PAYMENT_ATYPE'] ) ? $_POST['PM_PAYMENT_ATYPE'] : null;
			$dAmount = isset( $_POST['PM_PAYMENT_AMOUNT'] ) ? $_POST['PM_PAYMENT_AMOUNT'] : 0;
			$iTestMode = isset( $_POST['PM_PAYTEST_MODE'] ) ? $_POST['PM_PAYTEST_MODE'] - 0 : 0;
			$iTransNo = isset( $_POST['PM_PAYSYS_TRANS_NO'] ) ? $_POST['PM_PAYSYS_TRANS_NO'] - 0 : 0;
			$sTransDate = isset( $_POST['PM_PAYSYS_TRANS_DATE'] ) ? $_POST['PM_PAYSYS_TRANS_DATE'] : null;
			$sSignature = isset( $_POST['PM_PAYHASH'] ) ? $_POST['PM_PAYHASH'] : null;

			if( $iMerchantID != is_deffin($this->m_data,'PAYMER_MERCHANT_ID') ){
				die( 'bad merchant id' );
			}

			if( $iTestMode != 0 ){
				die( 'bad test mode' );
			}

			if( $sSignature != strtoupper( md5( $iMerchantID.$dAmount.$currency.$iOrderID.$iTestMode.$iTransNo.$sTransDate. is_deffin($this->m_data,'PAYMER_SECRET_KEY') ) ) ){
				die( 'bad signature' );
			}

			// $iOrderID - № заказа
			// $dAmount - сумма
			// $currency - валюта
			// $iTransNo - уникальный № транзакции

			if(check_trans_in($this->name, $iTransNo, $iOrderID)){
				die('Error!');
			}			
			
			$id = $iOrderID;
			$data = get_data_merchant_for_id($id);
			
			$in_sum = $dAmount;
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
			
			$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
			
			$bid_currency = $data['currency'];
			$bid_currency = str_replace('USD','WMZ',$bid_currency);
			$bid_currency = str_replace(array('RUR','RUB'),'WMR',$bid_currency);
			$bid_currency = str_replace('EUR','WME',$bid_currency);
			$bid_currency = str_replace('UAH','WMU',$bid_currency);		
			
			$to_account = is_deffin($this->m_data,'PAYMER_'. $bid_currency .'_PURSE');
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));			
			
			$en_status = array('new','techpay','coldpay');
			if(in_array($bid_status, $en_status)){  
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		

								$now_status = 'coldpay';							
								 
								$redeem = intval(is_isset($m_data, 'redeem'));
								if($redeem == 1){
									$redeem_res = $this->redeem_request($bid_currency, $iTransNo);
									if($redeem_res == 1){
										$now_status = 'realpay';										
									}
								}
								
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'bid_corr_sum' => $bid_corr_sum,
									'to_account' => $to_account,
									'trans_in' => $iTransNo,
									'currency' => $currency,
									'bid_currency' => $bid_currency,
									'invalid_ctype' => $invalid_ctype,
									'invalid_minsum' => $invalid_minsum,
									'invalid_maxsum' => $invalid_maxsum,
									'invalid_check' => $invalid_check,
									'm_place' => $bid_m_id,			
								);
								the_merchant_bid_status($now_status, $id, $params, 0); 								
								
											
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

new merchant_paymer(__FILE__, 'Paymer');