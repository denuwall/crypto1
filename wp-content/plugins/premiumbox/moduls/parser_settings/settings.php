<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_settings_new_parser', 'pn_admin_title_pn_settings_new_parser');
function pn_admin_title_pn_settings_new_parser($page){
	_e('Parser settings','pn');
} 

add_action('pn_adminpage_content_pn_settings_new_parser','def_pn_admin_content_pn_settings_new_parser');
function def_pn_admin_content_pn_settings_new_parser(){
global $wpdb, $premiumbox;
	
	$form = new PremiumForm();
	
	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Parser settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['parser'] = array(
		'view' => 'select',
		'title' => __('Parser type','pn'),
		'options' => array('0'=> __('CURL','pn'), '1'=> __('SSH','pn')), //, '2'=> __('From file','pn')
		'default' => $premiumbox->get_option('newparser','parser'),
		'name' => 'parser',
	);	
	// $options['url'] = array(
		// 'view' => 'inputbig',
		// 'title' => __('File URL', 'pn'),
		// 'default' => $premiumbox->get_option('newparser','url'),
		// 'name' => 'url',
	// );
	$options['parser_log'] = array(
		'view' => 'select',
		'title' => __('Logging parsing','pn'),
		'options' => array('0'=> __('No','pn'), '1'=> __('Yes','pn')),
		'default' => $premiumbox->get_option('newparser','parser_log'),
		'name' => 'parser_log',
	);	
	
	$params_form = array(
		'filter' => 'pn_settings_new_parser_options',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
	
}  

add_action('premium_action_pn_settings_new_parser','def_premium_action_pn_settings_new_parser');
function def_premium_action_pn_settings_new_parser(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));

	$form = new PremiumForm();
	
	//$premiumbox->update_option('newparser', 'url', esc_url(is_param_post('url')));
	$premiumbox->update_option('newparser', 'parser', intval(is_param_post('parser')));	
	$premiumbox->update_option('newparser', 'parser_log', intval(is_param_post('parser_log')));

	$url = admin_url('admin.php?page=pn_settings_new_parser&reply=true');
	$form->answer_form($url);
} 