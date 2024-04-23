<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_quicktags_page','adminpage_quicktags_page_register');
function adminpage_quicktags_page_register(){
?>
edButtons[edButtons.length] = 
new edButton('premium_register', '<?php _e('Sign up','pn'); ?>','[register_form]');
<?php	
}

add_filter('list_user_notify','list_user_notify_registerform');
function list_user_notify_registerform($places_admin){
	$places_admin['registerform'] = __('Registration form','pn');
	return $places_admin;
}

add_filter('list_notify_tags_registerform','def_list_notify_tags_registerform');
function def_list_notify_tags_registerform($tags){
	
	$tags['login'] = __('Login','pn');
	$tags['pass'] = __('Password','pn');
	$tags['email'] = __('E-mail','pn');
	
	return $tags;
}

function get_register_formed(){
global $wpdb, $premiumbox;
	
	$temp = '';
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	if(!$user_id){
		
		$items = get_register_form_filelds();
		$html = prepare_form_fileds($items, 'register_form_line', 'reg');
	
		$array = array(
			'[form]' => '<form method="post" class="ajax_post_form" action="'. get_ajax_link('registerform') .'">',
			'[/form]' => '</form>',
			'[result]' => '<div class="resultgo"></div>',
			'[html]' => $html,
			'[submit]' => '<input type="submit" formtarget="_top" name="submit" class="reg_submit" value="'. __('Sign up', 'pn') .'" />',
			'[toslink]' => $premiumbox->get_page('tos'),
			'[loginlink]' => $premiumbox->get_page('login'),
			'[lostpasslink]' => $premiumbox->get_page('lostpass'),
			'[return_link]' => '<input type="hidden" name="return_url" value="'. esc_url(pn_strip_input(is_param_get('return_url'))) .'" />',
			'[agreement]' => '<label><input type="checkbox" name="rcheck" value="1" /> '. sprintf(__('I read and agree with <a href="%s" target="_blank">the terms and conditions</a>','pn'), $premiumbox->get_page('terms') ) .'</label>',
		);	
	
		$temp_form = '
		<div class="reg_div_wrap">
		[form]
			[return_link]
			
			<div class="reg_div_title">
				<div class="reg_div_title_ins">
					'. __('Sign up','pn') .'
				</div>
			</div>
		
			<div class="reg_div">
				<div class="reg_div_ins">
					
					[html]
					
					<div class="reg_line">
						[agreement]
					</div>
					
					<div class="reg_line">
						<div class="reg_line_subm_left">
							[submit]
						</div>
						<div class="reg_line_subm_right">
							<a href="[loginlink]">'. __('Authorization','pn') .'</a>
						</div>
						
						<div class="clear"></div>
					</div>

					[result]
 
				</div>
			</div>

		[/form]
		</div>
		';
	
		$temp_form = apply_filters('register_form_temp',$temp_form);
		$temp .= get_replace_arrays($array, $temp_form);		

	} else {
		$temp .= '<div class="resultfalse">'. __('Error! This form is available for unauthorized users only','pn') .'</div>';
	}
	
	return $temp;
}

function register_form_shortcode($atts, $content) {
	$temp = get_register_formed();	
	return $temp;
}
add_shortcode('register_form', 'register_form_shortcode');

function register_page_shortcode($atts, $content) {
	$temp = apply_filters('before_register_page','');
	$temp .= get_register_formed();
    $temp .= apply_filters('after_register_page','');	
	return $temp;
}
add_shortcode('register_page', 'register_page_shortcode');

add_action('myaction_site_registerform', 'def_myaction_ajax_registerform');
function def_myaction_ajax_registerform(){
global $or_site_url, $wpdb, $premiumbox;	
	
	only_post();
	nocache_headers();
	
	global $myerrors;
	$myerrors = new WP_Error();	
	$secure_cookie = is_ssl();
	
	$log = array();		
	$log['response'] = '';
	$log['status'] = '';
	$log['status_code'] = 0;
	$log['status_text'] = '';
	
	$premiumbox->up_mode();
	
	$log = apply_filters('before_ajax_form_field', $log, 'registerform');
	$log = apply_filters('before_ajax_registerform', $log);
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	if($user_id){
		$log['status'] = 'error'; 
		$log['status_code'] = 1;
		$log['status_text']= __('Error! This form is available for unauthorized users only','pn');
		echo json_encode($log);
		exit;		
	}
	
	$parallel_error_output = get_parallel_error_output();
		
	$user_login = is_user(is_param_post('login'));
	$email = is_email(is_param_post('email'));
	$pass = is_password(is_param_post('pass'));
	$pass2 = is_password(is_param_post('pass2'));
	$rcheck = intval(is_param_post('rcheck'));
	
	$field_errors = array();
	
	if(!$rcheck){
		$field_errors[] = __('Error! You did not agree with our terms and conditions','pn');
	}
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if(!$user_login){
			$field_errors[] = __('Error! You have entered an incorrect username. The username must consist of digits or latin letters and contain from 3 up to 30 characters.','pn');
		}	
	}	
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if(!$email){
			$field_errors[] = __('Error! You have entered an incorrect e-mail','pn');
		}	
	}	
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if(!$pass or $pass != $pass2){
			$field_errors[] = __('Error! Password is incorrect or does not match with the previously entered password','pn');
		}	
	}
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if($user_login and username_exists($user_login)){
			$field_errors[] = __('Error! This login is already in use','pn');
		}	
	}
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if($email and email_exists($email)){
			$field_errors[] = __('Error! This e-mail is already in use','pn');
		}	
	}
	
	if(count($field_errors) == 0){
		
		$user_id = wp_insert_user( array ('user_login' => $user_login, 'user_email' => $email, 'user_pass' => $pass) ) ;
		
		if($user_id){
								
			do_action( 'pn_user_register', $user_id);
								
			$notify_tags = array();
			$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
			$notify_tags['[login]'] = $user_login;
			$notify_tags['[pass]'] = $pass;
			$notify_tags['[email]'] = $email;
			$notify_tags = apply_filters('notify_tags_registerform', $notify_tags, $user_id);		

			$user_send_data = array(
				'user_email' => $email,
				'user_phone' => '',
			);	
			$result_mail = apply_filters('premium_send_message', 0, 'registerform', $notify_tags, $user_send_data); 																
								
			$creds = array();
			$creds['user_login'] = $user_login;
			$creds['user_password'] = $pass;
			$creds['remember'] = true;
			$user = wp_signon($creds, $secure_cookie);	
	
			$return_url = esc_url(pn_strip_input(is_param_post('return_url')));
			if(!$return_url){
				$return_url = $premiumbox->get_page('account');
			}	
	
			if ( $user && !is_wp_error($user) ) {
				$log['status'] = 'success';
				$log['url'] = apply_filters('login_auth_redirect', $return_url);
				$log['status_text'] = apply_filters('ajax_register_success_message', __('You have successfully registered','pn'));
			} else {
				$log['status'] = 'success';
				$log['status_text'] = apply_filters('ajax_register2_success_message', __('You have successfully registered. You can now log into your account','pn'));
			}								
								
		} else {
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('Error! Contact with website admin','pn');							
		}		
		
	} else {
		
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = join("<br />", $field_errors);
		
	}				
	
	echo json_encode($log);
	exit;
}