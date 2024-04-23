<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Archiving of old requests[:en_US][ru_RU:]Архивация старых заявок[:ru_RU]
description: [en_US:]!Do not disable the module after activation! Archiving of old requests with the creation date longer than two months[:en_US][ru_RU:]!Не отключать модуль после его активации! Архивация старых заявок со сроком создания более двух месяцев[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

/* BD */
add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_archive_bids');
add_action('pn_bd_activated', 'bd_pn_moduls_active_archive_bids');
function bd_pn_moduls_active_archive_bids(){
global $wpdb;	
	
	$table_name = $wpdb->prefix ."archive_exchange_bids";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`archive_date` datetime NOT NULL,
		`create_date` datetime NOT NULL, 
		`edit_date` datetime NOT NULL, 	
		`bid_id` bigint(20) NOT NULL default '0',
		`user_id` bigint(20) NOT NULL default '0',
		`ref_id` bigint(20) NOT NULL default '0',
		`archive_content` longtext NOT NULL,
		`account_give` varchar(250) NOT NULL, 
		`account_get` varchar(250) NOT NULL, 
		`first_name` varchar(150) NOT NULL,
		`last_name` varchar(150) NOT NULL,
		`second_name` varchar(150) NOT NULL,
		`user_phone` varchar(150) NOT NULL,
		`user_skype` varchar(150) NOT NULL,
		`user_email` varchar(150) NOT NULL,
		`user_passport` varchar(250) NOT NULL,
		`psys_give` longtext NOT NULL, 
		`psys_get` longtext NOT NULL, 
		`currency_id_give` bigint(20) NOT NULL default '0', 
		`currency_id_get` bigint(20) NOT NULL default '0',	
		`status` varchar(35) NOT NULL,
		`direction_id` bigint(20) NOT NULL default '0',
		`course_give` varchar(50) NOT NULL default '0', 
		`course_get` varchar(50) NOT NULL default '0',
		`user_ip` varchar(150) NOT NULL,	
		`currency_code_give` varchar(35) NOT NULL, 
		`currency_code_get` varchar(35) NOT NULL, 
		`currency_code_id_give` bigint(20) NOT NULL default '0', 
		`currency_code_id_get` bigint(20) NOT NULL default '0',
		`psys_id_give` bigint(20) NOT NULL default '0', 
		`psys_id_get` bigint(20) NOT NULL default '0', 
		`user_discount` varchar(10) NOT NULL default '0',
		`user_discount_sum` varchar(50) NOT NULL default '0',
		`exsum` varchar(50) NOT NULL default '0',
		`profit` varchar(50) NOT NULL default '0',
		`trans_in` varchar(250) NOT NULL default '0',
		`trans_out` varchar(250) NOT NULL default '0',
		`to_account` varchar(250) NOT NULL, 
		`from_account` varchar(250) NOT NULL,		
		`pay_ac` varchar(250) NOT NULL,
		`pay_sum` varchar(50) NOT NULL default '0',	
		`sum1` varchar(50) NOT NULL default '0', 
		`dop_com1` varchar(50) NOT NULL default '0',
		`sum1dc` varchar(50) NOT NULL default '0',
		`com_ps1` varchar(50) NOT NULL default '0',
		`com_ps2` varchar(50) NOT NULL default '0',
		`sum1c` varchar(50) NOT NULL default '0', 
		`sum1r` varchar(50) NOT NULL default '0',
		`sum2t` varchar(50) NOT NULL default '0',
		`sum2` varchar(50) NOT NULL default '0', 
		`dop_com2` varchar(50) NOT NULL default '0',
		`sum2dc` varchar(50) NOT NULL default '0',
		`sum2r` varchar(50) NOT NULL default '0',
		`sum2c` varchar(50) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}
/* end BD */

add_action( 'delete_user', 'delete_user_archive_bids');
function delete_user_archive_bids($user_id){
global $wpdb;

    $wpdb->query("DELETE FROM ". $wpdb->prefix ."archive_data WHERE item_id='$user_id' AND meta_key IN('user_exsum','user_bids_success','domacc1_currency_code','domacc2_currency_code')");
}

add_filter('user_sum_exchanges', 'user_sum_exchanges_archive_bids', 1, 3);
function user_sum_exchanges_archive_bids($d_sum, $sum, $user_id){ 
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='user_exsum' AND item_id='$user_id'");
	$d_sum = $sum + $count;
	$d_sum = is_sum($d_sum);
	
	return $d_sum;
}

add_filter('user_count_exchanges', 'user_count_exchanges_archive_bids', 1, 3);
function user_count_exchanges_archive_bids($d_sum, $sum, $user_id){
global $wpdb;
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='user_bids' AND meta_key2 = 'success' AND item_id='$user_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}

add_filter('partner_money', 'partner_money_archive_bids', 1, 3);
add_filter('partner_money_now', 'partner_money_archive_bids', 1, 3);
add_filter('get_partner_earn_all', 'partner_money_archive_bids', 1, 3);
function partner_money_archive_bids($d_sum, $sum, $user_id){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='pbids_sum' AND item_id='$user_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}
 
add_filter('user_sum_refobmen', 'user_sum_refobmen_archive_bids', 1, 3);
function user_sum_refobmen_archive_bids($d_sum, $sum, $user_id){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='pbids_exsum' AND item_id='$user_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}

add_filter('user_count_refobmen', 'user_count_refobmen_archive_bids', 1, 2);
function user_count_refobmen_archive_bids($sum, $ref_id){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='pbids' AND item_id='$ref_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}

/* тип валюты */
add_action('pn_currency_code_delete','archive_pn_currency_code_delete');
function archive_pn_currency_code_delete($id){
global $wpdb;

	$wpdb->query("DELETE FROM ".$wpdb->prefix."archive_data WHERE item_id = '$id' AND meta_key IN('currency_code_give','currency_code_get')");
}

add_filter('get_reserv_currency_code', 'get_reserv_currency_code_archive_bids', 1, 3);
function get_reserv_currency_code_archive_bids($d_sum, $sum, $currency_code_id){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_code_give' AND meta_key2='success' AND item_id='$currency_code_id'");
	$count2 = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_code_get' AND meta_key2='success' AND item_id='$currency_code_id'");
	$sum = $sum + $count - $count2;
	$d_sum = is_sum($sum);
	
	return $d_sum;
}
/* end тип валюты */

/* валюта */
add_filter('update_currency_reserv', 'update_currency_reserv_archive_bids', 1, 4);
function update_currency_reserv_archive_bids($sum, $currency_id, $f_st1, $f_st2){
global $wpdb;
	
	$sum1 = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_give' AND meta_key2 IN($f_st1) AND item_id='$currency_id'");
	$sum2 = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_get' AND meta_key2 IN($f_st2) AND item_id='$currency_id'");
	$sum = $sum + $sum1 - $sum2;
	$sum = is_sum($sum);
	
	return $sum;
}

add_filter('get_currency_in', 'get_currency_in_archive_bids', 1, 3);
function get_currency_in_archive_bids($sum, $currency_id, $status){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_give' AND meta_key2='$status' AND item_id='$currency_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}

add_filter('get_currency_out', 'get_currency_out_archive_bids', 1, 3);
function get_currency_out_archive_bids($sum, $currency_id, $status){
global $wpdb;
	
	$count = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE meta_key='currency_get' AND meta_key2='$status' AND item_id='$currency_id'");
	$sum = $sum + $count;
	$sum = is_sum($sum);
	
	return $sum;
}
/* end валюта */

/* направления */
add_action('pn_direction_delete','archive_pn_direction_delete');
function archive_pn_direction_delete($id){
global $wpdb;

	$wpdb->query("DELETE FROM ".$wpdb->prefix."archive_data WHERE meta_key IN('direction_give','direction_get') AND item_id = '$id'");
}

add_filter('get_sum_direction', 'archive_get_sum_direction', 1, 6);
function archive_get_sum_direction($d_sum, $sum, $direction_id, $method, $filter_status, $date){
global $wpdb;
	
	$date = trim($date);
	if(!$date){
		if($method == 'in'){
			$sum1 = $wpdb->get_var("SELECT SUM(meta_value) FROM ". $wpdb->prefix ."archive_data WHERE item_id='$direction_id' AND meta_key='direction_give' AND meta_key2 IN($filter_status)");
		} else {
			$sum1 = $wpdb->get_var("SELECT SUM(meta_value) FROM ". $wpdb->prefix ."archive_data WHERE item_id='$direction_id' AND meta_key='direction_get' AND meta_key2 IN($filter_status)");
		}		
		$d_sum = is_sum($sum + $sum1);
	}
	
	return $d_sum;
}
/* end направления */

/* dom acc */
add_filter('get_user_domacc', 'get_user_domacc_archive_bids', 1, 3);
function get_user_domacc_archive_bids($sum, $user_id, $currency_code_id){
global $wpdb;

	$sum1 = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE item_id='$user_id' AND meta_key='domacc2_currency_code' AND meta_key2 = 'success' AND meta_key3='$currency_code_id'");
	$sum2 = $wpdb->get_var("SELECT SUM(meta_value) FROM ".$wpdb->prefix."archive_data WHERE item_id='$user_id' AND meta_key='domacc1_currency_code' AND meta_key2 IN('realpay','success','verify') AND meta_key3='$currency_code_id'");
	$sum3 = is_sum($sum + $sum1 - $sum2);
	
	return $sum3;
}
/* end dom acc */

add_action('admin_menu', 'pn_adminpage_archive_bids');
function pn_adminpage_archive_bids(){
global $premiumbox;	
	
	if(current_user_can('administrator')){
		$hook = add_submenu_page('pn_bids', __('Archived orders','pn'), __('Archived orders','pn'), 'read', 'pn_archive_bids', array($premiumbox, 'admin_temp'));  
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_moduls", __('Archiving settings','pn'), __('Archiving settings','pn'), 'read', "pn_settings_archive_bids", array($premiumbox, 'admin_temp'));
	}
}

global $premiumbox;
$premiumbox->file_include($path.'/cron');
$premiumbox->file_include($path.'/list');
$premiumbox->file_include($path.'/settings');
$premiumbox->file_include($path.'/files');