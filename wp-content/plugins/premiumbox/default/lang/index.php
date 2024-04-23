<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_lang')){

	add_action('admin_menu', 'admin_menu_lang');
	function admin_menu_lang(){
	global $premiumbox;	
		add_submenu_page("pn_config", __('Language settings','pn'), __('Language settings','pn'), 'administrator', "pn_lang", array($premiumbox, 'admin_temp'));
	}

	add_action('pn_adminpage_title_pn_lang', 'def_pn_adminpage_title_pn_lang');
	function def_pn_adminpage_title_pn_lang($page){
		_e('Language settings','pn');
	}

	add_filter( 'whitelist_options', 'lang_whitelist_options' );
	function lang_whitelist_options($whitelist_options){
		if(isset($whitelist_options['general'])){	
			$key = array_search('WPLANG',$whitelist_options['general']);
			if(isset($whitelist_options['general'][$key])){
				unset($whitelist_options['general'][$key]);
			}		
		}
		return $whitelist_options;
	}	
	
	add_action('admin_footer', 'lang_admin_lang_footer');
	function lang_admin_lang_footer(){
		$screen = get_current_screen();
		
		if($screen->id == 'options-general'){
			?>
			<script type="text/javascript">
			jQuery(function($){
				$('#WPLANG').parents('tr').hide();
			});
			</script>
			<?php
		}		
		if($screen->id == 'profile' or $screen->id == 'user-edit'){
			?>
			<script type="text/javascript">
			jQuery(function($){
				$('.user-language-wrap').hide();
			});
			</script>
			<?php		
		}	
	}	

	add_filter('pn_lang_option', 'def_pn_lang_option', 1);
	function def_pn_lang_option($options){
	global $wpdb, $premiumbox;	
		
		$langs = apply_filters('pn_site_langs', array());
		
		$lang = get_option('pn_lang');
		if(!is_array($lang)){ $lang = array(); }		
		
		$admin_lang = is_isset($lang,'admin_lang');
		if(!$admin_lang){
			$admin_lang = get_locale();
		}		
		
		$site_lang = is_isset($lang,'site_lang');
		if(!$site_lang){
			$site_lang = get_locale();
		}		
		
		$multilingual = intval(is_isset($lang,'multilingual'));
		
		$multisite_lang = array();
		if(isset($lang['multisite_lang'])){
			$multisite_lang = $lang['multisite_lang'];
		}
		if(!is_array($multisite_lang)){ $multisite_lang = array(); }		
		
		$options['top_title'] = array(
			'view' => 'h3',
			'title' => __('Language settings','pn'),
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);	
		$options['lang_redir'] = array(
			'view' => 'select',
			'title' => __('User language auto detecting','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $premiumbox->get_option('lang_redir'),
			'name' => 'lang_redir',
			'work' => 'int',
		);
		$options[] = array(
			'view' => 'line',
			'colspan' => 2,
		);		
			
		$options['admin_lang'] = array(
			'view' => 'select',
			'title' => __('Admin-panel language','pn'),
			'options' => $langs,
			'default' => $admin_lang,
			'name' => 'admin_lang',
			'work' => 'input',
		);
		$options['site_lang'] = array(
			'view' => 'select',
			'title' => __('Website language','pn'),
			'options' => $langs,
			'default' => $site_lang,
			'name' => 'site_lang',
			'work' => 'input',
		);		
		$options[] = array(
			'view' => 'line',
			'colspan' => 2,
		);			
		$options['multilingual'] = array(
			'view' => 'select',
			'title' => __('Multilingual','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => $multilingual,
			'name' => 'multilingual',
			'work' => 'int',
		);
		$hidestyle = 'display: none;';
		if($multilingual == 1){
			$hidestyle = '';
		}				
		$options['multisite_lang'] = array(
			'view' => 'user_func',
			'func_data' => array(
				'hidestyle' => $hidestyle,
				'langs' => $langs,
				'multisite_lang' => $multisite_lang,
				'site_lang' => $site_lang,
			),
			'func' => 'pn_multisite_lang_option',
			'work' => 'input_array',
		);				
		
		return $options;
	}	
	
 	add_action('pn_adminpage_content_pn_lang','def_pn_adminpage_content_pn_lang');
	function def_pn_adminpage_content_pn_lang(){
	global $premiumbox;
		
		$form = new PremiumForm();
		$params_form = array(
			'filter' => 'pn_lang_option',
			'method' => 'post',
			'data' => '',
			'form_link' => '',
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form);		
		
	?>
	<script type="text/javascript">
	jQuery(function($){
		$('#pn_multilingual').change(function(){
			var vale = $(this).val();
			if(vale == 1){
				$('#pn_multilingual_area').show();
				$('.multisite_lang').find('input').prop('checked', true);
			} else {
				$('#pn_multilingual_area').hide();
				$('.multisite_lang').find('input').prop('checked', false);
			}
		});
		$('#pn_site_lang').change(function(){
			
			$('.multisite_lang').show();
			$('.multisite_lang').find('input').prop('checked', true);
			
			var vale = $(this).val();
			$('#multisite_lang_'+vale).hide();

		});	
	});
	</script>		
	<?php  
	} 

	function pn_multisite_lang_option($data){
		$langs = $data['langs'];			
		$temp = '
		<tr style="'. $data['hidestyle'] .'" id="pn_multilingual_area">
			<th></th>
			<td>
				<div class="premium_wrap_standart">';
				
					foreach($langs as $key => $title){ 
						$style = '';
						if($key == $data['site_lang']){
							$style = 'display: none;';
						}
						$checked = '';
						if(in_array($key, $data['multisite_lang']) or $data['site_lang'] == $key){ 
							$checked = 'checked="checked"';
						}							
						$temp .= '<div id="multisite_lang_'. $key .'" class="multisite_lang" style="'. $style .'"><label><input type="checkbox" name="multisite_lang[]" '. $checked .' value="'. $key .'" /> '. $title .'</label></div>';
					}
					
					$temp .= '	
				</div>
			</td>
		</tr>';			
		echo $temp;	
	}

	add_action('premium_action_pn_lang','def_premium_action_pn_lang');
	function def_premium_action_pn_lang(){
	global $wpdb, $premiumbox;	

		only_post();
		pn_only_caps(array('administrator'));

		$form = new PremiumForm();
		$data = $form->strip_options('pn_lang_option', 'post');
				
		$old_multi = is_ml();
		$old_site_lang = get_site_lang();
		$old_admin_lang = get_locale();
		
		$lang = get_option('pn_lang');
		$lang['admin_lang'] = $admin_lang = $data['admin_lang'];
		$lang['site_lang'] = $site_lang = $data['site_lang'];
		$lang['multilingual'] = $multi = $data['multilingual'];
		$lang['multisite_lang'] = is_param_post('multisite_lang');
		update_option('pn_lang',$lang);
			
		$premiumbox->update_option('lang_redir','',$data['lang_redir']);	
			
		do_action('pn_lang_option_post', $data);
			
		do_action('change_site_lang', $old_site_lang, $site_lang, $old_multi, $multi);		
		do_action('change_admin_lang', $old_admin_lang, $admin_lang, $old_multi, $multi);			
				
		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
				
		$form->answer_form($back_url);							
	} 	

	add_action('template_redirect','lang_template_redirect');
	function lang_template_redirect(){
	global $premiumbox;
		$lang_redir = intval($premiumbox->get_option('lang_redir'));
		if($lang_redir){
			$first_redirect = intval(get_pn_cookie('first_redirect'));
			if($first_redirect != 1){
				add_pn_cookie('first_redirect', 1);
				$your_lang_arr = explode(',',is_isset($_SERVER,'HTTP_ACCEPT_LANGUAGE'));
				$your_lang = str_replace('-','_',$your_lang_arr[0]);
				$now_locale = get_locale();
				if($your_lang and $your_lang != $now_locale){
					$langs = get_langs_ml();	
					foreach($langs as $lang){
						if($lang == $your_lang){
							$url = lang_self_link($your_lang);
							wp_redirect($url);
							exit;	
						}	
					}			
				}
			}
		}
	}

}