<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('standart_whitelist_options')){
	add_filter( 'whitelist_options', 'standart_whitelist_options' );
	function standart_whitelist_options($whitelist_options){
		if(isset($whitelist_options['general'])){	
			$key = array_search('blogname',$whitelist_options['general']);
			if(isset($whitelist_options['general'][$key])){
				unset($whitelist_options['general'][$key]);
			}
			$key = array_search('blogdescription',$whitelist_options['general']);
			if(isset($whitelist_options['general'][$key])){
				unset($whitelist_options['general'][$key]);
			}			
		}
		return $whitelist_options;
	}

	add_action('admin_footer', 'standart_admin_lang_footer');
	function standart_admin_lang_footer(){
		$screen = get_current_screen();
		if($screen->id == 'options-general'){
			?>
			<script type="text/javascript">
			jQuery(function($){
				$('#blogname').parents('tr').hide();
				$('#blogdescription').parents('tr').hide();
			});
			</script>
			<?php
		}	
	}

	add_action('pn_adminpage_title_pn_config', 'def_adminpage_title_pn_config');
	function def_adminpage_title_pn_config($page){
		_e('General settings','pn');
	} 

	add_filter('pn_config_option', 'def_pn_config_option', 1);
	function def_pn_config_option($options){
	global $wpdb, $premiumbox;	
		
		$options['top_title'] = array(
			'view' => 'h3',
			'title' => __('General settings','pn'),
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);	
		$row = $wpdb->get_row( "SELECT option_value FROM ". $wpdb->prefix ."options WHERE option_name = 'blogname'");
		$options['blogname'] = array(
			'view' => 'inputbig',
			'title' => __('Website Title','pn'),
			'default' => $row->option_value,
			'name' => 'blogname',
			'work' => 'input',
			'ml' => 1,
		);
		
		$row = $wpdb->get_row( "SELECT option_value FROM ". $wpdb->prefix ."options WHERE option_name = 'blogdescription'");
		$options['blogdescription'] = array(
			'view' => 'inputbig',
			'title' => __('Description'),
			'default' => $row->option_value,
			'name' => 'blogdescription',
			'work' => 'input',
			'ml' => 1,
		);		
		
		return $options;
	}
	
	add_action('pn_adminpage_content_pn_config','def_adminpage_content_pn_config');
	function def_adminpage_content_pn_config(){

		$form = new PremiumForm();
		$params_form = array(
			'filter' => 'pn_config_option',
			'method' => 'post',
			'data' => '',
			'form_link' => '',
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form);
		
	} 

	add_action('premium_action_pn_config','def_premium_action_pn_config');
	function def_premium_action_pn_config(){
	global $wpdb, $premiumbox;	

		only_post();
		pn_only_caps(array('administrator'));
		
		$form = new PremiumForm();
		$data = $form->strip_options('pn_config_option', 'post');
		
		update_option('blogname', $data['blogname']);
		update_option('blogdescription', $data['blogdescription']);
		
		do_action('pn_config_option_post', $data);			
		
		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
				
		$form->answer_form($back_url);					
	}
}