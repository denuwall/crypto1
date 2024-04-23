<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pincode_login_form')){
	add_action('login_form', 'pincode_login_form' );
	add_action('newadminpanel_form', 'pincode_login_form');
	function pincode_login_form(){ 
		global $premiumbox;
		
		$pincode = intval($premiumbox->get_option('pincode'));
		if($pincode){
			$temp = '
			<div style="font-weight: 500; padding: 0 0 3px 0;">
				'. __('Personal PIN code','pn') .':
			</div>
			<div style="padding: 0 0 10px 0;">
				<input type="password" class="input" name="user_pin" autocomplete="off" value="" />
			</div>
			';
			
			echo $temp;
		}
	}
}

if(!function_exists('pincode_get_form_filelds')){
	add_filter('get_form_filelds', 'pincode_get_form_filelds', 0, 2);
	function pincode_get_form_filelds($items, $place=''){
		global $premiumbox;
		if($place == 'loginform'){
			$pincode = intval($premiumbox->get_option('pincode'));
			if($pincode){
				$items['user_pin'] = array(
					'name' => 'user_pin',
					'title' => __('Personal PIN code', 'pn'),
					'placeholder' => '',
					'req' => 0,
					'value' => '',
					'type' => 'password',
					'not_auto' => 0,
				);
			}
		}
		
		return $items;
	}
}	

if(!function_exists('pincode_login_check')){
	add_filter('authenticate', 'pincode_login_check', 70, 1);
	function pincode_login_check($user){
		global $premiumbox;
		if(is_object($user) and isset($user->data->ID)){
			if(!defined('PN_ADMIN_GOWP') or defined('PN_ADMIN_GOWP') and constant('PN_ADMIN_GOWP') != 'true'){
				$pincode = intval($premiumbox->get_option('pincode'));
				if($pincode){
					
					$user_id = $user->data->ID;
					$old_user_browser = $user->data->user_browser;
					$old_user_ip = $user->data->user_ip;
					$bd_user_pin = $user->data->user_pin;
					$enable_pin = $user->data->enable_pin;
					
					$user_browser = pn_maxf(pn_strip_input(is_isset($_SERVER,'HTTP_USER_AGENT')),500);
					$user_ip = pn_real_ip();
					$user_pin = pn_strip_input(is_param_post('user_pin'));
					
					$check_pin = 0;
					if($enable_pin == 1){
						$check_pin = 1;
					} elseif($enable_pin == 2){
						if($user_ip != $old_user_ip){
							$check_pin = 1;
						}
					} elseif($enable_pin == 3){	
						if($user_browser != $old_user_browser){
							$check_pin = 1;
						}	
					} elseif($enable_pin == 4){	
						if($user_ip != $old_user_ip or $user_browser != $old_user_browser){
							$check_pin = 1;
						}				
					}
					
					if($check_pin and !$user_pin){

						$error = new WP_Error();
						$error->add( 'pn_error',__('Please enter your personal PIN code','pn'));
						wp_clear_auth_cookie();			
						return $error;
					
					}
					
					if($check_pin and $user_pin and $bd_user_pin != $user_pin){
					
						$error = new WP_Error();
						$error->add( 'pn_error',__('Error! Personal PIN code incorrect','pn'));
						wp_clear_auth_cookie();			
						return $error;							
					
					}
					
				}
			}
		}
		
		return $user;
	}
	
	add_filter('pn_config_option', 'pincode_config_option');
	function pincode_config_option($options){
	global $premiumbox;
		
		$options['line3'] = array(
			'view' => 'line',
			'colspan' => 2,
		);	
		$options['pincode'] = array(
			'view' => 'select',
			'title' => __('Allow setting personal PIN code', 'pn'),
			'default' => $premiumbox->get_option('pincode'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'name' => 'pincode',
			'work' => 'int',
		);	
		
		return $options;
	}

	add_action('pn_config_option_post', 'pincode_config_option_post');
	function pincode_config_option_post($data){
	global $premiumbox;
	
		$pincode = intval($data['pincode']);
		$premiumbox->update_option('pincode','',$pincode);
	}	
	
}