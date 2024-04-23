<?php
/*
title: [en_US:]Paypal[:en_US][ru_RU:]Paypal[:ru_RU]
description: [en_US:]Paypal merchant[:en_US][ru_RU:]мерчант Paypal[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_paypal')){
	class merchant_paypal extends Merchant_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'PAYPAL_BUSINESS_ACCOUNT', 
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
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
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}			
			
			$text = '
			<strong>Status URL:</strong> <a href="'. get_merchant_link($this->name.'_status') .'" target="_blank">'. get_merchant_link($this->name.'_status') .'</a><br />
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
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'PAYPAL_BUSINESS_ACCOUNT')  
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
					
			$temp = '
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="notify_url" value="'. get_merchant_link($this->name.'_status') .'" />
				<input type="hidden" name="currency_code" value="'. $currency .'" />
				<input type="hidden" name="business" value="'. is_deffin($this->m_data,'PAYPAL_BUSINESS_ACCOUNT') .'" />
				<input type="hidden" name="return" value="'. get_merchant_link($this->name.'_success') .'" />
				<input type="hidden" name="rm" value="0" />
				<input type="hidden" name="cancel_return" value="'. get_merchant_link($this->name.'_fail') .'" />
				<input type="hidden" name="charset" value="UTF-8" />
				<input type="hidden" name="item_number" value="'. $item->id .'" />
				<input type="hidden" name="item_name" value="'. $text_pay .'" />
				<input type="hidden" name="amount" value="'. $pay_sum .'" />
				<input type="submit" value="'. __('Make a payment','pn') .'" />
			</form>													
			';				
		
			return $temp;				
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('item_number');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('item_number');
			the_merchant_bid_success($id);
		}

		function myaction_merchant_status(){
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);

			if(isset($_POST["ipn_track_id"], $_POST["item_number"], $_POST["mc_gross"]) and is_numeric($_POST["mc_gross"]) and $_POST["mc_gross"] > 0){

				$aResponse = array();

				foreach($_POST as $sKey => $sValue){
					if(get_magic_quotes_gpc()){
						$sKey = stripslashes($sKey);
						$sValue = stripslashes($sValue);
					}

					$aResponse[] = $sKey . "=" . $sValue;
					$aResponseUrl[] = $sKey . "=" . urlencode($sValue);
				}

				$c_options = array(
					CURLOPT_HEADER => 0,
					CURLOPT_POST => 1,
					CURLOPT_POSTFIELDS => "cmd=_notify-validate&" . implode("&", $aResponseUrl),
					CURLOPT_SSL_VERIFYHOST => 1,
				);
				$result = get_curl_parser("https://www.paypal.com/cgi-bin/webscr", $c_options, 'merchant', 'paypal');
				$sResponse = $result['output'];

				if($sResponse == "VERIFIED"){
					
					if(check_trans_in($this->name, $_POST["ipn_track_id"], $_POST["item_number"])){
						die('Error!');
					}					
					
					$id = $_POST["item_number"];
					$data = get_data_merchant_for_id($id);
					
					$in_sum = $_POST["mc_gross"];
					$in_sum = is_sum($in_sum,2);
					$bid_err = $data['err'];
					$bid_status = $data['status'];
					$bid_m_id = $data['m_id'];
					
					$currency = $_POST["mc_currency"];
					
					$payer_purse = $_POST["payer_email"];					
					$pay_purse = is_pay_purse($payer_purse, $m_data, $bid_m_id);
					
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
									if($in_sum >= $bid_sum or $invalid_minsum == 1){		
							
										$params = array(
											'pay_purse' => $pay_purse,
											'sum' => $in_sum,
											'bid_sum' => $bid_sum,
											'bid_corr_sum' => $bid_corr_sum,
											'to_account' => is_deffin($this->m_data,'PAYPAL_BUSINESS_ACCOUNT'),
											'trans_in' => $_POST["ipn_track_id"],
											'currency' => $currency,
											'bid_currency' => $bid_currency,
											'invalid_ctype' => $invalid_ctype,
											'invalid_minsum' => $invalid_minsum,
											'invalid_maxsum' => $invalid_maxsum,
											'invalid_check' => $invalid_check,
											'm_place' => $bid_m_id,
										);
										the_merchant_bid_status('realpay', $id, $params, 0); 							
													 
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
	}
}

new merchant_paypal(__FILE__, 'Paypal');