<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Captcha for admin panel[:en_US][ru_RU:]Капча для админ панели[:ru_RU]
description: [en_US:]Captcha for admin panel[:en_US][ru_RU:]Капча для админ панели[:ru_RU]
version: 1.5
category: [en_US:]Security[:en_US][ru_RU:]Безопасность[:ru_RU]
cat: secur
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_adminpanelcaptcha');
function bd_pn_moduls_active_adminpanelcaptcha(){
global $wpdb;	
		
	$table_name = $wpdb->prefix ."adminpanelcaptcha";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`createdate` datetime NOT NULL,
		`sess_hash` varchar(150) NOT NULL,
		`num1` varchar(10) NOT NULL default '0',
		`num2` varchar(10) NOT NULL default '0',
		`symbol` int(2) NOT NULL default '0',
		PRIMARY KEY ( `id` ),
		INDEX (`createdate`),
		INDEX (`sess_hash`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
}

function adminpanelcaptcha_generate_image($word) {
global $premiumbox;

	$word = pn_strip_input($word);

	$fonts = array(
		$premiumbox->plugin_dir . 'moduls/admincaptcha/fonts/GenAI102.TTF',
		$premiumbox->plugin_dir . 'moduls/admincaptcha/fonts/GenAR102.TTF',
		$premiumbox->plugin_dir . 'moduls/admincaptcha/fonts/GenI102.TTF',
		$premiumbox->plugin_dir . 'moduls/admincaptcha/fonts/GenR102.TTF' 
	);

	$wp_upload_dir = wp_upload_dir();
	$path = $wp_upload_dir['basedir'];
	$dir = trailingslashit( $path . '/captcha/' );	
	if(!realpath($dir)){
		@mkdir($dir, 0777);
	}
	
	$filename = '';
	$prefix = time() . mt_rand(1000,1000000);

	if ( $im = imagecreatetruecolor( 50, 50 ) ) {

		$bg = imagecolorallocate( $im, 255, 255, 255 );
		$fg = imagecolorallocate( $im, 0, 0, 0 );
		imagefill( $im, 0, 0, $bg );

		$font = $fonts[array_rand( $fonts )];
		imagettftext($im, 30, 0, mt_rand(0,30), mt_rand(30,40) , $fg, $font, $word );

		$filename = sanitize_file_name( $prefix . '.png' );
		$link = $dir . $filename;
		imagepng( $im, $link );

		imagedestroy( $im );
				
	}

	return $wp_upload_dir['baseurl'] . '/captcha/'. $filename;
}

function acp_del_img(){	
global $wpdb;

	$time = current_time('timestamp') - (1*24*60*60);
	$date = date('Y-m-d H:i:s', $time);
	$wpdb->query("DELETE FROM ".$wpdb->prefix."adminpanelcaptcha WHERE createdate < '$date'");	
	
	$wp_upload_dir = wp_upload_dir();
	$path = $wp_upload_dir['basedir'];
    $dir = trailingslashit( $path . '/captcha/' );
    if(is_array(glob("$dir*"))){
        foreach (glob("$dir*") as $filename) {
	        if(is_file($filename)){
			    @unlink($filename);
			}
        }
    }
}

add_filter('list_cron_func', 'adminpanelcaptcha_list_cron_func');
function adminpanelcaptcha_list_cron_func($filters){
	$filters['acp_del_img'] = array(
		'title' => __('Deleting admin captcha','pn'),
		'site' => '10min',
	);
	return $filters;
}

add_action('login_enqueue_scripts', 'adminpanelcaptcha_login_enqueue_scripts');
function adminpanelcaptcha_login_enqueue_scripts(){

	wp_deregister_script('jquery');
    wp_register_script('jquery', get_premium_url() .'js/jquery.min.js', false, '3.2.1');
    wp_enqueue_script('jquery');
	
}

function adminpanelcaptcha_reload(){
global $wpdb, $premiumbox;
	
	$sess_hash = get_session_id();
	$wpdb->query("DELETE FROM ".$wpdb->prefix."adminpanelcaptcha WHERE sess_hash = '$sess_hash'");
	
	$admin_panel_captcha = intval($premiumbox->get_option('admin_panel_captcha'));
	
	$array = array();
	$array['sess_hash'] = $sess_hash;
	$array['createdate'] = current_time('mysql');
	$array['num1'] = mt_rand(1,9);
	$array['num2'] = mt_rand(0,9);
	if($admin_panel_captcha == 1){
		$array['symbol'] = $symbol = mt_rand(0,2);
	} else {
		$array['symbol'] = $symbol = 0;
	}
	$wpdb->insert($wpdb->prefix.'adminpanelcaptcha', $array);
	$array['id'] = $wpdb->insert_id;
	$array['img1'] = adminpanelcaptcha_generate_image($array['num1']);
	$array['img2'] = adminpanelcaptcha_generate_image($array['num2']);	
		
	$symbols = array('+','-','x');

	$array['nsymb'] = is_isset($symbols, $symbol);	
	
	return (object)$array;	
}

add_action('premium_action_adminpanelcaptcha_reload', 'the_premium_action_adminpanelcaptcha_reload');
function the_premium_action_adminpanelcaptcha_reload(){
global $wpdb;

	only_post();
	
	$log = array();
	$log['status'] = 'success';
	$log['status_text'] = '';
	$log['status_code'] = 0;

	$data = adminpanelcaptcha_reload();
	if(isset($data->id)){
		$num1 = intval($data->num1);
		$num2 = intval($data->num2);
		$img1 = $data->img1;
		$img2 = $data->img2;
		$nsymb = $data->nsymb;		
	} else {
		$num1 = 0;
		$num2 = 0;
		$img1 = adminpanelcaptcha_generate_image('0');
		$img2 = adminpanelcaptcha_generate_image('0');
		$nsymb = '+';		
	}

	$log['ncapt1'] = $img1;
	$log['ncapt2'] = $img2;
	$log['nsym'] = $nsymb;

	echo json_encode($log);	
	exit;
}

add_action('login_footer','adminpanelcaptcha_login_footer');
add_action('newadminpanel_form_footer', 'adminpanelcaptcha_login_footer');
function adminpanelcaptcha_login_footer(){
	?>
<script type="text/javascript">	
jQuery(function($) {	 

	$(document).on('click', '.rlc_reload', function(){
		var dataString='have=reload';
		$.ajax({
		type: "POST",
		url: "<?php pn_the_link_post('adminpanelcaptcha_reload'); ?>",
		dataType: 'json',
		data: dataString,
		error: function(res,res2,res3){
			<?php do_action('pn_js_error_response', 'ajax'); ?>
		},		
		success: function(res)
		{
			if(res['ncapt1']){
				$('.captcha1').attr('src',res['ncapt1']);
			}
			if(res['ncapt2']){
				$('.captcha2').attr('src',res['ncapt2']);
			}	
			if(res['nsym']){
				$('.captcha_sym').html(res['nsym']);
			}
		}
		});
		
		return false;
	});
		
});	
</script>
<style>
.rlc_div{
margin: 0 0 10px 0;
}
	.rlc_divimg{
	float: left;
	width: 50px;
	height: 50px!important;
	border: 1px solid #ddd;
	}
	.rlc_divznak{
	float: left;
	width: 30px;
	height: 50px;
	font: 30px/50px Arial;
	text-align: center;
	}
	input.rlc_divpole{
	float: left;
	width: 80px!important;
	height: 52px!important;
	font-size: 30px!important;
	margin: 0!important;
	text-align: center;
	}
	.rlc_div_change{
	padding: 0 0 10px 0;
	}
	
.clear{ clear: both; }	
</style>
	<?php
}

add_action('ajax_post_form_jsresult','ajax_post_form_jsresult_adminpanelcaptcha');
function ajax_post_form_jsresult_adminpanelcaptcha($place='site'){
	if($place == 'admin'){
?>
	if(res['ncapt1']){
		$('.captcha1').attr('src',res['ncapt1']);
	}
	if(res['ncapt2']){
		$('.captcha2').attr('src',res['ncapt2']);
	}
	if(res['nsym']){
		$('.captcha_sym').html(res['nsym']);
	}	
<?php	
	}
} 

add_action('login_form', 'adminpanelcaptcha_login_form' );
add_action('newadminpanel_form', 'adminpanelcaptcha_login_form');
function adminpanelcaptcha_login_form(){ 
global $wpdb;

	$temp = '';

	$data = adminpanelcaptcha_reload();
	if(isset($data->id)){
		$num1 = intval($data->num1);
		$num2 = intval($data->num2);
		$img1 = $data->img1;
		$img2 = $data->img2;
		$nsymb = $data->nsymb;
	} else {
		$num1 = 0;
		$num2 = 0;		
		$img1 = adminpanelcaptcha_generate_image('0');
		$img2 = adminpanelcaptcha_generate_image('0');
		$nsymb = '+';
	}
	
	$temp = '
		<div class="rlc_div">
			<div class="rlc_divimg">
				<img src="'. $img1 .'" class="captcha1" alt="" />
			</div>
			<div class="rlc_divznak">
				<span class="captcha_sym">'. $nsymb .'</span>
			</div>	
			<div class="rlc_divimg">
				<img src="'. $img2 .'" class="captcha2" alt="" />
			</div>
			<div class="rlc_divznak">
				=
			</div>

			<input type="text" class="rlc_divpole" name="number" maxlength="4" autocomplete="off" value="" />
			
				<div class="clear"></div>
		</div>
		<div class="rlc_div_change">
			<a href="#" class="rlc_reload">'. __('replace task','pn') .'</a>
		</div>
	';
	
	echo $temp;
}

add_filter('authenticate', 'adminpanelcaptcha_login_check', 50, 1);
function adminpanelcaptcha_login_check($user){
global $wpdb;

	if(isset($_POST['log'], $_POST['pwd'])){

		$number = '';
		if(isset($_POST['number'])){
			$number = trim($_POST['number']);
		
			$sess_hash = get_session_id();
			$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."adminpanelcaptcha WHERE sess_hash='$sess_hash'");
			if(isset($data->id)){
					
				$num1 = $data->num1;
				$num2 = $data->num2;
				$symbol = intval($data->symbol);
				if($symbol == 0){
					$sum = $num1+$num2;
				} elseif($symbol == 1){
					$sum = $num1-$num2;
				} else {
					$sum = $num1*$num2;
				}
				if($number == $sum){
					
					return $user;
					
				} else {
					$error = new WP_Error();
					$error->add( 'pn_error', __('<strong>Error:</strong> You have not entered test number.','pn') );
					wp_clear_auth_cookie();
					return $error;			
				}
				
			} else {
				$error = new WP_Error();
				$error->add( 'pn_error', __('<strong>Error:</strong> You have not entered test number.','pn') );
				wp_clear_auth_cookie();
				return $error;				
			}
		} else {
			$error = new WP_Error();
			$error->add( 'pn_error', __('<strong>Error:</strong> You have not entered test number.','pn') );
			wp_clear_auth_cookie();
			return $error;
		}
	
	} else {
		return $user;
	}
}	

add_filter('premium_auth', 'adminpanelcaptcha_premium_auth', 10, 3);
function adminpanelcaptcha_premium_auth($log, $user, $place='site'){
	
	if(is_wp_error($user) and $place == 'admin'){

		$data = adminpanelcaptcha_reload();
		if(isset($data->id)){
			$num1 = intval($data->num1);
			$num2 = intval($data->num2);
			$img1 = $data->img1;
			$img2 = $data->img2;
			$nsymb = $data->nsymb;			
		} else {
			$num1 = 0;
			$num2 = 0;
			$img1 = adminpanelcaptcha_generate_image('0');
			$img2 = adminpanelcaptcha_generate_image('0');
			$nsymb = '+';
		}

		$log['ncapt1'] = $img1;
		$log['ncapt2'] = $img2;
		$log['nsym'] = $nsymb;		
	
	}
	
	return $log;
}

add_filter('newadminpanel_ajax_form', 'adminpanelcaptcha_newadminpanel_ajax_form');
function adminpanelcaptcha_newadminpanel_ajax_form($log){
global $wpdb;

	$error = 0;

	$number = trim(is_param_post('number'));
	$sess_hash = get_session_id();
	$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."adminpanelcaptcha WHERE sess_hash='$sess_hash'");
	if(isset($data->id)){		
		$num1 = $data->num1;
		$num2 = $data->num2;
		$symbol = intval($data->symbol);
		if($symbol == 0){
			$sum = $num1+$num2;
		} elseif($symbol == 1){
			$sum = $num1-$num2;
		} else {
			$sum = $num1*$num2;
		}
		if($number != $sum){
			$error = 1;			
		}	
	} else {
		$error = 1;				
	}
	
	if($error == 1){
		$data = adminpanelcaptcha_reload();
		if(isset($data->id)){
			$num1 = intval($data->num1);
			$num2 = intval($data->num2);
			$img1 = $data->img1;
			$img2 = $data->img2;
			$nsymb = $data->nsymb;			
		} else {
			$num1 = 0;
			$num2 = 0;
			$img1 = adminpanelcaptcha_generate_image('0');
			$img2 = adminpanelcaptcha_generate_image('0');
			$nsymb = '+';
		}

		$log['ncapt1'] = $img1;
		$log['ncapt2'] = $img2;
		$log['nsym'] = $nsymb;		
		
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('<strong>Error:</strong> You have not entered test number.','pn');	
		echo json_encode($log);
		exit;		
	}
	
	return $log;
}

add_filter('pn_config_option', 'adminpanelcaptcha_config_option');
function adminpanelcaptcha_config_option($options){
global $premiumbox;
		
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['admin_panel_captcha'] = array(
		'view' => 'select',
		'title' => __('Admin panel captcha', 'pn'),
		'options' => array('0'=> __('only numbers addition','pn'), '1'=> __('all mathematical actions with numbers','pn')),
		'default' => $premiumbox->get_option('admin_panel_captcha'),
		'name' => 'admin_panel_captcha',
		'work' => 'input',
	);
		
	return $options;
}

add_action('pn_config_option_post', 'adminpanelcaptcha_config_option_post');
function adminpanelcaptcha_config_option_post($data){
global $premiumbox;
	
	$admin_panel_captcha = intval($data['admin_panel_captcha']);
	$premiumbox->update_option('admin_panel_captcha','', $admin_panel_captcha);
		
}