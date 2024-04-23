<?php
if( !defined( 'ABSPATH')){ exit(); }
	
function the_exchange_home() {
	echo get_exchange_table();
}
	
function get_exchange_table($def_cur_from='', $def_cur_to=''){
global $wpdb;	
	
	$temp = '';
	
	$arr = array(
		'from' => $def_cur_from,
		'to' => $def_cur_to,
	);
	$arr = apply_filters('get_exchange_table_vtypes', $arr, 'web');
	
	$show_data = pn_exchanges_output('home');
	
	if($show_data['text']){
		$temp .= '<div class="home_resultfalse"><div class="home_resultfalse_close">'. $show_data['text'] .'</div></div>';
	}	
	
	if($show_data['mode'] == 1){
		$type_table = get_type_table();
		$html = apply_filters('exchange_table_type', '', $type_table ,$arr['from'] ,$arr['to']);
		$temp .= apply_filters('exchange_table_type' . $type_table, $html ,$arr['from'] ,$arr['to']);
	} 	
	
	return $temp;
}	

add_filter('exchange_input', 'def_exchange_input', 10, 8);
function def_exchange_input($html, $place, $cdata, $calc_data){
	
	$dis1 = $dis1c = $dis2 = $dis2c = '';
	if($cdata['dis1'] == 1){ $dis1 = 'disabled="disabled"'; }
	if($cdata['dis1c'] == 1){ $dis1c = 'disabled="disabled"'; }
	if($cdata['dis2'] == 1){ $dis2 = 'disabled="disabled"'; }
	if($cdata['dis2c'] == 1){ $dis2c = 'disabled="disabled"'; }	
	
	$sum1 = is_sum(is_isset($cdata,'sum1'));
	$sum1c = is_sum(is_isset($cdata,'sum1c'));
	$sum2 = is_sum(is_isset($cdata,'sum2'));
	$sum2c = is_sum(is_isset($cdata,'sum2c'));		
	
	if($place == 'give'){
		$html = '<input type="text" name="sum1" '. $dis1 .' autocomplete="off" cash-id="sum1" data-decimal="'. $cdata['decimal_give'] .'" class="js_decimal js_sum1 cache_data" value="'. $sum1 .'" />';
	} elseif($place == 'give_com'){
		$html = '<input type="text" name="" '. $dis1c .' autocomplete="off" class="js_decimal js_sum1c" data-decimal="'. $cdata['decimal_give'] .'" value="'. $sum1c .'" />';
	} elseif($place == 'get'){
		$html = '<input type="text" name="" '. $dis2 .' autocomplete="off" class="js_decimal js_sum2" data-decimal="'. $cdata['decimal_get'] .'" value="'. $sum2 .'" />';
	} elseif($place == 'get_com'){	
		$html = '<input type="text" name="" '. $dis2c .' autocomplete="off" class="js_decimal js_sum2c" data-decimal="'. $cdata['decimal_get'] .'" value="'. $sum2c .'" /> ';
	}
	
	return $html;
}

global $premiumbox; 
$premiumbox->include_patch(__FILE__, 'function');
$premiumbox->include_patch(__FILE__, 'calculator'); 
$premiumbox->include_patch(__FILE__, 'action');
$premiumbox->include_patch(__FILE__, 'table1'); 
$premiumbox->include_patch(__FILE__, 'table2'); 
$premiumbox->include_patch(__FILE__, 'table3'); 
$premiumbox->include_patch(__FILE__, 'table4');
$premiumbox->include_patch(__FILE__, 'widget');
$premiumbox->include_patch(__FILE__, 'cron'); 
$premiumbox->include_patch(__FILE__, 'mails');