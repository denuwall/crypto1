<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Captcha for website[:en_US][ru_RU:]Капча для сайта[:ru_RU]
description: [en_US:]Captcha for website[:en_US][ru_RU:]Капча для сайта[:ru_RU]
version: 1.5
category: [en_US:]Security[:en_US][ru_RU:]Безопасность[:ru_RU]
cat: secur
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_captcha');
function bd_pn_moduls_active_captcha(){
global $wpdb;	
		
	$table_name = $wpdb->prefix ."captcha";
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

add_filter('captcha_settings', 'captcha_settings_sitecaptcha');
function captcha_settings_sitecaptcha($ind){
	return 1;
}

function captcha_generate_image($word) {
global $premiumbox;

	$word = pn_strip_input($word);

	$fonts = array(
		$premiumbox->plugin_dir . 'moduls/captcha/fonts/GenAI102.TTF',
		$premiumbox->plugin_dir . 'moduls/captcha/fonts/GenAR102.TTF',
		$premiumbox->plugin_dir . 'moduls/captcha/fonts/GenI102.TTF',
		$premiumbox->plugin_dir . 'moduls/captcha/fonts/GenR102.TTF' 
	);
	$fonts = apply_filters('pn_sc_fonts', $fonts);

	$wp_upload_dir = wp_upload_dir();
	$path = $wp_upload_dir['basedir'];
	$dir = trailingslashit( $path . '/captcha/' );	
	if(!realpath($dir)){
		@mkdir($dir, 0777);
	}
	
	$filename = '';
	$prefix = time() . mt_rand(1000,1000000);

	if ( $im = imagecreatetruecolor( 50, 50 ) ) {

		$bgcolor = apply_filters('pn_sc_bgcolor', array('255','255','255'));
		$bg = imagecolorallocate( $im, $bgcolor[0], $bgcolor[1], $bgcolor[2]);
		
		$color = apply_filters('pn_sc_color', array('67','67','67'));
		$fg = imagecolorallocate( $im, $color[0], $color[1], $color[2] );
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

function captcha_del_img(){	
global $wpdb;

	$time = current_time('timestamp') - (24*60*60);
	$date = date('Y-m-d H:i:s', $time);
	$wpdb->query("DELETE FROM ".$wpdb->prefix."captcha WHERE createdate < '$date'");	
	
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

add_filter('list_cron_func', 'captcha_list_cron_func');
function captcha_list_cron_func($filters){
	$filters['captcha_del_img'] = array(
		'title' => __('Deleting captcha','pn'),
		'site' => '10min',
	);
	return $filters;
}

add_action('ajax_post_form_jsresult','ajax_post_form_jsresult_captcha');
function ajax_post_form_jsresult_captcha($place='site'){
	if($place == 'site'){
?>
	if(res['ncapt1']){
		$('.captcha1').attr('src',res['ncapt1']);
	}
	if(res['ncapt2']){
		$('.captcha2').attr('src',res['ncapt2']);
	}
	if(res['nsymb']){
		$('.captcha_sym').html(res['nsymb']);
	}	
<?php	
	}
}

add_action('siteplace_js','siteplace_js_captcha');
function siteplace_js_captcha(){
?>
jQuery(function($){ 
	$(document).on('click', '.captcha_reload', function(){
		
		var thet = $(this);
		thet.addClass('act');
		
		var dataString='have=reload';
		$.ajax({
		type: "POST",
		url: "<?php echo get_ajax_link('captcha_reload'); ?>",
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
			if(res['nsymb']){
				$('.captcha_sym').html(res['nsymb']);
			}			
			
			thet.removeClass('act');
		}
		});
		
		return false;
	});
});	
<?php	
}

add_action('init', 'captcha_init');
function captcha_init(){
global $wpdb;
	
	$sess_hash = get_session_id();
	$cc = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."captcha WHERE sess_hash = '$sess_hash'");
	if($cc == 0){
	
		$array = array();
		$array['sess_hash'] = $sess_hash;
		$array['createdate'] = current_time('mysql');
		$array['num1'] = mt_rand(1,9);
		$array['num2'] = mt_rand(0,9);
		$array['symbol'] = mt_rand(0,2);
		$wpdb->insert($wpdb->prefix.'captcha', $array);

	}
}

function captcha_reload(){
global $wpdb, $premiumbox;
	$data = array();

	$sess_hash = get_session_id();
	$wpdb->query("DELETE FROM ".$wpdb->prefix."captcha WHERE sess_hash = '$sess_hash'");
	
	$site_captcha = intval($premiumbox->get_option('site_captcha'));
	
	$array = array();
	$array['sess_hash'] = $sess_hash;
	$array['createdate'] = current_time('mysql');
	$array['num1'] = mt_rand(1,9);
	$array['num2'] = mt_rand(0,9);
	if($site_captcha == 1){
		$array['symbol'] = $symbol = mt_rand(0,2);
	} else {
		$array['symbol'] = $symbol = 0;
	}
	$wpdb->insert($wpdb->prefix.'captcha', $array);
	
	$array['id'] = $wpdb->insert_id;
	$array['img1'] = captcha_generate_image($array['num1']);
	$array['img2'] = captcha_generate_image($array['num2']);	
		
	$symbols = array('+','-','x');

	$array['nsymb'] = is_isset($symbols, $symbol);
	
	return (object)$array;	
}

add_action('myaction_site_captcha_reload', 'the_myaction_site_captcha_reload');
function the_myaction_site_captcha_reload(){
global $premiumbox;	

	only_post();
	
	$log = array();
	$log['status'] = 'success';
	$log['status_text'] = '';
	$log['status_code'] = 0;
	
	$premiumbox->up_mode();
	
	$data = captcha_reload();
	if(isset($data->id)){
		$num1 = intval($data->num1);
		$num2 = intval($data->num2);
		$img1 = $data->img1;
		$img2 = $data->img2;
		$nsymb = $data->nsymb;		
	} else {
		$num1 = 0;
		$num2 = 0;
		$img1 = captcha_generate_image('0');
		$img2 = captcha_generate_image('0');
		$nsymb = '+';		
	}
	
	$log['ncapt1'] = $img1;
	$log['ncapt2'] = $img2;
	$log['nsymb'] = $nsymb;	

	echo json_encode($log);
	exit;
}

add_filter('premium_auth', 'captcha_premium_auth', 10, 3);
function captcha_premium_auth($log, $user, $place='site'){
	
	if(is_wp_error($user) and $place == 'site'){

		$data = captcha_reload();
		if(isset($data->id)){
			$num1 = intval($data->num1);
			$num2 = intval($data->num2);
			$img1 = $data->img1;
			$img2 = $data->img2;
			$nsymb = $data->nsymb;			
		} else {
			$num1 = 0;
			$num2 = 0;
			$img1 = captcha_generate_image('0');
			$img2 = captcha_generate_image('0');
			$nsymb = '+';
		}

		$log['ncapt1'] = $img1;
		$log['ncapt2'] = $img2;
		$log['nsymb'] = $nsymb;		
	
	}
	
	return $log;
}

add_filter('exchange_step1', 'exchange_form_captcha');
function exchange_form_captcha($line){
global $wpdb, $premiumbox;

	if($premiumbox->get_option('captcha','exchangeform') == 1){
		$sess_hash = get_session_id();
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."captcha WHERE sess_hash='$sess_hash'");
		if(isset($data->id)){
			$num1 = $data->num1;
			$num2 = $data->num2;
			$symbol = intval($data->symbol);
		} else {
			$num1 = 1;
			$num2 = 2;
			$symbol = 0;
		}
		
		$symbols = array('+','-','x');	
			
		$img1 = captcha_generate_image($num1);
		$img2 = captcha_generate_image($num2);

		$line .= get_captcha_temp($img1,$img2, is_isset($symbols, $symbol));
	}
	
	return $line;	
}

add_filter('get_form_filelds','get_form_filelds_captcha', 10, 2);
function get_form_filelds_captcha($items, $name){
global $premiumbox;	
	if($premiumbox->get_option('captcha',$name) == 1){
		$items['captcha'] = array(
			'type' => 'captcha',
		);
	}
	return $items;
}

add_filter('form_field_line','form_field_line_captcha', 10, 3);
function form_field_line_captcha($line, $filter, $data){
global $wpdb;	
	
	$type = trim(is_isset($data, 'type'));
	if($type == 'captcha'){
	
		$sess_hash = get_session_id();
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."captcha WHERE sess_hash='$sess_hash'");
		if(isset($data->id)){
			$num1 = $data->num1;
			$num2 = $data->num2;
			$symbol = intval($data->symbol);
		} else {
			$num1 = 1;
			$num2 = 2;
			$symbol = 0;
		}
		
		$symbols = array('+','-','x');
		
		$img1 = captcha_generate_image($num1);
		$img2 = captcha_generate_image($num2);

		$line = get_captcha_temp($img1,$img2, is_isset($symbols, $symbol));	
	
	}
	
	return $line;
}

function get_captcha_temp($img1,$img2,$symbol=''){
	$symbol = trim($symbol);
	if(!$symbol){ $symbol = '+'; }
	
	$temp = '
	<div class="captcha_div">
		<div class="captcha_title">
			'. __('Type your answer','pn') .'
		</div>
		<div class="captcha_body">
			<div class="captcha_divimg">
				<img src="'. $img1 .'" class="captcha1" alt="" />
			</div>
			<div class="captcha_divznak">
				<span class="captcha_sym">'. $symbol .'</span>
			</div>	
			<div class="captcha_divimg">
				<img src="'. $img2 .'" class="captcha2" alt="" />
			</div>
			<div class="captcha_divznak">
				=
			</div>
			<input type="text" class="captcha_divpole" name="number" maxlength="4" autocomplete="off" value="" />
			<a href="#" class="captcha_reload" title="'. __('replace task','pn') .'"></a>
				<div class="clear"></div>
		</div>
	</div>		
	';
	
	$temp = apply_filters('get_captcha_temp', $temp, $img1, $img2, $symbol);
	
	return $temp;
}

add_filter('before_ajax_form_field','before_ajax_form_field_captcha', 99, 2);
function before_ajax_form_field_captcha($logs, $name){
global $premiumbox, $wpdb;	

	if($premiumbox->get_option('captcha',$name) == 1){
		
		$number = trim(is_param_post('number'));	
		$sess_hash = get_session_id();
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."captcha WHERE sess_hash='$sess_hash'");
		$data_new = captcha_reload();
		
		$logs['ncapt1'] = $data_new->img1;
		$logs['ncapt2'] = $data_new->img2;
		$logs['nsymb'] = $data_new->nsymb;
		
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
					
				$logs['status']	= 'error';
				$logs['status_code'] = '-3'; 
				$logs['status_text'] = __('Error! You have entered an incorrect number','pn');
				echo json_encode($logs);
				exit;
				
			}
					
		} else {
			$logs['status']	= 'error';
			$logs['status_code'] = '-3';
			$logs['status_text'] = __('Error! You have entered an incorrect number','pn');
			echo json_encode($logs);
			exit;
		}	
		
	}
	
	return $logs;
}

add_filter('pn_config_option', 'sitecaptcha_config_option');
function sitecaptcha_config_option($options){
global $premiumbox;
		
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['site_captcha'] = array(
		'view' => 'select',
		'title' => __('Website captcha', 'pn'),
		'options' => array('0'=> __('only numbers addition','pn'), '1'=> __('all mathematical actions with numbers','pn')),
		'default' => $premiumbox->get_option('site_captcha'),
		'name' => 'site_captcha',
		'work' => 'input',
	);
	if(isset($options['bottom_title'])){
		unset($options['bottom_title']);
	}
	$options['bottom_title'] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);	
		
	return $options;
}

add_action('pn_config_option_post', 'sitecaptcha_config_option_post');
function sitecaptcha_config_option_post($data){
global $premiumbox;
	
	$site_captcha = intval($data['site_captcha']);
	$premiumbox->update_option('site_captcha','', $site_captcha);
		
}