<?php
if( !defined( 'ABSPATH')){ exit(); }

function delete_auto_bids(){
global $wpdb, $premiumbox;

	$count_minute = intval($premiumbox->get_option('logssettings', 'delete_auto_bids'));
	if(!$count_minute){ $count_minute = 15; }

	$second = $count_minute * 60;
	$second = apply_filters('del_autobids_second', $second);
	$time = current_time('timestamp') - $second;
	if($second != '-1'){
		$ldate = date('Y-m-d H:i:s', $time);
		$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE create_date < '$ldate' AND status='auto'");
		foreach($items as $item){
			$id = $item->id;	
			$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."exchange_bids WHERE id = '$id'");
			if($result == 1){
				$wpdb->query("DELETE FROM ".$wpdb->prefix."bids_meta WHERE item_id = '$id'");
				do_action('change_bidstatus_all', 'autodelete', $item->id, $item, 'cron_auto_delete','system');
				do_action('change_bidstatus_autodelete', $item->id, $item, 'cron_auto_delete','system'); 			
			}
		}
	}
} 

add_filter('list_cron_func', 'delete_auto_bids_list_cron_func');
function delete_auto_bids_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_auto_bids'] = array(
			'title' => __('Removing orders with inappropriate rules','pn'),
			'site' => 'now',
		);
	}
	
	return $filters;
}

add_filter('list_logs_settings', 'delete_auto_bids_list_logs_settings');
function delete_auto_bids_list_logs_settings($filters){
			
	$filters['delete_auto_bids'] = array(
		'title' => __('Removing orders with inappropriate rules','pn') .' ('. __('minuts','pn') .')',
		'count' => 15,
		'minimum' => 1,
	);
		
	return $filters;
} 