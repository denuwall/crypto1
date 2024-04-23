<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Accounts verification[:en_US][ru_RU:]Верификация счетов пользователей[:ru_RU]
description: [en_US:]Accounts verification[:en_US][ru_RU:]Верификация счетов пользователей[:ru_RU]
version: 1.5
category: [en_US:]Users[:en_US][ru_RU:]Пользователи[:ru_RU]
cat: user
dependent: userwallets
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_walletsverify');
function bd_pn_moduls_active_walletsverify(){
global $wpdb;	
	
	$table_name = $wpdb->prefix ."uv_wallets";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(250) NOT NULL,
		`user_email` varchar(250) NOT NULL,
		`user_ip` varchar(250) NOT NULL,
		`currency_id` bigint(20) NOT NULL default '0',
		`user_wallet_id` bigint(20) NOT NULL default '0',
		`wallet_num` longtext NOT NULL,
		`comment` longtext NOT NULL,
		`locale` varchar(20) NOT NULL,
		`status` int(1) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
	$table_name = $wpdb->prefix ."uv_wallets_files";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`user_id` bigint(20) NOT NULL default '0',
		`uv_data` longtext NOT NULL,
		`uv_wallet_id` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_walletsverify');
function bd_pn_moduls_migrate_walletsverify(){
global $wpdb;

	$table_name = $wpdb->prefix ."uv_wallets";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(250) NOT NULL,
		`user_email` varchar(250) NOT NULL,
		`user_ip` varchar(250) NOT NULL,
		`currency_id` bigint(20) NOT NULL default '0',
		`user_wallet_id` bigint(20) NOT NULL default '0',
		`wallet_num` longtext NOT NULL,
		`comment` longtext NOT NULL,
		`locale` varchar(20) NOT NULL,
		`status` int(1) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
	$table_name = $wpdb->prefix ."uv_wallets_files";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`user_id` bigint(20) NOT NULL default '0',
		`uv_data` longtext NOT NULL,
		`uv_wallet_id` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}

add_action('admin_menu', 'pn_adminpage_walletsverify');
function pn_adminpage_walletsverify(){
global $premiumbox;
	
	if(current_user_can('administrator') or current_user_can('pn_userwallets')){ 	
		$hook = add_submenu_page("pn_userwallets", __('Accounts verification','pn'), __('Accounts verification','pn'), 'read', "pn_userwallets_verify", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_userwallets", __('Verification settings','pn'), __('Verification settings','pn'), 'read', "pn_userwallets_verify_settings", array($premiumbox, 'admin_temp'));		
	}
	
}

/* e-mail */
add_filter('list_admin_notify','list_admin_notify_walletsverify');
function list_admin_notify_walletsverify($places_admin){
	$places_admin['userverify2'] = __('Account verification requests','pn');
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_walletsverify');
function list_user_notify_walletsverify($places_admin){
	$places_admin['userverify3_u'] = __('Successful account verification','pn');
	$places_admin['userverify4_u'] = __('Account verification declined','pn');
	return $places_admin;
}

add_filter('list_notify_tags_userverify2','def_list_notify_tags_walletsverify');
add_filter('list_notify_tags_userverify3_u','def_list_notify_tags_walletsverify');
add_filter('list_notify_tags_userverify4_u','def_list_notify_tags_walletsverify');
function def_list_notify_tags_walletsverify($tags){
	$tags['user_login'] = __('User login','pn');
	$tags['purse'] = __('Account number','pn');
	$tags['comment'] = __('Comment','pn');
	return $tags;
}
/* end e-mail */

function delete_userwallets_files($id){
global $wpdb;
	$id = intval($id);
	$my_dir = wp_upload_dir();
	$wpdb->query("DELETE FROM ".$wpdb->prefix."uv_wallets_files WHERE uv_wallet_id = '$id'");
	$path = $my_dir['basedir'].'/accountverify/'. $id .'/';
	full_del_dir($path);
}

add_action('pn_userwallets_delete', 'pn_userwallets_delete_walletsverify');
function pn_userwallets_delete_walletsverify($id){
global $wpdb;

	$items = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE user_wallet_id = '$id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_uv_wallets_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."uv_wallets WHERE id = '$item_id'");
		do_action('pn_uv_wallets_delete', $item_id, $item);
		if($result){
			do_action('pn_uv_wallets_delete_after', $item_id, $item);
		}
	}
}

add_action('pn_uv_wallets_delete_after', 'pn_uv_wallets_delete_walletsverify', 10, 2);
function pn_uv_wallets_delete_walletsverify($item_id, $item){
	$user_wallet_id = $item->user_wallet_id;
	delete_userwallets_files($user_wallet_id);
}

add_action('pn_currency_delete', 'pn_currency_delete_walletsverify');
function pn_currency_delete_walletsverify($id){
global $wpdb;	

	$items = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE currency_id = '$id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_uv_wallets_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."uv_wallets WHERE id = '$item_id'");
		do_action('pn_uv_wallets_delete', $item_id, $item);
		if($result){
			do_action('pn_uv_wallets_delete_after', $item_id, $item);
		}
	}
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'settings');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'file');
$premiumbox->include_patch(__FILE__, 'shortcode'); 
$premiumbox->include_patch(__FILE__, 'filters');