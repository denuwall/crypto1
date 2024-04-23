<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'admin_menu_admin');
function admin_menu_admin(){
global $premiumbox;	

	add_submenu_page("pn_config", __('Admin Panel','pn'), __('Admin Panel','pn'), 'administrator', "pn_admin", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_admin', 'pn_adminpage_title_pn_admin');
function pn_adminpage_title_pn_admin(){
	_e('Admin Panel','pn');
}

add_filter('pn_adminpanel_option', 'def_pn_adminpanel_option', 1);
function def_pn_adminpanel_option($options){
global $wpdb, $premiumbox;	
		
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Widgets on the main page','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
		$options['w0'] = array(
			'view' => 'select',
			'title' => __('Hide Welcome Panel','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w0'),
			'name' => 'w0',
			'work' => 'int',
		);		
		$options['w1'] = array(
			'view' => 'select',
			'title' => __('Hide At a Glance','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w1'),
			'name' => 'w1',
			'work' => 'int',
		);
		$options['w2'] = array(
			'view' => 'select',
			'title' => __('Hide Activity','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w2'),
			'name' => 'w2',
			'work' => 'int',
		);
		$options['w3'] = array(
			'view' => 'select',
			'title' => __('Hide Quick Drafts','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w3'),
			'name' => 'w3',
			'work' => 'int',
		);
		$options['w4'] = array(
			'view' => 'select',
			'title' => __('Hide WordPress News','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w4'),
			'name' => 'w4',
			'work' => 'int',
		);
		$options['w5'] = array(
			'view' => 'select',
			'title' => __('Hide Recent Comments','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w5'),
			'name' => 'w5',
			'work' => 'int',
		);
		$options['w6'] = array(
			'view' => 'select',
			'title' => __('Hide Incoming Refs','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w6'),
			'name' => 'w6',
			'work' => 'int',
		);
		$options['w7'] = array(
			'view' => 'select',
			'title' => __('Hide Plugins','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w7'),
			'name' => 'w7',
			'work' => 'int',
		);
		$options['w8'] = array(
			'view' => 'select',
			'title' => __('Hide Recent Drafts','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','w8'),
			'name' => 'w8',
			'work' => 'int',
		);
	$options['center_title'] = array(
		'view' => 'h3',
		'title' => __('Menu Sections','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
		$options['ws0'] = array(
			'view' => 'select',
			'title' => sprintf(__('Hide section "%s"','pn'), __('Posts','pn')),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','ws0'),
			'name' => 'ws0',
			'work' => 'int',
		);	
		$options['ws1'] = array(
			'view' => 'select',
			'title' => sprintf(__('Hide section "%s"','pn'), __('Comments','pn')),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','ws1'),
			'name' => 'ws1',
			'work' => 'int',
		);	
	$options['other_title'] = array(
		'view' => 'h3',
		'title' => __('Other','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
		$options['wm0'] = array(
			'view' => 'select',
			'title' => __('Disable e-mail notification when user changes password','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','wm0'),
			'name' => 'wm0',
			'work' => 'int',
		);
		$options['wm1'] = array(
			'view' => 'select',
			'title' => __('Disable sending emails to confirm e-mail change','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','wm1'),
			'name' => 'wm1',
			'work' => 'int',
		);
		$options['wm2'] = array(
			'view' => 'select',
			'title' => __('Disable RSS feed','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('admin','wm2'),
			'name' => 'wm2',
			'work' => 'int',
		);		
		
	return $options;
}

add_action('pn_adminpage_content_pn_admin','def_pn_adminpage_content_pn_admin');
function def_pn_adminpage_content_pn_admin(){
global $premiumbox;	
	
	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_adminpanel_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form);	
				  
} 

add_action('premium_action_pn_admin','def_premium_action_pn_admin');
function def_premium_action_pn_admin(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));
		
	$form = new PremiumForm();
	$data = $form->strip_options('pn_adminpanel_option', 'post');	
		
	foreach($data as $key => $val){
		$premiumbox->update_option('admin', $key, $val);
	}		
				
	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
			
	$form->answer_form($back_url);
} 