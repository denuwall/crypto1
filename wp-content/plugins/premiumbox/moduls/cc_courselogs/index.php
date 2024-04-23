<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Logging changes in currency code rates[:en_US][ru_RU:]Логирование изменения курсов кодов валют[:ru_RU]
description: [en_US:]Logging changes in currency code rates[:en_US][ru_RU:]Логирование изменения курсов кодов валют[:ru_RU]
version: 1.5
category: [en_US:]Currency[:en_US][ru_RU:]Валюты[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_cccourselogs');
function bd_pn_moduls_active_cccourselogs(){
global $wpdb;	
	
	$table_name= $wpdb->prefix ."currency_codes_course_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(150) NOT NULL,
		`currency_code_id` bigint(20) default '0',
		`currency_code_title` longtext NOT NULL,
		`last_internal_rate` varchar(150) NOT NULL default '0',
		`internal_rate` varchar(150) NOT NULL default '0',		
		`who` varchar(50) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
}
 
add_action('admin_menu', 'pn_adminpage_cccourselogs', 12);
function pn_adminpage_cccourselogs(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_currency_codes')){
		$hook = add_submenu_page("pn_currency_codes", __('Logging changes in exchange rates','pn'), __('Logging changes in exchange rates','pn'), 'read', "pn_cccourselogs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
	}
}

add_action('currency_code_change_course','cccourselogs_currency_code_change_course',10,5);  
function cccourselogs_currency_code_change_course($currency_code_id, $currency_code, $internal_rate, $who=''){
global $wpdb;
	
	if(!isset($currency_code->id)){
		$currency_code = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency_codes WHERE auto_status = '1' AND id='$currency_code_id'");
	}
	if(isset($currency_code->id)){
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);		
				
		$last_internal_rate = is_sum($currency_code->internal_rate); 
 		if($last_internal_rate != $internal_rate){
				
			$arr = array();
			$arr['create_date'] = current_time('mysql');
			$arr['currency_code_id'] = intval($currency_code_id);
			$arr['currency_code_title'] = pn_strip_input($currency_code->currency_code_title);
			$arr['user_id'] = intval($user_id);
			$arr['user_login'] = is_isset($ui,'user_login');
			$arr['last_internal_rate'] = is_sum($last_internal_rate);
			$arr['internal_rate'] = is_sum($internal_rate);			
			$arr['who'] = pn_strip_input($who);
			$wpdb->insert($wpdb->prefix . 'currency_codes_course_logs', $arr);
		
		}
	}
}

function del_cccourselogs(){
global $wpdb, $premiumbox;

	$count_day = intval($premiumbox->get_option('logssettings', 'delete_cccourselogs_day'));
	if(!$count_day){ $count_day = 60; }

	$count_day = apply_filters('delete_cccourselogs_day', $count_day);
	if($count_day > 0){
		$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
		$ldate = date('Y-m-d H:i:s', $time);
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix."currency_codes_course_logs WHERE create_date < '$ldate'");
	}
} 

add_filter('list_cron_func', 'del_cccourselogs_list_cron_func');
function del_cccourselogs_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['del_cccourselogs'] = array(
			'title' => __('Deleting logs about changes in rates in currency codes','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'cccourselogs_list_logs_settings');
function cccourselogs_list_logs_settings($filters){
			
	$filters['delete_cccourselogs_day'] = array(
		'title' => __('Deleting logs about changes in rates in currency codes','pn') .' ('. __('days','pn') .')',
		'count' => 60,
		'minimum' => 1,
	);
		
	return $filters;
} 

global $premiumbox;
$premiumbox->file_include($path.'/list');