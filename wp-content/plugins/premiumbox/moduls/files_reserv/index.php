<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Currency reserve from file[:en_US][ru_RU:]Парсер резерва из файла[:ru_RU]
description: [en_US:]Currency reserve from file[:en_US][ru_RU:]Парсер резерва из файла[:ru_RU]
version: 1.5
category: [en_US:]Currency[:en_US][ru_RU:]Валюты[:ru_RU]
cat: currency
dependent: naps_reserv
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_filter('reserv_place_list', 'fres_reserv_place_list', 10, 2);
function fres_reserv_place_list($list, $place){
	
	$reservs = get_reserv_fres($place);
	$r=0;
	foreach($reservs as $key => $val){ $r++;
		$list[$key] = sprintf(__('File reserve, line %1s, name %2s','pn'), $r, is_isset($val,'title'));
	}
	
	return $list;
}

add_filter('update_direction_reserv', 'fres_update_direction_reserv', 10, 3);
function fres_update_direction_reserv($ind, $key, $direction_id){
	$name = 'fres';
	if($ind == 0){
		if(strstr($key, $name.'_') == 0){
			$reserv_in_file = get_reserv_fres('direction');		
			$rezerv = '-1';
				if(isset($reserv_in_file[$key])){
					$rezerv = $reserv_in_file[$key]['sum'];
				}		
			if($rezerv != '-1' and function_exists('pm_update_nr')){
				pm_update_nr($direction_id, $rezerv);
			}
			
			return 1;			
		}
	}	
		return $ind;	
}

add_action('update_currency_autoreserv', 'fres_update_currency_autoreserv', 10, 3);
function fres_update_currency_autoreserv($ind, $key, $currency_id){
	$name = 'fres';
	if($ind == 0){
		if(strstr($key, $name.'_')){	
			$reserv_in_file = get_reserv_fres('currency');		
			$rezerv = '-1';
				if(isset($reserv_in_file[$key]) and isset($reserv_in_file[$key]['sum'])){
					$rezerv = $reserv_in_file[$key]['sum'];
				}				
			if($rezerv != '-1' and function_exists('pm_update_vr')){
				pm_update_vr($currency_id, $rezerv);
			}											
						
			return 1;			
		}
	}
			
		return $ind;	
}

function get_reserv_fres($place='currency'){
global $premiumbox;

	$arr = array();
	if($place == 'currency'){
		$url = trim($premiumbox->get_option('fres','url'));
	} else {
		$url = trim($premiumbox->get_option('fres','url2'));
	}
	$name = 'fres';
	if($url){
		$curl = get_curl_parser($url, '', 'moduls', 'fres');
		$string = $curl['output'];
		if(!$curl['err']){
			$lines = explode("\n",$string);
			$r=0;
			foreach($lines as $line){ $r++;
				$pars_line = explode('=',$line);
				if(isset($pars_line[1])){
					$sum = is_sum($pars_line[1]);
					$arr[$name.'_'.$r] = array(
						'title' => $pars_line[0],
						'sum' => $sum,
					);
				}					
			}
		}
	}
	return $arr;
}

add_action('myaction_request_fres','fres_request_cron');
function fres_request_cron(){
global $wpdb, $premiumbox;	

	if(check_hash_cron() and !$premiumbox->is_up_mode()){

		$reserv_in_file = get_reserv_fres('currency');
		$name = 'fres';
		$currencies = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND reserv_place LIKE '{$name}_%'");
		foreach($currencies as $currency){
			$key = $currency->reserv_place;
			$currency_id = $currency->id;
			$rezerv = '-1';
			if(isset($reserv_in_file[$key])){
				$rezerv = $reserv_in_file[$key]['sum'];
			}						
			if($rezerv != '-1' and function_exists('pm_update_vr')){
				pm_update_vr($currency_id, $rezerv);
			}	
		}
		
		$reserv_in_file = get_reserv_fres('direction');
		$name = 'fres';
		
		$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'reserv_place'");
		if ($query == 1){
		
			$directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status = '1' AND reserv_place LIKE '{$name}_%'");
			foreach($directions as $direction){
				$key = $direction->reserv_place;
				$direction_id = $direction->id;
				$rezerv = '-1';
				if(isset($reserv_in_file[$key])){
					$rezerv = $reserv_in_file[$key]['sum'];
				}						
				if($rezerv != '-1' and function_exists('pm_update_nr')){
					pm_update_nr($direction_id, $rezerv);
				}	
			}	
		
		}
	
	}
	
	_e('Done','pn');
}

add_action('admin_menu', 'pn_adminpage_fres');
function pn_adminpage_fres(){
global $premiumbox;	
	
	add_submenu_page("pn_moduls", __('File reserve','pn'), __('File reserve','pn'), 'administrator', "pn_fres", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_fres', 'pn_admin_title_pn_fres');
function pn_admin_title_pn_fres($page){
	_e('File reserve','pn');
} 

add_action('pn_adminpage_content_pn_fres','def_pn_admin_content_pn_fres');
function def_pn_admin_content_pn_fres(){
global $wpdb, $premiumbox;

	$form = new PremiumForm();

	$site_url = get_site_url_or();
	$text = '
	<a href="'. $site_url .'/request-fres.html'. get_hash_cron('?') .'" target="_blank">CRON-file</a>
	';
	$form->substrate($text);
	
	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('File reserve settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['url'] = array(
		'view' => 'inputbig',
		'title' => __('URL of file with reserves for Currency section', 'pn'),
		'default' => $premiumbox->get_option('fres','url'),
		'name' => 'url',
	);
	$options['url2'] = array(
		'view' => 'inputbig',
		'title' => __('URL of file with reserves for Exchange directions section', 'pn'),
		'default' => $premiumbox->get_option('fres','url2'),
		'name' => 'url2',
	);

	$params_form = array(
		'filter' => 'pn_fres_options',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
	
}  

add_action('premium_action_pn_fres','def_premium_action_pn_fres');
function def_premium_action_pn_fres(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();

	$options = array('url', 'url2');	
	foreach($options as $key){
		$premiumbox->update_option('fres', $key, pn_strip_input(is_param_post($key)));
	}				

	$url = admin_url('admin.php?page=pn_fres&reply=true');
	$form->answer_form($url);
} 