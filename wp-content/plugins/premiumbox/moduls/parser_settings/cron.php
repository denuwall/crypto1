<?php

//require __DIR__.'/vendor/autoload.php';

if(!class_exists('PremiumParser')){
	class PremiumParser{
		public $path_logs = '';
		public $links = array();
		//public $parts = 5; 
		
		function __construct()
		{
			$my_dir = wp_upload_dir();
			
			$path = $my_dir['basedir'].'/';
			$path2 = $my_dir['basedir'].'/parser_logs/';
			if(!is_dir($path)){ 
				@mkdir($path , 0777);
			}
			if(!is_dir($path2)){ 
				@mkdir($path2 , 0777);
			}			
			
			$this->path_logs = $path2;
			
			$this->links = apply_filters('work_parser_links', array());
		}

		function load(){
			$time_start = microtime(true);
			$this->log_write('--- Start loading ---');
			
			if(count($this->links) == 0){
				$this->log_write('Not links');
				return;
			}		

			global $premiumbox;
			$vers = intval($premiumbox->get_option('newparser','parser'));
			
			$parser_pairs = ''; //get_option('parser_pairs');
			if(!is_array($parser_pairs)){ $parser_pairs = array(); }
			
			if($vers == 0){
				$parser_pairs = $this->set_curl_load($parser_pairs);
			} elseif($vers == 1){
				$parser_pairs = $this->set_ssh_load($parser_pairs);
			//} elseif($vers == 2){
				//$parser_pairs = $this->set_multi_curl_load($parser_pairs);	
			//} else {
				//$parser_pairs = $this->set_url_load($parser_pairs);
			}
			
			update_option('parser_pairs', $parser_pairs);
	
			$this->log_write('--- End loading by '. number_format(microtime(true)-$time_start, 4) .' second');
			$time = current_time('timestamp');
			update_option('time_new_parser', $time);
			
			do_action('load_new_parser_courses', $parser_pairs);
			
			update_directions_to_new_parser();
			update_currency_code_to_new_parser();
		}		
	
		function set_curl_load($parser_pairs){

			foreach($this->links as $birg_key => $link_data){
				
				$birg_url = trim(is_isset($link_data, 'url'));
				$birg_title = trim(is_isset($link_data, 'title'));
				
				$curl = get_curl_parser($birg_url, '', 'new_parser');
				if(!$curl['err']){
					$this->log_write('Link load '. $birg_url);
					$output = $curl['output'];
					$parser_pairs = apply_filters('set_parser_pairs', $parser_pairs, $output, $birg_key);
				} else {
					$this->log_write('Link error load '. $birg_url, 1);
				}
				
			}	
			
			return $parser_pairs;
		}

		function set_ssh_load($parser_pairs){
			
			$repeats = 3;
			$timeout = 3;			
			$last_domain = '';
			
			foreach($this->links as $birg_key => $link_data){
				
				$birg_url = trim(is_isset($link_data, 'url'));
				$birg_title = trim(is_isset($link_data, 'title'));
				
				if(parse_url($birg_url, PHP_URL_HOST) == $last_domain){
					usleep($timeout * 1000000);
				}
				
				$last_domain = parse_url($birg_url, PHP_URL_HOST);
				
				$data = false;
				
				$r=0;
				while($r++ <= $repeats){
					$data = $this->get_ssh_load($birg_url);
					if($data === false OR strlen($data) == 0){
						$data = false;
						$this->log_write('Link error load '. $birg_url . ', repeat: ' . $r, 1);
					} else {
						$this->log_write('Link load '. $birg_url . ', repeat: ' . $r);
						break;
					}
				}
				
				if($data === false){
					$this->log_write('Link error load '. $birg_url . ', repeat: all', 1);
				} else {
					$parser_pairs = apply_filters('set_parser_pairs', $parser_pairs, $data, $birg_key);
				}
				
			}

			return $parser_pairs;
		}

		// function set_multi_curl_load($parser_pairs){
			
			// $links_parts = array_chunk($this->links, $this->parts);
			
			// $mc = JMathai\PhpMultiCurl\MultiCurl::getInstance();
			
			// foreach($links_parts as $pc => $links){
			
				// $this->log_write('Load part '.($pc+1).', off '.count($links_parts));
				
				// $calls = array();
				
				// foreach($links as $birg_key => $link_data){
					
					// $birg_url = trim(is_isset($link_data, 'url'));
					// $birg_title = trim(is_isset($link_data, 'title'));
					
					// $ch = curl_init($file_url);
					
					// curl_setopt_array($ch, array(
						// CURLINFO_HEADER_OUT => true,
						// CURLOPT_RETURNTRANSFER => true,
						// CURLOPT_FOLLOWLOCATION => true,
						// CURLOPT_MAXREDIRS => 3,
						// CURLOPT_SSL_VERIFYPEER => 0,
						// CURLOPT_SSL_VERIFYHOST => 0,
						// CURLOPT_CONNECTTIMEOUT => 5,
						// CURLOPT_TIMEOUT => 10,
						// CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
						// CURLOPT_ENCODING => '',
						// CURLOPT_PROTOCOLS => CURLPROTO_HTTP|CURLPROTO_HTTPS,
						// CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
						// CURLOPT_HTTPHEADER => array(
							// 'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
							// 'Cache-Control: no-cache',
							// 'Pragma: no-cache'
						// )
					// ));
					
					// $calls[$birg_key] = $mc->addCurl($ch);
					
				// }
				
				// foreach($calls as $birg_key => $res){
					
					// $response = $res->response;
					
					// if($res->code != 200 OR empty($response)){
						// $this->log_write('Birg error load '. $birg_key . ', code: ' . (int)$res->code, 1);
						// continue;
					// }
					
					// $this->log_write('Birg load '. $birg_key);
					
					// $parser_pairs = apply_filters('set_parser_pairs', $parser_pairs, $response, $birg_key);
					
				// }
			
			// }

			// return $parser_pairs;
		// }

		function set_url_load($parser_pairs){
			global $premiumbox;
			$url = trim($premiumbox->get_option('newparser','url'));
			
			
			
			return $parser_pairs;
		}		
	
		function get_ssh_load($url, $post=false){
			$command = 'wget -O - -q -T 10 --no-check-certificate --no-cache --max-redirect 3 --header "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4" --user-agent "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36"';
			if($post !== false){
				if(is_array($post)){
					$post = http_build_query($post);
				}
				$command .=  ' --post-data "'.$post.'"';
			}
			$command .=  ' "'.$url.'"';
			$result = shell_exec($command);
			if(empty($result) AND strlen($result) > 10){
				return false;
			}
			return $result;			
		}	
	
		function log_write($log='', $error=0){
		
			$error = intval($error);
			$time = current_time('timestamp');
			
			global $premiumbox;
			$enable_log = intval($premiumbox->get_option('newparser','parser_log'));
			if($enable_log == 1){
				if($error == 0){
					$line = '[INFO time="'. date('d.m.Y H:i:s', $time) .'"] ' . $log . "\n";
					@file_put_contents($this->path_logs . date('d-m-Y', $time) . '.txt', $line, FILE_APPEND|LOCK_EX);
				} else {
					$line = '[ERROR time="'. date('d.m.Y H:i:s', $time) .'"] ' . $log . "\n";
					@file_put_contents($this->path_logs . date('d-m-Y', $time) . '.txt', $line, FILE_APPEND|LOCK_EX);
				}		
			}
		}	
	}
}	

function new_parser_upload_data(){
	$parser = new PremiumParser();
	$parser->load();
}

add_filter('list_cron_func', 'new_parser_list_cron_func');
function new_parser_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['new_parser_upload_data'] = array(
			'title' => __('Rates parser','pn'),
			'site' => '1hour',
		);
	}
	
	return $filters;
}