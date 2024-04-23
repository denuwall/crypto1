<?php 
if( !defined( 'ABSPATH')){ exit(); } 

add_filter("bulk_actions-toplevel_page_pn_userwallets", 'bulk_actions_uv_wallets');
function bulk_actions_uv_wallets($actions){
	$new_actions = array(
		'verify'    => __('Verified','pn'),
		'unverify'    => __('Unverified','pn'),	
	);
	if(is_array($actions)){
		foreach($actions as $ac_k => $ac_v){
			$new_actions[$ac_k] = $ac_v;
		}
	}
	return $new_actions;
}

add_filter("userwallets_manage_ap_columns", 'userwallets_manage_ap_columns_uv_wallets');
function userwallets_manage_ap_columns_uv_wallets($columns){
	$columns['status'] = __('Status','pn');
	return $columns;
}

add_filter("userwallets_manage_ap_col", 'userwallets_manage_ap_col_uv_wallets', 10, 3);
function userwallets_manage_ap_col_uv_wallets($return, $column_name,$item){
	if($column_name == 'status'){
		if($item->verify == 1){
			$status ='<span class="bgreen">'. __('Verified','pn') .'</span>';
		} else {
			$status ='<span class="bred">'. __('Unverified','pn') .'</span>';
		} 	
		return $status;	
	}
	return $return;
}

add_action( 'pn_userwallets_action', 'pn_userwallets_action_uv_wallets', 10, 2);
function pn_userwallets_action_uv_wallets($action, $post_ids){
global $wpdb;	
	if($action == 'verify'){		
		foreach($post_ids as $id){
			$id = intval($id);
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."user_wallets WHERE id='$id' AND verify != '1'");
			if(isset($item->id)){
				do_action('pn_userwallets_verify_before', $id, $item);
				$result = $wpdb->query("UPDATE ".$wpdb->prefix."user_wallets SET verify = '1' WHERE id = '$id'");
				do_action('pn_userwallets_verify', $id, $item);
				if($result){
					do_action('pn_userwallets_verify_after', $id, $item);
				}
			}
		}									
	}
	if($action == 'unverify'){		
		foreach($post_ids as $id){
			$id = intval($id);
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."user_wallets WHERE id='$id' AND verify != '0'");
			if(isset($item->id)){
				do_action('pn_userwallets_unverify_before', $id, $item);
				$result = $wpdb->query("UPDATE ".$wpdb->prefix."user_wallets SET verify = '0' WHERE id = '$id'");
				do_action('pn_userwallets_unverify', $id, $item);
				if($result){
					do_action('pn_userwallets_unverify_after', $id, $item);
				}
			}
		}								
	}	
}

add_filter("pn_admin_submenu_pn_userwallets", 'pn_admin_submenu_pn_userwallets_uv_wallets', 10, 3);
function pn_admin_submenu_pn_userwallets_uv_wallets($options){
	$options['mod'] = array(
		'name' => 'mod',
		'options' => array(
			'1' => __('verified account','pn'),
			'2' => __('unverified account','pn'),
		),
		'title' => '',
	);
	return $options;
}

add_filter("pn_admin_searchwhere_pn_userwallets", 'pn_admin_searchwhere_pn_userwallets_uv_wallets', 10, 3);
function pn_admin_searchwhere_pn_userwallets_uv_wallets($where){
	$mod = pn_strip_input(is_param_get('mod'));
	if($mod == 1){
		$where .= " AND verify = '1'";
	} elseif($mod == 2){
		$where .= " AND verify = '0'";
	}
	return $where;
}

add_filter('pn_userwallets_addform', 'uv_wallets_pn_userwallets_addform', 10, 2);
function uv_wallets_pn_userwallets_addform($options, $data){
		
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['verify'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('0'=>__('Unverified','pn'), '1'=>__('Verified account','pn')),
		'default' => is_isset($data, 'verify'),
		'name' => 'verify',
	);		
	
	return $options;
}

add_filter('pn_userwallets_addform_post', 'uv_wallets_pn_userwallets_addform_post');
function uv_wallets_pn_userwallets_addform_post($array){
	$array['verify'] = intval(is_param_post('verify'));	
	return $array;
}

add_action( 'delete_user', 'delete_user_uv_wallets');
function delete_user_uv_wallets($user_id){
global $wpdb;

	$items = $wpdb->get_results("SELECT FROM ". $wpdb->prefix ."uv_wallets WHERE user_id = '$user_id'");
	foreach($items as $item){
		$item_id = $item->id;
		do_action('pn_uv_wallets_delete_before', $item_id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."uv_wallets WHERE id = '$item_id'");
		do_action('pn_uv_wallets_delete', $item_id, $item);
		if($result){
			do_action('pn_uv_wallets_delete_after', $item_id, $item);
		}
	}	
}

add_action('pn_currency_addform','pn_currency_addform_uv_wallets', 10, 2);
function pn_currency_addform_uv_wallets($options, $data){
	
	$has_verify = get_currency_meta(is_isset($data, 'id'), 'has_verify');
	$help_verify = get_currency_meta(is_isset($data, 'id'), 'help_verify');
	$verify_files = get_currency_meta(is_isset($data, 'id'), 'verify_files');
	
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['has_verify'] = array(
		'view' => 'select',
		'title' => __('Ability for account verification','pn'),
		'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
		'default' => $has_verify,
		'name' => 'has_verify',
	);
	$options['verify_files'] = array(
		'view' => 'input',
		'title' => __('Nubmer of images for upload','pn'),
		'default' => $verify_files,
		'name' => 'verify_files',
	);	
	$options['help_verify'] = array(
		'view' => 'textarea',
		'title' => __('Instruction for account verification','pn'),
		'default' => $help_verify,
		'name' => 'help_verify',
		'width' => '',
		'height' => '100px',
		'ml' => 1,
	);	
	
	return $options;
} 

add_action('pn_currency_edit','pn_currency_edit_uv_wallets');
add_action('pn_currency_add','pn_currency_edit_uv_wallets');
function pn_currency_edit_uv_wallets($data_id){
	if($data_id){
		$has_verify = intval(is_param_post('has_verify'));

		update_currency_meta($data_id, 'has_verify', $has_verify);

		$verify_files = intval(is_param_post('verify_files'));
		update_currency_meta($data_id, 'verify_files', $verify_files);		
		
		$help_verify = pn_strip_input(is_param_post_ml('help_verify'));
		update_currency_meta($data_id, 'help_verify', $help_verify);
	}
} 

add_filter('list_icon_indicators', 'uv_wallets_icon_indicators');
function uv_wallets_icon_indicators($lists){
	$lists['uv_wallets'] = __('Account verification requests','pn');
	return $lists;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_uv_wallets');
function wp_before_admin_bar_render_uv_wallets() {
global $wp_admin_bar, $wpdb, $premiumbox;
	
    if(current_user_can('administrator') or current_user_can('pn_userwallets')){
		if(get_icon_indicators('uv_wallets')){
			$count = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."uv_wallets WHERE status = '0'");
			if($count > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_uv_wallets',
					'href' => admin_url('admin.php?page=pn_userwallets_verify&mod=1'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/verify.png) no-repeat center center"></div>',
					'meta' => array( 'title' => __('Account verification requests','pn').' ('. $count .')' )		
				));	
			}
		}
	}
}

add_action('tab_direction_tab8','tab_direction_tab_uv_wallets',100,2);
function tab_direction_tab_uv_wallets($data, $data_id){
?>	
	<tr>
		<th><?php _e('Verified accounts only','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<?php 
				$verify_account = get_direction_meta($data_id, 'verify_account');
				?>									
				<select name="verify_account" autocomplete="off"> 
					<option value="0" <?php selected($verify_account,0); ?>><?php _e('No','pn'); ?></option>
					<option value="1" <?php selected($verify_account,1); ?>><?php _e('account Send','pn'); ?></option>
					<option value="2" <?php selected($verify_account,2); ?>><?php _e('account Receive','pn'); ?></option>
					<option value="3" <?php selected($verify_account,3); ?>><?php _e('accounts Send and Receive','pn'); ?></option>
				</select>
			</div>
		</td>
	</tr>	
<?php
}

add_action('pn_direction_edit_before','pn_direction_edit_uv_wallets');
add_action('pn_direction_add','pn_direction_edit_uv_wallets');
function pn_direction_edit_uv_wallets($data_id){
	$verify_account = intval(is_param_post('verify_account'));
	update_direction_meta($data_id, 'verify_account', $verify_account);	
} 

add_filter('account1_bids','account1_bids_uv_wallets',99, 4);
function account1_bids_uv_wallets($account_bids, $account, $direction, $vd){
global $wpdb;
	
	if(isset($direction->id)){
		$currency_id = $vd->id;
		$verify_account = is_isset($direction,'verify_account');
		if($verify_account == 1 or $verify_account == 3){
			$ui = wp_get_current_user();
			$user_id = intval($ui->ID);
			if($user_id){
				$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_wallets WHERE user_id = '$user_id' AND verify='1' AND accountnum='$account' AND currency_id='$currency_id'");
				if($cc == 0){
					$account_bids = array(
						'error' => 1,
						'error_text' => __('account is not verified','pn')
					);					
				}
			} else {
				$account_bids = array(
					'error' => 1,
					'error_text' => __('account is not verified','pn')
				);				
			}
		}
	}
	
	return $account_bids;
} 

add_filter('account2_bids','account2_bids_uv_wallets',99, 4);
function account2_bids_uv_wallets($account_bids, $account, $direction, $vd){
global $wpdb;
	
	if(isset($direction->id)){
		$currency_id = $vd->id;
		$verify_account = is_isset($direction,'verify_account');
		if($verify_account == 2 or $verify_account == 3){
			$ui = wp_get_current_user();
			$user_id = intval($ui->ID);
			if($user_id){
				$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_wallets WHERE user_id = '$user_id' AND verify='1' AND accountnum='$account' AND currency_id='$currency_id'");
				if($cc == 0){
					$account_bids = array(
						'error' => 1,
						'error_text' => __('account is not verified','pn')
					);					
				}
			} else {
				$account_bids = array(
					'error' => 1,
					'error_text' => __('account is not verified','pn')
				);				
			}
		}
	}
	
	return $account_bids;
} 
 
add_filter('onebid_account_give','onebid_account_verify',99,3);
add_filter('onebid_account_get','onebid_account_verify',99,3);
function onebid_account_verify($txtacc, $account, $item){
global $wpdb;	
	
	$account = pn_strip_input($account);
	if($account){
		$user_id = $item->user_id;
		if($user_id){
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_wallets WHERE user_id = '$user_id' AND verify='1' AND accountnum='$account'");
			if($cc > 0){
				$txtacc .= '<br /> <span class="bgreen">'. __('Verified account','pn') .'</span>';
			}
		}
	}
	
	return $txtacc;
} 