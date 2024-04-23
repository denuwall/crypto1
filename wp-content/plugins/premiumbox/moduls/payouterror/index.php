<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Status "Automatic payout error"[:en_US][ru_RU:]Статус "Ошибка автовыплаты"[:ru_RU]
description: [en_US:]Status "Automatic payout error"[:en_US][ru_RU:]Статус "Ошибка автовыплаты"[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('paymerchant_error', 'payouterror_paymerchant_error', 10, 4);
function payouterror_paymerchant_error($m_id, $error, $item_id, $place){
	$params = array(
		'm_place' => 'modul payouterror',
		'system' => 'system',
		'ap_place' => $place
	);
	the_merchant_bid_status('payouterror', $item_id, $params, 1);	
}