<?php
/*
title: [en_US:]PayKassa[:en_US][ru_RU:]PayKassa[:ru_RU]
description: [en_US:]PayKassa merchant[:en_US][ru_RU:]мерчант PayKassa[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_paykassa')){
	class merchant_paykassa extends Merchant_Premiumbox {
		function __construct($file, $title)
		{
			$map = array(
				'SHOP_ID', 'SHOP_PASS',
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'. $this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchant_bidform_'.$this->name, array($this,'merchant_bidform'),99,4);
			add_action('myaction_merchant_'. $this->name .'_fail', array($this,'myaction_merchant_fail'));
			add_action('myaction_merchant_'. $this->name .'_success', array($this,'myaction_merchant_success'));
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
		}
		
		function merchants_settingtext($text){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'SHOP_ID') 
				and is_deffin($this->m_data,'SHOP_PASS') 
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

		function security_list(){
			return array('resulturl','show_error', 'enableip');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			
			$paymethods = array(
				'1' => 'payeer',
				'2' => 'perfectmoney',
				'4' => 'advcash',
				'11' => 'bitcoin',
				'12' => 'ethereum',
				'14' => 'litecoin',
				'15' => 'dogecoin',
				'16' => 'dash',
				'18' => 'bitcoincash',
				'19' => 'zcash',
				'20' => 'monero',
				'21' => 'ethereumclassic',
				'22' => 'ripple',
			);			
			
			$options['paymethod'] = array(
				'view' => 'select',
				'title' => __('Payment method','pn'),
				'options' => $paymethods,
				'default' => is_isset($data, 'paymethod'),
				'name' => 'paymethod',
				'work' => 'int',
			);			
			
			$text = '
			<strong>Status URL:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a><br />
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

		function merchant_bidform($temp, $pay_sum, $item, $direction){

			$amount = is_sum($pay_sum);
			$text_pay = get_text_pay($this->name, $item, $amount);		
			
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));
			
			$system_id = intval(is_isset($m_data, 'paymethod'));
			if(!$system_id){ $system_id = 1; }
			
			$currency = pn_strip_input(str_replace('RUR','RUB',$item->currency_code_give));
			
			$res = '';
			
			try {
				$paykassa = new PayKassaSCI(is_deffin($this->m_data,'SHOP_ID'),is_deffin($this->m_data,'SHOP_PASS'));
				
				$res = $paykassa->sci_create_order(
					$amount,
					$currency,  
					$item->id,  
					$text_pay,   
					$system_id 
				);				
			}
			catch( Exception $e ) {
				if($show_error){
					die( __('Error!','pn') . ' ' .$e->getMessage() );
				} else {
					die(__('Error!','pn'));
				}
			}				
				
			if(isset($res["data"]) and isset($res["data"]["url"])){ 
				$temp = '
				<form action="'. $res["data"]["url"] .'" method="POST">
					<input type="submit" value="'. __('Make a payment','pn') .'" />
				</form>
				';
			} else {
				if($show_error and isset($res['message'])){
					print_r($res);
					$temp = '';
				} else {
					$temp = __('Error!','pn');
				}				
			}				
			
			return $temp;
		}

		function myaction_merchant_fail(){
			$id = get_payment_id('ac_order_id');
			the_merchant_bid_delete($id);
		}

		function myaction_merchant_success(){
			$id = get_payment_id('ac_order_id');
			the_merchant_bid_success($id);
		}
	
		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$show_error = intval(is_isset($m_data, 'show_error'));
	
			try {
				
				$paykassa = new PayKassaSCI(is_deffin($this->m_data,'SHOP_ID'),is_deffin($this->m_data,'SHOP_PASS'));

				$res = $paykassa->sci_confirm_order();

				if (isset($res['error']) and $res['error']) {        // $res['error'] - true если ошибка
					if($show_error){
						echo $res['message']; 	// $res['message'] - текст сообщения об ошибке
					} else {
						_e('Error!','pn');
					}					
				} elseif(isset($res['data'])) {
					$id = (int)$res["data"]["order_id"];        // уникальный числовой идентификатор платежа в вашем системе, пример: 150800
					$transaction = $res["data"]["transaction"]; // номер транзакции в системе paykassa: 96401
					$hash = $res["data"]["hash"];               // hash, пример: bde834a2f48143f733fcc9684e4ae0212b370d015cf6d3f769c9bc695ab078d1
					$currency = $res["data"]["currency"];       // валюта платежа, пример: RUB, USD
					$amount = $res["data"]["amount"];           // сумма платежа, пример: 100.50
					$system = $res["data"]["system"];           // система, пример: AdvCash
					$address = $res["data"]["address"];			// a cryptocurrency wallet address, for example: Xybb9RNvdMx8vq7z24srfr1FQCAFbFGWLg

					if(check_trans_in($this->name, $transaction, $id)){
						die('Error!');
					}	

					$data = get_data_merchant_for_id($id);
			
					$in_sum = $amount;
					$in_sum = is_sum($in_sum);
					$bid_err = $data['err'];
					$bid_status = $data['status'];
					$bid_m_id = $data['m_id'];
			
					$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
			
					$bid_currency = $data['currency'];
					$bid_currency = str_replace('RUR','RUB',$bid_currency);
			
					$bid_sum = is_sum($data['pay_sum']);
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
										$now_status = 'realpay';

										if($now_status){	
											$params = array(
												'sum' => $in_sum,
												'bid_sum' => $bid_sum,
												'bid_corr_sum' => $bid_corr_sum,
												'pay_purse' => $pay_purse,
												'to_account' => $address, //is_deffin($this->m_data,'SHOP_ID')
												'trans_in' => $transaction,
												'currency' => $currency,
												'bid_currency' => $bid_currency,
												'invalid_ctype' => $invalid_ctype,
												'invalid_minsum' => $invalid_minsum,
												'invalid_maxsum' => $invalid_maxsum,
												'invalid_check' => $invalid_check,
												'm_place' => $bid_m_id,
											);
											the_merchant_bid_status($now_status, $id, $params, 0);
										}
										
										echo $id.'|success'; // обязательно, для подтверждения зачисления платежа
										
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
			catch( Exception $e ) {
				if($show_error){
					die( __('Error!','pn') . ' ' .$e->getMessage() );
				} else {
					die(__('Error!','pn'));
				}
			}			
		}		
	}
}

new merchant_paykassa(__FILE__, 'PayKassa');		