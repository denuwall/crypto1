<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Additional fee of exchange office in general table[:en_US][ru_RU:]Доп. комиссия обменного пункта в общей таблице[:ru_RU]
description: [en_US:]Additional fee of the exchange office in the general table of exchange directions in the control panel[:en_US][ru_RU:]Дополнительная комиссия обменного пункта в общей таблице направлений обмена в панели управления[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_directions_save', 'comboxlist_pn_directions_save');
function comboxlist_pn_directions_save(){
global $wpdb;	
	
	if(isset($_POST['com_box_sum1']) and is_array($_POST['com_box_sum1'])){
		foreach($_POST['com_box_sum1'] as $id => $com_box_sum1){
			$id = intval($id);
			$com_box_sum1 = is_sum($com_box_sum1);
			$com_box_sum2 = is_sum($_POST['com_box_sum2'][$id]);			
			$com_box_pers1 = is_sum($_POST['com_box_pers1'][$id]);	
			$com_box_pers2 = is_sum($_POST['com_box_pers2'][$id]);				
						
			$array = array();
			$array['com_box_sum1'] = $com_box_sum1;
			$array['com_box_sum2'] = $com_box_sum2;
			$array['com_box_pers1'] = $com_box_pers1;
			$array['com_box_pers2'] = $com_box_pers2;					
			$wpdb->update($wpdb->prefix.'directions', $array, array('id'=>$id));			
		}
	}		
}

add_filter('directions_manage_ap_columns', 'comboxlist_directions_manage_ap_columns');
function comboxlist_directions_manage_ap_columns($columns){
	$columns['comboxlist_give'] = __('Additional sender fee','pn');
	$columns['comboxlist_get'] = __('Additional recipient fee','pn');
	return $columns;
}

add_filter('directions_manage_ap_col', 'comboxlist_directions_manage_ap_col', 10, 3);
function comboxlist_directions_manage_ap_col($show, $column_name, $item){
global $wpdb;
	
	if($column_name == 'comboxlist_give'){	
		$show = '
		<div><input type="text" style="width: 100%; max-width: 80px;" name="com_box_sum1['. $item->id .']" value="'. is_sum($item->com_box_sum1) .'" /> S</div>
		<div><input type="text" style="width: 100%; max-width: 80px;" name="com_box_pers1['. $item->id .']" value="'. is_sum($item->com_box_pers1) .'" /> %</div>
		';
	}
	if($column_name == 'comboxlist_get'){	
		$show = '
		<div><input type="text" style="width: 100%; max-width: 80px;" name="com_box_sum2['. $item->id .']" value="'. is_sum($item->com_box_sum2) .'" /> S</div>
		<div><input type="text" style="width: 100%; max-width: 80px;" name="com_box_pers2['. $item->id .']" value="'. is_sum($item->com_box_pers2) .'" /> %</div>
		';
	}	
	
	return $show;
}