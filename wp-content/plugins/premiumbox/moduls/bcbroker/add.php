<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_bc_add_adjs', 'pn_admin_title_pn_bc_add_adjs');
function pn_admin_title_pn_bc_add_adjs(){
	$id = intval(is_param_get('item_id'));
	if($id){
		_e('Edit adjustment','pn');
	} else {
		_e('Add adjustment','pn');
	}
}

add_action('pn_adminpage_content_pn_bc_add_adjs','def_pn_admin_content_pn_bc_add_adjs');
function def_pn_admin_content_pn_bc_add_adjs(){
global $wpdb;

	$form = new PremiumForm();

	$id = intval(is_param_get('item_id'));
	$data_id = 0;
	$data = '';
	
	if($id){
		$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE id='$id'");
		if(isset($data->id)){
			$data_id = $data->id;
		}	
	}

	if($data_id){
		$title = __('Edit adjustment','pn');
	} else {
		$title = __('Add adjustment','pn');
	}
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_bc_adjs'),
		'title' => __('Back to list','pn')
	);
	if($data_id){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_bc_adjs'),
			'title' => __('Add new','pn')
		);	
	}
	$form->back_menu($back_menu, $data);

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
	$direction_id = intval(is_isset($data, 'direction_id'));

	if($direction_id){
		$dir_row = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$direction_id'");
		if(isset($dir_row->id)){
			$options['course'] = array(
				'view' => 'textfield',
				'title' => __('Exchange rate','pn'),
				'default' => is_sum($dir_row->course_give) . '&rarr;' . is_sum($dir_row->course_get),
			);	
		}
	}
	
	$opts = array();
	$opts[0] = '--'. __('No item','pn') . '--';
	$directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND direction_status='1' ORDER BY site_order1 ASC");
	foreach($directions as $direction){ 
		$opts[$direction->id]= pn_strip_input($direction->tech_name);
	}
	$options['direction_id'] = array(
		'view' => 'select',
		'title' => __('Exchange direction','pn'),
		'options' => $opts,
		'default' => $direction_id,
		'name' => 'direction_id',
	);	
	$options['line0'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$alls = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes ORDER BY currency_code_title ASC");
	$vs[0] = '--'. __('No item','pn') .'--';
	foreach($alls as $all){
		$vs[$all->currency_code_id] = pn_strip_input($all->currency_code_title);
	}
	$options['v1'] = array(
		'view' => 'select',
		'title' => __('Send','pn'),
		'options' => $vs,
		'default' => is_isset($data, 'v1'),
		'name' => 'v1',
	);	
	$options['v2'] = array(
		'view' => 'select',
		'title' => __('Receive','pn'),
		'options' => $vs,
		'default' => is_isset($data, 'v2'),
		'name' => 'v2',
	);		
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['name_column'] = array(
		'view' => 'select',
		'title' => __('Correct rate','pn'),
		'options' => array('0'=> __('Send','pn'), '1'=> __('Receive','pn')),
		'default' => is_isset($data, 'name_column'),
		'name' => 'name_column',
	);	
	$options['now_sort'] = array(
		'view' => 'select',
		'title' => __('Sort rate by','pn'),
		'options' => array('0'=> __('descending','pn'), '1'=> __('ascending','pn')),
		'default' => is_isset($data, 'now_sort'),
		'name' => 'now_sort',
	);	
	$options['line2'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['pars_position'] = array(
		'view' => 'inputbig',
		'title' => __('Position','pn'),
		'default' => is_isset($data, 'pars_position'),
		'name' => 'pars_position',
	);
	$options['min_res'] = array(
		'view' => 'inputbig',
		'title' => __('Min reserve for position','pn'),
		'default' => is_isset($data, 'min_res'),
		'name' => 'min_res',
	);
	$options['step'] = array(
		'view' => 'inputbig',
		'title' => __('Step','pn'),
		'default' => is_isset($data, 'step'),
		'name' => 'step',
	);
	$options['min_sum'] = array(
		'view' => 'inputbig',
		'title' => __('Min rate','pn'),
		'default' => is_isset($data, 'min_sum'),
		'name' => 'min_sum',
	);
	$options['max_sum'] = array(
		'view' => 'inputbig',
		'title' => __('Max rate','pn'),
		'default' => is_isset($data, 'max_sum'),
		'name' => 'max_sum',
	);
	$options['line3'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['reset_course'] = array(
		'view' => 'select',
		'title' => __('Reset to standard rate','pn'),
		'options' => array('0'=> __('Yes','pn'), '1'=> __('No','pn')),
		'default' => is_isset($data, 'reset_course'),
		'name' => 'reset_course',
	);	
	$options['standart_course_give'] = array(
		'view' => 'inputbig',
		'title' => __('Standart rate Send','pn'),
		'default' => is_isset($data, 'standart_course_give'),
		'name' => 'standart_course_give',
	);
	$options['standart_course_get'] = array(
		'view' => 'inputbig',
		'title' => __('Standart rate Receive','pn'),
		'default' => is_isset($data, 'standart_course_get'),
		'name' => 'standart_course_get',
	);	
	$options['line4'] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	$options['status'] = array(
		'view' => 'select',
		'title' => __('Enable parser','pn'),
		'options' => array('1'=>__('Yes','pn'),'0'=>__('No','pn')),
		'default' => is_isset($data, 'status'),
		'name' => 'status',
	);	

	$params_form = array(
		'filter' => 'pn_bcadjs_addform',
		'method' => 'post',
		'data' => $data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
} 

add_action('premium_action_pn_bc_add_adjs','def_premium_action_pn_bc_add_adjs');
function def_premium_action_pn_bc_add_adjs(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();

	$data_id = intval(is_param_post('data_id')); 
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "bcbroker_directions WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['status'] = intval(is_param_post('status'));
	$direction_id = intval(is_param_post('direction_id'));
	$array['direction_id'] = 0;
	$array['currency_id_give'] = 0;
	$array['currency_id_get'] = 0;
	$direction = '';
	if($direction_id){
		$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND direction_status='1' AND id = '$direction_id'");
		if(isset($direction->id)){
			$array['direction_id'] = $direction->id;
			$array['currency_id_give'] = $direction->currency_id_give;
			$array['currency_id_get'] = $direction->currency_id_get;			
		} else {
			$direction_id = 0;
		}
	}
	if(!$direction_id){
		$form->error_form(__('Error! You have not specified the exchange direction','pn'));
	}
	$id_v1 = intval(is_param_post('v1'));
	$id_v2 = intval(is_param_post('v2'));
	$array['v1'] = $id_v1;
	$array['v2'] = $id_v2;
	
	$v1 = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes WHERE currency_code_id='$id_v1'");
	$v2 = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes WHERE currency_code_id='$id_v2'");
	if(!isset($v1->id) or !isset($v2->id)){
		$form->error_form(__('Error! You have not specified the Send or Receive value','pn'));
	}
	
	$array['name_column'] = intval(is_param_post('name_column'));
	$array['now_sort'] = intval(is_param_post('now_sort'));
	$array['pars_position'] = intval(is_param_post('pars_position'));
	$array['min_res'] = is_sum(is_param_post('min_res'));
	$array['step'] = pn_strip_input(is_param_post('step'));
	$array['min_sum'] = is_sum(is_param_post('min_sum'));
	$array['max_sum'] = is_sum(is_param_post('max_sum'));
	$array['reset_course'] = intval(is_param_post('reset_course'));
	$array['standart_course_give'] = is_sum(is_param_post('standart_course_give'));
	$array['standart_course_get'] = is_sum(is_param_post('standart_course_get'));
	$array = apply_filters('pn_bcadjs_addform_post',$array, $last_data);		
			
	if($data_id){	
		do_action('pn_bcadjs_edit_before', $data_id, $array, $last_data, $direction_id, $direction);
		$wpdb->update($wpdb->prefix.'bcbroker_directions', $array, array('id'=>$data_id));
		do_action('pn_bcadjs_edit', $data_id, $array, $last_data, $direction_id, $direction);	
	} else {
		$wpdb->insert($wpdb->prefix.'bcbroker_directions', $array);
		$data_id = $wpdb->insert_id;	
		do_action('pn_bcadjs_add', $data_id, $array, $direction_id, $direction);	
	}

	$url = admin_url('admin.php?page=pn_bc_add_adjs&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	