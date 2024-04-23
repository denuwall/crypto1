<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Affiliate program[:en_US][ru_RU:]Партнерская программа[:ru_RU]
description: [en_US:]Affiliate program[:en_US][ru_RU:]Партнерская программа[:ru_RU]
version: 1.5
category: [en_US:]Users[:en_US][ru_RU:]Пользователи[:ru_RU]
cat: user
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_user_payouts_wait_after','reserv_pn_user_payouts_wait_after',1,2);
add_action('pn_user_payouts_success_after','reserv_pn_user_payouts_wait_after',1,2);
add_action('pn_user_payouts_not_after','reserv_pn_user_payouts_wait_after',1,2);
add_action('pn_user_payouts_delete_after','reserv_pn_user_payouts_wait_after',1,2);
function reserv_pn_user_payouts_wait_after($id, $item){
	update_currency_reserv($item->currency_id);
}

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_pp');
function bd_pn_moduls_active_pp(){
global $wpdb;	
	
    $query = $wpdb->query("SHOW COLUMNS FROM ". $wpdb->prefix ."users LIKE 'ref_id'");
    if ($query == 0) {
        $wpdb->query("ALTER TABLE ". $wpdb->prefix ."users ADD `ref_id` bigint(20) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'partner_pers'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `partner_pers` varchar(50) NOT NULL default '0'");
    }
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'p_payout'"); 
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `p_payout` int(2) NOT NULL default '1'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'payout_com'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `payout_com` varchar(50) NOT NULL default '0'");
    }
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'ref_id'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `ref_id` bigint(20) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'partner_sum'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `partner_sum` varchar(50) NOT NULL default '0'");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'partner_pers'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `partner_pers` varchar(50) NOT NULL default '0'");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'pcalc'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `pcalc` int(1) NOT NULL default '0'");
    }		
	
/* 	
partner_pers
*/	
	$table_name= $wpdb->prefix ."partner_pers";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
        `sumec` varchar(50) NOT NULL default '0',
		`pers` varchar(50) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$table_name= $wpdb->prefix ."plinks";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(250) NOT NULL,
		`pdate` datetime NOT NULL,
		`pbrowser` longtext NOT NULL,
		`pip` longtext NOT NULL,
		`prefer` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

/*
0 - в ожидании
1 - выполнена
2 - отказано
3 - отменена пользователем
*/
	$table_name= $wpdb->prefix ."user_payouts";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`pay_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(250) NOT NULL,
		`pay_sum` varchar(250) NOT NULL default '0',
		`pay_sum_or` varchar(250) NOT NULL default '0',
		`currency_id` bigint(20) NOT NULL default '0',
		`psys_title` longtext NOT NULL,
		`currency_code_id` bigint(20) NOT NULL default '0',
		`currency_code_title` varchar(250) NOT NULL,
		`pay_account` varchar(250) NOT NULL,
		`status` int(1) NOT NULL default '0',
		`comment` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_pp');
function bd_pn_moduls_migrate_pp(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'p_payout'"); 
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `p_payout` int(2) NOT NULL default '1'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'payout_com'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency ADD `payout_com` varchar(50) NOT NULL default '0'");
    }
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'ref_id'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `ref_id` bigint(20) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'partner_sum'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `partner_sum` varchar(50) NOT NULL default '0'");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'partner_pers'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `partner_pers` varchar(50) NOT NULL default '0'");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'pcalc'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `pcalc` int(1) NOT NULL default '0'");
    }

	$table_name= $wpdb->prefix ."user_payouts";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`pay_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL default '0',
		`user_login` varchar(250) NOT NULL,
		`pay_sum` varchar(250) NOT NULL default '0',
		`pay_sum_or` varchar(250) NOT NULL default '0',
		`currency_id` bigint(20) NOT NULL default '0',
		`psys_title` longtext NOT NULL,
		`currency_code_id` bigint(20) NOT NULL default '0',
		`currency_code_title` varchar(250) NOT NULL,
		`pay_account` varchar(250) NOT NULL,
		`status` int(1) NOT NULL default '0',
		`comment` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

}

add_filter('pn_tech_pages', 'list_tech_pages_pp');
function list_tech_pages_pp($pages){
 
	$pages[] = array(
        'post_name'      => 'paccount',
        'post_title'     => '[en_US:]Affiliate account[:en_US][ru_RU:]Партнёрский аккаунт[:ru_RU]',
		'post_content'   => '[paccount_page]',
		'post_template'   => 'pn-pluginpage.php',
	);	
	$pages[] = array(
        'post_name'      => 'promotional',
        'post_title'     => '[en_US:]Promotional materials[:en_US][ru_RU:]Рекламные материалы[:ru_RU]',
		'post_content'   => '[promotional_page]',
		'post_template'   => 'pn-pluginpage.php',
	);	
	$pages[] = array(
        'post_name'      => 'pexch',
        'post_title'     => '[en_US:]Affiliate exchanges[:en_US][ru_RU:]Партнёрские обмены[:ru_RU]',
		'post_content'   => '[pexch_page]',
		'post_template'   => 'pn-pluginpage.php',
	);	
	$pages[] = array(
        'post_name'      => 'plinks',
        'post_title'     => '[en_US:]Affiliate transitions[:en_US][ru_RU:]Партнёрские переходы[:ru_RU]',
		'post_content'   => '[plinks_page]',
		'post_template'   => 'pn-pluginpage.php',
	);	
	$pages[] = array(
        'post_name'      => 'preferals',
        'post_title'     => '[en_US:]Referrals[:en_US][ru_RU:]Рефералы[:ru_RU]',
		'post_content'   => '[preferals_page]',
		'post_template'   => 'pn-pluginpage.php',
	);
	$pages[] = array(
        'post_name'      => 'payouts',
        'post_title'     => '[en_US:]Affiliate payouts[:en_US][ru_RU:]Вывод партнёрских средств[:ru_RU]',
		'post_content'   => '[payouts_page]',
		'post_template'   => 'pn-pluginpage.php',
	);
	$pages[] = array(
	    'post_name' => 'partnersfaq',
	    'post_title' => '[en_US:]Affiliate FAQ[:en_US][ru_RU:]Партнёрский FAQ[:ru_RU]',
	    'post_content' => '',
		'post_template' => '',
	);
	$pages[] = array(
	    'post_name' => 'terms',
	    'post_title' => '[en_US:]Affiliate terms and conditions[:en_US][ru_RU:]Условия участия в партнерской программе[:ru_RU]',
	    'post_content' => '',
		'post_template' => '',
	);		
	
	return $pages;
}

add_filter('pn_caps','pp_pn_caps');
function pp_pn_caps($pn_caps){
	$pn_caps['pn_pp'] = __('Use affiliate program','pn');
	$pn_caps['pn_pp_bids'] = __('Editing the amount of the partner reward','pn');
	return $pn_caps;
}

add_filter('list_admin_notify','list_admin_notify_payout');
function list_admin_notify_payout($places_admin){
	$places_admin['payout'] = __('Affiliate reward payout request','pn');
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_partprofit');
function list_user_notify_partprofit($places_admin){
	$places_admin['partprofit'] = __('Affiliate reward charging','pn');
	return $places_admin;
}

add_filter('list_notify_tags_payout','def_mailtemp_tags_payout');
function def_mailtemp_tags_payout($tags){
	$tags['user'] = __('User','pn');
	$tags['sum'] = __('Amount','pn');
	return $tags;
}

add_filter('list_notify_tags_partprofit','def_mailtemp_tags_partprofit');
function def_mailtemp_tags_partprofit($tags){
	$tags['sum'] = __('Amount','pn');
	$tags['ctype'] = __('Currency code','pn');
	return $tags;
}

add_action('admin_menu', 'pn_adminpage_pp',200);
function pn_adminpage_pp(){
global $premiumbox;	
	
	if(current_user_can('administrator') or current_user_can('pn_pp')){
		
		add_menu_page(__('Affiliate program','pn'), __('Affiliate program','pn'), 'read', 'pn_pp', array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('pp'));  
		add_submenu_page("pn_pp", __('Statistics','pn'), __('Statistics','pn'), 'read', "pn_pp", array($premiumbox, 'admin_temp'));
		
		$hook = add_submenu_page("pn_pp", __('Partnership exchanges','pn'), __('Partnership exchanges','pn'), 'read', "pn_pexch", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );		
		
		$hook = add_submenu_page("pn_pp", __('Transitions','pn'), __('Transitions','pn'), 'read', "pn_plinks", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );
		
		$hook = add_submenu_page("pn_pp", __('Referrals','pn'), __('Referrals','pn'), 'read', "pn_preferals", array($premiumbox, 'admin_temp'));
		add_action( "load-$hook", 'pn_trev_hook' );

		$hook = add_submenu_page("pn_pp", __('Royalties','pn'), __('Royalties','pn'), 'read', "pn_partnpers", array($premiumbox, 'admin_temp'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_pp", __('Add reward','pn'), __('Add reward','pn'), 'read', "pn_add_partnpers", array($premiumbox, 'admin_temp'));		
		
		$hook = add_submenu_page("pn_pp", __('Payouts','pn'), __('Payouts','pn'), 'read', "pn_payouts", array($premiumbox, 'admin_temp'));	
		add_action( "load-$hook", 'pn_trev_hook' );		
		
		add_submenu_page("pn_pp", __('Banners','pn'), __('Banners','pn'), 'read', "pn_pbanners", array($premiumbox, 'admin_temp'));	
		add_submenu_page("pn_pp", __('Settings','pn'), __('Settings','pn'), 'read', "pn_psettings", array($premiumbox, 'admin_temp'));
	
	}
}

global $premiumbox;
$premiumbox->file_include($path.'/psettings');
$premiumbox->file_include($path.'/users'); 
$premiumbox->file_include($path.'/stats');
$premiumbox->file_include($path.'/preferals');
$premiumbox->file_include($path.'/plinks'); 
$premiumbox->file_include($path.'/cron');
$premiumbox->file_include($path.'/partnpers');
$premiumbox->file_include($path.'/add_partnpers');
$premiumbox->file_include($path.'/pbanners');
$premiumbox->file_include($path.'/payouts');
$premiumbox->file_include($path.'/pexch'); 

$premiumbox->file_include($path.'/filters');

$premiumbox->auto_include($path.'/shortcode');
