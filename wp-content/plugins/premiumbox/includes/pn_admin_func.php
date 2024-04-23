<?php 
if( !defined( 'ABSPATH')){ exit(); }

add_filter('pn_exchange_cat_filters', 'def_pn_exchange_cat_filters', 0);
function def_pn_exchange_cat_filters(){
	$cats = array(
		'home' => __('Homepage exchange table','pn'),
		'exchange' => __('Exchange type','pn'),
	);
	return $cats;
}

add_filter('bid_status_list','def_bid_status_list',0);
function def_bid_status_list($status){
	
	$status = array(
		'new' => __('new order','pn'),
		'cancel' => __('cancelled order by user','pn'),
		'delete' => __('deleted order','pn'),
		'techpay' => __('when user entered payment section','pn'),
		'payed' => __('user marked order as paid','pn'),
		'coldpay' => __('waiting for merchant confirmation','pn'),
		'realpay' => __('paid order','pn'),
		'verify' => __('order is on checking','pn'),
		'error' => __('error order','pn'),
		'payouterror' => __('automatic payout error','pn'),
		'coldsuccess' => __('waiting for automatic payment module confirmation','pn'),
		'success' => __('successful order','pn'),
	);
	
	return $status;
}

function get_list_user_menu(){
global $premiumbox;

	$account_list_pages = array(
		'account' => array(
			'title' => '',
			'url' => '',
			'type' => 'page',
			'class' => '',
			'id' => '',
		),
		'security' => array(
			'title' => '',
			'url' => '',
			'type' => 'page',
			'class' => '',
			'id' => '',			
		),										
	);
	$account_list_pages = apply_filters('account_list_pages',$account_list_pages);
	$pages = get_option($premiumbox->plugin_page_name);
	
	$list = array();
	if(is_array($account_list_pages)){
		foreach($account_list_pages as $key => $data){
			$type = trim(is_isset($data,'type'));
			$url = trim(is_isset($data,'url'));
			$title = trim(is_isset($data,'title'));
			$target = intval(is_isset($data,'target'));
			$class = trim(is_isset($data,'class'));
			$id = trim(is_isset($data,'id'));
			
			if($type == 'page'){
				if(isset($pages[$key])){
					$page_url = get_permalink($pages[$key]);
					$current = '';
					if(is_page($pages[$key])){
						$current = 'current';
					}
					$list[] = array(
						'url' => $page_url,
						'title' => get_the_title($pages[$key]),
						'target' => '',
						'class' => is_isset($data,'class'),
						'id' => is_isset($data,'id'),
						'current' => $current,
					);
				}
			} elseif($type == 'target_link'){
				$list[] = array(
					'url' => $url,
					'title' => $title,
					'target' => 1,
					'class' => $class,
					'id' => $id,	
					'current' => is_place_url($url),
				);				
			} else {
				$list[] = array(
					'url' => $url,
					'title' => $title,
					'target' => $target,
					'class' => $class,
					'id' => $id,	
					'current' => is_place_url($url),
				);
			}
		}
	}
	
	return $list;
}

function get_bids_meta($id, $key){
	return get_pn_meta('bids_meta', $id, $key);
}

add_filter('placed_captcha', 'def_placed_captcha', 0);
function def_placed_captcha(){
	$placed = array(
		'loginform' => __('Authourization form','pn'),
		'registerform' => __('Registration form','pn'),
		'lostpass1form' => __('Lost password form','pn'),
		'exchangeform' => __('Exchange type','pn'),
	);	
	return $placed;
}

function get_security_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['pass'] = array(
		'name' => 'pass',
		'title' => __('New password', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => '',
		'type' => 'password',
		'not_auto' => 0,
		'disable' => 0,
	);
	$items['pass2'] = array(
		'name' => 'pass2',
		'title' => __('New password again', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => '',
		'type' => 'password',
		'not_auto' => 0,
		'disable' => 0,
	);	
	$items['user_pin'] = array(
		'name' => 'user_pin',
		'title' => __('Personal PIN code', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => is_isset($ui,'user_pin'),
		'type' => 'input',
		'not_auto' => 0,
	);
	$items['enable_pin'] = array(
		'name' => 'enable_pin',
		'title' => __('Request personal PIN code', 'pn'),
		'req' => 0,
		'value' => is_isset($ui,'enable_pin'),
		'type' => 'select',
		'options' => array(__('No','pn'), __('Always','pn'), __('If IP address changed','pn'), __('If browser changed','pn'), __('If IP address or browser changed','pn')),
	);	
	$items['sec_lostpass'] = array(
		'name' => 'sec_lostpass',
		'title' => __('Recover password', 'pn'),
		'req' => 0,
		'value' => is_isset($ui,'sec_lostpass'),
		'type' => 'select',
		'options' => array(__('No','pn'), __('Yes','pn')),
	);
	$items['sec_login'] = array(
		'name' => 'sec_login',
		'title' => __('Log in notification by e-mail', 'pn'),
		'req' => 0,
		'value' => is_isset($ui,'sec_login'),
		'type' => 'select',
		'options' => array(__('No','pn'), __('Yes','pn')),
	);
	$items['email_login'] = array(
		'name' => 'email_login',
		'title' => __('Two-factor authorization by one-time ref', 'pn'),
		'req' => 0,
		'value' => is_isset($ui,'email_login'),
		'type' => 'select',
		'options' => array(__('No','pn'), __('Yes','pn')),
	);
	$items['enable_ips'] = array(
		'name' => 'enable_ips',
		'title' => __('Allowed IP address (in new line)', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => is_isset($ui,'enable_ips'),
		'type' => 'text',
		'not_auto' => 0,
	);		
	$items = apply_filters('get_form_filelds',$items, 'securityform', $ui, $place);
	$items = apply_filters('security_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_register_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['login'] = array(
		'name' => 'login',
		'title' => __('Login', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'input',
		'not_auto' => 0,
	);
	$items['email'] = array(
		'name' => 'email',
		'title' => __('E-mail', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'input',
		'not_auto' => 0,
	);	
	$items['pass'] = array(
		'name' => 'pass',
		'title' => __('Password', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'password',
		'not_auto' => 0,
	);
	$items['pass2'] = array(
		'name' => 'pass2',
		'title' => __('Password again', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'password',
		'not_auto' => 0,
	);	
	$items = apply_filters('get_form_filelds',$items, 'registerform', $ui, $place);
	$items = apply_filters('register_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_lostpass1_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['email'] = array(
		'name' => 'email',
		'title' => __('E-mail', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'input',
		'not_auto' => 0,
	);		
	$items = apply_filters('get_form_filelds',$items, 'lostpass1form', $ui, $place);
	$items = apply_filters('lostpass1_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_lostpass2_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['pass'] = array(
		'name' => 'pass',
		'title' => __('New password', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'password',
		'not_auto' => 1,
	);
	$items['pass2'] = array(
		'name' => 'pass2',
		'title' => __('New password again', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'password',
		'not_auto' => 1,
	);	
	$items = apply_filters('get_form_filelds',$items, 'lostpass2form', $ui, $place);
	$items = apply_filters('lostpass2_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_login_form_filelds($place='shortcode'){
	$ui = wp_get_current_user();

	$items = array();
	$items['logmail'] = array(
		'name' => 'logmail',
		'title' => __('Login or email', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'input',
		'not_auto' => 0,
	);
	$items['pass'] = array(
		'name' => 'pass',
		'title' => __('Password', 'pn'),
		'placeholder' => '',
		'req' => 1,
		'value' => '',
		'type' => 'password',
		'not_auto' => 0,
	);	
	$items = apply_filters('get_form_filelds',$items, 'loginform', $ui, $place);
	$items = apply_filters('login_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_account_form_filelds($place='shortcode'){
global $premiumbox;
	
	$ui = wp_get_current_user();
	$user_id = intval(is_isset($ui, 'ID'));

	$items = array();
	if(pn_allow_uv('login')){
		$items['login'] = array(
			'name' => 'login',
			'title' => __('Login', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => is_user(is_isset($ui,'user_login')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => 1,
		);
	}
	if(pn_allow_uv('last_name')){
		$items['last_name'] = array(
			'name' => 'last_name',
			'title' => __('Last name', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => pn_strip_input(is_isset($ui,'last_name')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'last_name', $ui),
		);
	}
	if(pn_allow_uv('first_name')){	
		$items['first_name'] = array(
			'name' => 'first_name',
			'title' => __('First name', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => pn_strip_input(is_isset($ui,'first_name')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'first_name', $ui),
		);
	}
	if(pn_allow_uv('second_name')){	
		$items['second_name'] = array(
			'name' => 'second_name',
			'title' => __('Second name', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => pn_strip_input(is_isset($ui,'second_name')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'second_name', $ui),
		);	
	}
	if(pn_allow_uv('user_phone')){	
		$items['user_phone'] = array(
			'name' => 'user_phone',
			'title' => __('Phone no.', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => is_phone(is_isset($ui,'user_phone')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'user_phone', $ui),
		);
	}
	if(pn_allow_uv('user_skype')){
		$items['user_skype'] = array(
			'name' => 'user_skype',
			'title' => __('Skype', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => pn_strip_input(is_isset($ui,'user_skype')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'user_skype', $ui),
		);
	}
	$items['user_email'] = array(
		'name' => 'user_email',
		'title' => __('E-mail', 'pn'),
		'placeholder' => '',
		'req' => 0,
		'value' => is_email(is_isset($ui,'user_email')),
		'type' => 'input',
		'not_auto' => 0,
		'disable' => apply_filters('disabled_account_form_line', 0, 'user_email', $ui),
	);	
	if(pn_allow_uv('website')){	
		$items['website'] = array(
			'name' => 'website',
			'title' => __('Website', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => esc_url(is_isset($ui,'user_url')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'website', $ui),
		);
	}
	if(pn_allow_uv('user_passport')){	
		$items['user_passport'] = array(
			'name' => 'user_passport',
			'title' => __('Passport number', 'pn'),
			'placeholder' => '',
			'req' => 0,
			'value' => pn_strip_input(is_isset($ui,'user_passport')),
			'type' => 'input',
			'not_auto' => 0,
			'disable' => apply_filters('disabled_account_form_line', 0, 'user_passport', $ui),
		);
	}		
	$items = apply_filters('get_form_filelds',$items, 'accountform', $ui, $place);
	$items = apply_filters('account_form_filelds',$items, $ui, $place);	
	
	return $items;
}

function get_exchangestep_title(){
global $wpdb, $bids_data;	

	if(isset($bids_data->id)){
		if($bids_data->status == 'auto'){
			$item_title1 = pn_strip_input(ctv_ml($bids_data->psys_give)).' '.pn_strip_input($bids_data->currency_code_give);
			$item_title2 = pn_strip_input(ctv_ml($bids_data->psys_get)).' '.pn_strip_input($bids_data->currency_code_get);
		    $title = sprintf(__('Exchange %1$s to %2$s','pn'), $item_title1, $item_title2);
			return apply_filters('get_exchange_title', $title, $bids_data->direction_id, $item_title1, $item_title2);
		} else {
			$title = __('Order ID','pn') . ' '. $bids_data->id;
			return apply_filters('get_exchangestep_title', $title, $bids_data->id);
		}
	} else {
		return __('Error 404','pn');
	}	
}

function get_exchange_title(){
global $direction_data;	
	if(isset($direction_data->item_give) and isset($direction_data->item_get)){
		$item_title1 = pn_strip_input($direction_data->item_give);
		$item_title2 = pn_strip_input($direction_data->item_get);
								
		$title = sprintf(__('Exchange %1$s to %2$s','pn'), $item_title1, $item_title2);	
		return apply_filters('get_exchange_title', $title, $direction_data->direction_id, $item_title1, $item_title2);
	} else {
		return __('Error 404','pn');
	}
}

add_filter('list_directions_temp','def_list_directions_temp',0);
function def_list_directions_temp($list_directions_temp){
	
	$list_directions_temp = array(
		'description_txt' => __('Exchange description','pn'),
		'timeline_txt' => __('Deadline','pn'),
		'window_txt' => __('Popup text before order creation','pn'),
	);
	$bid_status_list = apply_filters('bid_status_list',array());
	foreach($bid_status_list as $key => $title){
		$list_directions_temp['status_'.$key] = sprintf(__('Status of order is "%s"', 'pn'), $title);
	}	
							
	return $list_directions_temp;
}

function get_comis_text($com_ps, $dop_com, $psys, $curr_code, $vid, $gt){
	$comis_text = '';
	
	if($com_ps > 0 or $dop_com > 0){
		$comis_text = __('Including','pn').' ';
	}		

	if($com_ps > 0 and $dop_com > 0){
		$comis_text .= __('add. service fee','pn');
		$comis_text .= ' (<span class="dop_com">'. $dop_com .'</span> <span class="vtype curr_code">'. $curr_code .'</span>)';
		$comis_text .= __('and','pn');
		$comis_text .= ' ';		
		$comis_text .= __('payment system fees','pn');
		$comis_text .= ' <span class="psys">'. $psys . '</span> (<span class="com_ps">'. $com_ps .'</span> <span class="vtype curr_code">'. $curr_code .'</span>) ';
	} elseif($com_ps > 0){
		$comis_text .= __('payment system fees','pn');
		$comis_text .= ' <span class="psys">'. $psys . '</span> (<span class="com_ps">'. $com_ps .'</span> <span class="vtype curr_code">'. $curr_code .'</span>) ';	
	} elseif($dop_com > 0){
		$comis_text .= __('add. service fee','pn');
		$comis_text .= ' (<span class="dop_com">'. $dop_com .'</span> <span class="vtype curr_code">'. $curr_code .'</span>)';
	}	
	
	if($gt == 1){
		if($com_ps > 0 or $dop_com > 0){
			$comis_text .= ', ';
			if($vid == 1){
				$comis_text .= __('you send','pn');
			} else {
				$comis_text .= __('you receive','pn');
			}
		}
	}
	
	return pn_strip_input($comis_text);
}

function get_payuot_status($status){
	$statused = array(
		'0' => __('Waiting order','pn'),
		'1' => __('Completed order','pn'),
		'2' => __('Cancelled order','pn'),
		'3' => __('Cancelled order by user','pn'),
	);	
	return is_isset($statused, $status);
}

function update_currency_meta($id, $key, $value){ 
	return update_pn_meta('currency_meta', $id, $key, $value);
}

add_filter('colors_for_bidstatus', 'def_colors_for_bidstatus', 0);
function def_colors_for_bidstatus($colors){
	
	$colors = array(
		'0' => array(
			'title' => __('Red','pn'),
			'color' => '#ff3c00',
		),
		'1' => array(
			'title' => __('Orange','pn'),
			'color' => '#fc6d41',
		),
		'2' => array(
			'title' => __('Yellow','pn'),
			'color' => '#dbdd0a',
		),
		'3' => array(
			'title' => __('Green','pn'),
			'color' => '#31dd0a',
		),
		'4' => array(
			'title' => __('Blue','pn'),
			'color' => '#0adddb',
		),
		'5' => array(
			'title' => __('Purple','pn'),
			'color' => '#810add',
		),		
	);
	
	return $colors;
}