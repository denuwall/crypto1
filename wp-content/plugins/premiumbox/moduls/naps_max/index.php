<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Exchange direction currency limit[:en_US][ru_RU:]Лимит резерва валюты по направлению обмена[:ru_RU]
description: [en_US:]Exchange direction currency limit[:en_US][ru_RU:]Лимит резерва валюты по направлению обмена[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);
 
add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_maxnaps');
function bd_pn_moduls_active_maxnaps(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'maxnaps'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `maxnaps` varchar(50) NOT NULL default '0'");
    }
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_maxnaps');
function bd_pn_moduls_migrate_maxnaps(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'maxnaps'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `maxnaps` varchar(50) NOT NULL default '0'");
    }

}

add_filter('list_export_directions', 'maxnaps_list_export_directions');
function maxnaps_list_export_directions($array){
	
	$array['maxnaps'] = __('Max. amount for sending','pn');
	
	return $array;
}

add_filter('export_directions_filter', 'maxnaps_export_directions_filter');
function maxnaps_export_directions_filter($export_filter){
	
	$export_filter['sum_arr'][] = 'maxnaps';
	
	return $export_filter;
}

add_action('tab_direction_tab8', 'maxnaps_tab_direction_tab8', 1, 2);
function maxnaps_tab_direction_tab8($data, $data_id){
	?>
	<tr>
		<th><?php _e('Reserve limit for exhange direction','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<input type="text" name="maxnaps" style="width: 200px;" value="<?php echo is_sum(is_isset($data, 'maxnaps')); ?>" />
			</div>			
		</td>
	</tr>	
	<?php 		
}

add_filter('pn_direction_addform_post', 'maxnaps_pn_direction_addform_post');
function maxnaps_pn_direction_addform_post($array){
	$array['maxnaps'] = is_sum(is_param_post('maxnaps'));
	return $array;
}

add_filter('get_max_sum_to_direction_get', 'maxnaps_get_max_sum_to_direction_get', 9999, 4);
function maxnaps_get_max_sum_to_direction_get($max, $direction, $vd1, $vd2){
	
	if($direction->maxnaps > 0){
		$summ_direction_all = get_sum_direction($direction->id, 'out');
		$maxnaps = $direction->maxnaps - $summ_direction_all;
		if($maxnaps < 0){ $maxnaps = 0; }
		
		if(is_numeric($max)){
			if($max > $maxnaps){
				$max = $maxnaps;
			}
		} else {
			$max = $maxnaps;
		}
	}				
	
	return $max;
}	