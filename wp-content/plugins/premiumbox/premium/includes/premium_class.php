<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('Premium')){
	class Premium {
		
		public $plugin_version = "0";
		public $plugin_prefix = "premium";
		public $plugin_name = "Premium";
		public $plugin_path = "";
		public $plugin_dir = "";
		public $plugin_url = "";
		public $plugin_page_name = "";
		public $plugin_option_name = "";
		public $plugin_usersess_day = "";
		public $debug_constant_name = "PREMIUM_RICH_TEST";

		function __construct($debug_mode)
		{
			
			$this->debug_mode($debug_mode);
			
			$this->init_options();
			
			add_action('plugins_loaded', array($this, 'plugin_langs_loaded'));
			
			add_filter('auth_cookie_expiration', array($this, 'auth_cookie_expiration'), 10, 3 );
			
			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
			
			add_action('activate_'. $this->plugin_path, array($this, 'plugin_activate'));
			
			add_action("admin_menu", array($this, 'tech_pages_select'));
			add_action("edit_post", array($this, 'tech_pages_edit_post'));
			
			add_action('admin_menu', array($this, 'admin_menu'), 1);
			
			add_filter($this->plugin_prefix.'_tech_pages', array($this, 'list_tech_pages'));

			global $premium_once;
			$premium_once = intval($premium_once);
			$premium_once++;
			if($premium_once == 1){
				add_action('wp_enqueue_scripts', array($this, 'pn_themeinit'),0);
				add_action('myaction_site_logout', array($this, 'myaction_site_logout')); 
				add_filter('logout_url', array($this, 'logout_url'));
				add_filter('premium_send_message', array($this,'def_premium_send_message'), 10, 4);
				if($this->is_debug_mode()){
					add_action('wp_footer', array($this, 'wp_footer_text'), 1000);
					add_filter('admin_footer_text', array($this, 'admin_footer_text'), 1000);
				}
			}
		}
		
		public function def_premium_send_message($result, $method, $notify_tags='', $user_send_data='', $lang=''){ 
			if(!is_array($notify_tags)){ $notify_tags = array(); }
			
			if(!$lang){ $lang = get_locale(); }
			
			$pn_notify = get_pn_notify();
			$pn_notify_email = is_isset($pn_notify, 'email');
			
			if(isset($pn_notify_email[$method])){
				$data = $pn_notify_email[$method];
				if($data['send'] == 1){
					$ot_mail = is_email($data['mail']);
					$ot_mail = get_replace_arrays($notify_tags, $ot_mail, 1);
					$ot_name = pn_strip_input($data['name']);
					$ot_name = get_replace_arrays($notify_tags, $ot_name, 1);
					$subject = pn_strip_input(ctv_ml($data['title'], $lang));
					$subject = get_replace_arrays($notify_tags, $subject);
					$html = pn_strip_text(ctv_ml($data['text'], $lang));
					$html = get_replace_arrays($notify_tags, $html, 1);
					$html = str_replace('[subject]', $subject, $html);
					$html = apply_filters('comment_text',$html);
					$to_mail = is_email(is_isset($user_send_data, 'user_email'));
					if(!$to_mail){ $to_mail = is_isset($data,'tomail'); }
					
					do_action('pn_mail_send', $to_mail, $subject, $html, $ot_name, $ot_mail);
					$result = 1;
				}
			}
			
			$pn_notify_sms = is_isset($pn_notify, 'sms');
			if(isset($pn_notify_sms[$method])){
				$data = $pn_notify_sms[$method];
				if($data['send'] == 1){
					$html = pn_strip_input(ctv_ml($data['text'], $lang));
					$html = get_replace_arrays($notify_tags, $html);
					$to = is_phone(is_isset($user_send_data, 'user_phone'));
					if(!$to){ $to = is_isset($data,'to'); }
					
					do_action('pn_sms_send', $html, $to);
					$result = 1;
				}
			}
			
			return $result;
		}
		
		public function debug_mode($show=0){
			$show = intval($show);
			if($show or WP_DEBUG){	
				$debug_constant_name = $this->debug_constant_name;
				if(!defined($debug_constant_name)){
					if(function_exists('ini_set')){
						ini_set('display_errors', 1);
					}
					if(function_exists('error_reporting')){
						error_reporting(E_ALL); 
					}
					define($debug_constant_name, 1);
				}
			}
		}
		
		public function is_debug_mode(){
			$debug_constant_name = $this->debug_constant_name;
			if(defined($debug_constant_name) and constant($debug_constant_name) == 1 or WP_DEBUG){
				return 1;
			}
				return 0;
		}
		
		public function _deprecated_function( $function, $version, $replacement) {
			$debug_constant_name = $this->debug_constant_name;
			if ( defined($debug_constant_name) and constant($debug_constant_name) == 1 or WP_DEBUG) {
				if ($replacement) {
					trigger_error( sprintf( __('%1$s is <strong>deprecated</strong> in plugin <strong>%2$s</strong> since version %3$s! Use %4$s instead.', 'premium'), $function, $this->plugin_name, $version, $replacement ) );
				} else {
					trigger_error( sprintf( __('%1$s is <strong>deprecated</strong> in plugin <strong>%2$s</strong> since version %3$s with no alternative available.', 'premium'), $function, $this->plugin_name, $version ) );
				}
			}
		}		

		public function admin_menu(){
			
		}
		
		public function list_tech_pages($pages){
			
			return $pages;
		}	
		
		public function is_up_mode(){
			$up_mode = 0;
			if($this->get_option('up_mode') == 1){
				$up_mode = 1;
			}
				return $up_mode;
		}		
		
		public function up_mode($method=''){
			if(!$method){ $method = trim(is_param_get('meth')); }
			if($method != 'post'){ $method = 'get'; }
			if($this->is_up_mode()){
				if($method == 'get'){
					pn_display_mess(__('Maintenance','premium')); 
				} else {
					$log = array();
					$log['status'] = 'error';
					$log['status_code'] = '-1'; 
					$log['status_text'] = __('Maintenance','premium');
					echo json_encode($log);
					exit;	
				}
			}
		}		
		
		public function auth_cookie_expiration($expiration, $user_id, $remember){
			$session_day = intval($this->plugin_usersess_day);
			if($session_day > 0){
				$expiration = $session_day * DAY_IN_SECONDS;
			}
			return $expiration;
		} 		
		
		public function plugin_langs_loaded(){
			$plugin_path = dirname($this->plugin_path);
			if($plugin_path){
				load_plugin_textdomain( $this->plugin_prefix, false, $plugin_path . '/langs' ); 
			}
		}	

		public function init_options(){
			global $premium_options, $wpdb;
			
			$plugin_option_name = trim($this->plugin_option_name);
			if($plugin_option_name){
				$query = $wpdb->query("CHECK TABLE ".$wpdb->prefix . $plugin_option_name);
				if($query == 1){
					$query_options = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix . $plugin_option_name);
					foreach($query_options as $qc){
						$key1 = trim($qc->meta_key);
						$key2 = trim($qc->meta_key2);
						$premium_options[$this->plugin_prefix][$key1][$key2] = maybe_unserialize($qc->meta_value);
					}
				}	
			}
		}

		function get_option($option='', $option2=''){
			global $premium_options;
			
			$plugin_prefix = trim($this->plugin_prefix);
			if($plugin_prefix){
				if(isset($premium_options[$plugin_prefix][$option][$option2])){
					return $premium_options[$plugin_prefix][$option][$option2];
				} 
			}
				return false;
		}

		function update_option($key1='', $key2='', $value=''){
			global $wpdb;   	
			if(is_object($value) or is_array($value)){ $value = @serialize($value); }
			
			$key1 = pn_strip_input($key1);
			$key2 = pn_strip_input($key2);
			
			$result = 0;
			
			$plugin_option_name = trim($this->plugin_option_name);
			if($plugin_option_name){			
				$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix . $plugin_option_name ." WHERE meta_key = '$key1' AND meta_key2 = '$key2'");
				if(isset($item->id)){
					$result = $wpdb->update($wpdb->prefix . $plugin_option_name, array('meta_value'=> $value), array('id'=>$item->id));
				} else {
					$wpdb->insert($wpdb->prefix . $plugin_option_name, array('meta_key'=>$key1,'meta_key2'=>$key2,'meta_value'=> $value));
					$result = $wpdb->insert_id;
				}
			}	
				return $result;
		}

		function delete_option($key1='', $key2=''){
			global $wpdb;   	
			$key1 = pn_strip_input($key1);
			$key2 = pn_strip_input($key2);		
			$plugin_option_name = trim($this->plugin_option_name);
			if($plugin_option_name){
				return $wpdb->query("DELETE FROM ". $wpdb->prefix . $plugin_option_name . " WHERE meta_key = '$key1' AND meta_key2 = '$key2'");
			}
			return 0;
		}		
		
		public function file_include($page){
			$plugin_patch = str_replace('\\','/',$this->plugin_dir);
			$page = str_replace("\\","/",$page);
			$page = str_replace($plugin_patch,'',$page);
			$page_include = $plugin_patch . $page . ".php";
			if(file_exists($page_include)){
				include_once($page_include);
			}
		}

		public function include_patch($path, $file){
			$plugin_patch = str_replace('\\','/',$this->plugin_dir);
			$path = str_replace("\\","/",dirname($path));
			$page = str_replace($plugin_patch,'',$path);
			$this->file_include($page . '/' . $file);	
		}
		
		public function auto_include($folder,$filename=''){
			$folder = str_replace($this->plugin_dir, '', $folder);
			$foldervn = $this->plugin_dir . $folder."/";			
			if(is_dir($foldervn)){
				$dir = @opendir($foldervn);
				$abc_files = array();
				while(($file = @readdir($dir))){
					$abc_files[] = $file;
				}
				asort($abc_files);
				foreach($abc_files as $file){
					if($filename){
						if ( substr($file, -4) != '.php' and substr($file, 0, 1) != '.'){
							$this->file_include($folder. '/'. $file .'/'. $filename);
						}
					} else {
						if ( substr($file, -4) == '.php' ){
							include($foldervn. '/'. $file);
						}
					}			
				}
			}
		}			

		public function plugin_create_pages(){
			$pages = apply_filters($this->plugin_prefix.'_tech_pages', array());
			$this->create_pages($pages);
		}
		
		public function tech_pages_select(){
			$pages = apply_filters($this->plugin_prefix.'_tech_pages', array());
			if(count($pages) > 0){
				add_meta_box($this->plugin_prefix."_techpage_id", sprintf(__('Technical page "%s"', 'premium'), $this->plugin_name), array($this, "tech_pages_select_box"), 'page', "normal");
			}
		}
		
		public function tech_pages_select_box($post){
			$post_id = $post->ID; 
			$page_name = trim($this->plugin_page_name);
			$premium_pages = (array)get_option($page_name);
			$default = 0;
			foreach($premium_pages as $k => $id){
				if($id == $post_id){
					$default = $k;
				}
			}
			$sel_options = array();
			$sel_options[0] = '--'. __('No', 'premium') .'--';
			$pages = apply_filters($this->plugin_prefix.'_tech_pages', array());
			foreach($pages as $data){
				$post_name = trim(is_isset($data, 'post_name'));
				if($post_name){
					$sel_options[$post_name] = ctv_ml(is_isset($data, 'post_title'));
				}
			}
		
			$form = new PremiumForm();
			$form->select($this->plugin_prefix . '_techpage_key', $sel_options, $default);
		}
		
		public function tech_pages_edit_post($post_id){
			if(!current_user_can('edit_post', $post_id )){
				return $post_id;
			}
			
			$page_name = trim($this->plugin_page_name);	
			if($page_name and isset($_POST[$this->plugin_prefix . '_techpage_key'])){
				$premium_pages = get_option($page_name);
				if(!is_array($premium_pages)){ $premium_pages = array(); }
				$new_premium_pages = array();
				foreach($premium_pages as $k => $id){
					if($id != $post_id){
						$new_premium_pages[$k] = $id;
					}	
				}	
				$techpage_key = trim(is_param_post($this->plugin_prefix . '_techpage_key'));
				$new_premium_pages[$techpage_key] = $post_id;
				update_option($page_name, $new_premium_pages);
			}
		}
		
		public function create_pages($pages=''){
			$created = array();
			if(!is_array($pages)){ $pages = array(); }
			
			$page_name = trim($this->plugin_page_name);
			if($page_name){
				
				$premium_pages = get_option($page_name);
				if(!is_array($premium_pages)){ $premium_pages = array(); }
				
				$pages_content = array();
				foreach($pages as $page){
					if(isset($page['post_name'])){
						$post_key = trim(is_isset($page, 'post_key'));
						if(!$post_key){ $post_key = $page['post_name']; }
						
						$pages_content[$post_key] = array(
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'post_name'      => 'test',
							'post_status'    => 'publish',
							'post_title'     => 'Test',
							'post_type'      => 'page',
							'post_content'   => '',
							'post_template'   => 'pn-pluginpage.php',
						);
								
						foreach($page as $key => $val){
							if($key != 'post_key'){
								$pages_content[$post_key][$key] = $val;
							}
						}
					}
				}
						
				foreach($pages_content as $name => $data){
					if(isset($premium_pages[$name])){
						$id = intval($premium_pages[$name]);
						if($id > 0){
							$status = get_post_status($id);
							if($status === false){
								if(isset($pages_content[$name])){
									$created[$name] = $data['post_template'];
									$premium_pages[$name] = -1;
								}	
							} elseif($status != 'publish'){
								wp_update_post(array('ID' => $id, 'post_status' => 'publish'));
							}
						} else {
							$created[$name] = $data['post_template'];
							$premium_pages[$name] = -1;				
						}
					} else {
						$created[$name] = $data['post_template'];
						$premium_pages[$name] = -1;			
					}
				}		
				
				foreach($created as $name => $temp){
					$page_id = wp_insert_post($pages_content[$name]);
					if($page_id){
						$premium_pages[$name] = $page_id;
						$temp = trim($temp);
						if($temp){
							update_post_meta($page_id, '_wp_page_template', $temp) or add_post_meta($page_id, '_wp_page_template', $temp, true);
						}
					}
				}
				
				update_option($page_name, $premium_pages);	

				$homepage = intval(is_isset($premium_pages,'home'));
				$blogpage = intval(is_isset($premium_pages,'news'));
				if(!$blogpage){ $blogpage = intval(is_isset($premium_pages,'blog')); }
				if($homepage and $blogpage){
					update_option('show_on_front','page');
					update_option('page_on_front',$homepage);
					update_option('page_for_posts',$blogpage);
				}
				
			}
		}

		public function get_page($attr){
			global $premium_pages;
			$page_name = trim($this->plugin_page_name);
			if($page_name){
				$plugin_prefix = trim($this->plugin_prefix);
				if(!isset($premium_pages[$plugin_prefix])){
					$premium_pages[$plugin_prefix] = get_option($page_name);
				}
				if(isset($premium_pages[$plugin_prefix][$attr])){
					return get_permalink($premium_pages[$plugin_prefix][$attr]);
				} 
			}
				return '#';
		}

		public function get_icon_link($icon=''){
			if(!$icon){ 
				return $icon = get_premium_url() . 'images/icon.png'; 
			}
			return $this->plugin_url .'images/icon/'. $icon .'.png';
		}		
		
		public function plugin_activate(){	
			$this->file_include('activation/defaultchange');
			$this->file_include('activation/bd'); 
			$this->file_include('activation/migrate');
			$this->plugin_create_pages();
			$this->update_option('up_mode','', 1);
		}		
		
		public function logout_url($link){
			return get_ajax_link('logout', 'get');
		}
		
		public function myaction_site_logout(){
		global $or_site_url;	
		
			wp_logout();
			$url = trim(is_param_post('url'));
			if(!$url){
				if(function_exists('get_site_url_ml')){
					$url = get_site_url_ml();
				} else {
					$url = $or_site_url;
				}
			}
			
			wp_redirect($url);
			exit();				
		}		

		public function admin_enqueue_scripts(){
		global $wp_version;	
		
			$pn_version = get_premium_version();
			$plugin_vers = $this->plugin_version;
			if($this->is_debug_mode()){
				$pn_version = $plugin_vers = current_time('timestamp');
			}			
			$plugin_url = get_premium_url();
			
			$screen_id = pn_get_current_screen();
			if($screen_id != 'nav-menus'){
				if(version_compare($wp_version, '4.9.6') == '-1'){
					wp_deregister_script('jquery');
					wp_register_script('jquery', $plugin_url . 'js/jquery.min.js', false, '3.2.1');
					wp_enqueue_script('jquery');				
				}
				wp_enqueue_script('jquery-ui', $plugin_url . 'js/jquery-ui/script.min.js', false, '1.11.4');
				wp_enqueue_script("jform", $plugin_url . "js/jquery.form.js", false, "3.51");

				wp_enqueue_script("jquery-cookie", $plugin_url ."js/jcook.js", false, "2.2.0");
				wp_enqueue_script("jquery-clipboard", $plugin_url ."js/clipboard.min.js", false, "2.0.0");
				
				$locale = get_locale();
				if($locale == 'ru_RU'){
					wp_enqueue_script("jquery-datepicker", $plugin_url . "js/jquery-ui/jquery.ui.datepicker-ru.js", false, $pn_version);
					wp_enqueue_script("jquery-timepicker", $plugin_url . "js/jquery-ui/jquery-ui-timepicker-addon.js", false, $pn_version);
				} else {
					wp_enqueue_script("jquery-timepicker", $plugin_url . "js/jquery-ui/jquery-ui-timepicker-addon-en.js", false, $pn_version);
				}	

				wp_enqueue_script("jquery-window", $plugin_url ."js/jquery-window.js", false, $pn_version);
			}
			
			if (isset($_GET['page']) and preg_match('/^'. $this->plugin_prefix .'_/i',$_GET['page'])){
				$plugin_name = strtolower($this->plugin_name);
		
				wp_enqueue_style($plugin_name . ' style', $this->plugin_url . "style.css", false, $plugin_vers);
		
				wp_enqueue_script("jquery-prbar", $plugin_url ."js/jquery-prbar.js", false, $pn_version);
			
				wp_enqueue_script('premium config', $plugin_url . 'js/config.js', false, $pn_version);
		
				wp_enqueue_media();
				wp_register_script( 'tgm-nmp-media', $plugin_url . 'js/media.js' , array( 'jquery' ), $pn_version, true );
				wp_localize_script( 'tgm-nmp-media', 'tgm_nmp_media',
					array(
						'title'     => __('Choose or upload file', 'premium'), 
						'button'    => __('Insert file into the field', 'premium'),
						'library'   => 'image', 
					)
				);
				wp_enqueue_script( 'tgm-nmp-media' ); 
			}				
		}	

		public function pn_themeinit(){
			$plugin_url = get_premium_url();

			wp_deregister_script('jquery');
			wp_register_script('jquery', $plugin_url . 'js/jquery.min.js', false, '3.2.1');
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui', $plugin_url . 'js/jquery-ui/script.min.js', false, '1.11.4');
			wp_enqueue_script('jquery forms', $plugin_url . "js/jquery.form.js", false, "3.51");
			wp_enqueue_script("jquery-cookie", $plugin_url ."js/jcook.js", false, "2.1.4");
			wp_enqueue_script("jquery-window", $plugin_url ."js/jquery-window.js", false, time());
		}		
		
 		public function admin_temp(){
			$version = $this->plugin_version;
			$prefix = $this->plugin_prefix;

			$page = pn_strip_input(is_param_get('page'));
			$reply = is_param_get('reply');
			$code = is_param_get('rcode');
			
			$image = $this->plugin_url . 'images/big-icon.png';
			?>
			<div class="wrap">
				<div class="premium_wrap">
					<div class="premium_wrap_ins">
					
						<?php do_action('pn_adminpage_head', $page, $prefix); ?>
			
						<div id="premium_reply_wrap">
									
							<?php if($reply == 'true'){ 
								$reply_text = apply_filters('premium_admin_reply_true', __('Action completed successfully','premium'), $page, $code); 
							?>
								<div class="premium_reply thesuccess js_reply_wrap"><div class="premium_reply_close js_reply_close"></div><?php echo $reply_text; ?></div>
							<?php } ?>	

							<?php if($reply == 'false'){ 
								$reply_text = apply_filters('premium_admin_reply_false', __('Error! Action not completed','premium'), $page, $code); 
							?>
								<div class="premium_reply theerror js_reply_wrap"><div class="premium_reply_close js_reply_close"></div><?php echo $reply_text; ?></div>
							<?php } ?>					
										
						</div>							
		
						<?php do_action('before_pn_adminpage_title', $page, $prefix); ?>
			
						<div class="premium_header">
						
							<?php if($image){ ?>
								<div class="premium_title_logo">
									<div class="premium_title_logo_ins">
										<img src="<?php echo $image; ?>" alt="" />
									</div>	
								</div>
							<?php } ?>
							<div class="premium_title"><?php echo $this->plugin_name; ?></div> 
							<?php if($version){ ?>
								<div class="premium_version"><span class="pn_version js_<?php echo $prefix; ?>_version"><?php echo $version; ?></span></div>
							<?php } ?>
							<div class="premium_title_page">
								- <?php do_action('pn_adminpage_title_' . $page); ?>
							</div>
							<div id="premium_ajax"></div>
							
								<div class="premium_clear"></div>
						</div>
						
						<?php do_action('after_pn_adminpage_title', $page, $prefix); ?>
		
						<div class="premium_content">
			
							<?php do_action('pn_adminpage_content_'. $page); ?>
			
						</div>
			
						<?php do_action('pn_adminpage_footer', $page, $prefix); ?>
						
						<div class="premium_clear"></div>
					</div>
				</div>
			</div>		
			<?php		
		} 
		
		function wp_footer_text($text){
			$text .= ' <div style="text-align: center;">'. get_num_queries().' queries in '. timer_stop(0, 10).' seconds.</div>';
			echo $text;
		}		
		function admin_footer_text($text){
			$text .= ' <div class="alignleft">'. get_num_queries().' queries in '. timer_stop(0, 10).' seconds.</div>';
			return $text;
		}
		
	}
}