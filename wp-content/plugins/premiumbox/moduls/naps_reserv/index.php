<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Reserve settings for exchange directions[:en_US][ru_RU:]Настройки резерва для направлений обмена[:ru_RU]
description: [en_US:]Reserve settings for exchange directions[:en_US][ru_RU:]Настройки резерва для направлений обмена[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_napsreserv');
function bd_pn_moduls_active_napsreserv(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'direction_reserv'");
    if($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `direction_reserv` varchar(250) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'reserv_place'");
    if($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `reserv_place` varchar(250) NOT NULL default '0'");
    }	
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_napsreserv');
function bd_pn_moduls_migrate_napsreserv(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'direction_reserv'");
    if($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `direction_reserv` varchar(250) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE 'reserv_place'");
    if($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."directions ADD `reserv_place` varchar(250) NOT NULL default '0'");
    }

}

add_filter('list_tabs_direction','list_tabs_direction_napsreserv');
function list_tabs_direction_napsreserv($list_tabs_naps){
	$list_tabs_naps['tab300'] = __('Reserve','pn');
	
	return $list_tabs_naps;
}

add_action('tab_direction_tab300','tab_direction_tab_napsreserv',99,2);
function tab_direction_tab_napsreserv($data, $data_id){
	
	$rplaced = array();
	$rplaced[0] = '--'. __('Default','pn') .'--';
	$rplaced[1] = '--'. __('From field below','pn') .'--';
	$rplaced = apply_filters('reserv_place_list', $rplaced, 'direction');
	$rplaced = (array)$rplaced;	
?>	
	<tr>
		<th><?php _e('Reserve','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<select name="reserv_place" autocomplete="off">
					<?php 
					foreach($rplaced as $key => $title){
					?>						
					<option value="<?php echo $key; ?>" <?php selected($key,$data->reserv_place); ?>><?php echo $title;?></option>			
					<?php } ?>
				</select>
			</div>
		</td>
	</tr>
	<tr>
		<th><?php _e('Field for reserve','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="direction_reserv" style="width: 100px;" value="<?php echo is_sum($data->direction_reserv); ?>" />
			</div>
		</td>
		<td>			
		</td>
	</tr>	
<?php
}
 
add_filter('pn_direction_addform_post', 'napsreserv_pn_direction_addform_post');
function napsreserv_pn_direction_addform_post($array){
	
	$array['reserv_place'] = is_extension_name(is_param_post('reserv_place'));
	$array['direction_reserv'] = is_sum(is_param_post('direction_reserv'));
	
	return $array;
}

function update_direction_reserv($direction_id){
global $wpdb;
	$ind = 0;
	$direction_id = intval($direction_id); 
	if($direction_id){ 
		$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$direction_id'");
		if(isset($item->id)){
			$ind = apply_filters('update_direction_reserv', 0,  is_extension_name($item->reserv_place), $direction_id, $item);
		}
	}
		return $ind;
}

add_action('change_bidstatus_all','napsreserv_change_bidstatus',1000,3);
function napsreserv_change_bidstatus($action, $obmen_id, $obmen){
	update_direction_reserv($obmen->direction_id);
}

add_action('pn_direction_edit','napsreserv_pn_direction_edit', 1000, 2); 
add_action('pn_direction_add','napsreserv_pn_direction_edit', 1000, 2);
function napsreserv_pn_direction_edit($data_id, $array){
	update_direction_reserv($data_id);
}

add_filter('get_direction_reserv', 'napsreserv_get_direction_reserv', 9999, 4);
function napsreserv_get_direction_reserv($reserv, $currency_reserv, $decimal, $direction){
	if($direction->reserv_place != '0'){
		return $direction->direction_reserv;
	}
	return $reserv;
}