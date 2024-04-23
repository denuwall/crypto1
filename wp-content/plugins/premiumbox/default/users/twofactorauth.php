<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('la_login_check')){
	add_filter( 'authenticate', 'la_login_check', 100, 1 );
	function la_login_check($user){
		global $wpdb;

		if(is_object($user) and isset($user->data->email_login)){
			if(!defined('PN_ADMIN_GOWP') or defined('PN_ADMIN_GOWP') and constant('PN_ADMIN_GOWP') != 'true'){
				$email_login = $user->data->email_login;
				if($email_login == 1){	
				
					$auto_login1 = wp_generate_password( 30 , false, false);
					$auto_login2 = wp_generate_password( 30 , false, false);
					$al1h = pn_crypt_data($auto_login1);
					$al2h = pn_crypt_data($auto_login2);
					$wpdb->update($wpdb->prefix."users", array('auto_login1'=>$al1h,'auto_login2'=>$al2h), array('ID'=>$user->data->ID));
							
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[link]'] = get_ajax_link('laform', 'get') . '&user=' . $user->data->ID . '&h1='. $auto_login1 .'&h2='. $auto_login2;
					$notify_tags = apply_filters('notify_tags_letterauth', $notify_tags, $user->data, $auto_login1, $auto_login2);
				
					$user_send_data = array(
						'user_email' => is_isset($user->data, 'user_email'),
						'user_phone' => is_isset($user->data, 'user_phone'),
					);				
					$result_mail = apply_filters('premium_send_message', 0, 'letterauth', $notify_tags, $user_send_data); 		
					if($result_mail){	
					
						$error = new WP_Error();
						$error->add( 'pn_success', __('We sent you a link needed for your authorization. Check your e-mail.','pn') );
						wp_clear_auth_cookie();
								
						return $error;																			
					}	
				}
			}
		}
			
		return $user;
	}
}

if(!function_exists('def_myaction_ajax_laform')){
	add_action('myaction_site_laform', 'def_myaction_ajax_laform');
	function def_myaction_ajax_laform(){
		global $wpdb, $or_site_url, $premiumbox;
		
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
	
		if(!$user_id){
			$now_user_id = intval(is_param_get('user'));
			$h1 = is_lahash(is_param_get('h1'));
			$h2 = is_lahash(is_param_get('h2'));
			if($now_user_id and $h1 and $h2){
				$user = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."users WHERE ID='$now_user_id'");
				if(isset($user->ID)){
					if(is_pn_crypt($user->auto_login1, $h1) and is_pn_crypt($user->auto_login2, $h2)){
						$wpdb->update($wpdb->prefix."users", array('auto_login1'=>'','auto_login2'=>''), array('ID'=>$user->ID));
						
						$secure_cookie = is_ssl();
						wp_set_auth_cookie($user->ID, true, $secure_cookie);
						wp_set_current_user($user->ID);
						
						if(user_can($user->ID,'read')){
							wp_redirect(admin_url('index.php'));
						} else {
							$url = apply_filters('login_auth_redirect', $premiumbox->get_page('account'));
							wp_redirect($url);
						}
						exit;
					}
				}
			}
		}
			pn_display_mess(__('Attention! Authorisation Error!','pn'), __('Attention! Authorisation Error!','pn'), 'error');
	}
}