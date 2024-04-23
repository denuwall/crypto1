<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]User automatic registration[:en_US][ru_RU:]Автоматическая регистрация пользователя[:ru_RU]
description: [en_US:]User automatic registration during exchange[:en_US][ru_RU:]Автоматическая регистрация пользователя при обмене[:ru_RU]
version: 1.5
category: [en_US:]Users[:en_US][ru_RU:]Пользователи[:ru_RU]
cat: user
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_filter('pn_exchange_config_option', 'autoreg_exchange_config_option');
function autoreg_exchange_config_option($options){
global $premiumbox;

	$options[] = array(
		'view' => 'select',
		'title' => __('Automatic user registration','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('exchange','auto_reg'),
		'name' => 'auto_reg',
	);		
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	
	return $options;	
}

add_action('pn_exchange_config_option_post', 'autoreg_exchange_config_option_post');
function autoreg_exchange_config_option_post(){
global $premiumbox;

	$options = array('auto_reg');
	foreach($options as $key){
		$val = pn_strip_input(is_param_post($key));
		$premiumbox->update_option('exchange',$key,$val);
	}
}

add_filter('list_user_notify','list_user_notify_autoregisterform');
function list_user_notify_autoregisterform($places_admin){
	$places_admin['autoregisterform'] = __('Automatic user registration','pn');
	return $places_admin;
}

add_filter('list_notify_tags_autoregisterform','def_list_notify_tags_autoregisterform');
function def_list_notify_tags_autoregisterform($tags){
	
	$tags['login'] = __('Login','pn');
	$tags['pass'] = __('Password','pn');
	$tags['email'] = __('E-mail','pn');
	
	return $tags;
}
	
add_action('change_bidstatus_new','autoreg_change_bidstatus_new',99,3);
function autoreg_change_bidstatus_new($obmen_id, $obmen, $place){
global $wpdb, $premiumbox;

	if($place == 'exchange_button' and $premiumbox->get_option('exchange','auto_reg') == 1){
		$locale = pn_strip_input($obmen->bid_locale);
		$user_id = $obmen->user_id;
		$user_email = is_email($obmen->user_email);
		if(!$user_id and $user_email){
			if (!email_exists($user_email) ){
				$user_login = is_user(selection_email_login($user_email));
				if($user_login){
					$pass = wp_generate_password( 20 , false, false);
					$user_id = wp_insert_user( array ('user_login' => $user_login, 'user_email' => $user_email, 'user_pass' => $pass) ) ;
					if($user_id){
							
						do_action( 'pn_user_register', $user_id);	
							
						$wpdb->update($wpdb->prefix . 'exchange_bids', array('user_id'=> $user_id), array('id'=>$obmen->id));
							
						$first_name = pn_strip_input($obmen->first_name);
						update_user_meta( $user_id, 'first_name', $first_name) or add_user_meta($user_id, 'first_name', $first_name, true);
							
						$second_name = pn_strip_input($obmen->second_name);
						update_user_meta( $user_id, 'second_name', $second_name) or add_user_meta($user_id, 'second_name', $second_name, true);
							
						$last_name = pn_strip_input($obmen->last_name);
						update_user_meta( $user_id, 'last_name', $last_name) or add_user_meta($user_id, 'last_name', $last_name, true);
							
						$user_phone = is_phone($obmen->user_phone);
						update_user_meta( $user_id, 'user_phone', $user_phone) or add_user_meta($user_id, 'user_phone', $user_phone, true);
							
						$user_skype = pn_strip_input($obmen->user_skype);
						update_user_meta( $user_id, 'user_skype', $user_skype) or add_user_meta($user_id, 'user_skype', $user_skype, true);
							
						$user_passport = pn_strip_input($obmen->user_passport);
						update_user_meta( $user_id, 'user_passport', $user_passport) or add_user_meta($user_id, 'user_passport', $user_passport, true);						

						$notify_tags = array();
						$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
						$notify_tags['[login]'] = $user_login;
						$notify_tags['[pass]'] = $pass;
						$notify_tags['[email]'] = $user_email;
						$notify_tags = apply_filters('notify_tags_autoregisterform', $notify_tags, $user_id, $obmen);		

						$user_send_data = array(
							'user_email' => $user_email,
							'user_phone' => '',
						);	
						$result_mail = apply_filters('premium_send_message', 0, 'autoregisterform', $notify_tags, $user_send_data, $locale);
 					}	
				}
			}
		}
	}
}