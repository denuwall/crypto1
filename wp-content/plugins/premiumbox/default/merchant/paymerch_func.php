<?php
if( !defined( 'ABSPATH')){ exit(); }
 
add_filter('list_paymerchants', 'def_list_paymerchants', 100);
function def_list_paymerchants($list){
	asort($list);
	return $list;
}

function is_enable_paymerchant($id){
	$merchants = get_option('paymerchants');
	if(!is_array($merchants)){ $merchants = array(); }
	
	return intval(is_isset($merchants,$id));
}

function get_paymerch_data($m_id){
global $pn_paymerch_data;
	if(!is_array($pn_paymerch_data)){
		$pn_paymerch_data = (array)get_option('paymerch_data');
	}
	return is_isset($pn_paymerch_data,$m_id);
}
 
add_action('instruction_paymerchant','def_instruction_paymerchant',1,2);
function def_instruction_paymerchant($instruction,$m_id){
global $premiumbox;
	
	if($m_id){
		$data = get_paymerch_data($m_id); 
		$text = trim(ctv_ml(is_isset($data,'text')));
		if($text){
			return $text;
		} else {
			$show = intval($premiumbox->get_option('exchange','mp_ins'));
			if($show == 0){
				return $text;
			} else {
				return $instruction;
			}
		}
	}
	
	return $instruction;
}

function get_text_paymerch($m_id, $item, $pay_sum=0){
	if($m_id and isset($item->id)){
		$data = get_paymerch_data($m_id);
		$text = trim(ctv_ml(is_isset($data,'note')));
		
		$fio_arr = array($item->last_name, $item->first_name, $item->second_name);
		$fio_arr = array_unique($fio_arr);
		$fio = pn_strip_input(join(' ',$fio_arr));
		
		$text = apply_filters('get_text_paymerch', $text, $m_id, $item);
		$text = str_replace('[id]',$item->id,$text);
		$text = str_replace('[paysum]', $pay_sum, $text);
		$text = str_replace('[sum1]', is_sum($item->sum1dc),$text);
		$text = str_replace(array('[valut1]','[currency_give]'), pn_strip_input(ctv_ml($item->psys_give)) .' '. pn_strip_input($item->currency_code_give),$text);	
		$text = str_replace('[sum2]', is_sum($item->sum2c),$text);
		$text = str_replace(array('[valut2]','[currency_get]'), pn_strip_input(ctv_ml($item->psys_get)) .' '. pn_strip_input($item->currency_code_get),$text);
		$text = str_replace('[account_give]', pn_strip_input($item->account_give),$text);
		$text = str_replace('[account_get]', pn_strip_input($item->account_get),$text);
		$text = str_replace('[fio]',$fio,$text);
		$text = str_replace('[last_name]',pn_strip_input($item->last_name),$text);
		$text = str_replace('[first_name]',pn_strip_input($item->first_name),$text);
		$text = str_replace('[second_name]',pn_strip_input($item->second_name),$text);			
		$text = str_replace('[ip]', pn_strip_input($item->user_ip),$text);
		$text = str_replace('[skype]', pn_strip_input($item->user_skype),$text);
		$text = str_replace('[phone]', pn_strip_input($item->user_phone),$text);
		$text = str_replace('[email]', is_email($item->user_email),$text);	
		$text = str_replace('[passport]', pn_strip_input($item->user_passport),$text);
		
		return esc_attr($text);
	}
}
 
add_filter('list_admin_notify','list_admin_notify_paymerchant');
function list_admin_notify_paymerchant($places_admin){
	$places_admin['paymerchant_error'] = __('Automatic payout error','pn');
	return $places_admin;
}

add_filter('list_notify_tags_paymerchant_error','def_mailtemp_tags_paymerchant_error');
function def_mailtemp_tags_paymerchant_error($tags){
	
	$tags['bid_id'] = __('Order ID','pn');
	$tags['error_txt'] = __('Error','pn');
	
	return $tags;
} 

function send_paymerchant_error($bid_id, $error_txt){
	
	$notify_tags = array();
	$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
	$notify_tags['[bid_id]'] = $bid_id;
	$notify_tags['[error_txt]'] = $error_txt;
	$notify_tags = apply_filters('notify_tags_paymerchant_error', $notify_tags);		

	$user_send_data = array();
	$result_mail = apply_filters('premium_send_message', 0, 'paymerchant_error', $notify_tags, $user_send_data); 	
	
}				

add_action('change_bidstatus_realpay','paymerch_change_bidstatus_realpay',1500,3);
function paymerch_change_bidstatus_realpay($obmen_id, $item, $place){
global $wpdb;	
	if($place != 'admin_panel'){
		$m_id = apply_filters('get_paymerchant_id',0, is_isset($item,'m_out'), $item);
		if($m_id){
			$direction_id = intval(is_isset($item, 'direction_id'));
			$direction_data = get_direction_meta($direction_id, 'paymerch_data');
			$m_out_realpay = intval(is_isset($direction_data, 'm_out_realpay'));
			if(is_paymerch_realpay($m_id) and $m_out_realpay == 0 or $m_out_realpay == 2){
				do_action('paymerchant_action_bid_'.$m_id, $item, 'site', $direction_data, $place);
			}
		}
	}	
}

add_action('change_bidstatus_verify','paymerch_change_bidstatus_verify',1500,3);
function paymerch_change_bidstatus_verify($obmen_id, $item, $place){
global $wpdb;
	if($place != 'admin_panel'){
		$m_id = apply_filters('get_paymerchant_id',0, is_isset($item,'m_out'), $item);
		if($m_id){
			$direction_id = intval(is_isset($item, 'direction_id'));
			$direction_data = get_direction_meta($direction_id, 'paymerch_data');
			$m_out_verify = intval(is_isset($direction_data, 'm_out_verify'));
			if(is_paymerch_verify($m_id) and $m_out_verify == 0 or $m_out_verify == 2){
				do_action('paymerchant_action_bid_'.$m_id, $item, 'site', $direction_data, $place);
			}
		}
	}	
}

add_filter('onebid_actions','onebid_actions_paymerch',99,3);
function onebid_actions_paymerch($actions, $item, $data_fs){
global $wpdb;
	
	$status = $item->status;
	
	$av_status_button = get_option('av_status_button');
	if(!is_array($av_status_button)){ $av_status_button = array(); }
	 
	$st = apply_filters('status_for_autopay_admin', $av_status_button);
	$st = (array)$st;
	if(in_array($status, $st)){
		if(current_user_can('administrator') or current_user_can('pn_bids_payouts')){
			$m_id = apply_filters('get_paymerchant_id',0, is_isset($item,'m_out'), $item);
			if($m_id){
				$enable_autopay = apply_filters('paymerchant_enable_autopay',0 , $m_id);
				if($enable_autopay == 1){
					if(is_paymerch_button($m_id)){
						$actions['pay_merch'] = array(
							'type' => 'link',
							'title' => __('Transfer','pn'),
							'label' => __('Transfer','pn'),
							'link' => pn_link_post('paymerchant_bid_action') .'&id=[id]',
							'link_target' => '_blank',
							'link_class' => 'pay_merch',
						);					
					}
				}
			}
		}
	}
	
	return $actions;
}

add_action('premium_action_paymerchant_bid_action','def_paymerchant_bid_action');
function def_paymerchant_bid_action(){
global $wpdb;

	if(current_user_can('administrator') or current_user_can('pn_bids_payouts')){
		admin_pass_protected(__('Enter security code','pn'), __('Enter','pn'));	
		
		$bid_id = intval(is_param_get('id'));
		$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$bid_id'");
		if(isset($item->id)){
			$status = $item->status;
			
			$av_status_button = get_option('av_status_button');
			if(!is_array($av_status_button)){ $av_status_button = array(); }
			
			$st = apply_filters('status_for_autopay_admin', $av_status_button);
			$st = (array)$st;
			if(in_array($status, $st)){
				$m_id = apply_filters('get_paymerchant_id',0, is_isset($item,'m_out'), $item);
				if($m_id){
					$enable_autopay = apply_filters('paymerchant_enable_autopay',0, $m_id);
					if($enable_autopay == 1){
						if(is_paymerch_button($m_id)){
							$direction_id = intval(is_isset($item, 'direction_id'));
							$direction_data = get_direction_meta($direction_id, 'paymerch_data');
							do_action('paymerchant_action_bid_' . $m_id, $item, 'admin', $direction_data, 'admin_panel');
						} else {
							pn_display_mess(__('Error! Automatic payout is disabled','pn'));
						}
					} else {
						pn_display_mess(__('Error! Automatic payout is disabled','pn'));
					}
				} else {
					pn_display_mess(__('Error! Automatic payout is disabled','pn'));
				}
			} else {
				pn_display_mess(__('Error! Incorrect status of the order','pn'));
			}
		} else {
			pn_display_mess(__('Error! Order do not exist','pn'));
		}
	} else {
		pn_display_mess(__('Error! Insufficient privileges','pn'));
	}
}

/* стандартная проверка всех ав */
add_filter('autopayment_filter', 'def_autopayment_filter', 1, 6);
function def_autopayment_filter($au_filter, $m_id, $item, $place, $naps_data, $paymerch_data){
global $premiumbox;	
	
	if(is_substitution_account($item)){
		$au_filter['error'][] = __('Data from the order were compromised', 'pn');
	}	
	
	$autopay_status = intval(get_bids_meta($item->id, 'ap_status'));
	if($autopay_status == 1){
		$au_filter['error'][] = __('Automatic payout has already been made', 'pn');		
	}	
	
	$sum = is_sum(is_paymerch_sum($m_id, $item, $paymerch_data), 2);
	
	if(is_paymerch_check_sum($m_id, $sum, $place, $paymerch_data, $naps_data) != 1){
		$au_filter['error'][] = __('The amount exceeds the limit for automatic payouts for order', 'pn');		
	}				
					
	if(is_paymerch_check_day_sum($m_id, $sum, $place, $paymerch_data, $naps_data) != 1){
		$au_filter['error'][] = __('The amount exceeds the daily limit for automatic payouts', 'pn');		
	}	
	
	return $au_filter;
}

add_filter('autopayment_filter', 'avsumbig_autopayment_filter', 5, 6);
function avsumbig_autopayment_filter($au_filter, $m_id, $item, $place, $naps_data, $paymerch_data){
global $premiumbox;	

	$avsumbig = intval($premiumbox->get_option('exchange','avsumbig'));
	if($avsumbig == 0 and isset($item->pay_sum)){
		$pay_sum = is_sum($item->pay_sum);
		$sum_tb = 'sum1c';
		$sum_tb = apply_filters('avsumbig_autopayment_sum_filter', $sum_tb, $m_id, $item, $place, $naps_data, $paymerch_data);
		$comis_sum = is_sum(is_isset($item, $sum_tb)); 
		if($pay_sum > $comis_sum){ 
			$au_filter['error'][] = __('The amount of payment is less than the amount required in the order', 'pn'); 
		} 
	}	

	return $au_filter;
}

function is_paymerch_sum($m_id, $item, $paymerch_data){
	$where_sum = intval(is_isset($paymerch_data, 'where_sum'));
	$sum = 0;
	if($where_sum == 0){
		$sum = $item->sum2c;
	} elseif($where_sum == 1){
		$sum = $item->sum2dc;
	} elseif($where_sum == 2){
		$sum = $item->sum2r;
	} elseif($where_sum == 3){
		$sum = $item->sum2;
	}
	return $sum;
}

function is_substitution_account($item){
	
	$hask_keys = bid_hashkey();
	
	$hashdata = @unserialize($item->hashdata);
	if(!is_array($hashdata)){ $hashdata = array(); }
	
	foreach($hask_keys as $key){
		$value = trim(is_isset($item, $key));
		if($value){
			$hash = trim(is_isset($hashdata, $key));
			if(!is_pn_crypt($hash, $value)){
				return 1;
				break;
			}	
		}
	}	

	return 0;
}

function is_paymerch_check_sum($m_id, $sum, $place, $paymerch_data, $naps_data=array()){
	if($place == 'admin' and get_paymerch_button_maximum($m_id) == 1){
		return 1;
	}	
	$max_sum = is_sum(is_isset($naps_data,'m_out_max_sum'));
	if($max_sum <= 0){
		$max_sum = is_sum(is_isset($paymerch_data,'max_sum'));
	}
	if($max_sum > 0){
		$sum = is_sum($sum);
		if($sum > $max_sum){
			return 0;
		}
	}
	return 1;
}

function is_paymerch_check_day_sum($m_id, $sum, $place, $paymerch_data, $naps_data=array()){
	if($place == 'admin' and get_paymerch_button_maximum($m_id) == 1){
		return 1;
	}	
	if($sum > 0){
		$max_sum = is_sum(is_isset($naps_data,'m_out_max'));
		if($max_sum <= 0){
			$max_sum = is_sum(is_isset($paymerch_data,'max'));
		}		
		if($max_sum > 0){
			$time = current_time('timestamp');
			$date = date('Y-m-d 00:00:00',$time);			
			$day_sum = get_sum_for_autopay($m_id, $date);
			$plan_sum = $day_sum + $sum;
			if($plan_sum > $max_sum){
				return 0;
			}
		}
	}
		return 1;
}

function is_paymerch_realpay($m_id){
	$data = get_paymerch_data($m_id); 
	return intval(is_isset($data,'realpay'));
}

function is_paymerch_verify($m_id){
	$data = get_paymerch_data($m_id); 
	return intval(is_isset($data,'verify'));
}

function is_paymerch_checkpay($m_id){
	$data = get_paymerch_data($m_id);  
	
	return intval(is_isset($data,'checkpay'));
}

function is_paymerch_button($m_id){
	$data = get_paymerch_data($m_id);  
	
	return intval(is_isset($data,'button'));
}

function get_paymerch_button_maximum($m_id){
	$data = get_paymerch_data($m_id);  
	
	return intval(is_isset($data,'button_maximum'));
}

if(!class_exists('AutoPayut_Premiumbox')){
	class AutoPayut_Premiumbox {
		public $name = "";
		public $m_data = "";
		public $title = "";	
		public $autopay_button_arg = "";
		
		function __construct($file, $map, $title, $autopay_button_arg='BUTTON')
		{
			$path = get_extension_file($file);
			$name = get_extension_name($path);
			$numeric = get_extension_num($name);

			$data = set_extension_data($path . '/dostup/index', $map);
			
			file_safe_include($path . '/class');
		
			$this->name = trim($name);
			$this->m_data = $data;
			$this->title = $title.' '.$numeric;
			$this->autopay_button_arg = $autopay_button_arg;
			
			add_filter('list_paymerchants', array($this, 'list_paymerchants'));
			add_filter('get_paymerchant_id',array($this, 'get_paymerchant_id'),1,3);
			add_filter('paymerchant_enable_autopay',array($this, 'paymerchant_enable_autopay'),1,2);
			add_filter('premium_security_errors', array($this, 'security_errors'));
			add_action('paymerchant_action_bid_'. $this->name, array($this,'paymerchant_action_bid'),99,4);
		}	
		
		public function list_paymerchants($list_merchants){
			$list_merchants[] = array(
				'id' => $this->name,
				'title' => $this->title . ' ('. $this->name .')',
			);
			return $list_merchants;
		}

		public function get_paymerchant_id($now, $m_id, $item){
			if($m_id and $m_id == $this->name){
				if(is_enable_paymerchant($m_id)){
					return $m_id;
				} 
			}
			return $now;
		}

		public function paymerchant_enable_autopay($now, $m_id){
			global $premiumbox;
			if($m_id and $m_id == $this->name and intval(is_deffin($this->m_data, $this->autopay_button_arg)) == 1 or $premiumbox->is_debug_mode()){	
				return 1;
			}
			return $now;
		}

		public function get_reserve_lists(){
			return array();
		}
		
		public function check_reserv_list($key){
			$lists = $this->get_reserve_lists();
			$new_list = array();
			foreach($lists as $list_key => $list_value){
				$new_list[$list_key] = $list_key;
			}
			if(in_array($key, $new_list)){
				return 1;
			} else {
				return 0;
			}
		}
		
		public function security_list(){
			return array('resulturl','show_error','checkpay');
		}		
		
		public function paymerchant_action_bid($item, $place, $direction_data, $modul_place=''){
			$item_id = is_isset($item,'id');
			if($item_id){
				$paymerch_data = get_paymerch_data($this->name);
				$unmetas = @unserialize($item->unmetas);
				$au_filter = array(
					'error' => array(),
					'pay_error' => 0,
					'enable' => 1,
				);
				$au_filter = apply_filters('autopayment_filter', $au_filter, $this->name, $item, $place, $direction_data, $paymerch_data, $unmetas);				
				if($au_filter['enable'] == 1){
					$error = (array)$au_filter['error'];
					$pay_error = intval($au_filter['pay_error']);
					
					$this->do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place);	
				}		
			}			
		}	
		
		public function set_ap_status($item){
			$result = update_bids_meta($item->id, 'ap_status', 1);
			update_bids_meta($item->id, 'ap_status_date', current_time('timestamp'));
			return $result;
		}
		
		public function reset_ap_status($error, $pay_error, $item, $place){
			if($pay_error == 1){
				update_bids_meta($item->id, 'ap_status', 0);
				update_bids_meta($item->id, 'ap_status_date', current_time('timestamp'));
			}	
							
			$error_text = join('<br />',$error);
						
			do_action('paymerchant_error', $this->name, $error, $item->id, $place);
						
			if($place == 'admin'){
				pn_display_mess(__('Error!','pn') . $error_text);
			} else {
				send_paymerchant_error($item->id, $error_text);
			}			
		}
		
		public function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
			/* standard */
		}
		
		public function security_errors($errors){
			$security_list = $this->security_list();
			$data = get_paymerch_data($this->name);
			
			foreach($security_list as $security){
				if($security == 'resulturl'){
					if(!is_isset($data,$security)){
						$errors[] = sprintf(__('For %s auto payout, hash is not specified for Status/Result URL','pn'), $this->name);
					}
				}
				if($security == 'checkpay'){
					if(is_isset($data,'checkpay') != 1){
						$errors[] = sprintf(__('For %s auto payout, payment history verification through API interface is not enabled','pn'), $this->name);
					}
				}				
				if($security == 'show_error'){
					if(is_isset($data,'show_error') == 1){
						$errors[] = sprintf(__('For %s auto payout, error output is enabled','pn'), $this->name);
					}
				}
			}
			
			return $errors;
		}		
	}
}