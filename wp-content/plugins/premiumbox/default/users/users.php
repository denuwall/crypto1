<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_sanitize_user')){
	add_filter('sanitize_user','pn_sanitize_user');
	function pn_sanitize_user($login){
		$login = is_user($login);
		return $login;
	}
}

if(!function_exists('pn_delete_user')){
	add_action( 'delete_user', 'pn_delete_user');
	function pn_delete_user($user_id){
		global $wpdb;
		$wpdb->query("DELETE FROM ". $wpdb->prefix. "auth_logs WHERE user_id = '$user_id'");	
	}		
}	

if(!function_exists('user_pn_user_register')){
	add_action('pn_user_register', 'user_pn_user_register');
	function user_pn_user_register($user_id) {
		global $wpdb;
		
		$array = array();
		$array['user_registered'] = current_time('mysql');
		$array['user_browser'] = pn_maxf(pn_strip_input(is_isset($_SERVER,'HTTP_USER_AGENT')),500);
		$array['user_ip'] = pn_real_ip();
		$array['user_bann'] = 0;
		$array['admin_comment'] = '';
		$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));		
	}
}

if(!function_exists('del_autologs')){
	function del_autologs(){
	global $wpdb, $premiumbox;
	
		$count_day = intval($premiumbox->get_option('logssettings', 'delete_autologs_day'));
		if(!$count_day){ $count_day = 60; }
		$count_day = apply_filters('delete_autologs_day', $count_day);
		if($count_day > 0){
			$time = current_time('timestamp') - ($count_day * DAY_IN_SECONDS); 
			$ldate = date('Y-m-d H:i:s', $time);
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."auth_logs WHERE auth_date < '$ldate'");
			foreach($items as $item){
				$item_id = $item->id;
				do_action('pn_alogs_delete_before', $item_id, $item);
				$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."auth_logs WHERE id = '$item_id'");
				do_action('pn_alogs_delete', $item_id, $item);
				if($result){
					do_action('pn_alogs_delete_after', $item_id, $item);
				}
			}
		}
	}	
}	
	
if(!function_exists('del_autologs_cronjob')){
	add_filter('list_cron_func', 'del_autologs_cronjob');
	function del_autologs_cronjob($filters){
		global $premiumbox;	

		if(!$premiumbox->is_up_mode()){
			$filters['del_autologs'] = array(
				'title' => __('Deleting authorization logs','pn'),
				'site' => '1day',
			);
		}
		
		return $filters;
	} 
}

if(!function_exists('set_list_logs_settings')){
	add_filter('list_logs_settings', 'set_list_logs_settings');
	function set_list_logs_settings($filters){
			
		$filters['delete_autologs_day'] = array(
			'title' => __('Deleting authorization logs','pn').' ('. __('days','pn') .')',
			'count' => 60,
			'minimum' => 3,
		);
		
		return $filters;
	} 
}

if(!function_exists('auth_fail_logs')){
	add_filter('authenticate', 'auth_fail_logs', 1000);
	function auth_fail_logs($user){
		global $wpdb;
		
		$logmail = '';
		if(isset($_POST['log'])){
			$logmail = is_param_post('log');
		}
		if(isset($_POST['logmail'])){
			$logmail = is_param_post('logmail');
		}	
			
		if($logmail and is_wp_error($user)){	
			if(strstr($logmail,'@')){
				$logmail = is_email($logmail);
				$ui = get_user_by('email', $logmail);
			} else {
				$logmail = is_user($logmail);
				$ui = get_user_by('login', $logmail);
			}
			if(isset($ui->ID)){
				$error_text = pn_strip_input($user->get_error_message());
				
				$user_id = $ui->ID;
				
				$old_user_browser = is_isset($ui, 'user_browser');
				$old_user_ip = is_isset($ui, 'user_ip');
			
				$now_user_browser = pn_maxf(pn_strip_input(is_isset($_SERVER,'HTTP_USER_AGENT')),500);
				$now_user_ip = pn_real_ip();
			
				$array = array();
				$array['auth_date'] = current_time('mysql');
				$array['user_id'] = $user_id;
				$array['user_login'] = is_user($ui->user_login);
				$array['now_user_ip'] = $now_user_ip;
				$array['now_user_browser'] = $now_user_browser;
				$array['old_user_ip'] = $old_user_ip;
				$array['old_user_browser'] = $old_user_browser;		
				$array['auth_status'] = 0;
				$array['auth_status_text'] = $error_text;
				$wpdb->insert($wpdb->prefix . 'auth_logs', $array);			
			}
		}	
		
		return $user;
	}
}	

if(!function_exists('save_user_ip_browser')){
	add_action('set_logged_in_cookie', 'save_user_ip_browser', 99, 4);
	function save_user_ip_browser($logged_in_cookie, $expire, $expiration, $user_id){
		global $change_ld_account, $wpdb;
		
		if($change_ld_account != 1 and $user_id > 0){
			$ui = get_userdata($user_id);
			
			$old_user_browser = is_isset($ui, 'user_browser');
			$old_user_ip = is_isset($ui, 'user_ip');
			
			$now_user_browser = pn_maxf(pn_strip_input(is_isset($_SERVER,'HTTP_USER_AGENT')),500);
			$now_user_ip = pn_real_ip();
			
			$array = array();
			$array['user_browser'] = $now_user_browser;
			$array['user_ip'] = $now_user_ip;
			$wpdb->update($wpdb->prefix ."users", $array, array('ID'=> $user_id));
			
			$array = array();
			$array['auth_date'] = current_time('mysql');
			$array['user_id'] = $user_id;
			$array['user_login'] = is_user($ui->user_login);
			$array['now_user_ip'] = $now_user_ip;
			$array['now_user_browser'] = $now_user_browser;
			$array['old_user_ip'] = $old_user_ip;
			$array['old_user_browser'] = $old_user_browser;		
			$array['auth_status'] = 1;
			$wpdb->insert($wpdb->prefix . 'auth_logs', $array);
		
			if(isset($ui->sec_login) and $ui->sec_login == 1){
				
				$notify_tags = array();
				$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
				$notify_tags['[date]'] = $array['auth_date'];
				$notify_tags['[ip]'] = $array['now_user_ip'];
				$notify_tags['[browser]'] = get_browser_name($array['now_user_browser'], __('Unknown','pn'));
				$notify_tags['[old_ip]'] = $array['old_user_ip'];
				$notify_tags['[old_browser]'] = get_browser_name($array['old_user_browser'], __('Unknown','pn'));
				$notify_tags = apply_filters('notify_tags_alogs', $notify_tags, $array, $ui);
				
				$user_send_data = array(
					'user_email' => is_isset($ui, 'user_email'),
					'user_phone' => is_isset($ui, 'user_phone'),
				);
				$result_mail = apply_filters('premium_send_message', 0, 'alogs', $notify_tags, $user_send_data); 	
				
			}					
		}
	}
}

if(!function_exists('list_user_notify_alogs')){
	add_filter('list_user_notify','list_user_notify_alogs');
	function list_user_notify_alogs($places){
		$places['alogs'] = __('Notify of user logging into personal account','pn');
		$places['letterauth'] = __('Two-factor authorization by one-time ref','pn');
		return $places;
	}
}

if(!function_exists('def_list_notify_tags_alogs')){
	add_filter('list_notify_tags_alogs','def_list_notify_tags_alogs');
	function def_list_notify_tags_alogs($tags){
		$tags['date'] = __('Date','pn');
		$tags['ip'] = __('Current IP address','pn');
		$tags['browser'] = __('Current browser','pn');
		$tags['old_ip'] = __('Previous IP address','pn');
		$tags['old_browser'] = __('Previous browser','pn');		
		return $tags;
	}
}

if(!function_exists('def_notify_tags_letterauth')){
	add_filter('list_notify_tags_letterauth','def_notify_tags_letterauth');
	function def_notify_tags_letterauth($tags){
		$tags['link'] = __('Link','pn');		
		return $tags;
	}
}

if(!function_exists('pn_unset_profile_colorcheme')){
	add_action('admin_head', 'pn_unset_profile_colorcheme');
	function pn_unset_profile_colorcheme() {
		global $_wp_admin_css_colors;
		$_wp_admin_css_colors = 0;
	}
}

if(!function_exists('admin_init_operator')){
	add_action('admin_init','admin_init_operator');
	function admin_init_operator(){
		global $wpdb;
		
		$ui = wp_get_current_user();	
		$user_id = intval($ui->ID);
		
		$array = array();
		$array['last_adminpanel'] = current_time('timestamp');
		$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));
	}
}

if(!function_exists('standart_user_wp_dashboard_setup')){
	add_action('wp_dashboard_setup', 'standart_user_wp_dashboard_setup' );
	function standart_user_wp_dashboard_setup() {
		wp_add_dashboard_widget('standart_user_dashboard_widget', __('Users in Admin Panel','pn'), 'dashboard_users_in_admin_panel');
	}
}	

if(!function_exists('dashboard_users_in_admin_panel')){
	function dashboard_users_in_admin_panel(){
		global $wpdb;

		$time = current_time('timestamp') - 60;
		$users = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."users WHERE last_adminpanel >= '$time'");
		foreach($users as $us){
			echo '<strong>'. is_user($us->user_login) . '</strong> ('. date("d.m.Y, H:i:s", pn_strip_input($us->last_adminpanel)) .')';
			echo '<hr />';
		}
	}
}	

if(!function_exists('pn_unset_profile_details')){
	add_filter('user_contactmethods','pn_unset_profile_details',10,1);
	function pn_unset_profile_details( $conts ) {
		if(isset($conts['yim'])){
			unset($conts['yim']);
		}
		if(isset($conts['aim'])){
			unset($conts['aim']);
		}
		if(isset($conts['jabber'])){
			unset($conts['jabber']);
		}

		$conts['second_name'] = __('Second name','pn');
		$conts['user_phone'] = __('Phone no.','pn');
		$conts['user_skype'] = __('Skype','pn');
		$conts['user_passport'] = __('Passport number','pn');		
			
		return $conts;
	}
}	

if(!function_exists('pn_premium_action_stand_admin_comment')){
	add_action('premium_action_stand_admin_comment', 'pn_premium_action_stand_admin_comment');
	function pn_premium_action_stand_admin_comment(){
	global $wpdb;
	
		$log = array();
		$log['response'] = '';
		$log['status'] = '';
		$log['status_code'] = 0;
		$log['status_text'] = '';
		
		$user_id = intval(is_param_post('user_id'));
		if($user_id){
			if(current_user_can('administrator')){
				$array = array();
				$array['admin_comment'] = $text = pn_maxf_mb(pn_strip_input(is_param_post('user_comment')),1000);
				$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));
						
				$log['status'] = 'success';
				$log['response'] = $text;
			} else {
				$log['status'] = 'error'; 
				$log['status_code'] = 1;
				$log['status_text'] = __('Error! Insufficient privileges','pn');		
			}
		} else {
			$log['status'] = 'error'; 
			$log['status_code'] = 1;
			$log['status_text'] = __('Error! ID is not specified','pn');
		} 
		echo json_encode($log);		
		exit;	
	} 
}

if(!function_exists('stand_pn_adminpage_js_users')){
	add_action('pn_adminpage_js_users', 'stand_pn_adminpage_js_users');
	function stand_pn_adminpage_js_users(){
	?>
	var now_id = 0;
	
	$(document).on('click','.user_comment',function(){
		
		now_id = $(this).attr('data-id');
		var text = $(this).find('.user_comment_text').html();
		
		<?php
		$content = '<form action="'. pn_link_post('stand_admin_comment', 'post') .'" class="user_ajax_form" method="post"><p><textarea id="hide_user_comment" name="user_comment"></textarea></p><p><input type="submit" name="submit" class="button-primary" value="'. __('Save','pn') .'" /></p><input type="hidden" id="hide_user_id" name="user_id" value="" /></form>';
		?>
		
		$(document).JsWindow('show', {
			id: 'update_info',
			div_class: 'update_window',
			title: '<?php _e('Comment to user','pn'); ?>',
			content: '<?php echo $content; ?>',
			shadow: 1,
			after: init_user_ajax_form
		});
		
		$('#hide_user_comment').val(text);
		$('#hide_user_id').val(now_id);
	});	
	
	function init_user_ajax_form(){
	
		var thet = '';
		$('.user_ajax_form').ajaxForm({
			dataType:  'json',
			beforeSubmit: function(a,f,o) {
				thet = f;
				thet.find('input[type=submit]').prop('disabled',true);
			},
			error: function(res, res2, res3) {
				<?php do_action('pn_js_error_response', 'form'); ?>
			},		
			success: function(res) {
				if(res['status'] == 'error') {
					<?php do_action('pn_js_alert_response'); ?>
				} else {
					$(document).JsWindow('hide');

					if(res['response'] && res['response'].length > 1){
						$('#ucomment-'+now_id).find('.user_comment_text').html(res['response']);
						$('#ucomment-'+now_id).addClass('has_comment');
					} else {
						$('#ucomment-'+now_id).find('.user_comment_text').html('');
						$('#ucomment-'+now_id).removeClass('has_comment');
					}	
				}
				thet.find('input[type=submit]').prop('disabled',false);
			}
		});	
	
	}

	<?php	
	}
}

if(!function_exists('pn_manage_users_sortable_columns')){
	add_filter('manage_users_sortable_columns','pn_manage_users_sortable_columns');
	function pn_manage_users_sortable_columns($sortable_columns){
		
		$sortable_columns['rdate'] = 'user_registered';
		$sortable_columns['rid'] = 'ID';
		$sortable_columns['last_adminpanel'] = 'last_adminpanel';
		
		return $sortable_columns;
	}
}
	
if(!function_exists('pn_users_columns')){
	add_filter('manage_users_columns', 'pn_users_columns',1);
	function pn_users_columns($columns) {

		$columns = array();
		$columns['cb']  = '<input type="checkbox" />';
		$columns['rid'] = 'ID';
		$columns['username'] = __( 'Username' );
		$columns['rdate'] = __('Registration date','pn');
		$columns['email']    = __( 'E-mail' );
		$columns['role']     = __( 'Role' );
		$columns['last_adminpanel']    = __( 'Admin Panel','pn' );
		$columns['user_phone'] = __('Phone no.','pn');
		$columns['user_skype'] = __('Skype','pn');		
		
		$columns['user_browser'] = __('Browser','pn');
		$columns['user_ip'] = __('IP','pn');
		$columns['user_bann'] = __('Ban','pn');
		$columns['admin_comment'] = __('Comment','pn');
			
		return $columns;
	}
}

if(!function_exists('pn_manage_users_custom_column')){
	add_filter('manage_users_custom_column', 'pn_manage_users_custom_column', 10, 3);
	function pn_manage_users_custom_column($empty='', $column_name, $user_id){
			
		if($column_name == 'rdate'){
			$ui = get_userdata($user_id);
			return get_mytime($ui->user_registered,'d.m.Y, H:i');
		} 
			
		if($column_name == 'user_browser'){
			$ui = get_userdata($user_id);
			$user_browser = get_browser_name(is_isset($ui, 'user_browser'), __('Unknown','pn'));
			return $user_browser;
		}
		
		if($column_name == 'last_adminpanel'){
			$ui = get_userdata($user_id);
			$admin_time_last = pn_strip_input(is_isset($ui, 'last_adminpanel'));
			if($admin_time_last){
				return date("d.m.Y, H:i:s",$admin_time_last);
			}
		}	

		if($column_name == 'user_ip'){
			$ui = get_userdata($user_id);
			$user_ip = pn_strip_input(is_isset($ui, 'user_ip'));
			return $user_ip;
		}

		if($column_name == 'user_bann'){
			$ui = get_userdata($user_id);
			$user_bann = intval(is_isset($ui, 'user_bann'));
			if($user_bann == 1){		
				return '<span class="bred">'. __('banned','pn') .'</span>';
			} else {
				return __('not banned','pn');
			}
		}

		if($column_name == 'user_phone'){
			$user_phone = is_phone(get_user_meta($user_id, 'user_phone', true));
			return $user_phone;
		}

		if($column_name == 'user_skype'){
			$user_skype = pn_strip_input(get_user_meta($user_id, 'user_skype', true));
			return $user_skype;
		}		
		
		if($column_name == 'admin_comment'){
			$ui = get_userdata($user_id);
			$admin_comment = pn_strip_input(is_isset($ui, 'admin_comment'));
			$cl = '';
			if($admin_comment){ 
				$cl = 'has_comment'; 
			}	
				
			return '
			<div class="user_comment '. $cl .'" id="ucomment-'. $user_id .'" data-id="'. $user_id .'">
				<div class="user_comment_text">'. $admin_comment .'</div>
			</div>';
		}		
		
		if($column_name == 'rid'){
			return $user_id;	
		}		
			
		return $empty;	
	}
}

if(!function_exists('pn_hide_admin_bar')){
	add_action('init', 'pn_hide_admin_bar');
	function pn_hide_admin_bar(){
		if (!current_user_can('read')){	
			add_filter('show_admin_bar', '__return_false');	
		}
			
		if(!current_user_can('administrator')){
			global $or_site_url;
			$ui = wp_get_current_user();
			$user_bann = intval(is_isset($ui, 'user_bann'));
			if($user_bann == 1){
				wp_logout();
				wp_redirect($or_site_url);
				exit();
			}			
		}
	}
}

if(!function_exists('pn_profile_update')){
	add_action( 'profile_update', 'pn_profile_update');
	function pn_profile_update($user_id){
		global $change_ld_account, $wpdb;
		$change_ld_account = 1;
		
		if(isset($_POST['pn_profile_update'])){
		
			$array = array();
			$array['user_pin'] = pn_strip_input(is_param_post('user_pin'));
			$array['enable_pin'] = intval(is_param_post('enable_pin'));
			$array['user_bann'] = intval(is_param_post('user_bann'));
			$array['admin_comment'] = pn_maxf_mb(pn_strip_input(is_param_post('admin_comment')),1000);
			$array['sec_lostpass'] = intval(is_param_post('sec_lostpass'));
			$array['sec_login'] = intval(is_param_post('sec_login'));
			$array['email_login'] = intval(is_param_post('email_login'));
			$array['enable_ips'] = pn_maxf(pn_strip_input(is_param_post('enable_ips')),1500);
			$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));
		
		}
	}	
}	

if(!function_exists('pn_edit_user')){
	add_action( 'show_user_profile', 'pn_edit_user');
	add_action( 'edit_user_profile', 'pn_edit_user');	
	function pn_edit_user($user){
		$user_id = $user->ID;
		$user_bann = pn_strip_input(is_isset($user, 'user_bann'));
		$user_browser = pn_strip_input(is_isset($user, 'user_browser'));
		$user_ip = pn_strip_input(is_isset($user, 'user_ip'));
		$admin_comment = pn_strip_input(is_isset($user, 'admin_comment'));
		$user_pin = pn_strip_input(is_isset($user, 'user_pin'));
		$enable_pin = pn_strip_input(is_isset($user, 'enable_pin'));
		?>
		<input type="hidden" name="pn_profile_update" value="1" />
		
		<h3><?php _e('User information','pn'); ?></h3>
	    <table class="form-table">	
			<tr>
				<th>
					<label for="user_ip"><?php _e('IP','pn'); ?></label>
				</th>
				<td>
					<input type="text" name="user_ip" id="user_ip" disabled class="regular-text" autocomplete="off" value="<?php echo $user_ip;?>" />
			   </td>
			</tr>
			<tr>
				<th>
					<label for="user_browser"><?php _e('Browser','pn'); ?></label>
				</th>
				<td>
					<input type="text" name="user_browser" id="user_browser" disabled class="regular-text" autocomplete="off" value="<?php echo $user_browser;?>" />
			   </td>
			</tr>
			<tr>
				<th>
					<label for="admin_comment"><?php _e('Comment','pn'); ?></label>
				</th>
				<td>
					<textarea name="admin_comment" id="admin_comment" rows="5" cols="30"><?php echo $admin_comment; ?></textarea>
			   </td>
			</tr>
			<tr>
				<th>
					<label for="user_bann"><?php _e('Ban','pn'); ?></label>
				</th>
				<td>
					<select name="user_bann" id="user_bann" autocomplete="off">
						<option value='0'><?php _e('not banned','pn'); ?></option>
						<option value='1' <?php selected($user_bann, 1); ?>><?php _e('banned','pn'); ?></option>
					</select>
			   </td>
			</tr>			
        </table>		
		
		<h3><?php _e('Security settings','pn'); ?></h3>
	    <table class="form-table">	
			<tr>
				<th>
					<label for="user_pin"><?php _e('Personal PIN code','pn'); ?></label>
				</th>
				<td>
					<input type="text" name="user_pin" id="user_pin" class="regular-text" autocomplete="off" value="<?php echo $user_pin;?>" />
			   </td>
			</tr>
			<tr>
				<th>
					<label for="enable_pin"><?php _e('Request personal PIN code','pn'); ?>:</label>
				</th>
				<td>
					<select name="enable_pin" id="enable_pin">
						<option value="0"><?php _e('No','pn'); ?></option>
						<option value="1" <?php selected($enable_pin, 1); ?>><?php _e('Always','pn'); ?></option>
						<option value="2" <?php selected($enable_pin, 2); ?>><?php _e('If IP address changed','pn'); ?></option>
						<option value="3" <?php selected($enable_pin, 3); ?>><?php _e('If browser changed','pn'); ?></option>
						<option value="4" <?php selected($enable_pin, 4); ?>><?php _e('If IP address or browser changed','pn'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sec_lostpass"><?php _e('Password recovery','pn'); ?>:</label>
				</th>
				<td>
					<select name="sec_lostpass" id="sec_lostpass">
						<option value="0"><?php _e('No','pn'); ?></option>
						<option value="1" <?php selected($user->sec_lostpass, 1); ?>><?php _e('Yes','pn'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="sec_login"><?php _e('E-mail notification upon authentication','pn'); ?>:</label>
				</th>
				<td>
					<select name="sec_login" id="sec_login">
						<option value="0"><?php _e('No','pn'); ?></option>
						<option value="1" <?php selected($user->sec_login, 1); ?>><?php _e('Yes','pn'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="email_login"><?php _e('Two-factor authentication by one-time ref','pn'); ?>:</label>
				</th>
				<td>
					<select name="email_login" id="email_login">
						<option value="0"><?php _e('No','pn'); ?></option>
						<option value="1" <?php selected($user->email_login, 1); ?>><?php _e('Yes','pn'); ?></option>
					</select>
				</td>
			</tr>			
			<tr>
				<th>
					<label><?php _e('Allowed IP address (in new line)','pn'); ?>:</label>
				</th>
				<td>
					<textarea name="enable_ips" rows="5" cols="30"><?php echo pn_strip_input(is_isset($user,'enable_ips')); ?></textarea>
				</td>
			</tr>			
        </table>
		<?php
	}
} 