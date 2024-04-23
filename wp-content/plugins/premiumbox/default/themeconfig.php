<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_themeconfig')){
	
	add_action('admin_menu', 'admin_menu_themeconfig');
	function admin_menu_themeconfig(){
	global $premiumbox;
		add_submenu_page("pn_themeconfig", __('Images','pn'), __('Images','pn'), 'administrator', "pn_themeconfig", array($premiumbox, 'admin_temp'));
	}

	add_action('pn_adminpage_title_pn_themeconfig', 'def_pn_adminpage_title_pn_themeconfig');
	function def_pn_adminpage_title_pn_themeconfig($page){
		_e('Images','pn');
	} 

	add_filter('pn_themeconfig_option', 'def_pn_themeconfig_option', 1);
	function def_pn_themeconfig_option($options){
	global $wpdb, $premiumbox;	
		
		$options['top_title'] = array(
			'view' => 'h3',
			'title' => __('Images','pn'),
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);
				
		$options['favicon'] = array(
			'view' => 'uploader',
			'title' => __('Favicon', 'pn'),
			'default' => $premiumbox->get_option('favicon'),
			'name' => 'favicon',
			'work' => 'input',
			'ml' => 1,
		);			
				
		$options['logo'] = array(
			'view' => 'uploader',
			'title' => __('Logo', 'pn'),
			'default' => $premiumbox->get_option('logo'),
			'name' => 'logo',
			'work' => 'input',
			'ml' => 1,
		);					

		$options['textlogo'] = array(
			'view' => 'inputbig',
			'title' => __('Text logo', 'pn'),
			'default' => $premiumbox->get_option('textlogo'),
			'name' => 'textlogo',
			'work' => 'input',
			'ml' => 1,
		);		
		
		return $options;
	}	
	
	add_action('pn_adminpage_content_pn_themeconfig','def_pn_adminpage_content_pn_themeconfig');
	function def_pn_adminpage_content_pn_themeconfig(){
	global $wpdb, $premiumbox;

		$form = new PremiumForm();
		$params_form = array(
			'filter' => 'pn_themeconfig_option',
			'method' => 'post',
			'data' => '',
			'form_link' => '',
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form);	
		
	} 

	add_action('premium_action_pn_themeconfig','def_premium_action_pn_themeconfig');
	function def_premium_action_pn_themeconfig(){
	global $wpdb, $premiumbox;	

		only_post();
		pn_only_caps(array('administrator'));

		$form = new PremiumForm();
		$data = $form->strip_options('pn_themeconfig_option', 'post');
		
		$opts =  array('favicon','logo','textlogo');
		foreach($opts as $opt){
			$premiumbox->update_option($opt,'',$data[$opt]);
		}	
		
		do_action('pn_themeconfig_option_post', $data);
		
		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
				
		$form->answer_form($back_url);	
	}

	add_action('wp_head','favicon_theme_wp_head');
	add_action('admin_head','favicon_theme_wp_head');
	function favicon_theme_wp_head(){
	global $premiumbox;

		$favicon = pn_strip_input(ctv_ml($premiumbox->get_option('favicon')));
		if($favicon){ 
			$wp_filetype = wp_check_filetype(basename($favicon), null );
			$favicon = is_ssl_url($favicon);
	?>
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="<?php echo is_isset($wp_filetype,'type');?>" />
	<link rel="icon" href="<?php echo $favicon;?>" type="<?php echo is_isset($wp_filetype,'type');?>" />
	<?php
		}
	} 

	function get_logotype(){
	global $premiumbox;
		return is_ssl_url(pn_strip_input(ctv_ml($premiumbox->get_option('logo'))));
	}
	function get_textlogo(){
	global $premiumbox;	
		return pn_strip_input(ctv_ml($premiumbox->get_option('textlogo')));
	} 
}