<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

global $or_template_directory;
if(!$or_template_directory){
	$or_template_directory = get_template_directory_uri();
}

global $or_site_url;
if(!$or_site_url){
	$or_site_url = rtrim(get_option('siteurl'), '/');
}

if(!function_exists('get_premium_version')){
	function get_premium_version(){
		return '1.8';
	}		
}

require_once( dirname(__FILE__) . "/includes/functions.php");
require_once( dirname(__FILE__) . "/includes/set_admin_pointer.php");
require_once( dirname(__FILE__) . "/includes/mail_filters.php");
require_once( dirname(__FILE__) . "/includes/admin_func.php");
require_once( dirname(__FILE__) . "/includes/menu_filters.php");
require_once( dirname(__FILE__) . "/includes/lang_func.php");
require_once( dirname(__FILE__) . "/includes/rtl_func.php");
require_once( dirname(__FILE__) . "/includes/title_filters.php");
require_once( dirname(__FILE__) . "/includes/form_class.php");
require_once( dirname(__FILE__) . "/includes/premium_class.php");
require_once( dirname(__FILE__) . "/includes/init_page.php");
require_once( dirname(__FILE__) . "/includes/init_cron.php");
require_once( dirname(__FILE__) . "/includes/pagenavi.php");
require_once( dirname(__FILE__) . "/includes/security.php");

if(!function_exists('premium_langs_loaded')){
	add_action('plugins_loaded', 'premium_langs_loaded');
	function premium_langs_loaded(){
		load_plugin_textdomain( 'premium', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' ); 
	}			
}