<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_rtl')){

	add_action('admin_menu', 'admin_menu_rtl');
	function admin_menu_rtl(){
	global $premiumbox;	
		add_submenu_page("pn_config", __('Writing settings','pn'), __('Writing settings','pn'), 'administrator', "pn_rtl", array($premiumbox, 'admin_temp'));
	}

	add_action('pn_adminpage_title_pn_rtl', 'def_pn_adminpage_title_pn_rtl');
	function def_pn_adminpage_title_pn_rtl($page){
		_e('Writing settings','pn');
	}

	add_filter('pn_rtl_option', 'def_pn_rtl_option', 1);
	function def_pn_rtl_option($options){
	global $wpdb, $premiumbox;	
		
		$langs = apply_filters('pn_site_langs', array());
		
		$lang = get_option('pn_lang');
		if(!is_array($lang)){ $lang = array(); }
		
		$rtl = is_isset($lang,'rtl');
		if(!is_array($rtl)){ $rtl = array(); }
		
		$options['top_title'] = array(
			'view' => 'h3',
			'title' => __('Writing settings','pn'),
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);	
		foreach($langs as $la_key => $la_title){
			$options[$la_key] = array(
				'view' => 'select',
				'title' => sprintf(__('Writing setting for language "%s"','pn'), $la_title),
				'options' => array('ltr'=> 'LTR', 'rtl'=> 'RTL'),
				'default' => is_isset($rtl, $la_key),
				'name' => $la_key,
				'work' => 'input',
			);
		}		
		
		return $options;
	}	
	
	add_action('pn_adminpage_content_pn_rtl','def_pn_adminpage_content_pn_rtl');
	function def_pn_adminpage_content_pn_rtl(){
	global $premiumbox;
		
		$form = new PremiumForm();
		$params_form = array(
			'filter' => 'pn_rtl_option',
			'method' => 'post',
			'data' => '',
			'form_link' => '',
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form);		
		
	}   

	add_action('premium_action_pn_rtl','def_premium_action_pn_rtl');
	function def_premium_action_pn_rtl(){
	global $wpdb, $premiumbox;	

		only_post();
		pn_only_caps(array('administrator'));

		$langs = apply_filters('pn_site_langs', array());
		
		$form = new PremiumForm();
		$data = $form->strip_options('pn_rtl_option', 'post');
				
		$lang = get_option('pn_lang');
		foreach($langs as $la_key => $la_title){
			$lang['rtl'][$la_key] = $data[$la_key];
		}
		update_option('pn_lang',$lang);
				
		do_action('pn_rtl_option_post', $data);			
				
		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';

		$form->answer_form($back_url);
	} 	
}