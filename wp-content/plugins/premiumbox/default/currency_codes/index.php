<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_currency_codes');
function pn_adminpage_currency_codes(){
global $premiumbox;
	
	if(current_user_can('administrator') or current_user_can('pn_currency_codes')){
		$hook = add_menu_page(__('Currency codes','pn'), __('Currency codes','pn'), 'read', "pn_currency_codes", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('currency_codes'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_currency_codes", __('Add currency code','pn'), __('Add currency code','pn'), 'read', "pn_add_currency_codes", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','currency_codes_pn_caps');
function currency_codes_pn_caps($pn_caps){
	$pn_caps['pn_currency_codes'] = __('Use currency codes','pn');
	return $pn_caps;
}

add_filter('list_currency_codes_manage', 'def_list_currency_codes_manage',0,2);
function def_list_currency_codes_manage($lists, $default){
global $wpdb;

	$lists = array();
	$lists[0] = '--' . $default . '--';
	$lists_datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency_codes WHERE auto_status = '1' ORDER BY currency_code_title ASC");
	foreach($lists_datas as $item){
		$lists[$item->id] = is_site_value($item->currency_code_title);
	}
	return $lists;
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'cron');