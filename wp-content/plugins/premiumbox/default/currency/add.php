<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_currency', 'pn_adminpage_title_pn_add_currency');
function pn_adminpage_title_pn_add_currency(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix . 'currency', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit currency','pn');
	} else {
		_e('Add currency','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_currency','def_pn_admin_content_pn_add_currency');
function def_pn_admin_content_pn_add_currency(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit currency','pn');
	} else {
		$title = __('Add currency','pn');
	}	

	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_currency'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_currency'),
			'title' => __('Add new','pn')
		);	
	}
	$form->back_menu($back_menu, $bd_data);
	
	$psys = apply_filters('list_psys_manage', array(), __('No item','pn'));	

	$currency_codes = apply_filters('list_currency_codes_manage', array(), __('No item','pn'));
	
	$rplaced = array();
	$rplaced[0] = '--'. __('calculate according to orders','pn') .'--';
	$rplaced = apply_filters('reserv_place_list', $rplaced, 'currency');
	$rplaced = (array)$rplaced;

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
	$options['currency_status'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('1'=>__('Active currency','pn'),'0'=>__('Inactive currency','pn')),
		'default' => is_isset($bd_data, 'currency_status'),
		'name' => 'currency_status',
	);
	$options['line0'] = array(
		'view' => 'line',
		'colspan' => 2,
	);		
	$options['psys_id'] = array(
		'view' => 'select',
		'title' => __('PS title','pn'),
		'options' => $psys,
		'default' => is_isset($bd_data, 'psys_id'),
		'name' => 'psys_id',
	);	
	$options['currency_code_id'] = array(
		'view' => 'select',
		'title' => __('Currency code','pn'),
		'options' => $currency_codes,
		'default' => is_isset($bd_data, 'currency_code_id'),
		'name' => 'currency_code_id',
	);	
	$pn_icon_size = apply_filters('pn_icon_size','50 x 50');
	$currency_logo = @unserialize(is_isset($bd_data, 'currency_logo'));
	$options['currency_logo'] = array(
		'view' => 'uploader',
		'title' => __('Main logo','pn').' ('. $pn_icon_size .')',
		'default' => is_isset($currency_logo, 'logo1'),
		'name' => 'currency_logo',
		'ml' => 1,
	);
	$options['currency_logo_second'] = array(
		'view' => 'uploader',
		'title' => __('Additional logo','pn').' ('. $pn_icon_size .')',
		'default' => is_isset($currency_logo, 'logo2'),
		'name' => 'currency_logo_second',
		'ml' => 1,
	);	
	
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['xml_value'] = array(
		'view' => 'input',
		'title' => __('XML name','pn'),
		'default' => is_isset($bd_data, 'xml_value'),
		'name' => 'xml_value',
	);	
	$options['xml_value_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => sprintf(__('Allowed symbols: a-z, A-Z, 0-9, min.: %1$s , max.: %2$s symbols','pn'), 3, 30),
	);
	$options['xml_value_warning'] = array(
		'view' => 'warning',
		'title' => __('More info','pn'),
		'default' => sprintf(__('Enter the name (according to the standard): <a href="%s">Jsons.info</a>.','pn'), 'http://jsons.info/references/signatures/currencies'),
	);	
	$options['line2'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['currency_decimal'] = array(
		'view' => 'input',
		'title' => __('Amount of Decimal places','pn'),
		'default' => is_isset($bd_data, 'currency_decimal'),
		'name' => 'currency_decimal',
	);
	$options['line3'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['reserv_place'] = array(
		'view' => 'select',
		'title' => __('Currency reserve','pn'),
		'options' => $rplaced,
		'default' => is_isset($bd_data, 'reserv_place'),
		'name' => 'reserv_place',
	);		
	$options['center_title'] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['txt_give'] = array(
		'view' => 'inputbig',
		'title' => __('Field title "From Account"','pn'),
		'default' => is_isset($bd_data, 'txt_give'),
		'name' => 'txt_give',
		'ml' => 1,
	);
	$options['show_give'] = array(
		'view' => 'select',
		'title' => __('Show field "From Account"','pn'),
		'options' => array('1'=>__('Yes','pn'),'0'=>__('No','pn')),
		'default' => is_isset($bd_data, 'show_give'),
		'name' => 'show_give',
	);	
	$options['helps_give'] = array(
		'view' => 'textarea',
		'title' => __('Tip for field "From Account"','pn'),
		'default' => is_isset($bd_data, 'helps_give'),
		'name' => 'helps_give',
		'width' => '',
		'height' => '100px',
		'ml' => 1,
	);	
	$options['txt_get'] = array(
		'view' => 'inputbig',
		'title' => __('Field title "Onto Account"','pn'),
		'default' => is_isset($bd_data, 'txt_get'),
		'name' => 'txt_get',
		'ml' => 1,
	);
	$options['show_get'] = array(
		'view' => 'select',
		'title' => __('Show filed "Onto Account"','pn'),
		'options' => array('1'=>__('Yes','pn'),'0'=>__('No','pn')),
		'default' => is_isset($bd_data, 'show_get'),
		'name' => 'show_get',
	);
	$options['helps_get'] = array(
		'view' => 'textarea',
		'title' => __('Tip for field "Onto Account"','pn'),
		'default' => is_isset($bd_data, 'helps_get'),
		'name' => 'helps_get',
		'width' => '',
		'height' => '100px',
		'ml' => 1,
	);	
	if(is_enable_check_purse()){
		$wchecks = array();
		$wchecks[0] = '--'. __('No item','pn') .'--';
		$list_wchecks = apply_filters('list_wchecks', array());
		$list_wchecks = (array)$list_wchecks;
		foreach($list_wchecks as $val){
			$wchecks[is_isset($val,'id')] = is_isset($val,'title');
		}	
		
		$options['line4'] = array(
			'view' => 'line',
			'colspan' => 2,
		);
		$options['check_purse'] = array(
			'view' => 'select',
			'title' => __('Checking account for verification in PS','pn'),
			'options' => $wchecks,
			'default' => is_isset($bd_data, 'check_purse'),
			'name' => 'check_purse',
		);
		$options['check_text'] = array(
			'view' => 'inputbig',
			'title' => __('Text indicating the verified wallet','pn'),
			'default' => is_isset($bd_data, 'check_text'),
			'name' => 'check_text',
			'work' => 'input',
			'ml' => 1,
		);		
	}		
	$options['line7'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['center_title2'] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['minzn'] = array(
		'view' => 'input',
		'title' => __('Min. number of symbols','pn'),
		'default' => is_isset($bd_data, 'minzn'),
		'name' => 'minzn',
	);
	$options['maxzn'] = array(
		'view' => 'input',
		'title' => __('Max. number of symbols','pn'),
		'default' => is_isset($bd_data, 'maxzn'),
		'name' => 'maxzn',
	);
	$options['firstzn'] = array(
		'view' => 'input',
		'title' => __('First symbols','pn'),
		'default' => is_isset($bd_data, 'firstzn'),
		'name' => 'firstzn',
	);
	$options['firstzn_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Checking the first symbols when client enters own account. For example, the first symbol of WebMoney Z wallet is set as Z.','pn'),
	);	
	$options['cifrzn'] = array(
		'view' => 'select',
		'title' => __('Allowed symbols','pn'),
		'options' => array('0'=>__('Numbers and latin letters','pn'),'1'=>__('Numbers','pn'),'2'=>__('Latin letters','pn'),'3'=>__('E-mail','pn'),'5'=>__('Phone number','pn'),'4'=>__('Any symbols','pn')),
		'default' => is_isset($bd_data, 'cifrzn'),
		'name' => 'cifrzn',
	);
	$options['backspace'] = array(
		'view' => 'select',
		'title' => __('Remove spaces in details','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => is_isset($bd_data, 'backspace'),
		'name' => 'backspace',
	);	
	$options['vidzn'] = array(
		'view' => 'select',
		'title' => __('Account type','pn'),
		'options' => array('0'=>__('Account','pn'),'1'=>__('Bank card','pn'),'2'=>__('Phone number','pn')),
		'default' => is_isset($bd_data, 'vidzn'),
		'name' => 'vidzn',
	);	
	$options['line8'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['valut_warning'] = array(
		'view' => 'warning',
		'title' => __('More info','pn'),
		'default' => sprintf(__('Caution! After adding currency it is necessary to set <a href="%s">reserve</a>.','pn'), admin_url('admin.php?page=pn_reserv')),
	);	
	
	$params_form = array(
		'filter' => 'pn_currency_addform',
		'method' => 'post',
		'data' => $bd_data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
	
} 

add_action('premium_action_pn_add_currency','def_premium_action_pn_add_currency');
function def_premium_action_pn_add_currency(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_currency'));

	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id'));
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();		
	$array['currency_decimal'] = intval(is_param_post('currency_decimal'));
	if($array['currency_decimal'] < 0){ $array['currency_decimal'] = 8; }						
			
	$array['reserv_place'] = is_extension_name(is_param_post('reserv_place'));

	$array['currency_status'] = intval(is_param_post('currency_status'));
			
	$array['currency_code_id'] = 0;
	$array['currency_code_title'] = '';
			
	$currency_code_id = intval(is_param_post('currency_code_id'));
	if($currency_code_id){
		$currency_code_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency_codes WHERE id='$currency_code_id'");
		if(isset($currency_code_data->id)){
			$array['currency_code_id'] = $currency_code_data->id;
			$array['currency_code_title'] = is_site_value($currency_code_data->currency_code_title);
		}
	} else {
		$form->error_form(__('Error! You did not choose the currency code','pn'));
	}
		
	$logo1 = pn_strip_input(is_param_post_ml('currency_logo'));
	$logo2 = pn_strip_input(is_param_post_ml('currency_logo_second'));
	if(!$logo2){
		$logo2 = $logo1;
	}
	$currency_logo = array(
		'logo1' => $logo1,
		'logo2' => $logo2,
	);
	$array['currency_logo'] = @serialize($currency_logo);
	
	$array['psys_id'] = 0;
	$array['psys_title'] = '';
	$array['psys_logo'] = '';
			
	$psys_id = intval(is_param_post('psys_id'));
	if($psys_id){
		$psys_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."psys WHERE id='$psys_id'");
		if(isset($psys_data->id)){
			$array['psys_id'] = $psys_data->id;
			$array['psys_title'] = pn_strip_input($psys_data->psys_title);
			$array['psys_logo'] = $psys_data->psys_logo; 
		}
	} else {
		$form->error_form(__('Error! You did not choose the payment system','pn'));
	} 

	$xml_value = is_xml_value(is_param_post('xml_value'));
	if(!$xml_value){
		$xml_value = pn_strip_symbols(replace_cyr(ctv_ml($array['psys_title'])));
		$xml_value = unique_xml_value($xml_value, $data_id);
	}
			
	$array['xml_value'] = $xml_value;
			
	$array['helps_give'] = pn_strip_input(is_param_post_ml('helps_give'));
	$array['helps_get'] = pn_strip_input(is_param_post_ml('helps_get'));
	$array['show_give'] = intval(is_param_post('show_give'));
	$array['show_get'] = intval(is_param_post('show_get'));
	$array['txt_give'] = pn_strip_input(is_param_post_ml('txt_give'));
	$array['txt_get'] = pn_strip_input(is_param_post_ml('txt_get'));
			
	$array['minzn'] = intval(is_param_post('minzn'));
	$array['maxzn'] = intval(is_param_post('maxzn'));
	$array['firstzn'] = is_firstzn_value(is_param_post('firstzn'));
	$array['cifrzn'] = intval(is_param_post('cifrzn'));
	$array['backspace'] = intval(is_param_post('backspace'));
	$array['vidzn'] = intval(is_param_post('vidzn'));

	if(is_enable_check_purse()){
		$array['check_text'] = pn_strip_input(is_param_post_ml('check_text'));
		$array['check_purse'] = is_extension_name(is_param_post('check_purse'));		
	}	
	
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');	
	$array = apply_filters('pn_currency_addform_post', $array, $last_data);		
		
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){			
			do_action('pn_currency_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'currency', $array, array('id' => $data_id));
			do_action('pn_currency_edit', $data_id, $array, $last_data);			
			if($result){
				do_action('pn_currency_edit_after', $data_id, $array, $last_data);
			}
		} else {			
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'currency', $array, array('id' => $data_id));
			if($result){
				do_action('pn_currency_add', $data_id, $array);
			}
		}
	}

	$url = admin_url('admin.php?page=pn_add_currency&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	