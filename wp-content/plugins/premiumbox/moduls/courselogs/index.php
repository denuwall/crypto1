<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Logging changes in exchange rates[:en_US][ru_RU:]Логирование изменения курсов обмена[:ru_RU]
description: [en_US:]Logging changes in exchange rates. Notification window[:en_US][ru_RU:]Логирование изменения курсов обмена. Окно уведомления[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_courselogs');
function bd_pn_moduls_active_courselogs(){
global $wpdb;	
	
	$table_name= $wpdb->prefix ."course_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`createdate` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(150) NOT NULL,
		`naps_id` bigint(20) default '0',
		`v1` bigint(20) NOT NULL default '0',
		`v2` bigint(20) NOT NULL default '0',
		`lcurs1` varchar(150) NOT NULL default '0',
		`lcurs2` varchar(150) NOT NULL default '0',
		`curs1` varchar(150) NOT NULL default '0',
		`curs2` varchar(150) NOT NULL default '0',		
		`who` varchar(50) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
}
 
add_action('admin_menu', 'pn_adminpage_courselogs', 12);
function pn_adminpage_courselogs(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$hook = add_submenu_page("pn_directions", __('Logging changes in exchange rates','pn'), __('Logging changes in exchange rates','pn'), 'read', "pn_courselogs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_moduls", __('Notification window','pn'), __('Notification window','pn'), 'administrator', "pn_courselogs_settings", array($premiumbox, 'admin_temp'));
	}
}

add_action('direction_change_course','courselogs_direction_change_course',10,5);  
function courselogs_direction_change_course($direction_id, $direction, $curs1, $curs2, $who=''){
global $wpdb;
	
	if(!isset($direction->id)){
		$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status = '1' AND id='$direction_id'");
	}
	if(isset($direction->id)){
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);		
				
		$lcurs1 = is_sum($direction->course_give); 
		$lcurs2 = is_sum($direction->course_get);
 		if($lcurs1 != $curs1 or $lcurs2 != $curs2){
				
			$arr = array();
			$arr['createdate'] = current_time('mysql');
			$arr['naps_id'] = intval($direction_id);
			$arr['user_id'] = intval($user_id);
			$arr['user_login'] = is_isset($ui,'user_login');
			$arr['v1'] = intval($direction->currency_id_give);
			$arr['v2'] = intval($direction->currency_id_get);
			$arr['lcurs1'] = $lcurs1;
			$arr['lcurs2'] = $lcurs2;
			$arr['curs1'] = is_sum($curs1);
			$arr['curs2'] = is_sum($curs2);			
			$arr['who'] = pn_strip_input($who);
			$wpdb->insert($wpdb->prefix . 'course_logs', $arr);
		
		}
	}
}

function del_courselogs(){
global $wpdb, $premiumbox;

	$count_day = intval($premiumbox->get_option('logssettings', 'delete_courselogs_day'));
	if(!$count_day){ $count_day = 60; }

	$count_day = apply_filters('delete_courselogs_day', $count_day);
	if($count_day > 0){
		$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
		$ldate = date('Y-m-d H:i:s', $time);
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix."course_logs WHERE createdate < '$ldate'");
	}
} 

add_filter('list_cron_func', 'del_courselogs_list_cron_func');
function del_courselogs_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['del_courselogs'] = array(
			'title' => __('Deleting logs about changes in rates in direction of exchange','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'courselogs_list_logs_settings');
function courselogs_list_logs_settings($filters){
			
	$filters['delete_courselogs_day'] = array(
		'title' => __('Deleting logs about changes in rates in direction of exchange','pn') .' ('. __('days','pn') .')',
		'count' => 60,
		'minimum' => 1,
	);
		
	return $filters;
}

global $premiumbox;
$premiumbox->file_include($path.'/list');
$premiumbox->file_include($path.'/config');
$premiumbox->file_include($path.'/window');