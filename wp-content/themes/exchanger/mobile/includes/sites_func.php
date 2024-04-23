<?php
if( !defined( 'ABSPATH')){ exit(); }

if (function_exists('register_nav_menu')) {
	register_nav_menu('mobile_top_menu', __('Mobile top menu for guest','pntheme'));
	register_nav_menu('mobile_top_menu_user', __('Mobile top menu for users','pntheme'));
}

if(function_exists('is_mobile') and is_mobile()){
	
	remove_action('wp_enqueue_scripts', 'my_themeinit', 0);
	add_action('wp_enqueue_scripts', 'my_mobthemeinit', 100);
	function my_mobthemeinit(){
		global $or_template_directory, $premiumbox;

		$vers = $premiumbox->plugin_version;
		if($premiumbox->is_debug_mode()){
			$vers = current_time('timestamp');
		}

		wp_enqueue_style('mobile theme style', $or_template_directory . "/mobile/style.css", false, $vers);
		wp_deregister_style('open-sans');
		wp_enqueue_style('open-sans', is_ssl_url("http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=latin,cyrillic-ext,cyrillic"), false, "1.0");
		wp_enqueue_script("jquery checkbox", $or_template_directory . "/js/jquery-checkbox.js", false, $vers);
		wp_enqueue_script('jquery mobile site js', $or_template_directory.'/mobile/js/site.js', false, $vers);

	}
} 