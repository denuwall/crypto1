<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Blacklist[:en_US][ru_RU:]Черный список[:ru_RU]
description: [en_US:]Blacklist[:en_US][ru_RU:]Черный список[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_blacklist');
function bd_pn_moduls_active_blacklist(){
global $wpdb;	

	/* 
	meta_key - ключ (0-счет, 1-e-mail, 2-телефон,3-скайп, 4-ip)
	meta_value - значение
	*/
	$table_name= $wpdb->prefix ."blacklist";
	$sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`meta_key` varchar(12) NOT NULL default '0',
		`meta_value` longtext NOT NULL,
		`comment_text` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."blacklist LIKE 'comment_text'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."blacklist ADD `comment_text` longtext NOT NULL");
	}	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_blacklist');
function bd_pn_moduls_migrate_blacklist(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."blacklist LIKE 'comment_text'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."blacklist ADD `comment_text` longtext NOT NULL");
	}	
}

add_action('admin_menu', 'pn_adminpage_blacklist');
function pn_adminpage_blacklist(){
global $premiumbox;
	if(current_user_can('administrator') or current_user_can('pn_blacklist')){
		$hook = add_menu_page(__('Blacklist','pn'), __('Blacklist','pn'), 'read', 'pn_blacklist', array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('blacklist'));  
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_blacklist", __('Add','pn'), __('Add','pn'), 'read', "pn_add_blacklist", array($premiumbox, 'admin_temp'));	
		add_submenu_page("pn_blacklist", __('Add list','pn'), __('Add list','pn'), 'read', "pn_add_blacklist_many", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_blacklist", __('Settings','pn'), __('Settings','pn'), 'read', "pn_config_blacklist", array($premiumbox, 'admin_temp'));
	}
}

add_filter('pn_caps','blacklist_pn_caps');
function blacklist_pn_caps($pn_caps){
	$pn_caps['pn_blacklist'] = __('Work with a blacklist','pn');
	return $pn_caps;
}

add_filter('cf_auto_form_value','blacklist_cf_auto_form_value',1,4);
function blacklist_cf_auto_form_value($cauv,$value,$item,$direction){
global $wpdb, $premiumbox;

	$cf_auto = $item->cf_auto;
	if($value){
		
		$checks = $premiumbox->get_option('blacklist','check');
		if(!is_array($checks)){ $checks = array(); }
		
		if($cf_auto == 'user_email' and in_array(4, $checks)){
			$value_arr = explode('@',$value);
			$domen = '@' . trim(is_isset($value_arr, 1));
			$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$value' AND meta_key='1' OR meta_value='$domen' AND meta_key='1'");
			if($blacklist > 0){
				$cauv = array(
					'error' => 1,
					'error_text' => __('In blacklist','pn')
				);					
			}
		} elseif($cf_auto == 'user_phone' and in_array(2, $checks)){
			$value = str_replace('+','',$value);
			$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$value' AND meta_key='2'");
			if($blacklist > 0){
				$cauv = array(
					'error' => 1,
					'error_text' => __('In blacklist','pn')
				);									
			}
		} elseif($cf_auto == 'user_skype' and in_array(3, $checks)){	
			$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$value' AND meta_key='3'");
			if($blacklist > 0){
				$cauv = array(
					'error' => 1,
					'error_text' => __('In blacklist','pn')
				);					
			}							
		}
	}	
	
	return $cauv;
}

add_filter('account1_bids','blacklist_account_bids1',1,2);
function blacklist_account_bids1($account_bids, $account){
global $wpdb, $premiumbox;

	if($account_bids['error'] == 0){
		
		$checks = $premiumbox->get_option('blacklist','check');
		if(!is_array($checks)){ $checks = array(); }
		
		if(in_array(0, $checks)){
			$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$account' AND meta_key='0'");
			if($blacklist > 0){
				$account_bids = array(
					'error' => 1,
					'error_text' => __('In blacklist','pn'),
				);		
			}	
		}
	}
	
	return $account_bids;
}

add_filter('account2_bids','blacklist_account_bids2',1,2);
function blacklist_account_bids2($account_bids, $account){
global $wpdb, $premiumbox;

	if($account_bids['error'] == 0){
		
		$checks = $premiumbox->get_option('blacklist','check');
		if(!is_array($checks)){ $checks = array(); }
		
		if(in_array(1, $checks)){
			$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$account' AND meta_key='0'");
			if($blacklist > 0){
				$account_bids = array(
					'error' => 1,
					'error_text' => __('In blacklist','pn'),
				);		
			}	
		}
	}
	
	return $account_bids;
}

add_filter('error_bids','blacklist_error_bids',1,3);
function blacklist_error_bids($error_bids, $account1, $account2){
global $wpdb, $premiumbox;

	$user_ip = pn_real_ip();
	
	$checks = $premiumbox->get_option('blacklist','check');
	if(!is_array($checks)){ $checks = array(); }
	
	if(in_array(5, $checks)){
		$blacklist = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."blacklist WHERE meta_value='$user_ip' AND meta_key='4'");
		if($blacklist > 0){
			$error_bids['error_text'][] = __('Error! Your IP address in black list','pn');	
		}
	}
	
	return $error_bids;
}

add_filter('get_statusbids_for_admin', 'get_statusbids_for_admin_blacklist');
function get_statusbids_for_admin_blacklist($st){
	if(current_user_can('administrator') or current_user_can('pn_blacklist')){
		$st['blacklist'] = array(
			'name' => 'blacklist',
			'title' => __('add to blacklist','pn'),
			'color' => '#ffffff',
			'background' => '#000000',
		);				
	}
		return $st;
}

add_action('bidstatus_admin_action', 'bidstatus_admin_action_blacklist', 10, 2);
function bidstatus_admin_action_blacklist($ids, $action){
global $wpdb;

	/* ЧС */
	if($action == 'blacklist'){
		foreach($ids as $id){
			$id = intval($id);
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$id'");
			if(isset($item->id)){
						
				$account1 = pn_strip_input($item->account_give);
				if($account1){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$account1' AND meta_key='0'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$account1,'meta_key'=>0));
					}
				}

				$account2 = pn_strip_input($item->account_get);
				if($account2){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$account2' AND meta_key='0'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$account2,'meta_key'=>0));
					}	
				}						
						
				$user_email = is_email($item->user_email);
				if($user_email){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$user_email' AND meta_key='1'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$user_email,'meta_key'=>1));
					}
				}						
						
				$user_phone = str_replace('+','',pn_strip_input($item->user_phone));
				if($user_phone){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$user_phone' AND meta_key='2'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$user_phone,'meta_key'=>2));
					}	
				}
						
				$user_skype = pn_strip_input($item->user_skype);
				if($user_skype){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$user_skype' AND meta_key='3'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$user_skype,'meta_key'=>3));
					}
				}

				$user_ip = pn_strip_input($item->user_ip);
				if($user_ip){
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."blacklist WHERE meta_value='$user_ip' AND meta_key='4'");
					if($cc == 0){
						$wpdb->insert($wpdb->prefix.'blacklist', array('meta_value'=>$user_ip,'meta_key'=>4));
					}
				}	
						
			}
		}
	}	
	/* end ЧС */	
}

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'add_many');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'config');