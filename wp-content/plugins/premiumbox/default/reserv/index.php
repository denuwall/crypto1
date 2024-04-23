<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_reserv');
function pn_adminpage_reserv(){
global $premiumbox;

	if(current_user_can('administrator') or current_user_can('pn_currency_reserv')){
		$hook = add_menu_page(__('Reserve adjustment','pn'), __('Reserve adjustment','pn'), 'read', "pn_currency_reserv", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('reserv'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_currency_reserv", __('Add reserve transaction','pn'), __('Add reserve transaction','pn'), 'read', "pn_add_currency_reserv", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','currency_reserv_pn_caps');
function currency_reserv_pn_caps($pn_caps){
	$pn_caps['pn_currency_reserv'] = __('Use adjustment reserve','pn');
	return $pn_caps;
}

add_action('change_bidstatus_all', 'reserv_change_bidstatus', 1000, 3);
function reserv_change_bidstatus($action, $obmen_id, $obmen){
	update_currency_reserv($obmen->currency_id_give);
	update_currency_reserv($obmen->currency_id_get);
}

add_action('pn_currency_edit','reserv_pn_currency_edit',1,2);
function reserv_pn_currency_edit($data_id, $array){
	$object = (object)$array;
	update_currency_reserv($data_id, $object);
} 

add_action('pn_currency_delete','reserv_pn_currency_delete', 10, 2);
function reserv_pn_currency_delete($id, $item){
global $wpdb;

	$items = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency_reserv WHERE currency_id = '$id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_currency_reserv_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM " . $wpdb->prefix . "currency_reserv WHERE id = '$item_id'");
		do_action('pn_currency_reserv_delete', $item_id, $item);
		if($result){
			do_action('pn_currency_reserv_delete_after', $item_id, $item);
		}
	}
}

add_action('pn_currency_code_edit','reserv_pn_currency_code_edit',1,2);
function reserv_pn_currency_code_edit($data_id, $array){
global $wpdb;

	$currency_code_title = is_isset($array,'currency_code_title');
	$wpdb->update($wpdb->prefix . 'currency_reserv', array('currency_code_title' => $currency_code_title), array('currency_code_id' => $data_id));
}

add_action('pn_currency_reserv_delete','reserv_pn_currency_reserv_delete', 10, 2);
function reserv_pn_currency_reserv_delete($id, $item){
global $wpdb;

	update_currency_reserv($item->currency_id);
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'cron');
