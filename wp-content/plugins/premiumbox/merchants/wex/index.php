<?php
/*
title: [en_US:]WEX[:en_US][ru_RU:]WEX[:ru_RU]
description: [en_US:]WEX merchant[:en_US][ru_RU:]мерчант WEX[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_wex')){
	class merchant_wex extends Merchant_Premiumbox{
	
		function __construct($file, $title)
		{
			$map = array(
				'WEX_KEY', 'WEX_SECRET', 
			);
			parent::__construct($file, $map, $title);
			
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_bidaction_'.$this->name, array($this,'merchant_bidaction'),99,4);
			add_filter('get_merchant_admin_options_'.$this->name,array($this, 'get_merchant_admin_options'),1,2);
			add_action('myaction_merchant_'. $this->name .'_status', array($this,'myaction_merchant_status'));
		}	
		
		function security_list(){
			return array('show_error');
		}		
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'WEX_KEY')  
				and is_deffin($this->m_data,'WEX_SECRET') 
			){
				$text = '';
			}
			
			return $text;
		}

		function get_merchant_admin_options($options, $data){
					
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}					
			if(isset($options['check_api'])){
				unset($options['check_api']);
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
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}			
			
			return $options;
		}	
		
  		function merchant_bidaction($temp, $pay_sum, $item, $direction){
			$err = is_param_get('err');
			if($err == '-1'){ 
				$temp .= '
				<div class="error_div">
					'. __('You have not entered a coupon code','pn') .'
				</div>';
			} 
			if($err == '-2'){
				$temp .= '
				<div class="error_div">
					'. __('Coupon is not valid','pn') .'
				</div>';
			} 
			if($err == '-3'){ 
				$temp .= '
				<div class="error_div">
					'. __('Coupon amount does not match the required amount','pn') .'
				</div>';
			} 
			if($err == '-4'){
				$temp .= '
				<div class="error_div">
					'. __('Coupon currency code does not match the required currency','pn') .'
				</div>
				';	
			} 			
				
			$temp .= '	
			<div class="zone center"> 
				
				<p>'. __('In order to pay an ID order','pn') .' <b>'. $item->id.'</b>,<br /> '. __('enter coupon code valued','pn').' <b><span class="clpb_item" data-clipboard-text="'. $pay_sum .'">' . $pay_sum . '</span> WEX '. is_site_value($item->currency_code_give).'</b>:</p>
							
				<form action="'. get_merchant_link($this->name.'_status').'" method="post">
					<input type="hidden" name="hash" value="'. $item->hashed.'" />
					<p><input type="text" placeholder="'. __('Code','pn').'" required name="code" value="" /></p>
					<p><input type="submit" class="submit_form" formtarget="_top" value="'. __('Submit code','pn').'" /></p>
				</form>				
							
			</div>';
 
			return $temp;		
		}  
		
		function myaction_merchant_status(){
		global $wpdb;	

			$hashed = is_bid_hash(is_param_post('hash'));
			$code = trim(is_param_post('code'));
			if($hashed){
				$m_data = get_merch_data($this->name);
				$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
				if(isset($item->id)){
					$id = $item->id;
					$data = get_data_merchant_for_id($id, $item);
					$bid_err = $data['err'];
					$bid_status = $data['status'];
					$bid_m_id = $data['m_id'];
					if($bid_err == 0){
						$en_status = array('new', 'techpay', 'coldpay');
						if(in_array($bid_status, $en_status) and $bid_m_id and $bid_m_id == $this->name){
							
							$bid_currency = $data['currency'];
							$bid_currency = strtoupper(str_replace('RUB','RUR',$bid_currency));
							
							$bid_sum = is_sum($data['pay_sum']);
							$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $bid_m_id);							
							
							$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
							$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
							$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
							$invalid_check = intval(is_isset($m_data, 'check'));
							
							if($code){
								try{
									$res = new WEX(is_deffin($this->m_data,'WEX_KEY'),is_deffin($this->m_data,'WEX_SECRET'));
									$info = $res->redeem_voucher($code);
									if($info){
										$merch_sum = is_isset($info,'amount');
										$merch_currency = strtoupper(is_isset($info,'currency'));
										$merch_trans_id = trim(is_isset($info,'trans_id'));
										if($merch_sum >= $bid_corr_sum or $invalid_minsum == 1){
											if($merch_currency == $bid_currency or $invalid_ctype == 1){
												
												$pay_purse = is_pay_purse($code, $m_data, $bid_m_id);
												
												$params = array(
													'pay_purse' => $pay_purse,
													'sum' => $merch_sum,
													'bid_sum' => $bid_sum,
													'bid_corr_sum' => $bid_corr_sum,
													'trans_in' => $merch_trans_id,
													'currency' => $merch_currency,
													'bid_currency' => $bid_currency,
													'invalid_ctype' => $invalid_ctype,
													'invalid_minsum' => $invalid_minsum,
													'invalid_maxsum' => $invalid_maxsum,
													'invalid_check' => $invalid_check,	
													'm_place' => $bid_m_id,
												);
												the_merchant_bid_status('realpay', $id, $params, 0); 											
												 
												wp_redirect(get_bids_url($item->hashed));
												exit;					
												
											} else {
												$back = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed) .'&err=-4';
												wp_redirect($back);
												exit;
											}
										} else {
											$back = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed) .'&err=-3';
											wp_redirect($back);
											exit;					
										}
									} else {
										$back = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed) .'&err=-2';
										wp_redirect($back);
										exit;							
									}
								}
								catch (Exception $e)
								{
									$show_error = intval(is_isset($m_data, 'show_error'));
									if($show_error){
										die($e);
									}	
									$back = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed) .'&err=-2';
									wp_redirect($back);
									exit;						
								}					
							} else {
								$back = get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($item->hashed) .'&err=-1';
								wp_redirect($back);
								exit;				
							}
						} else {
							wp_redirect(get_bids_url($hashed));
							exit;
						}
					} else {
						pn_display_mess(__('Error!','pn'));
					}					
				} else {
					pn_display_mess(__('Error!','pn'));
				}	
			} else {
				pn_display_mess(__('Error!','pn'));
			}		

		}	 	
		
	}
}

new merchant_wex(__FILE__, 'WEX');