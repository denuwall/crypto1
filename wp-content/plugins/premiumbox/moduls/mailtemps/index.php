<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]E-mail notifications templates[:en_US][ru_RU:]Шаблоны e-mail уведомлений[:ru_RU]
description: [en_US:]Sender E-mail and sender name used for letters template by default[:en_US][ru_RU:]E-mail отправителя и имя отправителя используемые для шаблонов писем по умолчанию[:ru_RU]
version: 1.5
category: [en_US:]E-mail[:en_US][ru_RU:]E-mail[:ru_RU]
cat: email
*/


add_action('admin_menu', 'pn_adminpage_mailtemps');
function pn_adminpage_mailtemps(){
global $premiumbox;	

	add_submenu_page("pn_mail_temps", __('E-mail settings','pn'), __('E-mail settings','pn'), 'administrator', "pn_mailtemps", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_mailtemps', 'pn_adminpage_title_pn_mailtemps');
function pn_adminpage_title_pn_mailtemps($page){
	_e('E-mail settings','pn');
} 

add_filter('pn_mailtemps_option', 'def_pn_mailtemps_option', 1);
function def_pn_mailtemps_option($options){
global $wpdb, $premiumbox;	
		
	$data = get_option('pn_mailtemp_modul');	
		
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['mail'] = array(
		'view' => 'inputbig',
		'title' => __('Senders e-mail','pn'),
		'default' => is_isset($data, 'mail'),
		'name' => 'mail',
		'work' => 'input',
	);
	$options['mail_warning'] = array(
		'view' => 'warning',
		'default' => __('Use only existing e-mail like info@site.ru','pn'),
	);	
	$options['name'] = array(
		'view' => 'inputbig',
		'title' => __('Sender name','pn'),
		'default' => is_isset($data, 'name'),
		'name' => 'name',
		'work' => 'input',
	);		
		
	return $options;
}

add_action('pn_adminpage_content_pn_mailtemps','pn_adminpage_content_pn_mailtemps');
function pn_adminpage_content_pn_mailtemps(){
global $wpdb;

	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_mailtemps_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form);	
	
}  

add_action('premium_action_pn_mailtemps','def_premium_action_pn_mailtemps');
function def_premium_action_pn_mailtemps(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
		
	$form = new PremiumForm();
	$data = $form->strip_options('pn_mailtemps_option', 'post');
		
	$new_data = array();
	$new_data['mail'] = $data['mail'];
	$new_data['name'] = $data['name'];
	update_option('pn_mailtemp_modul',$new_data);			
		
	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
				
	$form->answer_form($back_url);
} 

add_filter('pn_mail_temps_option', 'mailtemps_pn_mail_temps_option');
function mailtemps_pn_mail_temps_option($options){
	
	if(isset($options['mail'])){
		unset($options['mail']);
	}
	if(isset($options['name'])){
		unset($options['name']);
	}
	if(isset($options['mail_warning'])){
		unset($options['mail_warning']);
	}	
	
	return $options;
}

add_filter('wp_mail', 'mailtemps_wp_mail');
function mailtemps_wp_mail($data){
	
	$d = get_option('pn_mailtemp_modul');
	$mail = pn_strip_input(is_isset($d, 'mail'));
	$name = pn_strip_input(is_isset($d, 'name'));
	if($mail and $name){
		$data['headers'] = "From: $name <". $mail .">\r\n";
	}
	
	return $data;
}