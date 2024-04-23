<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('pn_config_option', 'premiumbox_config_option');
function premiumbox_config_option($options){
global $premiumbox;
	
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['pn_up_mode'] = array(
		'view' => 'select',
		'title' => __('Updating mode','pn'),
		'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('up_mode'),
		'name' => 'pn_up_mode',
		'work' => 'int',
	);
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['wchecks'] = array(
		'view' => 'select',
		'title' => __('Accounts verification checker','pn'),
		'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('wchecks'),
		'name' => 'wchecks',
		'work' => 'int',
	);
	$options['adminpass'] = array(
		'view' => 'select',
		'title' => __('Remember successful entry of the security code','pn'),
		'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('adminpass'),
		'name' => 'adminpass',
		'work' => 'int',
	);
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	$options['nocopydata'] = array(
		'view' => 'select',
		'title' => __('Ability to copy information on clients in one click','pn'),
		'options' => array('0'=>__('Yes','pn'), '1'=>__('No','pn')),
		'default' => $premiumbox->get_option('nocopydata'),
		'name' => 'nocopydata',
		'work' => 'int',
	);	
	
	return $options;
}

add_action('pn_config_option_post', 'premiumbox_config_option_post');
function premiumbox_config_option_post($data){
global $premiumbox;
	
	$opts =  array('pn_up_mode'); 
	foreach($opts as $opt){
		$premiumbox->update_option('up_mode','',$data[$opt]);
	}
	
	$opts =  array('wchecks','adminpass','nocopydata'); 
	foreach($opts as $opt){
		$premiumbox->update_option($opt,'',$data[$opt]);
	}	
	
}			