<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_cf');
function pn_adminpage_cf(){
global $premiumbox;
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$hook = add_menu_page( __('Custom fields','pn'), __('Custom fields','pn'), 'read', "pn_cf", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('dfield'));	
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_cf", __('Add custom field','pn'), __('Add custom field','pn'), 'read', "pn_add_cf", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_cf", __('Sort custom fields','pn'), __('Sort custom fields','pn'), 'read', "pn_sort_cf", array($premiumbox, 'admin_temp'));
	}
}

add_filter('cf_auto_filed','def_cf_auto_filed',1);
function def_cf_auto_filed($cf_auto){
	
	$cf_auto = array();
	$cf_auto[0] = '--' . __('No','pn') . '--';
	$cf_auto['first_name'] = __('First name', 'pn');
	$cf_auto['last_name'] = __('Last name', 'pn');
	$cf_auto['second_name'] = __('Second name', 'pn');
	$cf_auto['user_phone'] = __('Phone no.', 'pn');
	$cf_auto['user_skype'] = __('Skype', 'pn');
	$cf_auto['user_email'] = __('E-mail', 'pn');
	$cf_auto['user_passport'] = __('Passport number','pn');	
	
	return $cf_auto;
}

add_filter('cf_auto_user_value','def_cf_auto_user_value',1,3);
function def_cf_auto_user_value($value,$cf_auto,$ui){
	if($cf_auto == 'first_name'){
		$value = pn_strip_input(is_isset($ui,'first_name'));
	} elseif($cf_auto == 'last_name'){
		$value = pn_strip_input(is_isset($ui,'last_name'));
	} elseif($cf_auto == 'second_name'){
		$value = pn_strip_input(is_isset($ui,'second_name'));
	} elseif($cf_auto == 'user_phone'){
		$value = is_phone(is_isset($ui,'user_phone'));
	} elseif($cf_auto == 'user_skype'){
		$value = pn_strip_input(is_isset($ui,'user_skype'));
	} elseif($cf_auto == 'user_email'){
		$value = is_email(is_isset($ui,'user_email'));
	} elseif($cf_auto == 'user_passport'){
		$value = pn_strip_input(is_isset($ui,'user_passport'));		
	}	
	return $value;
}

add_filter('cf_strip_auto_value','def_cf_strip_auto_value',1,2);
function def_cf_strip_auto_value($op_value, $op_auto){
	if($op_auto == 'first_name'){
		$op_value = get_caps_name($op_value);
	} elseif($op_auto == 'last_name'){
		$op_value = get_caps_name($op_value);
	} elseif($op_auto == 'second_name'){
		$op_value = get_caps_name($op_value);
	} elseif($op_auto == 'user_phone'){
		$op_value = is_phone($op_value);
	} elseif($op_auto == 'user_email'){
		$op_value = is_email($op_value);
	}	
	return $op_value;
}

add_action('pn_cf_delete', 'def_pn_cf_delete', 10 ,2);
function def_pn_cf_delete($id, $item){
global $wpdb;
	
	$wpdb->query("DELETE FROM ".$wpdb->prefix."cf_directions WHERE cf_id = '$id'");	
}

add_action('pn_direction_delete', 'cf_pn_direction_delete', 10 ,2);
function cf_pn_direction_delete($id, $item){
global $wpdb;
	
	$wpdb->query("DELETE FROM ".$wpdb->prefix."cf_directions WHERE direction_id = '$id'");
}

add_action('pn_direction_copy', 'cf_pn_direction_copy', 10 ,2);
function cf_pn_direction_copy($last_id, $data_id){
global $wpdb;
	
	$cf_directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."cf_directions WHERE direction_id='$last_id'");
	foreach($cf_directions as $dir){
		$arr = array();
		$arr['direction_id'] = $data_id;
		$arr['cf_id'] = $dir->cf_id;
		$arr['place_id'] = $dir->place_id;
		$wpdb->insert($wpdb->prefix.'cf_directions', $arr);
	}
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'sort');
$premiumbox->include_patch(__FILE__, 'cron');