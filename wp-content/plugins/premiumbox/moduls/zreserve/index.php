<?php 
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Request for reserve[:en_US][ru_RU:]Запрос резерва[:ru_RU]
description: [en_US:]Request for reserve[:en_US][ru_RU:]Запрос резерва[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_zresrve');
function bd_pn_moduls_active_zresrve(){
global $wpdb;
	
/*
Запрос резерва

rdate - дата запроса
user_email - e-mail
naps_id - id направления
amount - сумма запроса
comment - комментарий
*/
	$table_name = $wpdb->prefix ."reserve_requests";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`rdate` datetime NOT NULL,
		`user_email` varchar(250) NOT NULL,
		`naps_id` bigint(20) NOT NULL default '0',
		`naps_title` longtext NOT NULL,
		`amount` varchar(250) NOT NULL,
		`comment` longtext NOT NULL,
		`locale` varchar(250) NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
}

add_action('admin_menu', 'pn_adminpage_zreserv');
function pn_adminpage_zreserv(){
global $premiumbox;
		
	if(current_user_can('administrator') or current_user_can('pn_zreserv')){
		$hook = add_menu_page( __('Reserve requests','pn'), __('Reserve requests','pn'), 'read', "pn_zreserv", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('zreserve'));	
		add_action( "load-$hook", 'pn_trev_hook' );
	}
}

add_filter('pn_caps','zreserv_pn_caps');
function zreserv_pn_caps($pn_caps){
	$pn_caps['pn_zreserv'] = __('Work with reserve requests','pn');
	return $pn_caps;
}

add_filter('list_admin_notify','list_admin_notify_zreserv');
function list_admin_notify_zreserv($places_admin){
	$places_admin['zreserv_admin'] = __('Reserve request','pn');
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_zreserv');
function list_user_notify_zreserv($places_admin){
	$places_admin['zreserv'] = __('Reserve request','pn');
	return $places_admin;
}

add_filter('list_notify_tags_zreserv_admin','def_list_notify_tags_zreserv_admin');
function def_list_notify_tags_zreserv_admin($tags){
	$tags['email'] = __('E-mail','pn');
	$tags['sum'] = __('Requested amount','pn');
	$tags['direction'] = __('Exchange direction','pn');
	$tags['comment'] = __('Comment','pn');
	$tags['ip'] = __('IP address','pn');
	return $tags;
}

add_filter('list_notify_tags_zreserv','def_list_notify_tags_zreserv');
function def_list_notify_tags_zreserv($tags){
	$tags['email'] = __('E-mail','pn');
	$tags['sumres'] = __('Amount reserved','pn');
	$tags['sum'] = __('Requested amount','pn');
	$tags['direction'] = __('Exchange direction','pn');
	$tags['direction_url'] = __('Exchange direction URL','pn');
	$tags['comment'] = __('Comment','pn');
	$tags['ip'] = __('IP address','pn');
	return $tags;
}

add_filter('placed_captcha', 'placed_captcha_zreserv');
function placed_captcha_zreserv($placed){
	$placed['reservform'] = __('Reserve request','pn');
	return $placed;
}

function get_zreserv_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['sum'] = array(
		'name' => 'sum',
		'title' => '',
		'placeholder' => __('Required amount', 'pn'),
		'req' => 1,
		'value' => '',
		'type' => 'input',
		'not_auto' => 0,
	);
	$items['email'] = array(
		'name' => 'email',
		'title' => '',
		'placeholder' => __('E-mail', 'pn'),
		'req' => 1,
		'value' => is_email(is_isset($ui,'user_email')),
		'type' => 'input',
		'not_auto' => 0,
		'classes' => 'notclear',
	);		
	$items['comment'] = array(
		'name' => 'comment',
		'title' => '',
		'placeholder' => __('Comment', 'pn'),
		'req' => 0,
		'value' => '', 
		'type' => 'text',
		'not_auto' => 0,
	);	
	$items = apply_filters('get_form_filelds',$items, 'reservform', $ui, $place);
	$items = apply_filters('reserv_form_filelds',$items, $ui, $place);	
	
	return $items;
}

add_action('pn_direction_delete','zreserv_pn_direction_delete',0,2);
function zreserv_pn_direction_delete($id, $item){
global $wpdb;

	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."reserve_requests WHERE naps_id = '$id'");
	foreach($items as $item){	
		$item_id = $item->id;
		do_action('pn_zreserv_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."reserve_requests WHERE id = '$item_id'");
		do_action('pn_zreserv_delete', $item_id, $item);
		if($result){
			do_action('pn_zreserv_delete_after', $item_id, $item);
		}
	}	
}

add_filter('pn_exchange_config_option', 'zreserv_exchange_config_option');
function zreserv_exchange_config_option($options){
global $premiumbox;

	$options['reserv'] = array(
		'view' => 'select',
		'title' => __('Allow reserve request','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('exchange','reserv'),
		'name' => 'reserv',
	);		
	
	return $options;	
}

add_action('pn_exchange_config_option_post', 'zreserv_exchange_config_option_post');
function zreserv_exchange_config_option_post(){
global $premiumbox;
	
	$reserv = intval(is_param_post('reserv'));
	$premiumbox->update_option('exchange', 'reserv', $reserv);
	
}

function is_enable_zreserve(){
global $premiumbox;	
	
	$en_reserv = intval($premiumbox->get_option('exchange','reserv'));
	return apply_filters('is_enable_zreserve', $en_reserv);
}

/* filters table */
add_filter('tbl1_rightcol_data','tbl1_rightcol_data_zreserv', 10, 6); 
function tbl1_rightcol_data_zreserv($data, $direction_data, $vd1, $vd2, $course, $cur_to){
	if(is_enable_zreserve()){
						
		$v_title1 = get_currency_title($vd1);		
		$v_title2 = get_currency_title($vd2);				
						
		$data['zreserv'] = '
		<div class="xtt_one_line_rez js_reserv" data-id="'. $direction_data->direction_id .'" data-title="'. $v_title1 .'-'. $v_title2 .'">
			<div class="xtt_one_line_rez_ins">
				<span>'. __('Not enough?','pn') .'</span>
			</div>
		</div>														
		';
		
	}
	return $data;													
}

add_filter('tbl4_rightcol_data','tbl4_rightcol_data_zreserv', 10, 5); 
function tbl4_rightcol_data_zreserv($data, $direction_data, $vd1, $vd2, $cur_to){
	if(is_enable_zreserve()){
						
		$v_title1 = get_currency_title($vd1);		
		$v_title2 = get_currency_title($vd2);				
						
		$data['zreserv'] = '
		<div class="xtt4_one_line_rez js_reserv" data-id="'. $direction_data->direction_id .'" data-title="'. $v_title1 .'-'. $v_title2 .'">
			<div class="xtt4_one_line_rez_ins">
				<span>'. __('Not enough?','pn') .'</span>
			</div>
		</div>														
		';
		
	}
	return $data;													
}

add_filter('tbl2_rightcol_data','tbl2_rightcol_data_zreserv', 10, 7); 
function tbl2_rightcol_data_zreserv($data, $cdata, $vd1, $vd2, $direction, $user_id, $post_sum){
	if(is_enable_zreserve()){
						
		$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv, $vd2->currency_decimal, $direction), $vd2->currency_decimal, 'reserv');
				
		$v_title1 = get_currency_title($vd1);		
		$v_title2 = get_currency_title($vd2);				
						
		$data['zreserv'] = '
		<div class="xtp_line xtp_exchange_reserve">
			'. __('Reserve','pn') .': <span class="js_reserv_html">'. $reserv .' '. $cdata['currency_code_get'] .'</span> <a href="#" class="xtp_link js_reserv" data-id="'. $direction->id .'" data-title="'. $v_title1 .'-'. $v_title2 .'">'. __('Not enough?','pn') .'</a> 
		</div>														
		';
		
	}
	return $data;													
}

add_filter('tbl3_rightcol_data','tbl3_rightcol_data_zreserv', 10, 7); 
function tbl3_rightcol_data_zreserv($data, $cdata, $vd1, $vd2, $direction, $user_id, $post_sum){
	if(is_enable_zreserve()){
						
		$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv, $vd2->currency_decimal, $direction), $vd2->currency_decimal, 'reserv');
				
		$v_title1 = get_currency_title($vd1);		
		$v_title2 = get_currency_title($vd2);				
						
		$data['zreserv'] = '
		<div class="xtl_line xtl_exchange_reserve">
			'. __('Reserve','pn') .': <span class="js_reserv_html">'. $reserv .' '. $cdata['currency_code_get'] .'</span> <a href="#" class="xtp_link js_reserv" data-id="'. $direction->id .'" data-title="'. $v_title1 .'-'. $v_title2 .'">'. __('Not enough?','pn') .'</a> 
		</div>														
		';
		
	}
	return $data;													
}
/* end filters table */
 
add_filter('after_update_currency_reserv','zreserv_after_update_currency_reserv', 10, 3);
function zreserv_after_update_currency_reserv($currency_reserv, $currency_id, $item){ 
global $wpdb;
	$currency_id = intval($currency_id);
	if(is_enable_zreserve()){
		
		if(isset($item->id)){
			$directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND direction_status='1' AND currency_id_get = '$currency_id'");
			foreach($directions as $direction){
				$direction_id = $direction->id;
				$reserv = get_direction_reserv($currency_reserv, $item->currency_decimal, $direction);
					
				$zapros = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."reserve_requests WHERE naps_id='$direction_id' AND amount <= $reserv");
				foreach($zapros as $za){
					$zaid = $za->id;
					$wpdb->query("DELETE FROM ".$wpdb->prefix."reserve_requests WHERE id = '$zaid'");
					
					$locale = pn_strip_input($za->locale);
					$direction_title = get_currency_title_by_id($direction->currency_id_give) .' &rarr; '. get_currency_title_by_id($direction->currency_id_get);
					$direction_url = get_exchange_link($direction->direction_name);		
					$user_email = is_email($za->user_email);			
								
					if($user_email){	
					
						$notify_tags = array();
						$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
						$notify_tags['[sumres]'] = $reserv;
						$notify_tags['[sum]'] = $za->amount;
						$notify_tags['[email]'] = $user_email;
						$notify_tags['[comment]'] = pn_strip_input($za->comment);
						$notify_tags['[ip]'] = pn_real_ip();
						$notify_tags['[direction]'] = $direction_title;
						$notify_tags['[direction_url]'] = $direction_url;
						$notify_tags = apply_filters('notify_tags_zreserv', $notify_tags, $direction, $za, $reserv);					
						
						$user_send_data = array(
							'user_email' => $user_email,
							'user_phone' => '',
						);	
						$result_mail = apply_filters('premium_send_message', 0, 'zreserv', $notify_tags, $user_send_data, $locale); 
						
					}					
				}
			}
		}
	}
	return $currency_reserv;
}

add_filter('list_icon_indicators', 'zreserv_icon_indicators');
function zreserv_icon_indicators($lists){
	$lists['zreserv'] = __('Reserve requests','pn');
	return $lists;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_zreserv');
function wp_before_admin_bar_render_zreserv(){
global $wp_admin_bar, $wpdb, $premiumbox;
    if(current_user_can('administrator') or current_user_can('pn_zreserv')){
		if(get_icon_indicators('zreserv')){
			$count = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."reserve_requests");
			if($count > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_zreserve',
					'href' => admin_url('admin.php?page=pn_zreserv'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/zreserv.png) no-repeat center center"></div>',
					'meta' => array( 
						'title' => sprintf(__('Reserve requests (%s)','pn'), $count) 
					)		
				));	
			}
		}
	}
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'window');