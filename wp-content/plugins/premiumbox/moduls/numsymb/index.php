<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Max number of decimal places allowed in DB[:en_US][ru_RU:]Макс. кол-во знаков после запятой в БД[:ru_RU]
description: [en_US:]Max number of decimal places in calculations allowed in database[:en_US][ru_RU:]Макс. кол-во знаков после запятой в БД[:ru_RU]
version: 1.5
category: [en_US:]Settings[:en_US][ru_RU:]Настройки[:ru_RU]
cat: sett
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_filter('pn_config_option', 'numsybm_config_option');
function numsybm_config_option($options){
global $premiumbox;

	$options['numsybm_count'] = array(
		'view' => 'input',
		'title' => __('Max number of decimal places in calculations allowed in DB','pn'),
		'default' => $premiumbox->get_option('numsybm_count'),
		'name' => 'numsybm_count',
		'work' => 'input',
	);		
	
	return $options;	
}

add_action('pn_config_option_post', 'numsybm_config_option_post');
function numsybm_config_option_post(){
global $premiumbox;
	
	$numsybm_count = intval(is_param_post('numsybm_count'));
	$premiumbox->update_option('numsybm_count', '', $numsybm_count);
}

add_filter('is_sum_cs', 'numsybm_is_sum_cs', 10, 4);
function numsybm_is_sum_cs($cs){
global $premiumbox;
	
	$numsybm_count = intval($premiumbox->get_option('numsybm_count'));
	if($numsybm_count > 0){
		if($cs > $numsybm_count){
			$cs = $numsybm_count;	
		}
	}	
	
	return $cs;
}			