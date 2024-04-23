<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_userwallets_verify_settings', 'def_adminpage_title_pn_userwallets_verify_settings');
function def_adminpage_title_pn_userwallets_verify_settings(){
	_e('Settings','pn');
} 

add_action('pn_adminpage_content_pn_userwallets_verify_settings','def_adminpage_content_pn_userwallets_verify_settings');
function def_adminpage_content_pn_userwallets_verify_settings(){
global $premiumbox;	
	
	$form = new PremiumForm();
	
	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);		
	$options['acc_status'] = array(
		'view' => 'select',
		'title' => __('Allow send request','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('usve','acc_status'),
		'name' => 'acc_status',
	);
	$options['disable_mtype_check'] = array(
		'view' => 'select',
		'title' => __('Additional security check when images are uploaded','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('usve','disable_mtype_check'),
		'name' => 'disable_mtype_check',
	);			
	$params_form = array(
		'filter' => 'pn_userwallets_verify_settings_adminform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);		
	
} 

add_action('premium_action_pn_userwallets_verify_settings','def_premium_action_pn_userwallets_verify_settings');
function def_premium_action_pn_userwallets_verify_settings(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator','pn_userwallets'));
	
	$form = new PremiumForm();

	$options = array('acc_status', 'disable_mtype_check');
	foreach($options as $key){
		$val = is_sum(is_param_post($key));
		$premiumbox->update_option('usve',$key,$val);
	}			
			
	do_action('pn_userwallets_verify_settings_adminform_post');
			
	$url = admin_url('admin.php?page=pn_userwallets_verify_settings&reply=true');
	$form->answer_form($url);
}	 