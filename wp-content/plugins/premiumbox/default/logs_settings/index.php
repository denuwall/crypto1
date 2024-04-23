<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'admin_menu_logssettings');
function admin_menu_logssettings(){
global $premiumbox;	
	add_submenu_page("pn_config", __('Logging settings','pn'), __('Logging settings','pn'), 'administrator', "pn_logs_settings", array($premiumbox, 'admin_temp'));
}	
	
add_action('pn_adminpage_title_pn_logs_settings', 'def_adminpage_title_pn_logs_settings');
function def_adminpage_title_pn_logs_settings(){
	_e('Logging settings','pn');
}	
	
add_action('pn_adminpage_content_pn_logs_settings','def_pn_adminpage_content_pn_logs_settings');
function def_pn_adminpage_content_pn_logs_settings(){
global $premiumbox;
		
	$options = array();	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Logging settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	
	$lists = apply_filters('list_logs_settings', array());	
	if(is_array($lists)){
		foreach($lists as $list_key => $list_data){
			$default = intval($premiumbox->get_option('logssettings', $list_key));
			if(!$default){ $default = intval(is_isset($list_data,'count')); }
			$options[] = array(
				'view' => 'input',
				'title' => is_isset($list_data,'title'),
				'default' => $default,
				'name' => $list_key,				
			);			
		}
	}
	
	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_logs_settings_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
		
}

add_action('premium_action_pn_logs_settings','def_premium_action_pn_logs_settings');
function def_premium_action_pn_logs_settings(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));

	$form = new PremiumForm();
	
	$lists = apply_filters('list_logs_settings', array());	
	if(is_array($lists)){
		foreach($lists as $list_key => $list_data){
			$minimum = intval(is_isset($list_data,'minimum'));
			$now = intval(is_param_post($list_key));
			if($now < $minimum){ $now = $minimum; }
			$premiumbox->update_option('logssettings', $list_key, $now);	
		}
	}		

	$back_url = admin_url('admin.php?page=pn_logs_settings&reply=true');
	$form->answer_form($back_url);
}		