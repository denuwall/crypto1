<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_reviews', 'pn_adminpage_title_pn_add_reviews');
function pn_adminpage_title_pn_add_reviews(){
global $bd_data, $wpdb;
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."reviews WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix.'reviews', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."reviews WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit review','pn');
	} else {
		_e('Add review','pn');
	}		
}

add_action('pn_adminpage_content_pn_add_reviews','def_pn_adminpage_content_pn_add_reviews');
function def_pn_adminpage_content_pn_add_reviews(){
global $wpdb, $bd_data;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit review','pn');
	} else {
		$title = __('Add review','pn');
	}

	$users = array();
	$users[0] = '--' . __('Guest','pn') . '--';
	$blogusers = $wpdb->get_results("SELECT ID, user_login FROM ". $wpdb->prefix ."users ORDER BY user_login ASC"); 
	foreach($blogusers as $us){
		$users[$us->ID] = is_user($us->user_login);
	}	
	
	$langs = get_langs_ml();
	$the_lang = array();
	foreach($langs as $lan){
		$the_lang[$lan] = get_title_forkey($lan);
	}
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_reviews'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_reviews'),
			'title' => __('Add new','pn')
		);	
		if(isset($bd_data->review_status) and $bd_data->review_status == 'publish'){
			$back_menu['link'] = array(
				'link' => get_review_link($data_id, $bd_data),
				'title' => __('View','pn'),
				'target' => 1,
			);	
		}		
	}	
	$form->back_menu($back_menu, $bd_data);	
	
	$options = array();
	$options['hidden_block'] = array(
		'view' => 'hidden_input',
		'name' => 'data_id',
		'default' => $data_id,
	);	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => $title,
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['review_date'] = array(
		'view' => 'datetime',
		'title' => __('Publication date','pn'),
		'default' => is_isset($bd_data, 'review_date'),
		'name' => 'review_date',
		'work' => 'datetime',
	);	
	$options['user_id'] = array(
		'view' => 'select_search',
		'title' => __('User','pn'),
		'options' => $users,
		'default' => is_isset($bd_data, 'user_id'),
		'name' => 'user_id',
		'work' => 'int',
	);	
	$options['user_name'] = array(
		'view' => 'inputbig',
		'title' => __('User name','pn'),
		'default' => is_isset($bd_data, 'user_name'),
		'name' => 'user_name',
		'work' => 'input',
	);	
	$options['user_email'] = array(
		'view' => 'inputbig',
		'title' => __('User e-mail','pn'),
		'default' => is_isset($bd_data, 'user_email'),
		'name' => 'user_email',
		'work' => 'input',
	);
	$options['user_site'] = array(
		'view' => 'inputbig',
		'title' => __('Website','pn'),
		'default' => is_isset($bd_data, 'user_site'),
		'name' => 'user_site',
		'work' => 'input',
	);	
	$options['review_text'] = array(
		'view' => 'textarea',
		'title' => __('Text','pn'),
		'default' => is_isset($bd_data, 'review_text'),
		'name' => 'review_text',
		'width' => '',
		'height' => '150px',
	);	
	$options['review_locale'] = array(
		'view' => 'select',
		'title' => __('Language','pn'),
		'options' => $the_lang,
		'default' => is_isset($bd_data, 'review_locale'),
		'name' => 'review_locale',
	);	
	$options['review_status'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('publish'=>__('published review','pn'),'moderation'=>__('review is moderating','pn')),
		'default' => is_isset($bd_data, 'review_status'),
		'name' => 'review_status',
	);	
	$params_form = array(
		'filter' => 'pn_reviews_addform',
		'data' => $bd_data,
		'method' => 'post',
	);
	$form->init_form($params_form, $options);	
	
}

add_action('premium_action_pn_add_reviews','def_premium_action_pn_add_reviews');
function def_premium_action_pn_add_reviews(){
global $wpdb;	
	
	only_post();
	pn_only_caps(array('administrator','pn_reviews'));
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id')); 
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "reviews WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['review_date'] = get_mytime(is_param_post('review_date'),'Y-m-d H:i:s');
	$array['user_id'] = intval(is_param_post('user_id'));
	$array['user_name'] = pn_strip_input(is_param_post('user_name'));
	$array['user_email'] = is_email(is_param_post('user_email'));
	$array['user_site'] = esc_url(pn_strip_input(is_param_post('user_site')));

	$array['review_text'] = pn_strip_input(is_param_post('review_text'));
			
	$array['review_locale'] = pn_strip_input(is_param_post('review_locale'));
	$array['review_status'] = pn_strip_input(is_param_post('review_status'));
			
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');				
	$array = apply_filters('pn_reviews_addform_post', $array, $last_data);
			
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_reviews_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'reviews', $array, array('id' => $data_id));
			do_action('pn_reviews_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_reviews_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'reviews', $array, array('id' => $data_id));
			if($result){
				do_action('pn_reviews_add', $data_id, $array);
			}
		}		
	}			

	$url = admin_url('admin.php?page=pn_add_reviews&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	