<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Direction copy[:en_US][ru_RU:]Копирование направлений[:ru_RU]
description: [en_US:]Direction copy[:en_US][ru_RU:]Копирование направлений[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

add_action('premium_action_copy_direction_exchange','def_premium_action_copy_direction_exchange');
function def_premium_action_copy_direction_exchange(){
global $wpdb;	

	pn_only_caps(array('administrator','pn_directions'));
		
	$form = new PremiumForm();	
		
	$item_id = intval(is_param_get('item_id'));
	if($item_id){
		$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE id='$item_id' AND auto_status='1'");
		if(isset($data->id)){
			$last_id = $data->id;	
			$array = array();
			foreach($data as $key => $item){
				if($key != 'id'){
					$array[$key] = $item;
				}
				if($key == 'tech_name'){
					$array[$key] = $item . '[copy]';
				}	
				if($key == 'direction_name'){
					$array[$key] = unique_direction_name($item, 0);
				}
			}
			$array['direction_status'] = 0;
			$wpdb->insert($wpdb->prefix.'directions', $array);
			$new_id = $wpdb->insert_id;
			if($new_id){
				$directions_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$last_id'");
				foreach($directions_meta as $dirs){
					$arr = array();
					foreach($dirs as $dir_k => $dir_v){
						if($dir_k != 'id'){
							$arr[$dir_k] = $dir_v;
						}
					}
					$arr['item_id'] = $new_id;
					$wpdb->insert($wpdb->prefix.'directions_meta', $arr);
				}							
				$cf_directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_order WHERE direction_id='$last_id'");
				foreach($cf_directions as $dirs){
					$arr = array();
					foreach($dirs as $dir_k => $dir_v){
						if($dir_k != 'id'){
							$arr[$dir_k] = $dir_v;
						}						
					}
					$arr['direction_id'] = $new_id;
					$wpdb->insert($wpdb->prefix.'directions_order', $arr);
				}				
				copy_direction_txtmeta($last_id, $new_id);
				do_action('pn_direction_copy', $last_id, $new_id);
			}
		}
	}
			
	$url = admin_url('admin.php?page=pn_directions') . '&reply=true';
	$form->answer_form($url);			
}

add_filter('directions_manage_ap_columns', 'copy_directions_manage_ap_columns', 1000);
function copy_directions_manage_ap_columns($columns){
	$columns['copy'] = __('Copy exchange direction','pn');
	
	return $columns;
}

add_filter('directions_manage_ap_col', 'copy_directions_manage_ap_col', 10, 3);
function copy_directions_manage_ap_col($column,$column_name,$item){
	
	if($column_name == 'copy'){	
		$column = '<a href="'. pn_link_post('copy_direction_exchange') .'&item_id='. $item->id .'" class="button">'. __('Copy','pn') .'</a>';
	} 
	
	return $column;
}

add_filter('pn_admin_back_menu_pn_add_directions', 'copy_pn_admin_back_menu_pn_add_directions', 1000, 2);
function copy_pn_admin_back_menu_pn_add_directions($back_menu, $bd_data){
	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['copy'] = array(
			'link' => pn_link_post('copy_direction_exchange').'&item_id='.$data_id,
			'title' => __('Copy direction exchange','pn')
		);
	}
	return $back_menu;
}