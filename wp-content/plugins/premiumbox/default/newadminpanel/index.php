<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_register_url')){
	add_filter('register_url','pn_register_url');
	function pn_register_url($url){
	global $premiumbox;	
		return $premiumbox->get_page('register');
	}
}

if(!function_exists('pn_lostpassword_url')){
	add_filter('lostpassword_url','pn_lostpassword_url');
	function pn_lostpassword_url($url){
	global $premiumbox;		
		return $premiumbox->get_page('lostpass');
	}
}

if(!function_exists('login_form_notfound')){

	global $admin_panel_url, $premiumbox, $wpdb;
	$admin_panel_url = is_admin_newurl($premiumbox->get_option('admin_panel_url'));

	add_action('login_form_register','login_form_notfound');
	add_action('login_form_retrievepassword','login_form_notfound');
	add_action('login_form_resetpass','login_form_notfound');
	add_action('login_form_rp','login_form_notfound');
	add_action('login_form_lostpassword','login_form_notfound');
	if(defined('PN_ADMIN_GOWP') and constant('PN_ADMIN_GOWP') != 'true' and $admin_panel_url){
		remove_action('admin_enqueue_scripts','wp_auth_check_load');
		add_action('login_form_login','login_form_notfound');
		
		add_filter('wp_redirect', 'pn_filter_wp_login');
		add_filter('network_site_url', 'pn_filter_wp_login');
		add_filter('site_url', 'pn_filter_wp_login');
		
		add_action('init', 'set_login_page');
		
		add_action('premium_action_pn_admin_login','def_premium_action_pn_admin_login');
	}

	function login_form_notfound(){
		pn_display_mess(__('Page does not exist','pn'));
	}
	
	function pn_filter_wp_login($str){
	global $admin_panel_url, $or_site_url, $wpdb;	
		if(preg_match("/reauth/i", $str)){
			wp_redirect($or_site_url);
			exit;
		} 	
		return str_replace('wp-login.php', $admin_panel_url, $str);
	}	
	
	function set_login_page(){
		global $admin_panel_url, $premiumbox, $wpdb, $or_site_url, $wp_query;
		
		$data = premium_rewrite_data();
		$super_base = $data['super_base'];
		$base = $data['base'];

		if($super_base == $admin_panel_url){			
			
			$ui = wp_get_current_user();
			$user_id = intval($ui->ID);	
			
			if($user_id){
				if(current_user_can('read')){
					$url = admin_url('index.php');
					wp_redirect($url);
					exit;
				} else {
					return;
				}
			}			
			
			header('Content-Type: text/html; charset=utf-8');
			$wp_query->set_404();
			status_header(404);			
			
			$premium_url = get_premium_url();
			$plugin_url = $premiumbox->plugin_url;
			$plugin_version = current_time('timestamp');		
			?>
<!DOCTYPE html>
<html lang="<?php echo get_locale(); ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="PalmComputingPlatform" content="true" />
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php _e('Authorization','pn'); ?></title>
	<link rel='stylesheet' href='<?php echo $plugin_url; ?>default/newadminpanel/style.css?ver=<?php echo $plugin_version; ?>' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo $premium_url; ?>js/jquery.min.js?ver=<?php echo $plugin_version; ?>'></script>
	<script type='text/javascript' src='<?php echo $premium_url; ?>js/jquery.form.js?ver=<?php echo $plugin_version; ?>'></script>
	<script type="text/javascript">
		<?php set_premium_default_js('admin'); ?>
	</script>	
	<?php do_action('newadminpanel_form_head'); ?>
</head>
<body>
<div id="container">
	<div class="wrap">
		<form method="post" class="ajax_post_form" action="<?php pn_the_link_post('pn_admin_login'); ?>">
		<input type="hidden" name="super_base" value="<?php echo $super_base; ?>" />
		
		<div class="resultgo"></div>
		<div class="form">
			<div class="form_title"><?php _e('Authorization','pn'); ?></div>
			
			<div class="form_line">
				<div class="form_label"><?php _e('Login or email', 'pn'); ?></div>
				<input type="text" name="logmail" class="notclear" value="" />
			</div>

			<div class="form_line">
				<div class="form_label"><?php _e('Password', 'pn'); ?></div>
				<input type="password" name="pass" class="notclear" value="" />
			</div>
			
			<?php do_action('newadminpanel_form'); ?>
			
			<div class="form_line centered"><input type="submit" formtarget="_top" name="submit" value="<?php _e('Sign in', 'pn'); ?>" /></div>
			
			<div class="form_links"><a href="<?php echo $premiumbox->get_page('register'); ?>"><?php _e('Sign up','pn'); ?></a> | <a href="<?php echo $premiumbox->get_page('lostpass'); ?>"><?php _e('Forgot password?','pn'); ?></a></div>
		</div>
		</form>
	</div>
	<?php do_action('newadminpanel_form_footer'); ?>
</div>	
</body>
</html>		
			<?php
			exit;
		}
	}	
	
	function def_premium_action_pn_admin_login(){
	global $wpdb, $premiumbox, $or_site_url, $admin_panel_url;	
		
		only_post();
		nocache_headers();
			
		$secure_cookie = is_ssl();
		
		$log = array();	
		$log['response'] = '';
		$log['status'] = '';
		$log['status_code'] = 0;
		$log['status_text'] = '';
		$log['errors'] = array();
		
		$log = apply_filters('before_ajax_form_field', $log, 'newadminpanel');
		$log = apply_filters('newadminpanel_ajax_form', $log);
		
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);			
		
		if($user_id){
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('Error! This form is available for unauthorized users only','pn');
			if(current_user_can('read')){
				$url = admin_url('index.php');
			} else {
				$url = $or_site_url;
			}
			$log['url'] = $url;
			echo json_encode($log);
			exit;		
		}
			
		$logmail = is_param_post('logmail');
		if(strstr($logmail,'@')){
			$logmail = is_email($logmail);
		} else {
			$logmail = is_user($logmail);
		}

		$pass = is_password(is_param_post('pass'));
		
		if($logmail){
			if($pass){
				$super_base = trim(is_param_post('super_base'));
				if($admin_panel_url == $super_base){
					if(strstr($logmail,'@')){
						$ui = get_user_by('email', $logmail);
					} else {
						$ui = get_user_by('login', $logmail);
					}
					if(isset($ui->ID)){
						$creds = array();
						$creds['user_login'] = is_user($ui->user_login);
						$creds['user_password'] = $pass;
						$creds['remember'] = true;
						$user = wp_signon($creds, $secure_cookie);	
					
						$log = apply_filters('premium_auth', $log, $user, 'admin');
					
						if ($user && !is_wp_error($user)) {
							$log['status'] = 'success';
							$log['url'] = admin_url('index.php');		
						} elseif($user and isset($user->errors['pn_error'])){
							$log['status'] = 'error';	
							$log['status_text'] = $user->errors['pn_error'][0];
						} elseif($user and isset($user->errors['pn_success'])){	
							$log['status'] = 'success_clear';	
							$log['status_text'] = $user->errors['pn_success'][0];
						} else {
							$log['status'] = 'error';
							$log['status_code'] = 1;
							$log['status_text'] = __('Error! Wrong pair of username/password entered','pn');
						}
					} else {
						$log['status'] = 'error';
						$log['status_code'] = 1;
						$log['status_text'] = __('Error! Wrong pair of username/password entered','pn');				
					}
				} else {
					$log['status'] = 'error';
					$log['status_code'] = 1;
					$log['status_text'] = __('Error! Wrong pair of username/password entered','pn');				
				}			
			} else {
				$log['status'] = 'error';
				$log['status_code'] = 1;
				$log['status_text'] = __('Error! Incorrect password','pn');
			}
		} else {
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('Error! Incorrect login or e-mail','pn');
		}			
		
		echo json_encode($log);	
		exit;
	}	
	
	add_filter('pn_config_option', 'newadminpanel_config_option');
	function newadminpanel_config_option($options){
	global $premiumbox;
		
		$options['line2'] = array(
			'view' => 'line',
			'colspan' => 2,
		);	
		$options['newpanel'] = array(
			'view' => 'inputbig',
			'title' => __('Admin panel URL', 'pn'),
			'default' => $premiumbox->get_option('admin_panel_url'),
			'name' => 'admin_panel_url',
			'work' => 'input',
		);
		$options['newpanel_help'] = array(
			'view' => 'help',
			'title' => __('More info','pn'),
			'default' => __('Enter new URL to enter the admin panel. Use only lowercase letters and numbers. Be sure to remember the entered address!','pn'),
		);	
		
		return $options;
	}

	add_action('pn_config_option_post', 'newadminpanel_config_option_post');
	function newadminpanel_config_option_post($data){
	global $premiumbox;
	
		$admin_panel_url = is_admin_newurl($data['admin_panel_url']);
		$premiumbox->update_option('admin_panel_url','',$admin_panel_url);
		
	}	
	
}