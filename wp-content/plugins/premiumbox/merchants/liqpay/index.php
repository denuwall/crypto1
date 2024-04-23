<?php
/*
title: [en_US:]LiqPay[:en_US][ru_RU:]LiqPay[:ru_RU]
description: [en_US:]LiqPay merchant[:en_US][ru_RU:]мерчант LiqPay[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_liqpay')){
	class merchant_liqpay extends Merchant_Premiumbox {
		function __construct($file, $title)
		{
			$map = array(
				'LIQPAY_PUBLIC_KEY', 'LIQPAY_PRIVATE_KEY', 
			);			
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_fail', array($this,'myaction_merchant_fail'));
			add_action('myaction_merchant_'. $this->name .'_success', array($this,'myaction_merchant_success'));
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
			add_action('myaction_merchant_'. $this->name .'_cron' . get_hash_result_url($this->name), array($this,'myaction_merchant_cron'));
		}

		function security_list(){
			return array('resulturl','show_error', 'enableip','check_api');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}						
			$options['private_line'] = array(
				'view' => 'line',
				'colspan' => 2,
			);
			$opt = array(
				'0' => __('shop settings','pn'),
				'1' => __('card payment','pn'),
				'2' => __('liqpay account','pn'),
				'3' => __('privat24 account','pn'),
				'4' => __('masterpass account','pn'),
				'5' => __('installments','pn'),
				'6' => __('cash','pn'),
				'7' => __('invoice to e-mail','pn'),
				'8' => __('qr code scanning','pn'),
			);
			$paytype = intval(is_isset($data, 'paytype'));
			$options[] = array(
				'view' => 'select',
				'title' => __('Payment method','pn'),
				'options' => $opt,
				'default' => $paytype,
				'name' => 'paytype',
				'work' => 'int',
			);			
			
			$text = '
			<strong>RETURN URL:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
			<strong>SUCCESS URL:</strong> <a href="'. get_merchant_link($this->name.'_success') .'" target="_blank">'. get_merchant_link($this->name.'_success') .'</a><br />
			<strong>FAIL URL:</strong> <a href="'. get_merchant_link($this->name.'_fail') .'" target="_blank">'. get_merchant_link($this->name.'_fail') .'</a><br />	
			<strong>CRON:</strong> <a href="'. get_merchant_link($this->name.'_cron' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_cron' . get_hash_result_url($this->name)) .'</a>				
			';

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
				is_deffin($this->m_data,'LIQPAY_PUBLIC_KEY') 
				and is_deffin($this->m_data,'LIQPAY_PRIVATE_KEY') 
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

			$params = array(
				'sum' => 0,
				'm_place' => $this->name,
				'system' => 'user',
			);		
			the_merchant_bid_status('techpay', $item->id, $params, 0);	 	
		 
			$currency = pn_strip_input($item->currency_code_give);
					
			$locale = get_locale();
			if($locale == 'ru_RU'){
				$lang = 'ru';
			} else {
				$lang = 'en';
			}			
						
			$pay_sum = is_sum($pay_sum,2);		
			$text_pay = get_text_pay($this->name, $item, $pay_sum);
						
			$LIQPAY_RESULT_URL = get_merchant_link($this->name.'_success');
			$LIQPAY_SERVER_URL = get_merchant_link($this->name.'_status' . get_hash_result_url($this->name));
				
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));	
					
			try {
				$liqpay = new LiqPay(is_deffin($this->m_data,'LIQPAY_PUBLIC_KEY'), is_deffin($this->m_data,'LIQPAY_PRIVATE_KEY'));
				$cnb_form = array(
					'version'        => 3,
					'action'         => 'pay',
					'amount'         => $pay_sum,
					'currency'       => $currency,
					'description'    => $text_pay,
					'order_id'       => $item->id,
					'language'       => $lang,
					'result_url'       => $LIQPAY_RESULT_URL,
					'server_url'       => $LIQPAY_SERVER_URL,
					'public_key' => is_deffin($this->m_data,'LIQPAY_PUBLIC_KEY'),
				);
				
				$paytype = intval(is_isset($m_data, 'paytype'));			
				$opts = array(
					'1' => 'card',
					'2' => 'liqpay',
					'3' => 'privat24',
					'4' => 'masterpass',
					'5' => 'part',
					'6' => 'cash',
					'7' => 'invoice',
					'8' => 'qr',
				);
				$pt = trim(is_isset($opts, $paytype));
				if($pt){
					$cnb_form['paytypes'] = $pt;
				}
				
				$temp = $liqpay->cnb_form($cnb_form);				
			}
			catch( Exception $e ) {
				if($show_error){
					$temp = $e->getMessage();
				}
			}
					
			return $temp;				
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('order_id');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('order_id');
			the_merchant_bid_success($id);
		}

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$def_signature = is_param_req('signature');
			$def_data = is_param_req('data');
	
			if(!$def_signature){
				die( 'bad signature' );
			}
			
			$data = base64_decode($def_data);
			$datap = @json_decode($data, true);
	
			$public_key = is_deffin($this->m_data,'LIQPAY_PUBLIC_KEY');
			$private_key = is_deffin($this->m_data,'LIQPAY_PRIVATE_KEY');

			$signature = base64_encode( sha1( $private_key . $def_data . $private_key, 1 ) );
			if($signature != $def_signature){
				die( 'bad sign in request' );
			}
			
			$order_id = $datap['order_id'];
			$type = $datap['type'];/* buy */
			$action = $datap['action'];/* pay */
			$status = $datap['status'];
			$amount = $datap['amount'];
			$currency = $datap['currency'];
			$transaction_id = $datap['transaction_id'];
			
			$check_history = intval(is_isset($m_data, 'check_api'));
			$show_error = intval(is_isset($m_data, 'show_error'));
			if($check_history == 1){
			
				try {
					$liqpay = new LiqPay($public_key, $private_key);
					$res = $liqpay->api("request", array(
						'action' => 'status',
						'version' => '3',
						'order_id' => $order_id
					));	
					if(isset($res->result) and $res->result == 'ok'){
						$type = $res->type;/* buy */
						$action = $res->action;/* pay */
						$status = $res->status;
						$amount = $res->amount;
						$currency = $res->currency;
						$transaction_id = $res->transaction_id;						
					} else {
						die( 'bad request' );
					}
				}
				catch( Exception $e ) {
					if($show_error){
						die('Фатальная ошибка: '.$e->getMessage());
					} else {
						die('Фатальная ошибка');
					}
				}		
			
			}	

			if($type != 'buy' or $action != 'pay'){
				die( 'bad data' );
			}
			
			if(check_trans_in($this->name, $transaction_id, $order_id)){
				die('Error!');
			}			
			
			$id = $order_id;
			$data = get_data_merchant_for_id($id);
			
			$in_sum = $amount;	
			$in_sum = is_sum($in_sum,2);
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
			
			$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
				
			$bid_currency = $data['currency'];
			$bid_currency = str_replace(array('GLD'),'OAU',$bid_currency);
			
			$bid_sum = is_sum($data['pay_sum'],2);
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));			
			
			if($bid_status == 'new' or $bid_status == 'coldpay'or $bid_status == 'techpay'){ 
				if($bid_err == 0){
					if($bid_m_id and $bid_m_id == $this->name){
						if($bid_currency == $currency or $invalid_ctype == 1){
							if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
						
								if($status == 'success'){
									$now_status = 'realpay';																		
								} elseif($status == 'failure' or $status == 'error' or $status == 'reversed') {
									$now_status = 'error';																		
								} else {	
									$now_status = 'coldpay';								
								}
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'to_account' => $public_key,
									'trans_in' => $transaction_id,
									'currency' => $currency,
									'bid_currency' => $bid_currency,
									'invalid_ctype' => $invalid_ctype,
									'invalid_minsum' => $invalid_minsum,
									'invalid_maxsum' => $invalid_maxsum,
									'invalid_check' => $invalid_check,
									'm_place' => $bid_m_id,
								);
								the_merchant_bid_status($now_status, $id, $params, 0);									
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
		
		function myaction_merchant_cron(){
		global $wpdb;	
			
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));
			
			$m_in = $this->name;
			$public_key = is_deffin($this->m_data,'LIQPAY_PUBLIC_KEY');
			$private_key = is_deffin($this->m_data,'LIQPAY_PRIVATE_KEY');
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status IN('coldpay','techpay') AND m_in='$m_in'");
			foreach($items as $item){
				$order_id = $item->id;
				try {
					$liqpay = new LiqPay($public_key, $private_key);
					$res = $liqpay->api("request", array(
						'action' => 'status',
						'version' => '3',
						'order_id' => $order_id
					));	
					if(isset($res->result, $res->status) and $res->result == 'ok'){ 
					
						$type = $res->type;
						$action = $res->action;
						$amount = $res->amount;
						$currency = $res->currency;
						$transaction_id = $res->transaction_id;
						$status = $res->status;

						$id = $order_id;
						$data = get_data_merchant_for_id($id, $item);
						
						$in_sum = $amount;
						$in_sum = is_sum($in_sum,2);
						$bid_err = $data['err'];
						$bid_m_id = $data['m_id'];
						
						$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
						
						$bid_currency = $data['currency'];
									
						$bid_sum = is_sum($data['pay_sum'],2);
						$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
						
						$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
						$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
						$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
						$invalid_check = intval(is_isset($m_data, 'check'));						
						
						if($bid_err == 0 and $type == 'buy' and $action == 'pay'){
							if($bid_currency == $currency or $invalid_ctype == 1){	
								if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){	
								
									if($status == 'success'){
										$now_status = 'realpay';										
									} elseif($status == 'failure' or $status == 'error' or $status == 'reversed') {
										$now_status = 'error';									
									} else {
										$now_status = 'coldpay';																
									}							
									$params = array(
										'pay_purse' => $pay_purse,
										'sum' => $in_sum,
										'bid_sum' => $bid_sum,
										'bid_corr_sum' => $bid_corr_sum,
										'to_account' => $public_key,
										'trans_in' => $transaction_id,
										'currency' => $currency,
										'bid_currency' => $bid_currency,
										'invalid_ctype' => $invalid_ctype,
										'invalid_minsum' => $invalid_minsum,
										'invalid_maxsum' => $invalid_maxsum,
										'invalid_check' => $invalid_check,
										'system' => 'system',	
										'm_place' => $bid_m_id,
									);
									the_merchant_bid_status($now_status, $id, $params, 0);				
								}
							}
						}	

					} 	
				}
				catch( Exception $e ) {
					if($show_error){
						die($e);
					}	
				}
			}	

			_e('Done','pn');
			exit;
			
		}	
		
	}
}
new merchant_liqpay(__FILE__, 'LiqPay');