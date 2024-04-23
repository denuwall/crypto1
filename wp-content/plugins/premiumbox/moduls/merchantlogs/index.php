<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]!Do not activate without any reason! Merchant logs[:en_US][ru_RU:]!Не активируйте без необходимости! Логи мерчантов[:ru_RU]
description: [en_US:]!Do not activate without any reason! Logging requests of those merchants who send payment systems right after making a payment.[:en_US][ru_RU:]!Не активируйте без необходимости! Логирование обращений мерчантов, которые присылают платежные системы после оплаты.[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_merchantlogs');
function bd_pn_moduls_active_merchantlogs(){
global $wpdb;	
	
	$table_name= $wpdb->prefix ."merchant_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`createdate` datetime NOT NULL,
		`mdata` longtext NOT NULL,
		`merchant` varchar(150) NOT NULL,
		`ip` varchar(250) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."merchant_logs LIKE 'ip'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."merchant_logs ADD `ip` varchar(250) NOT NULL");
	}	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_merchantlogs');
function bd_pn_moduls_migrate_merchantlogs(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."merchant_logs LIKE 'ip'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."merchant_logs ADD `ip` varchar(250) NOT NULL");
	}
}
 
add_action('admin_menu', 'pn_adminpage_merchantlogs', 13);
function pn_adminpage_merchantlogs(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_bids')){
		$hook = add_submenu_page("pn_bids", __('Merchant log','pn'), __('Merchant log','pn'), 'read', "pn_merchantlogs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );		
	}
}

add_action('merchant_logs','merchantlogs_merchant_logs',10); 
function merchantlogs_merchant_logs($merchant=''){
global $wpdb;
	
	$arr = array();
	$arr['createdate'] = current_time('mysql');
	$arr['mdata'] = pn_strip_input(http_build_query($_REQUEST));
	$arr['merchant'] = is_extension_name($merchant);
	$arr['ip'] = pn_strip_input(pn_real_ip());
	$wpdb->insert($wpdb->prefix.'merchant_logs', $arr);
	
}

function del_merchantlogs(){
global $wpdb, $premiumbox;

	$count_day = intval($premiumbox->get_option('logssettings', 'delete_merchantlogs_day'));
	if(!$count_day){ $count_day = 60; }

	$count_day = apply_filters('delete_merchantlogs_day', $count_day);
	if($count_day > 0){
		$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
		$ldate = date('Y-m-d H:i:s', $time);
		$wpdb->query("DELETE FROM ".$wpdb->prefix."merchant_logs WHERE createdate < '$ldate'");
	}
} 

add_filter('list_cron_func', 'del_merchantlogs_list_cron_func');
function del_merchantlogs_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['del_merchantlogs'] = array(
			'title' => __('Delete merchant log','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'merchantlogs_list_logs_settings');
function merchantlogs_list_logs_settings($filters){
			
	$filters['delete_merchantlogs_day'] = array(
		'title' => __('Delete merchant log','pn') .' ('. __('days','pn') .')',
		'count' => 60,
		'minimum' => 1,
	);
		
	return $filters;
} 

global $premiumbox;
$premiumbox->file_include($path.'/list');