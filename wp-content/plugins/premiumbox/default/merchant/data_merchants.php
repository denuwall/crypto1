<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_data_merchants', 'pn_admin_title_pn_data_merchants');
function pn_admin_title_pn_data_merchants(){
	_e('Merchant settings','pn');
}	

add_action('pn_adminpage_content_pn_data_merchants','def_pn_admin_content_pn_data_merchants');
function def_pn_admin_content_pn_data_merchants(){
global $wpdb;
		
	$form = new PremiumForm();	
		
	$m_id = is_extension_name(is_param_get('m_id'));
	
	$list_merchants = apply_filters('list_merchants',array());
	$list_merchants_t = array();
	foreach($list_merchants as $data){
		$list_merchants_t[] = is_isset($data,'id');
	}
	
	$merch_data = get_option('merch_data');
	if(!is_array($merch_data)){ $merch_data = array(); }
	
	$selects = array();
	$selects[] = array(
		'link' => admin_url("admin.php?page=pn_data_merchants"),
		'title' => '--' . __('Make a choice','pn') . '--',
		'background' => '',
		'default' => '',
	);
	if(is_array($list_merchants)){  
		foreach($list_merchants as $data){
			$id = is_isset($data,'id');
			$title = is_isset($data,'title');
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_data_merchants&m_id=".$id),
				'title' => $title,
				'background' => '',
				'default' => $id,
			);
		}
	}	
	$form->select_box($m_id, $selects, __('Setting up','pn'));	
	
	if(in_array($m_id,$list_merchants_t)){
		$data = '';
		if(isset($merch_data[$m_id])){
			$data = $merch_data[$m_id]; 
		}	
		
		do_action('before_merchant_admin', $m_id, $data);

		$options = array();
		$options['hidden_block'] = array(
			'view' => 'hidden_input',
			'name' => 'm_id',
			'default' => $m_id,
		);	
		$options['top_title'] = array(
			'view' => 'h3',
			'title' => '',
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);
		$options['instruction'] = array(
			'view' => 'textarea',
			'title' => __('Instruction','pn'),
			'default' => is_isset($data, 'text'),
			'name' => 'text',
			'width' => '',
			'height' => '200px',
			'ml' => 1,
			'work' => 'text',
		);	
		$tags = array(
			'id' => __('Order ID','pn'),
			'paysum' => __('Payment amount','pn'),
			'sum1' => __('Amount To send','pn'),
			'currency_give' => __('Currency name Giving','pn'),
			'sum2' => __('Amount Receive','pn'),
			'currency_get' => __('Currency name Receiving','pn'),
			'account_give' => __('Account Send','pn'),
			'account_get' => __('Account Receive','pn'),
			'fio' => __('User name','pn'),
			'last_name' => __('Last name','pn'),
			'first_name' => __('First name','pn'),
			'second_name' => __('Second name','pn'),
			'ip' => __('User IP','pn'),
			'skype' => __('User skype','pn'),
			'phone' => __('Phone no.','pn'),
			'email' => __('User e-mail','pn'),
			'passport' => __('Passport number','pn'),
		);
		$tags = apply_filters('merchant_admin_tabs', $tags, $m_id);
		$options['note'] = array(
			'view' => 'textareatags',
			'title' => __('Note for payment','pn'),
			'default' => is_isset($data, 'note'),
			'tags' => $tags,
			'width' => '',
			'height' => '200px',
			'prefix1' => '[',
			'prefix2' => ']',
			'name' => 'note',
			'work' => 'text',
			'ml' => 1,
		);	
		$options['corr'] = array(
			'view' => 'input',
			'title' => __('Payment amount error','pn'),
			'default' => is_isset($data, 'corr'),
			'name' => 'corr',
			'work' => 'sum',
		);		
		$options['check_api'] = array(
			'view' => 'select',
			'title' => __('Check payment history by API','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'check_api'),
			'name' => 'check_api',
			'work' => 'int',
		);		
		$options['type'] = array(
			'view' => 'select',
			'title' => __('Type','pn'),
			'options' => array('0'=>__('Standart merchant fee','pn'), '1'=>__('Non-standart merchant fee','pn')),
			'default' => is_isset($data, 'type'),
			'name' => 'type',
			'work' => 'int',
		);		
		$options['help_type'] = array(
			'view' => 'help',
			'title' => __('More info','pn'),
			'default' => __('Choose "Non-standart merchant fee" if a payment system takes a fee for incoming payment. In other case you need to set "Standart merchant fee".','pn'),
		);
		$options['enableip'] = array(
			'view' => 'textarea',
			'title' => __('Authorized IP (at the beginning of a new line)','pn'),
			'default' => is_isset($data, 'enableip'),
			'name' => 'enableip',
			'width' => '',
			'height' => '200px',
			'work' => 'text',
		);
		$options['personal_secret'] = array(
			'view' => 'inputbig',
			'title' => __('Extra secret key','pn'),
			'default' => is_isset($data, 'personal_secret'),
			'name' => 'personal_secret',
			'work' => 'symbols',
		);		
		$options['resulturl'] = array(
			'view' => 'inputbig',
			'title' => __('Status/Result URL hash','pn'),
			'default' => is_isset($data, 'resulturl'),
			'name' => 'resulturl',
			'work' => 'symbols',
		);
		$options['show_error'] = array(
			'view' => 'select',
			'title' => __('Display errors arising during module operation','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'show_error'),
			'name' => 'show_error',
			'work' => 'int',
		);
		$options['center_title'] = array(
			'view' => 'h3',
			'title' => __('Set order status to "Order is on checking", when:','pn'),
			'submit' => __('Save','pn'),
			'colspan' => 2,
		);		
		$options['check'] = array(
			'view' => 'select',
			'title' => __('Number of account, from which payment was made does not match one specified in order','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'check'),
			'name' => 'check',
			'work' => 'int',
		);	
		$options['invalid_ctype'] = array(
			'view' => 'select',
			'title' => __('Incorrect currency code','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'invalid_ctype'),
			'name' => 'invalid_ctype',
			'work' => 'int',
		);
		$options['invalid_minsum'] = array(
			'view' => 'select',
			'title' => __('Payment amount is less than required','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'invalid_minsum'),
			'name' => 'invalid_minsum',
			'work' => 'int',
		);
		$options['invalid_maxsum'] = array(
			'view' => 'select',
			'title' => __('Payment amount is more required','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'invalid_maxsum'),
			'name' => 'invalid_maxsum',
			'work' => 'int',
		);		

		$options = apply_filters('get_merchant_admin_options', $options, $m_id, $data);
		$params_form = array(
			'filter' => 'get_merchant_admin_options_'.$m_id,
			'method' => 'post',
			'data' => $data,
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form, $options);		
	} 
}  

add_action('premium_action_pn_data_merchants','def_premium_action_pn_data_merchants');
function def_premium_action_pn_data_merchants(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_merchants'));

	$form = new PremiumForm();
	
	$m_id = is_extension_name(is_param_post('m_id'));
	
	$options = array();
	$options['instruction'] = array(
		'name' => 'text',
		'ml' => 1,
		'work' => 'text',
	);	
	$options['note'] = array(
		'name' => 'note',
		'work' => 'text',
		'ml' => 1,
	);
	$options['corr'] = array(
		'name' => 'corr',
		'work' => 'sum',
	);		
	$options['check_api'] = array(
		'name' => 'check_api',
		'work' => 'int',
	);	
	$options['type'] = array(
		'name' => 'type',
		'work' => 'int',
	);
	$options['enableip'] = array(
		'name' => 'enableip',
		'work' => 'text',
	);
	$options['personal_secret'] = array(
		'name' => 'personal_secret',
		'work' => 'symbols',
	);	
	$options['resulturl'] = array(
		'name' => 'resulturl',
		'work' => 'symbols',
	);	
	$options['show_error'] = array(
		'name' => 'show_error',
		'work' => 'int',
	);
	$options['check'] = array(
		'name' => 'check',
		'work' => 'int',
	);
	$options['invalid_ctype'] = array(
		'name' => 'invalid_ctype',
		'work' => 'int',
	);	
	$options['invalid_minsum'] = array(
		'name' => 'invalid_minsum',
		'work' => 'int',
	);
	$options['invalid_maxsum'] = array(
		'name' => 'invalid_maxsum',
		'work' => 'int',
	);	
	$options = apply_filters('get_merchant_admin_options', $options, $m_id, '');
	$data = $form->strip_options('get_merchant_admin_options_'.$m_id, 'post', $options);	
	
	$merch_data = get_option('merch_data');
	if(!is_array($merch_data)){ $merch_data = array(); }
						
	foreach($data as $key => $val){
		$merch_data[$m_id][$key] = $val;
	}			

	update_option('merch_data', $merch_data);

	do_action('merchant_admin_post', $data);
				
	$url = admin_url('admin.php?page=pn_data_merchants&m_id='. $m_id .'&reply=true');
	$form->answer_form($url);
}