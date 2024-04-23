<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_ga_settings')){
	
	global $premiumbox;
	$premiumbox->include_patch(__FILE__, 'settings');
	$premiumbox->include_patch(__FILE__, 'filters');

}