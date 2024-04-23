<?php
/*
title: [en_US:]PayKassa[:en_US][ru_RU:]PayKassa[:ru_RU]
description: [en_US:]PayKassa automatic payouts[:en_US][ru_RU:]авто выплаты PayKassa[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_paykassa')){
	class paymerchant_paykassa extends AutoPayut_Premiumbox{
		function __construct($file, $title)
		{
			$map = array(
				'BUTTON',  
				'API_ID', 'API_PASS','SHOP_ID'
			);
			parent::__construct($file, $map, $title, 'BUTTON');	
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));			
		}

		function security_list(){
			return array('show_error');
		}				
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}			

			$paymethods = array(
				'1' => 'payeer',
				'2' => 'perfectmoney',
				'4' => 'advcash',
				'11' => 'bitcoin',
				'12' => 'ethereum',
				'14' => 'litecoin',
				'15' => 'dogecoin',
				'16' => 'dash',
				'18' => 'bitcoincash',
				'19' => 'zcash',
				'20' => 'monero',
				'21' => 'ethereumclassic',
				'22' => 'ripple',
			);			
			
			$options['paymethod'] = array(
				'view' => 'select',
				'title' => __('Payment method','pn'),
				'options' => $paymethods,
				'default' => is_isset($data, 'paymethod'),
				'name' => 'paymethod',
				'work' => 'int',
			);
			
			$pay_comis = array(
				'0' => __('Exchanger','pn'),
				'1' => __('User','pn'),
			);			
			$options['pay_comis'] = array(
				'view' => 'select',
				'title' => __('Who pays fee','pn'),
				'options' => $pay_comis,
				'default' => is_isset($data, 'pay_comis'),
				'name' => 'pay_comis',
				'work' => 'int',
			);							
			
			return $options;
		}			
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(  
				is_deffin($this->m_data,'API_ID') 
				and is_deffin($this->m_data,'API_PASS') 
				and is_deffin($this->m_data,'SHOP_ID') 
			){
				$text = '';
			}
			
			return $text;
		}
		
		function get_reserve_lists(){
			$keys = array(
				'payeer_rub',
				'advcash_rub',
				'payeer_usd',
				'perfectmoney_usd',
				'advcash_usd',
				'bitcoin_btc',
				'ethereum_eth',
				'litecoin_ltc',
				'dogecoin_doge',
				'dash_dash',
				'bitcoincash_bch',
				'zcash_zec',
				'monero_xmr',
				'ethereumclassic_etc',
				'ripple_xrp',
			);
			$purses = array();
			foreach($keys as $key){
				$key = trim($key);
				if($key){
					$purses[$this->name.'_'.$key] = $key;
				}	
			}
			
			return $purses;
		}		

		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){ 
				$list[$k] = 'PayKassa '. $v .':'. is_deffin($this->m_data, $v).' ['. $this->name .']';
			}			
			
			return $list;
		}	

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
			
				if($this->check_reserv_list($key)){
					try {
						$class = new PayKassaAPI(is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_PASS'));
						$res = $class->api_get_shop_balance(is_deffin($this->m_data,'SHOP_ID'));	
					
						$now_key = str_replace($this->name.'_', '', $key);
					
						$rezerv = '-1';
					
						if(isset($res['data']) and is_array($res['data'])){
							foreach($res['data'] as $k => $v){
								if($now_key == $k){
									$rezerv = $v;
								}
							}
						}
							
						if($rezerv != '-1'){
							pm_update_vr($currency_id, $rezerv);
						}		
						
					}
					catch (Exception $e)
					{
							
					} 									
				
					return 1;
				}
			}
			
			return $ind;
		}

		function update_direction_reserv($ind, $key, $direction_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
					try{
						$class = new PayKassaAPI(is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_PASS'));
						$res = $class->api_get_shop_balance(is_deffin($this->m_data,'SHOP_ID'));
					
						$now_key = str_replace($this->name.'_', '', $key);
					
						$rezerv = '-1';
					
						if(isset($res['data']) and is_array($res['data'])){
							foreach($res['data'] as $k => $v){
								if($now_key == $k){
									$rezerv = $v;
								}
							}
						}
							
						if($rezerv != '-1'){
							pm_update_nr($direction_id, $rezerv);
						}					 
						
					}
					catch (Exception $e)
					{
							
					} 				
						
					return 1;
				}
			}
			
			return $ind;
		}		
		
		function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
			
			$item_id = $item->id;			
			$trans_id = 0;				
			
			$system_id = intval(is_isset($paymerch_data,'paymethod'));
			if(!$system_id){ $system_id = 1; }
			
			$pay_comis = intval(is_isset($paymerch_data,'pay_comis'));
			if($pay_comis == 1){
				$paid_commission = 'client';
			} else {
				$paid_commission = 'shop';
			}
			
			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace(array('RUR'),'RUB',$vtype);
		
			$account = $item->account_get;
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data));
						
			if(count($error) == 0){

				$result = $this->set_ap_status($item);
				if($result){
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('Order ID %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,100));
						
					try{
						
						$paykassa = new PayKassaAPI(is_deffin($this->m_data,'API_ID'), is_deffin($this->m_data,'API_PASS'));

						$res = $paykassa->api_payment(
							is_deffin($this->m_data,'SHOP_ID'),      // обязательный параметр, id магазина с которого нужно сделать выплату
							$system_id,    // обязательный параметр, id платежного метода
							$account,                // обязательный параметр, номер кошелька на который отправляем деньги
							$sum,         // обязательный параметр, сумма платежа, сколько отправить
							$vtype,              // обязательный параметр, валюта платежа
							$notice,                // обязательный параметр, комметнарий к платежу, можно передать пустой
							$paid_commission
						);

						if (isset($res['error']) and $res['error']) {        // $res['error'] - true если ошибка
							$error[] = $res['message'];   // $res['message'] - текст сообщения об ошибке
							$pay_error = 1;
						} elseif(isset($res['data'])) {
							$shop_id = $res['data']['shop_id'];                         // id магазина, с которого была сделана выплата, пример 122
							$trans_id = $res['data']['transaction'];                 // номер транзакции платежа, пример 130236
							$amount = $res['data']['amount'];                           // сумма выплаты, сколько списалось с баланса магазина, 1066.00
							$amount_pay = $res['data']['amount_pay'];                   // сумма выплаты, столько пришло пользователю, пример: 1000.00
							$system = $res['data']['system'];                           // система выплаты, на какую платежную систему была сделана выплата, пример: Payeer
							$currency = $res['data']['currency'];                       // валюта выплаты, пример: RUB
							$number = $res['data']['number'];                           // номер кошелька, куда были отправлены средства, пример: P123456
							$comission_percent = $res['data']['shop_comission_percent'];// комиссия за перевод в процентах, пример: 6.5
							$comission_amount = $res['data']['shop_comission_amount'];  // комиссия за перевод сумма, пример: 1.00
							$paid_commission = $res['data']['paid_commission'];         // кто оплачивал комиссию, пример: shop
						} else {
							$error[] = 'Class error';
							$pay_error = 1;
						}						
						
					}
					catch (Exception $e)
					{
						$error[] = $e;
						$pay_error = 1;
					} 
							
				} else {
					$error[] = 'Database error';
				}
									
			}
					
			if(count($error) > 0){
				
				$this->reset_ap_status($error, $pay_error, $item, $place);
				
			} else {	
			
				$params = array(
					'trans_out' => $trans_id,
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('success', $item_id, $params, 1); 						
						
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'), 'true');
				} 	
				
			}
		}				
	}
}

new paymerchant_paykassa(__FILE__, 'PayKassa');