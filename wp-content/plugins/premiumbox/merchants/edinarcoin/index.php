<?php
/*
title: [en_US:]E-dinarcoin[:en_US][ru_RU:]E-dinarcoin[:ru_RU]
description: [en_US:]E-dinarcoin merchant[:en_US][ru_RU:]мерчант E-dinarcoin[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_edinar')){
	class merchant_edinar extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'TOKEN', 'ACCOUNT',
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_bidaction_'.$this->name, array($this,'merchant_bidaction'),99,4);
			add_filter('get_merchant_admin_options_'.$this->name,array($this, 'get_merchant_admin_options'),1,2);
			add_action('myaction_merchant_'. $this->name .'_cron'. get_hash_result_url($this->name), array($this,'myaction_merchant_cron'));
			
			/* check address */
			//add_filter('merchant_formstep_after', array($this,'merchant_formstep_after'),99,5);
			//add_action('myaction_merchant_'. $this->name .'_checkorder', array($this,'myaction_merchant_checkorder'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			/* end check address */
			
			add_filter('list_user_notify',array($this,'user_mailtemp'));
			add_filter('list_admin_notify',array($this,'admin_mailtemp'));
			add_filter('list_notify_tags_generate_address1_edinar',array($this,'mailtemp_tags_generate_address'));
			add_filter('list_notify_tags_generate_address2_edinar',array($this,'mailtemp_tags_generate_address'));
		}
		
		function user_mailtemp($places_admin){
			
			$places_admin['generate_address1_edinar'] = sprintf(__('Address generation for %s','pn'), 'Edinar');
			
			return $places_admin;
		}

		function admin_mailtemp($places_admin){
			
			$places_admin['generate_address2_edinar'] = sprintf(__('Address generation for %s','pn'), 'Edinar');
			
			return $places_admin;
		}

		function mailtemp_tags_generate_address($tags){
			
			$tags['bid_id'] = __('Order ID','pn');
			$tags['address'] = __('Address','pn');
			$tags['sum'] = __('Amount','pn');
			
			return $tags;
		}				

		function merchant_formstep_autocheck($autocheck, $m_id){
			
			if($m_id and $m_id == $this->name){
				$autocheck = 1;
			}
			
			return $autocheck;
		}					
		
		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_merchant_admin_options($options, $data){
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['check_api'])){
				unset($options['check_api']);
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
			if(isset($options['enableip'])){
				unset($options['enableip']);
			}			

			$text = '
			<strong>CRON URL:</strong> <a href="'. get_merchant_link($this->name.'_cron'. get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_cron'. get_hash_result_url($this->name)) .'</a><br />
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
				is_deffin($this->m_data,'TOKEN') and is_deffin($this->m_data,'ACCOUNT')
			){
				$text = '';
			}
			
			return $text;
		}		

		function merchant_bidaction($temp, $pay_sum, $item, $direction){
			global $wpdb;

			$item_id = $item->id;		
			$currency = $item->currency_code_give;
			$currency_m = strtolower($currency);
				
			$params = array(
				'm_place' => $this->name,
				'system' => 'user',
			);
			the_merchant_bid_status('techpay', $item_id, $params, 0); 	
			
			$to_account = pn_strip_input($item->to_account);
			if(!$to_account){
				
				$m_data = get_merch_data($this->name);
				$show_error = intval(is_isset($m_data, 'show_error'));				
				
				try {
					
					$token = is_deffin($this->m_data,'TOKEN');
					$account = is_deffin($this->m_data,'ACCOUNT');
					$class = new Edinar($token);
					$result_url = get_merchant_link($this->name.'_cron' . get_hash_result_url($this->name)).'?hook_id='.$item_id;
					$to_account = $class->add_adress($account, $result_url);
					
				} catch (Exception $e) { 
					if($show_error){
						die($e);
					}	
				}
				if($to_account){
					
					$to_account = pn_strip_input($to_account);
					update_bid_tb($item_id, 'to_account', $to_account);
					
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags['[address]'] = $to_account;
					$notify_tags['[sum]'] = $pay_sum;
					$notify_tags = apply_filters('notify_tags_generate_address_edinar', $notify_tags);		

					$user_send_data = array();
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address2_edinar', $notify_tags, $user_send_data); 
					
					$user_send_data = array(
						'user_email' => $item->user_email,
						'user_phone' => '',
					);	
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address1_edinar', $notify_tags, $user_send_data, $item->bid_locale);					
					
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
				';
			} else { 
				$temp .= '
				<div class="error_div">'. __('Error','pn') .'</div>
				';
			}  	
			return $temp;				
		}  
 
		function myaction_merchant_cron(){
	
			$order_id = trim(is_param_get('hook_id'));
			$this->edinar_check_orders($order_id, 0);
	
		}		

		function edinar_check_orders($order_id=0, $return=0){
			global $wpdb;

			$m_id = $this->name;
			$order_id = intval($order_id);
			$return_url = '';

			$where = '';
			if($order_id){
				$where = " AND id = '$order_id'";
			}
			
			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));
			
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status IN ('techpay') AND currency_code_give IN('EDC') AND to_account != '' AND m_in='$m_id' $where");
			foreach($items as $item){
				$item_id = $item->id;
							
				$address = $item->to_account;
				
				$id = $item_id;
				$data = get_data_merchant_for_id($id);
				
				$pay_purse = apply_filters('pay_purse_merchant', '', $m_data, $m_id);
				
				$bid_sum = $data['pay_sum'];
				$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $m_id);
				
				$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
				$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
				$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
				$invalid_check = intval(is_isset($m_data, 'check'));				
					
				if($return){
					$return_url = get_bids_url($item->hashed);
				}
					
				try {
					$token = is_deffin($this->m_data,'TOKEN');
					$account = is_deffin($this->m_data,'ACCOUNT');
					$class = new Edinar($token);						
					$datas = $class->get_history_address($address);
					foreach($datas as $trans_id => $data){
						$amount = is_sum($data['amount']);	
						if($amount >= $bid_corr_sum or $invalid_minsum == 1){
							$trans_id = pn_strip_input($trans_id);
								
							$params = array(
								'pay_purse' => $pay_purse,
								'sum' => $amount,
								'bid_sum' => $bid_sum,
								'bid_corr_sum' => $bid_corr_sum,
								'trans_in' => $trans_id,
								'invalid_ctype' => $invalid_ctype,
								'invalid_minsum' => $invalid_minsum,
								'invalid_maxsum' => $invalid_maxsum,
								'invalid_check' => $invalid_check,
								'm_place' => $m_id,
							);
							the_merchant_bid_status('realpay', $item_id, $params, 0);								
								
							break;
						}
					}
				}
				catch (Exception $e)
				{
					if($show_error){
						echo $e;
					}
				}					
			} 
			
			if($return_url){
				wp_redirect($return_url);
				exit;
			}			
		}
		
		function merchant_formstep_after($content, $m_id, $direction, $vd1, $vd2){
		global $bids_data;	
			if($m_id and $m_id == $this->name){
				$temp = '
				<div class="block_warning_merch">
					<div class="block_warning_merch_ins">		
						<p>'. __('Attention! Click "Check payment", if you have aready paid the order.','pn') .'</p>		
					</div>
				</div>
							
				<div class="block_paybutton_merch">
					<div class="block_paybutton_merch_ins">				
						<a href="'. get_merchant_link($this->name.'_checkorder') .'?order_id='. $bids_data->id .'" class="merch_paybutton">'. __('Check payment','pn') .'</a>				
					</div>
				</div>							
				';	

				return $temp;
			}
			return $content;
		}

		function myaction_merchant_checkorder(){
			$order_id = intval(is_param_get('order_id'));
			$this->edinar_check_orders($order_id, 1);	
		}
		
	}
}

new merchant_edinar(__FILE__, 'E-dinarcoin');