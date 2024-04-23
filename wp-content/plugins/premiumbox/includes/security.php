<?php 
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('delete_eval_files')){
	add_action('init','delete_eval_files');
	function delete_eval_files($path=''){
		if(!$path){
			$my_dir = wp_upload_dir();
			$path = $my_dir['basedir'].'/';
		} 
		$true = array('.gif','.jpg','.jpeg','.jpe','.png','.csv','.htaccess','.txt','.xml','.dat','.svg');
		$true = apply_filters('delete_eval_files_ext', $true);
		if(is_dir($path)){
			$dir = @opendir($path);
			while(($file = @readdir($dir))){
				if (is_file($path.$file)){	
					$ext = strtolower(strrchr($file,"."));	
					if(!in_array($ext, $true) or strstr($file,'.php')){
						@unlink($path.$file);			
					}
				} elseif(is_dir($path.$file)){
					if ( substr($file, 0, 1) != '.'){
						delete_eval_files($path.$file.'/');
					}
				}
			}
		}
	}
}

if(!function_exists('pn_remove_pingback_method')){
	add_filter('xmlrpc_enabled', '__return_false');
	add_filter('wp_xmlrpc_server_class', 'disable_wp_xmlrpc_server_class');
	function disable_wp_xmlrpc_server_class() {
		return 'disable_wp_xmlrpc_server_class';
	}
	class disable_wp_xmlrpc_server_class {
		function serve_request() {
			echo 'XMLRPC disabled';
		}
	}
	add_filter('xmlrpc_methods', 'pn_remove_pingback_method');
	function pn_remove_pingback_method( $methods ) {
		unset( $methods['pingback.ping'] );
		unset( $methods['pingback.extensions.getPingbacks'] );
		return $methods;
	}

	add_filter('wp_headers', 'pn_remove_x_pingback_header');
	function pn_remove_x_pingback_header( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
}

if(!function_exists('security_comment_text')){
	add_filter('comment_text', 'security_comment_text',0);
	add_filter('the_content', 'security_comment_text',0);
	add_filter('the_excerpt', 'security_comment_text',0);
	function security_comment_text($content){
		return pn_strip_text($content);
	}

	add_filter('the_title', 'security_the_title',0);
	function security_the_title($content){
		return pn_strip_input($content);
	}

	add_filter('is_email', 'security_is_email',0);
	function security_is_email($content){
		return pn_strip_input($content);
	}
}

if(!function_exists('security_preprocess_comment')){
	add_filter('preprocess_comment', 'security_preprocess_comment',10);
	function security_preprocess_comment($commentdata){
		
		if(is_array($commentdata)){
			$new_comment = array();
			foreach($commentdata as $k => $v){
				$new_comment[$k] = pn_maxf_mb(pn_strip_text($v), 2000);
			}
			return $new_comment;
		}
		
		return $commentdata;
	}
}

if(!function_exists('security_query_vars')){
	add_filter( 'query_vars', 'security_query_vars' );
	function security_query_vars($data){
		if(!is_admin()){
			$key = array_search('author', $data);
			if($key){
				if(isset($data[$key])){
					unset($data[$key]);
				}
			}
			$key = array_search('author_name', $data);
			if($key){
				if(isset($data[$key])){
					unset($data[$key]);
				}
			}			
		}
		return $data;
	}
}

if(!function_exists('security_wp_dashboard_setup')){
	add_action('wp_dashboard_setup', 'security_wp_dashboard_setup' );
	function security_wp_dashboard_setup() {
		wp_add_dashboard_widget('standart_security_dashboard_widget', __('Security check','pn'), 'dashboard_security_in_admin_panel');
	}

	function dashboard_security_in_admin_panel(){

		$errors = apply_filters('premium_security_errors', array());
		$errors = (array)$errors;
		
		$r=0;
		foreach($errors as $error){ $r++;
			?>
			<div class="dashboard_security_line">-<?php echo $error; ?></div>
			<?php
		}
		
		if($r==0){
			_e('Security status - OK','pn');
		}
		
	}
}

if(!function_exists('pn_adminpage_head_security')){
	add_action('pn_adminpage_head','pn_adminpage_head_security', 11);
	function pn_adminpage_head_security($page){ 	
	
		$text = sprintf(__('Specify security settings or follow <a href="%s" target="_blank">the link</a> to see instructions for disabling security settings notifications.','pn'), 'https://premiumexchanger.com/wiki/biblioteka-hukov/');
		?>
		<div style="margin: 0 0 10px 0;">
			<?php
			$form = new PremiumForm();
			$form->help(__('Instructions for disabling notifications','pn'), $text);
			?>
		</div>
		<?php
		$errors = apply_filters('premium_security_errors', array());
		$errors = (array)$errors;	
		foreach($errors as $error){
			?>
			<div class="head_security_line"><?php echo $error; ?></div>
			<?php	
		}	
	}
}

if(!function_exists('def_premium_security_errors')){
	add_filter('premium_security_errors', 'def_premium_security_errors');
	function def_premium_security_errors($errors){
	global $wpdb, $premiumbox;
	
		$updater = ABSPATH . 'updater.php';
		if(is_file($updater)){ 
			$errors[] = __('There is a dangerous script updater.php in root directory. Delete it','pn');
		}	
		
		$sql_file = ABSPATH . 'damp_db.sql';
		if(is_file($sql_file)){ 
			$errors[] = __('There is a dangerous file damp_db.sql in root directory. Delete it','pn');
		}		
		
		$installer = ABSPATH . 'installer/';
		if(is_dir($installer)){ 
			$errors[] = __('There is a dangerous folder installer in root directory. Delete it','pn'); 
		}	

		if(!defined('DISALLOW_FILE_MODS') or defined('DISALLOW_FILE_MODS') and !constant('DISALLOW_FILE_MODS')){
			$errors[] = __('Edit mode enabled. Disable it','pn');
		}	
		
		if(defined('PN_ADMIN_GOWP') and constant('PN_ADMIN_GOWP') == 'true'){
			$errors[] = __('Disable editing mode','pn');
		}
		
		$admin_panel_url = is_admin_newurl($premiumbox->get_option('admin_panel_url'));
		if(!$admin_panel_url){
			$errors[] = __('Set new address of website control panel','pn');
		}	

		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		if(isset($ui->user_login) and $ui->user_login == 'admin' or isset($ui->user_login) and $ui->user_login == 'administrator'){ 
			$errors[] = __('You are using standard admin login. Please change it','pn');		
		}	
		
		if(isset($ui->email_login) and $ui->email_login != 1){ 
			$errors[] = __('E-mail authorization is disabled. Set up an appropriate e-mail template and enable an e-mail authorization in a user account','pn'); 	
		}
		
		if(isset($ui->user_pass) and $ui->user_pass == '$P$BASwWSemU6D3fp2iRd2M7pX0SH.g2a/'){ 
			$errors[] = __('You are using standard admin password. Please change it','pn');		
		}

		$pincode = intval($premiumbox->get_option('pincode'));
		
		if(isset($ui->user_pin) and !$ui->user_pin and $pincode == 1){ 
			$errors[] = __('You have not set a personal PIN code','pn');		
		}

		if(isset($ui->enable_pin) and $ui->enable_pin == 0 and $pincode == 1){ 
			$errors[] = __('PIN code verification disabled','pn');		
		}		

		if(!is_extension_active('pn_extended', 'moduls', 'admincaptcha') and !is_extension_active('pn_extended', 'moduls', 'recaptcha')){
			$errors[] = __('Enable captcha for control panel','pn');
		}

		return $errors;
	}
}