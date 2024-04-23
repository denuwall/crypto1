<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Auto broker of exchange rates[:en_US][ru_RU:]Автоброкер курсов обмена[:ru_RU]
description: [en_US:]Auto broker of exchange rates[:en_US][ru_RU:]Автоброкер курсов обмена[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_blackbroker');
function bd_pn_moduls_active_blackbroker(){
global $wpdb;	
	
	$table_name = $wpdb->prefix ."blackbrokers_naps";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`naps_id` bigint(20) NOT NULL default '0',
		`site_id` bigint(20) NOT NULL default '0',
		`step_column` int(20) NOT NULL default '0',
		`step` varchar(150) NOT NULL default '0',
		`min_sum` varchar(150) NOT NULL default '0',
		`max_sum` varchar(150) NOT NULL default '0',
		`cours1` varchar(150) NOT NULL default '0',
		`cours2` varchar(150) NOT NULL default '0',
		`item_from` varchar(150) NOT NULL,
		`item_to` varchar(150) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$table_name = $wpdb->prefix ."blackbrokers";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`title` longtext NOT NULL,
		`url` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
}

add_action('admin_menu', 'pn_adminpage_blackbroker');
function pn_adminpage_blackbroker(){
global $premiumbox;		
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$hook = add_menu_page( __('Auto broker','pn'), __('Auto broker','pn'), 'read', "pn_blackbroker", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('parser'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_blackbroker", __('Add','pn'), __('Add','pn'), 'read', "pn_add_blackbroker", array($premiumbox, 'admin_temp'));
	}
}

global $premiumbox;
$premiumbox->file_include($path.'/filters'); 
$premiumbox->file_include($path.'/list');
$premiumbox->file_include($path.'/add');
$premiumbox->file_include($path.'/cron');