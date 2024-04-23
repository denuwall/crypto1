<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('InvestBox_Merchant')){
	class InvestBox_Merchant {

		public $merch_name = '';
	
		function __construct()
		{
			add_action('invest_systems', array($this, 'invest_systems'));
			$name = trim($this->merch_name);
			if($name){
				add_action('myaction_merchant_invest_'. $this->merch_name .'_fail', array($this,'merchant_fail'));
				add_action('myaction_merchant_invest_'. $this->merch_name .'_success', array($this,'merchant_success'));
				add_action('myaction_merchant_invest_'. $this->merch_name .'_status', array($this,'merchant_status'));
			}
			add_filter('the_pay_form_deposit', array($this, 'pay_form_deposit'), 99, 2);
		}	
		
		public function invest_systems($systems){
			return $systems;
		}
		
		public function merchant_fail(){
			pn_display_mess(__('You have declined payment','inex'));
		}
		
		public function merchant_success(){
		global $investbox;	
			$toinvest = $investbox->get_page('toinvest');
			wp_redirect($toinvest);
			exit;
		}		
		
		public function merchant_status(){
			
		}		
		
		public function pay_form_deposit($temp, $data){
			
			return $temp;
		}
		
		
		public function payed_deposit($id, $summ, $vtype, $truemess='',$errormess=''){ 
		global $wpdb;
			
			$id = intval($id);
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."inex_deposit WHERE id='$id' AND paystatus='0'");
			if(isset($item->id)){	
				$item_id = $item->id;
				if($summ >= $item->insumm and $item->gvalut == $vtype){
					
					$array = array();
					$date = current_time('mysql');
					$time = current_time('timestamp');
					$array['indate'] = $date;
					
					$endtime = $time + ($item->couday * 24 * 60 * 60);
					$enddate = date('Y-m-d H:i:s', $endtime);
					$array['enddate'] = $enddate;
					$array['paystatus'] = 1;
					$wpdb->update($wpdb->prefix.'inex_deposit', $array, array('id'=>$item_id));
					
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[system]'] = pn_strip_text($item->gtitle .' '. $item->gvalut);
					$notify_tags['[outsumm]'] = pn_strip_text($item->insumm .' '. $item->gvalut);
					$notify_tags['[id]'] = $item->id;
					$notify_tags = apply_filters('notify_tags_mail1', $notify_tags);		

					$user_send_data = array();	
					$result_mail = apply_filters('premium_send_message', 0, 'mail1', $notify_tags, $user_send_data);						
					
					echo $truemess;
				
				} else {
					echo $errormess;
				}	
			} else {
				echo $errormess;
			}
			exit;
		}		
		
	}    
}