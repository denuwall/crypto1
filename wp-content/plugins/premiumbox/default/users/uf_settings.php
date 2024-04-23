<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'admin_menu_uf_settings');
function admin_menu_uf_settings(){
global $premiumbox;	
	
	if(current_user_can('administrator')){
		add_submenu_page('users.php', __('User profile settings','pn'), __('User profile settings','pn'), 'read', 'pn_uf_settings', array($premiumbox, 'admin_temp'));  
	}
}

add_action('pn_adminpage_title_pn_uf_settings', 'def_adminpage_title_pn_uf_settings');
function def_adminpage_title_pn_uf_settings($page){
	_e('User profile settings','pn');
} 

add_action('pn_adminpage_content_pn_uf_settings','def_pn_adminpage_content_pn_uf_settings');
function def_pn_adminpage_content_pn_uf_settings(){
global $wpdb, $premiumbox;

	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Displaying fields on website','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	
	$uf = $premiumbox->get_option('user_fields');
	
	$fields = array(
		'login' => __('Login', 'pn'),
		'last_name' => __('Last name', 'pn'),
		'first_name' => __('First name', 'pn'),
		'second_name' => __('Second name', 'pn'),
		'user_phone' => __('Phone no.', 'pn'),
		'user_skype' => __('Skype', 'pn'),
		'website' => __('Website', 'pn'),
		'user_passport' => __('Passport number', 'pn'),
	);
	
	foreach($fields as $field_key => $field_val){
		$options[$field_key] = array(
			'view' => 'select',
			'title' => sprintf(__('Display "%s" field','pn'), $field_val),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($uf, $field_key),
			'name' => $field_key,
			'work' => 'int',
		);	
	}
	
	$options['center_title'] = array(
		'view' => 'h3',
		'title' => __('Editing fields on website','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);		
	
	$ufc = $premiumbox->get_option('user_fields_change');
	
	$chfields = array(
		'last_name' => __('Last name', 'pn'),
		'first_name' => __('First name', 'pn'),
		'second_name' => __('Second name', 'pn'),
		'user_phone' => __('Phone no.', 'pn'),
		'user_skype' => __('Skype', 'pn'),
		'website' => __('Website', 'pn'),
		'user_passport' => __('Passport number', 'pn'),
		'user_email' => __('E-mail', 'pn'),
	);	
	
	foreach($chfields as $field_key => $field_val){
		$options['ch_'.$field_key] = array(
			'view' => 'select',
			'title' => sprintf(__('Allow user to change "%s" field contents','pn'), $field_val),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($ufc, $field_key),
			'name' => 'ch_'.$field_key,
			'work' => 'int',
		);	
	}	
	
	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_usersettings_config_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
	
} 

add_action('premium_action_pn_uf_settings','def_premium_action_pn_uf_settings');
function def_premium_action_pn_uf_settings(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$fields = array(
		'login' => __('Login', 'pn'),
		'last_name' => __('Last name', 'pn'),
		'first_name' => __('First name', 'pn'),
		'second_name' => __('Second name', 'pn'),
		'user_phone' => __('Phone no.', 'pn'),
		'user_skype' => __('Skype', 'pn'),
		'website' => __('Website', 'pn'),
		'user_passport' => __('Passport number', 'pn'),
	);	
	$fields1 = array();
	foreach($fields as $k => $v){
		$fields1[$k] = intval(is_param_post($k));
	}
	
	$chfields = array(
		'last_name' => __('Last name', 'pn'),
		'first_name' => __('First name', 'pn'),
		'second_name' => __('Second name', 'pn'),
		'user_phone' => __('Phone no.', 'pn'),
		'user_skype' => __('Skype', 'pn'),
		'website' => __('Website', 'pn'),
		'user_passport' => __('Passport number', 'pn'),
		'user_email' => __('E-mail', 'pn'),
	);	
	$fields2 = array();
	foreach($chfields as $k => $v){
		$fields2[$k] = intval(is_param_post('ch_'.$k));
	}	
	
	$premiumbox->update_option('user_fields','',$fields1);
	$premiumbox->update_option('user_fields_change','',$fields2);			
	
	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
		
	$form->answer_form($back_url);				
}