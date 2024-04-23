<?php 
/*
Plugin Name: Premium Exchanger
Plugin URI: http://best-curs.info
Description: Professional e-currency exchanger
Version: 1.5
Author: Best-Curs.info
Author URI: http://best-curs.info
*/

if( !defined( 'ABSPATH')){ exit(); }

if (strpos($_SERVER['REQUEST_URI'], "eval(") ||
    strpos($_SERVER['REQUEST_URI'], "CONCAT") ||
    strpos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
    strpos($_SERVER['REQUEST_URI'], "base64")) {
		header("HTTP/1.1 414 Request-URI Too Long");
		header("Status: 414 Request-URI Too Long");
		header("Connection: Close");
		exit;
}

/* 
Основные константы плагина
*/
if(!defined('PN_PLUGIN_NAME')){
	define('PN_PLUGIN_NAME', plugin_basename(__FILE__));
}
if(!defined('PN_PLUGIN_DIR')){
	define('PN_PLUGIN_DIR', str_replace("\\", "/", dirname(__FILE__).'/'));
}
if(!defined('PN_PLUGIN_URL')){
	define('PN_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

/* подключаем фреймворк */
require_once( dirname(__FILE__) . "/premium/index.php");
if(!class_exists('Premium')){
	return;
}

require_once( dirname(__FILE__) . "/userdata.php");

require( dirname(__FILE__) . "/includes/plugin_class.php");
if(!class_exists('PremiumBox')){
	return;
}

/* 
Если вы проводите тестирование, поставьте 1, в противном случае, оставьте 0. Также желательно в файле wp-config.php поставить WP_DEBUG true.
If you are testing the system then enter 1. In other cases enter 0. Note that it will be of much help if you add the following line in the wp-config.php file: WP_DEBUG true.
*/
$debug_mode = 0;

global $premiumbox;
$premiumbox = new PremiumBox($debug_mode);

pn_disallow_file_mode();

pn_concatenate_scripts();

$premiumbox->file_include('includes/pn_func');
$premiumbox->file_include('includes/pn_bd_func');
$premiumbox->file_include('includes/pn_admin_func');
$premiumbox->file_include('includes/deprecated');
$premiumbox->file_include('includes/lang_filters');
$premiumbox->file_include('includes/security'); 

$premiumbox->file_include('default/mail_temps');
$premiumbox->file_include('default/sms_temps');
$premiumbox->file_include('default/migrate');
$premiumbox->file_include('default/lang/index');
$premiumbox->file_include('default/rtl/index');
$premiumbox->file_include('default/roles/index');
$premiumbox->file_include('default/config');
$premiumbox->file_include('default/pn_config');
$premiumbox->file_include('default/themeconfig');
$premiumbox->file_include('default/globalajax/index');
$premiumbox->file_include('default/admin/index');
$premiumbox->file_include('default/cron');
$premiumbox->file_include('default/newadminpanel/index');
$premiumbox->file_include('default/moduls');
$premiumbox->file_include('default/users/index');

$premiumbox->file_include('default/exchange_config');
$premiumbox->file_include('default/exchange_filters'); 
$premiumbox->file_include('default/reserv_config');
$premiumbox->file_include('default/directions/index'); 
$premiumbox->file_include('default/cf/index');
$premiumbox->file_include('default/currency/index'); 
$premiumbox->file_include('default/psys/index');
$premiumbox->file_include('default/currency_codes/index');
$premiumbox->file_include('default/cfc/index');
$premiumbox->file_include('default/reserv/index');
$premiumbox->file_include('default/exchange/index');
$premiumbox->file_include('default/merchant/index');
$premiumbox->file_include('default/bids/index'); 

pn_verify_extended(array('moduls','merchants','paymerchants','sms','wchecks'));

$premiumbox->file_include('default/up_mode/index');
$premiumbox->file_include('default/update/index');
$premiumbox->file_include('default/captcha/index');
$premiumbox->file_include('default/icon_indicators/index');
$premiumbox->file_include('default/logs_settings/index');

/* $premiumbox->file_include('infoblock'); */

add_action('widgets_init', 'pn_register_widgets');
function pn_register_widgets(){
global $premiumbox;
	$premiumbox->auto_include('widget');	 
}

$premiumbox->auto_include('shortcode');