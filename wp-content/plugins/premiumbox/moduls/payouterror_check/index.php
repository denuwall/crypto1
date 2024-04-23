<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Icon "Automatic payout error"[:en_US][ru_RU:]Иконка "Ошибка автовыплаты"[:ru_RU]
description: [en_US:]Icon "Automatic payout error" in topbar[:en_US][ru_RU:]Иконка "Ошибка автовыплаты" в топбаре[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_payouterror');
function wp_before_admin_bar_render_payouterror(){
global $wp_admin_bar, $wpdb, $premiumbox;
    if(current_user_can('administrator') or current_user_can('pn_bids')){
		$page = is_param_get('page');
		if($page != 'pn_bids'){	
			$z = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."exchange_bids WHERE status IN('payouterror')");
			if($z > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_payouterror_bids',
					'href' => admin_url('admin.php?page=pn_bids&idspage=1&bidstatus[]=payouterror'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/payouterror.png) no-repeat center center"></div>',
					'meta' => array( 'title' => __('Orders with payout error','pn').' ('. $z .')' )		
				));	
			}
		}
	}
}