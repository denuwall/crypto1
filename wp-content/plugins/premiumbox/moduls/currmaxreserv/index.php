<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Displayed value of the currency reserve[:en_US][ru_RU:]Отображаемое значение резерва валюты[:ru_RU]
description: [en_US:]Displayed value of the currency reserve[:en_US][ru_RU:]Отображаемое значение резерва валюты[:ru_RU]
version: 1.5
category: [en_US:]Currency[:en_US][ru_RU:]Валюты[:ru_RU]
cat: currency
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_currmaxreserv');
function bd_pn_moduls_active_currmaxreserv(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'max_reserv'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `max_reserv` varchar(50) NOT NULL default '0'");
    }
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_currmaxreserv');
function bd_pn_moduls_migrate_currmaxreserv(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'max_reserv'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `max_reserv` varchar(50) NOT NULL default '0'");
    }
}

add_filter('list_export_currency', 'currmaxreserv_list_export_currency');
function currmaxreserv_list_export_currency($array){
	$array['max_reserv'] = __('Displayed value of the currency reserve','pn');
	return $array;
}

add_filter('export_currency_filte', 'currmaxreserv_export_currency_filte');
function currmaxreserv_export_currency_filte($export_filter){
	$export_filter['sum_arr']['max_reserv'] = 'max_reserv';
	return $export_filter;
}

add_filter('pn_currency_addform', 'currmaxreserv_pn_currency_addform', 10, 2);
function currmaxreserv_pn_currency_addform($options, $data){
	
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options[] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['max_reserv'] = array(
		'view' => 'input',
		'title' => __('Displayed value of the currency reserve','pn'),
		'default' => is_isset($data, 'max_reserv'),
		'name' => 'max_reserv',
	);
	
	return $options;
}

add_filter('pn_currency_addform_post', 'currmaxreserv_currency_addform_post');
function currmaxreserv_currency_addform_post($array){
	$array['max_reserv'] = is_sum(is_param_post('max_reserv'));	
	return $array;
}

add_filter('get_currency_reserv', 'get_currency_reserv_currmaxreserv', 10, 3);
function get_currency_reserv_currmaxreserv($reserv, $data, $decimal){
	$max = is_sum($data->max_reserv);
	if($max > 0){
		if($reserv > $max){
			$reserv = $max;
		}
	}			
	return is_sum($reserv, $decimal);
}										