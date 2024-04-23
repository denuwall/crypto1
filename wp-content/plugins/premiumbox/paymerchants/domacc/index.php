<?php
/*
title: [en_US:]Internal account[:en_US][ru_RU:]Внутренний счет[:ru_RU]
description: [en_US:]auto payouts for internal account[:en_US][ru_RU:]авто выплаты для внутреннего счета[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_domacc')){
	class paymerchant_domacc extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array();
			parent::__construct($file, $map, $title, 'BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('paymerchant_enable_autopay',array($this, 'paymerchant_enable_autopay'),1,2);
		}
		
		function security_list(){
			return array('show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['note'])){
				unset($options['note']);
			}
			if(isset($options['max'])){
				unset($options['max']);
			}					
			if(isset($options['max_sum'])){
				unset($options['max_sum']);
			}
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}			
			if(isset($options['where_sum'])){
				unset($options['where_sum']);
			}
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}			
			
			return $options;
		}		

		function paymerchant_enable_autopay($now, $m_id){
			
			if($m_id and $m_id == $this->name){	
				return 1;
			}
			
			return $now;
		}

		function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
		global $wpdb;
		
			$trans_id = 0;
			$item_id = $item->id;	
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){
					$wpdb->update($wpdb->prefix.'exchange_bids', array('domacc2'=>'1'), array('id'=>$item_id));
				} else {
					$error[] = 'Database error'; 
				}
						
			}
				
			if(count($error) > 0){
							
				$this->reset_ap_status($error, $pay_error, $item, $place);
	
			} else {
							
				$params = array(
					'trans_out' => $trans_id,
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('success', $item_id, $params, 1); 						
							 
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 
							
			}							
		}				
		
	}
}

new paymerchant_domacc(__FILE__, 'Internal account');