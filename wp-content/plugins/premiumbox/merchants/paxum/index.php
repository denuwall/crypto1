<?php
/*
title: [en_US:]Paxum[:en_US][ru_RU:]Paxum[:ru_RU]
description: [en_US:]Paxum merchant[:en_US][ru_RU:]мерчант Paxum[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_paxum')){
	class merchant_paxum extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			
			$map = array(
				'PAXUM_EMAIL', 'PAXUM_SECRET', 
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
			<strong>RESULT URL:</strong> <a href="'. get_merchant_link($this->name.'_status') .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a>			
			';
			$options[] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			
			return $options;	
		}			
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'PAXUM_SECRET') 
				and is_deffin($this->m_data,'PAXUM_EMAIL') 
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
				<form name="changer_form" action="https://www.paxum.com/payment/phrame.php?action=displayProcessPaymentLogin" target="_blank" method="post">
					<input type="hidden" name="business_email" value="'. is_deffin($this->m_data,'PAXUM_EMAIL') .'" />
					<input type="hidden" name="button_type_id" value="1" />
					<input type="hidden" name="item_id" value="'. $item->id .'" />
					<input type="hidden" name="item_name" value="'. $text_pay .'" />
					<input type="hidden" name="amount" value="'. $pay_sum .'" />
					<input type="hidden" name="currency" value="'. $currency .'" />
					<input type="hidden" name="ask_shipping" value="1" />
					<input type="hidden" name="cancel_url" value="'. get_merchant_link($this->name.'_fail') .'" />
					<input type="hidden" name="finish_url" value="'. get_merchant_link($this->name.'_success') .'" />
					<input type="hidden" name="variables" value="notify_url='. get_merchant_link($this->name.'_status') .'" />
					<input type="submit" value="'. __('Make a payment','pn') .'" />
				</form>													
				';				

			return $temp;		
		}

		function myaction_merchant_fail(){	
			$id = get_payment_id('transaction_item_id');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){	
			$id = get_payment_id('transaction_item_id');
			the_merchant_bid_success($id);	
		}

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			if(!isset($_POST['transaction_item_id']) or !isset($_POST['key'])){
				die( 'No id' );
			}		
			
			$rawPostedData = file_get_contents('php://input');

			$i = strpos($rawPostedData, "&key=");
			$fieldValuePairsData = substr($rawPostedData, 0, $i);

			$calculatedKey = md5($fieldValuePairsData . is_deffin($this->m_data,'PAXUM_SECRET'));

			$isValid = $_POST["key"] == $calculatedKey ? true : false;

			if(!$isValid)
			{
				die("This is not a valid notification message");
			}

			/*
			$_POST['transaction_item_id'] - номер заказа который прописывался в $OrderID в index.php
			$_POST['transaction_amount'] - сумма прихода 
			$_POST['transaction_currency'] - валюта прихода (USD,EUR..)
			$_POST['transaction_status'] - если все ок то вернет done.
			*/
			$currency = is_param_post('transaction_currency');
			
			$id = is_param_post('transaction_item_id');
			$data = get_data_merchant_for_id($id);
			
			$in_sum = is_param_post('transaction_amount');
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];			
			
			$transaction_status = is_param_post('transaction_status');
			
			$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
			
			$bid_currency = $data['currency'];
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));			
			
			if($bid_status == 'new'){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name and $transaction_status == 'done'){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
					
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'bid_corr_sum' => $bid_corr_sum,
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

new merchant_paxum(__FILE__, 'Paxum');