<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_psys', 'pn_admin_title_pn_add_psys');
function pn_admin_title_pn_add_psys(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."psys WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix.'psys', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."psys WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit payment system','pn');
	} else {
		_e('Add payment system','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_psys','def_pn_admin_content_pn_add_psys');
function def_pn_admin_content_pn_add_psys(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit payment system','pn');
	} else {
		$title = __('Add payment system','pn');
	}	

	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_psys'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_psys'),
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
	$options['psys_title'] = array(
		'view' => 'inputbig',
		'title' => __('PS title','pn'),
		'default' => is_isset($bd_data, 'psys_title'),
		'name' => 'psys_title',
		'work' => 'input',
		'ml' => 1,
	);		
	$pn_icon_size = apply_filters('pn_icon_size', '50 x 50');
	$psys_logo = @unserialize(is_isset($bd_data, 'psys_logo'));
	
	$options['psys_logo'] = array(
		'view' => 'uploader',
		'title' => __('Main logo','pn').' ('. $pn_icon_size .')',
		'default' => is_isset($psys_logo, 'logo1'),
		'name' => 'psys_logo',
		'work' => 'input',
		'ml' => 1,
	);

	$options['psys_logo_second'] = array(
		'view' => 'uploader',
		'title' => __('Additional logo','pn').' ('. $pn_icon_size .')',
		'default' => is_isset($psys_logo, 'logo2'),
		'name' => 'psys_logo_second',
		'work' => 'input',
		'ml' => 1,
	);		
	
	$params_form = array(
		'filter' => 'pn_psys_addform',
		'method' => 'post',
		'data' => $bd_data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
	
}

add_action('premium_action_pn_add_psys','def_premium_action_pn_add_psys');
function def_premium_action_pn_add_psys(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_psys'));
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id')); 
	
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "psys WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}		
	
	$array = array();
	$array['psys_title'] = $psys_title = pn_strip_input(is_param_post_ml('psys_title'));
			
	if(!$psys_title){ 
		$form->error_form(__('Error! You did not enter the name','pn'));
	}
	
	$logo1 = pn_strip_input(is_param_post_ml('psys_logo'));
	$logo2 = pn_strip_input(is_param_post_ml('psys_logo_second'));
	if(!$logo2){
		$logo2 = $logo1;
	}
	$psys_logo = array(
		'logo1' => $logo1,
		'logo2' => $logo2,
	);
	$array['psys_logo'] = @serialize($psys_logo);
		
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');	
	$array = apply_filters('pn_psys_addform_post',$array, $last_data);
			
	$count_psys = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."psys WHERE psys_title='$psys_title' AND id != '$data_id'");
	if($count_psys > 0){
		$form->error_form(__('Error! This currency code already exists','pn'));
	}
	
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_psys_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'psys', $array, array('id' => $data_id));
			do_action('pn_psys_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_psys_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'psys', $array, array('id' => $data_id));
			if($result){
				do_action('pn_psys_add', $data_id, $array);
			}
		}
	}

	$url = admin_url('admin.php?page=pn_add_psys&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	