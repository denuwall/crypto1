<?php
/*
title: [en_US:]Blockchain[:en_US][ru_RU:]Blockchain[:ru_RU]
description: [en_US:]Blockchain merchant[:en_US][ru_RU:]мерчант Blockchain[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_blockchain')){
	class merchant_blockchain extends Merchant_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'CONFIRM_COUNT', 'API_KEY', 'XPUB', 'SECRET', 'SECRET2',
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('get_merchant_admin_options_'.$this->name,array($this, 'get_merchant_admin_options'),1,2);
			add_filter('merchant_bidaction_'.$this->name, array($this,'merchant_bidaction'),99,4);
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
			add_filter('list_user_notify',array($this,'user_mailtemp'));
			add_filter('list_admin_notify',array($this,'admin_mailtemp'));
			add_filter('list_notify_tags_generate_address1_blockchain',array($this,'mailtemp_tags_generate_address'));
			add_filter('list_notify_tags_generate_address2_blockchain',array($this,'mailtemp_tags_generate_address'));
		}
		
		function user_mailtemp($places_admin){
			$places_admin['generate_address1_blockchain'] = sprintf(__('Address generation for %s','pn'), 'Blockchain');
			return $places_admin;
		}

		function admin_mailtemp($places_admin){
			$places_admin['generate_address2_blockchain'] = sprintf(__('Address generation for %s','pn'), 'Blockchain');
			return $places_admin;
		}

		function mailtemp_tags_generate_Address($tags){
			
			$tags['bid_id'] = __('Order ID','pn');
			$tags['address'] = __('Address','pn');
			$tags['sum'] = __('Amount','pn');
			$tags['count'] = __('Confirmations','pn');
			
			return $tags;
		}				
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'CONFIRM_COUNT') 
				and is_deffin($this->m_data,'API_KEY') 
				and is_deffin($this->m_data,'XPUB') 
				and is_deffin($this->m_data,'SECRET') 
				and is_deffin($this->m_data,'SECRET2') 
			){
				$text = '';
			}
			
			return $text;
		}	

		function security_list(){
			return array('resulturl','show_error', 'enableip');
		}		
		
		function get_merchant_admin_options($options, $data){
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['note'])){
				unset($options['note']);
			}
			if(isset($options['type'])){
				unset($options['type']);
			}
			if(isset($options['help_type'])){
				unset($options['help_type']);
			}
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}
			
			$options['private_line'] = array(
				'view' => 'line',
				'colspan' => 2,
			);
			$options['gap_limit'] = array(
				'view' => 'input',
				'title' => __('Gap limit','pn'),
				'default' => is_isset($data, 'gap_limit'),
				'name' => 'gap_limit',
				'work' => 'int',
			);			
			
			return $options;
		}		
		
		function merchant_formstep_autocheck($autocheck, $m_id){
			
			if($m_id and $m_id == $this->name){
				$autocheck = 1;
			}
			
			return $autocheck;
		}		

		function merchant_bidaction($temp, $pay_sum, $item, $direction){
			global $wpdb;

			$item_id = $item->id;		
			$currency = $item->currency_code_give;
			$currency_m = strtolower($currency);
				
			$my_xpub = is_deffin($this->m_data,'XPUB');
			$my_api_key = is_deffin($this->m_data,'API_KEY');
			
			$to_account = pn_strip_input($item->to_account);
			if(!$to_account){
				
				$m_data = get_merch_data($this->name);
				$show_error = intval(is_isset($m_data, 'show_error'));
				$gap_limit = intval(is_isset($m_data, 'gap_limit'));

				$my_callback_url = get_merchant_link($this->name.'_status'.get_hash_result_url($this->name)) .'?invoice_id='. $item_id .'&secret='. urlencode(is_deffin($this->m_data,'SECRET')) .'&secret2='. urlencode(is_deffin($this->m_data,'SECRET2'));
				$root_url = 'https://api.blockchain.info/v2/receive';
				$parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key . '&gap_limit=' . $gap_limit;
				$response1 = @file_get_contents($root_url . '?' . $parameters);
				$response = @json_decode($response1);				

				if(isset($response->address)){
					
					$to_account = pn_strip_input($response->address);
					update_bid_tb($item_id, 'to_account', $to_account);
					
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags['[address]'] = $to_account;
					$notify_tags['[sum]'] = $pay_sum;
					$notify_tags['[count]'] = intval(is_deffin($this->m_data,'CONFIRM_COUNT'));
					$notify_tags = apply_filters('notify_tags_generate_address_blockchain', $notify_tags);		

					$user_send_data = array();
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address2_blockchain', $notify_tags, $user_send_data); 
					
					$user_send_data = array(
						'user_email' => $item->user_email,
						'user_phone' => '',
					);	
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address1_blockchain', $notify_tags, $user_send_data, $item->bid_locale);					
					
				} 
			}
			
 			if($to_account){	 
				$temp .= '		
				<div class="zone_table"> 
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $item_id .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('ID','pn') .'</div></div>
						<div class="zone_text">'. $item_id .'</div>
					</div>				
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $pay_sum .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('Amount','pn') .'</div></div>
						<div class="zone_text">'. $pay_sum .' '. $currency .'</div>					
					</div>				
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $to_account .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('Address','pn') .'</div></div>
						<div class="zone_text">'. $to_account .'</div>					
					</div>
				</div>
				<div class="zone center">
					'. sprintf(__('The order status changes to "Paid" when we get <b>%1$s</b> confirmations','pn'), is_deffin($this->m_data,'CONFIRM_COUNT')) .'</p>
				</div>				
				';
			} else { 
				$temp .= '
				<div class="error_div">'. __('Error','pn') .'</div>
				';
			}  	
			return $temp;					
		} 

		function myaction_merchant_status(){
	
			$m_data = get_merch_data($this->name);
			do_action('merchant_logs', $this->name, $m_data);
	
			$sAddress = isset( $_REQUEST['address'] ) ? $_REQUEST['address'] : null; 
			$secret = isset( $_REQUEST['secret'] ) ? $_REQUEST['secret'] : null; 
			$secret2 = isset( $_REQUEST['secret2'] ) ? $_REQUEST['secret2'] : null; 
			$invoice_id = isset( $_REQUEST['invoice_id'] ) ? $_REQUEST['invoice_id'] : null; 
			$sTransferHash = isset( $_REQUEST['transaction_hash'] ) ? $_REQUEST['transaction_hash'] : null;
			$iConfirmCount = isset( $_REQUEST['confirmations'] ) ? $_REQUEST['confirmations'] - 0 : 0;
			$in_sum = isset( $_REQUEST['value'] ) ? $_REQUEST['value'] / 100000000 : 0;

			if(urldecode($secret) != is_deffin($this->m_data,'SECRET')){
				die('wrong secret!');
			}

			if(urldecode($secret2) != is_deffin($this->m_data,'SECRET2')){
				die('wrong secret!');
			}
  
			$currency = 'BTC';
  
			$id = intval($invoice_id);
			$data = get_data_merchant_for_id($id);
			
			$bid_err = $data['err'];
			$bid_status = $data['status'];
			$bid_m_id = $data['m_id'];
			
			$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
			
			$bid_currency = $data['currency'];
			
			$bid_sum = $data['pay_sum'];
			$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
			
			$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
			$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
			$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
			$invalid_check = intval(is_isset($m_data, 'check'));			
				 
			if($bid_err == 0){
				if($bid_m_id and $bid_m_id == $this->name){
					if($bid_currency == $currency or $invalid_ctype == 1){
						if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){		
						
							$conf_count = intval(is_deffin($this->m_data,'CONFIRM_COUNT'));
							do_action('merchant_confirm_count', $id, $iConfirmCount, $data['bids_data'], $data['direction_data'], $conf_count, $this->name);
						
							$now_status = '';
						
							if( $iConfirmCount >= $conf_count ) {
								if($bid_status == 'new' or $bid_status == 'coldpay'){ 
									$now_status = 'realpay';
								}
							} else {
								if($bid_status == 'new'){
									$now_status = 'coldpay';
								}
							}
							if($now_status){
								$params = array(
									'pay_purse' => $pay_purse,
									'sum' => $in_sum,
									'bid_sum' => $bid_sum,
									'bid_corr_sum' => $bid_corr_sum,
									'trans_in' => $sTransferHash,
									'currency' => $currency,
									'bid_currency' => $bid_currency,
									'invalid_ctype' => $invalid_ctype,
									'invalid_minsum' => $invalid_minsum,
									'invalid_maxsum' => $invalid_maxsum,
									'invalid_check' => $invalid_check,
									'm_place' => $bid_m_id,
								);
								the_merchant_bid_status($now_status, $id, $params, 0);
									 	
								die( 'ok' );								
							}		
						} else {
							die('Payment amount is less than the provisions');
						}
					} else {
						die('Wrong type of currency');
					}
				} else {
					die('Merchant is off in this direction');
				}
			} else {
				die( 'Bid does not exist or the wrong ID' );
			}
		}
		
	}
}

new merchant_blockchain(__FILE__, 'Blockchain');