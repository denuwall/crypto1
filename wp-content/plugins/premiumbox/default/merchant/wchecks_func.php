<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('list_wchecks', 'def_list_wchecks', 100);
function def_list_wchecks($list){
	asort($list);
	return $list;
}

function is_enable_wchecks($id){
	$wchecks = get_option('wchecks');
	if(!is_array($wchecks)){ $wchecks = array(); }
	
	return intval(is_isset($wchecks,$id));
}

add_filter('get_account_wline', 'wchecks_get_account_wline', 10, 5);
function wchecks_get_account_wline($temp, $vd, $direction, $id, $place){
	if(is_enable_check_purse()){
		$check_purse = 0;
		if($direction->check_purse == $id or $direction->check_purse == 3){
			$check_purse = 1;
		} 
		$check_purse_text = pn_strip_input(ctv_ml($vd->check_text));
		if(!$check_purse_text){ $check_purse_text = __('e-wallet has valid status','pn'); }		
			
		if($check_purse > 0){
			$temp .= '
			<div class="check_purse_line">
				<label><input type="checkbox" class="js_check_purse" name="check_purse'. $id .'" value="1" /> '. $check_purse_text .'</label>
			</div>
			';
		}	
	}
	return $temp;
}

if(!class_exists('Wchecks_Premiumbox')){
	class Wchecks_Premiumbox {
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
			$this->title = $title . ' ' . $numeric;
			
			add_filter('list_wchecks', array($this, 'list_wchecks'));
			add_action('wchecks_admin', array($this, 'wchecks_admin'));
			add_action('premium_action_'. $name .'_test', array($this, 'premium_action_test'));
			
			if(is_enable_wchecks($name)){
				add_filter('check_purse_text_give', array($this, 'check_purse_text'), 10, 2);
				add_filter('check_purse_text_get', array($this, 'check_purse_text'), 10, 2);
				add_filter('set_check_account_give', array($this, 'set_check_account'), 10, 3);
				add_filter('set_check_account_get', array($this, 'set_check_account'), 10, 3);
			}
		}
		
		public function list_wchecks($list){
			$list[] = array(
				'id' => $this->name,
				'title' => $this->title . ' ('. $this->name .')',
			);
			return $list;
		}
		
		public function wchecks_admin($m_id){
			if($m_id == $this->name){
				
				$form = new PremiumForm();
				
				$options = array();	
				$options['top_title'] = array(
					'view' => 'h3',
					'title' => __('Test','pn'),
					'submit' => __('Test','pn'),
					'colspan' => 2,
				);	
				$options['purse'] = array(
					'view' => 'inputbig',
					'title' => __('Wallet','pn'),
					'default' => '',
					'name' => 'purse',
				);	

				$params_form = array(
					'filter' => 'wchecks_admin_options',
					'method' => 'post',
					'form_link' => pn_link_post($this->name.'_test'),
					'button_title' => __('Test','pn'),
				);
				$form->init_form($params_form, $options);
				
			}
		}		
		
		public function premium_action_test(){
			$form = new PremiumForm();
			$form->error_form(__('Not tested','pn'));
		}
		
		public function check_purse_text($text, $check_id){
			if($check_id and $check_id == $this->name){
				$text = __('Your account is not verified','pn');
			}
			return $text;
		}	

		public function set_check_account($ind, $purse, $check_id){
			return $ind;
		}	
	}
}