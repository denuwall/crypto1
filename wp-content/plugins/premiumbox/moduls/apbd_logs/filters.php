<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_currency_reserv_delete','apbd_pn_currency_reserv_delete');
function apbd_pn_currency_reserv_delete($id){
global $wpdb;
	$wpdb->query("DELETE FROM ".$wpdb->prefix."db_admin_logs WHERE item_id = '$id' AND tbl_name='reserv'");
}

add_action('pn_discount_delete','apbd_pn_discount_delete');
function apbd_pn_discount_delete($id){
global $wpdb;
	$wpdb->query("DELETE FROM ".$wpdb->prefix."db_admin_logs WHERE item_id = '$id' AND tbl_name='discount'");
}

add_action('change_bidstatus_realdelete', 'apbd_change_bidstatus');
add_action('change_bidstatus_archived', 'apbd_change_bidstatus');
function apbd_change_bidstatus($id){
global $wpdb;	
	$wpdb->query("DELETE FROM ".$wpdb->prefix."db_admin_logs WHERE item_id = '$id' AND tbl_name='bids'");	
}

/************************/

add_action('pn_currency_reserv_edit','apbd_pn_currency_reserv', 10 , 3);
function apbd_pn_currency_reserv($id, $array, $ldata=''){	

	$tbl_check = array(
		'trans_title' => __('Comment','pn'),
		'trans_sum' => __('Amount','pn'),
		'currency_id' => __('Currency ID','pn'),
	);	
	
	insert_apbd('reserv', $tbl_check, $id, $array, $ldata);
}

add_action('pn_discount_edit','apbd_pn_discount', 10 , 3);
function apbd_pn_discount($id, $array, $ldata=''){	

	$tbl_check = array(
		'sumec' => __('Amount more than','pn'),
		'discount' => __('Discount (%)','pn'),
	);	
	
	insert_apbd('discount', $tbl_check, $id, $array, $ldata);
}
	
add_action('pn_onebid_edit','apbd_pn_onebid_edit', 10 , 4);
function apbd_pn_onebid_edit($id, $array, $ldata='', $lists){	

	$tbl_check = array();
	if(is_array($lists)){
		foreach($lists as $list_name => $list_data){
			$tbl_check[$list_name] = is_isset($list_data, 'title');
		}
	}
	
	insert_apbd('bids', $tbl_check, $id, $array, $ldata);

}	
	
/************************/

add_action('pn_adminpage_content_pn_add_currency_reserv','transreslogs_pn_admin_content_pn_add_currency_reserv');
function transreslogs_pn_admin_content_pn_add_currency_reserv(){
	$tbl_check = array(
		'trans_sum' => __('Amount','pn'),
		'currency_id' => __('Currency ID','pn'),
		'trans_title' => __('Comment','pn'),
	);	
	view_apbd('reserv', $tbl_check);
}

add_action('pn_adminpage_content_pn_add_discount','transreslogs_pn_admin_content_pn_add_discount');
function transreslogs_pn_admin_content_pn_add_discount(){
	$tbl_check = array(
		'sumec' => __('Amount more than','pn'),
		'discount' => __('Discount (%)','pn'),
	);	
	view_apbd('discount', $tbl_check);
}	

add_action('onebid_edit','apbd_onebid_edit', 10, 3);
function apbd_onebid_edit($id, $item, $lists){

	$tbl_check = array();
	if(is_array($lists)){
		foreach($lists as $list_name => $list_data){
			$tbl_check[$list_name] = is_isset($list_data, 'title');
		}
	}	
	view_apbd('bids', $tbl_check);

}

/************************/