<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_admin')){
	
	global $premiumbox;
	$premiumbox->include_patch(__FILE__, 'settings');
	$premiumbox->include_patch(__FILE__, 'filters');

}

add_action('wp_dashboard_setup', 'pn_license_wp_dashboard_setup' );
function pn_license_wp_dashboard_setup() {
	return;
	wp_add_dashboard_widget('pn_license_pn_dashboard_widget', __('License Info','pn'), 'pn_dashboard_license_pn_in_admin_panel');
}

function pn_dashboard_license_pn_in_admin_panel(){
global $wpdb;
	return;
	$text = __('No data available','pn');
	$end_time = get_pn_license_time();
	if($end_time){
		$time = current_time('timestamp');
		$cou_days = ceil(($end_time - $time) / 24 / 60 / 60);
		$cou_days = intval($cou_days);
		if($cou_days == 0){
			$text = ' <span class="bred">'. __('License validity period expires today','pn') .'</span>';
		} elseif($cou_days <= 7){
			$text = ' <span class="bred">'.sprintf(__('Days till license expiration date: %s days','pn'), $cou_days).'</span>';
		} else {
			$text = ' '.sprintf(__('Days till license expiration date: %s days','pn'), $cou_days);
		}
	}
	echo $text;
}

add_filter('admin_footer_text', 'pn_admin_footer_text', 1);
function pn_admin_footer_text($text){

	$text .= '<div>&copy; '. get_copy_date('2015') .' <strong>Premium Exchanger</strong>.';
	$end_time = get_pn_license_time();
	$end_time = false;
	if($end_time){
		$time = current_time('timestamp');
		$cou_days = ceil(($end_time - $time) / 24 / 60 / 60);
		$cou_days = intval($cou_days);
		if($cou_days == 0){
			$text .= ' (<span class="bred">'. __('License validity period expires today','pn') .'</span>)';
		} elseif($cou_days <= 7){
			$text .= ' (<span class="bred">'.sprintf(__('Days till license expiration date: %s days','pn'), $cou_days).'</span>)';
		} else {
			$text .= ' ('.sprintf(__('Days till license expiration date: %s days','pn'), $cou_days).')';
		}
	}
	$text .= '</div>';
	
	return $text;
}

if(!function_exists('def_login_headerurl')){
	add_filter('login_headerurl', 'def_login_headerurl');
	function def_login_headerurl($login_header_url){
		$login_header_url = 'https://premiumexchanger.com/';
		return $login_header_url;
	}
}

if(!function_exists('def_login_headertitle')){
	add_filter('login_headertitle', 'def_login_headertitle');
	function def_login_headertitle($login_header_title){
		$login_header_title = 'PremiumExchanger';
		return $login_header_title;
	}
}

if(!function_exists('def_login_head')){
	add_action('login_head','def_login_head');
	function def_login_head(){
		global $premiumbox;		
		?>
		<style>
		.login h1 a {
		height: 108px;
		width: 108px;
		background: url(<?php echo $premiumbox->plugin_url; ?>images/admin-logo.png) no-repeat center center;	
		}
		</style>
	<?php
	}
}