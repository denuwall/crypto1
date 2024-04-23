<?php 
if( !defined( 'ABSPATH')){ exit(); }

add_filter('mobile_template_not_found', 'theme_mobile_template_not_found', 10, 3);
function theme_mobile_template_not_found($template, $not_template, $mobile_dir){
	
	$temp_part = explode('/', $not_template);
	$not = end($temp_part);
	if($not == 'pn-whitepage.php' or $not == 'pn-notsidebar.php'){
		return $mobile_dir.'page.php';
	}
	
	return $template;
}

if(function_exists('is_mobile') and is_mobile()){
	remove_action('wp_footer','statuswork_wp_footer');
	remove_action('siteplace_js','siteplace_js_zreserv');
	remove_action('wp_footer','wp_footer_zreserv');	
	remove_action('siteplace_js','siteplace_js_exchange_widget');
	remove_action('live_change_html','js_select_live');
	
	add_filter('before_plinks_page', 'mobile_page_title'); 
	add_filter('before_preferals_page', 'mobile_page_title');
	add_filter('before_payouts_page', 'mobile_page_title');
	add_filter('before_sitemap_page', 'mobile_page_title');
	add_filter('before_tarifs_page', 'mobile_page_title');
	add_filter('before_pexch_page', 'mobile_page_title');
	add_filter('before_userxch_page', 'mobile_page_title');
	add_filter('before_userverify_page', 'mobile_page_title');
	add_filter('before_promotional_page', 'mobile_page_title');
	add_filter('before_exchange_page', 'mobile_page_title_exchange');
	add_filter('before_exchangestep_page', 'mobile_page_title_exchange');	
	
	add_filter('before_one_tarifs_block','mobile_before_one_tarifs_block');
	add_filter('after_one_tarifs_block','mobile_after_one_tarifs_block');
	add_filter('one_tarifs_line','mobile_one_tarifs_line', 10, 7);

	add_filter('before_userverify_textform','mobile_before_one_tarifs_block');
	add_filter('after_userverify_textform','mobile_before_one_tarifs_block');	
	
	add_filter('lists_plinks', 'mobile_lists_table', 0);
	add_filter('lists_preferals', 'mobile_lists_table', 0);
	add_filter('lists_payouts', 'mobile_lists_table', 0);
	add_filter('lists_pexch', 'mobile_lists_table', 0);
	add_filter('lists_userxch', 'mobile_lists_table', 0);
	add_filter('lists_userverify', 'mobile_lists_table', 0);
	
	add_filter('body_list_payouts', 'mobile_body_list_payouts', 0, 6);	
}

function mobile_page_title(){
	$html = '<h1 class="page_wrap_title">'. get_the_title() .'</h1>';
	return $html;
}

function mobile_page_title_exchange(){
	if(function_exists('is_exchange_page') and is_exchange_page()) {
		$html = '<h1 class="page_wrap_title" id="the_title_page">'. get_exchange_title() .'</h1>';
		return $html;		
	} elseif(function_exists('is_exchangestep_page') and is_exchangestep_page()){
		$html = '<h1 class="page_wrap_title" id="the_title_page">'. get_exchangestep_title() .'</h1>';
		return $html;
	}	
}

function mobile_one_tarifs_line($html, $tar, $curs1, $curs2, $reserv, $vd1, $vd2){
	
	$html = '
	<a href="'. get_exchange_link($tar->direction_name) .'" class="one_tarif_line">
		<div class="tarif_curs_one give">
			<div class="tarif_curs_image">
				<div class="tarif_curs_logo" style="background: url('. get_currency_logo($vd1) .') no-repeat center center;"></div>
			</div>
			<div class="tarif_curs_vtype">
				'. get_currency_title($vd1) .'
			</div>
			<div class="tarif_curs_sum">
				'. $curs1 .'&nbsp;'. is_site_value($vd1->currency_code_title) .'
			</div>
		</div>
		<div class="tarif_curs_one">
			<div class="tarif_curs_image">
				<div class="tarif_curs_logo" style="background: url('. get_currency_logo($vd2) .') no-repeat center center;"></div>
			</div>
			<div class="tarif_curs_vtype">
				'. get_currency_title($vd2) .'
			</div>
			<div class="tarif_curs_sum">
				'. $curs2 .'&nbsp;'. is_site_value($vd2->currency_code_title) .'
			</div>
		</div>		
			<div class="clear"></div>
		<div class="tarif_curs_reserv">'. __('Reserve','pn') .': '. $reserv .' '. get_currency_title($vd2) .'</div>
	</a>
	';
	
	return $html;
}

function mobile_before_one_tarifs_block($html){
	return '';
}

function mobile_after_one_tarifs_block($html){
	return '';
}

function mobile_lists_table($lists){
	$lists['before'] = ''; 
	$lists['after'] = '';
	$lists['before_head'] = '';
	$lists['after_head'] = '';
	$lists['head_line'] = '';
	$lists['before_body'] = '';
	$lists['after_body'] = '';
	$lists['noitem'] = '<div class="no_items"><div class="no_items_ins">[title]</div></div>';
	$lists['body_line'] = '<div class="one_item [odd_even]">[html]</div>';
	$lists['lists']['del_status'] = __('Apply','pntheme');
	$lists['body_item'] = '
	<div class="one_item_line">
		<span class="one_item_label">[title]:</span>
		<span class="one_item_content">[content]</span>
	</div>
	';
	return $lists;
}

function mobile_body_list_payouts($data_item, $item, $key, $title, $date_format, $time_format){

	if($key == 'pay_account'){
		$valut_title = pn_strip_input(ctv_ml($item->psys_title));
		$data_item = '<span class="ptvaluts">'. $valut_title .'</span> ('. pn_strip_input($item->pay_account).')';
	}
	if($key == 'pay_status'){
		$status = get_payuot_status($item->status);
		$pst = $item->status + 1;	
		$data_item = '<span class="paystatus pst'. $pst .'">'. $status .'</span>'; 
	}
	
	return $data_item;
}