<?php
if(!class_exists('QIWI_API')){
class QIWI_API {
	
    private $api_wallet = "";
	private $api_token_key = "";
	private $test = 0;	
	
    function __construct($api_wallet, $api_token_key, $test){
		$this->api_wallet = trim($api_wallet);
		$this->api_token_key = trim($api_token_key);
		$this->test = trim($test);
    }
	
    public function get_history($start_date, $end_date) { 
		
		$cur_syms = array(
			'643'=>'RUB',
			'840'=>'USD',
			'978'=>'EUR'
		);
	
		$curl_data = array(
			'rows'=> 50,
			'operation'=>'IN', //OUT
			'startDate'=> $start_date,
			'endDate'=> $end_date
		);
	
		$result = $this->request('https://edge.qiwi.com/payment-history/v2/persons/'. $this->api_wallet .'/payments?'.http_build_query($curl_data));
		
		$trans = array();
		
		if(isset($result['data']) and is_array($result['data'])){
			foreach($result['data'] as $d){
				if(isset($d['comment']) AND is_string($d['comment'])){
					
					$trans_id = 0;
					if(preg_match('/\((.*?)\)/is', $d['comment'], $item)){	
						$trans_id = trim(is_isset($item, 1));
						$trans_id = intval($trans_id);
					}
					$trans[$trans_id] = array(
						'trans_id'=> $trans_id,
						'qiwi_id'=>(string)$d['txnId'],
						'date'=>(string)$d['date'],
						'status'=>(string)$d['status'],
						'client_id'=>(string)$d['trmTxnId'],
						'account'=>(string)$d['account'],
						'sum_amount'=>(string)$d['sum']['amount'],
						'sum_currency'=>(string)$d['sum']['currency'],
						'total_amount'=>(string)$d['total']['amount'],
						'total_currency'=>(string)$d['total']['currency'],
						'total_currency_sym'=>$cur_syms[(string)$d['total']['currency']],
						'comment'=>(string)$d['comment'],
						'data'=>$d
					);
				}
			}
		}
		
		return $trans;		
    }	
	
    private function request($request_url, $post_data=false) {
		
		$headers = array(
			'Accept: application/json',
			'Content-type: application/json',
			'Authorization: Bearer '. $this->api_token_key,
		);

		$c_options = array(
			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_HTTPHEADER => $headers,
			
			CURLINFO_HEADER_OUT => true,
			CURLOPT_MAXREDIRS => 3,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
			CURLOPT_ENCODING => '',
			CURLOPT_PROTOCOLS => CURLPROTO_HTTP|CURLPROTO_HTTPS,
		);
		
		if($post_data !== false){
			$c_options[CURLOPT_CUSTOMREQUEST] = 'POST';
			$c_options[CURLOPT_POSTFIELDS] = $post_data;
		}	
		
		$prox = array();
		
		/*
		для добавления еще одного proxy,
		копируем код и повторяем со своими данными
		*/		
		
		/* code */
		// $prox[] = array(
			// 'ip' => '', /* 255.255.255.0 */
			// 'port' => '', /* 80 */
			// 'login' => '', /* login */
			// 'password' => '', /* password */
		// );
		/* end code */
		
		shuffle($prox);
		
		$now = is_isset($prox,'0');
		$ip = trim(is_isset($now,'ip'));
		$port = trim(is_isset($now,'port'));
		$login = trim(is_isset($now,'login'));
		$password = trim(is_isset($now,'password'));		
		
		if($ip and $port){
			
			/* 	$c_options[CURLOPT_HTTPPROXYTUNNEL] = 0; */
			
			$c_options[CURLOPT_PROXY] = $ip;
			$c_options[CURLOPT_PROXYPORT] = $port;
			
			if($password and $login){
				$c_options[CURLOPT_PROXYUSERPWD] = $login.':'.$password;
			} elseif($password){
				$c_options[CURLOPT_PROXYAUTH] = $password;
			}
		}				
		
		$result = get_curl_parser($request_url, $c_options, 'merchant', 'qiwinew');
		
		if($this->test == 1){
			print_r($result);
			exit;
		}
		
		$output = $result['output'];
		
		if(!(!empty($output) and $output = json_decode($output, true) and is_array($output) and !isset($output['errorCode']) AND !isset($output['message']))){
			$output = false;
		}	

		return $output;
	
    }
}
}