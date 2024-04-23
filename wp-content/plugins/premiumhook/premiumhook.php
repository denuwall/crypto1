<?php 
/*
Plugin Name: Premium Exchanger hooks
Plugin URI: http://best-curs.info
Description: Actions and filters
Version: 0.1
Author: Best-Curs.info
Author URI: http://best-curs.info
*/

if( !defined( 'ABSPATH')){ exit(); }

add_action('wp_footer','my_wp_footer'); 
function my_wp_footer(){
?>

<!-- Put online chat code or another code here / Razmestite kod onlajn chata ili drugoi kod vmesto jetogo teksta !-->

<?php
}

add_filter('general_tech_pages', 'nonnpod_general_tech_pages');
function nonnpod_general_tech_pages($g_pages){
	$g_pages['exchange'] = 'exchange-';
	return $g_pages;
}

add_filter('direction_premalink_temp', 'nonnpod_naps_premalink_temp');
function nonnpod_naps_premalink_temp($temp){
	$temp = '[xmlv1]-to-[xmlv2]';
	return $temp;
}

add_filter('is_direction_premalink', 'nonnpod_is_naps_premalink', 10, 2);
function nonnpod_is_naps_premalink($new_name, $name){
	$new_name = '';
	$new_name = replace_cyr($name);
	$new_name = preg_replace("/[^A-Za-z0-9-]/", '_', $new_name);	
	return $new_name;
}

add_filter('is_direction_name', 'nonnpod_is_naps_chpu', 10, 2);
function nonnpod_is_naps_chpu($new_name, $name){
	$new_name = '';
	if (preg_match("/^[-a-zA-z0-9_]{1,500}$/", $name, $matches )) {
		$new_name = $name;
	} else {
		$new_name = '';
	}	
	return $new_name;
}

remove_action('pn_adminpage_head','pn_adminpage_head_security', 11);


add_filter('get_pn_parser','get_pn_parser_bitfinex');
function get_pn_parser_bitfinex($parsers){
	
	$newparsers = array(
		'700' => array(
			'title' => 'BTC - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'701' => array(
			'title' => 'USD - BTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'702' => array(
			'title' => 'LTC - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'703' => array(
			'title' => 'USD - LTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'704' => array(
			'title' => 'LTC - BTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),	
		'705' => array(
			'title' => 'BTC - LTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'706' => array(
			'title' => 'ETH - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'707' => array(
			'title' => 'USD - ETH',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'708' => array(
			'title' => 'ETH - BTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'709' => array(
			'title' => 'BTC - ETH',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'710' => array(
			'title' => 'ETC - BTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),	
		'711' => array(
			'title' => 'BTC - ETC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'712' => array(
			'title' => 'ETC - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'713' => array(
			'title' => 'USD - ETC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'714' => array(
			'title' => 'XMR - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'715' => array(
			'title' => 'USD - XMR',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'716' => array(
			'title' => 'XRP - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'717' => array(
			'title' => 'USD - XRP',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'718' => array(
			'title' => 'BCH - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'719' => array(
			'title' => 'USD - BCH',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'720' => array(
			'title' => 'BCC - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),
		'721' => array(
			'title' => 'USD - BCC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'722' => array(
			'title' => 'BCU - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),	
		'723' => array(
			'title' => 'USD - BCU',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'724' => array(
			'title' => 'DSH - USD',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),	
		'725' => array(
			'title' => 'USD - DSH',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1000,
		),
		'726' => array(
			'title' => 'DSH - BTC',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 100,
		),	
		'727' => array(
			'title' => 'BTC - DSH',
			'birg' => __('Bitfinex','pn'),
			'data' => array('mid','bid','ask','last_price','low','high'),
			'curs' => 1,
		),		
	);	
	foreach($newparsers as $key => $data){
		$parsers[$key] = $data;
	}
	
	return $parsers;
}

add_filter('before_load_curs_parser','before_load_curs_parser_bitfinex', 10, 4);
function before_load_curs_parser_bitfinex($curs_parser, $work_parser='', $config_parser='', $parsers=''){
	
	if(!is_array($parsers)){
		$parsers = apply_filters('get_pn_parser', array());
	}
	
	$arrs = array(
		'BTCUSD' => array(
			'id1' => 700,
			'sum1' => 1,
			'id2' => 701,
			'sum2' => 1000,			
		),
		'LTCUSD' => array(
			'id1' => 702,
			'sum1' => 1,
			'id2' => 703,
			'sum2' => 1000,			
		),
		'LTCBTC' => array(
			'id1' => 704,
			'sum1' => 1,
			'id2' => 705,
			'sum2' => 1,			
		),
		'ETHUSD' => array(
			'id1' => 706,
			'sum1' => 1,
			'id2' => 707,
			'sum2' => 1000,			
		),
		'ETHBTC' => array(
			'id1' => 708,
			'sum1' => 1,
			'id2' => 709,
			'sum2' => 1,			
		),
		'ETCBTC' => array(
			'id1' => 710,
			'sum1' => 1000,
			'id2' => 711,
			'sum2' => 1,			
		),
		'ETCUSD' => array(
			'id1' => 712,
			'sum1' => 1,
			'id2' => 713,
			'sum2' => 1000,			
		),
		'XMRUSD' => array(
			'id1' => 714,
			'sum1' => 1,
			'id2' => 715,
			'sum2' => 1000,			
		),
		'XRPUSD' => array(
			'id1' => 716,
			'sum1' => 1,
			'id2' => 717,
			'sum2' => 1,			
		),		
		'BCHUSD' => array(
			'id1' => 718,
			'sum1' => 1,
			'id2' => 719,
			'sum2' => 1000,			
		),
		'BCCUSD' => array(
			'id1' => 720,
			'sum1' => 1,
			'id2' => 721,
			'sum2' => 1000,			
		),
		'BCUUSD' => array(
			'id1' => 722,
			'sum1' => 1,
			'id2' => 723,
			'sum2' => 1000,			
		),	
		'DSHUSD' => array(
			'id1' => 724,
			'sum1' => 1,
			'id2' => 725,
			'sum2' => 1000,			
		),	
		'DSHBTC' => array(
			'id1' => 726,
			'sum1' => 100,
			'id2' => 727,
			'sum2' => 1,			
		),		
	);

	$curl = get_curl_parser('https://api.bitfinex.com/v1/tickers?symbols', '', 'parser', 'bitfinex');
	if(!$curl['err']){
		$outs = @json_decode($curl['output']);
		if(is_array($outs)){
			foreach($arrs as $arr_id => $arr_data){
				foreach($outs as $item){
					if(isset($item->pair) and $item->pair == $arr_id){
						$id1 = intval(is_isset($arr_data, 'id1'));
						$sum1 = intval(is_isset($arr_data, 'sum1'));
						$id2 = intval(is_isset($arr_data, 'id2'));
						$sum2 = intval(is_isset($arr_data, 'sum2'));					
						
						if(is_isset($work_parser, $id1) == 1){
							$key1 = trim(is_isset($config_parser, $id1));
							if(!$key1){ $key1 = 'mid'; }
							$ck1 = is_my_money($item->$key1);
							$curs1 = def_parser_curs($parsers, $id1, $sum1);
							if($ck1){
								$curs_parser[$id1]['curs1'] = $curs1;
								$curs_parser[$id1]['curs2'] = $ck1 * $curs1;
							}
						}
						if(is_isset($work_parser, $id2) == 1){
							$key2 = trim(is_isset($config_parser, $id2));
							if(!$key2){ $key2 = 'mid'; }
							$ck2def = is_my_money($item->$key2); 
							$curs2 = def_parser_curs($parsers, $id2, $sum2);
							if($curs2 and $ck2def){
								$ck2 = is_my_money($curs2 / $ck2def);
								$curs_parser[$id2]['curs1'] = $curs2; 
								$curs_parser[$id2]['curs2'] = $ck2;
							}						
						}					
					}
				}
			}	
		} 
	}	
	
	return $curs_parser;
}

add_filter('get_pn_parser','get_pn_parser_exmo');
function get_pn_parser_exmo($parsers){
	
	$newparsers = array(
		'551' => array(
			'title' => 'BTC - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'552' => array(
			'title' => 'USD - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'553' => array(
			'title' => 'BTC - EUR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'554' => array(
			'title' => 'EUR - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'555' => array(
			'title' => 'BTC - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'556' => array(
			'title' => 'RUB - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 10000,
		),			 
		'557' => array(
			'title' => 'BTC - UAH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'558' => array(
			'title' => 'UAH - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 10000,
		),
		'559' => array(
			'title' => 'DASH - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'560' => array(
			'title' => 'BTC - DASH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'561' => array(
			'title' => 'DASH - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'562' => array(
			'title' => 'USD - DASH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'563' => array(
			'title' => 'ETH - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 10,
		),
		'564' => array(
			'title' => 'BTC - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'565' => array(
			'title' => 'ETH - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'566' => array(
			'title' => 'USD - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		), 
		'585' => array(
			'title' => 'ETH - UAH',
			'birg' => __('ExMo','pn'),
			'curs' => 1,
		),
		'586' => array(
			'title' => 'UAH - ETH',
			'birg' => __('ExMo','pn'),
			'curs' => 1000,
		),		
		'567' => array(
			'title' => 'DOGE - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000000,
		),
		'568' => array(
			'title' => 'BTC - DOGE',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'569' => array(
			'title' => 'LTC - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'570' => array(
			'title' => 'BTC - LTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'587' => array(
			'title' => 'LTC - UAH',
			'birg' => __('ExMo','pn'),
			'curs' => 1,
		),
		'588' => array(
			'title' => 'UAH - LTC',
			'birg' => __('ExMo','pn'),
			'curs' => 1000,
		),		
		'571' => array(
			'title' => 'ETH - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'572' => array(
			'title' => 'RUB - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'573' => array(
			'title' => 'ETH - EUR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'574' => array(
			'title' => 'EUR - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		), 
		'575' => array(
			'title' => 'LTC - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'576' => array(
			'title' => 'RUB - LTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'577' => array(
			'title' => 'DASH - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'578' => array(
			'title' => 'RUB - DASH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'589' => array(
			'title' => 'DASH - UAH',
			'birg' => __('ExMo','pn'),
			'curs' => 1,
		),
		'590' => array(
			'title' => 'UAH - DASH',
			'birg' => __('ExMo','pn'),
			'curs' => 1000,
		),		
		'579' => array(
			'title' => 'ETH - LTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'580' => array(
			'title' => 'LTC - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'581' => array(
			'title' => 'USD - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'582' => array(
			'title' => 'RUB - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'583' => array(
			'title' => 'WAVES - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'584' => array(
			'title' => 'BTC - WAVES',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'591' => array(
			'title' => 'LTC - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'592' => array(
			'title' => 'USD - LTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 100,
		),	
		'593' => array(
			'title' => 'LTC - EUR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'594' => array(
			'title' => 'EUR - LTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 100,
		),
		'595' => array(
			'title' => 'ZEC - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 100,
		),	
		'596' => array(
			'title' => 'BTC - ZEC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'597' => array(
			'title' => 'ZEC - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'598' => array(
			'title' => 'USD - ZEC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'599' => array(
			'title' => 'ZEC - EUR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'600' => array(
			'title' => 'EUR - ZEC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'601' => array(
			'title' => 'ZEC - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'602' => array(
			'title' => 'RUB - ZEC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'603' => array(
			'title' => 'ETC - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'604' => array(
			'title' => 'RUB - ETC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'605' => array(
			'title' => 'WAVES - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'606' => array(
			'title' => 'RUB - WAVES',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'607' => array(
			'title' => 'KICK - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 100,
		),	
		'608' => array(
			'title' => 'ETH - KICK',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'609' => array(
			'title' => 'KICK - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 10000,
		),	
		'610' => array(
			'title' => 'BTC - KICK',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'611' => array(
			'title' => 'USDT - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'612' => array(
			'title' => 'RUB - USDT',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'613' => array(
			'title' => 'USDT - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'614' => array(
			'title' => 'USD - USDT',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'615' => array(
			'title' => 'ETH - USDT',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'616' => array(
			'title' => 'USDT - ETH',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),	
		'617' => array(
			'title' => 'BTC - USDT',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'618' => array(
			'title' => 'USDT - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'619' => array(
			'title' => 'XMR - EUR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'620' => array(
			'title' => 'EUR - XMR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),
		'621' => array(
			'title' => 'XMR - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'622' => array(
			'title' => 'USD - XMR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),		
		'623' => array(
			'title' => 'XMR - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),	
		'624' => array(
			'title' => 'BTC - XMR',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'625' => array(
			'title' => 'XRP - RUB',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'626' => array(
			'title' => 'RUB - XRP',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'627' => array(
			'title' => 'XRP - USD',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),	
		'628' => array(
			'title' => 'USD - XRP',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),
		'629' => array(
			'title' => 'XRP - BTC',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1000,
		),	
		'630' => array(
			'title' => 'BTC - XRP',
			'birg' => __('ExMo','pn'),
			'data' => array('low','buy_price','sell_price','last_trade','high','avg'),
			'curs' => 1,
		),		
	);	
	foreach($newparsers as $key => $data){
		$parsers[$key] = $data;
	}
	
	return $parsers;
}

add_filter('before_load_curs_parser','before_load_curs_parser_exmo', 10, 4);
function before_load_curs_parser_exmo($curs_parser, $work_parser='', $config_parser='', $parsers=''){
	
	if(!is_array($parsers)){
		$parsers = apply_filters('get_pn_parser', array());
	}
	
	$arrs = array(
		'BTC_USD' => array(
			'id1' => 551,
			'sum1' => 1,
			'id2' => 552,
			'sum2' => 1000,			
		),
		'BTC_EUR' => array(
			'id1' => 553,
			'sum1' => 1,
			'id2' => 554,
			'sum2' => 1000,			
		),
		'BTC_RUB' => array(
			'id1' => 555,
			'sum1' => 1,
			'id2' => 556,
			'sum2' => 10000,			
		),
		'BTC_UAH' => array(
			'id1' => 557,
			'sum1' => 1,
			'id2' => 558,
			'sum2' => 10000,			
		),
		'DASH_BTC' => array(
			'id1' => 559,
			'sum1' => 1,
			'id2' => 560,
			'sum2' => 1,			
		),
		'DASH_USD' => array(
			'id1' => 561,
			'sum1' => 1,
			'id2' => 562,
			'sum2' => 1000,			
		),
		'ETH_BTC' => array(
			'id1' => 563,
			'sum1' => 10,
			'id2' => 564,
			'sum2' => 1,			
		),
		'ETH_USD' => array(
			'id1' => 565,
			'sum1' => 1,
			'id2' => 566,
			'sum2' => 1000,			
		),
		'ETH_UAH' => array(
			'id1' => 585,
			'sum1' => 1,
			'id2' => 586,
			'sum2' => 1000,			
		),		
		'DOGE_BTC' => array(
			'id1' => 567,
			'sum1' => 1000000,
			'id2' => 568,
			'sum2' => 1,			
		),
		'LTC_BTC' => array(
			'id1' => 569,
			'sum1' => 1,
			'id2' => 570,
			'sum2' => 1,			
		),
		'ETH_RUB' => array(
			'id1' => 571,
			'sum1' => 1,
			'id2' => 572,
			'sum2' => 1000,			
		),
		'ETH_EUR' => array(
			'id1' => 573,
			'sum1' => 1,
			'id2' => 574,
			'sum2' => 1,			
		),
		'LTC_RUB' => array(
			'id1' => 575,
			'sum1' => 1,
			'id2' => 576,
			'sum2' => 1000,			
		),
		'DASH_RUB' => array(
			'id1' => 577,
			'sum1' => 1,
			'id2' => 578,
			'sum2' => 1000,			
		),
		'ETH_LTC' => array(
			'id1' => 579,
			'sum1' => 1,
			'id2' => 580,
			'sum2' => 1,			
		),
		'USD_RUB' => array(
			'id1' => 581,
			'sum1' => 1,
			'id2' => 582,
			'sum2' => 1,			
		),
		'WAVES_BTC' => array(
			'id1' => 583,
			'sum1' => 1000,
			'id2' => 584,
			'sum2' => 1,			
		),
		'LTC_USD' => array(
			'id1' => 591,
			'sum1' => 1,
			'id2' => 592,
			'sum2' => 100,			
		),
		'LTC_EUR' => array(
			'id1' => 593,
			'sum1' => 1,
			'id2' => 594,
			'sum2' => 100,			
		),
		'ZEC_BTC' => array(
			'id1' => 595,
			'sum1' => 100,
			'id2' => 596,
			'sum2' => 1,			
		),
		'ZEC_USD' => array(
			'id1' => 597,
			'sum1' => 1,
			'id2' => 598,
			'sum2' => 1,			
		),
		'ZEC_EUR' => array(
			'id1' => 599,
			'sum1' => 1,
			'id2' => 600,
			'sum2' => 1,			
		),
		'ZEC_RUB' => array(
			'id1' => 601,
			'sum1' => 1,
			'id2' => 602,
			'sum2' => 1000,			
		),
		'ETC_RUB' => array(
			'id1' => 603,
			'sum1' => 1,
			'id2' => 604,
			'sum2' => 1000,			
		),
		'WAVES_RUB' => array(
			'id1' => 605,
			'sum1' => 1,
			'id2' => 606,
			'sum2' => 1000,			
		),
		'KICK_ETH' => array(
			'id1' => 607,
			'sum1' => 100,
			'id2' => 608,
			'sum2' => 1,			
		),
		'KICK_BTC' => array(
			'id1' => 609,
			'sum1' => 10000,
			'id2' => 610,
			'sum2' => 1,			
		),	
		'USDT_RUB' => array(
			'id1' => 611,
			'sum1' => 1,
			'id2' => 612,
			'sum2' => 1000,			
		),
		'USDT_USD' => array(
			'id1' => 613,
			'sum1' => 1,
			'id2' => 614,
			'sum2' => 1,			
		),
		'ETH_USDT' => array(
			'id1' => 615,
			'sum1' => 1,
			'id2' => 616,
			'sum2' => 1000,			
		),	
		'BTC_USDT' => array(
			'id1' => 617,
			'sum1' => 1,
			'id2' => 618,
			'sum2' => 1000,			
		),
		'XMR_EUR' => array(
			'id1' => 619,
			'sum1' => 1,
			'id2' => 620,
			'sum2' => 1000,			
		),
		'XMR_USD' => array(
			'id1' => 621,
			'sum1' => 1,
			'id2' => 622,
			'sum2' => 1000,			
		),
		'XMR_BTC' => array(
			'id1' => 623,
			'sum1' => 1000,
			'id2' => 624,
			'sum2' => 1,			
		),
		'XRP_RUB' => array(
			'id1' => 625,
			'sum1' => 1,
			'id2' => 626,
			'sum2' => 1,			
		),
		'XRP_USD' => array(
			'id1' => 627,
			'sum1' => 1,
			'id2' => 628,
			'sum2' => 1,			
		),
		'XRP_BTC' => array(
			'id1' => 629,
			'sum1' => 1000,
			'id2' => 630,
			'sum2' => 1,			
		),		
	);

	$curl = get_curl_parser('https://api.exmo.me/v1/ticker/', '', 'parser', 'exmo');
	if(!$curl['err']){
		$outs = @json_decode($curl['output']);
		if(is_object($outs)){
			foreach($arrs as $arr_id => $arr_data){
				if(isset($outs->$arr_id)){
					$item = $outs->$arr_id;
					$id1 = intval(is_isset($arr_data, 'id1'));
					$sum1 = intval(is_isset($arr_data, 'sum1'));
					$id2 = intval(is_isset($arr_data, 'id2'));
					$sum2 = intval(is_isset($arr_data, 'sum2'));					
					
					if(is_isset($work_parser, $id1) == 1){
						$key1 = trim(is_isset($config_parser, $id1));
						if(!$key1){ $key1 = 'low'; }
						$ck1 = is_my_money($item->$key1);
						$curs1 = def_parser_curs($parsers, $id1, $sum1);
						if($ck1){
							$curs_parser[$id1]['curs1'] = $curs1;
							$curs_parser[$id1]['curs2'] = $ck1 * $curs1;
						}
					}
					if(is_isset($work_parser, $id2) == 1){
						$key2 = trim(is_isset($config_parser, $id2));
						if(!$key2){ $key2 = 'low'; }
						$ck2def = is_my_money($item->$key2); 
						$curs2 = def_parser_curs($parsers, $id2, $sum2);
						if($curs2 and $ck2def){
							$ck2 = is_my_money($curs2 / $ck2def);
							$curs_parser[$id2]['curs1'] = $curs2; 
							$curs_parser[$id2]['curs2'] = $ck2;
						}						
					}					
				}	
			}	
		} 
	}		 	
	
	$rubuah = 0;
	if(isset($curs_parser[6]['curs2']) and $curs_parser[6]['curs2'] > 0){
		$def = def_parser_curs($parsers, 6, 100);
		$rubuah = $curs_parser[6]['curs2'] / $def;
	}
	$usduah = 0;
	if(isset($curs_parser[101]['curs2']) and $curs_parser[101]['curs2'] > 0){
		$def = def_parser_curs($parsers, 101, 100);
		$usduah = $curs_parser[101]['curs2'] / $def;
	}	
	if(isset($curs_parser[105]['curs2']) and $curs_parser[105]['curs2'] > 0){
		$def = def_parser_curs($parsers, 105, 100);
		$usduah = $curs_parser[105]['curs2'] / $def;
	}
	if(is_isset($work_parser, 587) == 1){
		if($rubuah > 0 and isset($curs_parser[575]['curs2']) and $curs_parser[575]['curs2'] > 0){
			$def = def_parser_curs($parsers, 575, 1);
			$curs_one = $curs_parser[575]['curs2'] / $def;
			$curs_parser[587]['curs1'] = 1; 
			$curs_parser[587]['curs2'] = is_my_money($curs_one * $rubuah);

			$def = def_parser_curs($parsers, 588, 1000);
			$curs_parser[588]['curs1'] = $def; 
			$curs_parser[588]['curs2'] = is_my_money(1 / $curs_parser[587]['curs2'] * $def);			
		}	
	}
	if(is_isset($work_parser, 589) == 1){
		if($rubuah > 0 and isset($curs_parser[561]['curs2']) and $curs_parser[561]['curs2'] > 0){
			$def = def_parser_curs($parsers, 561, 1);
			$curs_one = $curs_parser[561]['curs2'] / $def;
			$curs_parser[589]['curs1'] = 1; 
			$curs_parser[589]['curs2'] = is_my_money($curs_one * $rubuah);	

			$def = def_parser_curs($parsers, 590, 1000);
			$curs_parser[590]['curs1'] = $def; 
			$curs_parser[590]['curs2'] = is_my_money(1 / $curs_parser[589]['curs2'] * $def);			
		}	
	}	
	
	return $curs_parser;
}

add_filter('get_pn_parser','get_pn_parser_okcoin');
function get_pn_parser_okcoin($parsers){
 
	$parsers['20000'] = array(
		'title' => 'BTC - CNY',
		'birg' => 'Okcoin',
		'data' => array('low', 'high', 'last', 'buy', 'sell'),
		'curs' => 1,
	);
	$parsers['20001'] = array(
		'title' => 'CNY - BTC',
		'birg' => 'Okcoin',
		'data' => array(),
		'curs' => 1,
	);
	$parsers['20002'] = array(
		'title' => 'LTC - CNY',
		'birg' => 'Okcoin',
		'data' => array('low', 'high', 'last', 'buy', 'sell'),
		'curs' => 1,
	);
	$parsers['20003'] = array(
		'title' => 'CNY - LTC',
		'birg' => 'Okcoin',
		'data' => array(),
		'curs' => 1,
	);	
	$parsers['20004'] = array(
		'title' => 'ETH - CNY',
		'birg' => 'Okcoin',
		'data' => array('low', 'high', 'last', 'buy', 'sell'),
		'curs' => 1,
	);
	$parsers['20005'] = array(
		'title' => 'CNY - ETH',
		'birg' => 'Okcoin',
		'data' => array(),
		'curs' => 1,
	);	
 
	return $parsers;
}

add_filter('before_load_curs_parser','before_load_curs_parser_okcoin', 10, 4);
function before_load_curs_parser_okcoin($curs_parser, $work_parser='', $config_parser='', $parsers=''){
	
	if(!$work_parser){
		$work_parser = get_option('work_parser');
		if(!is_array($work_parser)){ $work_parser = array(); }		
	}
	if(!$config_parser){
		$config_parser = get_option('config_parser');
		if(!is_array($config_parser)){ $config_parser = array(); }		
	}
	if(!is_array($parsers)){
		$parsers = apply_filters('get_pn_parser', array());
	}	
	
	$parser_id1 = 20000;
	$parser_id2 = 20001;
	if(is_isset($work_parser,$parser_id1) == 1 or is_isset($work_parser,$parser_id2) == 1){
		$curl = get_curl_parser('https://www.okcoin.cn/api/v1/ticker.do?symbol=btc_cny');
		if(!$curl['err']){
			$out = @json_decode($curl['output']);
			if(is_object($out)){
				$key = trim(is_isset($config_parser,$parser_id1));
				if(!$key){ $key='low'; }
				if(isset($out->ticker)){
					$ck = is_my_money($out->ticker->$key);
					if($ck){
						if(function_exists('def_parser_curs')){
							$curs1 = def_parser_curs($parsers, $parser_id1, 1);
						} else {
							$curs1 = 1;
						}
						$curs_parser[$parser_id1]['curs1'] = $curs1; 
						$curs_parser[$parser_id1]['curs2'] = $ck;

						if(function_exists('def_parser_curs')){
							$curs2 = def_parser_curs($parsers, $parser_id2, 1);
						} else {
							$curs2 = 1;
						}						
						$curs_parser[$parser_id2]['curs1'] = $curs2;
						$curs_parser[$parser_id2]['curs2'] = is_my_money($curs2 / $ck * $curs1);
					}
				}
			}
		}						
	}

	$parser_id1 = 20002;
	$parser_id2 = 20003;
	if(is_isset($work_parser,$parser_id1) == 1 or is_isset($work_parser,$parser_id2) == 1){
		$curl = get_curl_parser('https://www.okcoin.cn/api/v1/ticker.do?symbol=ltc_cny');
		if(!$curl['err']){
			$out = @json_decode($curl['output']);
			if(is_object($out)){
				$key = trim(is_isset($config_parser,$parser_id1));
				if(!$key){ $key='low'; }
				if(isset($out->ticker)){
					$ck = is_my_money($out->ticker->$key);
					if($ck){
						if(function_exists('def_parser_curs')){
							$curs1 = def_parser_curs($parsers, $parser_id1, 1);
						} else {
							$curs1 = 1;
						}
						$curs_parser[$parser_id1]['curs1'] = $curs1; 
						$curs_parser[$parser_id1]['curs2'] = $ck;

						if(function_exists('def_parser_curs')){
							$curs2 = def_parser_curs($parsers, $parser_id2, 1);
						} else {
							$curs2 = 1;
						}						
						$curs_parser[$parser_id2]['curs1'] = $curs2;
						$curs_parser[$parser_id2]['curs2'] = is_my_money($curs2 / $ck * $curs1);
					}
				}
			}
		}						
	}

	$parser_id1 = 20004;
	$parser_id2 = 20005;
	if(is_isset($work_parser,$parser_id1) == 1 or is_isset($work_parser,$parser_id2) == 1){
		$curl = get_curl_parser('https://www.okcoin.cn/api/v1/ticker.do?symbol=eth_cny');
		if(!$curl['err']){
			$out = @json_decode($curl['output']);
			if(is_object($out)){
				$key = trim(is_isset($config_parser,$parser_id1));
				if(!$key){ $key='low'; }
				if(isset($out->ticker)){
					$ck = is_my_money($out->ticker->$key);
					if($ck){
						if(function_exists('def_parser_curs')){
							$curs1 = def_parser_curs($parsers, $parser_id1, 1);
						} else {
							$curs1 = 1;
						}
						$curs_parser[$parser_id1]['curs1'] = $curs1; 
						$curs_parser[$parser_id1]['curs2'] = $ck;

						if(function_exists('def_parser_curs')){
							$curs2 = def_parser_curs($parsers, $parser_id2, 1);
						} else {
							$curs2 = 1;
						}						
						$curs_parser[$parser_id2]['curs1'] = $curs2;
						$curs_parser[$parser_id2]['curs2'] = is_my_money($curs2 / $ck * $curs1);
					}
				}
			}
		}						
	}	
	
	return $curs_parser;
}

remove_action('init','delete_eval_files');

