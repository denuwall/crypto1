<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_currency_reserv', 'pn_admin_title_pn_add_currency_reserv');
function pn_admin_title_pn_add_currency_reserv(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency_reserv WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix . 'currency_reserv', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_reserv WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit reserve transaction','pn');
	} else {
		_e('Add reserve transaction','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_currency_reserv','def_pn_admin_content_pn_add_currency_reserv');
function def_pn_admin_content_pn_add_currency_reserv(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit reserve transaction','pn');
	} else {
		$title = __('Add reserve transaction','pn');
	}	

	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_currency_reserv'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_currency_reserv'),
			'title' => __('Add new','pn')
		);	
	}
	$form->back_menu($back_menu, $bd_data);

	$currencies = apply_filters('list_currency_manage', array(), __('No item','pn'));	

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
	$options['trans_title'] = array(
		'view' => 'inputbig',
		'title' => __('Comment','pn'),
		'default' => is_isset($bd_data, 'trans_title'),
		'name' => 'trans_title',
	);
	$options['trans_sum'] = array(
		'view' => 'inputbig',
		'title' => __('Amount','pn'),
		'default' => is_isset($bd_data, 'trans_sum'),
		'name' => 'trans_sum',
	);
	$options['currency_id'] = array(
		'view' => 'select',
		'title' => __('Currency name','pn'),
		'options' => $currencies,
		'default' => is_isset($bd_data, 'currency_id'),
		'name' => 'currency_id',
	);
	
	$params_form = array(
		'filter' => 'pn_currency_reserv_addform',
		'method' => 'post',
		'data' => $bd_data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);		
} 

add_action('premium_action_pn_add_currency_reserv','def_premium_action_pn_add_currency_reserv');
function def_premium_action_pn_add_currency_reserv(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_currency_reserv'));

	$form = new PremiumForm();
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$data_id = intval(is_param_post('data_id')); 
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_reserv WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
			
	$array['trans_title'] = pn_strip_input(is_param_post('trans_title'));
	$array['trans_sum'] = is_sum(is_param_post('trans_sum'));

	$array['currency_id'] = 0;
	$array['currency_code_id'] = 0;
	$array['currency_code_title'] = '';
			
	$currency_id = intval(is_param_post('currency_id'));
	if($currency_id){
		$currency_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND id='$currency_id'");
		if(isset($currency_data->id)){
			$array['currency_id'] = $currency_data->id;
			$array['currency_code_id'] = $currency_data->currency_code_id;
			$array['currency_code_title'] = is_site_value($currency_data->currency_code_title);	
		}	
	} else {
		$form->error_form(__('Error! You did not choose currency','pn'));
	}

	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');
	$array = apply_filters('pn_currency_reserv_addform_post',$array, $last_data);
	
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			$array['user_editor'] = intval($user_id);
			do_action('pn_currency_reserv_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix . 'currency_reserv', $array, array('id' => $data_id));
			do_action('pn_currency_reserv_edit', $data_id, $array, $last_data);
			if($result){
				$update = 1;
				
				if(isset($last_data->currency_id)){
					update_currency_reserv($last_data->currency_id);
							
					if($last_data->currency_id == $array['currency_id']){
						$update = 0;
					}
				}						
				
				if($update == 1){
					update_currency_reserv($array['currency_id']);
				}				
				do_action('pn_currency_reserv_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['user_creator'] = intval($user_id);
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix . 'currency_reserv', $array, array('id' => $data_id));
			if($result){
				update_currency_reserv($array['currency_id']);
				do_action('pn_currency_reserv_add', $data_id, $array);
			}
		}
	}	

	$url = admin_url('admin.php?page=pn_add_currency_reserv&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	