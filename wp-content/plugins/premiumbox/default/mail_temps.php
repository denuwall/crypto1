<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('def_pn_adminpage_title_pn_mail_temps')){
	add_action('pn_adminpage_title_pn_mail_temps', 'def_pn_adminpage_title_pn_mail_temps');
	function def_pn_adminpage_title_pn_mail_temps(){
		_e('E-mail templates','pn');
	}
}

if(!function_exists('def_pn_adminpage_content_pn_mail_temps')){
	add_action('pn_adminpage_content_pn_mail_temps','def_pn_adminpage_content_pn_mail_temps');
	function def_pn_adminpage_content_pn_mail_temps(){
	global $wpdb;
			
		$place = pn_strip_input(is_param_get('place'));	
			
		$form = new PremiumForm();	
			
		$selects = array();
		$selects[] = array(
			'link' => admin_url("admin.php?page=pn_mail_temps"),
			'title' => '--' . __('Make a choice','pn') . '--',
			'background' => '',
			'default' => '',
		);			
	 
		$places_admin = apply_filters('list_admin_notify',array());
		$places_admin = (array)$places_admin;
		$places_admin_t = array();
				
		if(count($places_admin) > 0){
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_mail_temps&place=admin_notify"),
				'title' => '---' . __('Admin notification','pn'),
				'background' => '#faf9c4',
				'default' => 'admin_notify',
			);				
		}
				
		foreach($places_admin as $key => $val){
			$places_admin_t[] = $key;
					
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_mail_temps&place=".$key),
				'title' => $val,
				'background' => '',
				'default' => $key,
			);				
		}		
				
		$places_user = apply_filters('list_user_notify',array());
		$places_user = (array)$places_user;
		$places_user_t = array();
				
		if(count($places_user) > 0){
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_mail_temps&place=user_notify"),
				'title' => '---' . __('Users notification','pn'),
				'background' => '#faf9c4',
				'default' => 'user_notify',
			);					
		}			
				
		foreach($places_user as $key => $val){
			$places_user_t[] = $key;
					
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_mail_temps&place=".$key),
				'title' => $val,
				'background' => '',
				'default' => $key,
			);				
		}
				
		$form->select_box($place, $selects, __('Setting up','pn'));

		if(in_array($place,$places_admin_t) or in_array($place,$places_user_t)){
			
			$pn_notify = get_option('pn_notify');
			$pn_notify_email = is_isset($pn_notify, 'email');
			
			$data = is_isset($pn_notify_email, $place);		
			
			$options = array();
			$options['top_title'] = array(
				'view' => 'h3',
				'title' => __('E-mail templates','pn'),
				'submit' => __('Save','pn'),
				'colspan' => 2,
			);
			$options['hidden_block'] = array(
				'view' => 'hidden_input',
				'name' => 'block',
				'default' => $place,
			);				
			$options['send'] = array(
				'view' => 'select',
				'title' => __('To send','pn'),
				'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
				'default' => is_isset($data, 'send'),
				'name' => 'send',
				'work' => 'int',
			);		
			$options['title'] = array(
				'view' => 'inputbig',
				'title' => __('Subject of an e-mail','pn'),
				'default' => is_isset($data, 'title'),
				'name' => 'title',
				'work' => 'input',
				'ml' => 1,
			);
			$options['mail'] = array(
				'view' => 'inputbig',
				'title' => __('Senders e-mail','pn'),
				'default' => is_isset($data, 'mail'),
				'name' => 'mail',
				'work' => 'input',
			);	
			$options['mail_warning'] = array(
				'view' => 'warning',
				'default' => __('Use only existing e-mail address (for example - info@site.ru)','pn'),
			);		
			$options['name'] = array(
				'view' => 'inputbig',
				'title' => __('Sender name','pn'),
				'default' => is_isset($data, 'name'),
				'name' => 'name',
				'work' => 'input',
			);	

			if(in_array($place,$places_admin_t)){
				$options['tomail'] = array(
					'view' => 'inputbig',
					'title' => __('Administrator e-mail','pn'),
					'default' => is_isset($data, 'tomail'),
					'name' => 'tomail',
					'work' => 'input',
				);					
				$options['tomailhelp'] = array(
					'view' => 'help',
					'title' => __('More info','pn'),
					'default' => __('If the recipient has several e-mail address, e-mail address should be comma-separated','pn'),
				);					
			}
					
			$tags = array(
				'sitename' => __('Website name','pn'),
			);
			$tags = apply_filters('list_notify_tags_'.$place, $tags);
					
			$options['text'] = array(
				'view' => 'textareatags',
				'title' => __('E-mail text','pn'),
				'default' => is_isset($data, 'text'),
				'tags' => $tags,
				'width' => '',
				'height' => '300px',
				'prefix1' => '[',
				'prefix2' => ']',
				'name' => 'text',
				'work' => 'text',
				'ml' => 1,
			);				
				
			$params_form = array(
				'filter' => 'pn_mail_temps_option',
				'method' => 'post',
				'button_title' => __('Save','pn'),
			);
			$form->init_form($params_form, $options); 		
			
		} else {

			$options = array();
			$options['top_title'] = array(
				'view' => 'h3',
				'title' => __('Send test e-mail','pn'),
				'submit' => __('Send a message','pn'),
				'colspan' => 2,
			);
			$options['to'] = array(
				'view' => 'inputbig',
				'title' => __('Your e-mail','pn'),
				'default' => '',
				'name' => 'to',
				'work' => 'email',
				'not_auto' => 1,
			);		
			
			$params_form = array(
				'filter' => '',
				'method' => 'ajax',
				'data' => '',
				'form_link' => pn_link_post('pn_mails_send_test'),
				'button_title' => __('Send a message','pn'),
			);
			$form->init_form($params_form, $options);				
		
		}
		
	}
}

if(!function_exists('def_premium_action_pn_mails_send_test')){
	add_action('premium_action_pn_mails_send_test','def_premium_action_pn_mails_send_test');
	function def_premium_action_pn_mails_send_test(){
	global $wpdb;	

		only_post();
		pn_only_caps(array('administrator','pn_change_notify'));

		$form = new PremiumForm();
		
			$to = is_email(is_param_post('to'));
			if(!$to){
				$form->error_form(__('Error! You have not entered an e-mail!','pn'));
			} else {
				wp_mail($to, 'Test MAIL send', 'Test MAIL send content');			
			}

		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
		
		$form->answer_form($back_url);
		
	}
}

if(!function_exists('def_premium_action_pn_mail_temps')){
	add_action('premium_action_pn_mail_temps','def_premium_action_pn_mail_temps');
	function def_premium_action_pn_mail_temps(){
	global $wpdb;

		only_post();
		pn_only_caps(array('administrator','pn_change_notify'));
		
		$block = pn_strip_input(is_param_post('block'));
				
		$form = new PremiumForm();
		
		if($block){
			$pn_notify = get_option('pn_notify');
			if(!is_array($pn_notify)){ $pn_notify = array(); }

				$pn_notify['email'][$block]['send'] = intval(is_param_post('send'));
				$pn_notify['email'][$block]['title'] = pn_strip_input(is_param_post_ml('title'));
				$pn_notify['email'][$block]['mail'] = trim(is_param_post('mail'));
				$pn_notify['email'][$block]['tomail'] = trim(is_param_post('tomail'));
				$pn_notify['email'][$block]['name'] = pn_strip_input(is_param_post('name'));
				$pn_notify['email'][$block]['text'] = pn_strip_text(is_param_post_ml('text'));

			update_option('pn_notify', $pn_notify);
		}			

		do_action('pn_mail_temps_option_post');

		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
				
		$form->answer_form($back_url); 
	}
}	