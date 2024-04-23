<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Orders status log[:en_US][ru_RU:]Лог статусов заявок[:ru_RU]
description: [en_US:]Orders status log[:en_US][ru_RU:]Лог статусов заявок[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

/* BD */
add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_bidlogs');
function bd_pn_moduls_active_bidlogs(){
global $wpdb;	
	
	$table_name= $wpdb->prefix ."bid_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`createdate` datetime NOT NULL,
		`bid_id` bigint(20) NOT NULL default '0',
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(150) NOT NULL,
		`old_status` varchar(150) NOT NULL,
		`new_status` varchar(150) NOT NULL,
		`place` varchar(50) NOT NULL,
		`who` varchar(50) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."bid_logs LIKE 'who'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."bid_logs ADD `who` varchar(50) NOT NULL");
	}	
	
}
/* end BD */
 
add_action('pn_bd_activated', 'bd_pn_moduls_migrate_bidlogs');
function bd_pn_moduls_migrate_bidlogs(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."bid_logs LIKE 'who'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."bid_logs ADD `who` varchar(50) NOT NULL");
	}
}

add_action('admin_menu', 'pn_adminpage_bidlogs', 12);
function pn_adminpage_bidlogs(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_bids')){
		$hook = add_submenu_page("pn_bids", __('Orders status log','pn'), __('Orders status log','pn'), 'read', "pn_bidlogs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
	}
}

add_action('change_bidstatus_all','bidlogs_change_bidstatus_all',2,5); 
function bidlogs_change_bidstatus_all($new_status, $item_id, $item, $place='', $system=''){
global $wpdb;
	
	if($new_status == 'autodelete'){
		$wpdb->query("DELETE FROM ".$wpdb->prefix."bid_logs WHERE bid_id = '$item_id'");
	} else {
		$status = $item->status;
		if($status != $new_status){
			$ui = wp_get_current_user();
			$user_id = intval($ui->ID);		
			
			$arr = array();
			$arr['createdate'] = current_time('mysql');
			$arr['bid_id'] = $item_id;
			$arr['user_id'] = $user_id;
			$arr['user_login'] = is_isset($ui,'user_login');
			$arr['old_status'] = is_status_name($status);
			$arr['new_status'] = is_status_name($new_status);
			$arr['place'] = pn_strip_input($place);
			$arr['who'] = pn_strip_input($system);
			$wpdb->insert($wpdb->prefix.'bid_logs', $arr);
		}
	}
	
}

function delete_bidlogs(){
global $wpdb, $premiumbox;

	$count_day = intval($premiumbox->get_option('logssettings', 'delete_bidlogs_day'));
	if(!$count_day){ $count_day = 60; }

	$count_day = apply_filters('delete_bidlogs_day', $count_day);
	if($count_day > 0){
		$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
		$ldate = date('Y-m-d H:i:s', $time);
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix."bid_logs WHERE createdate < '$ldate'");
	}
} 

add_filter('list_cron_func', 'delete_bidlogs_list_cron_func');
function delete_bidlogs_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_bidlogs'] = array(
			'title' => __('Deleting old orders status log','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'bidlogs_list_logs_settings');
function bidlogs_list_logs_settings($filters){
			
	$filters['delete_bidlogs_day'] = array(
		'title' => __('Deleting old orders status log','pn') .' ('. __('days','pn') .')',
		'count' => 60,
		'minimum' => 1,
	);
		
	return $filters;
} 

function bidlogs_status($status){

	$status_name = '';
	if($status == 'realdelete'){
		$status_name = __('Complete removal','pn'); /* т.е. не удаленная, а уничтоженная */
	} elseif($status == 'archived'){ 	
		$status_name = __('Archived','pn'); /* т.е. ушла в архив */
	} else {
		$status_name = get_bid_status($status);
	}
	
	return '<span class="stname st_'. is_status_name($status) .'">'. $status_name .'</span>';
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'list');