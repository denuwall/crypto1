<?php
/*
title: [en_US:]BlockIo[:en_US][ru_RU:]BlockIo[:ru_RU]
description: [en_US:]BlockIo automatic payouts[:en_US][ru_RU:]авто выплаты BlockIo[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_blockio')){
	class paymerchant_blockio extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'AP_BLOCKIO_BUTTON', 'AP_BLOCKIO_SSL', 'AP_BLOCKIO_PIN', 
				'AP_BLOCKIO_BTC', 'AP_BLOCKIO_LTC', 'AP_BLOCKIO_DOGE', 
			);
			parent::__construct($file, $map, $title, 'AP_BLOCKIO_BUTTON');
			
			add_action('get_paymerchant_admin_options_'.$this->name, array($this, 'get_paymerchant_admin_options'), 10, 2);			
			add_filter('paymerchants_settingtext_'.$this->name, array($this, 'paymerchants_settingtext'));
			add_filter('reserv_place_list',array($this,'reserv_place_list'));
			add_filter('update_currency_autoreserv', array($this,'update_currency_autoreserv'), 10, 3);
			add_filter('update_direction_reserv', array($this,'update_direction_reserv'), 10, 3);
		}	
		
		function security_list(){
			return array('show_error');
		}		
		
		function get_paymerchant_admin_options($options, $data){
			
			if(isset($options['note'])){
				unset($options['note']);
			}			
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}						
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			$opt = array(
				'low' => 'low',
				'medium' => 'medium',
				'high' => 'high',
			);
			$priority = trim(is_isset($data, 'priority'));
			if(!$priority){ $priority = 'low'; }
			$options[] = array(
				'view' => 'select',
				'title' => __('Network payment priority','pn'),
				'options' => $opt,
				'default' => $priority,
				'name' => 'priority',
				'work' => 'input',
			);											
			
			return $options;
		}				

		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'AP_BLOCKIO_PIN')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => array(
					'title' => 'BTC',
					'key' => is_deffin($this->m_data,'AP_BLOCKIO_BTC'),
				),
				$this->name.'_2' => array(
					'title' => 'LTC',
					'key' => is_deffin($this->m_data,'AP_BLOCKIO_LTC'),
				),
				$this->name.'_3' => array(
					'title' => 'DOGE',
					'key' => is_deffin($this->m_data,'AP_BLOCKIO_DOGE'),
				),
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$key = trim($v['key']);
				if($key){
					$list[$k] = 'BlockIo '. $v['title'].' ['. $this->name .']';
				}
			}
			
			return $list;						
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				 
					$purses = array(
						$this->name.'_1' => is_deffin($this->m_data,'AP_BLOCKIO_BTC'),
						$this->name.'_2' => is_deffin($this->m_data,'AP_BLOCKIO_LTC'),
						$this->name.'_3' => is_deffin($this->m_data,'AP_BLOCKIO_DOGE'),
					);
					
					$api = trim(is_isset($purses, $key));
					if($api){
						
						try{
					
							$block_io = new AP_BlockIo($api, is_deffin($this->m_data,'AP_BLOCKIO_PIN'), 2, is_deffin($this->m_data,'AP_BLOCKIO_SSL'));
							$res = $block_io->get_balance();	
							if(isset($res->status) and $res->status == 'success' and isset($res->data->available_balance)){
								$rezerv = (string)$res->data->available_balance;
								pm_update_vr($currency_id, $rezerv);
							}			
						
						}
						catch (Exception $e)
						{
							
						} 				
						
						return 1;
					}
				
				}
			}
			
			return $ind;
		}

		function update_direction_reserv($ind, $key, $direction_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					$purses = array(
						$this->name.'_1' => is_deffin($this->m_data,'AP_BLOCKIO_BTC'),
						$this->name.'_2' => is_deffin($this->m_data,'AP_BLOCKIO_LTC'),
						$this->name.'_3' => is_deffin($this->m_data,'AP_BLOCKIO_DOGE'),
					);
					
					$api = trim(is_isset($purses, $key));
					if($api){
						
						try{
					
							$block_io = new AP_BlockIo($api, is_deffin($this->m_data,'AP_BLOCKIO_PIN'), 2, is_deffin($this->m_data,'AP_BLOCKIO_SSL'));
							$res = $block_io->get_balance();	
							if(isset($res->status) and $res->status == 'success' and isset($res->data->available_balance)){
								$rezerv = (string)$res->data->available_balance;
								pm_update_nr($direction_id, $rezerv);
							}			
						
						}
						catch (Exception $e)
						{
							
						} 				
						
						return 1;
					}
				
				}
			}
			
			return $ind;
		}		

		function do_auto_payouts($error, $pay_error, $item, $direction_data, $paymerch_data, $unmetas, $place, $modul_place){
			
			$trans_id = 0;	
			$item_id = $item->id;
			
			$vtype = mb_strtoupper($item->currency_code_get);
					
			$enable = array('BTC','LTC','DOGE');		
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}					
					
			$account = $item->account_get;
			if (!$account) {
				$error[] = __('Client wallet type does not match with currency code','pn');
			}				
					
			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data));
			$minsum = '0.00005';
			if($sum < $minsum){
				$error[] = sprintf(__('Minimum payment amount is %s','pn'), $minsum);
			}		
					
			$api = 0;
			if($vtype == 'BTC' and is_deffin($this->m_data,'AP_BLOCKIO_BTC')){
				$api = is_deffin($this->m_data,'AP_BLOCKIO_BTC');
			} elseif($vtype == 'LTC' and is_deffin($this->m_data,'AP_BLOCKIO_LTC')){
				$api = is_deffin($this->m_data,'AP_BLOCKIO_LTC');
			} elseif($vtype == 'DOGE' and is_deffin($this->m_data,'AP_BLOCKIO_DOGE')){
				$api = is_deffin($this->m_data,'AP_BLOCKIO_DOGE');
			}
					
			if(!$api){	
				$error[] = 'Error interfaice';
			}
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);				
				if($result){				
					
					try{
							
						$block_io = new AP_BlockIo($api, is_deffin($this->m_data,'AP_BLOCKIO_PIN'), 2, is_deffin($this->m_data,'AP_BLOCKIO_SSL'));
								
						$priority = trim(is_isset($paymerch_data, 'priority'));
						$prio = array('low','medium','high');
						if(!in_array($priority, $prio)){
							$priority = 'low';
						}
						$res_data = array('amounts' => $sum, 'to_addresses' => $account, 'priority' => $priority, 'pin' => is_deffin($this->m_data,'AP_BLOCKIO_PIN'));
						$res = $block_io->withdraw($res_data);
						if(isset($res->data->txid)){
							$trans_id = $res->data->txid;
						}								
						if(!isset($res->status) or $res->status != 'success' or !isset($res->data->amount_sent)){
							$error[] = __('Payout error','pn');
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
					'system' => 'user',
					'ap_place' => $place,
					'm_place' => $modul_place. ' ' .$this->name,
				);
				the_merchant_bid_status('success', $item_id, $params, 1); 					
						 
				if($place == 'admin'){
					pn_display_mess(__('Automatic payout is done','pn'),__('Automatic payout is done','pn'),'true');
				} 
			}			
		}				
		
	}
}

new paymerchant_blockio(__FILE__, 'BlockIo');