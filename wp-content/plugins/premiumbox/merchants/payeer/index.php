<?php
/*
title: [en_US:]Payeer[:en_US][ru_RU:]Payeer[:ru_RU]
description: [en_US:]Payeer merchant[:en_US][ru_RU:]мерчант Payeer[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_payeer')){
	class merchant_payeer extends Merchant_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'PAYEER_SEKRET_KEY', 'PAYEER_SHOP_ID', 
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

		public function security_list(){
			return array('resulturl','show_error','enableip');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}		
			
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
				is_deffin($this->m_data,'PAYEER_SHOP_ID') 
				and is_deffin($this->m_data,'PAYEER_SEKRET_KEY') 
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
					
			$m_desc = base64_encode($text_pay);
			$m_amount = number_format($pay_sum, 2, '.', '');
			$arHash = array(
				is_deffin($this->m_data,'PAYEER_SHOP_ID'),
				$item->id,
				$m_amount,
				$currency,
				$m_desc,
				is_deffin($this->m_data,'PAYEER_SEKRET_KEY')
			);
			$sign = strtoupper(hash('sha256', implode(":", $arHash)));
					
			$temp = '
			<form method="GET" action="//payeer.com/api/merchant/m.php" target="_blank">
				<input type="hidden" name="m_shop" value="'. is_deffin($this->m_data,'PAYEER_SHOP_ID') .'">
				<input type="hidden" name="m_orderid" value="'. $item->id .'">
				<input type="hidden" name="m_amount" value="'. $pay_sum .'">
				<input type="hidden" name="m_curr" value="'. $currency .'">
				<input type="hidden" name="m_desc" value="'. $m_desc .'">
				<input type="hidden" name="m_sign" value="'. $sign .'">
				<input type="submit" value="'. __('Make a payment','pn') .'" />
			</form>												
			';				
		
			return $temp;		
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('m_orderid');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('m_orderid');
			the_merchant_bid_success($id);
		}

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"])){

				$m_key = is_deffin($this->m_data,'PAYEER_SEKRET_KEY');
				$arHash = array($_POST['m_operation_id'],
						$_POST['m_operation_ps'],
						$_POST['m_operation_date'],
						$_POST['m_operation_pay_date'],
						$_POST['m_shop'],
						$_POST['m_orderid'],
						$_POST['m_amount'],
						$_POST['m_curr'],
						$_POST['m_desc'],
						$_POST['m_status'],
						$m_key);
						
				$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
				if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success"){			

					if(check_trans_in($this->name, $_POST['m_operation_id'], $_POST['m_orderid'])){
						echo $_POST['m_orderid']."|error";
						exit;
					}				
				
					$currency = $_POST['m_curr'];
				
					$id = $_POST['m_orderid'];
					$data = get_data_merchant_for_id($id);
					
					$in_sum = $_POST['m_amount'];
					$in_sum = is_sum($in_sum,2);
					$bid_err = $data['err'];
					$bid_status = $data['status'];
					$bid_m_id = $data['m_id'];
					
					$pay_purse = is_pay_purse($_POST['client_account'], $m_data, $bid_m_id);
					
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
											'to_account' => is_deffin($this->m_data,'PAYEER_SHOP_ID'),
											'trans_in' => $_POST['m_operation_id'],
											'currency' => $currency,
											'bid_currency' => $bid_currency,
											'invalid_ctype' => $invalid_ctype,
											'invalid_minsum' => $invalid_minsum,
											'invalid_maxsum' => $invalid_maxsum,
											'invalid_check' => $invalid_check,
											'm_place' => $bid_m_id,
										);
										the_merchant_bid_status('realpay', $id, $params, 0);	 						
										 
										echo $_POST['m_orderid']."|success";
										exit;
									} 
								} 
							} 
						} 
					} 
				
				}
				
				echo $_POST['m_orderid']."|error";
				exit;
			}				
		}
		
	}
}

new merchant_payeer(__FILE__, 'Payeer');