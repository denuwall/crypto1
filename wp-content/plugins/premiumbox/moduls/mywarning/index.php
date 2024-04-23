<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Maintenance notification[:en_US][ru_RU:]Текст уведомления технического обслуживания[:ru_RU]
description: [en_US:]Maintenance notification[:en_US][ru_RU:]Текст уведомления технического обслуживания[:ru_RU]
version: 1.5
category: [en_US:]Settings[:en_US][ru_RU:]Настройки[:ru_RU]
cat: sett
dependent: -
*/

add_action('admin_menu', 'admin_menu_mywarning');
function admin_menu_mywarning(){
global $premiumbox;	
	
	add_submenu_page("pn_moduls", __('Maintenance message','pn'), __('Maintenance message','pn'), 'administrator', "pn_mywarning", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_mywarning', 'def_adminpage_title_pn_mywarning');
function def_adminpage_title_pn_mywarning($page){
	_e('Maintenance message','pn');
} 

add_action('pn_adminpage_content_pn_mywarning','def_adminpage_content_pn_mywarning');
function def_adminpage_content_pn_mywarning(){
global $wpdb;

	$form = new PremiumForm();

	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['text'] = array(
		'view' => 'textarea',
		'title' => __('Text','pntheme'),
		'default' => get_option('pn_update_plugin_text'),
		'name' => 'text',
		'width' => '',
		'height' => '180px',
		'work' => 'text',
	);		

	$params_form = array(
		'filter' => 'pn_mywarning_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
			
}  

add_action('premium_action_pn_mywarning','def_premium_action_pn_mywarning');
function def_premium_action_pn_mywarning(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$text = pn_strip_text(is_param_post('text'));
	update_option('pn_update_plugin_text', $text);			

	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
			
	$form->answer_form($back_url);	
	
} 