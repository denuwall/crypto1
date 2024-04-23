<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_cfc', 'pn_admin_title_pn_add_cfc');
function pn_admin_title_pn_add_cfc(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency_custom_fields WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix . 'currency_custom_fields', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_custom_fields WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit custom field','pn');
	} else {
		_e('Add custom field','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_cfc','def_pn_admin_content_pn_add_cfc');
function def_pn_admin_content_pn_add_cfc(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit custom field','pn');
	} else {
		$title = __('Add custom field','pn');
	}
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_cfc'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_cfc'),
			'title' => __('Add new','pn')
		);	
	}
	$form->back_menu($back_menu, $bd_data);	
	
	$currency = apply_filters('list_currency_manage', array(), __('No item','pn'));	

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
	$options['tech_name'] = array(
		'view' => 'inputbig',
		'title' => __('Custom field name (technical)','pn'),
		'default' => is_isset($bd_data, 'tech_name'),
		'name' => 'tech_name',
		'ml' => 1,
	);		
	$options['cf_name'] = array(
		'view' => 'inputbig',
		'title' => __('Custom field name','pn'),
		'default' => is_isset($bd_data, 'cf_name'),
		'name' => 'cf_name',
		'work' => 'input',
		'ml' => 1,
	);
	$options['uniqueid'] = array(
		'view' => 'inputbig',
		'title' => __('Unique ID','pn'),
		'default' => is_isset($bd_data, 'uniqueid'),
		'name' => 'uniqueid',
		'work' => 'input',
	);	
	$options['currency_id'] = array(
		'view' => 'select',
		'title' => __('Currency name','pn'),
		'options' => $currency,
		'default' => is_isset($bd_data, 'currency_id'),
		'name' => 'currency_id',
	);
	$options['place_id'] = array(
		'view' => 'select',
		'title' => __('Display conditions','pn'),
		'options' => array('0'=> __('always','pn'), '1'=> __('send','pn'), '2'=> __('receive','pn')),
		'default' => is_isset($bd_data, 'place_id'),
		'name' => 'place_id',
	);			
	$options['cf_hidden'] = array(
		'view' => 'select',
		'title' => __('Data visibility in order placed on a website','pn'),
		'options' => array('0'=>__('do not show data','pn'),'1'=>__('hide data','pn'),'2'=>__('do not hide first 4 symbols','pn'),'3'=>__('do not hide last 4 symbols','pn'),'4'=>__('do not hide first 4 symbols and the last 4 symbols','pn')),
		'default' => is_isset($bd_data, 'cf_hidden'),
		'name' => 'cf_hidden',
	);	
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['vid'] = array(
		'view' => 'select',
		'title' => __('Custom field type','pn'),
		'options' => array('0'=> __('Text input field','pn'), '1'=> __('Options','pn')),
		'default' => is_isset($bd_data, 'vid'),
		'name' => 'vid',
	);	
	
	$vid = intval(is_isset($bd_data, 'vid'));
	if($vid == 0){
		$cl1 = '';
		$cl2 = 'pn_hide';
	} else {
		$cl1 = 'pn_hide';
		$cl2 = '';			
	}	
	
	$options['minzn'] = array(
		'view' => 'input',
		'title' => __('Min. number of symbols','pn'),
		'default' => is_isset($bd_data, 'minzn'),
		'name' => 'minzn',
		'class' => 'thevib thevib0 '.$cl1,
	);	
	$options['maxzn'] = array(
		'view' => 'input',
		'title' => __('Max. number of symbols','pn'),
		'default' => is_isset($bd_data, 'maxzn'),
		'name' => 'maxzn',
		'class' => 'thevib thevib0 '.$cl1,
	);				
	$options['firstzn'] = array(
		'view' => 'input',
		'title' => __('First symbols','pn'),
		'default' => is_isset($bd_data, 'firstzn'),
		'name' => 'firstzn',
		'class' => 'thevib thevib0 '.$cl1,
	);
	$options['firstzn_help'] = array(
		'view' => 'help',
		'title' => __('More info','pn'),
		'default' => __('Checking the first symbols while a customer fills out a field.','pn'),
		'class' => 'thevib thevib0 '.$cl1,
	);
	$options['cifrzn'] = array(
		'view' => 'select',
		'title' => __('Allowed symbols','pn'),
		'options' => array('0'=>__('Numbers and latin letters','pn'),'1'=>__('Numbers','pn'),'2'=>__('Latin letters','pn'),'3'=>__('E-mail','pn'),'5'=>__('Phone number','pn'),'4'=>__('Any symbols','pn')),
		'default' => is_isset($bd_data, 'cifrzn'),
		'name' => 'cifrzn',
		'class' => 'thevib thevib0 '.$cl1,
	);	
	$options['backspace'] = array(
		'view' => 'select',
		'title' => __('Remove spaces in details','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => is_isset($bd_data, 'backspace'),
		'name' => 'backspace',
		'class' => 'thevib thevib0 '.$cl1,
	);	
	$options['cf_req'] = array(
		'view' => 'select',
		'title' => __('Required field','pn'),
		'options' => array('1'=>__('Yes','pn'),'0'=>__('No','pn')),
		'default' => is_isset($bd_data, 'cf_req'),
		'name' => 'cf_req',
		'class' => 'thevib thevib0 '.$cl1,
	);
	$options['helps'] = array(
		'view' => 'textarea',
		'title' => __('Fill-in tips','pn'),
		'default' => is_isset($bd_data, 'helps'),
		'name' => 'helps',
		'width' => '',
		'height' => '100px',
		'ml' => 1,
		'class' => 'thevib thevib0 '.$cl1
	);	
	$options['datas'] = array(
		'view' => 'textarea',
		'title' => __('Options (at the beginning of a new line)','pn'),
		'default' => is_isset($bd_data, 'datas'),
		'name' => 'datas',
		'width' => '',
		'height' => '200px',
		'ml' => 1,
		'class' => 'thevib thevib1 '.$cl2
	);	
	$options['status'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('1'=>__('active field','pn'),'0'=>__('inactive field','pn')),
		'default' => is_isset($bd_data, 'status'),
		'name' => 'status',
	);	
	
	$params_form = array(
		'filter' => 'pn_cfc_addform',
		'method' => 'post',
		'data' => $bd_data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);			
?>
<script type="text/javascript">
$(function(){ 
	$('#pn_vid').change(function(){
		var id = $(this).val();
		$('.thevib').hide();
		$('.thevib' + id).show();
		
		return false;
	});
});
</script>	
<?php
} 

add_action('premium_action_pn_add_cfc','def_premium_action_pn_add_cfc');
function def_premium_action_pn_add_cfc(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_cfc'));	
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id'));
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "currency_custom_fields WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['cf_name'] = pn_strip_input(is_param_post_ml('cf_name'));
	$tech_name = pn_strip_input(is_param_post_ml('tech_name'));
	if(!$tech_name){
		$tech_name = $array['cf_name'];
	}
	$array['tech_name'] = $tech_name;	
	$array['place_id'] = intval(is_param_post('place_id'));	
	$array['currency_id'] = intval(is_param_post('currency_id'));				
	$array['vid'] = intval(is_param_post('vid'));
	$array['uniqueid'] = pn_strip_input(is_param_post('uniqueid'));
	$array['cf_hidden'] = intval(is_param_post('cf_hidden'));
	if($array['vid'] == 0){	
		$array['cf_req'] = intval(is_param_post('cf_req'));		
		$array['minzn'] = intval(is_param_post('minzn'));
		$array['maxzn'] = intval(is_param_post('maxzn'));
		$array['helps'] = pn_strip_input(is_param_post_ml('helps'));
		$array['firstzn'] = is_firstzn_value(is_param_post('firstzn'));
		$array['cifrzn'] = intval(is_param_post('cifrzn'));
		$array['backspace'] = intval(is_param_post('backspace'));
		$array['datas'] = '';	
	} else {		
		$array['cf_req'] = 0;		
		$array['minzn'] = 0;
		$array['maxzn'] = 0;
		$array['helps'] = '';
		$array['firstzn'] = '';	
		$array['cifrzn'] = 0;
		$array['datas'] = pn_strip_input(is_param_post_ml('datas'));		
	}
		
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');		
	$array['status'] = intval(is_param_post('status'));

	$array = apply_filters('pn_cfc_addform_post',$array, $last_data);
		
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_cfc_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'currency_custom_fields', $array, array('id' => $data_id));
			do_action('pn_cfc_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_cfc_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'currency_custom_fields', $array, array('id' => $data_id));
			if($result){
				do_action('pn_cfc_add', $data_id, $array);
			}
		}
	}

	$url = admin_url('admin.php?page=pn_add_cfc&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}