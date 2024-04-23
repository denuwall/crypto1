<?php
if( !defined( 'ABSPATH')){ exit(); }

function merchant_temps_script(){
global $premiumbox;

	$time = current_time('timestamp');

	$temp = '
	<script type="text/javascript" src="'. get_premium_url() .'js/jquery.min.js?ver='. $time .'"></script>
	<script type="text/javascript" src="'. get_premium_url() .'js/jquery-ui/script.min.js"></script>
	<script type="text/javascript" src="'. get_premium_url() .'js/clipboard.min.js"></script>
	<script type="text/javascript" src="'. get_premium_url() .'js/jquery.form.js"></script>
	<script type="text/javascript" src="'. get_premium_url() .'js/jcook.js"></script>	
	';
	
	return $temp;
}

function merchant_temps_body_class(){
global $premiumbox;

	$body_class = "";
	if($premiumbox->get_option('exchange','mhead_style') == 1){
		$body_class = "body_black";
	}
	return join(' ',get_body_class($body_class));
}

add_filter('merchant_header', 'def_merchant_header', 10,2);
function def_merchant_header($html, $item){
global $premiumbox;
	
	$item_title1 = pn_strip_input(ctv_ml($item->psys_give)).' '.is_site_value($item->currency_code_give);
	$item_title2 = pn_strip_input(ctv_ml($item->psys_get)).' '.is_site_value($item->currency_code_get);
	$title = sprintf(__('Exchange %1$s to %2$s','pn'),$item_title1,$item_title2);
	
	$logo = get_logotype();
	$textlogo = get_textlogo();
	
	$time = current_time('timestamp');
	
	$html .= '
	<!DOCTYPE html>
	<html '. get_language_attributes( 'html' ) .'>
	<head>

		<meta charset="'. get_bloginfo( 'charset' ) .'">
		<title>'. $title .'</title>
			
		'. merchant_temps_script() .'
		
		<link rel="stylesheet" href="'. $premiumbox->plugin_url .'merchant_style.css?ver='. $time .'" type="text/css" media="all" />

	</head>
	<body class="' . merchant_temps_body_class() . '">
	
	<div class="header">
		<div class="logo">
			<div class="logo_ins">
				<a href="'. get_site_url_ml() .'">';
								
					if($logo){
						$html .= '<img src="'. $logo .'" alt="" />';
					} elseif($textlogo){
						$html .= $textlogo; 
					} else { 
						$textlogo = str_replace(array('http://','https://','www.'),'',get_site_url_or());
						$html .= get_caps_name($textlogo);	
					} 
									
				$html .= '				
				</a>	
			</div>
		</div>
			<div class="clear"></div>
	</div>
	<div class="description">
		'. $title .'
	</div>
	<div class="back_div"><a href="'. get_bids_url($item->hashed) .'" id="back_link">'. __('Back to order page','pn') .'</a></div>

	<div class="content">
	';
	
	return $html;
}

add_filter('merchant_footer', 'def_merchant_footer', 10,2);
function def_merchant_footer($html, $item){
	
	$html .= "
	</div>
		<script type='text/javascript'>
			jQuery(function($){			
				$(document).on('keyup', function( e ){
					if(e.which == 27){
						var nurl = $('a#back_link').attr('href');
						window.location.href = nurl;
					}
				});								
			});
		</script>	
	</body>
	</html>
	";
	
	return $html;
}