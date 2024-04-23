<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Currency reserve auto update (Cron)[:en_US][ru_RU:]Автообновление резервов валют (по Cron)[:ru_RU]
description: [en_US:]Currency reserve auto update (Cron)[:en_US][ru_RU:]Автообновление резервов валют (по Cron)[:ru_RU]
version: 1.5
category: [en_US:]Currency[:en_US][ru_RU:]Валюты[:ru_RU]
cat: currency
*/

add_filter('currency_manage_ap_columns', 'cres_currency_manage_ap_columns');
function cres_currency_manage_ap_columns($columns){
	$columns['cres'] = __('Cron Link','pn');
	return $columns;
}

add_filter('currency_manage_ap_col', 'currency_valuts_manage_ap_col', 10, 3);
function currency_valuts_manage_ap_col($html, $column_name, $item){
	if($column_name == 'cres'){
		return '<a href="'. get_site_url_or(). '/request-cres.html?id='. $item->id . get_hash_cron('&') .'" class="button" target="_blank">'. __('Link','pn') .'</a>'; 
	}
	return $html;
}

add_action('myaction_request_cres','cres_request_cron');
function cres_request_cron(){
global $wpdb;	

	$data_id = intval(is_param_get('id'));
	if($data_id and check_hash_cron() and function_exists('update_currency_reserv')){	
		update_currency_reserv($data_id);	
	}	
	_e('Done','pn');
}