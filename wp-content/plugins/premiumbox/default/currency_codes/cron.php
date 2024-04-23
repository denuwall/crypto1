<?php
if( !defined( 'ABSPATH')){ exit(); }

function delete_auto_currency_codes(){
global $wpdb;

	$time = current_time('timestamp') - (1 * DAY_IN_SECONDS); 
	$ldate = date('Y-m-d H:i:s', $time);
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency_codes WHERE create_date < '$ldate' AND auto_status='0'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_currency_code_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM " . $wpdb->prefix . "currency_codes WHERE id = '$item_id'");
		do_action('pn_currency_code_delete', $item_id, $item);
		if($result){
			do_action('pn_currency_code_delete_after', $item_id, $item);
		}
	}	
	
} 

add_filter('list_cron_func', 'delete_auto_currency_codes_list_cron_func');
function delete_auto_currency_codes_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_auto_currency_codes'] = array(
			'title' => __('Deleting technical currency codes','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}