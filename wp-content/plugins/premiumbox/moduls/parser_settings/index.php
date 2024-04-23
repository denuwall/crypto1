<?php
if( !defined( 'ABSPATH')){ exit(); }
	
/*
title: [en_US:]Rates parser 2.0[:en_US][ru_RU:]Парсер курсов 2.0[:ru_RU]
description: [en_US:]Rates parser 2.0[:en_US][ru_RU:]Парсер курсов 2.0[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/	
	
$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_newparser');
function bd_pn_moduls_active_newparser(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'new_parser'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `new_parser` bigint(20) NOT NULL default '0'");
    }		
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'new_parser_actions_give'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `new_parser_actions_give` varchar(150) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'new_parser_actions_get'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `new_parser_actions_get` varchar(150) NOT NULL default '0'");
    }
	
	$table_name = $wpdb->prefix ."parser_pairs";
	$sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`title_pair_give` varchar(150) NOT NULL,
		`title_pair_get` varchar(150) NOT NULL,
		`title_birg` longtext NOT NULL,
		`pair_give` longtext NOT NULL,
		`pair_get` longtext NOT NULL,
		`menu_order` bigint(20) NOT NULL default '0', 
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}	

add_action('admin_menu', 'pn_adminpage_newparser');
function pn_adminpage_newparser(){
global $premiumbox;
	
	add_menu_page(__('Parsers 2.0','pn'), __('Parsers 2.0','pn'), 'administrator', 'pn_new_parser', array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('parser'));  
	add_submenu_page("pn_new_parser", __('Rates sources','pn'), __('Rates sources','pn'), 'administrator', "pn_new_parser", array($premiumbox, 'admin_temp'));
	$hook = add_submenu_page("pn_new_parser", __('Rates','pn'), __('Rates','pn'), 'administrator', "pn_parser_pairs", array($premiumbox, 'admin_temp'));	
	add_action( "load-$hook", 'pn_trev_hook' );
	add_submenu_page("pn_new_parser", __('Add rate','pn'), __('Add rate','pn'), 'administrator', "pn_add_parser_pairs", array($premiumbox, 'admin_temp'));
	add_submenu_page("pn_new_parser", __('Sorting rates','pn'), __('Sorting rates','pn'), 'administrator', "pn_sort_parser_pairs", array($premiumbox, 'admin_temp'));
	add_submenu_page("pn_new_parser", __('Settings','pn'), __('Settings','pn'), 'administrator', "pn_settings_new_parser", array($premiumbox, 'admin_temp'));
	
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'birg_filters');
$premiumbox->include_patch(__FILE__, 'parser');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'sort');
$premiumbox->include_patch(__FILE__, 'filters');
$premiumbox->include_patch(__FILE__, 'settings');
$premiumbox->include_patch(__FILE__, 'cron');

$premiumbox->auto_include($path.'/widget');