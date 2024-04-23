<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_vaccounts_many', 'pn_admin_title_pn_add_vaccounts_many');
function pn_admin_title_pn_add_vaccounts_many(){
	_e('Add list','pn');
}

add_action('pn_adminpage_content_pn_add_vaccounts_many','def_pn_admin_content_pn_add_vaccounts_many');
function def_pn_admin_content_pn_add_vaccounts_many(){
global $wpdb;

	$form = new PremiumForm();

	$title = __('Add list','pn');
	$currencies = apply_filters('list_currency_manage', array(), __('No item','pn'));		
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_vaccounts'),
		'title' => __('Back to list','pn')
	);
	$form->back_menu($back_menu, '');

	$options = array();	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => $title,
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
	$options['valut_id'] = array(
		'view' => 'select',
		'title' => __('Currency name','pn'),
		'options' => $currencies,
		'default' => 0,
		'name' => 'valut_id',
	);	
	$options['items'] = array(
		'view' => 'textarea',
		'title' => __('Accounts (at the beginning of a new line)','pn'),
		'default' => '',
		'name' => 'items',
		'width' => '',
		'height' => '300px',
	);
	
	$params_form = array(
		'filter' => 'pn_add_vaccounts_many_addform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);					
}

add_action('premium_action_pn_add_vaccounts_many','def_premium_action_pn_add_vaccounts_many');
function def_premium_action_pn_add_vaccounts_many(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_vaccounts'));

	$form = new PremiumForm();
	
	$items = explode("\n",is_param_post('items'));
	if(is_array($items)){
				
		$valut_id = intval(is_param_post('valut_id'));
				
		foreach($items as $item){
			$accountnum = pn_strip_input($item);
			if($accountnum){
				$array = array(
					'valut_id' => $valut_id,
					'accountnum' => $accountnum,
				);
				$wpdb->insert($wpdb->prefix.'valuts_account', $array);
				$data_id = $wpdb->insert_id;
				
				do_action('pn_vaccounts_add', $data_id, $array);
				
				if($data_id){
					$otv = update_vaccs_txtmeta($data_id, 'accountnum', $accountnum);
					if($otv != 1){
						$form->error_form(sprintf(__('Error! Directory <b>%s</b> do not exist or cannot be written! Create this directory or get permission 777.','pn'),'/wp-content/uploads/vaccsmeta/'));
					}							
				}
						
			}
		}
	}

	$url = admin_url('admin.php?page=pn_vaccounts&reply=true');
	$form->answer_form($url);
}	