<?php
/*
title: [en_US:]Privat24[:en_US][ru_RU:]Privat24[:ru_RU]
description: [en_US:]Privat24 merchant[:en_US][ru_RU:]мерчант Privat24[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_privat')){
	class merchant_privat extends Merchant_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'PRIVAT24_MERCHANT_ID_UAH', 'PRIVAT24_MERCHANT_KEY_UAH', 
				'PRIVAT24_MERCHANT_ID_USD', 'PRIVAT24_MERCHANT_KEY_USD', 
				'PRIVAT24_MERCHANT_ID_EUR', 'PRIVAT24_MERCHANT_KEY_EUR', 
			);
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_return', array($this,'myaction_merchant_return'));
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
		}

		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			$text = '
			<strong>CRON:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a>			
			';

			if(isset($options['check_api'])){
				unset($options['check_api']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}
			if(isset($options['enableip'])){
				unset($options['enableip']);
			}			
			
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
				is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_UAH') and is_deffin($this->m_data,'PRIVAT24_MERCHANT_KEY_UAH') 
				or is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_USD') and is_deffin($this->m_data,'PRIVAT24_MERCHANT_KEY_USD') 
				or is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_EUR') and is_deffin($this->m_data,'PRIVAT24_MERCHANT_KEY_EUR') 
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
				
			$merchant = 0;
			if($currency == 'UAH'){
				$merchant = is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_UAH');
			} elseif($currency == 'USD'){
				$merchant = is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_USD');
			} elseif($currency == 'EUR'){
				$merchant = is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_EUR');
			}		
					
			$pay_sum = is_sum($pay_sum,2);		
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
					
			$params = array(
				'sum' => 0,
				'm_place' => $this->name,
				'system' => 'user',
			);
			the_merchant_bid_status('techpay', $item->id, $params, 0); 								
					 
			$temp = '
			<form name="pay" action="https://api.privatbank.ua/p24api/ishop" method="post" target="_blank">
											
				<input type="hidden" name="merchant" value="'. $merchant .'" />
				<input type="hidden" name="pay_way" value="privat24" />
				<input type="hidden" name="server_url" value="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" />
				<input type="hidden" name="return_url" value="'. get_merchant_link($this->name.'_return') .'" />
				<input name="order" type="hidden" value="'. $item->id .'" />
				<input name="amt" type="hidden" value="'. $pay_sum .'" />
				<input name="ccy" type="hidden" value="'. $currency .'" />
				<input name="details" type="hidden" value="'. $text_pay .'" />
				<input name="ext_details" type="hidden" value="'. is_email($item->user_email) .'" />

				<input type="submit" value="'. __('Make a payment','pn') .'" />
			</form>												
			';					
		
			return $temp;					
		}

		function myaction_merchant_return(){
	
			$payment = urldecode(is_param_post('payment'));
			parse_str($payment,$arr);
			
			$order_id = intval(is_isset($arr,'order'));
			$state = is_isset($arr,'state');

			if($state == 'ok'){
				the_merchant_bid_success($order_id);
			} else {	
				the_merchant_bid_delete($order_id);
			}			
	
		}

		function myaction_merchant_status(){
		global $wpdb;
			
			$m_in = $this->name;
			
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));
			
			$en_currency = array('USD', 'EUR', 'UAH');
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status IN('coldpay','techpay') AND m_in='$m_in'");
			foreach($items as $item){
				
				$currency = mb_strtoupper($item->currency_code_give);
				if(in_array($currency, $en_currency)){
				
					$merchant_id = is_deffin($this->m_data,'PRIVAT24_MERCHANT_ID_' . $currency);
					$merchant_key = is_deffin($this->m_data,'PRIVAT24_MERCHANT_KEY_' . $currency);
					if($merchant_id and $merchant_key){
						try {
							$oClass = new PrivatBank($merchant_id,$merchant_key);
							$res = $oClass->get_order($item->id);
							if(isset($res['state']) and $res['state'] == 'ok'){
								$currency = $res['ccy'];
								
								$id = $res['order'];
								$data = get_data_merchant_for_id($id, $item);
								
								$in_sum = $res['amt'];
								$in_sum = is_sum($in_sum,2);
								$err = $data['err'];
								$status = $data['status'];
								$m_id = $data['m_id'];
								
								$pay_purse = is_pay_purse('', $m_data, $m_id);
								
								$bid_currency = $data['currency'];
								
								$bid_sum = is_sum($data['pay_sum'],2);
								$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $m_in);
								
								$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
								$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
								$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
								$invalid_check = intval(is_isset($m_data, 'check'));								
								
								if($err == 0 and $m_id and $m_id == $m_in){
									if($bid_currency == $currency or $invalid_ctype == 1){
										if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){	
											$params = array(
												'pay_purse' => $pay_purse,
												'sum' => $in_sum,
												'bid_sum' => $bid_sum,
												'bid_corr_sum' => $bid_corr_sum,
												'to_account' => $merchant_id,
												'trans_in' => is_isset($res,'payment_id'),
												'currency' => $currency,
												'bid_currency' => $bid_currency,
												'invalid_ctype' => $invalid_ctype,
												'invalid_minsum' => $invalid_minsum,
												'invalid_maxsum' => $invalid_maxsum,
												'invalid_check' => $invalid_check,
												'm_place' => $m_id,
											);
											the_merchant_bid_status('realpay', $id, $params, 0);											
										}		
									}
								}	
							}
						}
						catch( Exception $e ) {
							if($show_error){
								echo $e;
							}
						}
					} 
				}
			}			
		}
		
	}
}

new merchant_privat(__FILE__, 'Privat24');