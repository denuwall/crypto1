<?php  
if( !defined( 'ABSPATH')){ exit(); }

add_filter('new_parser_links', 'def_new_parser_links');
function def_new_parser_links($links){	

	$time = current_time('timestamp');
	$tomorrow = $time + (24*60*60);

	$links['cbr'] = array(
		'title' => 'CBR.RU',
		'url' => 'http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d.m.Y', $time),
	);
	$links['ecb'] = array(
		'title' => 'ECB.EU',
		'url' => 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
	);
	$links['privatnbu'] = array(
		'title' => 'NBU',
		'url' => 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=3',
	);
	$links['privat'] = array(
		'title' => 'PRIVATBANK.UA',
		'url' => 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5',
	);
	$links['nationalkz'] = array(
		'title' => 'NATIONALBANK.KZ',
		'url' => 'http://www.nationalbank.kz/rss/rates_all.xml',
	);	
	$links['nbrb'] = array(
		'title' => 'NBRB.BY',
		'url' => 'http://www.nbrb.by/Services/XmlExRates.aspx?ondate='.date('m/d/Y', $time),
	);	
	$links['bitsane'] = array(
		'title' => 'BitSane.com',
		'url' => 'https://bitsane.com/api/public/ticker',
	);
	$links['blockchain'] = array(
		'title' => 'Blockchain.info',
		'url' => 'https://blockchain.info/ticker',
	);	
	$links['coinmarketcap'] = array(
		'title' => 'Coinmarketcap.com',
		'url' => 'https://api.coinmarketcap.com/v2/ticker/',
	);	
	$links['wex'] = array(
		'title' => 'Wex.nz',
		'url' => 'https://wex.nz/api/3/ticker/btc_usd-btc_rur-btc_eur-ltc_usd-ltc_eur-ltc_rur-ltc_btc-dsh_btc-eth_btc-eth_usd-eth_ltc-eth_rur-usd_rur-eur_rur-eur_usd-nvc_btc-nmc_btc-nvc_usd-nmc_usd-dsh_usd-dsh_rur-dsh_eur-bch_usd-bch_rur-bch_eur-bch_btc-bch_ltc-bch_eth-bch_dsh-zec_btc-zec_usd',
	);
	$links['exmo'] = array(
		'title' => 'Exmo.me',
		'url' => 'http://api.exmo.me/v1/ticker/',
	);
	$links['poloniex'] = array(
		'title' => 'Poloniex.com',
		'url' => 'https://poloniex.com/public?command=returnTicker',
	);
	$links['btc_alpha'] = array(
		'title' => 'Btc-alpha.com',
		'url' => 'https://btc-alpha.com/api/v1/ticker/?format=json',
	);	
	$links['livecoin'] = array(
		'title' => 'Livecoin.net',
		'url' => 'https://api.livecoin.net/exchange/ticker',
	);
	$links['bitfinex'] = array(
		'title' => 'Bitfinex.com',
		'url' => 'https://api.bitfinex.com/v1/tickers?symbols',
	);	
	$links['binance'] = array(
		'title' => 'Binance.com',
		'url' => 'https://api.binance.com/api/v3/ticker/price',
	);	

	$arrs = array('btcusd','btceur','eurusd','xrpusd','xrpeur','xrpbtc','ltcusd','ltceur','ltcbtc','ethusd','etheur','ethbtc','bchusd','bcheur','bchbtc');
	foreach($arrs as $arr_v){
		$title = mb_strtoupper($arr_v);
		$links['bitstamp_'. $arr_v] = array(
			'title' => 'Bitstamp.net '. mb_substr($title, 0, 3). '-'. mb_substr($title, 3, 7),
			'url' => 'https://www.bitstamp.net/api/v2/ticker/'. $arr_v . '/',
		);		
	}	
	
	$arrs = array(
		'1' => 'WMZ/WMR',
		'2' => 'WMR/WMZ',
		'3' => 'WMZ/WME',
		'4' => 'WME/WMZ',
		'5' => 'WME/WMR',
		'6' => 'WMR/WME',
		'7' => 'WMZ/WMU',
		'8' => 'WMU/WMZ',
		'9' => 'WMR/WMU',
		'10' => 'WMU/WMR',
		'11' => 'WMU/WME',
		'12' => 'WME/WMU',
		'17' => 'WMB/WMZ',
		'18' => 'WMZ/WMB',
		'19' => 'WMB/WME',
		'20' => 'WME/WMB',
		'23' => 'WMR/WMB',
		'24' => 'WMB/WMR',
		'25' => 'WMZ/WMG',
		'26' => 'WMG/WMZ',
		'27' => 'WME/WMG',
		'28' => 'WMG/WME',
		'29' => 'WMR/WMG',
		'30' => 'WMG/WMR',
		'31' => 'WMU/WMG',
		'32' => 'WMG/WMU',
		'33' => 'WMZ/WMX',
		'34' => 'WMX/WMZ',
		'35' => 'WME/WMX',
		'36' => 'WMX/WME',
		'37' => 'WMR/WMX',
		'38' => 'WMX/WMR',
		'39' => 'WMU/WMX',
		'40' => 'WMX/WMU',
		'41' => 'WMK/WMZ',
		'42' => 'WMZ/WMK',
		'43' => 'WMK/WME',
		'44' => 'WME/WMK',
		'45' => 'WMR/WMK',
		'46' => 'WMK/WMR',
		'47' => 'WMB/WMU',
		'48' => 'WMU/WMB',
		'49' => 'WMB/WMX',
		'50' => 'WMX/WMB',
		'51' => 'WMK/WMX',
		'52' => 'WMX/WMK',
		'53' => 'WMB/WMG',
		'54' => 'WMG/WMB',
		'55' => 'WMB/WMK',
		'56' => 'WMK/WMB',
		'57' => 'WMG/WMK',
		'58' => 'WMK/WMG',
		'59' => 'WMG/WMX',
		'60' => 'WMX/WMG',
		'61' => 'WMU/WMK',
		'62' => 'WMK/WMU',
		'63' => 'WMV/WMZ',
		'64' => 'WMZ/WMV',
		'65' => 'WMV/WME',
		'66' => 'WME/WMV',
	);
	foreach($arrs as $arr_k => $arr_v){
		$links['wmexchanger' . $arr_k] = array(
			'title' => 'Wm.exchanger.ru '. $arr_v,
			'url' => 'https://wm.exchanger.ru/asp/XMLWMList.asp?exchtype='. $arr_k,
		);		
	}
	
	return $links;
}

add_filter('set_parser_pairs', 'def_set_parser_pairs', 10, 3);
function def_set_parser_pairs($parser_pairs, $output, $birg_key){
	
	$cs = 20;
	
	if($birg_key == 'binance'){
		$res = @json_decode($output);
		if(is_array($res)){	
			foreach($res as $out){
				$title_in = is_isset($out,'symbol');
				
				$rate = (string)is_isset($out, 'price');
				$rate = is_sum($rate, $cs);
				if($rate){
					$parser_pairs[] = array(
						'title' => mb_substr($title_in, 0, 3). '-'. mb_substr($title_in, 3, 7),
						'course' => $rate,
						'code' => $birg_key . '_'. mb_strtolower($title_in),
						'birg' => $birg_key,
					);
				}
			}
		}		
	}
	
	if($birg_key == 'blockchain'){
		$res = @json_decode($output);
		if(is_object($res)){	
			foreach($res as $title => $out){
				$arrs = array('15m','last','buy','sell');
				foreach($arrs as $arr_value){
					$rate = (string)is_isset($out, $arr_value);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => 'BTC -'. $title,
							'course' => $rate,
							'code' => $birg_key . '_btc'. mb_strtolower($title) . '_'. $arr_value,
							'birg' => $birg_key,
						);
					}
				}
			}
		}			
	}
	
	if($birg_key == 'coinmarketcap'){
		$res = @json_decode($output);
		if(is_object($res)){
			foreach($res->data as $out){
				$title1 = $out->symbol;
				foreach($out->quotes as $quote_key => $quote_value){
					$title2 = $quote_key;
					$rate = (string)is_isset($quote_value, 'price');
				}
				$rate = is_sum($rate, $cs);
				if($rate){
					$parser_pairs[] = array(
						'title' => $title1 . '-'. $title2,
						'course' => $rate,
						'code' => $birg_key . '_'. mb_strtolower($title1 . $title2) . '_price',
						'birg' => $birg_key,
					);
				}				
			}	
		}		
	}
	
	if($birg_key == 'bitfinex'){		
		$res = @json_decode($output);
		if(is_array($res)){	
			foreach($res as $out){
				$title_in = is_isset($out,'pair');
				
				$narr = array('mid', 'bid', 'ask', 'last_price', 'low','high');
				foreach($narr as $res_key){
					$rate = (string)is_isset($out, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => mb_substr($title_in, 0, 3). '-'. mb_substr($title_in, 3, 7).' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower($title_in) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}
	
	if($birg_key == 'livecoin'){		
		$res = @json_decode($output);
		if(is_array($res)){	
			foreach($res as $out){
				$title_in = is_isset($out,'symbol');
				$title_arr = explode('/', $title_in);
				
				$narr = array('last', 'high', 'low', 'volume', 'vwap','max_bid','min_ask','best_bid','best_ask');
				foreach($narr as $res_key){
					$rate = (string)is_isset($out, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => is_isset($title_arr,0) .'-'. is_isset($title_arr,1) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('/', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}
	
	if($birg_key == 'poloniex'){		
		$res = @json_decode($output);
		if(is_object($res)){	
			foreach($res as $title_in => $v){
				$title_arr = explode('_', $title_in);
				
				$narr = array('last', 'lowestAsk', 'highestBid', 'high24hr', 'low24hr');
				foreach($narr as $res_key){
					$rate = (string)is_isset($v, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){	
						$parser_pairs[] = array(
							'title' => mb_strtoupper(str_replace('_', '-', $title_in)) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('_', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}
	
	if($birg_key == 'btc_alpha'){		
		$res = @json_decode($output);
		if(is_array($res)){	
			foreach($res as $v){
				$title_in = $v->pair;
				$title_arr = explode('_', $title_in);
				
				$narr = array('last', 'diff', 'vol', 'high', 'low', 'buy', 'sell');
				foreach($narr as $res_key){
					$rate = (string)is_isset($v, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){	
						$parser_pairs[] = array(
							'title' => mb_strtoupper(str_replace('_', '-', $title_in)) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('_', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}	
	
	if($birg_key == 'exmo'){		
		$res = @json_decode($output);
		if(is_object($res)){	
			foreach($res as $title_in => $v){
				$title_arr = explode('_', $title_in);
				
				$narr = array('buy_price', 'sell_price', 'last_trade', 'high', 'low', 'avg');
				foreach($narr as $res_key){
					$rate = (string)is_isset($v, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => mb_strtoupper(str_replace('_', '-', $title_in)) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('_', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}	
	
	if($birg_key == 'wex'){		
		$res = @json_decode($output);
		if(is_object($res)){	
			foreach($res as $title_in => $v){
				$title_arr = explode('_', $title_in);
				
				$narr = array('high', 'low', 'avg', 'last', 'buy', 'sell');
				foreach($narr as $res_key){
					$rate = (string)is_isset($v, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => mb_strtoupper(str_replace('_', '-', $title_in)) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('_', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}	
	
	if($birg_key == 'bitsane'){		
		$res = @json_decode($output);
		if(is_object($res)){	
			foreach($res as $title_in => $v){
				$title_arr = explode('_', $title_in);
				
				$narr = array('last', 'lowestAsk', 'highestBid', 'high24hr', 'low24hr');
				foreach($narr as $res_key){
					$rate = (string)is_isset($v, $res_key);
					$rate = is_sum($rate, $cs);
					if($rate){
						$parser_pairs[] = array(
							'title' => str_replace('_', '-', $title_in) .' ('. $res_key .')',
							'course' => $rate,
							'code' => $birg_key . '_'. mb_strtolower(str_replace('_', '', $title_in)) .'_'.$res_key,
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}	
	
	if(strstr($birg_key,'bitstamp_')){
		$res = @json_decode($output);
		if(is_object($res)){
			$title = mb_strtoupper(str_replace('bitstamp_','', $birg_key));
			
			$narr = array('high', 'last', 'bid', 'vwap', 'low', 'ask', 'open');
			foreach($narr as $res_key){
				$rate = (string)is_isset($res, $res_key);
				$rate = is_sum($rate, $cs);
				if($rate){
					$parser_pairs[] = array(
						'title' => mb_substr($title, 0, 3). '-'. mb_substr($title, 3, 7).' ('. $res_key .')',
						'course' => $rate,
						'code' => $birg_key . '_'.$res_key,
						'birg' => $birg_key,
					);
				}
			}
		}	
	}	
	
	if(strstr($birg_key,'wmexchanger')){
		if(strstr($output,'<?xml')){		
			$res = @simplexml_load_string($output);
			if(is_object($res) and isset($res->WMExchnagerQuerys)){	
				if(isset($res->WMExchnagerQuerys['amountin'], $res->WMExchnagerQuerys['amountout'])){
					$curr1 = $res->WMExchnagerQuerys['amountin'];
					$curr2 = $res->WMExchnagerQuerys['amountout'];
					
					$rate1 = (string)$res->WMExchnagerQuerys->query['inoutrate'][0]; 
					$rate1 = is_sum($rate1, $cs);
					
					$rate2 = (string)$res->WMExchnagerQuerys->query['outinrate'][0];
					$rate2 = is_sum($rate2, $cs);
					
					$parser_pairs[] = array(
						'title' => $curr2. '-'.$curr1.' (outrate)',
						'course' => $rate1,
						'code' => $birg_key. '_'. strtolower($curr2) . strtolower($curr1). '_outrate',
						'birg' => $birg_key,
					);
					$parser_pairs[] = array(
						'title' => $curr1. '-'.$curr2.' (inrate)',
						'course' => $rate2,
						'code' => $birg_key. '_'. strtolower($curr1) . strtolower($curr2). '_inrate',
						'birg' => $birg_key,
					);					

				}	
			}
		}		
	}
	
	if($birg_key == 'nbrb'){
		if(strstr($output,'<?xml')){		
			$res = @simplexml_load_string($output);
			if(is_object($res) and isset($res->Currency)){
				foreach($res->Currency as $data){
					
					$CharCode = $data->CharCode;
					$CharCode = trim($CharCode); /* type */
					
					$nominal = (string)$data->Scale; /* 1 USD */
					$nominal = is_sum($nominal, $cs); 
					
					$value = (string)$data->Rate; /* ? KZT */
					$value = is_sum($value, $cs);
					
					if($nominal > 0 and $value > 0){
						$course = is_sum($value / $nominal, $cs);
						$parser_pairs[] = array(
							'title' => $CharCode. '- BYN',
							'course' => $course,
							'code' => $birg_key. '_'. strtolower($CharCode) .'byn',
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}		
	
	if($birg_key == 'nationalkz'){
		if(strstr($output,'<?xml')){		
			$res = @simplexml_load_string($output);
			if(is_object($res) and isset($res->channel)){
				foreach($res->channel->item as $data){
					
					$CharCode = $data->title;
					$CharCode = trim($CharCode); /* type */
					
					$nominal = (string)$data->quant; /* 1 USD */
					$nominal = is_sum($nominal, $cs); 
					
					$value = (string)$data->description; /* ? KZT */
					$value = is_sum($value, $cs);
					
					if($nominal > 0 and $value > 0){
						$course = is_sum($value / $nominal, $cs);
						$parser_pairs[] = array(
							'title' => $CharCode. '- KZT',
							'course' => $course,
							'code' => $birg_key. '_'. strtolower($CharCode) .'kzt',
							'birg' => $birg_key,
						);
					}
				}
			}
		}				
	}	
	
	if($birg_key == 'cbr'){
		$res = @simplexml_load_string($output);
		if(is_object($res)){
			if(isset($res->Valute)){
				$currencies = $res->Valute;
				foreach($currencies as $c_obj){
					$CharCode = (string)$c_obj->CharCode;
					$CharCode = trim($CharCode); /* type */
					
					$nominal = (string)$c_obj->Nominal;
					$nominal = is_sum($nominal, $cs);
					
					$value = (string)$c_obj->Value;
					$value = is_sum($value, $cs);
					
					if($nominal > 0 and $value > 0){
						$course = is_sum($value / $nominal, $cs);
						$parser_pairs[] = array(
							'title' => $CharCode. '- RUB',
							'course' => $course,
							'code' => $birg_key. '_'. strtolower($CharCode) .'rub',
							'birg' => $birg_key,
						);
					}
				}	
			}	
		}	
	}
	
	if($birg_key == 'ecb'){
		$res = @simplexml_load_string($output);
		if(is_object($res) and isset($res->Cube, $res->Cube->Cube)){
			foreach($res->Cube->Cube->Cube as $cube){
				$currency = (string)$cube['currency'];
				$currency = trim($currency);
				
				$rate = (string)$cube['rate'];
				$rate = is_sum($rate, $cs);
				
				if($rate > 0){
					$parser_pairs[] = array(
						'title' => 'EUR - '. $currency,
						'course' => $rate,
						'code' => $birg_key. '_eur'. strtolower($currency),
						'birg' => $birg_key,
					);
				}				
			}
		}
	}	
	
	if($birg_key == 'privatnbu' or $birg_key == 'privat'){
		$res = @simplexml_load_string($output);
		if(is_object($res) and isset($res->row)){
			foreach($res->row as $val){
				$v_data = (array)$val->exchangerate;
				$currency = (string)$v_data['@attributes']['ccy'];
				$currency = trim($currency);
				
				$rate1 = (string)$v_data['@attributes']['buy'];
				$rate1 = is_sum($rate1, $cs);
				
				if($rate1 > 0){
					$parser_pairs[] = array(
						'title' => $currency . ' - UAH (buy)',
						'course' => $rate1,
						'code' => $birg_key . '_' . strtolower($currency) . '_uah_buy',
						'birg' => $birg_key,
					);
				}

				$rate2 = (string)$v_data['@attributes']['sale'];
				$rate2 = is_sum($rate2, $cs);
				
				if($rate2 > 0){
					$parser_pairs[] = array(
						'title' => $currency . ' - UAH (sale)',
						'course' => $rate2,
						'code' => $birg_key . '_' . strtolower($currency) . '_uah_sale',
						'birg' => $birg_key,
					);
				}				
			}
		}
	}	
	
	return $parser_pairs;
}

add_filter('work_parser_links', 'def_work_parser_links');
function def_work_parser_links($links){	

	$birgs = apply_filters('new_parser_links', array());
	
	$work_birgs = get_option('work_birgs');
	if(!is_array($work_birgs)){ $work_birgs = array(); }
	
	foreach($birgs as $birg_key => $birg_data){
		if(in_array($birg_key, $work_birgs)){
			$links[$birg_key] = $birg_data;
		}
	}	
	
	return $links;
}