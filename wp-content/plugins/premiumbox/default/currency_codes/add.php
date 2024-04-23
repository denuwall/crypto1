<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_currency_codes', 'pn_adminpage_title_pn_add_currency_codes');
function pn_adminpage_title_pn_add_currency_codes(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency_codes WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix . 'currency_codes', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_codes WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit currency code','pn');
	} else {
		_e('Add currency code','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_currency_codes','def_pn_admin_content_pn_add_currency_codes');
function def_pn_admin_content_pn_add_currency_codes(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit currency code','pn');
	} else {
		$title = __('Add currency code','pn');
	}	

	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_currency_codes'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_currency_codes'),
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
	$options['currency_code_title'] = array(
		'view' => 'input',
		'title' => __('Currency code','pn'),
		'default' => is_isset($bd_data, 'currency_code_title'),
		'name' => 'currency_code_title',
	);		
	$options['internal_rate'] = array(
		'view' => 'input',
		'title' => __('Internal rate per','pn'). ' 1 '. cur_type() .'',
		'default' => is_isset($bd_data, 'internal_rate'),
		'name' => 'internal_rate',
	);		

	$params_form = array(
		'filter' => 'pn_currency_code_addform',
		'method' => 'post',
		'data' => $bd_data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
					
}

add_action('premium_action_pn_add_currency_codes','def_premium_action_pn_add_currency_codes');
function def_premium_action_pn_add_currency_codes(){
global $wpdb;

	only_post();
	pn_only_caps(array('administrator','pn_currency_codes'));		
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id')); 
	
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_codes WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}		
		
	$array = array();
	$array['currency_code_title'] = $currency_code_title = is_site_value(is_param_post('currency_code_title'));
	if(!$currency_code_title){ $form->error_form(__('Error! You did not enter the name','pn')); }

	$array['internal_rate'] = is_sum(is_param_post('internal_rate'));
	if($array['internal_rate'] <= 0){ $array['internal_rate'] = 1; }
		
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');		
	$array = apply_filters('pn_currency_code_addform_post',$array, $last_data);
			
	$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_codes WHERE currency_code_title='$currency_code_title' AND id != '$data_id'");
	if($cc > 0){
		$form->error_form(__('Error! This currency code already exists','pn'));
	}
		
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_currency_code_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'currency_codes', $array, array('id' => $data_id));
			do_action('pn_currency_code_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_currency_code_edit_after', $data_id, $array, $last_data);
				do_action('currency_code_change_course', $data_id, $last_data, is_isset($array,'internal_rate'), 'edit_currency_code');
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'currency_codes', $array, array('id' => $data_id));
			if($result){
				do_action('pn_currency_code_add', $data_id, $array);
			}
		}
	}

	$url = admin_url('admin.php?page=pn_add_currency_codes&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	