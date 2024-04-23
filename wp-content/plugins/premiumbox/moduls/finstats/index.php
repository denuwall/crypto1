<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Financial statistics[:en_US][ru_RU:]Финансовая статистика[:ru_RU]
description: [en_US:]Financial statistics[:en_US][ru_RU:]Финансовая статистика[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('admin_menu', 'pn_adminpage_finstats');
function pn_adminpage_finstats(){
global $premiumbox;	
	if(current_user_can('administrator') or current_user_can('pn_finstats')){
		add_menu_page(__('Financial statistics','pn'), __('Financial statistics','pn'), 'read', "pn_finstats", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('finstats'));
		add_submenu_page("pn_finstats", __('From amount of exchange','pn'), __('From amount of exchange','pn'), 'read', "pn_finstats", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_finstats", __('By exchange direction','pn'), __('By exchange direction','pn'), 'read', "pn_finstats_direction", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_finstats", __('From profit','pn'), __('From profit','pn'), 'read', "pn_finstats_bid", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','finstats_pn_caps');
function finstats_pn_caps($pn_caps){
	$pn_caps['pn_finstats'] = __('Use financial statistics','pn');
	return $pn_caps;
}

global $premiumbox;
$premiumbox->file_include($path.'/finstats');
$premiumbox->file_include($path.'/finstats_bid');
$premiumbox->file_include($path.'/finstats_direction');