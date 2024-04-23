<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_directions');
function pn_adminpage_directions(){
global $premiumbox;
		
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$hook = add_menu_page(__('Exchange directions','pn'), __('Exchange directions','pn'), 'read', "pn_directions", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('directions'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_directions", __('Add exchange direction','pn'), __('Add exchange direction','pn'), 'read', "pn_add_directions", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_directions", __('Exchange direction templates','pn'), __('Exchange direction templates','pn'), 'read', "pn_directions_temp", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_directions", __('Sort exchange direction for tariffs','pn'), __('Sort exchange direction for tariffs','pn'), 'read', "pn_sort_directions", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_directions", sprintf(__('Sort exchange direction for exchange table %s','pn'),'1,4'), sprintf(__('Sort exchange direction for exchange table %s','pn'),'1,4'), 'read', "pn_sort_table1", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_directions", sprintf(__('Sort exchange direction for exchange table %s','pn'),'2'), sprintf(__('Sort exchange direction for exchange table %s','pn'),'2'), 'read', "pn_sort_table2", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_directions", sprintf(__('Sort exchange direction for exchange table %s','pn'),'3'), sprintf(__('Sort exchange direction for exchange table %s','pn'),'3'), 'read', "pn_sort_table3", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','directions_pn_caps');
function directions_pn_caps($pn_caps){
	$pn_caps['pn_directions'] = __('Use exchange direction','pn');
	return $pn_caps;
} 

add_action('pn_psys_delete','directions_pn_psys_delete');
function directions_pn_psys_delete($id){
global $wpdb;

	$wpdb->update($wpdb->prefix.'directions', array('psys_id_give'=> 0, 'direction_status' => 0), array('psys_id_give'=>$id));
	$wpdb->update($wpdb->prefix.'directions', array('psys_id_get'=> 0, 'direction_status' => 0), array('psys_id_get'=>$id));
}

add_action('pn_currency_delete', 'directions_pn_currency_delete');
function directions_pn_currency_delete($id){
global $wpdb;

	$wpdb->query("DELETE FROM ".$wpdb->prefix."directions_order WHERE c_id = '$id'");

	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE currency_id_give = '$id' OR currency_id_get = '$id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_direction_delete_before', $item_id, $item);		
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."directions WHERE id = '$item_id'");
		do_action('pn_direction_delete', $item_id, $item);
		if($result){						
			do_action('pn_direction_delete_after', $item_id, $item);
		}
	}
}

add_action('pn_direction_delete', 'def_pn_direction_delete');
function def_pn_direction_delete($id){
global $wpdb;

	$wpdb->query("DELETE FROM ".$wpdb->prefix."directions_order WHERE direction_id = '$id'"); 
	
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id = '$id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_directionmeta_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."directions_meta WHERE id = '$item_id'");
		do_action('pn_directionmeta_delete', $item_id, $item);
		if($result){
			do_action('pn_directionmeta_delete', $item_id, $item);
		}
	}	
	
	//delete_direction_txtmeta($id);
}	

add_action('pn_currency_notactive', 'directions_pn_currency_notactive');
function directions_pn_currency_notactive($id){
global $wpdb;

	$wpdb->query("UPDATE ".$wpdb->prefix."directions SET direction_status = '0' WHERE currency_id_give = '$id' OR currency_id_get = '$id'");
}

add_action('pn_currency_edit','directions_pn_currency_edit', 1, 2);
function directions_pn_currency_edit($data_id, $array){
global $wpdb;
	if($data_id > 0){
		if($array['currency_status'] == 0){
			$wpdb->query("UPDATE ".$wpdb->prefix."directions SET direction_status = '0' WHERE currency_id_give = '$data_id' OR currency_id_get = '$data_id'");
		}
		$wpdb->update($wpdb->prefix.'directions', array('psys_id_give'=> $array['psys_id']), array('currency_id_give'=>$data_id));
		$wpdb->update($wpdb->prefix.'directions', array('psys_id_get'=> $array['psys_id']), array('currency_id_get'=>$data_id));

		$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status = '1'");
		foreach($directions as $direction){
			$direction_id = $direction->id;
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions_order WHERE direction_id='$direction_id' AND c_id='$data_id'");
			if($cc == 0){
				$arr = array(
					'direction_id' => $direction_id,
					'c_id' => $data_id,
				);
				$wpdb->insert($wpdb->prefix.'directions_order', $arr);
			}
		}		
	}
}

add_action('pn_currency_add','naps_pn_currency_add', 1, 2);
function naps_pn_currency_add($data_id, $array){
global $wpdb;

	if($data_id > 0){
		$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status = '1'");
		foreach($directions as $direction){
			$direction_id = $direction->id;
			$arr = array(
				'directions_id' => $direction_id,
				'c_id' => $data_id,
			);
			$wpdb->insert($wpdb->prefix.'directions_order', $arr);
		}
	}
}
  
add_action('pn_adminpage_quicktags_pn_add_directions','adminpage_quicktags_page_directions');
add_action('pn_adminpage_quicktags_pn_directions_temp','adminpage_quicktags_page_directions');
function adminpage_quicktags_page_directions(){
?>
edButtons[edButtons.length] = 
new edButton('premium_bidid', '<?php _e('Order ID','pn'); ?>','[bid_id]');

edButtons[edButtons.length] = 
new edButton('premium_paysum', '<?php _e('Payment amount','pn'); ?>','[sum_dc]');

edButtons[edButtons.length] = 
new edButton('premium_psys_give', '<?php _e('Payment system Sending','pn'); ?>','[psys_give]');

edButtons[edButtons.length] = 
new edButton('premium_psys_get', '<?php _e('Payment system Receiving','pn'); ?>','[psys_get]');

edButtons[edButtons.length] = 
new edButton('premium_autodel_time', '<?php _e('Order deleting time','pn'); ?>','[bid_delete_time]');

edButtons[edButtons.length] = 
new edButton('premium_trans_in', '<?php _e('Merchant transaction ID','pn'); ?>','[bid_trans_in]');

edButtons[edButtons.length] = 
new edButton('premium_trans_out', '<?php _e('Auto payout transaction ID','pn'); ?>','[bid_trans_out]');

edButtons[edButtons.length] = 
new edButton('premium_frozen_date', '<?php _e('Payout holding time','pn'); ?>','[frozen_date]');
<?php	
}  
 
add_filter('direction_instruction','quicktags_direction_instruction', 10, 5);
function quicktags_direction_instruction($instruction, $txt_name, $direction, $vd1, $vd2){
global $bids_data;	
	
	if(isset($bids_data->id)){
		$instruction = str_replace('[bid_id]', $bids_data->id ,$instruction);
		
		$m_in = apply_filters('get_merchant_id','', is_isset($direction, 'm_in'), $bids_data);
		$sum_to_pay = apply_filters('sum_to_pay', is_sum($bids_data->sum1dc), $m_in , $bids_data, $direction);
		
		$instruction = str_replace('[sum_dc]', $sum_to_pay,$instruction);
		$instruction = str_replace('[bid_trans_in]', $bids_data->trans_in ,$instruction);
		$instruction = str_replace('[bid_trans_out]', $bids_data->trans_out ,$instruction);
		$instruction = str_replace('[frozen_date]', get_mytime($bids_data->touap_date) ,$instruction);
		if(strstr($instruction,'[psys_give]') and isset($bids_data->psys_id_give)){
			$instruction = str_replace('[psys_give]', get_pstitle($bids_data->psys_id_give) ,$instruction);
		}
		if(strstr($instruction,'[psys_get]') and isset($bids_data->psys_id_get)){
			$instruction = str_replace('[psys_get]', get_pstitle($bids_data->psys_id_get) ,$instruction);
		}
		if(strstr($instruction,'[bid_delete_time]') and isset($bids_data->status)){
			$status = $bids_data->status;
			if($status == 'auto'){
				$createdate = $bids_data->create_date;
				$editdate = $bids_data->create_date;
				$del_date = '';
				$date_format = get_option('date_format');
				$time_format = get_option('time_format');			
				$createtime = strtotime($createdate);
				$second = 24*60*60; $second = apply_filters('del_autobids_second', $second);
				$del_time = $createtime + $second;
				$del_date = date("{$date_format}, {$time_format}", $del_time);
				$instruction = str_replace('[bid_delete_time]', $del_date, $instruction);
			} 
		}
	}
	
	return $instruction;
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'add'); 
$premiumbox->include_patch(__FILE__, 'temps');
$premiumbox->include_patch(__FILE__, 'cron');
$premiumbox->include_patch(__FILE__, 'sort');
$premiumbox->include_patch(__FILE__, 'sort1');
$premiumbox->include_patch(__FILE__, 'sort2');
$premiumbox->include_patch(__FILE__, 'sort3');