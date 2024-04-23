<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]QR code generator[:en_US][ru_RU:]QR код генератор[:ru_RU]
description: [en_US:]QR code generator[:en_US][ru_RU:]QR код генератор[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

add_filter('merchant_footer', 'qr_adress_merchant_footer', 9,3);
function qr_adress_merchant_footer($html, $item, $direction){
global $premiumbox, $wpdb;	
	$key = $direction->m_in;
	$new_html = '';
	$bid = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."exchange_bids WHERE id='{$item->id}'");
	if(isset($bid->to_account)){
		$to_account = pn_strip_input($bid->to_account);
		if(
			strstr($key, 'blockchain') or 
			strstr($key, 'blockio') or 
			strstr($key, 'edinar') or 
			strstr($key, 'btcup') or 
			strstr($key, 'askbtc') or
			strstr($key, 'coinpayments')
		){
			
			$new_html .= '
			<div style="padding: 20px 0; width: 260px; margin: 0 auto;">
				<div id="qr_adress"></div>
			</div>
			
			<script type="text/javascript" src="'. $premiumbox->plugin_url .'moduls/qr_adress/js/jquery-qrcode-0.14.0.min.js"></script>
			<script type="text/javascript">
			jQuery(function($){
				$("#qr_adress").qrcode({
					size: 260,
					text: "'. $to_account .'"
				});
			});
			</script>
			';
		}
	}
	return $new_html.$html;
}	