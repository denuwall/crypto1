<?php
/*
title: [en_US:]BlockIo[:en_US][ru_RU:]BlockIo[:ru_RU]
description: [en_US:]Block.io merchant[:en_US][ru_RU:]мерчант Block.io[:ru_RU]
version: 1.5
*/

/* 
if (!extension_loaded('gmp')) {
    return;
}

if (!extension_loaded('mcrypt')) {
    return;
}

if (!extension_loaded('curl')) {
    return;
}
*/

if(!class_exists('merchant_blockio')){
	class merchant_blockio extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'BLOCKIO_SSL', 'BLOCKIO_CV', 'BLOCKIO_PIN',
				'BLOCKIO_BTC', 'BLOCKIO_LTC', 'BLOCKIO_DOGE', 
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_bidaction_'.$this->name, array($this,'merchant_bidaction'),99,4);
			add_filter('get_merchant_admin_options_'.$this->name,array($this, 'get_merchant_admin_options'),1,2);
			add_action('myaction_merchant_'. $this->name .'_cron'. get_hash_result_url($this->name), array($this,'myaction_merchant_cron'));
			add_action('myaction_merchant_'. $this->name .'_archive_cron'. get_hash_result_url($this->name), array($this,'myaction_merchant_archive_cron'));
			add_filter('merchant_formstep_after', array($this,'merchant_formstep_after'),99,5);
			add_action('myaction_merchant_'. $this->name .'_checkorder', array($this,'myaction_merchant_checkorder'));
			add_filter('list_user_notify',array($this,'user_mailtemp'));
			add_filter('list_admin_notify',array($this,'admin_mailtemp'));
			add_filter('list_notify_tags_generate_address1_blockio',array($this,'mailtemp_tags_generate_address'));
			add_filter('list_notify_tags_generate_address2_blockio',array($this,'mailtemp_tags_generate_address'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
		}
		
		function user_mailtemp($places_admin){
			
			$places_admin['generate_address1_blockio'] = sprintf(__('Address generation for %s','pn'), 'BlockIo');
			
			return $places_admin;
		}

		function admin_mailtemp($places_admin){
			
			$places_admin['generate_address2_blockio'] = sprintf(__('Address generation for %s','pn'), 'BlockIo');
			
			return $places_admin;
		}

		function mailtemp_tags_generate_Address($tags){
			
			$tags['bid_id'] = __('Order ID','pn');
			$tags['address'] = __('Address','pn');
			$tags['sum'] = __('Amount','pn');
			$tags['count'] = __('Confirmations','pn');
			
			return $tags;
		}				

		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_merchant_admin_options($options, $data){
			
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			if(isset($options['note'])){
				unset($options['note']);
			}
			if(isset($options['type'])){
				unset($options['type']);
			}
			if(isset($options['help_type'])){
				unset($options['help_type']);
			}
			if(isset($options['enableip'])){
				unset($options['enableip']);
			}
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}		

			$text = '
			<strong>CRON URL:</strong> <a href="'. get_merchant_link($this->name.'_cron'. get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_cron'. get_hash_result_url($this->name)) .'</a><br />
			<strong>CRON ARCHIVE URL:</strong> <a href="'. get_merchant_link($this->name.'_archive_cron'. get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_archive_cron'. get_hash_result_url($this->name)) .'</a>			
			';

			$options[] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);			
			
			return $options;
		}			
		
		function merchant_formstep_autocheck($autocheck, $m_id){
			
			if($m_id and $m_id == $this->name){
				$autocheck = 0;
			}
			
			return $autocheck;
		}		
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'BLOCKIO_PIN') 
			){
				$text = '';
			}
			
			return $text;
		}		

		function merchant_bidaction($temp, $pay_sum, $item, $direction){
			global $wpdb;

			$item_id = $item->id;		
			$currency = $item->currency_code_give;
			$currency_m = strtolower($currency);
				
			$to_account = pn_strip_input($item->to_account);
			if(!$to_account){
				
				$m_data = get_merch_data($this->name);
				$show_error = intval(is_isset($m_data, 'show_error'));
				
				$api = 0;
				if($currency == 'BTC'){
					$api = is_deffin($this->m_data,'BLOCKIO_BTC');
				} elseif($currency == 'LTC'){
					$api = is_deffin($this->m_data,'BLOCKIO_LTC');
				} elseif($currency == 'DOGE'){
					$api = is_deffin($this->m_data,'BLOCKIO_DOGE');
				}				

				try{
					$block_io = new BlockIo($api, is_deffin($this->m_data,'BLOCKIO_PIN'),2,is_deffin($this->m_data,'BLOCKIO_SSL'));
					$res = $block_io->get_new_address();	
					if(isset($res->status) and $res->status == 'success' and isset($res->data->address)){
						$to_account = pn_strip_input($res->data->address);
					}		
				}
				catch (Exception $e)
				{
					if($show_error){
						echo $e;
					}
				}	

				if($to_account){
					
					update_bid_tb($item_id, 'to_account', $to_account);
					
					$notify_tags = array();
					$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
					$notify_tags['[bid_id]'] = $item_id;
					$notify_tags['[address]'] = $to_account;
					$notify_tags['[sum]'] = $pay_sum;
					$notify_tags['[count]'] = intval(is_deffin($this->m_data,'BLOCKIO_CV'));
					$notify_tags = apply_filters('notify_tags_generate_address_blockio', $notify_tags);		

					$user_send_data = array();
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address2_blockio', $notify_tags, $user_send_data); 
					
					$user_send_data = array(
						'user_email' => $item->user_email,
						'user_phone' => '',
					);	
					$result_mail = apply_filters('premium_send_message', 0, 'generate_address1_blockio', $notify_tags, $user_send_data, $item->bid_locale);					
					
				} 
			}
			
 			if($to_account){	 
				$temp .= '		
				<div class="zone_table"> 
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $item_id .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('ID','pn') .'</div></div>
						<div class="zone_text">'. $item_id .'</div>
					</div>				
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $pay_sum .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('Amount','pn') .'</div></div>
						<div class="zone_text">'. $pay_sum .' '. $currency .'</div>					
					</div>				
					<div class="zone_div">
						<div class="zone_title"><div class="zone_copy clpb_item" data-clipboard-text="'. $to_account .'"><div class="zone_copy_abs">'. __('copied to clipboard','pn') .'</div>'. __('Address','pn') .'</div></div>
						<div class="zone_text">'. $to_account .'</div>					
					</div>				
				</div>
				<div class="zone center">
					'. sprintf(__('The order status changes to "Paid" when we get <b>%1$s</b> confirmations','pn'), is_deffin($this->m_data,'BLOCKIO_CV')) .'</p>
				</div>				
				';
			} else { 
				$temp .= '
				<div class="error_div">'. __('Error','pn') .'</div>
				';
			}  	
			return $temp;							
		}  

		function myaction_merchant_cron(){
			global $wpdb;

			$m_id = $this->name;
			$currencies = array('BTC','LTC','DOGE');
			foreach($currencies as $curr){
				$api = is_deffin($this->m_data,'BLOCKIO_'.$curr);
				if($api){
				
					$m_data = get_merch_data($this->name);
					$show_error = intval(is_isset($m_data, 'show_error'));
				
					try{
						
						$block_io = new BlockIo($api, is_deffin($this->m_data,'BLOCKIO_PIN'), 2, is_deffin($this->m_data,'BLOCKIO_SSL'));
						$res = $block_io->get_transactions(array('type' => 'received'));
						if(isset($res->status) and $res->status == 'success' and isset($res->data->network) and isset($res->data->txs)){
							if($curr == $res->data->network){			
								$n_conf = intval(is_deffin($this->m_data,'BLOCKIO_CV'));
						
								foreach($res->data->txs as $data){
									$confirmations = $data->confirmations;
										
									$sender = '';
									if(isset($data->senders[0])){
										$sender = $data->senders[0];
									}
										
									$amount = '0';
									if(isset($data->amounts_received[0]->amount)){
										$amount = is_sum($data->amounts_received[0]->amount);
									}

									$address = '';
									if(isset($data->amounts_received[0]->recipient)){
										$address = $data->amounts_received[0]->recipient;
									}	
									
									$trans_id = 0;
									if(isset($data->txid)){
										$trans_id = $data->txid;
									}									

									if($amount > 0 and $address){
										$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status IN ('new','coldpay') AND currency_code_give='$curr' AND to_account='$address' AND m_in='$m_id'");
										if(isset($item->id)){
											$bid_status = $item->status;
												
											$pay_purse = apply_filters('pay_purse_merchant', $sender, $m_data, $m_id);
											
											$id = $item->id;
											$bid_data = get_data_merchant_for_id($id, $item);
											
											$bid_sum = $bid_data['pay_sum'];
											$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $m_id);
											
											$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
											$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
											$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
											$invalid_check = intval(is_isset($m_data, 'check'));
											
											if($amount >= $bid_corr_sum or $invalid_minsum == 1){
													
												do_action('merchant_confirm_count', $item->id, $confirmations, $item, $bid_data['direction_data'], $n_conf, $this->name);	

												$now_status = '';
												
												if($confirmations >= $n_conf){
													if($bid_status == 'new' or $bid_status == 'coldpay'){
														$now_status = 'realpay';														
													}  
												} else {
													if($bid_status == 'new'){
														$now_status = 'coldpay';														
													}	
												}	
												if($now_status){
													$params = array(
														'pay_purse' => $pay_purse,
														'sum' => $amount,
														'bid_sum' => $bid_sum,
														'bid_corr_sum' => $bid_corr_sum,
														'trans_in' => $trans_id,
														'invalid_ctype' => $invalid_ctype,
														'invalid_minsum' => $invalid_minsum,
														'invalid_maxsum' => $invalid_maxsum,
														'invalid_check' => $invalid_check,	
														'm_place' => $m_id,
													);
													the_merchant_bid_status($now_status, $item->id, $params, 0);													
												}
											}	
										}
									}
								}
							}
						} 
					}
					catch (Exception $e)
					{
						if($show_error){
							echo $e;
						}
					}		
				}
			}
		}
		
		function myaction_merchant_archive_cron(){
			global $wpdb;

			$m_id = $this->name;
			$apis = array();
			$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'success' AND to_account != '' AND m_in='$m_id' ORDER BY id DESC LIMIT 50");
			foreach($items as $item){
				$currency = trim(mb_strtoupper($item->currency_code_give));
				$to_account = pn_strip_input($item->to_account);
				if($to_account){
					$apis[$currency][] = $to_account;
				}
			}
			
			foreach($apis as $curr => $datas){
				$api_key = trim(is_deffin($this->m_data,'BLOCKIO_'.$curr));
				if($api_key and is_array($datas) and count($datas) > 0){
					$addresses = join(',', $datas);
					$this->archive_request($api_key, $addresses);
				}
			}
			
			_e('Done', 'pn');
		}		

		function merchant_formstep_after($temp, $m_id, $direction, $vd1, $vd2){
		global $bids_data;	
			if($m_id and $m_id == $this->name){
				$temp .= '
				<div class="block_warning_merch">
					<div class="block_warning_merch_ins">		
						<p>'. __('Attention! Click "Check payment", if you have aready paid the order.','pn') .'</p>		
					</div>
				</div>
							
				<div class="block_paybutton_merch">
					<div class="block_paybutton_merch_ins">				
						<a href="'. get_merchant_link($this->name.'_checkorder') .'?order='. $bids_data->id .'" class="merch_paybutton">'. __('Check payment','pn') .'</a>				
					</div>
				</div>							
				';	
			}
			return $temp;
		}

		function myaction_merchant_checkorder(){
			global $wpdb;

			$item_id = intval(is_param_get('order'));
			if($item_id > 0){
			
				$m_id = $this->name;

				$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$item_id' AND m_in='$m_id' AND status != 'auto' AND currency_code_give IN('BTC','LTC','DOGE')");
				if(isset($item->id)){
					$to_account = $item->to_account;
					if($to_account){
							
						$m_data = get_merch_data($this->name);
						$show_error = intval(is_isset($m_data, 'show_error'));							
							
						$id = $item->id;
						$bid_data = get_data_merchant_for_id($id);	

						$bid_currency = $bid_data['currency'];
						
						if($item->status == 'new' or $item->status == 'coldpay'){
									
							$api = 0;
							if($bid_currency == 'BTC'){
								$api = is_deffin($this->m_data,'BLOCKIO_'.$bid_currency);
							} elseif($bid_currency == 'LTC'){
								$api = is_deffin($this->m_data,'BLOCKIO_'.$bid_currency);
							} elseif($bid_currency == 'DOGE'){
								$api = is_deffin($this->m_data,'BLOCKIO_'.$bid_currency);
							}
									
							if($api){
								try{	
									$block_io = new BlockIo($api, is_deffin($this->m_data,'BLOCKIO_PIN'), 2, is_deffin($this->m_data,'BLOCKIO_SSL'));
									$res = $block_io->get_transactions(array('type' => 'received', 'addresses' => $naschet));
									if(isset($res->status) and $res->status == 'success' and isset($res->data->network) and isset($res->data->txs)){
										if($bid_currency == $res->data->network){			
											$n_conf = intval(is_deffin($this->m_data,'BLOCKIO_CV'));
												
											foreach($res->data->txs as $data){
												$confirmations = $data->confirmations;
	
												$sender = '';
												if(isset($data->senders[0])){
													$sender = $data->senders[0];
												}
																
												$amount = '0';
												if(is_object($data) and isset($data->amounts_received[0]->amount)){
													$amount = is_sum($data->amounts_received[0]->amount,8);
												}

												$address = '';
												if(is_object($data) and isset($data->amounts_received[0]->recipient)){
													$address = $data->amounts_received[0]->recipient;
												}	

												$trans_id = 0;
												if(isset($data->txid)){
													$trans_id = $data->txid;
												}	
														
												if($amount > 0 and $address){
													if($to_account == $address){
														
														$pay_purse = apply_filters('pay_purse_merchant', $sender, $m_data, $m_id);
																
														$bid_sum = $bid_data['pay_sum'];
														$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $m_id);		
																
														$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
														$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
														$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
														$invalid_check = intval(is_isset($m_data, 'check'));																
																
														if($amount >= $bid_corr_sum or $invalid_minsum == 1){
																		
															do_action('merchant_confirm_count', $item->id, $confirmations, $item, $bid_data['direction_data'], $n_conf, $this->name);	
																	
															$now_status = '';
																	
															if($confirmations >= $n_conf){
																if($item->status == 'new' or $item->status == 'coldpay'){
																	$now_status = 'realpay';																			
																} 
															} else {
																if($item->status == 'new'){
																	$now_status = 'coldpay';																				
																}	
															}
															if($now_status){
																$params = array(
																	'pay_purse' => $pay_purse,
																	'sum' => $amount,
																	'bid_sum' => $bid_sum,
																	'bid_corr_sum' => $bid_corr_sum,
																	'trans_in' => $trans_id,
																	'invalid_ctype' => $invalid_ctype,
																	'invalid_minsum' => $invalid_minsum,
																	'invalid_maxsum' => $invalid_maxsum,
																	'invalid_check' => $invalid_check,
																	'm_place' => $m_id,
																);
																the_merchant_bid_status($now_status, $item->id, $params, 0);																
															}
														}				
													}		
												}
											}
										}
									} 
								}
								catch (Exception $e)
								{
												
								}										
							}	
						}	
									
						$url = get_bids_url($item->hashed);
						wp_redirect($url);
						exit;		
						
					} else {
						$url = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed);
						wp_redirect($url);
						exit;
					}
				} else {
					pn_display_mess(__('Error!','pn'));
				}
			} else {
				pn_display_mess(__('Error!','pn'));
			}			
	
		}
		
		function archive_request($api_key, $addresses){
			get_curl_parser('https://block.io/api/v2/archive_addresses/?api_key='. $api_key .'&addresses='.$addresses, array(), 'merchant', 'blockio');			
		}
		
	}
}

new merchant_blockio(__FILE__, 'BlockIo');