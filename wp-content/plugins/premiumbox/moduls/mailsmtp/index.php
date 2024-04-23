<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]SMTP[:en_US][ru_RU:]SMTP[:ru_RU]
description: [en_US:]Sending e-mail via SMTP[:en_US][ru_RU:]Отправление электронной почты с помощью SMTP[:ru_RU]
version: 1.5
category: [en_US:]E-mail[:en_US][ru_RU:]E-mail[:ru_RU]
cat: email
*/

add_action('admin_menu', 'pn_adminpage_mailsmtp');
function pn_adminpage_mailsmtp(){
global $premiumbox;	

	add_submenu_page("pn_mail_temps", __('SMTP settings','pn'), __('SMTP settings','pn'), 'administrator', "pn_mailsmtp", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_mailsmtp', 'pn_adminpage_title_pn_mailsmtp');
function pn_adminpage_title_pn_mailsmtp($page){
	_e('SMTP settings','pn');
} 

add_filter('pn_mailsmtp_option', 'def_pn_mailsmtp_option', 1);
function def_pn_mailsmtp_option($options){
global $wpdb, $premiumbox;	
		
	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('SMTP settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['enable'] = array(
		'view' => 'select',
		'title' => __('Enable SMTP','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('smtp','enable'),
		'name' => 'enable',
		'work' => 'int',
	);		
	$options['host'] = array(
		'view' => 'inputbig',
		'title' => __('SMTP Host','pn'),
		'default' => $premiumbox->get_option('smtp','host'),
		'name' => 'host',
		'work' => 'input',
	);
	$options['port'] = array(
		'view' => 'inputbig',
		'title' => __('SMTP Port','pn'),
		'default' => $premiumbox->get_option('smtp','port'),
		'name' => 'port',
		'work' => 'input',
	);
	$options['username'] = array(
		'view' => 'inputbig',
		'title' => __('SMTP Username','pn'),
		'default' => $premiumbox->get_option('smtp','username'),
		'name' => 'username',
		'work' => 'input',
	);
	$options['password'] = array(
		'view' => 'inputbig',
		'title' => __('SMTP Password','pn'),
		'default' => $premiumbox->get_option('smtp','password'),
		'name' => 'password',
		'work' => 'input',
	);
	$options['from'] = array(
		'view' => 'inputbig',
		'title' => __('SMTP Under name','pn'),
		'default' => $premiumbox->get_option('smtp','from'),
		'name' => 'from',
		'work' => 'input',
	);			
			
	$help = '
	<p>
		<strong>'. __('SMTP Host','pn').'</strong>: smtp.yandex.ru<br />
		<strong>'. __('SMTP Port','pn').'</strong>: 465
	</p>
	';
	$options['yahelp'] = array(
		'view' => 'help',
		'title' => __('Info for yandex','pn'),
		'default' => $help,
	);		
		
	return $options;
}

add_action('pn_adminpage_content_pn_mailsmtp','pn_adminpage_content_pn_mailsmtp');
function pn_adminpage_content_pn_mailsmtp(){
global $wpdb, $premiumbox;		
			
	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_mailsmtp_option',
		'method' => 'post',
		'data' => '',
		'form_link' => '',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form);			

}  


add_action('premium_action_pn_mailsmtp','def_premium_action_pn_mailsmtp');
function def_premium_action_pn_mailsmtp(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	$data = $form->strip_options('pn_mailsmtp_option', 'post');
	foreach($data as $key => $val){
		$premiumbox->update_option('smtp', $key, $val);
	}				

	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
			
	$form->answer_form($back_url);	
} 


add_action('phpmailer_init','pn_send_smtp_email');
function pn_send_smtp_email( $phpmailer ) {
global $premiumbox;	
    if($premiumbox->get_option('smtp','enable') == 1){
	
		$phpmailer->isSMTP();
		$phpmailer->Host = $premiumbox->get_option('smtp','host');
		$username = trim($premiumbox->get_option('smtp','username'));
		$password = trim($premiumbox->get_option('smtp','password'));
		if($username and $password){
			$phpmailer->SMTPAuth = true;
			$phpmailer->Username = $premiumbox->get_option('smtp','username');
			$phpmailer->Password = $premiumbox->get_option('smtp','password');
		}
		$phpmailer->Port = $premiumbox->get_option('smtp','port');
		$phpmailer->From = $premiumbox->get_option('smtp','username'); 
		$phpmailer->FromName = $premiumbox->get_option('smtp','from');
		$phpmailer->SMTPSecure = "ssl";
	
	}
} 