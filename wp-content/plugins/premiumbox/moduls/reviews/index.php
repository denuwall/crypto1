<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Reviews[:en_US][ru_RU:]Отзывы[:ru_RU]
description: [en_US:]Reviews[:en_US][ru_RU:]Отзывы[:ru_RU]
version: 1.5
category: [en_US:]Settings[:en_US][ru_RU:]Настройки[:ru_RU]
cat: sett
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_reviews');
function bd_pn_moduls_active_reviews(){
global $wpdb;
	
/* 
отзывы

user_id - id пользователя
user_name - имя пользователя
user_email - e-mail пользователя
user_site - сайт пользователя
review_date - дата
review_hash - хэш 
review_status - статус (moderation|publish)
review_locale - локализация
*/
	$table_name = $wpdb->prefix ."reviews";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',
		`user_id` bigint(20) NOT NULL default '0',
		`user_name` tinytext NOT NULL,
		`user_email` tinytext NOT NULL,
		`user_site` tinytext NOT NULL,
		`review_date` datetime NOT NULL,
		`review_hash` tinytext NOT NULL,
		`review_text` longtext NOT NULL,		
		`review_status` varchar(150) NOT NULL default 'moderation',
		`review_locale` varchar(10) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$table_name= $wpdb->prefix ."reviews_meta";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`item_id` bigint(20) NOT NULL default '0',
		`meta_key` longtext NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'create_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `create_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'edit_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `edit_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'auto_status'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `auto_status` int(1) NOT NULL default '1'");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'edit_user_id'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `edit_user_id` bigint(20) NOT NULL default '0'");
	}	
	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_reviews');
function bd_pn_moduls_migrate_reviews(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'create_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `create_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'edit_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `edit_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'auto_status'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `auto_status` int(1) NOT NULL default '1'");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."reviews LIKE 'edit_user_id'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."reviews ADD `edit_user_id` bigint(20) NOT NULL default '0'");
	}	
}

add_filter('pn_tech_pages', 'list_tech_pages_reviews');
function list_tech_pages_reviews($pages){
 
	$pages[] = array(
		'post_name'      => 'reviews',
		'post_title'     => '[en_US:]Reviews[:en_US][ru_RU:]Отзывы[:ru_RU]',
		'post_content'   => '[reviews_page]',
		'post_template'   => 'pn-pluginpage.php',
	);			
	
	return $pages;
}

add_filter('placed_captcha', 'placed_captcha_reviews');
function placed_captcha_reviews($placed){
	$placed['reviewsform'] = __('Add reviews form','pn');
	return $placed;
}

function is_reviews_hash($hash){
	$hash = pn_strip_input($hash);
	if (preg_match("/^[a-zA-z0-9]{25}$/", $hash, $matches )) {
		$r = $hash;
	} else {
		$r = 0;
	}
	return $r;
}

function update_reviews_meta($id, $key, $value){ 
	return update_pn_meta('reviews_meta', $id, $key, $value);
}

function get_reviews_meta($id, $key){
	return get_pn_meta('reviews_meta', $id, $key);
}

function delete_reviews_meta($id, $key){
	return delete_pn_meta('reviews_meta', $id, $key);
}

add_action('admin_menu', 'pn_adminpage_reviews');
function pn_adminpage_reviews(){
global $premiumbox;
	
	if(current_user_can('administrator') or current_user_can('pn_reviews')){
		$hook = add_menu_page(__('Reviews','pn'), __('Reviews','pn'), 'read', 'pn_reviews', array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('reviews'));  
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_reviews", __('Add','pn'), __('Add','pn'), 'read', "pn_add_reviews", array($premiumbox, 'admin_temp'));	
		add_submenu_page("pn_reviews", __('Settings','pn'), __('Settings','pn'), 'read', "pn_config_reviews", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','reviews_pn_caps');
function reviews_pn_caps($pn_caps){
	$pn_caps['pn_reviews'] = __('Work with reviews','pn');
	return $pn_caps;
} 

function get_review_link($review_id, $data=''){
global $wpdb, $premiumbox;

	$review_id = intval($review_id);

	if(!is_object($data)){
		$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."reviews WHERE auto_status = '1' AND id='$review_id'");
	}
	if(!isset($data->review_date)){
		return '#';
	}

	$review_date = pn_strip_input($data->review_date);
	
    $zcount = intval($premiumbox->get_option('reviews','count')); if($zcount < 1){ $zcount=10; } /* кол-во отзывов на странице */
	
	$reviews_temp = rtrim($premiumbox->get_page('reviews'),'/'); /* страница отзывов */
	$reviews_arr = explode('/',$reviews_temp);
	$reviews_ind = end($reviews_arr);
	
	$deduce = intval($premiumbox->get_option('reviews','deduce'));
	
	$where = '';
	if($deduce == 1){	
		$locale = pn_strip_input($data->review_locale);
		$where = " AND review_locale='$locale'";
		$reviews_page = get_site_url_or() . '/' . get_lang_key($locale) . '/' . $reviews_ind . '/';	
	} else {
		$reviews_page = get_site_url_or() . '/' . $reviews_ind . '/';
	}
	
	$cc = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."reviews WHERE auto_status = '1' AND review_status='publish' $where AND id != '$review_id' AND review_date >= '$review_date'"); /* кол-во отзывов после текущего */
	if($cc >= $zcount){ 
	    $pp = floor($cc / $zcount) + 1;
		if($pp > 1){
		    return $reviews_page .'page/'. $pp .'/#review-'. $review_id;
		} 
	} 
	
	return $reviews_page .'#review-'. $review_id;
}

function list_reviews($count=5){
global $wpdb, $premiumbox;
	$count = intval($count); if($count < 1){ $count = 5; }
	$deduce = intval($premiumbox->get_option('reviews','deduce'));
	$where = '';
	if($deduce == 1){	
		$locale = get_locale();
		$where = " AND review_locale='$locale'";	
	}	
	return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."reviews WHERE auto_status = '1' AND review_status = 'publish' $where ORDER BY review_date DESC limit $count");	
}

add_filter('list_admin_notify','list_admin_notify_reviews');
function list_admin_notify_reviews($places_admin){
	$places_admin['newreview'] = __('New review','pn');
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_reviews');
function list_user_notify_reviews($places_admin){
	$places_admin['newreview_auto'] = __('Autoresponder (new review)','pn');
	$places_admin['confirmreview'] = __('Review confirmation','pn');
	return $places_admin;
}

add_filter('list_notify_tags_newreview','def_list_notify_tags_newreview');
function def_list_notify_tags_newreview($tags){
	$tags['user'] = __('User','pn');
	$tags['management'] = __('Manage a review','pn');
	$tags['status'] = __('Review status','pn');
	return $tags;
}

add_filter('list_notify_tags_newreview_auto','def_list_notify_tags_newreview_auto');
function def_list_notify_tags_newreview_auto($tags){
	$tags['user'] = __('User','pn');
	$tags['status'] = __('Review status','pn');
	return $tags;
}

add_filter('list_notify_tags_confirmreview','def_list_notify_tags_confirmreview');
function def_list_notify_tags_confirmreview($tags){
	$tags['link'] = __('Confirmation Link','pn');
	return $tags;
}

add_action('pn_reviews_delete', 'def_reviews_delete', 10, 2);
function def_reviews_delete($data_id, $item){
global $wpdb;
	
	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."reviews_meta WHERE item_id = '$data_id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_reviewsmeta_delete_before', $id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."reviews_meta WHERE id = '$item_id'");
		if($result){
			do_action('pn_reviewsmeta_delete', $id, $item);
		}
	}	
}

add_filter('list_icon_indicators', 'reviews_icon_indicators');
function reviews_icon_indicators($lists){
	$lists['reviews'] = __('Reviews about moderation','pn');
	return $lists;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_reviews');
function wp_before_admin_bar_render_reviews(){
global $wp_admin_bar, $wpdb, $premiumbox;
    if(current_user_can('administrator') or current_user_can('pn_reviews')){
		if(get_icon_indicators('reviews')){
			$count = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."reviews WHERE auto_status = '1' AND review_status='moderation'");
			if($count > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_review',
					'href' => admin_url('admin.php?page=pn_reviews&mod=2'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/reviews.png) no-repeat center center"></div>',
					'meta' => array( 
						'title' => sprintf(__('Unapproved reviews (%s)','pn'), $count) 
					)		
				));	
			}
		}
	}
}

function mailto_add_reviews($review, $status){
	$review_id = intval($review->id); 
	$user_id = intval($review->user_id);
	$user_name = pn_strip_input($review->user_name);
	$user_email = is_email($review->user_email);
	
	if($status == 'moderation'){
		$textstatus = __('moderating','pn');
		$management = '( <a href="'. admin_url('admin.php?page=pn_add_reviews&item_id='.$review_id) .'">'. __('Edit','pn') .'</a> )';
	} else {
		$textstatus = __('published','pn');		
		$management = '( <a href="'. admin_url('admin.php?page=pn_add_reviews&item_id='.$review_id) .'">'. __('Edit','pn') .'</a> ) ( <a href="'. get_review_link($review_id, $review) .'">'. __('View','pn') .'</a> )';
	}		
	
	if($user_id){
		$user = '<a href="'. admin_url('user-edit.php?user_id='.$user_id) .'">'. $user_name .'</a>';
	} else {
		$user = $user_name;
	}	
	
	$notify_tags = array();
	$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
	$notify_tags['[user]'] = $user;
	$notify_tags['[status]'] = $textstatus;
	$notify_tags['[management]'] = $management;
	$notify_tags = apply_filters('notify_tags_newreview', $notify_tags);	
	
	$user_send_data = array(
		'user_email' => '',
		'user_phone' => '',
	);	
	$result_mail = apply_filters('premium_send_message', 0, 'newreview', $notify_tags, $user_send_data); 	
	
	$user = $user_name;
	
	$notify_tags = array();
	$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
	$notify_tags['[user]'] = $user;
	$notify_tags['[status]'] = $textstatus;
	$notify_tags = apply_filters('notify_tags_newreview_auto', $notify_tags);
	
	$user_send_data = array(
		'user_email' => $user_email,
		'user_phone' => '',
	);	
	$result_mail = apply_filters('premium_send_message', 0, 'newreview_auto', $notify_tags, $user_send_data);		
	
}

function get_reviews_form_filelds($place='shortcode'){
global $premiumbox;
	$ui = wp_get_current_user();

	$items = array();
	$items['name'] = array(
		'name' => 'name',
		'title' => __('Your name', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => pn_strip_input(is_isset($ui,'first_name')),
		'type' => 'input',
		'not_auto' => 0,
		'disable' => 0,
		'classes' => 'notclear',
	);
	$items['email'] = array(
		'name' => 'email',
		'title' => __('Your e-mail', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => is_email(is_isset($ui,'user_email')),
		'type' => 'input',
		'not_auto' => 0,
		'disable' => 0,
		'classes' => 'notclear',
	);
	$website = intval($premiumbox->get_option('reviews','website'));
	if($website == 1){
		$items['website'] = array(
			'name' => 'website',
			'title' => __('Website', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => esc_url(is_isset($ui,'user_url')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => 0,
			'classes' => 'notclear',
		);	
	}
	$items['text'] = array(
		'name' => 'text',
		'title' => __('Review', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '', 
		'type' => 'text',
		'not_auto' => 0,
		'classes' => '',
	);
	$items = apply_filters('get_form_filelds',$items, 'reviewsform', $ui, $place);
	$items = apply_filters('reviews_form_filelds',$items, $ui, $place);	
	
	return $items;
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'config');
$premiumbox->include_patch(__FILE__, 'cron');
$premiumbox->auto_include($path.'/widget');
$premiumbox->auto_include($path.'/shortcode');