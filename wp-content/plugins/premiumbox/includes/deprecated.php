<?php
if( !defined( 'ABSPATH')){ exit(); } 

/* 1.0 */
if(!function_exists('update_pn_term_meta')){
	function update_pn_term_meta($id, $key, $value){
	global $premiumbox;	
		$premiumbox->_deprecated_function('update_pn_term_meta', '1.0', 'update_term_meta');
		
		return update_term_meta($id, $key, $value);
	}
}
if(!function_exists('get_pn_term_meta')){
	function get_pn_term_meta($id, $key){
	global $premiumbox;	
		$premiumbox->_deprecated_function('get_pn_term_meta', '1.0', 'get_term_meta');	
		
		return get_term_meta($id, $key);
	}
}	
if(!function_exists('delete_pn_term_meta')){
	function delete_pn_term_meta($id, $key){
	global $premiumbox;	
		$premiumbox->_deprecated_function('delete_pn_term_meta', '1.0', 'delete_term_meta');	
		
		return delete_term_meta($id, $key);
	}
}
if(!function_exists('is_merchant_id')){
	function is_merchant_id($name){
	global $premiumbox;	
		$premiumbox->_deprecated_function('is_merchant_id', '1.0', 'is_extension_name');
		return is_extension_name($name);
	}
}

/* 1.2 */
if(!function_exists('pn_allow_second_name')){
	function pn_allow_second_name(){
	global $premiumbox;

		$premiumbox->_deprecated_function('pn_allow_second_name', '1.2', "pn_allow_uv('second_name')");
		return pn_allow_uv('second_name');	
	}
}
if(!function_exists('is_modul_name')){
	function is_modul_name($name){
	global $premiumbox;	
		$premiumbox->_deprecated_function('is_modul_name', '1.2', 'is_extension_name');
		return is_extension_name($name);
	}
}	
if(!function_exists('get_merchant_file')){
	function get_merchant_file($file){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_merchant_file', '1.2', 'get_extension_file');
		return get_extension_file($file);	
	}
}
if(!function_exists('get_merchant_name')){
	function get_merchant_name($path){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_merchant_name', '1.2', 'get_extension_name');
		return get_extension_name($path);		
	}
}
if(!function_exists('get_merchant_num')){
	function get_merchant_num($name){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_merchant_num', '1.2', 'get_extension_num');
		return get_extension_num($file);	
	}
}
if(!function_exists('set_merchant_data')){
	function set_merchant_data($path, $map){
	global $premiumbox;

		$premiumbox->_deprecated_function('set_merchant_data', '1.2', 'set_extension_data');
		return set_extension_data($path, $map);	
	}
}	
if(!function_exists('get_reserv_status_auto')){
	function get_reserv_status_auto(){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_reserv_status_auto', '1.2', 'get_reserv_status("auto")');
		return get_reserv_status('auto');	
	}
}
if(!function_exists('get_reserv_status_in')){
	function get_reserv_status_in(){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_reserv_status_in', '1.2', 'get_reserv_status("in")');
		return get_reserv_status('in');
	}
}
if(!function_exists('get_reserv_status_out')){	
	function get_reserv_status_out(){
	global $premiumbox;

		$premiumbox->_deprecated_function('get_reserv_status_out', '1.2', 'get_reserv_status("out")');
		return get_reserv_status('out');
	}
}	
if(!function_exists('is_enable_reserv')){
	function is_enable_reserv(){
	global $premiumbox;

		$premiumbox->_deprecated_function('is_enable_reserv', '1.2', "is_enable_zreserve");	
	}
}
if(!function_exists('get_goodly_num')){
	function get_goodly_num($sum, $decimal=2, $place='all'){
	global $premiumbox; 

		$premiumbox->_deprecated_function('get_goodly_num', '1.2', "is_out_sum");	
		return is_out_sum($sum, $decimal, $place);
	}
}
if(!function_exists('the_merchant_bid_payed')){
	function the_merchant_bid_payed($id, $sum=0, $purse='', $naschet='', $payment_id='', $system='user'){					
	global $premiumbox;
		$premiumbox->_deprecated_function('the_merchant_bid_payed', '1.2', "the_merchant_bid_status");
	}
}
if(!function_exists('the_merchant_bid_coldpay')){
	function the_merchant_bid_coldpay($id, $sum=0, $purse='', $naschet='', $payment_id='', $system=''){			
	global $premiumbox;
		$premiumbox->_deprecated_function('the_merchant_bid_coldpay', '1.2', "the_merchant_bid_status");
	}
}
if(!function_exists('the_merchant_bid_techpay')){
	function the_merchant_bid_techpay($id, $sum=0, $purse='', $naschet='', $payment_id='', $system=''){			
	global $premiumbox;
		$premiumbox->_deprecated_function('the_merchant_bid_techpay', '1.2', "the_merchant_bid_status");
	}
}
if(!function_exists('the_paymerchant_bid_success')){
	function the_paymerchant_bid_success($id, $sum=0, $purse='', $naschet='', $payment_id='', $system=''){			
	global $premiumbox;
		$premiumbox->_deprecated_function('the_paymerchant_bid_success', '1.2', "the_merchant_bid_status");
	}
}
if(!function_exists('the_paymerchant_bid_coldsuccess')){
	function the_paymerchant_bid_coldsuccess($id, $sum=0, $purse='', $naschet='', $payment_id='', $system=''){			
	global $premiumbox;
		$premiumbox->_deprecated_function('the_paymerchant_bid_coldsuccess', '1.2', "the_merchant_bid_status");
	}
}

/** 1.3 **/
if(!function_exists('is_check_wallet')){
	function is_check_wallet($m_id){
	global $premiumbox;
		$premiumbox->_deprecated_function('is_check_wallet', '1.3', "");	
		$data = get_merch_data($m_id); 
		return intval(is_isset($data,'check'));
	}
}

if(!function_exists('is_check_payapi')){
	function is_check_payapi($m_id){
	global $premiumbox;
		$premiumbox->_deprecated_function('is_check_payapi', '1.3', "");	
		$data = get_merch_data($m_id); 
		return intval(is_isset($data,'check_payapi'));
	}
}

/** 1.4 **/
if(!function_exists('delsimbol')){
	function delsimbol($arg, $symbols=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('delsimbol', '1.4', "pn_strip_symbols");
			return pn_strip_symbols($arg);
	}
}
if(!function_exists('is_my_money')){
	function is_my_money($sum, $cz=12, $mode='half_up'){
		global $premiumbox;
			$premiumbox->_deprecated_function('is_my_money', '1.4', "is_sum");
			return is_sum($sum, $cz, $mode);
	}
}
if(!function_exists('get_summ_color')){
	function get_summ_color($sum, $max='bgreen',$min='bred'){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_summ_color', '1.4', "get_sum_color");
			return get_sum_color($sum, $max, $min);
	}
}
if(!function_exists('get_valut_title')){
	function get_valut_title($data){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valut_title', '1.4', "get_currency_title");
			return get_currency_title($data);
	}
}
if(!function_exists('list_view_valuts')){
	function list_view_valuts($output=array(), $not=array()){
		global $premiumbox;
			$premiumbox->_deprecated_function('list_view_valuts', '1.4', "list_view_currencies");
			return list_view_currencies($output, $not);
	}
}
if(!function_exists('get_valut_logo')){
	function get_valut_logo($data){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valut_logo', '1.4', "get_currency_logo");
			return get_currency_logo($data);
	}
}
if(!function_exists('get_valut_reserv')){
	function get_valut_reserv($data){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valut_reserv', '1.4', "get_currency_reserv");
			return get_currency_reserv($data);
	}
}
if(!function_exists('get_vtitle')){
	function get_vtitle($currency_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_vtitle', '1.4', "get_currency_title_by_id");
			return get_currency_title_by_id($currency_id, __('No item', 'pn'));
	}
}
if(!function_exists('update_valuts_meta')){
	function update_valuts_meta($id, $key, $value){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_valuts_meta', '1.4', "update_currency_meta");
			return update_currency_meta($id, $key, $value);
	}
}
if(!function_exists('get_valuts_meta')){
	function get_valuts_meta($id, $key){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valuts_meta', '1.4', "get_currency_meta");
			return get_currency_meta($id, $key);
	}
}
if(!function_exists('delete_valuts_meta')){
	function delete_valuts_meta($id, $key){
		global $premiumbox;
			$premiumbox->_deprecated_function('delete_valuts_meta', '1.4', "delete_currency_meta");
			return delete_currency_meta($id, $key);
	}
}
if(!function_exists('is_naps_premalink')){
	function is_naps_premalink($name){
		global $premiumbox;
			$premiumbox->_deprecated_function('is_naps_premalink', '1.4', "is_direction_premalink");
			return is_direction_premalink($id, $key);
	}
}
if(!function_exists('unique_naps_name')){
	function unique_naps_name($direction_name, $data_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('unique_naps_name', '1.4', "unique_direction_name");
			return unique_direction_name($direction_name, $data_id);
	}
}
if(!function_exists('update_naps_meta')){
	function update_naps_meta($id, $key, $value){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_naps_meta', '1.4', "update_direction_meta");
			return update_direction_meta($id, $key, $value);
	}
}
if(!function_exists('get_naps_meta')){
	function get_naps_meta($id, $key){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_naps_meta', '1.4', "get_direction_meta");
			return get_direction_meta($id, $key);
	}
}
if(!function_exists('delete_naps_meta')){
	function delete_naps_meta($id, $key){
		global $premiumbox;
			$premiumbox->_deprecated_function('delete_naps_meta', '1.4', "delete_direction_meta");
			return delete_direction_meta($id, $key);
	}
}
if(!function_exists('copy_naps_txtmeta')){
	function copy_naps_txtmeta($data_id, $new_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('copy_naps_txtmeta', '1.4', "copy_direction_txtmeta");
			return copy_direction_txtmeta($data_id, $new_id);
	}
}
if(!function_exists('delete_naps_txtmeta')){
	function delete_naps_txtmeta($data_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('delete_naps_txtmeta', '1.4', "delete_direction_txtmeta");
			return delete_direction_txtmeta($data_id);
	}
}
if(!function_exists('get_naps_txtmeta')){
	function get_naps_txtmeta($data_id, $key){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_naps_txtmeta', '1.4', "get_direction_txtmeta");
			return get_direction_txtmeta($data_id, $key);
	}
}
if(!function_exists('update_naps_txtmeta')){
	function update_naps_txtmeta($data_id, $key, $value){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_naps_txtmeta', '1.4', "update_direction_txtmeta");
			return update_direction_txtmeta($data_id, $key, $value);
	}
}
if(!function_exists('get_valuts_data')){
	function get_valuts_data($output=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valuts_data', '1.4', "get_currency_data");
			return get_currency_data($output);
	}
}
if(!function_exists('get_naps_where')){
	function get_naps_where($place=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_naps_where', '1.4', "get_directions_where");
			return get_directions_where($place);
	}
}
if(!function_exists('get_naps_reserv')){
	function get_naps_reserv($valut_reserv, $decimal, $naps){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_naps_reserv', '1.4', "get_direction_reserv");
			return get_direction_reserv($valut_reserv, $decimal, $naps);
	}
}
if(!function_exists('update_naps_to_masschange')){
	function update_naps_to_masschange($id){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_naps_to_masschange', '1.4', "update_directions_to_masschange");
			return update_directions_to_masschange($id);
	}
}
if(!function_exists('plus_persent_curs')){
	function plus_persent_curs($course, $nums){
		global $premiumbox;
			$premiumbox->_deprecated_function('plus_persent_curs', '1.4', "rate_plus_interest");
			return rate_plus_interest($course, $nums);
	}
}
if(!function_exists('get_min_sum_to_naps_give')){
	function get_min_sum_to_naps_give(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_min_sum_to_naps_give', '1.4', "");
	}
}
if(!function_exists('get_min_sum_to_naps_get')){
	function get_min_sum_to_naps_get(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_min_sum_to_naps_get', '1.4', "");
	}
}
if(!function_exists('get_max_sum_to_naps_give')){
	function get_max_sum_to_naps_give(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_max_sum_to_naps_give', '1.4', "");
	}
}
if(!function_exists('get_max_sum_to_naps_get')){
	function get_max_sum_to_naps_get(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_max_sum_to_naps_get', '1.4', "");
	}
}
if(!function_exists('is_naps_chpu')){
	function is_naps_chpu($arg){
		global $premiumbox;
			$premiumbox->_deprecated_function('is_naps_chpu', '1.4', "is_direction_name");
			return is_direction_name($arg);
	}
}
if(!function_exists('get_valut_in')){
	function get_valut_in($valut_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valut_in', '1.4', "get_currency_in");
			return get_currency_in($valut_id);
	}
}
if(!function_exists('get_valut_out')){
	function get_valut_out($valut_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_valut_out', '1.4', "get_currency_out");
			return get_currency_out($valut_id);
	}
}
if(!function_exists('get_sum_valut')){
	function get_sum_valut($valut_id, $method='in', $date=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_sum_valut', '1.4', "get_sum_currency");
			return get_sum_currency($valut_id, $method, $date);
	}
}
if(!function_exists('get_summ_naps_all')){
	function get_summ_naps_all($naps_id, $method='out', $date=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_summ_naps_all', '1.4', "get_sum_direction");
			return get_sum_direction($naps_id, $method, $date);
	}
}
if(!function_exists('get_reserv_vtype')){
	function get_reserv_vtype($vtype_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_reserv_vtype', '1.4', "get_reserv_currency_code");
			return get_reserv_currency_code($vtype_id);
	}
}
if(!function_exists('update_vtypes_to_parser')){
	function update_vtypes_to_parser($data_id){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_vtypes_to_parser', '1.4', "update_currency_code_to_parser");
			return update_currency_code_to_parser($data_id);
	}
}
if(!function_exists('get_dop_comm')){
	function get_dop_comm($sum, $com_box_sum, $com_box_pers, $com_box_min){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_dop_comm', '1.4', "get_dop_com");
			return get_dop_com($sum, $com_box_sum, $com_box_pers, $com_box_min);
	}
}
if(!function_exists('get_ps_comm')){
	function get_ps_comm($summ, $com_summ, $com_pers, $minsumm, $maxsumm, $standart){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_ps_comm', '1.4', "get_ps_com");
			return get_ps_com($summ, $com_summ, $com_pers, $minsumm, $maxsumm, $standart);
	}
}
if(!function_exists('pers_alter_summ')){
	function pers_alter_summ($summ, $pers){
		global $premiumbox;
			$premiumbox->_deprecated_function('pers_alter_summ', '1.4', "pers_alter_sum");
			return pers_alter_sum($summ, $pers);
	}
}
if(!function_exists('get_profit_naps')){
	function get_profit_naps(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_profit_naps', '1.4', "");
	}
}
if(!function_exists('get_replace_bidmail')){
	function get_replace_bidmail(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_replace_bidmail', '1.4', "");
	}
}
if(!function_exists('update_bids_naschet')){
	function update_bids_naschet($id, $schet){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_bids_naschet', '1.4', "update_bid_tb");
			return update_bid_tb($id, 'to_account', $schet);
	}
}

/** 1.5 **/
if(!function_exists('get_mycookie')){
	function get_mycookie($key){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_mycookie', '1.5', "get_pn_cookie");
			return get_pn_cookie($key);
	}
}
if(!function_exists('add_mycookie')){
	function add_mycookie($key, $arg, $time=0){
		global $premiumbox;
			$premiumbox->_deprecated_function('add_mycookie', '1.5', "add_pn_cookie");
			return add_pn_cookie($key, $arg, $time);
	}
}
if(!function_exists('pn_editor_ml')){
	function pn_editor_ml(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_editor_ml', '1.5', "");
	}
}
if(!function_exists('pn_editor')){
	function pn_editor(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_editor', '1.5', "");
	}
}
if(!function_exists('pn_select')){
	function pn_select(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_select', '1.5', "");
	}
}
if(!function_exists('pn_select_disabled')){
	function pn_select_disabled(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_select_disabled', '1.5', "");
	}
} 
if(!function_exists('pn_admin_one_screen')){
	function pn_admin_one_screen(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_admin_one_screen', '1.5', "");
	}
}
if(!function_exists('pn_the_link_ajax')){
	function pn_the_link_ajax($action=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_the_link_ajax', '1.5', "pn_the_link_post");
			pn_the_link_post($action, 'post');
	}
}
if(!function_exists('pn_link_ajax')){
	function pn_link_ajax($action=''){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_link_ajax', '1.5', "pn_link_post");
			return pn_link_post($action, 'post');
	}
}
if(!function_exists('pn_admin_work_options')){
	function pn_admin_work_options(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_admin_work_options', '1.5', "");
	}
}
if(!function_exists('pn_set_option_template')){
	function pn_set_option_template(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_set_option_template', '1.5', "");
	}
}
if(!function_exists('pn_h3')){
	function pn_h3(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_h3', '1.5', "");
	}
}
if(!function_exists('pn_inputbig_ml')){
	function pn_inputbig_ml(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_inputbig_ml', '1.5', "");
	}
}
if(!function_exists('pn_inputbig')){
	function pn_inputbig(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_inputbig', '1.5', "");
	}
}
if(!function_exists('pn_input')){
	function pn_input(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_input', '1.5', "");
	}
}
if(!function_exists('pn_strip_options')){
	function pn_strip_options(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_strip_options', '1.5', "");
	}
}
if(!function_exists('pn_admin_substrate')){
	function pn_admin_substrate(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_admin_substrate', '1.5', "");
	}
}
if(!function_exists('pn_help')){
	function pn_help(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_help', '1.5', "");
	}
}
if(!function_exists('pn_uploader_ml')){
	function pn_uploader_ml(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_uploader_ml', '1.5', "");
	}
}
if(!function_exists('pn_uploader')){
	function pn_uploader(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_uploader', '1.5', "");
	}
}
if(!function_exists('pn_admin_select_box')){
	function pn_admin_select_box(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_admin_select_box', '1.5', "");
	}
}
if(!function_exists('pn_hidden_input')){
	function pn_hidden_input(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_hidden_input', '1.5', "");
	}
}
if(!function_exists('pn_admin_back_menu')){
	function pn_admin_back_menu(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_admin_back_menu', '1.5', "");
	}
}
if(!function_exists('pn_textareaico_ml')){
	function pn_textareaico_ml(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_textareaico_ml', '1.5', "");
	}
}
if(!function_exists('pn_textareaico')){
	function pn_textareaico(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_textareaico', '1.5', "");
	}
}
if(!function_exists('pn_sort_one_screen')){
	function pn_sort_one_screen(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_sort_one_screen', '1.5', "");
	}
}
if(!function_exists('get_sort_ul')){
	function get_sort_ul(){
		global $premiumbox;
			$premiumbox->_deprecated_function('get_sort_ul', '1.5', "");
	}
}
if(!function_exists('pn_textarea_ml')){
	function pn_textarea_ml(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_textarea_ml', '1.5', "");
	}
}
if(!function_exists('pn_textarea')){
	function pn_textarea(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_textarea', '1.5', "");
	}
}
if(!function_exists('pn_select_search')){
	function pn_select_search(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_select_search', '1.5', "");
	}
}
if(!function_exists('pn_textfield')){
	function pn_textfield(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_textfield', '1.5', "");
	}
}
if(!function_exists('pn_date')){
	function pn_date(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_date', '1.5', "");
	}
}
if(!function_exists('update_directions_to_masschange')){
	function update_directions_to_masschange(){
		global $premiumbox;
			$premiumbox->_deprecated_function('update_directions_to_masschange', '1.5', "");
	}
}
if(!function_exists('pn_checkbox')){
	function pn_checkbox(){
		global $premiumbox;
			$premiumbox->_deprecated_function('pn_checkbox', '1.5', "");
	}
}