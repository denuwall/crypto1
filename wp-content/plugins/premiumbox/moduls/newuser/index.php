<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Newcomers verification during exchange[:en_US][ru_RU:]Проверка на новичка при обмене[:ru_RU]
description: [en_US:]Newcomers verification during exchange[:en_US][ru_RU:]Проверка на новичка при обмене[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_newuser');
function bd_pn_moduls_active_newuser(){
global $wpdb;	
	
    $query = $wpdb->query("SHOW COLUMNS FROM ". $wpdb->prefix ."exchange_bids LIKE 'new_user'");
    if ($query == 0) {
        $wpdb->query("ALTER TABLE ". $wpdb->prefix ."exchange_bids ADD `new_user` int(2) NOT NULL default '0'");
    }
	
}
add_action('pn_bd_activated', 'bd_pn_moduls_migrate_newuser');
function bd_pn_moduls_migrate_newuser(){
global $wpdb;

    $query = $wpdb->query("SHOW COLUMNS FROM ". $wpdb->prefix ."exchange_bids LIKE 'new_user'");
    if ($query == 0) {
        $wpdb->query("ALTER TABLE ". $wpdb->prefix ."exchange_bids ADD `new_user` int(2) NOT NULL default '0'");
    }
	
}

add_filter('pn_exchange_config_option', 'newuser_exchange_config_option');
function newuser_exchange_config_option($options){

	$options[] = array(
		'view' => 'user_func',
		'func_data' => array(),
		'func' => 'pn_newuser_option1',
	);		
	
	return $options;	
}

function pn_newuser_option1(){
	$check_new_user = get_option('check_new_user');
	if(!is_array($check_new_user)){ $check_new_user = array(); }
				
	$fields = array(
		'0'=> __('Invoice Send','pn'),
		'1'=> __('Invoice Receive','pn'),
		'2'=> __('Phone no.','pn'),
		'3'=> __('Skype','pn'),
		'4'=> __('E-mail','pn'),
	);
	?>
	<tr>
		<th><?php _e('Newcomer verification','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php 
				if(is_array($fields)){
					foreach($fields as $key => $val){ 
					?>
						<div><label><input type="checkbox" name="check_new_user[]" <?php if(in_array($key,$check_new_user)){ ?>checked="checked"<?php } ?> value="<?php echo $key; ?>" /> <?php echo $val; ?></label></div>
					<?php 
					} 
				}
				?>							
			</div>
		</td>		
	</tr>				
	<?php				
}

add_action('pn_exchange_config_option_post', 'newuser_exchange_config_option_post');
function newuser_exchange_config_option_post(){
	
	$check_new_user = is_param_post('check_new_user');
	update_option('check_new_user', $check_new_user);
	
}

add_filter('array_data_bids_new', 'newuser_array_data_bids_new', 10, 2);
function newuser_array_data_bids_new($array, $obmen){
global $wpdb;

	$obmen_id = $obmen->id;
	
	$check_new_user = get_option('check_new_user');
	if(!is_array($check_new_user)){ $check_new_user = array(); }	
	
	$new = 0;
	
	$user_phone = is_phone($obmen->user_phone);
	$user_skype = pn_strip_input($obmen->user_skype);
	$user_email = is_email($obmen->user_email);
	$account1 = pn_strip_input($obmen->account_give);
	$account2 = pn_strip_input($obmen->account_get);
	
	if($account1 and in_array(0,$check_new_user)){
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE account_give='$account1' AND id != '$obmen_id' AND status = 'success'");
		if($cc == 0){ $new = 1; }
	}
	if($account2 and $new == 0 and in_array(1,$check_new_user)){
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE account_get='$account2' AND id != '$obmen_id' AND status = 'success'");
		if($cc == 0){ $new = 1; }
	}
	if($user_phone and $new == 0 and in_array(2,$check_new_user)){
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE user_phone='$user_phone' AND id != '$obmen_id' AND status = 'success'");
		if($cc == 0){ $new = 1; }
	}
	if($user_skype and $new == 0 and in_array(3,$check_new_user)){
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE user_skype='$user_skype' AND id != '$obmen_id' AND status = 'success'");
		if($cc == 0){ $new = 1; }
	}
	if($user_email and $new == 0 and in_array(4,$check_new_user)){
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE user_email='$user_email' AND id != '$obmen_id' AND status = 'success'");
		if($cc == 0){ $new = 1; }
	}	
	
	$query = $wpdb->query("CHECK TABLE ".$wpdb->prefix . "archive_exchange_bids");
	if($query == 1){

		if($account1 and $new == 1 and in_array(0,$check_new_user)){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE account_give='$account1' AND status = 'success'");
			if($cc > 0){ $new = 0; }
		}
		if($account2 and $new == 1 and in_array(1,$check_new_user)){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE account_get='$account2' AND status = 'success'");
			if($cc > 0){ $new = 0; }
		}
		if($user_phone and $new == 1 and in_array(2,$check_new_user)){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE user_phone='$user_phone' AND status = 'success'");
			if($cc > 0){ $new = 0; }
		}
		if($user_skype and $new == 1 and in_array(3,$check_new_user)){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE user_skype='$user_skype' AND status = 'success'");
			if($cc > 0){ $new = 0; }
		}
		if($user_email and $new == 1 and in_array(4,$check_new_user)){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE user_email='$user_email' AND status = 'success'");
			if($cc > 0){ $new = 0; }
		}
	
	}
		
	$array['new_user'] = $new;	
	
	return $array;
}

add_filter('change_bids_filter_list', 'newuser_change_bids_filter_list'); 
function newuser_change_bids_filter_list($lists){
global $wpdb;
	
	$options = array(
		'0' => '--'. __('All','pn').'--',
		'1' => __('Yes','pn'),
		'2' => __('No','pn'),
	);
			
	$lists['other']['new'] = array(
		'title' => __('Newcomer','pn'),
		'name' => 'new',
		'options' => $options,
		'view' => 'select',
		'work' => 'options',
	);	
	
	return $lists;
}

add_filter('where_request_sql_bids', 'newuser_where_request_sql_bids', 10,2);
function newuser_where_request_sql_bids($where, $pars_data){
global $wpdb;	
	
	$pr = $wpdb->prefix;
	$new = intval(is_isset($pars_data,'new'));
	if($new == 1){
		$where .= " AND {$pr}exchange_bids.new_user = '1'";
	} elseif($new == 2){	
		$where .= " AND {$pr}exchange_bids.new_user = '0'";
	}	
	
	return $where;
}

add_filter('onebid_icons','onebid_icons_newuser',10,2);
function onebid_icons_newuser($onebid_icon, $item){
global $premiumbox;
	
	if(isset($item->new_user) and $item->new_user == 1){
		$onebid_icon['newuser'] = array(
			'type' => 'label',
			'title' => __('Attention! Newcomer makes an exchange','pn'),
			'image' => $premiumbox->plugin_url . 'images/new.png',
		);	
	}
	
	return $onebid_icon;
}