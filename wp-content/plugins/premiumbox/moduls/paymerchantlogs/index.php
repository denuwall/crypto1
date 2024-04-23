<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Automatic payouts log[:en_US][ru_RU:]Лог автовыплат [:ru_RU]
description: [en_US:]Automatic payouts log[:en_US][ru_RU:]Лог автовыплат [:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

/* BD */
add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_paymerchantlogs');
function bd_pn_moduls_active_paymerchantlogs(){
global $wpdb;	
	
	$table_name= $wpdb->prefix ."paymerchant_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`createdate` datetime NOT NULL,
		`bid_id` bigint(20) NOT NULL default '0',
		`mdata` longtext NOT NULL,
		`merchant` varchar(150) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}
/* end BD */
 
add_action('admin_menu', 'pn_adminpage_paymerchantlogs', 13);
function pn_adminpage_paymerchantlogs(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_bids')){
		$hook = add_submenu_page("pn_bids", __('Automatic payouts log','pn'), __('Automatic payouts log','pn'), 'read', "pn_paymerchantlogs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
	}
}

add_action('paymerchant_error','paymerchantlogs_paymerchant_error',10, 3); 
function paymerchantlogs_paymerchant_error($m_id, $error, $bid_id){
global $wpdb;
	
	if(is_array($error)){ $error = join(',', $error); }
	
	$arr = array();
	$arr['createdate'] = current_time('mysql');
	$arr['mdata'] = pn_strip_input($error);
	$arr['merchant'] = is_extension_name($m_id);
	$arr['bid_id'] = pn_strip_input($bid_id);
	$wpdb->insert($wpdb->prefix.'paymerchant_logs', $arr);
	
}
function del_paymerchantlogs(){
global $wpdb, $premiumbox;

	$count_day = intval($premiumbox->get_option('logssettings', 'delete_paymerchantlogs_day'));
	if(!$count_day){ $count_day = 60; }

	$count_day = apply_filters('delete_paymerchantlogs_day', $count_day);
	if($count_day > 0){
		$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
		$ldate = date('Y-m-d H:i:s', $time);
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix."paymerchant_logs WHERE createdate < '$ldate'");
	}
} 

add_filter('list_cron_func', 'del_paymerchantlogs_list_cron_func');
function del_paymerchantlogs_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['del_paymerchantlogs'] = array(
			'title' => __('Deleting automatic payout logs','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'paymerchantlogs_list_logs_settings');
function paymerchantlogs_list_logs_settings($filters){
			
	$filters['delete_paymerchantlogs_day'] = array(
		'title' => __('Deleting automatic payout logs','pn') .' ('. __('days','pn') .')',
		'count' => 60,
		'minimum' => 1,
	);
		
	return $filters;
} 

global $premiumbox;
$premiumbox->file_include($path.'/list');