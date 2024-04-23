<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Widget for checking order status[:en_US][ru_RU:]Виджет для проверки статуса заявки[:ru_RU]
description: [en_US:]Widget for checking order status[:en_US][ru_RU:]Виджет для проверки статуса заявки[:ru_RU]
version: 1.5
category: [en_US:]Settings[:en_US][ru_RU:]Настройки[:ru_RU]
cat: sett
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

/* BD */
add_filter('pn_tech_pages', 'list_tech_pages_checkstatus');
function list_tech_pages_checkstatus($pages){
 
	$pages[] = array(
		'post_name'      => 'checkstatus',
		'post_title'     => '[en_US:]Check order status[:en_US][ru_RU:]Проверка статуса заявки[:ru_RU]',
		'post_content'   => '[checkstatus_form]',
		'post_template'   => 'pn-pluginpage.php',
	);	
	
	return $pages;
}
/* end BD */

add_filter('placed_captcha', 'placed_captcha_checkstatus');
function placed_captcha_checkstatus($placed){
	$placed['checkstatusform'] = __('Check order status','pn');
	return $placed;
}

function get_checkstatus_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();	
	$items['exchange_id'] = array(
		'name' => 'exchange_id',
		'title' => __('Exchange ID', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => '', 
		'type' => 'input',
		'not_auto' => 0,
	);	
	$items['email'] = array(
		'name' => 'email',
		'title' => __('Your e-mail', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => is_email(is_isset($ui,'user_email')),
		'type' => 'input',
		'not_auto' => 0,
	);
	$items = apply_filters('get_form_filelds', $items, 'checkstatusform', $ui, $place);
	$items = apply_filters('checkstatus_form_filelds',$items, $ui, $place);	
	
	return $items;
}

global $premiumbox;
$premiumbox->auto_include($path.'/shortcode');
$premiumbox->file_include($path.'/widget/check');