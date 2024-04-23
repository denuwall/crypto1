<?php
if( !defined( 'ABSPATH')){ exit(); }

function delete_auto_cf(){
global $wpdb;

	$time = current_time('timestamp') - (1 * DAY_IN_SECONDS); 
	$ldate = date('Y-m-d H:i:s', $time);
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."direction_custom_fields WHERE create_date < '$ldate' AND auto_status='0'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_cf_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM " . $wpdb->prefix . "direction_custom_fields WHERE id = '$item_id'");
		do_action('pn_cf_delete', $item_id, $item);
		if($result){
			do_action('pn_cf_delete_after', $item_id, $item);
		}
	}	
	
} 

add_filter('list_cron_func', 'delete_auto_cf_list_cron_func');
function delete_auto_cf_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_auto_cf'] = array(
			'title' => __('Deleting technical custom field','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}