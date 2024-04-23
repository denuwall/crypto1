<?php
/*
title: [en_US:]BimBo[:en_US][ru_RU:]BimBo[:ru_RU]
description: [en_US:]BimBo merchant[:en_US][ru_RU:]мерчант BimBo[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_bimbo')){
	class merchant_bimbo extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array();
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchant_pay_button_'.$this->name, array($this,'merchant_pay_button'),99,4);
			add_filter('merchant_formstep_after', array($this,'merchant_formstep_after'),99,4);
			add_action('myaction_merchant_'. $this->name .'_paystatus', array($this,'myaction_merchant_paystatus'));
		}

		function security_list(){
			return array();
		}		
		
		function get_merchant_admin_options($options, $data){ 
				
			if(isset($options['note'])){
				unset($options['note']);
			}
			if(isset($options['type'])){
				unset($options['type']);
			}
			if(isset($options['help_type'])){
				unset($options['help_type']);
			}
			if(isset($options['corr'])){
				unset($options['corr']);
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
			if(isset($options['enableip'])){
				unset($options['enableip']);
			}
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['show_error'])){
				unset($options['show_error']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			$options[] = array(
				'view' => 'inputbig',
				'title' => __('Link','pn'),
				'default' => is_isset($data, 'link'),
				'name' => 'link',
				'ml' => 1,
				'work' => 'input',
			);					
			
			return $options;	
		}									

		function merchant_formstep_after($content, $m_id, $direction){
		global $bids_data;
		
			if($m_id and $m_id == $this->name){
				$temp = '
				<div class="block_warning_merch">
					<div class="block_warning_merch_ins">		
						<p>'. __('Attention! Click "Paid", if you have already paid the request.','pn') .'</p>		
					</div>
				</div>
							
				<div class="block_paybutton_merch">
					<div class="block_paybutton_merch_ins">				
						<a href="'. get_merchant_link($this->name . '_paystatus') .'?hash='. is_bid_hash($bids_data->hashed) .'" class="merch_paybutton iam_pay_bids">'. __('Paid','pn') .'</a>				
					</div>
				</div>							
				';	

				return $temp;
			}
			return $content;
		}	

		function myaction_merchant_paystatus(){
		global $wpdb;	
	
			$hashed = is_bid_hash(is_param_get('hash'));
			if($hashed){
				$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
				if(isset($obmen->id)){
					$en_status = array('new','techpay','coldpay');
					if(in_array($obmen->status, $en_status)){
						if(is_true_userhash($obmen)){					
							$direction_id = intval($obmen->direction_id);
							$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
							$m_id = apply_filters('get_merchant_id','', is_isset($direction,'m_in'), $obmen);
							if($m_id and $m_id == $this->name){
								$result = $wpdb->update($wpdb->prefix.'exchange_bids', array('status'=>'payed','edit_date'=>current_time('mysql')), array('id'=>$obmen->id));
								if($result == 1){
									do_action('change_bidstatus_all', 'payed', $obmen->id, $obmen, 'bimbo', 'user');
									do_action('change_bidstatus_payed', $obmen->id, $obmen, 'bimbo', 'user');
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
		
		function merchant_pay_button($merchant_pay_button, $sum_to_pay, $item, $direction){
			
			$data = get_merch_data($this->name);
			$url = trim(ctv_ml(is_isset($data, 'link')));
			
			$merchant_pay_button = '
			<a href="'. $url .'" target="_blank" class="success_paybutton">'. __('Make a payment','pn') .'</a>
			';
			
			return $merchant_pay_button;
		}		
		
	}
}

new merchant_bimbo(__FILE__, 'BimBo');