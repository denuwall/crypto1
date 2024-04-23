<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Rates[:en_US][ru_RU:]Тарифы[:ru_RU]
description: [en_US:]Rates[:en_US][ru_RU:]Тарифы[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_filter('pn_tech_pages', 'list_tech_pages_tarifs');
function list_tech_pages_tarifs($pages){
 
	$pages[] = array(
		'post_name'      => 'tarifs',
		'post_title'     => '[en_US:]Tariffs[:en_US][ru_RU:]Тарифы[:ru_RU]',
		'post_content'   => '[tarifs]',
		'post_template'   => 'pn-pluginpage.php',
	);			
	
	return $pages;
}

add_filter('pn_exchange_cat_filters','pn_exchange_cat_filters_tarifs');
function pn_exchange_cat_filters_tarifs($cats){
	$cats['tar'] = __('Tariffs','pn');
	return $cats;
}

global $premiumbox;
$premiumbox->auto_include($path.'/shortcode');