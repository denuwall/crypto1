<?php
if( !defined( 'ABSPATH')){ exit(); }
	
add_filter('list_admin_notify','list_admin_notify_bids');
function list_admin_notify_bids($places_admin){
	$bid_status_list = apply_filters('bid_status_list',array());
	$bid_status_list['realdelete'] = __('Completely deleted order','pn');	
	foreach($bid_status_list as $k => $v){
		$t = $v;
		if($k != 'realdelete'){ $t = sprintf(__('Status of order is "%s"','pn'), $v); }
		$places_admin[$k . '_bids1'] = $t;
	}
	return $places_admin;
}

add_filter('list_user_notify','list_user_notify_bids');
function list_user_notify_bids($places_admin){
	$bid_status_list = apply_filters('bid_status_list',array());
	$bid_status_list['realdelete'] = __('Completely deleted order','pn');	
	foreach($bid_status_list as $k => $v){
		$t = $v;
		if($k != 'realdelete'){ $t = sprintf(__('Status of order is "%s"','pn'), $v); }
		$places_admin[$k . '_bids2'] = $t;
	}
	return $places_admin;
}	

add_action('init', 'def_bid_mailtemp_init');
function def_bid_mailtemp_init(){
	$bid_status_list = apply_filters('bid_status_list',array());
	$bid_status_list['realdelete'] = __('Completely deleted order','pn');
	foreach($bid_status_list as $k => $v){
		add_filter('list_notify_tags_'. $k .'_bids1','def_mailtemp_tags_bids');
		add_filter('list_notify_tags_'. $k .'_bids2','def_mailtemp_tags_bids');
	}
}

function def_mailtemp_tags_bids($tags){
	
	$tags['id'] = __('Order ID','pn');
	$tags['create_date'] = __('Date','pn');
	$tags['course_give'] = __('Rate Send','pn');
	$tags['course_get'] = __('Rate Receive','pn');
	$tags['psys_give'] = __('PS name Send','pn');
	$tags['psys_get'] = __('PS name Receive','pn');
	$tags['currency_code_give'] = __('Currency code Send','pn');
	$tags['currency_code_get'] = __('Currency code Receive','pn');
	$tags['account_give'] = __('Account To send','pn');
	$tags['account_get'] = __('Account To receive','pn');
	$tags['first_name'] = __('First name','pn');
	$tags['last_name'] = __('Last name','pn');
	$tags['second_name'] = __('Second name','pn');
	$tags['user_phone'] = __('Phone no.','pn');
	$tags['user_skype'] = __('Skype','pn');
	$tags['user_email'] = __('E-mail','pn');
	$tags['user_passport'] = __('Passport number','pn');
	$tags['sum1'] = __('Amount To send','pn');
	$tags['sum1dc'] = __('Amount To send (add. fees)','pn');
	$tags['sum1c'] = __('Amount Send (PS fee)','pn');
	$tags['sum2'] = __('Amount Receive','pn');
	$tags['sum2dc'] = __('Amount To receive (add. fees)','pn');
	$tags['sum2c'] = __('Amount Receive (PS fee)','pn');
	$tags['bidurl'] = __('Exchange URL','pn');
	$tags = apply_filters('shortcode_notify_tags_bids', $tags);
	
	return $tags;
}	

function goed_mail_to_changestatus_bids($obmen_id, $obmen, $name1='', $name2=''){
global $wpdb;	
	
	if(isset($obmen->id)){
		
		$bid_locale = $obmen->bid_locale;
		
		$notify_tags = array();
		$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
		$notify_tags['[id]'] = $obmen->id;
		$notify_tags['[createdate]'] = $notify_tags['[create_date]'] = pn_strip_input($obmen->create_date);
		$notify_tags['[curs1]'] = $notify_tags['[course_give]'] = pn_strip_input($obmen->course_give);
		$notify_tags['[curs2]'] = $notify_tags['[course_get]'] = pn_strip_input($obmen->course_get);
		$notify_tags['[valut1]'] = $notify_tags['[psys_give]'] = pn_strip_input(ctv_ml($obmen->psys_give,$bid_locale));
		$notify_tags['[valut2]'] = $notify_tags['[psys_get]'] = pn_strip_input(ctv_ml($obmen->psys_get,$bid_locale));
		$notify_tags['[vtype1]'] = $notify_tags['[currency_code_give]'] = pn_strip_input($obmen->currency_code_give);
		$notify_tags['[vtype2]'] = $notify_tags['[currency_code_get]'] = pn_strip_input($obmen->currency_code_get);
		$notify_tags['[account1]'] = $notify_tags['[account_give]'] = pn_strip_input($obmen->account_give);
		$notify_tags['[account2]'] = $notify_tags['[account_get]'] = pn_strip_input($obmen->account_get);
		$notify_tags['[first_name]'] = pn_strip_input($obmen->first_name);
		$notify_tags['[last_name]'] = pn_strip_input($obmen->last_name);
		$notify_tags['[second_name]'] = pn_strip_input($obmen->second_name);
		$notify_tags['[user_phone]'] = pn_strip_input($obmen->user_phone);
		$notify_tags['[user_skype]'] = pn_strip_input($obmen->user_skype);
		$notify_tags['[user_email]'] = pn_strip_input($obmen->user_email);
		$notify_tags['[user_passport]'] = pn_strip_input($obmen->user_passport);
		$notify_tags['[summ1]'] = $notify_tags['[sum1]'] = pn_strip_input($obmen->sum1);
		$notify_tags['[summ1_dc]'] = $notify_tags['[sum1dc]'] = pn_strip_input($obmen->sum1dc);
		$notify_tags['[summ1c]'] = $notify_tags['[sum1c]'] = pn_strip_input($obmen->sum1c);
		$notify_tags['[summ2]'] = $notify_tags['[sum2]'] = pn_strip_input($obmen->sum2);
		$notify_tags['[summ2_dc]'] = $notify_tags['[sum2dc]'] = pn_strip_input($obmen->sum2dc);
		$notify_tags['[summ2c]'] = $notify_tags['[sum2c]'] = pn_strip_input($obmen->sum2c);
		$notify_tags['[bidurl]'] = get_bids_url($obmen->hashed);
		$notify_tags = apply_filters('notify_tags_bids', $notify_tags, $obmen);		

		$user_send_data = array();
		$result_mail = apply_filters('premium_send_message', 0, $name1, $notify_tags, $user_send_data); 
		
		$user_send_data = array(
			'user_email' => $obmen->user_email,
			'user_phone' => $obmen->user_phone,
		);	
		$result_mail = apply_filters('premium_send_message', 0, $name2, $notify_tags, $user_send_data, $obmen->bid_locale);		

	}		
}

add_action('change_bidstatus_all','def_change_bidstatus_all',1,4);
function def_change_bidstatus_all($status, $obmen_id, $obmen, $place='site'){ 
global $wpdb, $premiumbox;
	
	$action1 = '';
	if($place != 'admin_panel' or $premiumbox->get_option('exchange','admin_mail') == 1){
		$action1 = $status.'_bids1';
	}
	$action2 = $status.'_bids2';
	//goed_mail_to_changestatus_bids($obmen_id, $obmen, $action1, $action2);	
	
}