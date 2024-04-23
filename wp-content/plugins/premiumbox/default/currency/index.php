<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_currency');
function pn_adminpage_currency(){
global $premiumbox;
	
	if(current_user_can('administrator') or current_user_can('pn_currency')){
		
		$hook = add_menu_page( __('Currency','pn'), __('Currency','pn'), 'read', "pn_currency", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('currency'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_currency", __('Add currency','pn'), __('Add currency','pn'), 'read', "pn_add_currency", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_currency", __('Sort currency','pn'), __('Sort currency','pn'), 'read', "pn_sort_currency", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_currency", __('Sort reserve','pn'), __('Sort reserve','pn'), 'read', "pn_sort_currency_reserve", array($premiumbox, 'admin_temp'));		
		
	}
}

add_filter('pn_caps','currency_pn_caps');
function currency_pn_caps($pn_caps){
	$pn_caps['pn_currency'] = __('Use currencies','pn');
	return $pn_caps;
}

add_action('pn_currency_delete','def_pn_currency_delete',0,2);
function def_pn_currency_delete($data_id, $item){
global $wpdb;
	
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency_meta WHERE item_id = '$data_id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_currencymeta_delete_before', $id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."currency_meta WHERE id = '$item_id'");
		do_action('pn_currencymeta_delete', $id, $item);
		if($result){
			do_action('pn_currencymeta_delete_after', $id, $item);
		}
	}
}

add_action('pn_currency_code_edit','def_pn_currency_code_edit',0,2);
function def_pn_currency_code_edit($data_id, $array){
global $wpdb;
	
	if(isset($array['currency_code_title'])){
		$wpdb->update($wpdb->prefix.'currency', array('currency_code_title'=>$array['currency_code_title']), array('currency_code_id'=>$data_id));
	}
}

add_action('pn_currency_code_delete','def_pn_currency_code_delete');
function def_pn_currency_code_delete($id){
global $wpdb;

	$wpdb->update($wpdb->prefix.'currency', array('currency_code_title'=> '', 'currency_code_id'=> 0), array('currency_code_id'=>$id));
}

add_action('pn_psys_edit','def_pn_psys_edit',0,2);
function def_pn_psys_edit($data_id, $array){
global $wpdb;	
	if(isset($array['psys_title'], $array['psys_logo'])){ 
		$wpdb->update($wpdb->prefix . 'currency', array('psys_title'=>$array['psys_title'], 'psys_logo'=>$array['psys_logo']), array('psys_id'=>$data_id));
	}
}

add_action('pn_psys_delete', 'def_pn_psys_delete');
function def_pn_psys_delete($id){
global $wpdb;

	$wpdb->update($wpdb->prefix . 'currency', array('psys_title'=> '', 'psys_id'=> 0), array('psys_id'=>$id));
}

add_filter('list_currency_manage', 'def_list_currency_manage',0,3);
function def_list_currency_manage($currency, $default, $show_decimal=0){
global $wpdb;

	$currency = $currency_info = array();
	$currency[0] = '--'. $default .'--';
	$currency_info[0] = array(
		'title' => '--'. $default .'--',
		'decimal' => 0,
	);
	$currency_datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' ORDER BY site_order ASC");
	foreach($currency_datas as $curr){
		$title = pn_strip_input(ctv_ml($curr->psys_title)) .' '. is_site_value($curr->currency_code_title);
		$currency[$curr->id] = $title;
		$currency_info[$curr->id] = array(
			'title' => $title,
			'decimal' => $curr->currency_decimal,
		);
	}
	
	if($show_decimal == 1){
		return $currency_info;
	} else {
		return $currency;
	}
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'sort');
$premiumbox->include_patch(__FILE__, 'sortres');
$premiumbox->include_patch(__FILE__, 'cron');