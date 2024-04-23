<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_get_current_screen')){
	function pn_get_current_screen(){
		$screen = get_current_screen();
		$screen_id = is_isset($screen,'id');
		if(strstr($screen_id, 'page_')){
			$screen_arr = explode('page_',$screen_id);
			$screen_id = is_isset($screen_arr,1);
		}
		return $screen_id;
	}
}

if(!function_exists('pn_set_screen_option')){
	add_filter('set-screen-option', 'pn_set_screen_option', 10, 3);
	function pn_set_screen_option($status, $option, $value) {
		return $value;
	}
}

if(!function_exists('pn_trev_hook')){
	function pn_trev_hook(){
		$page = pn_strip_input(is_param_get('page'));
		if(has_filter('premium_screen_' . $page)){
			do_action('premium_screen_' . $page);
		}
	}
}

if(!function_exists('pn_only_caps')){
	function pn_only_caps($caps, $method=''){
		$caps = (array)$caps;
		$method = trim(is_param_post('form_method'));
		if($method != 'ajax'){ $method = 'display'; }
		$dopusk = 0;
		foreach($caps as $cap){
			if(current_user_can($cap)){
				$dopusk = 1;
				break;
			}
		}
		if(!$dopusk){
			if($method == 'ajax'){
				$log = array();
				$log['status'] = 'error';
				$log['status_code'] = '1'; 
				$log['status_text']= __('Error! Insufficient privileges','premium');
				echo json_encode($log);
				exit;				
			} else {
				pn_display_mess(__('Error! Insufficient privileges','premium'));				
			}
		}
	}
}

if(!function_exists('pn_admin_head')){
	add_action('admin_head', 'pn_admin_head');
	function pn_admin_head(){
		$screen_id = pn_get_current_screen();
		
		if(has_filter('pn_adminpage_style_' . $screen_id) or has_filter('pn_adminpage_style')){
			?>
			<style>
				<?php
					do_action('pn_adminpage_style_' . $screen_id);
					do_action('pn_adminpage_style');
				?>
			</style>
			<?php
		}
		
		if(has_filter('pn_adminpage_js_' . $screen_id) or has_filter('pn_adminpage_js')){
			?>
			<script type="text/javascript">
				jQuery(function($){
				<?php 
					do_action('pn_adminpage_js_' . $screen_id); 
					do_action('pn_adminpage_js'); 
				?>
				});	
			</script>	
			<?php
		}			
	}
}

if(!function_exists('pn_admin_init')){
	add_action('admin_enqueue_scripts', 'pn_admin_init', 0);
	function pn_admin_init(){	
		global $or_site_url;
		
		$pn_version = current_time('timestamp');	
		$plugin_url = get_premium_url();
		
		wp_enqueue_style('roboto-sans', is_ssl_url("https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"), false, "1.0");
		
		wp_enqueue_style('premium ui-style', $plugin_url . "js/jquery-ui/style.css", false, "1.11.4");
		wp_enqueue_style('premium style', $plugin_url . "style.css", false, $pn_version);		
		
		$screen_id = pn_get_current_screen();
		if($screen_id != 'nav-menus'){
			if(has_filter('pn_adminpage_quicktags_' . $screen_id) or has_filter('pn_adminpage_quicktags')){
				wp_enqueue_script('premium other quicktags', $or_site_url . "/premium_quicktags.js?place=". $screen_id, array('quicktags'), $pn_version);
			}	
		}
	} 
}

if(!function_exists('pn_site_init')){
	add_action('wp_enqueue_scripts', 'pn_site_init',99);
	function pn_site_init(){
		global $or_site_url;
		
		$pn_version = current_time('timestamp');
		$lang = '';
		if(function_exists('get_lang_key')){
			$lang = get_lang_key(get_locale());
		}
		wp_enqueue_script('jquery premium-js', $or_site_url . '/premiumjs.js?lang='. $lang, false, $pn_version);
	}
}

if(!function_exists('jserror_js_error_response')){
	add_action('pn_js_error_response', 'jserror_js_error_response');
	function jserror_js_error_response($type){ 
	?>
		console.log('<?php _e('Error text','premium'); ?>, text1: ' + res2 + ',text2:' + res3);
		for (key in res) {
			console.log(key + ' = ' + res[key]);
		}
	<?php
	}
} 

if(!function_exists('jserror_js_alert_response')){
	add_action('pn_js_alert_response', 'jserror_js_alert_response');
	function jserror_js_alert_response(){
	?>
		if(res['status_text']){
			alert(res['status_text']);
		}
	<?php
	}
} 

if(!function_exists('pn_back_action_link')){
	function pn_back_action_link($reply){
		$url = is_param_post('_wp_http_referer') . $reply;
		$paged = intval(is_param_post('paged'));
		if($paged > 1){ $url .= '&paged='.$paged; }	
		return $url;
	} 
}

if(!function_exists('pn_admin_prepare_lost')){
	function pn_admin_prepare_lost($lost){
		$losted = array();
		if(is_array($lost)){
			$losted = $lost;
		} elseif(is_string($lost)) {
			$l = explode(',',$lost);
			foreach($l as $lk => $lv){
				$lv = trim($lv);
				if($lv){
					$losted[$lk] = $lv;
				}
			}		
		}
		return $losted;
	}
}
 
if(!function_exists('pn_admin_search_where')){
	function pn_admin_search_where($where){
		$page = pn_strip_input(is_param_get('page'));
		return apply_filters('pn_admin_searchwhere_'.$page, $where);
	}
} 
 
if(!function_exists('pn_admin_searchbox')){
	function pn_admin_searchbox($search, $lost=''){
		$page = pn_strip_input(is_param_get('page'));
		$works = pn_admin_prepare_lost($lost); 
		$search = apply_filters('pn_admin_searchbox_'.$page, $search);
		if(is_array($search) and count($search) > 0){
			$has_filter = 0;
			$now_url = is_isset($_SERVER,'REQUEST_URI');
			$now_url = str_replace('/wp-admin/','', $now_url);
			$now_url = explode('?',$now_url);
			$now_url = $now_url[0];
			
			foreach($search as $item){
				$name = trim(is_isset($item, 'name'));
				if($name){
					$works[] = $name;
				}
			}
		?>
		<div class="premium_search">
			<form action="" method="get">
				
				<?php 
				if(isset($_GET) and is_array($_GET)){
					foreach($_GET as $key => $val){
						if(!in_array($key, $works)){
				?>
					<input type="hidden" name="<?php echo $key; ?>" value="<?php echo pn_strip_input($val); ?>" />
				<?php 
						}
					}
				} ?>
				
				<?php
				foreach($search as $option){
					$view = trim(is_isset($option,'view'));
					$title = trim(is_isset($option,'title'));
					$name = trim(is_isset($option,'name'));
					$default = trim(is_isset($option,'default'));
					if(strlen($default) > 0){
						$has_filter = 1;
					}				
					if($view == 'input'){
						?>
						<div class="premium_search_div">
							<div class="premium_search_label"><?php echo $title; ?></div>
							<input type="search" name="<?php echo $name; ?>" value="<?php echo $default; ?>" />
						</div>
						<?php
					} elseif($view == 'date'){
						?>
						<div class="premium_search_div">
							<div class="premium_search_label"><?php echo $title; ?></div>
							<input type="search" name="<?php echo $name; ?>" class="pn_datepicker" value="<?php echo $default; ?>" />
						</div>
						<?php
					} elseif($view == 'datetime'){
						?>
						<div class="premium_search_div">
							<div class="premium_search_label"><?php echo $title; ?></div>
							<input type="search" name="<?php echo $name; ?>" class="pn_timepicker" value="<?php echo $default; ?>" />
						</div>
						<?php	
					} elseif($view == 'select'){
						$options = is_isset($option,'options');
						?>
						<div class="premium_search_div">
							<div class="premium_search_label"><?php echo $title; ?></div>
							<select name="<?php echo $name; ?>" style="position: relative; top: -1px;" autocomplete="off">
								<?php foreach($options as $key => $title){ ?>
									<option value="<?php echo $key; ?>" <?php selected($key, $default); ?>><?php echo $title; ?></option>
								<?php } ?>
							</select>
						</div>
						<?php					
					} elseif($view == 'line'){
						?>
						<div class="premium_clear"></div>	
						<div class="premium_search_line"></div>
						<?php
					}
				}
				?>
				
				<div class="premium_search_div">
					<div class="premium_search_label"></div>
					<input type="submit" style="float: left; margin-right: 5px;" name="" class="button" value="<?php _e('Filter','premium'); ?>"  />
					<?php if($has_filter){ ?>
						<a href="<?php echo admin_url($now_url.'?page='.$page);?>" class="button"><?php _e('Cancel','premium'); ?></a>
					<?php } ?>
				</div>
					<div class="premium_clear"></div>
			</form>
		</div><div class="premium_clear"></div>	
		<?php
		}
	} 
}  

if(!function_exists('pn_admin_submenu')){
	function pn_admin_submenu($options, $lost=''){
		$losted = pn_admin_prepare_lost($lost);
		$page = pn_strip_input(is_param_get('page'));
		$options = apply_filters('pn_admin_submenu_'.$page, $options);
		if(is_array($options)){
			foreach($options as $option_name => $option){
				$title = pn_strip_input(is_isset($option, 'title'));
				$name = trim(is_isset($option, 'name'));
				$lists = is_isset($option, 'options');
				$mod = pn_strip_input(is_param_get($name));
				$now_url = is_isset($_SERVER,'REQUEST_URI');
				$now_url = str_replace('/wp-admin/','', $now_url);
				$now_url = explode('?',$now_url);
				$link = $now_url[0];
				$sign = '?'; 
				if(isset($_GET) and is_array($_GET)){
					foreach($_GET as $k => $v){
						if($k != $name and !in_array($k, $losted)){
							$link .= $sign . $k .'='. esc_html($v);
							$sign = '&';
						}
					}
				}	
				?>
				<div class="premium_submenu">
					<?php if($title){ ?>
						<div class="premium_submenu_title">
							<?php echo $title; ?>:
						</div>
					<?php } ?>
					<ul class="subsubsub">
						<li><a href="<?php echo $link;?>" <?php if(!$mod){?>class="current"<?php }?>><?php _e('All'); ?></a></li>
						<?php 
						if(is_array($lists)){
							foreach($lists as $key => $val){
						?>
							<li>| <a href="<?php echo $link . $sign . $name . '=' . $key; ?>" <?php if($mod == $key){ ?>class="current"<?php }?> ><?php echo $val; ?></a></li>
						<?php 
							}
						} 
						?>
					</ul>	
						<div class="premium_clear"></div>
				</div>
					<div class="premium_clear"></div>
				<?php
			}
		}
	}
}  
 
if(!function_exists('pn_admin_filter_data')){
	function pn_admin_filter_data($url, $lost=''){
		$losted = pn_admin_prepare_lost($lost);
		$n = parse_url($url);
		$data_url = array();
		if(isset($n['query'])){
			parse_str($n['query'], $data_url);
		}
		foreach($losted as $v){
			if(isset($data_url[$v])){
				unset($data_url[$v]);
			}		
		}
		$sign = '?';
		$link = is_isset($n, 'path');
		if(is_array($data_url)){
			foreach($data_url as $k => $v){  
				$link .= $sign . $k .'='. esc_html($v);
				$sign = '&';
			}
		}	
		return $link . $sign;
	}
}