<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Currency reserve limits[:en_US][ru_RU:]Лимит резерва для валют[:ru_RU]
description: [en_US:]Currency reserve limits[:en_US][ru_RU:]Лимит резерва для валют[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_currlimit');
function bd_pn_moduls_active_currlimit(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inday1'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inday1` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inday2'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inday2` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inmon1'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inmon1` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inmon2'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inmon2` varchar(50) NOT NULL default '0'");
    }
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_currlimit');
function bd_pn_moduls_migrate_currlimit(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inday1'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inday1` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inday2'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inday2` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inmon1'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inmon1` varchar(50) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'inmon2'");
    if ($query == 0) { 
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `inmon2` varchar(50) NOT NULL default '0'");
    }

}

add_filter('list_export_currency', 'currlimit_list_export_currency');
function currlimit_list_export_currency($array){
	
	$array['inday1'] = __('Daily limit for Send','pn');
	$array['inday2'] = __('Daily limit for Receive','pn');
	$array['inmon1'] = __('Monthly limit for Send','pn');
	$array['inmon2'] = __('Monthly limit for Receive','pn');
	
	return $array;
}

add_filter('export_currency_filter', 'currlimit_export_currency_filter');
function currlimit_export_currency_filter($export_currency_filter){
	
	$export_currency_filter['sum_arr'][] = 'inday1';
	$export_currency_filter['sum_arr'][] = 'inday2';
	$export_currency_filter['sum_arr'][] = 'inmon1';
	$export_currency_filter['sum_arr'][] = 'inmon2';
	
	return $export_currency_filter;
}

add_filter('pn_currency_addform', 'currlimit_pn_currency_addform', 10, 2);
function currlimit_pn_currency_addform($options, $data){
	
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
	$options['inday1'] = array(
		'view' => 'input',
		'title' => __('Daily limit for Send','pn'),
		'default' => is_isset($data, 'inday1'),
		'name' => 'inday1',
	);
	$options['inday1_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Daily limit for currency purchase of currency. Unable to buy more currency more than previously set.','pn'),
	);	
	$options['inday2'] = array(
		'view' => 'input',
		'title' => __('Daily limit for Receive','pn'),
		'default' => is_isset($data, 'inday2'),
		'name' => 'inday2',
	);
	$options['inday2_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Daily limit for currency sale. Unable to sell currency more than previously set.','pn'),
	);	
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['inmon1'] = array(
		'view' => 'input',
		'title' => __('Monthly limit for Send','pn'),
		'default' => is_isset($data, 'inmon1'),
		'name' => 'inmon1',
	);
	$options['inmon1_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Monthly limit for currency purchase. Unable to buy currency more than previously set.','pn'),
	);		
	$options['inmon2'] = array(
		'view' => 'input',
		'title' => __('Monthly limit for Receive','pn'),
		'default' => is_isset($data, 'inmon2'),
		'name' => 'inmon2',
	);
	$options['inmon2_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Monthly limit for currency sale. Unable to sell currency more than previously set.','pn'),
	);		
	
	return $options;
}

add_filter('pn_currency_addform_post', 'currlimit_currency_addform_post');
function currlimit_currency_addform_post($array){
	
	$array['inday1'] = is_sum(is_param_post('inday1'));
	$array['inday2'] = is_sum(is_param_post('inday2'));
	$array['inmon1'] = is_sum(is_param_post('inmon1'));
	$array['inmon2'] = is_sum(is_param_post('inmon2'));	
	
	return $array;
}

add_filter('currency_manage_ap_columns', 'currlimit_currency_manage_ap_columns');
function currlimit_currency_manage_ap_columns($columns){
	$new = array();
	foreach($columns as $k => $v){
		$new[$k] = $v;
		if($k == 'decimal'){
			$new['inday1'] = __('Daily limit for Send','pn');
			$new['inday2'] = __('Daily limit for Receive','pn');
		}
	}
	return $new;
}

add_filter('currency_manage_ap_col', 'currlimit_currency_manage_ap_col', 10, 3);
function currlimit_currency_manage_ap_col($html, $column_name, $item){
	
	if($column_name == 'inday1'){		
		return '<input type="text" style="width: 80px;" name="inday1['. $item->id .']" value="'. is_sum($item->inday1) .'" />';
	} elseif($column_name == 'inday2'){		
		return '<input type="text" style="width: 80px;" name="inday2['. $item->id .']" value="'. is_sum($item->inday2) .'" />';		
	}
	
	return $html;
}

add_action('pn_currency_save', 'currlimit_pn_currency_save');
function currlimit_pn_currency_save(){
global $wpdb;

	if(isset($_POST['inday1']) and is_array($_POST['inday1'])){ 	
		foreach($_POST['inday1'] as $id => $inday1){
			$id = intval($id);
			$inday1 = is_sum($inday1);
			if($inday1 <= 0){ $inday1 = 0; }			
			$wpdb->query("UPDATE ".$wpdb->prefix."currency SET inday1 = '$inday1' WHERE id = '$id'");
		}		
	}

	if(isset($_POST['inday2']) and is_array($_POST['inday2'])){		
		foreach($_POST['inday2'] as $id => $inday2){
			$id = intval($id);
			$inday2 = is_sum($inday2);
			if($inday2 <= 0){ $inday2 = 0; }				
			$wpdb->query("UPDATE ".$wpdb->prefix."currency SET inday2 = '$inday2' WHERE id = '$id'");
		}	
	}	
}

function currlimit_get_currency_reserv($reserv, $vd, $decimal){
global $wpdb;

	if($reserv > 0){
		$time = current_time('timestamp');
		$inday = is_sum(is_isset($vd, 'inday2'));
		if($inday > 0){
			$date = date('Y-m-d 00:00:00',$time);
			$sum_day = get_sum_currency($vd->id, 'in', $date);
			if($sum_day >= $inday){
				$reserv = 0;
			}
		}	
		
		$inmon = is_sum(is_isset($vd, 'inmon2'));
		if($inmon > 0){
			$date = date('Y-m-01 00:00:00',$time);
			$sum_mon = get_sum_currency($vd->id, 'in', $date);
			if($sum_mon >= $inmon){
				$reserv = 0;
			}			
		}
	}
	
	return $reserv;
}

function currlimit_get_direction_reserv($reserv, $currency_reserv, $decimal, $direction){
global $wpdb;
	
	if($reserv > 0){
		$time = current_time('timestamp');
		$currency_id_get = $direction->currency_id_get;
		$vd = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND id='$currency_id_get'");
		$inday = is_sum(is_isset($vd, 'inday2'));
		if($inday > 0){
			$date = date('Y-m-d 00:00:00',$time);
			$sum_day = get_sum_currency($currency_id_get, 'in', $date);
			if($sum_day >= $inday){
				$reserv = 0;
			}
		}	
		
		$inmon = is_sum(is_isset($vd, 'inmon2'));
		if($inmon > 0){
			$date = date('Y-m-01 00:00:00',$time);
			$sum_mon = get_sum_currency($currency_id_get, 'in', $date);
			if($sum_mon >= $inmon){
				$reserv = 0;
			}			
		}
	}
	
	return $reserv;
}

add_filter('get_max_sum_to_direction_give', 'currlimit_get_max_sum_to_direction_give', 10, 4);
function currlimit_get_max_sum_to_direction_give($max, $direction, $vd1, $vd2){
	
	$time = current_time('timestamp');
	$inday = is_sum($vd1->inday1);
	if($inday > 0){
		$date = date('Y-m-d 00:00:00',$time);
		$sum_day = get_sum_currency($vd1->id, 'in', $date);
		$inday = $inday - $sum_day;
		if(is_numeric($max)){
			if($max > $inday){
				$max = $inday;
			}	
		} else {
			$max = $inday;
		}
	}	
	
	$inmon = is_sum($vd1->inmon1);
	if($inmon > 0){
		$date = date('Y-m-01 00:00:00',$time);
		$sum_mon = get_sum_currency($vd1->id, 'in', $date);
		$inmon = $inmon - $sum_mon;
		if(is_numeric($max)){
			if($max > $inmon){
				$max = $inmon;
			}	
		} else {
			$max = $inmon;
		}
	}	
	
	return $max;
}

add_filter('get_max_sum_to_direction_get', 'currlimit_get_max_sum_to_direction_get', 10, 4);
function currlimit_get_max_sum_to_direction_get($max, $direction, $vd1, $vd2){
	
	$time = current_time('timestamp');
	
	$inday = is_sum($vd2->inday2);
	if($inday > 0){
		$date = date('Y-m-d 00:00:00',$time);
		$sum_day = get_sum_currency($vd2->id, 'out', $date);
		$inday = $inday - $sum_day;
		
		if(is_numeric($max)){
			if($max > $inday){
				$max = $inday;
			}	
		} else {
			$max = $inday;
		}
	}		
	
	$inmon = is_sum($vd2->inmon2);
	if($inmon > 0){
		$date = date('Y-m-01 00:00:00',$time);
		$sum_mon = get_sum_currency($vd2->id, 'out', $date);
		$inmon = $inmon - $sum_mon;
		
		if(is_numeric($max)){
			if($max > $inmon){
				$max = $inmon;
			}	
		} else {
			$max = $inmon;
		}
	}	
	
	return $max;
}										