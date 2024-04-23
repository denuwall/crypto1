<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('list_merchants', 'def_list_merchants', 100);
function def_list_merchants($list){
	asort($list);
	return $list;
}

function is_enable_merchant($id){
	$merchants = get_option('merchants');
	if(!is_array($merchants)){ $merchants = array(); }
	
	return intval(is_isset($merchants,$id));
}

function get_merch_data($m_id){
global $pn_merch_data;
	if(!is_array($pn_merch_data)){
		$pn_merch_data = (array)get_option('merch_data');
	}
	return is_isset($pn_merch_data, $m_id);
}

add_action('instruction_merchant','def_instruction_merchant',1,2);
function def_instruction_merchant($instruction,$m_id){
global $premiumbox;
	
	if($m_id){	
		$data = get_merch_data($m_id); 
		$text = trim(ctv_ml(is_isset($data,'text')));
		if($text){
			return $text;
		} else {
			$show = intval($premiumbox->get_option('exchange','m_ins'));
			if($show == 0){
				return $text;
			} else {
				return $instruction;
			}
		}
	}
	
	return $instruction;
}

function get_text_pay($m_id, $item, $pay_sum){
	$text = '';
	if($m_id and isset($item->id)){
		
		$data = get_merch_data($m_id);
		$text = trim(ctv_ml(is_isset($data,'note')));
		
		$fio_arr = array($item->last_name, $item->first_name, $item->second_name);
		$fio_arr = array_unique($fio_arr);
		$fio = pn_strip_input(join(' ',$fio_arr));
		
		$text = apply_filters('get_text_pay', $text, $m_id, $item);
		$text = str_replace('[id]',$item->id, $text);
		$text = str_replace('[paysum]', $pay_sum, $text);
		$text = str_replace('[sum1]', is_sum($item->sum1dc), $text); 
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
		$text = str_replace('[phone]', is_phone($item->user_phone),$text);
		$text = str_replace('[email]', is_email($item->user_email),$text);	
		$text = str_replace('[passport]', pn_strip_input($item->user_passport),$text);		
	}
	return esc_attr(trim($text));
} 

add_action('merchant_logs','enableip_merchant_logs',1, 2);
function enableip_merchant_logs($m_id, $data){
global $premiumbox;
	
	if($m_id){	
		if(!is_array($data)){ 
			$data = get_merch_data($m_id);
		}	
		$enable_ip = explode("\n", is_isset($data, 'enableip'));
		$yes_ip = '';
		foreach($enable_ip as $v){
			$v = pn_strip_input($v);
			if($v){
				$yes_ip .= '[d]'. $v .'[/d]';
			}
		}
		$user_ip = pn_real_ip();
		if($yes_ip and enable_to_ip($user_ip, $yes_ip) == 1){
			die(sprintf(__('IP adress (%s) is blocked','pn'), $user_ip));
			exit;
		}
	}
} 

function get_corr_sum($m_id){
	$data = get_merch_data($m_id); 
	return is_sum(is_isset($data,'corr'));
}

add_filter('merchant_bid_sum', 'def_merchant_bid_sum', 10, 2);
function def_merchant_bid_sum($sum, $m_id){
	$corr = get_corr_sum($m_id);
	$sum = $sum - $corr;
	return $sum;
}

function is_type_merchant($m_id){
	$data = get_merch_data($m_id); 
	return intval(is_isset($data,'type'));
} 

function is_pay_purse($payer, $m_data, $m_id){
	return apply_filters('pay_purse_merchant', $payer, $m_data, $m_id);
}

add_filter('pay_purse_merchant', 'def_pay_purse_merchant', 10);
function def_pay_purse_merchant($purse){
	$purse = str_replace('+', '', $purse);
	$purse = preg_replace("/\s/", '', $purse);	
	return $purse;
}

function get_payment_id($arg){
	$id = intval(is_param_post($arg));
	if(!$id){ $id = intval(is_param_get($arg)); }
	return $id;
}

function the_merchant_bid_delete($id){
global $wpdb;

	$id = intval($id);	
	if($id > 0){
		$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$id' AND status != 'auto'");
		if(isset($item->id)){
			
			$hashed = is_bid_hash($item->hashed);
			$url = get_bids_url($hashed);
			wp_redirect($url);
			exit;		

		} else {
			pn_display_mess(__('You refused a payment','pn'));
		}
	} else {
		pn_display_mess(__('You refused a payment','pn'));
	}	
}

function the_merchant_bid_success($id){
global $wpdb;

	$id = intval($id);	
	if($id > 0){
		$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$id' AND status != 'auto'");
		if(isset($item->id)){
			
			$hashed = is_bid_hash($item->hashed);
			$url = get_bids_url($hashed);
			wp_redirect($url);
			exit;		

		} else {
			pn_display_mess(__('You have successfully paid','pn'),__('You have successfully paid','pn'),'true');
		}
	} else {
		pn_display_mess(__('You have successfully paid','pn'),__('You have successfully paid','pn'),'true');
	}	
}

function check_trans_in($m_in, $trans_id, $order_id){
global $wpdb;

	$trans_id = pn_maxf_mb(pn_strip_input($trans_id),500);	
	$where = '';
	$order_id = intval($order_id);
	if($order_id){
		$where .= " AND id != '$order_id'";
	}
	return $wpdb->query("SELECT id FROM ". $wpdb->prefix ."exchange_bids WHERE trans_in = '$trans_id' AND m_in = '$m_in' $where");
}

function check_personal_secret($merch_name, $order_id, $amount, $currency){
	$psh = is_param_get('psh'); 
	if($psh == get_personal_secret($merch_name, $order_id .':'. $amount .':'. $currency)){
		return 1;
	} else {
		return 0;
	}
}

function the_merchant_bid_status($status, $id, $params=array(), $ap=0){
global $wpdb;	

	$sum = is_sum(is_isset($params, 'sum'), 12);
	$bid_sum = is_sum(is_isset($params, 'bid_sum'), 12);
	$bid_corr_sum = is_sum(is_isset($params, 'bid_corr_sum'), 12);
	$pay_purse = pn_maxf_mb(pn_strip_input(is_isset($params, 'pay_purse')), 500);
	$to_account = pn_maxf_mb(pn_strip_input(is_isset($params, 'to_account')),500); 
	$from_account = pn_maxf_mb(pn_strip_input(is_isset($params, 'from_account')),500); 
	$trans_in = pn_maxf_mb(pn_strip_input(is_isset($params, 'trans_in')),500); 
	$trans_out = pn_maxf_mb(pn_strip_input(is_isset($params, 'trans_out')),500);
	$currency = strtoupper(trim(is_isset($params, 'currency')));
	$bid_currency = strtoupper(trim(is_isset($params, 'bid_currency')));
	$invalid_ctype = intval(is_isset($params, 'invalid_ctype'));
	$invalid_minsum = intval(is_isset($params, 'invalid_minsum'));
	$invalid_maxsum = intval(is_isset($params, 'invalid_maxsum'));
	$invalid_check = intval(is_isset($params, 'invalid_check'));

	$ap = intval($ap);
	$id = intval($id);
	
	$ap_place = trim(is_isset($params, 'ap_place'));
	$m_place = trim(is_isset($params, 'm_place'));
	if(!$m_place){ 
		if($ap == 1){
			$m_place = 'auto_payouts';
		} else {	
			$m_place = 'merchant';
		}	
	}

	$system = trim(is_isset($params, 'system'));
	if($system != 'user'){ $system = 'system'; }
	
	$status = is_status_name($status);
	if($id and $status){
		$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$id' AND status != 'auto'");
		if(isset($item->id)){
			$bid_status = $item->status;
			if($bid_status != $status){
				
				if($bid_sum <= 0){
					$bid_sum = is_sum($item->sum1dc, 12);
				}	
				if($bid_corr_sum <= 0){
					$bid_corr_sum = $bid_sum;
				}
				$account = apply_filters('pay_purse_merchant', $item->account_give);
				
				$arr = array(
					'edit_date'=> current_time('mysql') 
				);	
					
				$tables = array();
				if($to_account){
					$arr['to_account'] = $to_account;
					$tables[] = 'to_account';
				}	
				if($from_account){
					$arr['from_account'] = $from_account;
					$tables[] = 'from_account';
				}					
				if($trans_in){
					$arr['trans_in'] = $trans_in;
					$tables[] = 'trans_in';				
				}
				if($trans_out){
					$arr['trans_out'] = $trans_out;
					$tables[] = 'trans_out';				
				}					
					
				if($sum > $bid_sum){
					$arr['exceed_pay'] = 1;
				}			

				$arr['status'] = $status;
					
				if($sum > 0){
					$arr['pay_sum'] = $sum;
					$tables[] = 'pay_sum';					
				}
				if($pay_purse){
					$arr['pay_ac'] = $pay_purse;
					$tables[] = 'pay_ac';					
				}					
					
				if($arr['status'] == 'realpay'){
					if($invalid_check == 1){
						if($pay_purse and $account){
							if($pay_purse != $account){
								$arr['status'] = 'verify';
							}
						}
					}
					if($invalid_ctype == 1){
						if($currency and $bid_currency){
							if($currency != $bid_currency){
								$arr['status'] = 'verify';
							}	
						}
					}
					if($invalid_minsum == 1){
						if($sum < $bid_corr_sum){
							$arr['status'] = 'verify';
						}
					}
					if($invalid_maxsum == 1){
						if($sum > $bid_sum){
							$arr['status'] = 'verify';
						}						
					}					
				}					
					
				$result = $wpdb->update($wpdb->prefix.'exchange_bids', $arr, array('id'=>$item->id));
				if($result == 1){
					bid_hashdata($id, '', $tables);
					do_action('change_bidstatus_all', $arr['status'], $item->id, $item, $m_place, $system);
					do_action('change_bidstatus_' . $arr['status'], $item->id, $item, $m_place, $system);	
					if($ap == 1 and $arr['status'] == 'success'){
						do_action('set_autopayouts', $item, $ap_place);
					}
				}					
			}
		}	
	}
}	

add_filter('sum_to_pay','def_sum_to_pay',1,4);
function def_sum_to_pay($sum, $m_id ,$item, $direction){
	
	if($m_id){
		if(isset($direction->id) and isset($item->id)){
			$vid = is_type_merchant($m_id);
			if($direction->pay_com1 == 0 and $vid == 1){
				return $item->sum1c;
			} 
		} 
	}	
	
	return $sum;
}

function get_data_merchant_for_id($id, $item=''){
global $wpdb;	

    $id = intval($id);
	$array = array();
	$array['err'] = 0;
	$array['status'] = $array['currency'] = $array['hashed'] = $array['m_id'] = '';
	$array['sum'] = $array['pay_sum'] = 0;
	$array['bids_data'] = $array['direction_data'] = array();
	
	if($id){
		if(!is_object($item)){
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$id'");
		}
		if(isset($item->id)){
			
			$array['err'] = 0;
			$array['status'] = is_status_name($item->status);
			$array['sum'] = is_sum($item->sum1dc);
			$array['currency'] = is_site_value($item->currency_code_give);
			$array['hashed'] = is_bid_hash($item->hashed);
			$array['pay_sum'] = is_sum($item->sum1dc);
			$array['bids_data'] = (array)$item;
			
			$direction_id = intval($item->direction_id);
			$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND id='$direction_id'");
			if(isset($direction->m_in)){
				
				$array['direction_data'] = (array)$direction;
				$m_id = apply_filters('get_merchant_id','', $direction->m_in, $item);
				$array['m_id'] = $m_id;
				
				if($direction->pay_com1 == 1){	
					$array['pay_sum'] = is_sum($item->sum1r);	 
				} 				
			}
			
		} else {
			$array['err'] = 2;	
		}
	} else {
		$array['err'] = 1;
	}
	
	return $array;
}

if(!class_exists('Merchant_Premiumbox')){
	class Merchant_Premiumbox{
		public $name = "";
		public $m_data = "";
		public $title = "";		
		
		function __construct($file, $map, $title)
		{
			$path = get_extension_file($file);
			$name = get_extension_name($path);
			$numeric = get_extension_num($name);

			$data = set_extension_data($path . '/dostup/index', $map);
			
			file_safe_include($path . '/class');
			
			$this->name = trim($name);
			$this->m_data = $data;
			$this->title = $title.' '.$numeric;
			
			add_filter('list_merchants', array($this, 'list_merchants'));
			add_filter('get_merchant_id',array($this, 'get_merchant_id'),1,3);
			add_filter('premium_security_errors', array($this, 'security_errors'));
		}	
		
		public function list_merchants($list_merchants){
			$list_merchants[] = array(
				'id' => $this->name,
				'title' => $this->title .' ('. $this->name .')',
			);
			return $list_merchants;
		}

		public function get_merchant_id($now, $m_id, $item){
			if($m_id and $m_id == $this->name){
				if(is_enable_merchant($m_id)){
					return $m_id;
				} 
			}
			return $now;
		}	

		public function security_list(){
			return array('resulturl','show_error','enableip','check_api','personal_secret');
		}		
		
		public function security_errors($errors){
			$security_list = $this->security_list();
			$data = get_merch_data($this->name);
			
			foreach($security_list as $security){
				if($security == 'resulturl'){
					if(!is_isset($data,$security)){
						$errors[] = sprintf(__('For %s merchant, hash is not specified for Status/Result URL','pn'), $this->name);
					}
				}
				if($security == 'personal_secret'){
					if(!trim(is_isset($data,$security))){
						$errors[] = sprintf(__('For %s merchant, is not specified extra secret key','pn'), $this->name);
					}
				}
				if($security == 'check_api'){
					if(intval(is_isset($data,$security)) != 1){
						$errors[] = sprintf(__('For %s merchant, payment history verification through API interface is not enabled','pn'), $this->name);
					}
				}				
				if($security == 'enableip'){
					if(!trim(is_isset($data,$security))){
						$errors[] = sprintf(__('For %s merchant, restriction by IP address is not enabled','pn'), $this->name);
					}
				}				
				if($security == 'show_error'){
					if(is_isset($data,'show_error') == 1){
						$errors[] = sprintf(__('For %s merchant, error output is enabled','pn'), $this->name);
					}
				}
			}
			
			return $errors;
		}
		
	}
}