<?php
/*
title: [en_US:]Privat24 History (statement)[:en_US][ru_RU:]Privat24 History (выписка)[:ru_RU]
description: [en_US:]checking out payments history according to the merchant Private24 list[:en_US][ru_RU:]проверка истории платежей по выписке из мерчанта Privat24 [:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_privatbank')){
	class merchant_privatbank extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'MERCHANT_ID', 'MERCHANT_KEY', 'CARD_NUM'
			);
			parent::__construct($file, $map, $title);
			
			add_filter('get_text_pay', array($this,'get_text_pay'), 99, 3);
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_pay_button_'.$this->name, array($this,'merchant_pay_button'),99,4);
			add_action('myaction_merchant_'. $this->name .'_status' . get_hash_result_url($this->name), array($this,'myaction_merchant_status'));
			add_action('myaction_merchant_'. $this->name .'_paystatus', array($this,'myaction_merchant_paystatus'));
		}

		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_merchant_admin_options($options, $data){ 

			$text = '
			<strong>CRON:</strong> <a href="'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_status' . get_hash_result_url($this->name)) .'</a>			
			';

			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['note'])){
				unset($options['note']);
			}			
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}			
			if(isset($options['type'])){
				unset($options['type']);
			}
			if(isset($options['help_type'])){
				unset($options['help_type']);
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
		
		function get_text_pay($text, $m_id, $item){
			if($m_id and $m_id == $this->name){
				$text = str_replace('[id]','('.$item->id.')',$text);
			}
			return $text;
		}		
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'MERCHANT_ID') and is_deffin($this->m_data,'MERCHANT_KEY') and is_deffin($this->m_data,'CARD_NUM') 
			){
				$text = '';
			}
			
			return $text;
		}				
		
		function merchant_pay_button($merchant_pay_button, $sum_to_pay, $bids_data, $direction){
			
			$merchant_pay_button = '
			<a href="'. get_merchant_link($this->name . '_paystatus') .'?hash='. is_bid_hash($bids_data->hashed) .'" class="success_paybutton iam_pay_bids">'. __('Paid','pn') .'</a>
			';
			
			return $merchant_pay_button;
		}

		function myaction_merchant_paystatus(){
		global $wpdb;	
	
			$hashed = is_bid_hash(is_param_get('hash'));
			if($hashed){
				$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
				if(isset($obmen->id)){
					if($obmen->status == 'new'){
						if(is_true_userhash($obmen)){					
							$direction_id = intval($obmen->direction_id);
							$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
							$m_id = apply_filters('get_merchant_id','', is_isset($direction,'m_in'), $obmen);
							if($m_id and $m_id == $this->name){
								$result = $wpdb->update($wpdb->prefix.'exchange_bids', array('status'=>'payed','edit_date'=>current_time('mysql')), array('id'=>$obmen->id));
								if($result == 1){
									do_action('change_bidstatus_all', 'payed', $obmen->id, $obmen, $this->name, 'user');
									do_action('change_bidstatus_payed', $obmen->id, $obmen, $this->name, 'user');
								}
							}
						}
					} 
				}
			} 
				$url = get_bids_url($hashed);
				wp_redirect($url);
				exit;	
		}		
		
		function myaction_merchant_status(){
			global $wpdb;			
			$m_in = $this->name;
			
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));
			
			try {
				$oClass = new PrivatBankApi(is_deffin($this->m_data,'MERCHANT_ID'),is_deffin($this->m_data,'MERCHANT_KEY'));
				$card = is_deffin($this->m_data,'CARD_NUM');
				$res = $oClass->get_history($card);
				if(is_array($res)){
					foreach($res as $bid_id => $bid_data){
						$bid_id = intval($bid_id);
						$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status IN('coldpay','techpay','payed') AND m_in='$m_in' AND id='$bid_id'");
						if(isset($item->id)){
							$currency = mb_strtoupper(is_isset($bid_data,'currency'));
					
							$id = $bid_id;
							$data = get_data_merchant_for_id($id, $item);
							
							$in_sum = is_isset($bid_data,'amount');
							$in_sum = is_sum($in_sum,2);
							$bid_err = $data['err'];
							$bid_status = $data['status'];
							$bid_m_id = $data['m_id'];

							$pay_purse = is_pay_purse('', $m_data, $bid_m_id);
							
							$bid_currency = $data['currency'];
												
							$bid_sum = is_sum($data['pay_sum'],2);	
							$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);
							
							$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
							$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
							$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
							$invalid_check = intval(is_isset($m_data, 'check'));							
							
							if($bid_err == 0){
								if($bid_currency == $currency or $invalid_ctype == 1){
									if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){
										$params = array(
											'pay_purse' => $pay_purse,
											'sum' => $in_sum,
											'bid_sum' => $bid_sum,
											'bid_corr_sum' => $bid_corr_sum,
											'to_account' => is_deffin($this->m_data,'MERCHANT_ID'),
											'currency' => $currency,
											'bid_currency' => $bid_currency,
											'invalid_ctype' => $invalid_ctype,
											'invalid_minsum' => $invalid_minsum,
											'invalid_maxsum' => $invalid_maxsum,
											'invalid_check' => $invalid_check,
											'm_place' => $bid_m_id,
										);
										the_merchant_bid_status('realpay', $id, $params, 0); 													
									}
								}
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

new merchant_privatbank(__FILE__, 'Privat24 History');