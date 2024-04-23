<?php
if (session_id() === ''){
	session_start();
}

if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_disallow_file_mode')){
	function pn_disallow_file_mode(){
		if(!defined('DISALLOW_FILE_MODS')){
			define('DISALLOW_FILE_MODS', true);
		}	
	}
}

if(!function_exists('pn_concatenate_scripts')){
	function pn_concatenate_scripts(){
		if(!defined('CONCATENATE_SCRIPTS')){
			define('CONCATENATE_SCRIPTS', false);
		}	
	}
}

if(!function_exists('pn_php_vers')){
	function pn_php_vers(){
		$php_vers_arr = explode('.',phpversion());
		$vers = is_isset($php_vers_arr, 0).'.'.is_isset($php_vers_arr, 1);
		if($vers == '7.0'){ $vers = '5.6'; }
		return $vers;
	}
} 

if(!function_exists('pn_strip_symbols')){
	function pn_strip_symbols($txt, $symbols=''){	
		if(is_array($txt) or is_object($txt)){ return ''; }
		$txt = preg_replace("/[^A-Za-z0-9$symbols]/", '', $txt);
		return $txt;
	}
}

if(!function_exists('get_session_id')){
	function get_session_id(){
		return md5(pn_strip_input(session_id()));
	}
}

if(!function_exists('get_user_hash')){
	function get_user_hash(){
		return md5(pn_strip_input(session_id()));
	}
}

if(!function_exists('pn_define')){
	function pn_define($name){
		$string = 'undefined';
		if(defined($name)){
			$string = constant($name);
		}
		return $string;
	}	
}

if(!function_exists('get_premium_url')){
	function get_premium_url(){
		return str_replace('includes/','',plugin_dir_url( __FILE__ ));
	}
}

if(!function_exists('is_ssl_url')){
	function is_ssl_url($url){
		if(is_ssl()){
			$url = str_replace('http://','https://',$url);
		} else {
			$url = str_replace('https://','http://',$url);
		}
		return $url;
	}
}

if(!function_exists('is_phone')){
	function is_phone($phone){
		$phone = pn_string($phone);
		$new_phone = preg_replace( '/[^(+)0-9]/', '',$phone);
		$new_phone = apply_filters('is_phone', $new_phone, $phone);
		return $new_phone;
	}
}

if(!function_exists('is_older_browser')){
	function is_older_browser(){
		$older_browser = false;
		
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ){
				$older_browser = true;
			} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ){
				$older_browser = true;
			} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ){
				$older_browser = true;
			} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') ){
				$older_browser = true;
			}
		}
					
		$older_browser = apply_filters('is_older_browser',$older_browser);
		return $older_browser;
	}
}

if(!function_exists('get_browser_name')){
	function get_browser_name($user_agent, $unknown='Unknown'){
		
		$user_agent = (string)$user_agent;
		if (strpos($user_agent, "Firefox") !== false){
			$browser = 'Firefox';
		} elseif (strpos($user_agent, "OPR") !== false){
			$browser = 'Opera';
		} elseif (strpos($user_agent, "Chrome") !== false){
			$browser = 'Chrome';
		} elseif (strpos($user_agent, "MSIE") !== false){
			$browser = 'Internet Explorer';
		} elseif (strpos($user_agent, "Safari") !== false){
			$browser = 'Safari';
		} else { 
			$browser = $unknown; 
		}
		
		$browser = apply_filters('get_browser_name', $browser, $user_agent);
		return $browser;
	}
}

if(!function_exists('premium_rewrite_data')){
	function premium_rewrite_data(){
		global $or_site_url;
		
		$site_url = trailingslashit($or_site_url);
		$schema = 'http://';
		if(is_ssl()){
			$schema = 'https://';
		}
		$current_url = $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$request_url = str_replace( $site_url, '', $current_url );
		$request_url = str_replace('index.php/', '', $request_url);	
		$url_parts = explode( '?', $request_url);
		$base = $url_parts[0];
		$base = rtrim($base,"/");
		$exp = explode( '/', $base);
		$super_base = end($exp);		
		$data = array(
			'site_url' => $site_url,
			'current_url' => $current_url,
			'base' => $base,
			'super_base' => $super_base,
		);
		return $data;
	}
}

if(!function_exists('pn_set_wp_admin')){
	function pn_set_wp_admin(){
		if(!defined('WP_ADMIN')){
			define('WP_ADMIN', true);
		} 		
	}
}

if(!function_exists('pn_display_mess')){
	function pn_display_mess($title, $text='', $species='error'){
		$title = trim($title);
		$text = trim($text);
		if(!$text){ $text = $title; }
		
		$html = '<html '. get_language_attributes() .'><head><title>'. $title .'</title></head><body class="' . join( ' ', get_body_class() ) . '">';
		
		if($species == 'error'){
			$html .= '<p style="text-align: center; color: #ff0000; padding: 20px 0;">'. $text .'</p>';
		} else {
			$html .= '<p style="text-align: center; color: green; padding: 20px 0;">'. $text .'</p>';
		}
		
		$html .= '</body></html>';
		
		$html = apply_filters('premium_display_mess', $html, $title, $text, $species);
		echo $html;
		exit;
	}
}

if(!function_exists('replace_cyr')){
	function replace_cyr($item){
		$iso9_table = array(
			'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G`',
			'Ґ' => 'G`', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
			'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'Y',
			'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
			'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
			'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
			'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
			'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '``',
			'Ы' => 'YI', 'Ь' => '`', 'Э' => 'E`', 'Ю' => 'YU', 'Я' => 'YA',
			'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
			'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
			'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'y',
			'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
			'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
			'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
			'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
			'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ь' => '',
			'ы' => 'yi', 'ъ' => "'", 'э' => 'e`', 'ю' => 'yu', 'я' => 'ya'
		);
		$new_item = strtr($item, $iso9_table);
		return apply_filters('replace_cyr', $new_item, $item);
	}
}

if(!function_exists('pn_strip_input')){
	function pn_strip_input($item){	
		if(is_array($item) or is_object($item)){ return ''; }
		
		$item = trim(esc_html(strip_tags(stripslashes($item))));
		
		$pn_strip_input = array(
			'select' => 'sеlect',
			'insert' => 'insеrt',
			'union' => 'uniоn',
			'loadfile' => 'lоadfile',
			'load_file' => 'lоad_file',
			'outfile' => 'оutfile',
			'cookie' => 'coоkie',
			'concat' => 'cоncat',
			'update' => 'updаte',
			'eval' => 'еval',
			'base64' => 'bаse64',
			'delete' => 'dеlete',
			'truncate' => 'truncаte',
			'replace' => 'rеplace',
			'infile' => 'infilе',
			'handler' => 'hаndler',
		);
		
		$pn_strip_input = apply_filters('pn_strip_input', $pn_strip_input);
		$pn_strip_input = (array)$pn_strip_input;
		foreach($pn_strip_input as $key => $value){
			$item = preg_replace("/\b({$key})\b/iu", $value , $item);
		}
		
		return $item;
	}
}

if(!function_exists('pn_strip_text')){
	function pn_strip_text($item){
		if(is_array($item) or is_object($item)){ return ''; }
		$item = trim(stripslashes($item));
		$allow_tag = apply_filters('pn_allow_tag','<strong>,<em>,<a>,<del>,<ins>,<code>,<img>,<h1>,<h2>,<h3>,<h4>,<h5>,<b>,<i>,<table>,<tbody>,<thead>,<tr>,<th>,<td>,<span>,<p>,<div>,<ul>,<li>,<ol>,<center>,<br>,<blockquote>');
		$allow_tag = trim($allow_tag);
		if($allow_tag){
			$item = strip_tags($item, $allow_tag);
		} else {
			$item = strip_tags($item);
		}
		
		$pn_strip_text = array(
			'select' => 'sеlect',
			'insert' => 'insеrt',
			'union' => 'uniоn',
			'loadfile' => 'lоadfile',
			'load_file' => 'lоad_file',
			'outfile' => 'оutfile',
			'cookie' => 'coоkie',
			'concat' => 'cоncat',
			'update' => 'updаte',
			'eval' => 'еval',
			'base64' => 'bаse64',
			'delete' => 'dеlete',
			'truncate' => 'truncаte',
			'replace' => 'rеplace',
			'infile' => 'infilе',
			'handler' => 'hаndler',
		);
		
		$pn_strip_text = apply_filters('pn_strip_text', $pn_strip_text);
		$pn_strip_text = (array)$pn_strip_text;
		foreach($pn_strip_text as $key => $value){
			$item = preg_replace("/\b({$key})\b/iu", $value ,$item);
		}		
		return $item;
	}
}

if(!function_exists('pn_strip_input_array')){
	function pn_strip_input_array($array){
		$new_array = array();
		if(is_array($array)){
			foreach($array as $key => $val){
				if(is_array($val)){
					$new_array[$key] = pn_strip_input_array($val);
				} else {
					$new_array[$key] = pn_strip_input($val);
				}
			}
		}
			return $new_array;
	}
}

if(!function_exists('pn_strip_text_array')){
	function pn_strip_text_array($array){
		$new_array = array();
		if(is_array($array)){
			foreach($array as $key => $val){
				if(is_array($val)){
					$new_array[$key] = pn_strip_text_array($val);
				} else {
					$new_array[$key] = pn_strip_text($val);
				}
			}
		}
			return $new_array;
	}
}

if(!function_exists('get_pn_cookie')){
	function get_pn_cookie($key){
		$key = pn_strip_input($key);
		if(isset($_COOKIE[$key])){
			return pn_strip_input($_COOKIE[$key]);
		} else {
			return false;
		}
	}
}

if(!function_exists('add_pn_cookie')){
	function add_pn_cookie($key, $arg, $time=0){
		if($time == 0){
			$time = time()+365*24*60*60;
		}	
		$key = pn_strip_input($key);
		$arg = pn_strip_input($arg);
		if(isset($_COOKIE[$key])){
			unset($_COOKIE[$key]);
		}	
		setcookie($key, $arg, $time, COOKIEPATH, COOKIE_DOMAIN, false);
	}
}

if(!function_exists('get_copy_date')){	
	function get_copy_date($year){
		$time = current_time('timestamp');
		$y = date('Y', $time);
		if($year != $y){
			return $year.'-'.$y;
		} else {
			return $y;
		}
	}
}

if(!function_exists('is_isset')){ 
	function is_isset($where, $look){
		if(is_array($where)){
			if(isset($where[$look])){
				return $where[$look];
			} 
		} elseif(is_object($where)) {
			if(isset($where->$look)){
				return $where->$look;
			} 		
		}
			return '';
	}
}

if(!function_exists('is_param_get')){
	function is_param_get($arg){
		if(isset($_GET[$arg])){
			return $_GET[$arg];
		} else {
			return false;
		}
	}
}

if(!function_exists('is_param_post')){
	function is_param_post($arg){
		if(isset($_POST[$arg])){
			return $_POST[$arg];
		} else {
			return false;
		}
	}
}	

if(!function_exists('is_param_req')){
	function is_param_req($arg){
		if(isset($_REQUEST[$arg])){
			return $_REQUEST[$arg];
		} else {
			return false;
		}
	}
}

if(!function_exists('pn_string')){
	function pn_string($text){
		$text = (string)$text;
		$text = trim($text);
		return $text;
	}
}

if(!function_exists('pn_maxf_mb')){
	function pn_maxf_mb($text, $length){
		$text = pn_string($text);
		$length = intval($length);
		if(mb_strlen($text) > $length){
			return mb_substr($text, 0, $length);
		}
			return $text;
	}
}

if(!function_exists('pn_maxf')){
	function pn_maxf($text, $length){
		$text = pn_string($text);
		$length = intval($length);
		if(strlen($text) > $length){
			return substr($text,0,$length);
		}
			return $text;
	}
}

if(!function_exists('get_replace_arrays')){
	function get_replace_arrays($array, $content, $show=0){
		if(is_array($array)){
			foreach($array as $key => $value){
				$content = str_replace($key, $value, $content);
			}
		}
		if($show != 1){
			$content = preg_replace("!\[(.*?)\]!si", '', $content);
		}
		return $content;
	}
}

if(!function_exists('get_admin_action')){
	function get_admin_action(){
		$action = false;

		if ( isset( $_REQUEST['action'] ) && -1 != $_REQUEST['action'] ){
			$action = $_REQUEST['action'];
		}
		if ( isset( $_REQUEST['action2'] ) && -1 != $_REQUEST['action2'] ){
			$action = $_REQUEST['action2'];
		}	
		return $action;
	}
}

if(!function_exists('only_post')){	
	function only_post(){
		if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
			header('Allow: POST');
			header('HTTP/1.1 405 Method Not Allowed');
			header('Content-Type: text/plain');
			exit;
		}		
	}
}

if(!function_exists('pn_real_ip')){
	function pn_real_ip(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ips = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ips = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ips = $_SERVER['REMOTE_ADDR'];
		}
		
		$ips_arr = explode(',',$ips);
		$ip = trim($ips_arr[0]);
		$ip = preg_replace( '/[^0-9a-fA-F.]/', '',$ip);
		$ip = pn_maxf($ip, 140);
		
		return apply_filters('pn_real_ip', $ip, $ips_arr);	
	}
}

if(!function_exists('pn_create_nonce')){
	function pn_create_nonce(){
		$key1 = pn_define('AUTH_SALT');
		$key2 = pn_define('NONCE_SALT');
		return mb_substr(md5($key1 . session_id() . $key2), 0, 12);
	}
}

if(!function_exists('pn_verify_nonce')){
	function pn_verify_nonce($word){
		$word = pn_string($word);
		$key1 = pn_define('AUTH_SALT');
		$key2 = pn_define('NONCE_SALT');
		if(mb_substr(md5($key1 . session_id() . $key2), 0, 12) == $word){
			return 1;
		} else {
			return 0;
		}
	}
}

if(!function_exists('pn_link_post')){
	function pn_link_post($action='', $method=''){
		global $or_site_url;
		
		$action = trim($action);
		if(!$action){
			$action = pn_strip_input(is_param_get('page'));
		}
		$method = trim($method);
		if($method != 'post'){ $method = 'get'; }
			
		$link = $or_site_url .'/premium_post.html?meth='. $method .'&yid='. pn_create_nonce();
		if($action){
			$link .= '&myaction='.$action;	
		}
			
		return $link;
	}
}
	
if(!function_exists('pn_the_link_post')){	
	function pn_the_link_post($action='', $method=''){
		echo pn_link_post($action, $method);
	}
}

if(!function_exists('get_ajax_link')){
	function get_ajax_link($action, $method='post'){ 
	global $or_site_url;
		
		$link = $or_site_url .'/ajax-'. pn_strip_input($action) .'.html?meth='. $method .'&yid='. pn_create_nonce();
		
		if(function_exists('is_ml') and is_ml()){
			$link .= '&lang='. get_lang_key(get_locale());
		}		
		
		return $link;
	}
}

if(!function_exists('get_merchant_link')){
	function get_merchant_link($action){
		global $or_site_url;
		return $or_site_url .'/merchant-'. pn_strip_input($action) .'.html';
	}
}

if(!function_exists('full_del_dir')){
	function full_del_dir($directory){
		if(is_dir($directory)){
			$dir = @opendir($directory);
			while(($file = @readdir($dir))){
				if ( is_file($directory."/".$file)){
					@unlink($directory."/".$file);
				} else if ( is_dir ($directory."/".$file) && ($file != ".") && ($file != "..")){
					full_del_dir($directory."/".$file);  
				}
			}
			@closedir ($dir);
			@rmdir ($directory);
		}
	}
}

if(!function_exists('m_defined')){
	function m_defined($arg){
		if(defined($arg) and !strstr(constant($arg), 'сюда')){
			return trim(constant($arg));
		}
			return '';
	}
}

if(!function_exists('check_hash_cron')){
	function check_hash_cron(){
		$errors = array();
		if(defined('PN_HASH_CRON')){
			$hash_cron = m_defined('PN_HASH_CRON');
			if($hash_cron){
				$hash = is_param_get('hcron');
				if($hash != $hash_cron){
					$errors[] = 1;
				}
			}
		}
		if(defined('PN_HASH_CRON2')){
			$hash_cron = m_defined('PN_HASH_CRON2');
			if($hash_cron){
				$hash = is_param_get('hcron2');
				if($hash != $hash_cron){
					$errors[] = 1;
				}
			}
		}		
			if(count($errors) > 0){
				return 0;
			} else {
				return 1;
			}
	}
}

if(!function_exists('get_hash_cron')){
	function get_hash_cron($zn){
		$atts_arr = array();
		if(defined('PN_HASH_CRON')){
			$hash_cron = m_defined('PN_HASH_CRON');
			if($hash_cron){
				$atts_arr[] = 'hcron=' . $hash_cron;
			}
		}
		if(defined('PN_HASH_CRON2')){
			$hash_cron = m_defined('PN_HASH_CRON2');
			if($hash_cron){
				$atts_arr[] = 'hcron2=' . $hash_cron;
			}
		}		
			if(count($atts_arr) > 0){
				$atts = $zn . join('&', $atts_arr);
			} else {
				$atts =  '';
			}
				return $atts;
	}
}

if(!function_exists('get_sklon')){
	function get_sklon($num, $text1, $text2, $text3){

		$num = abs($num);
		$nums = $num % 100;
			 
		if (($nums > 4) && ($nums < 21)) {
			return str_replace('%',$num,$text3);
		}
			
		$nums = $num % 10;
		if (($nums == 0) || ($nums > 4)) {
			return str_replace('%',$num,$text3);
		}	
			
		if ($nums == 1) {
			return str_replace('%',$num,$text1);
		}
			 
		return str_replace('%',$num,$text2);	
	}
}

if(!function_exists('is_extension_active')){
	function is_extension_active($name, $folder, $extension_name){
		$active = 0;
		
		$extended = get_option($name);
		if(!is_array($extended)){ $extended = array(); }
		
		if(isset($extended[$folder])){
			if(isset($extended[$folder][$extension_name])){
				$active = 1;
			}
		}
		
		return $active;
	}
}

if(!function_exists('is_admin_newurl')){
	function is_admin_newurl($item){
		$item = pn_string($item);
		$new_item = pn_strip_symbols(replace_cyr($item));
		if (preg_match("/^[a-zA-z0-9]{3,250}$/", $new_item, $matches)) {
			$new_item = strtolower($new_item);
		} else {
			$new_item = '';
		}
		return apply_filters('is_admin_newurl', $new_item, $item);
	}
}

if(!function_exists('is_user')){
	function is_user($item){
		$item = pn_string($item);
		if (preg_match("/^[a-zA-z0-9]{3,30}$/", $item, $matches )) {
			$new_item = strtolower($item);
		} else {
			$new_item = '';
		}
		return apply_filters('is_user', $new_item, $item);
	}	
}

if(!function_exists('is_password')){
	function is_password($item){
		$item = pn_string($item);
		if (strlen($item) > 3 and strlen($item) < 50) {
			$new_item = $item;
		} else {
			$new_item = '';
		}
		return apply_filters('is_password', $new_item, $item);
	}
}

if(!function_exists('is_extension_name')){
	function is_extension_name($name){
		$name = pn_string($name);
		if (preg_match("/^[a-zA-z0-9_]{1,250}$/", $name, $matches )) {
			return $name;
		} else {
			return false;
		}
	}
}

if(!function_exists('is_lahash')){
	function is_lahash($hash){
		$hash = pn_string($hash);
		if (preg_match("/^[a-zA-z0-9]{30}$/", $hash, $matches )) {
			return $hash;
		} 
		return false;
	}
}	

if(!function_exists('get_extension_file')){
	function get_extension_file($file){
		return str_replace('\\','/',dirname($file));
	}
}

if(!function_exists('get_extension_name')){
	function get_extension_name($path){
		$name = explode('/',$path);
		$name = end($name);
		$name = is_extension_name($name);
		if(strstr($path,'/themes/')){
			$name .= '_theme';
		}
		return $name;
	}
}

if(!function_exists('file_safe_include')){
	function file_safe_include($path){
		$page_include = $path . ".php";
		if(file_exists($page_include)){
			include_once($page_include);
		}
	}
}

if(!function_exists('set_extension_data')){
	function set_extension_data($path, $map){
		$new_data = array();
		if(is_file($path .'.php')){
			include($path .'.php');
			if(isset($marr) and is_array($marr)){
				foreach($map as $val){
					if(isset($marr[$val])){
						$new_data[$val] = trim($marr[$val]); 
					}
				}			
			} 
		}
		
		return $new_data;
	}
}

if(!function_exists('get_extension_num')){
	function get_extension_num($name){
		$num = preg_replace( '/[^0-9]/', '',$name);
		return $num;	
	}
}

if(!function_exists('accept_extended_data')){
	function accept_extended_data($file){
		$data = array(
			'version' => '0.1',
			'description' => '',
			'category' => '',
			'cat' => '',
			'dependent' => '',
		);
		
		$content = @file_get_contents($file, false, null, 0, 1500);
		$content = trim($content);
		if($content){
			$content = explode("/*", $content);
			if(isset($content[1])){
				$content = explode("*/", $content[1]);
				$content = explode("\n", $content[0]);
				foreach($content as $con){
					$con = trim($con);
					if($con){
						$item = explode(":", $con);
						$val_name = '';
						$val = array();
						$r=0;
						foreach($item as $arg){ $r++;
							if($r==1){
								$val_name = trim(strtolower($arg));
							} else {
								$val[] = $arg;
							}
						}
						$val = trim(join(':',$val));
						
						if($val){
							$val_arr = array('title','version','description','cat', 'category', 'dependent');
							if(in_array($val_name, $val_arr)){
								$data[$val_name] = $val;
							} 
						}
					}
				}
			}
		}

		return $data;
	}
}

if(!function_exists('get_curl_parser')){
	function get_curl_parser($url, $options=array(), $place='', $pointer=''){
		$options = (array)$options;
		$arg = array(
			'output' => '',
			'err' => 1,
		);
		if($ch = curl_init()){
			$curl_options = array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_REFERER => '',
				CURLOPT_TIMEOUT => 40,
				CURLOPT_USERAGENT => "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)",
			);
			foreach($options as $k => $v){
				$curl_options[$k] = $v;
			}
			$curl_options = apply_filters('get_curl_parser', $curl_options, $place, $pointer);
			curl_setopt_array($ch, $curl_options);
			
			$arg['output'] = curl_exec($ch);
			$arg['err'] = curl_errno($ch);
			curl_close($ch);
		} else {
			$arg['err'] = '901';
		}
		
		return $arg;
	}
}

if(!function_exists('get_mydate')){
	function get_mydate($date, $format='d.m.Y'){
		$date = pn_strip_input($date);
		if($date and $date != '0000-00-00'){
			$time = strtotime($date);
			return date($format, $time);
		}
	}
}	

if(!function_exists('get_mytime')){
	function get_mytime($date, $format='d.m.Y H:i'){
		$date = pn_strip_input($date);
		if($date and $date != '0000-00-00 00:00:00'){
			$time = strtotime($date);
			return date($format, $time);
		}
	}
}

if(!function_exists('is_my_date')){
	function is_my_date($date, $zn='d.m.Y'){
		$date = pn_string($date);
		$zn = preg_quote($zn);
		if (preg_match("/^[0-9]{1,2}[$zn]{1}[0-9]{1,2}[$zn]{1}[0-9]{4}$/", $date, $matches )) {
			return $date;
		} 
			return '';	
	}
}

if(!function_exists('pn_sfilter')){
	function pn_sfilter($arg){
		$arg = trim((string)$arg);
		$arg = str_replace('%','',$arg);
		return $arg;
	}
}

if(!function_exists('pn_enable_ip')){
	function pn_enable_ip($list_ip, $ip=''){
		$ip = pn_string($ip);
		if(!$ip){
			$ip = pn_real_ip();
		}
		$tip = explode('.',$ip);
		$list_ip = pn_string($list_ip);
		if($ip and $list_ip){
			$items = explode("\n",$list_ip);
			$not_var = 1;
			foreach($items as $oip){
				$oip = trim($oip);
				if($oip){
					$not_var = 0;
					$otip1 = explode('.',$oip);
					$otip = array();
					foreach($otip1 as $ot1){
						$ot1 = trim($ot1);
						if($ot1){
							$otip[] = $ot1;
						}
					}
					
					$cotip = count($otip);
					if($cotip == 4){
						if($otip[0] == $tip[0] and $otip[1] == $tip[1] and $otip[2] == $tip[2] and $otip[3] == $tip[3]){
							return 1;
							break;
						}
					} elseif($cotip == 3){	
						if($otip[0] == $tip[0] and $otip[1] == $tip[1] and $otip[2] == $tip[2]){
							return 1;
							break;
						}					
					} elseif($cotip == 2){
						if($otip[0] == $tip[0] and $otip[1] == $tip[1]){
							return 1;
							break;
						}
					} elseif($cotip == 1){
						if($otip[0] == $tip[0]){
							return 1;
							break;
						}					
					}
				}
			}
			if($not_var == 1){
				return 1;
			} else {
				return 0;
			}
		}
			return 1;
	}	
}

if(!function_exists('update_pn_meta')){
	function update_pn_meta($table, $id, $key, $value){ 
	global $wpdb;
		
		$id = intval($id);
		if(is_array($value)){
			$value = serialize($value);
		}
		$cc = $wpdb->query("SELECT id FROM ". $wpdb->prefix . $table ." WHERE item_id='$id' AND meta_key='$key'");
		if($cc == 0){
			$result = $wpdb->insert($wpdb->prefix . $table, array('meta_value'=>$value, 'item_id'=>$id, 'meta_key'=>$key));	
		} else {
			$result = $wpdb->update($wpdb->prefix . $table, array('meta_value'=>$value), array('item_id'=>$id, 'meta_key'=>$key));
		}
		return $result;
	}
}

if(!function_exists('get_pn_meta')){
	function get_pn_meta($table, $id, $key){
	global $wpdb;
		$id = intval($id);
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix . $table ." WHERE item_id='$id' AND meta_key='$key'");
		if(isset($data->meta_value)){
			return maybe_unserialize($data->meta_value);
		} else {
			return false;
		}
	}
}

if(!function_exists('get_direction_meta')){
	function get_direction_meta($id, $key){
	global $wpdb;
		$id = intval($id);
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix . "_directions_meta WHERE item_id='$id' AND meta_key='$key'");
		if(isset($data->meta_value)){
			return maybe_unserialize($data->meta_value);
		} else {
			return false;
		}
	}
}

if(!function_exists('delete_pn_meta')){
	function delete_pn_meta($table, $id, $key){
	global $wpdb;   	
		$id = intval($id);			
		return $wpdb->query("DELETE FROM ".$wpdb->prefix . $table ." WHERE item_id='$id' AND meta_key='$key'");
	}
}

if(!function_exists('delete_txtmeta')){
	function delete_txtmeta($folder, $data_id){
		if($folder){
			$my_dir = wp_upload_dir();
			$dir = $my_dir['basedir'].'/'. $folder .'/';
			if(!is_dir($dir)){
				@mkdir($dir, 0777);
			}
			
			$file = $dir . $data_id .'.txt';
			if(file_exists($file)){
				@unlink($file);
			} 	 			
		}
	}
}

if(!function_exists('get_direction_txtmeta')){
	function get_direction_txtmeta($data_id, $key){
		return get_txtmeta('napsmeta', $data_id, $key);
	}
}

if(!function_exists('get_txtmeta')){
	function get_txtmeta($folder, $data_id, $key){
		if($folder){
			$my_dir = wp_upload_dir();
			$dir = $my_dir['basedir'].'/'. $folder .'/';
			if(!is_dir($dir)){
				@mkdir($dir, 0777);
			}
			
			$data = '';
			
			$txt_file = $dir . $data_id .'.txt';
			if(file_exists($txt_file)){
				$data = @file_get_contents($txt_file);
			}
			
			$array = @unserialize($data);
			$string = trim(stripslashes(is_isset($array, $key)));
			
			return $string;
		}
	}
}

if(!function_exists('copy_txtmeta')){
	function copy_txtmeta($folder, $data_id, $new_id){
		if($folder){
			$my_dir = wp_upload_dir();
			$dir = $my_dir['basedir'].'/'. $folder .'/';
			if(!is_dir($dir)){
				@mkdir($dir, 0777);
			}
			
			$file = $dir . $data_id .'.txt';
			$newfile = $dir . $new_id .'.txt';
			if(file_exists($file)){
				@copy($file, $newfile);
			} 				
		}
	}
}

if(!function_exists('update_txtmeta')){
	function update_txtmeta($folder, $data_id, $key, $value){
		if($folder){
			$my_dir = wp_upload_dir();
			$dir = $my_dir['basedir'].'/'. $folder .'/';
			if(!is_dir($dir)){
				@mkdir($dir, 0777);
			}
			$htacces = $dir.'.htaccess';
			if(!is_file($htacces)){
				$nhtacces = "Order allow,deny \n Deny from all";
				$file_open = @fopen($htacces, 'w');
				@fwrite($file_open, $nhtacces);
				@fclose($file_open);		
			}
			
			$txt_file = $dir . $data_id .'.txt';
			
			if(file_exists($txt_file)){
				$data = @file_get_contents($txt_file);
			}
			
			$array = @unserialize($data); 
			if(!is_array($array)){
				$array = array();
			}
			
			$array[$key] = addslashes($value);
			
			$file_data = @serialize($array);
			
			$file_open = @fopen($txt_file, 'w');
			@fwrite($file_open, $file_data);
			@fclose($file_open);	
			
			if(is_file($txt_file)){
				return 1;
			} 
		} 
		return 0;
	}
}

if(!function_exists('get_pn_notify')){
	function get_pn_notify(){
		global $pn_notify;
		
		if(!is_array($pn_notify)){
			$pn_notify = get_option('pn_notify');
		}
		
		return $pn_notify;
	}
}

if(!function_exists('get_caps_name')){
	function get_caps_name($name){
		$name = pn_strip_input($name);
		if($name){
			$newname = mb_strtoupper(mb_substr($name,0,1)).mb_strtolower(mb_substr($name,1,mb_strlen($name)));
			return $newname;
		}
			return $name;
	}
}

if(!function_exists('is_text')){
	function is_text($arg){
		$arg = pn_string($arg);
		$arg = preg_replace("/[^A-Za-z0-9АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧЩШЭЮЯЪЬфбвгдеёщзийклмнопрстуфхцчшщэюяъъ\n\r\-.,!?$%:;()@ ]/iu", '', $arg);

		return $arg;
	}
}

if(!function_exists('get_cptgn')){
	function get_cptgn($text){
		$text =  pn_string($text);
		$txt = iconv('UTF-8','CP1251',$text);
		return $txt;
	}
}

if(!function_exists('get_tgncp')){
	function get_tgncp($text){
		$text =  pn_string($text);
		$txt = iconv('CP1251','UTF-8',$text);
		return $txt;
	}
}

if(!function_exists('get_pn_excerpt')){	
	function get_pn_excerpt($item, $count=15){
		if(function_exists('ctv_ml')){
			$excerpt = pn_strip_text(ctv_ml($item->post_excerpt));
			if($excerpt){
				return $excerpt;
			} else {
				return wp_trim_words(pn_strip_text(ctv_ml($item->post_content)),$count);
			}
		} else {
			$excerpt = pn_strip_text($item->post_excerpt);
			if($excerpt){
				return $excerpt;
			} else {
				return wp_trim_words(pn_strip_text($item->post_content),$count);
			}			
		}		
	}
}

if(!function_exists('get_month_title')){
	function get_month_title($arg, $months=array()){
		$arg = intval($arg);

		if(!is_array($months) or count($months) < 7){
			$months = array('',
				'Jan.',
				'Feb.',
				'Mar.',
				'Apr.',
				'May',
				'June',
				'July',
				'Aug.',
				'Sep.',
				'Oct.',
				'Nov.',
				'Dec.'
			);
		}
		
		return is_isset($months,$arg);
	}
}

if(!function_exists('is_place_url')){
	function is_place_url($url, $class='current'){
		$http = 'http://'; if(is_ssl()){ $http = 'https://'; }
		$url_site = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		if($url == $url_site){
			return $class;
		}
	}
}		

if(!function_exists('get_userpage_pn')){
	function get_userpage_pn($page_id, $class='act'){
		if(is_page($page_id)){
			return $class;
		} else {
			return false;
		}
	}
}	

if(!function_exists('get_rand_word')){
	function get_rand_word($count=4, $vid=1){
		$count = intval($count);
		if($count < 1){ $count = 4; }
		
		$vid = intval($vid);
		if($vid == 1){
			$arr = 'q,w,e,r,t,y,u,i,o,p,a,s,d,f,g,h,j,k,l,z,x,c,v,b,n,m';
		} else {
			$arr = '1,2,3,4,5,6,7,8,9,0';
		}
		$array = explode(',',$arr);
		
		$r=0;
		$word = '';
		while($r++<$count){
			shuffle($array);
			$word .= mb_strtoupper($array[0]);
		}
		
		return $word;
	}
}

if(!function_exists('rez_exp')){
	function rez_exp($text){
		$text = trim($text);
		$text = str_replace(array(';','"'),'',$text);
		
		return $text;
	}
}

if(!function_exists('rep_dot')){
	function rep_dot($text){
		$text = str_replace('.',',',$text);
		
		return $text;
	}
}

if(!function_exists('get_exvar')){
	function get_exvar($zn, $arr){
		return is_isset($arr,$zn);
	}
}

if(!function_exists('prepare_form_fileds')){
	function prepare_form_fileds($items, $filter, $prefix){
		global $form_field_num;
		$form_field_num = intval($form_field_num);
		$form_field_num++;
		
		$ui = wp_get_current_user();
		$html = '';
		if(is_array($items)){
			foreach($items as $name => $data){
				$type = trim(is_isset($data, 'type'));
				$name = trim(is_isset($data, 'name'));
				$title = trim(is_isset($data, 'title'));
				$req = intval(is_isset($data, 'req'));
				$not_auto = intval(is_isset($data, 'not_auto'));
				$disable = intval(is_isset($data, 'disable'));
				$placeholder = trim(is_isset($data, 'placeholder'));
				$value = is_isset($data, 'value');
				$classes = explode(',',is_isset($data, 'classes'));
				$tooltip = pn_strip_input(ctv_ml(is_isset($data, 'tooltip')));	
				
				$req_html = '';
				if($req){
					$req_html = ' <span class="req">*</span>';
				}
				$not_auto_html = '';
				if($not_auto){
					$not_auto_html = 'autocomplete="off"';
				}
				$disabled = '';
				if($disable){
					$disabled = 'disabled="disabled"';
				}			
				$class = join(' ',$classes);
				
				$tooltip_div = '';
				$tooltip_span = '';
				$tooltip_class = '';
				if($tooltip){
					$tooltip_span = '<span class="field_tooltip_label"></span>';
					$tooltip_class = 'has_tooltip';
					$tooltip_div = '<div class="field_tooltip_div"><div class="field_tooltip_abs"></div><div class="field_tooltip">'. $tooltip .'</div></div>';
				}
				
				$line = '
				<div class="form_field_line '. $prefix .'_line type_'. $type .' '. $tooltip_class  .' field_name_'. $name .'">';
					if($title){
						$line .= '<div class="form_field_label '. $prefix .'_label"><label for="form_field_id-'. $form_field_num .'-'. $name .'"><span class="form_field_label_ins">'. $title .''. $req_html .':'. $tooltip_span .'</span></label></div>';
					}
					$line .= '
					<div class="form_field_ins '. $prefix .'_line_ins">
				';
				
				if($type == 'text'){
					$line .= '
					<textarea id="form_field_id-'. $form_field_num .'-'. $name .'" class="'. $prefix .'_textarea '. $class .'" '. $disabled .' placeholder="'. $placeholder .'" '. $not_auto_html .' name="'. $name .'">'. $value .'</textarea>							
					';	
				} elseif($type == 'input'){
					$line .= '
					<input type="text" id="form_field_id-'. $form_field_num .'-'. $name .'" class="'. $prefix .'_input '. $class .'" '. $disabled .' placeholder="'. $placeholder .'" '. $not_auto_html .' name="'. $name .'" value="'. $value .'" />						
					';
				} elseif($type == 'password'){
					$line .= '
					<input type="password" id="form_field_id-'. $form_field_num .'-'. $name .'" class="'. $prefix .'_input '. $class .'" '. $disabled .' placeholder="'. $placeholder .'" '. $not_auto_html .' name="'. $name .'" value="'. $value .'" />						
					';				
				} elseif($type == 'select'){
					$options = (array)is_isset($data, 'options');
					$line .= '
					<select name="'. $name .'" id="form_field_id-'. $form_field_num .'-'. $name .'" class="'. $prefix .'_select '. $class .'" '. $disabled .' autocomlete="off">';
						foreach($options as $key => $title){
							$line .= '<option value="'. $key .'" '. selected($value, $key, false) .'>'. $title .'</option>';
						}
					$line .= '		
					</select>												
					';
				}
				
				$line .= '
						'. $tooltip_div .'
						<div class="form_field_errors"><div class="form_field_errors_ins"></div></div>
					</div>
					<div class="form_field_clear '. $prefix .'_line_clear"></div>
				</div>
				';
			
				$line = apply_filters('form_field_line', $line, $filter, $data, $ui);
				$html .= apply_filters($filter, $line, $data, $ui);
			}
		}	
		return $html;
	}
}

if(!function_exists('pn_max_upload')){
	function pn_max_upload(){
		$max_upload_size = wp_max_upload_size();
		if ( ! $max_upload_size ) {
			$max_upload_size = 0;
		}	
		$max_mb = 0;
		if($max_upload_size > 0){
			$max_mb = ($max_upload_size / 1024 / 1024);	
		}	
		
		$max_mb = apply_filters('pn_max_upload', $max_mb);
		return $max_mb;
	}
}	

if(!function_exists('pn_enable_filetype')){
	function pn_enable_filetype(){
		$filetype = array('.gif','.jpg','.jpeg','.jpe','.png');
		$filetype = apply_filters('pn_enable_filetype', $filetype);
		
		return $filetype;
	}
}

if(!function_exists('pn_mime_filetype')){
	function pn_mime_filetype($file){
		$filetype = '';
		if(function_exists('mime_content_type')){
			$filetype = mime_content_type($file['tmp_name']);
			if($filetype == 'image/png'){
				$filetype = '.png';
			} elseif($filetype == 'image/jpeg'){
				$filetype = '.jpg';
			} elseif($filetype == 'image/gif'){	
				$filetype = '.gif';
			}
		} 
		if(!$filetype){
			$filetype = strtolower(strrchr($file['name'],"."));
		}
		return apply_filters('pn_mime_filetype', $filetype, $file);
	}
}

if(!function_exists('get_sum_color')){
	function get_sum_color($sum, $max='bgreen',$min='bred'){
		if($sum == 0){
			return '<span>'. $sum .'</span>';
		} elseif($sum > 0){
			return '<span class="'. $max .'">'. $sum .'</span>';
		} else {
			return '<span class="'. $min .'">'. $sum .'</span>';
		}
	}
}

if(!function_exists('is_sum')){ 
	function is_sum($sum, $cs=12, $mode='half_up'){
		$sum = pn_string($sum);
		$sum = str_replace(',','.',$sum);
		$cs = apply_filters('is_sum_cs', $cs);
		$cs = intval($cs); if($cs < 0){ $cs = 0; }	
		if($sum){
			if(strstr($sum, 'E')){
				$sum = sprintf("%0.20F",$sum);
				$sum = rtrim($sum,'0');
			}
			$s_arr = explode('.', $sum);
			$s_ceil = trim(is_isset($s_arr, 0));
			$s_double = trim(is_isset($s_arr, 1));
			$cs_now = mb_strlen($s_double);
			
			if($cs > $cs_now){
				$cs = $cs_now;
			}
			
			$new_sum = sprintf("%0.{$cs}F",$sum);
			if(strstr($new_sum,'.')){
				$new_sum = rtrim($new_sum,'0');
				$new_sum = rtrim($new_sum,'.');
			}
			
			return apply_filters('is_sum', $new_sum, $sum, $cs, $mode);
		} else {
			return 0;
		}
		
		return $sum;
	}
}