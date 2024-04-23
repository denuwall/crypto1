<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('list_smsgate', 'def_list_smsgate', 100);
function def_list_smsgate($list){
	asort($list);
	return $list;
}

function is_enable_smsgate($id){
	$smsgate = get_option('smsgate');
	if(!is_array($smsgate)){ $smsgate = array(); }
	
	return intval(is_isset($smsgate,$id));
}

if(!class_exists('SmsGate_Premiumbox')){
	class SmsGate_Premiumbox {
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
		
			add_filter('list_smsgate', array($this, 'list_smsgate'));
			add_action('pn_sms_send', array($this, 'send_sms'), 10, 2);
		
		}
		
		public function list_smsgate($list){

			$list[] = array(
				'id' => $this->name,
				'title' => $this->title . ' ('. $this->name .')',
			);
			
			return $list;
		}	

		public function send_sms($html, $to){
			
		}
	}
}	