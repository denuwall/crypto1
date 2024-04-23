<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]BestChange parser[:en_US][ru_RU:]BestChange парсер[:ru_RU]
description: [en_US:]BestChange parser[:en_US][ru_RU:]BestChange парсер[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_bcbroker');
add_action('pn_bd_activated', 'bd_pn_moduls_active_bcbroker');
function bd_pn_moduls_active_bcbroker(){
global $wpdb;	
	 	
	$table_name = $wpdb->prefix ."bcbroker_currency_codes";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`currency_code_id` bigint(20) NOT NULL default '0',
		`currency_code_title` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
	$table_name = $wpdb->prefix ."bcbroker_directions";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`direction_id` bigint(20) NOT NULL default '0',
		`currency_id_give` bigint(20) NOT NULL default '0',
		`currency_id_get` bigint(20) NOT NULL default '0',
		`v1` bigint(20) NOT NULL default '0',
		`v2` bigint(20) NOT NULL default '0',
		`now_sort` int(1) NOT NULL default '0',
		`name_column` int(20) NOT NULL default '0',
		`pars_position` bigint(20) NOT NULL default '0',
		`min_res` varchar(250) NOT NULL default '0',
		`step` varchar(250) NOT NULL default '0',
		`reset_course` int(1) NOT NULL default '0',
		`standart_course_give` varchar(250) NOT NULL default '0',
		`standart_course_get` varchar(250) NOT NULL default '0',
		`min_sum` varchar(250) NOT NULL default '0',
		`max_sum` varchar(250) NOT NULL default '0',
		`standart_parser` bigint(20) NOT NULL default '0',
		`standart_parser_actions_give` varchar(150) NOT NULL default '0',
		`standart_parser_actions_get` varchar(150) NOT NULL default '0',
		`minsum_parser` bigint(20) NOT NULL default '0',
		`minsum_parser_actions` varchar(150) NOT NULL default '0',
		`maxsum_parser` bigint(20) NOT NULL default '0',
		`maxsum_parser_actions` varchar(150) NOT NULL default '0',		
		`standart_new_parser` bigint(20) NOT NULL default '0',
		`standart_new_parser_actions_give` varchar(150) NOT NULL default '0',
		`standart_new_parser_actions_get` varchar(150) NOT NULL default '0',
		`minsum_new_parser` bigint(20) NOT NULL default '0',
		`minsum_new_parser_actions` varchar(150) NOT NULL default '0',
		`maxsum_new_parser` bigint(20) NOT NULL default '0',
		`maxsum_new_parser_actions` varchar(150) NOT NULL default '0',		
		`status` int(1) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);		
		
}	

add_action('admin_menu', 'pn_adminpage_bcparser');
function pn_adminpage_bcparser(){
global $premiumbox;
	
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		add_menu_page(__('BestChange parser','pn'), __('BestChange parser','pn'), 'read', "pn_bc_parser", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('parser'));
		add_submenu_page("pn_bc_parser", __('Settings','pn'), __('Settings','pn'), 'read', "pn_bc_parser", array($premiumbox, 'admin_temp'));
		$hook = add_submenu_page("pn_bc_parser", __('Adjustments','pn'), __('Adjustments','pn'), 'read', "pn_bc_adjs", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_bc_parser", __('Add adjustment','pn'), __('Add adjustment','pn'), 'read', "pn_bc_add_adjs", array($premiumbox, 'admin_temp'));
	}
	
}

add_action('update_direction_bcparser', 'def_update_direction_bcparser', 10, 8);
function def_update_direction_bcparser($direction_id, $arr, $data, $rat, $options, $direction, $vd1, $vd2){
global $wpdb;

	$wpdb->update($wpdb->prefix."directions", $arr, array('id'=> $direction_id));	
	do_action('direction_change_course', $direction_id, $direction, $arr['course_give'], $arr['course_get'], 'bestchange');
	
}

global $premiumbox;
$premiumbox->file_include($path.'/api');
$premiumbox->file_include($path.'/filters');
$premiumbox->file_include($path.'/settings');
$premiumbox->file_include($path.'/list');
$premiumbox->file_include($path.'/add');