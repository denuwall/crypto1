<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Mobile version[:en_US][ru_RU:]Мобильная версия[:ru_RU]
description: [en_US:]Mobile version[:en_US][ru_RU:]Мобильная версия[:ru_RU]
version: 1.5
category: [en_US:]Mobile[:en_US][ru_RU:]Мобильное приложение[:ru_RU]
cat: mobile
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_mobile');
function bd_pn_moduls_active_mobile(){
global $wpdb;	
	
	/*
	mobile - 0 - все, 1-web, 2-мобильная версия
	*/	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'mobile'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `mobile` int(1) NOT NULL default '0'");
    }

	/*
	device - 0 -web, 1-мобильная версия
	*/	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'device'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `device` int(1) NOT NULL default '0'");
    } 	
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_mobile');
function bd_pn_moduls_migrate_mobile(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'mobile'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `mobile` int(1) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'device'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `device` int(1) NOT NULL default '0'");
    }	
}

add_filter('template_include', 'mobile_template_include');
function mobile_template_include($template){
	
	$template = str_replace("\\","/",$template);
	$temp_part = explode('/', $template);
	$replace = end($temp_part);
	$mobile_dir = str_replace($replace, 'mobile/', $template);
	$new_template = str_replace($replace, 'mobile/'.$replace, $template);
	
	if(is_dir($mobile_dir) and is_mobile()){
		if(is_file($new_template)){
			return $new_template;
		} else {
			$file = apply_filters('mobile_template_not_found', $mobile_dir.'index.php', $new_template, $mobile_dir);
			if(is_file($file)){
				return $file;
			}
		}
	}
	
	return $template;
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'includes/functions');
$premiumbox->include_patch(__FILE__, 'includes/detected');
$premiumbox->file_include($path.'/includes/settings'); 
$premiumbox->file_include($path.'/includes/filters');

$premiumbox->file_include($path.'/exchange/index');

$premiumbox->auto_include($path.'/shortcode');