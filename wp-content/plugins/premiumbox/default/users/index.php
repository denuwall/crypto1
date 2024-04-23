<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_users_admin_menu')){
	add_action('admin_menu', 'pn_users_admin_menu');
	function pn_users_admin_menu(){
		global $premiumbox;	
		
		if(current_user_can('administrator')){
			$hook = add_submenu_page('users.php', __('Authorization log','pn'), __('Authorization log','pn'), 'read', 'pn_alogs', array($premiumbox, 'admin_temp'));  
			add_action( "load-$hook", 'pn_trev_hook' );
		}
	}
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'users');
$premiumbox->include_patch(__FILE__, 'enableip');
$premiumbox->include_patch(__FILE__, 'pincode');
$premiumbox->include_patch(__FILE__, 'twofactorauth');
$premiumbox->include_patch(__FILE__, 'list_auth');
$premiumbox->include_patch(__FILE__, 'uf_settings');
$premiumbox->include_patch(__FILE__, 'pn_users');