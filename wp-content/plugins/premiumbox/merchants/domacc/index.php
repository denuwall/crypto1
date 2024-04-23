<?php
/*
title: [en_US:]Internal account[:en_US][ru_RU:]Внутренний счет[:ru_RU]
description: [en_US:]merchant for internal account[:en_US][ru_RU:]мерчант для внутреннего счета[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_domacc')){
	class merchant_domacc extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array();
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchant_pay_button_'.$this->name, array($this,'merchant_pay_button'),99,4);
			add_action('myaction_merchant_'. $this->name .'_status', array($this,'myaction_merchant_status'));
		}

		function get_merchant_admin_options($options, $data){
			
			if(isset($options['corr'])){
				unset($options['corr']);
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
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}			
			if(isset($options['center_title'])){
				unset($options['center_title']);
			}
			if(isset($options['check'])){
				unset($options['check']);
			}
			if(isset($options['invalid_ctype'])){
				unset($options['invalid_ctype']);
			}
			if(isset($options['invalid_minsum'])){
				unset($options['invalid_minsum']);
			}
			if(isset($options['invalid_maxsum'])){
				unset($options['invalid_maxsum']);
			}
			if(isset($options['show_error'])){
				unset($options['show_error']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}					
			
			return $options;
		}		

		function merchant_pay_button($temp, $pay_sum, $item, $naps){

			$temp = '<a href="'. get_merchant_link($this->name.'_status') .'?hash='. is_bid_hash($item->hashed) .'" target="_blank" class="success_paybutton">'. __('Make a payment','pn') .'</a>';
		
			return $temp;			
		}		
		
		function security_list(){
			return array();
		}		
		
		function myaction_merchant_status(){
		global $wpdb;
	
			$hashed = is_bid_hash(is_param_get('hash'));
			$ui = wp_get_current_user();
			$user_id = intval($ui->ID);	
			if($user_id){
				if($hashed){
					$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
					if(isset($obmen->id)){
						if($obmen->status == 'new'){
							if(is_true_userhash($obmen)){
								$direction_id = intval($obmen->direction_id);
								$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
								$m_id = apply_filters('get_merchant_id','', is_isset($direction,'m_in'), $obmen);
								if($m_id and $m_id == $this->name and function_exists('get_user_domacc')){
									$now_sum = get_user_domacc($user_id, $obmen->currency_code_id_give);
									if($now_sum >= $obmen->sum1c){
										$wpdb->update($wpdb->prefix.'exchange_bids', array('domacc1'=>'1'), array('id'=>$obmen->id));
										
										$params = array(
											'sum' => $obmen->sum1c,
											'bid_sum' => $obmen->sum1c,
											'bid_corr_sum' => $obmen->sum1c,
											'm_place' => $this->name,
										);
										the_merchant_bid_status('realpay', $obmen->id, 'user', 0, '', $params);	
										 
									} else {
										pn_display_mess(__('Not enough money','pn'));
									}
								} else {
									pn_display_mess(__('Merchant is disabled','pn'));
								}
							} else {
								pn_display_mess(__('Browser hash does not match the required hash','pn'));
							}
						}
					}
				}			
			}	 
	
			$url = get_bids_url($hashed);
			wp_redirect($url);
			exit;			
		}
		
	}
}

new merchant_domacc(__FILE__, __('Internal account','pn'));