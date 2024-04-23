<?php
if( !defined( 'ABSPATH')){ exit(); }
 
add_action('pn_adminpage_quicktags_page','pn_adminpage_quicktags_page_contact');
function pn_adminpage_quicktags_page_contact(){
?>
edButtons[edButtons.length] = 
new edButton('premium_contact', '<?php _e('Contact form','pn'); ?>','[contact_form]');
<?php	
}

add_filter('list_admin_notify','list_admin_notify_contactform');
function list_admin_notify_contactform($places_admin){
	$places_admin['contactform'] = __('Contact form','pn');
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_contactform');
function list_user_notify_contactform($places_admin){
	$places_admin['contactform_auto'] = __('Auto-responder (contact form)','pn');
	return $places_admin;
}

add_filter('list_notify_tags_contactform','def_mailtemp_tags_contactform');
add_filter('list_notify_tags_contactform_auto','def_mailtemp_tags_contactform');
function def_mailtemp_tags_contactform($tags){
	
	$tags['name'] = __('Your name','pn');
	$tags['exchange_id'] = __('Exchange ID','pn');
	$tags['text'] = __('Text','pn');
	$tags['email'] = __('Your e-mail','pn');
	$tags['link'] = __('Reply link','pn');
	$tags['ip'] = __('IP address','pn');
	
	return $tags;
}

function pn_contact_form_shortcode($atts) {
	
	$temp = '';
	
 	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$items = get_contact_form_filelds();
	$html = prepare_form_fileds($items, 'contact_form_line', 'cf');
	
	$array = array(
		'[form]' => '<form method="post" class="ajax_post_form" action="'. get_ajax_link('contactform') .'">',
		'[/form]' => '</form>',
		'[result]' => '<div class="resultgo"></div>',
		'[html]' => $html,
		'[submit]' => '<input type="submit" formtarget="_top" name="submit" class="cf_submit" value="'. __('Send a message', 'pn') .'" />',
	);	
	
	$temp = '
	<div class="cf_div_wrap">
	[form]

		<div class="cf_div_title">
			<div class="cf_div_title_ins">
				'. __('Contact form','pn') .'
			</div>
		</div>
	
		<div class="cf_div">
			<div class="cf_div_ins">
				
				[html]
				
				<div class="cf_line has_submit">
					[submit]
				</div>
				
				[result]
				
			</div>
		</div>
	
	[/form]
	</div>
	';
	
	$temp = apply_filters('contact_form_temp',$temp);
	$temp = get_replace_arrays($array, $temp);
	
	return $temp;
}
add_shortcode('contact_form', 'pn_contact_form_shortcode');

add_action('myaction_site_contactform', 'def_myaction_ajax_contactform');
function def_myaction_ajax_contactform(){
global $or_site_url, $premiumbox;	
	
	only_post();
	
	$log = array();
	$log['response'] = '';
	$log['status'] = '';
	$log['status_code'] = 0;
	$log['status_text'] = '';
	$log['errors'] = array();
	
	$premiumbox->up_mode();
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$log = apply_filters('before_ajax_form_field', $log, 'contactform');
	$log = apply_filters('before_ajax_contactform', $log);
	
	$parallel_error_output = get_parallel_error_output();
	
	$name = pn_maxf_mb(pn_strip_input(is_param_post('name')), 150);
	$email = is_email(is_param_post('email'));
	$exchange_id = pn_maxf_mb(pn_strip_input(is_param_post('exchange_id')), 300);
	$text = pn_maxf_mb(pn_strip_input(is_param_post('text')), 2000);
	
	$field_errors = array();
	
	if(mb_strlen($name) < 2){
		$field_errors[] = __('Error! You must enter your name','pn');	
	}
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if(!$email){
			$field_errors[] = __('Error! You must enter your e-mail','pn');
		}	
	}
	if(count($field_errors) == 0 or $parallel_error_output == 1){
		if(mb_strlen($text) < 3){
			$field_errors[] = __('Error! You must enter a message','pn');
		}
	}	
	
	if(count($field_errors) == 0){
		
		$notify_tags = array();
		$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
		$notify_tags['[name]'] = $name;
		$notify_tags['[user]'] = $name;
		$notify_tags['[email]'] = $email;
		$notify_tags['[text]'] = $text;
		$notify_tags['[ip]'] = pn_real_ip();
		$notify_tags['[exchange_id]'] = $exchange_id;
		$notify_tags['[idz]'] = $exchange_id;
		$notify_tags['[link]'] = '<a href="mailto:'. $email .'?subject=[subject]">'. __('Reply','pn') .'</a>';
		$notify_tags = apply_filters('notify_tags_contactform', $notify_tags, $ui);		

		$user_send_data = array();
		$result_mail = apply_filters('premium_send_message', 0, 'contactform', $notify_tags, $user_send_data); 
		
		$notify_tags = apply_filters('notify_tags_contactform_auto', $notify_tags, $ui);
		
		$user_send_data = array(
			'user_email' => $email,
			'user_phone' => is_isset($ui, 'user_phone'),
		);	
		$result_mail = apply_filters('premium_send_message', 0, 'contactform_auto', $notify_tags, $user_send_data);
		
		$log['status'] = 'success_clear';
		$log['status_text'] = apply_filters('ajax_contactform_success_message',__('Your message has been successfully sent','pn'));		
		
	} else {
		
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = join("<br />", $field_errors);
		
	}
	
	echo json_encode($log);
	exit;
}