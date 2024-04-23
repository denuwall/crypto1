<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_partners', 'pn_adminpage_title_pn_add_partners');
function pn_adminpage_title_pn_add_partners(){
global $bd_data, $wpdb;
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."partners WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix.'partners', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."partners WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit partners','pn');
	} else {
		_e('Add partners','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_partners','def_pn_adminpage_content_pn_add_partners');
function def_pn_adminpage_content_pn_add_partners(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit partners','pn');
	} else {
		$title = __('Add partners','pn');
	}

	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_partners'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_partners'),
			'title' => __('Add new','pn')
		);	
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
	$options['title'] = array(
		'view' => 'inputbig',
		'title' => __('Title','pn'),
		'default' => is_isset($bd_data, 'title'),
		'name' => 'title',
		'work' => 'input',
		'ml' => 1,
	);	
	$options['link'] = array(
		'view' => 'inputbig',
		'title' => __('Link','pn'),
		'default' => is_isset($bd_data, 'link'),
		'name' => 'link',
		'work' => 'input',
	);	
	$options['img'] = array(
		'view' => 'uploader',
		'title' => __('Logo', 'pn'),
		'default' => is_isset($bd_data, 'img'),
		'name' => 'img',
		'work' => 'input',
	);
	$options['status'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('1'=>__('published','pn'),'0'=>__('moderating','pn')),
		'default' => is_isset($bd_data, 'status'),
		'name' => 'status',
		'work' => 'int',
	);		
	
	$params_form = array(
		'filter' => 'pn_partners_addform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
			
}

add_action('premium_action_pn_add_partners','def_premium_action_pn_add_partners');
function def_premium_action_pn_add_partners(){
global $wpdb;

	only_post();
	pn_only_caps(array('administrator'));
		
	$data_id = intval(is_param_post('data_id'));
	
	$form = new PremiumForm();
	
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "partners WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}		
	
	$array = array();
	$array['title'] = pn_strip_input(is_param_post_ml('title'));
	$array['link'] = esc_url(pn_strip_input(is_param_post('link')));
	$array['img'] = pn_strip_input(is_param_post('img'));
	$array['status'] = intval(is_param_post('status'));

	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');	
	$array = apply_filters('pn_partners_addform_post',$array, $last_data);
			
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_partners_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'partners', $array, array('id' => $data_id));
			do_action('pn_partners_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_partners_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'partners', $array, array('id' => $data_id));
			if($result){
				do_action('pn_partners_add', $data_id, $array);
			}
		}		
	}

	$url = admin_url('admin.php?page=pn_add_partners&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	