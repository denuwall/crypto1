<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Initial request ID set up[:en_US][ru_RU:]Установка начального ID заявки[:ru_RU]
description: [en_US:]Initial request ID set up[:en_US][ru_RU:]Установка начального ID заявки[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('admin_menu', 'pn_adminpage_setbidid');
function pn_adminpage_setbidid(){
global $premiumbox;	
	add_submenu_page("pn_moduls", __('Current order ID','pn'), __('Current order ID','pn'), 'administrator', "pn_setbidid", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_setbidid', 'def_adminpage_title_pn_setbidid');
function def_adminpage_title_pn_setbidid($page){
	_e('Current order ID','pn');
} 

add_action('pn_adminpage_content_pn_setbidid','def_adminpage_content_pn_setbidid');
function def_adminpage_content_pn_setbidid(){
global $wpdb;

	$form = new PremiumForm();

	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Current order ID','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);		
	$options['new_id'] = array(
		'view' => 'input',
		'title' => __('Set new current order ID','pn'),
		'default' => '',
		'name' => 'new_id',
	);	
	
	$params_form = array(
		'filter' => 'pn_setbidid_option',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
}  

add_action('premium_action_pn_setbidid','def_premium_action_pn_setbidid');
function def_premium_action_pn_setbidid(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$new_id = intval(is_param_post('new_id'));
	if($new_id > 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."exchange_bids AUTO_INCREMENT={$new_id};");
	}
	
	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
	$form->answer_form($back_url);
} 