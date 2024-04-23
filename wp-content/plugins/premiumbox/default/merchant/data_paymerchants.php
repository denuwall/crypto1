<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_data_paymerchants', 'pn_admin_title_pn_data_paymerchants');
function pn_admin_title_pn_data_paymerchants(){ 
	_e('Automatic payout settings','pn');
}

add_action('pn_adminpage_content_pn_data_paymerchants','def_pn_admin_content_pn_data_paymerchants');
function def_pn_admin_content_pn_data_paymerchants(){
global $wpdb;
		
	$form = new PremiumForm();	
		
	$m_id = is_extension_name(is_param_get('m_id'));
	
	$list_merchants = apply_filters('list_paymerchants',array());
	$list_merchants_t = array();
	foreach($list_merchants as $data){
		$list_merchants_t[] = is_isset($data,'id');
	}
	
	$merch_data = get_option('paymerch_data');
	if(!is_array($merch_data)){ $merch_data = array(); }
	
	$selects = array();
	$selects[] = array(
		'link' => admin_url("admin.php?page=pn_data_paymerchants"),
		'title' => '--' . __('Make a choice','pn') . '--',
		'background' => '',
		'default' => '',
	);
	if(is_array($list_merchants)){  
		foreach($list_merchants as $data){
			$id = is_isset($data,'id');
			$title = is_isset($data,'title');
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_data_paymerchants&m_id=".$id),
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
		
		do_action('before_paymerchant_admin', $m_id, $data);
		
		$options = array();
		$options['hidden_block'] = array(
			'view' => 'hidden_input',
			'name' => 'm_id',
			'default' => $m_id,
		);	
		$options['warning'] = array(
			'view' => 'warning',
			'default' => sprintf(__('Do not use automatic payouts if it not urgent. Developer is not responsible for the safety of currency on your accounts. Read more here <a href="%s">here</a>.','pn'),'https://premiumexchanger.com/wiki/preduprezhdenie-auto/'),
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
		$tags = apply_filters('paymerchant_admin_tabs', $tags, $m_id);
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
		$options['realpay'] = array(
			'view' => 'select',
			'title' => __('Automatic payout when order has status "Paid order"','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data,'realpay'),
			'name' => 'realpay',
			'work' => 'int',
		);
		$options['verify'] = array(
			'view' => 'select',
			'title' => __('Automatic payout when order has status "Order is on checking"','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data,'verify'),
			'name' => 'verify',
			'work' => 'int',
		);			
		$enable_autopay = apply_filters('paymerchant_enable_autopay', 0 , $m_id);
		if($enable_autopay == 1){
			$options['button'] = array(
				'view' => 'select',
				'title' => __('Button used to make payouts according to order manually','pn'),
				'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
				'default' => is_isset($data,'button'),
				'name' => 'button',
				'work' => 'int',
			);
			$options['button_maximum'] = array(
				'view' => 'select',
				'title' => __('Make a manual payout available if the amount needed exceeds the limit','pn'),
				'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
				'default' => is_isset($data,'button_maximum'),
				'name' => 'button_maximum',
				'work' => 'int',
			);			
		}
		$options['max'] = array(
			'view' => 'input',
			'title' => __('Max. amount for daily automatic payouts','pn'),
			'default' => is_isset($data, 'max'),
			'name' => 'max',
			'work' => 'sum',
		);
		$options['max_sum'] = array(
			'view' => 'input',
			'title' => __('Max. amount of automatic payouts due to order','pn'),
			'default' => is_isset($data, 'max_sum'),
			'name' => 'max_sum',
			'work' => 'sum',
		);
		$where_sum = array(
			'0' => __('Amount To receive (add.fees and PS fees)','pn'), 
			'1' => __('Amount To receive (add. fees)','pn'), 
			'2' => __('Amount for reserve','pn'), 
			'3' => __('Amount (discount included)','pn'), 
		);
		$options['where_sum'] = array(
			'view' => 'select',
			'title' => __('Amount transfer for payout','pn'),
			'options' => $where_sum,
			'default' => is_isset($data,'where_sum'),
			'name' => 'where_sum',
			'work' => 'int',
		);	
		$options['checkpay'] = array(
			'view' => 'select',
			'title' => __('Check payment history by API','pn'),
			'options' => array('0'=>__('No','pn'), '1'=>__('Yes','pn')),
			'default' => is_isset($data, 'checkpay'),
			'name' => 'checkpay',
			'work' => 'int',
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
		$options['line1'] = array(
			'view' => 'line',
			'colspan' => 2,
		);
		$options['timeout'] = array(
			'view' => 'input',
			'title' => __('Automatic payout delay (hrs)','pn'),
			'default' => is_isset($data, 'timeout'),
			'name' => 'timeout',
			'work' => 'sum',
		);
		$options['timeout_user'] = array(
			'view' => 'select',
			'title' => __('Whom the delay is for','pn'),
			'options' => array('0'=>__('everyone','pn'), '1'=>__('newcomers','pn'), '2'=>__('not registered users','pn'), '3' => __('not verified users','pn')),
			'default' => is_isset($data,'timeout_user'),
			'name' => 'timeout_user',
			'work' => 'int',
		);	
		$options['line_timeout'] = array(
			'view' => 'line',
			'colspan' => 2,
		);

		$options = apply_filters('get_paymerchant_admin_options', $options, $m_id, $data);
		$params_form = array(
			'filter' => 'get_paymerchant_admin_options_'.$m_id,
			'method' => 'post',
			'data' => $data,
			'button_title' => __('Save','pn'),
		);
		$form->init_form($params_form, $options);

	}  
} 

add_action('premium_action_pn_data_paymerchants','def_premium_action_pn_data_paymerchants');
function def_premium_action_pn_data_paymerchants(){
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
	$options['realpay'] = array(
		'name' => 'realpay',
		'work' => 'int',
	);
	$options['verify'] = array(
		'name' => 'verify',
		'work' => 'int',
	);					
	$enable_autopay = apply_filters('paymerchant_enable_autopay', 0 , $m_id);
	if($enable_autopay == 1){
		$options['button'] = array(
			'name' => 'button',
			'work' => 'int',
		);
		$options['button_maximum'] = array(
			'name' => 'button_maximum',
			'work' => 'int',
		);		
	}
	$options['max'] = array(
		'name' => 'max',
		'work' => 'sum',
	);
	$options['max_sum'] = array(
		'name' => 'max_sum',
		'work' => 'sum',
	);	
	$options['where_sum'] = array(
		'name' => 'where_sum',
		'work' => 'int',
	);	
	$options['checkpay'] = array(
		'name' => 'checkpay',
		'work' => 'int',
	);
	$options['resulturl'] = array(
		'name' => 'resulturl',
		'work' => 'symbols',
	);	
	$options['show_error'] = array(
		'name' => 'show_error',
		'work' => 'int',
	);	
	$options['timeout'] = array(
		'name' => 'timeout',
		'work' => 'sum',
	);
	$options['timeout_user'] = array(
		'name' => 'timeout_user',
		'work' => 'int',
	);	
	$options = apply_filters('get_paymerchant_admin_options', $options, $m_id, '');
	$data = $form->strip_options('get_paymerchant_admin_options_'.$m_id, 'post', $options);
	
	$merch_data = get_option('paymerch_data');
	if(!is_array($merch_data)){ $merch_data = array(); }
						
	foreach($data as $key => $val){
		$merch_data[$m_id][$key] = $val;
	}			

	update_option('paymerch_data', $merch_data);

	do_action('paymerchant_admin_post', $data);			
			
	$url = admin_url('admin.php?page=pn_data_paymerchants&m_id='. $m_id .'&reply=true');
	$form->answer_form($url);
} 