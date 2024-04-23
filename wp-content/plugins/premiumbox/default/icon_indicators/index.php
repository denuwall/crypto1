<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'admin_menu_iconbar');
function admin_menu_iconbar(){
global $premiumbox;	
	add_submenu_page("pn_config", __('Notification icons','pn'), __('Notification icons','pn'), 'administrator', "pn_iconbar", array($premiumbox, 'admin_temp'));
}	
	
add_action('pn_adminpage_title_pn_iconbar', 'def_adminpage_title_pn_iconbar');
function def_adminpage_title_pn_iconbar(){
	_e('Notification icons','pn');
}	
	
add_action('pn_adminpage_content_pn_iconbar','def_pn_adminpage_content_pn_iconbar');
function def_pn_adminpage_content_pn_iconbar(){
global $premiumbox;
		
	$form = new PremiumForm();	
		
	$options = array();	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Notification icons','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	
	$lists = apply_filters('list_icon_indicators', array());	
	if(is_array($lists)){
		foreach($lists as $list_key => $list_title){
			$options[] = array(
				'view' => 'select',
				'title' => $list_title,
				'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
				'default' => $premiumbox->get_option('iconbar', $list_key),
				'name' => $list_key,
			);			
		}
	}
	
	$params_form = array(
		'filter' => 'pn_iconbar_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
	
}

add_action('premium_action_pn_iconbar','def_premium_action_pn_iconbar');
function def_premium_action_pn_iconbar(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));

	$form = new PremiumForm();
	
	$lists = apply_filters('list_icon_indicators', array());	
	if(is_array($lists)){
		foreach($lists as $list_key => $list_title){	
			$premiumbox->update_option('iconbar', $list_key ,intval(is_param_post($list_key)));	
		}
	}		

	$url = admin_url('admin.php?page=pn_iconbar&reply=true');
	$form->answer_form($url);
}		