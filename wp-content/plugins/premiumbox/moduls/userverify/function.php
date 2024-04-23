<?php
if( !defined( 'ABSPATH')){ exit(); } 

function get_usvedoc_temp($id, $field_id){
global $wpdb;
$temp = '';

	$id = intval($id);
	if($id < 1){ $id = 0; }
	$userverify = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."uv_field_user WHERE uv_id='$id' AND uv_field='$field_id'");
	if(isset($userverify->id)){
		$file = pn_strip_input($userverify->uv_data);
		if($file){
			$temp .= '
				<div class="usvefilelock">
					<a href="'. get_usve_doc($userverify->id) .'" target="_blank">'. $file .'</a>
				';
				
				if(is_admin()){
					$temp .= ' | <a href="'. get_usve_doc($userverify->id) .'" target="_blank">'. __('Download','pn') .'</a> | <a href="'. get_usve_doc_view($userverify->id) .'" target="_blank">'. __('View','pn') .'</a>';
				}
				
				$temp .= '
				</div>	
			';
		} 
	}
	
	return $temp;
}

function pn_verify_uv($key){
global $premiumbox;	

	$uf = $premiumbox->get_option('usve','verify_fields');
	return intval(is_isset($uf, $key));
}

add_filter('manage_users_sortable_columns','userverify_manage_users_sortable_columns');
function userverify_manage_users_sortable_columns($sortable_columns){
	$sortable_columns['user_verify'] = 'user_verify';
	return $sortable_columns;
}

add_filter('manage_users_columns', 'userverify_users_columns',99);
function userverify_users_columns($columns) {	
	$columns['user_verify'] = __('Verification','pn'); 
	return $columns;
}

add_filter('manage_users_custom_column', 'userverify_manage_status_column', 99, 3);
function userverify_manage_status_column($empty='', $column_name, $user_id) {
	if($column_name == 'user_verify'){
		$ui = get_userdata($user_id);
		if(isset($ui->user_verify) and $ui->user_verify == 1){
			return '<span class="bgreen">'. __('verified','pn') .'</span>';
		} else {
			return '<span class="bred">'. __('not verified','pn') .'</span>';
		}
	}	
	return $empty;
}

add_action( 'profile_update', 'userverify_profile_update');
function userverify_profile_update($user_id){
	if(isset($_POST['userverify_profile_update']) and current_user_can('administrator')){	
		global $wpdb;
		$array = array();
		$array['user_verify'] = intval(is_param_post('user_verify'));
		$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));
	}	
}

add_action( 'show_user_profile', 'userverify_edit_user');
add_action( 'edit_user_profile', 'userverify_edit_user');
function userverify_edit_user($user){
global $wpdb;
    $user_id = $user->ID;
	if(current_user_can('administrator')){
		if(isset($user->user_verify)){
		?>
		<input type="hidden" name="userverify_profile_update" value="1" />
		
		<h3><?php _e('Verification','pn'); ?></h3> 
	    <table class="form-table">
			<tr>
				<th>
					<label><?php _e('Status','pn'); ?></label>
				</th>
				<td>
					<select name="user_verify" id="user_verify" autocomplete="off">
						<option value='0'><?php _e('not verified','pn'); ?></option>
						<option value='1' <?php selected($user->user_verify, 1); ?>><?php _e('verified','pn'); ?></option>
					</select>				
			   </td>
			</tr>
			<?php
			if($user->user_verify == 1){
				$fields = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uv_field LEFT OUTER JOIN ". $wpdb->prefix ."uv_field_user ON(".$wpdb->prefix."uv_field.id = ". $wpdb->prefix ."uv_field_user.uv_field) WHERE user_id='$user_id' AND fieldvid='1' ORDER BY uv_order ASC");
				if(count($fields) > 0){
				?>
				<tr>
					<th>
						<label><?php _e('Verification files','pn'); ?></label>
					</th>
					<td>
						<?php
						foreach($fields as $field){
							?>
							<div><strong><?php echo pn_strip_input(ctv_ml($field->title)); ?>:</strong> <a href="<?php echo get_usve_doc_view($field->id); ?>" target="_blank"><?php _e('View','pn'); ?></a></div>
							<?php
						}	
						?>
				   </td>
				</tr>
				<?php
				}
			}
			?>
        </table>
		<?php
		}
	}
}

add_action( 'delete_user', 'delete_user_userverify');
function delete_user_userverify($user_id){
global $wpdb;

	$usves = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."verify_bids WHERE user_id = '$user_id'");
	foreach($usves as $data){
		$id = $data->id;
		do_action('pn_usve_delete_before', $id, $data);
		$result = $wpdb->query("DELETE FROM ". $wpdb->prefix ."verify_bids WHERE id = '$id'");
		do_action('pn_usve_delete', $id, $data);
		if($result){
			do_action('pn_usve_delete_after', $id, $data);
		}
	}
	
}

add_filter('list_icon_indicators', 'userverify_icon_indicators');
function userverify_icon_indicators($lists){
	$lists['verify_bids'] = __('Requests for profile verification','pn');
	return $lists;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_userverify');
function wp_before_admin_bar_render_userverify() {
global $wp_admin_bar, $wpdb, $premiumbox;
	
    if(current_user_can('administrator') or current_user_can('pn_userverify')){
		if(get_icon_indicators('verify_bids')){
			$count = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."verify_bids WHERE auto_status = '1' AND status = '1'");
			if($count > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_userverify',
					'href' => admin_url('admin.php?page=pn_usve&mod=1'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/userverify.png) no-repeat center center"></div>',
					'meta' => array( 'title' => __('Requests for profile verification','pn').' ('. $count .')' )		
				));	
			}
		}
	}
}

add_filter('user_discount','userverify_user_discount',99,2);
function userverify_user_discount($sk, $user_id){
global $premiumbox;	
	if($user_id){
		$ui = get_userdata($user_id);
		if(isset($ui->user_verify) and $ui->user_verify == 1){
			$verifysk = is_sum($premiumbox->get_option('usve','verifysk'));
			$sk = $sk + $verifysk;
		}
	}
	return $sk;
}  

function delete_last_userverify(){
global $wpdb;	
	
	$my_dir = wp_upload_dir();
	$time = current_time('timestamp') - (24*60*60);
	$date = date('Y-m-d H:i:s', $time); 
	$usves = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."verify_bids WHERE auto_status='0' AND create_date < '$date'");
	foreach($usves as $item){
		$id = $item->id;
		do_action('pn_usve_delete_before', $id, $item);
		$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."verify_bids WHERE id = '$id'");
		if($result){
			do_action('pn_usve_delete', $id, $item);
		}
	}			
}

function clear_visible_userverify(){
	$my_dir = wp_upload_dir();
	$path = $my_dir['basedir'].'/usveshow/';
	full_del_dir($path);
}

add_filter('list_cron_func', 'delete_last_userverify_list_cron_func');
function delete_last_userverify_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['delete_last_userverify'] = array(
			'title' => __('Removal of blank requests waiting for verification','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}

add_filter('list_cron_func', 'clear_visible_userverify_list_cron_func');
function clear_visible_userverify_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['clear_visible_userverify'] = array(
			'title' => __('Delete verification files','pn'),
			'site' => '1hour',
		);
	}
	
	return $filters;
}

add_filter('disabled_account_form_line', 'userverify_disabled_account_form_line',99,3);
function userverify_disabled_account_form_line($disabled,$name, $ui){
	
	if(isset($ui->user_verify) and $ui->user_verify == 1){
		if(
			$name == 'first_name' and pn_verify_uv('first_name') or 
			$name == 'second_name' and pn_verify_uv('second_name') or 
			$name == 'last_name' and pn_verify_uv('last_name') or 
			$name == 'user_passport' and pn_verify_uv('user_passport') or
			$name == 'user_phone' and pn_verify_uv('user_phone') or
			$name == 'user_skype' and pn_verify_uv('user_skype') or
			$name == 'user_email' and pn_verify_uv('user_email')
		){
			return 1;
		}
	}
	
	return $disabled;
}

add_action('tab_direction_tab8','tab_direction_tab_userverify',100,2);
function tab_direction_tab_userverify($data, $data_id){
?>	
	<tr>
		<th><?php _e('Verified users only','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php 
					$verify = get_direction_meta($data_id, 'verify');
				?>									
				<select name="verify" autocomplete="off"> 
					<option value="0" <?php selected($verify,0); ?>><?php _e('No','pn'); ?></option>
					<option value="1" <?php selected($verify,1); ?>><?php _e('Yes','pn'); ?></option>
					<option value="2" <?php selected($verify,2); ?>><?php _e('If exchange amount is more than','pn'); ?></option>
				</select>
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<?php 
				$verify_sum = get_direction_meta($data_id, 'verify_sum');
				?>									
				<input type="text" name="verify_sum" value="<?php echo is_sum($verify_sum); ?>" /> <strong><?php _e('Exchange amount for Send','pn'); ?></strong>
			</div>		
		</td>
	</tr>	
<?php
}
 
add_action('pn_direction_edit','pn_direction_edit_userverify');
add_action('pn_direction_add','pn_direction_edit_userverify');
function pn_direction_edit_userverify($data_id){
	
	$verify = intval(is_param_post('verify'));
	update_direction_meta($data_id, 'verify', $verify);
	
	$verify_sum = is_sum(is_param_post('verify_sum'));
	update_direction_meta($data_id, 'verify_sum', $verify_sum);	
	
}

add_filter('file_xml_lines', 'file_xml_lines_userverify', 100, 4);
function file_xml_lines_userverify($lines, $ob, $vd1, $vd2){
	
	$verify = intval(get_direction_meta($ob->id, 'verify'));
	if($verify){
		if(isset($lines['param'])){
			$lines['param'] = $lines['param'].', verifying';
		} else {
			$lines['param'] = 'verifying';
		}
	}
	
	return $lines;
} 

add_filter('exchange_other_filter', 'userverify_exchange_other_filter');
function userverify_exchange_other_filter($html){
global $direction_data, $premiumbox;	

	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	if(isset($ui->user_verify)){
		if($ui->user_verify != 1){
			$direction_id = $direction_data->direction_id;
			$verify = intval(get_direction_meta($direction_id, 'verify'));
			if($verify != 0){
				$new_text = '';
				$text = pn_strip_text(ctv_ml($premiumbox->get_option('usve','text_notverify')));
				if($verify == 1 and $text){
					$new_text = $text;
				}
				$text = pn_strip_text(ctv_ml($premiumbox->get_option('usve','text_notverifysum')));
				if($verify == 2 and $text){
					$new_text = $text;
				}	
				if(strstr($new_text, '[amount]')){
					$verify_sum = is_sum(get_direction_meta($direction_id, 'verify_sum'));
					$new_text = str_replace('[amount]', $verify_sum, $new_text);
				}
				if($new_text){
					$html .= '<div class="notverify_message_wrap"><div class="notverify_message"><div class="notverify_message_ins">'. $new_text .'</div></div></div>';
				}
			}
		}
	}
	
	return $html;
}

add_filter('cf_auto_form_value','cf_auto_form_value_userverify',99,5);
function cf_auto_form_value_userverify($cauv,$value,$op_item, $direction, $cdata){
global $wpdb;
	$cf_auto = $op_item->cf_auto;
	$sum = $cdata['sum1dc'];


	$verify = intval(is_isset($direction,'verify'));
	$verify_sum = is_sum(is_isset($direction,'verify_sum'));
	if($verify == 1 or $verify == 2 and $sum >= $verify_sum){
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		if($user_id){
			if(isset($ui->user_verify)){	
				if($ui->user_verify == 1){
					
					$err = 0;
					
					if($cf_auto == 'first_name' and is_isset($ui,'first_name') != $value and pn_verify_uv('first_name')){
						$err = 1;
					} elseif($cf_auto == 'last_name' and is_isset($ui,'last_name') != $value and pn_verify_uv('last_name')){
						$err = 1;
					} elseif($cf_auto == 'second_name' and is_isset($ui,'second_name') != $value and pn_verify_uv('second_name')){
						$err = 1;
					} elseif($cf_auto == 'user_passport' and is_isset($ui,'user_passport') != $value and pn_verify_uv('user_passport')){
						$err = 1;
					} elseif($cf_auto == 'user_phone' and is_isset($ui,'user_phone') != $value and pn_verify_uv('user_phone')){
						$err = 1;
					} elseif($cf_auto == 'user_skype' and is_isset($ui,'user_skype') != $value and pn_verify_uv('user_skype')){
						$err = 1;
					} elseif($cf_auto == 'user_email' and is_isset($ui,'user_email') != $value and pn_verify_uv('user_email')){
						$err = 1;																		
					} 	

					if($err ==1){
						$cauv = array(
							'error' => 1,
							'error_text' => __('not verified','pn')
						);						
					}
				}
			}
		}
	}
	
	return $cauv;
} 
				
add_filter('error_bids', 'error_bids_verify', 99 ,9);
function error_bids_verify($error_bids, $account1, $account2, $direction, $vd1, $vd2, $auto_data, $unmetas, $cdata){
global $premiumbox;

	$sum = $cdata['sum1dc'];
	$verify = intval(is_isset($direction,'verify'));
	$verify_sum = is_sum(is_isset($direction,'verify_sum'));
	if($verify == 1 or $verify == 2 and $sum >= $verify_sum){
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		if($user_id){
			if(isset($ui->user_verify)){
				if($ui->user_verify != 1){	
					$error_bids['error_text'][] = sprintf(__('Error! Exchange is available for verified users only. Pass user verification by link: <a href="%1s" target="_blank">%2s</a>','pn'), $premiumbox->get_page('userverify'), $premiumbox->get_page('userverify'));
				}
			}
		} else { 
			$error_bids['error_text'][] = sprintf(__('Error! Exchange is available for verified users only. Pass user verification by link: <a href="%1s" target="_blank">%2s</a>','pn'), $premiumbox->get_page('userverify'), $premiumbox->get_page('userverify'));
		}
	}
	
	return $error_bids;
}

add_filter('array_data_create_bids', 'array_data_create_bids_verify', 99, 5);
function array_data_create_bids_verify($array, $direction, $vd1, $vd2, $cdata){
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	
	$array['user_verify'] = intval(is_isset($ui,'user_verify'));
	
	return $array;
}

add_filter('onebid_icons','onebid_icons_verify',10,2);
function onebid_icons_verify($onebid_icon, $item){
global $premiumbox;
	
	if(isset($item->user_verify) and $item->user_verify == 1){
		$onebid_icon['userverify'] = array(
			'type' => 'label',
			'title' => __('Verified user','pn'),
			'image' => $premiumbox->plugin_url . 'images/userverify.png',
		);	
	}
	
	return $onebid_icon;
}