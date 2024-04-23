<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter( 'admin_footer_text', '__return_false', 0 );

global $premiumbox;
if($premiumbox->get_option('admin', 'w0') == 1){
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

add_action('wp_dashboard_setup', 'pn_remove_dashboard_widgets' );
function pn_remove_dashboard_widgets() {
global $premiumbox;

	if($premiumbox->get_option('admin','w1') == 1){
		remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); 
	}
	if($premiumbox->get_option('admin','w2') == 1){
		remove_meta_box('dashboard_activity', 'dashboard', 'normal'); 
	}	
	if($premiumbox->get_option('admin','w3') == 1){
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); 
	}	
	if($premiumbox->get_option('admin','w4') == 1 or function_exists('is_ml') and is_ml()){
		remove_meta_box('dashboard_primary', 'dashboard', 'side'); 
	}	
	if($premiumbox->get_option('admin','w5') == 1){
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	}
	if($premiumbox->get_option('admin','w6') == 1){
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	}
	if($premiumbox->get_option('admin','w7') == 1){
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	}	
	if($premiumbox->get_option('admin','w8') == 1){
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
	}
	
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');
}

add_action( 'widgets_init', 'pn_remove_default_widget' );
function pn_remove_default_widget() {
    unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Tag_Cloud');		
	unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Archives');		
	unregister_widget('WP_Widget_Meta');	
	unregister_widget('WP_Widget_Search');
	if(defined('PN_COMMENT_STATUS') and constant('PN_COMMENT_STATUS') != 'true'){
		unregister_widget('WP_Widget_Recent_Comments');
	}	
	unregister_widget('WP_Widget_Categories');
	/* unregister_widget('WP_Widget_Text'); */		
}

add_action('admin_init', 'admin_init_new_user_notification_email_admin');
function admin_init_new_user_notification_email_admin(){
global $premiumbox;	
	add_filter('wp_new_user_notification_email_admin', 'pn_wp_new_user_notification_email_admin');
	if($premiumbox->get_option('admin','wm1') == 1){
		remove_action( 'personal_options_update', 'send_confirmation_on_profile_email');
	}	
}

function pn_wp_new_user_notification_email_admin($wp_new_user_notification_email_admin){
	if(isset($wp_new_user_notification_email_admin['to'])){
		unset($wp_new_user_notification_email_admin['to']);
	}
	return $wp_new_user_notification_email_admin;
}


add_action( 'admin_menu', 'pn_remove_meta_boxes' );
function pn_remove_meta_boxes() {
global $menu, $premiumbox, $submenu;
	
	if(function_exists('is_ml') and is_ml()){
		remove_meta_box('postexcerpt', 'post', 'normal');
	}
	remove_meta_box('trackbacksdiv', 'post', 'normal');
	remove_meta_box('postcustom', 'post', 'normal');
	remove_meta_box('trackbacksdiv', 'page', 'normal');
	remove_meta_box('postcustom', 'page', 'normal');
	if(defined('PN_COMMENT_STATUS') and constant('PN_COMMENT_STATUS') != 'true'){
		remove_meta_box('commentsdiv', 'post', 'normal');
		remove_meta_box('commentsdiv', 'page', 'normal');
	}	
	
	$restricted = array();
	if($premiumbox->get_option('admin','ws0') == 1){
		$restricted[] = __('Posts');
	}
	if($premiumbox->get_option('admin','ws1') == 1){
		$restricted[] = __('Comments');
	}	
	
	remove_submenu_page('themes.php', 'customize.php');

	if(isset($submenu['themes.php'])){
        foreach($submenu[ 'themes.php' ] as $index => $menu_item){
            if(in_array(__('Customize'), $menu_item)) {
                unset($submenu['themes.php'][$index]);
            }
        }
    }
	
	end($menu);
	while(prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
			unset($menu[key($menu)]);
		}
	}	
}

remove_action( 'wp_head', 'wp_generator' );

foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
	remove_action( $action, 'the_generator' );
}

add_filter('rest_enabled', '__return_false');
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
remove_action( 'init', 'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );
remove_action( 'rest_api_init', 'wp_oembed_register_route');
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');

add_action('wp_before_admin_bar_render', 'pn_admin_bar_links');
function pn_admin_bar_links() {
global $wp_admin_bar, $premiumbox;

    $wp_admin_bar->remove_menu('wp-logo'); 
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('new-link');
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('search');
	$wp_admin_bar->remove_menu('customize');
	if($premiumbox->get_option('admin','ws0') == 1){
		$wp_admin_bar->remove_menu('new-post');
	}
	if($premiumbox->get_option('admin','ws1') == 1){
		$wp_admin_bar->remove_menu('comments');
	}	
}

add_filter('the_content', 'do_shortcode', 10);		
add_filter('comment_text', 'do_shortcode', 10);

add_action( 'parse_query', 'pn_search_turn_off' );
function pn_search_turn_off( $q, $e = true ) {
	if ( is_search() ) {
		$q->is_search = false;
		$q->query_vars['s'] = false;
		$q->query['s'] = false;	
		if ( $e == true ){
			$q->is_404 = true;
		}
	}
}

add_filter( 'get_search_form', 'def_get_search_form');
function def_get_search_form(){
	return null;
}

add_filter('send_password_change_email', 'def_send_password_change_email', 1, 3);
function def_send_password_change_email($send, $user, $userdata){
global $premiumbox;	
	if($premiumbox->get_option('admin','wm0') == 1){
		if(isset($userdata['ID']) and !user_can( $userdata['ID'], 'administrator' )){
			return false;
		} 
	}
			
	return $send;	
}
 
function disable_all_feeds() {
	pn_display_mess(__('RSS feed is off','pn'));
}

global $premiumbox;
if($premiumbox->get_option('admin','wm2') == 1){
	add_action('do_feed', 'disable_all_feeds', 1);
	add_action('do_feed_rdf', 'disable_all_feeds', 1);
	add_action('do_feed_rss', 'disable_all_feeds', 1);
	add_action('do_feed_rss2', 'disable_all_feeds', 1);
	add_action('do_feed_atom', 'disable_all_feeds', 1);
}