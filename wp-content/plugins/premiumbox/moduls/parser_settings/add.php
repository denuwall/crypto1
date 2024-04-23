<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_parser_pairs', 'pn_admin_title_pn_add_parser_pairs');
function pn_admin_title_pn_add_parser_pairs(){
	$id = intval(is_param_get('item_id'));
	if($id){
		_e('Edit rate','pn');
	} else {
		_e('Add rate','pn');
	}
} 

add_action('pn_adminpage_content_pn_add_parser_pairs','def_pn_admin_content_pn_add_parser_pairs');
function def_pn_admin_content_pn_add_parser_pairs(){
global $wpdb;

	$form = new PremiumForm();

	$id = intval(is_param_get('item_id'));
	$data_id = 0;
	$data = '';
	
	if($id){
		$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."parser_pairs WHERE id='$id'");
		if(isset($data->id)){
			$data_id = $data->id;
		}	
	}

	if($data_id){
		$title = __('Edit rate','pn');
	} else {
		$title = __('Add rate','pn');
	}	
	?>
	<div style="margin: 0 0 10px 0;">
		<?php 
		$text = sprintf(__('For creating an exchange rate you can use the following mathematical operations:<br><br> 
		* multiplication<br> 
		/ division<br> 
		- subtraction<br> 
		+ addition<br><br> 
		An example of a formula where two exchange rates are multiplied: [bitfinex_btcusd_last_price] * [cbr_usdrub]<br> 
		For more detailed instructions, follow the <a href="%s" target="_blank">link</a>.','pn'), 'https://premiumexchanger.com/wiki/parseryi-kursov-valyut/');
		$form->help(__('Example of formulas for parser','pn'), $text);
		?>
	</div>	
	<?php
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_parser_pairs'),
		'title' => __('Back to list','pn')
	);
	if($data_id){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_parser_pairs'),
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
	$options['title_birg'] = array(
		'view' => 'inputbig',
		'title' => __('Source name','pn'),
		'default' => is_isset($data, 'title_birg'),
		'name' => 'title_birg',
		'ml' => 1,
	);
	$options['title_pair_give'] = array(
		'view' => 'inputbig',
		'title' => __('Currency name Send','pn'),
		'default' => is_isset($data, 'title_pair_give'),
		'name' => 'title_pair_give',
	);
	$options['title_pair_get'] = array(
		'view' => 'inputbig',
		'title' => __('Currency name Receive','pn'),
		'default' => is_isset($data, 'title_pair_get'),
		'name' => 'title_pair_get',
	);	
	$options['pair_give'] = array(
		'view' => 'inputbig',
		'title' => __('Rate formula for Send','pn'),
		'default' => is_isset($data, 'pair_give'),
		'name' => 'pair_give',
	);
	$options['pair_get'] = array(
		'view' => 'inputbig',
		'title' => __('Rate formula for Receive','pn'),
		'default' => is_isset($data, 'pair_get'),
		'name' => 'pair_get',
	);	
	
	$params_form = array(
		'filter' => 'pn_masschange_addform',
		'method' => 'post',
		'data' => $data,
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
		
} 

add_action('premium_action_pn_add_parser_pairs','def_premium_action_pn_add_parser_pairs');
function def_premium_action_pn_add_parser_pairs(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id'));
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "parser_pairs WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['title_birg'] = pn_strip_input(is_param_post_ml('title_birg'));
	$array['title_pair_give'] = pn_strip_input(is_param_post('title_pair_give'));
	$array['title_pair_get'] = pn_strip_input(is_param_post('title_pair_get'));
	$array['pair_give'] = pn_parser_actions(is_param_post('pair_give'));
	$array['pair_get'] = pn_parser_actions(is_param_post('pair_get'));
			
	$array = apply_filters('pn_parser_pairs_addform_post',$array, $last_data);
			
	if($data_id){		
		do_action('pn_parser_pairs_edit_before', $data_id, $array, $last_data);
		$result = $wpdb->update($wpdb->prefix.'parser_pairs', $array, array('id'=>$data_id));
		do_action('pn_parser_pairs_edit', $data_id, $array, $last_data);
		if($result){
			do_action('pn_parser_pairs_edit_after', $data_id, $array, $last_data);
		}	
		update_directions_to_new_parser($data_id);
	} else {		
		$wpdb->insert($wpdb->prefix.'parser_pairs', $array);
		$data_id = $wpdb->insert_id;	
		do_action('pn_parser_pairs_add', $data_id, $array);		
	}

	$url = admin_url('admin.php?page=pn_add_parser_pairs&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	