<?php
if( !defined( 'ABSPATH')){ exit(); }

function delete_auto_reviews(){
global $wpdb;

	$time = current_time('timestamp') - (1 * DAY_IN_SECONDS); 
	$ldate = date('Y-m-d H:i:s', $time);
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."reviews WHERE create_date < '$ldate' AND auto_status='0'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_reviews_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM " . $wpdb->prefix . "reviews WHERE id = '$item_id'");
		do_action('pn_reviews_delete', $item_id, $item);
		if($result){
			do_action('pn_reviews_delete_after', $item_id, $item);
		}
	}	
	
} 

add_filter('list_cron_func', 'delete_auto_reviews_list_cron_func');
function delete_auto_reviews_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_auto_reviews'] = array(
			'title' => __('Deleting temporary reviews','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}