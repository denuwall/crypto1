<?php
if( !defined( 'ABSPATH')){ exit(); } 

/*
title: [en_US:]!Do not activate without any reason! Coupon code given during automatic payout[:en_US][ru_RU:]!Не активируйте без необходимости! Код купона при автовыплате[:ru_RU]
description: [en_US:]!Do not activate it without any reason! Show automatic payout coupon code in request form.[:en_US][ru_RU:]!Не активируйте без необходимости! Отображение кода купона автовыплаты в карточке заявки[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

/* BD */
add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_fixbtccode');
function bd_pn_moduls_active_fixbtccode(){
global $wpdb;	
	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'btc_code'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `btc_code` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE 'btc_code_info'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."exchange_bids ADD `btc_code_info` varchar(250) NOT NULL");
    }	
	
}
/* end BD */

add_action('merchant_create_coupon', 'merchant_create_coupon_fixbtccode', 10, 4);
function merchant_create_coupon_fixbtccode($coupon_data, $item, $merchant, $place){
global $wpdb;	
	if(isset($item->id) and is_array($coupon_data)){
		$bid_id = $item->id;
		$array = array();
		$array['btc_code'] = is_isset($coupon_data,'coupon');
		$array['btc_code_info'] = is_isset($coupon_data,'coupon_code');
		$wpdb->update($wpdb->prefix ."exchange_bids", $array, array('id'=> $bid_id));
	}
}

add_filter('onebid_col1','onebid_col1_fixbtccode',99,3);
function onebid_col1_fixbtccode($actions, $item, $data_fs){
	
	if(isset($item->btc_code) and $item->btc_code){
		$actions['fixbtccode'] = array(
			'type' => 'text',
			'title' => __('Coupon code','pn'),
			'label' => '[fixbtccode]',
		);		
	}
	if(isset($item->btc_code_info) and $item->btc_code_info){
		$actions['fixbtccodeinfo'] = array(
			'type' => 'text',
			'title' => __('Coupon info','pn'),
			'label' => '[fixbtccodeinfo]',
		);		
	}	
	
	return $actions;
}

add_filter('get_bids_replace_text','get_bids_replace_text_fixbtccode',99,3);
function get_bids_replace_text_fixbtccode($text, $item, $data_fs){
	
	if(strstr($text, '[fixbtccode]')){
		$text = str_replace('[fixbtccode]', '<span class="onebid_item clpb_item item_fixbtccode" data-clipboard-text="' . pn_strip_input($item->btc_code) . '">' . pn_strip_input($item->btc_code) . '</span>',$text);
	}
	if(strstr($text, '[fixbtccodeinfo]')){
		$text = str_replace('[fixbtccodeinfo]', '<span class="onebid_item clpb_item item_fixbtccodeinfo" data-clipboard-text="' . pn_strip_input($item->btc_code_info) . '">' . pn_strip_input($item->btc_code_info) . '</span>',$text);
	}	
	
	return $text;
}

add_filter('pn_exchange_config_option', 'fixbtccode_exchange_config_option');
function fixbtccode_exchange_config_option($options){
global $premiumbox;	
	
	$options['fixbtccode'] = array(
		'view' => 'select',
		'title' => __('Display coupon code in exchange history of user','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('exchange','fixbtccode'),
		'name' => 'fixbtccode',
	);		
	return $options;
}

add_action('pn_exchange_config_option_post', 'fixbtccode_exchange_config_option_post');
function fixbtccode_exchange_config_option_post(){
global $premiumbox;
	
	$options = array('fixbtccode');
	foreach($options as $key){
		$val = intval(is_param_post($key));
		$premiumbox->update_option('exchange',$key,$val);
	}
	 
}

add_filter('lists_userxch', 'fixbtccode_lists_userxch');
function fixbtccode_lists_userxch($lists){
global $premiumbox;	

	$fixbtccode = intval($premiumbox->get_option('exchange','fixbtccode'));
	if($fixbtccode){
		$lists['lists']['fixbtccode'] = __('Coupon code','pn');
		$lists['lists']['fixbtccodeinfo'] = __('Coupon info','pn');
	}	
	
	return $lists;
}

add_action('pn_adminpage_quicktags_pn_add_directions','fixbtccode_adminpage_quicktags_page_directions');
add_action('pn_adminpage_quicktags_pn_directions_temp','fixbtccode_adminpage_quicktags_page_directions');
function fixbtccode_adminpage_quicktags_page_directions(){
?>
edButtons[edButtons.length] = 
new edButton('premium_coupon_code', '<?php _e('Coupon code','pn'); ?>','[coupon_code]');

edButtons[edButtons.length] = 
new edButton('premium_coupon_info', '<?php _e('Coupon info','pn'); ?>','[coupon_info]');
<?php	
} 

add_filter('direction_instruction','fixbtccode_direction_instruction', 10, 5);
function fixbtccode_direction_instruction($instruction, $txt_name, $direction, $vd1, $vd2){
global $bids_data;	
	
	if(isset($bids_data->id)){

		if(is_true_userhash($bids_data)){
			$btc_code = pn_strip_input($bids_data->btc_code);
			$btc_code_info = pn_strip_input($bids_data->btc_code_info);
		} else {
			$btc_code = '---';
			$btc_code_info = '---';
		}
		if(!$btc_code){ $btc_code = '---'; }
		if(!$btc_code_info){ $btc_code_info = '---'; }
		
		$instruction = str_replace('[coupon_code]', $btc_code, $instruction);
		$instruction = str_replace('[coupon_info]', $btc_code_info, $instruction);
		
	}
	
	return $instruction;
}

add_filter('body_list_userxch', 'fixbtccode_body_list_userxch', 10, 6);
function fixbtccode_body_list_userxch($data_item, $item, $key, $title, $date_format, $time_format){		
				
	if($key == 'fixbtccode'){
		$code = '---';
		$btc_code = pn_strip_input($item->btc_code);
		if($btc_code and is_true_userhash($item)){
			$code = $btc_code;
		}
		$data_item = '<span class="fixbtccode" style="word-wrap: break-word; word-break: break-all;">'. $code .'</span>';
	}
	if($key == 'fixbtccodeinfo'){
		$code = '---';
		$btc_code = pn_strip_input($item->btc_code_info);
		if($btc_code and is_true_userhash($item)){
			$code = $btc_code;
		}
		$data_item = '<span class="fixbtccode" style="word-wrap: break-word; word-break: break-all;">'. $code .'</span>';
	}	
	
	return $data_item;
}