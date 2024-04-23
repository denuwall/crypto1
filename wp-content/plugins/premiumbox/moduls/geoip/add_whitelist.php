<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_geoip_addwhitelist', 'pn_admin_title_pn_geoip_addwhitelist');
function pn_admin_title_pn_geoip_addwhitelist(){
	_e('Allow IP','pn');
}

add_action('pn_adminpage_content_pn_geoip_addwhitelist','def_pn_admin_content_pn_geoip_addwhitelist');
function def_pn_admin_content_pn_geoip_addwhitelist(){
global $wpdb;
	
	$form = new PremiumForm();

	$title = __('Allow IP','pn');
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_geoip_whitelist'),
		'title' => __('Back to list','pn')
	);	
	$form->back_menu($back_menu, '');

	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => $title,
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['lists'] = array(
		'view' => 'textarea',
		'title' => __('IP addresses (at the beginning of a new line)','pn'),
		'default' => '',
		'name' => 'lists',
		'width' => '',
		'height' => '200px',
	);	
	
	$params_form = array(
		'filter' => 'pn_geoip_addwhitelist_addform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);		
}

/* обработка формы */
add_action('premium_action_pn_geoip_addwhitelist','def_premium_action_pn_geoip_addwhitelist');
function def_premium_action_pn_geoip_addwhitelist(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_geoip'));
	
	$form = new PremiumForm();

	$lists = explode("\n",is_param_post('lists'));
	foreach($lists as $list){
		$ip = pn_strip_input($list);
		if($ip){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."geoip_whiteip WHERE theip = '$ip'");
			if($cc == 0){
				$array = array();
				$array['theip'] = $ip;
				$wpdb->insert($wpdb->prefix.'geoip_whiteip', $array);
			}
		}
	}	

	$url = admin_url('admin.php?page=pn_geoip_whitelist&reply=true');
	$form->answer_form($url);
}	
/* end обработка формы */