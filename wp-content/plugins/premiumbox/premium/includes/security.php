<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('premium_verify_csrf')){
	add_action('premium_post', 'premium_verify_csrf', 0);
	function premium_verify_csrf($m) {
		if($m == 'post' or $m == 'ajax'){
			$method = trim(is_param_get('meth'));
			if ( !pn_verify_nonce( is_param_get('yid') ) ) {
				if($method == 'get'){
					pn_display_mess(__('System error (code: anticsfr)','premium'));
				} else {
					$log = array();
					$log['status'] = 'error';
					$log['status_code'] = '1'; 
					$log['status_text']= __('System error (code: anticsfr)','premium');
					echo json_encode($log);
					exit;
				}
			}			
		}
	}
}

if(!function_exists('premium_verify_csrf_byorigin')){
	add_action('premium_post', 'premium_verify_csrf_byorigin', 0);
	function premium_verify_csrf_byorigin($m) {
		if($m == 'post' or $m == 'ajax'){
			
			$method = trim(is_param_get('meth'));
			$origin = '';
			if(isset($_SERVER['HTTP_ORIGIN'])){
				$origin = rtrim(str_replace(array('http://','https://'),'',$_SERVER['HTTP_ORIGIN']),'/');
			}
			$origin_arr = explode(':', $origin);
			$origin = is_isset($origin_arr, 0);
			$site = rtrim(str_replace(array('http://','https://'),'',get_site_url_or()),'/');
			if($origin and $origin != $site){
				if($method == 'get'){
					pn_display_mess(__('System error (code: validreq)','premium'));
				} else {
					$log = array();
					$log['status'] = 'error';
					$log['status_code'] = '1'; 
					$log['status_text']= __('System error (code: validreq)','premium');
					echo json_encode($log);
					exit;
				}
			} 		
			
		}
	}
}