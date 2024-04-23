<?php
/*
title: [en_US:]Qiwi new[:en_US][ru_RU:]Qiwi new[:ru_RU]
description: [en_US:]Qiwi new merchant[:en_US][ru_RU:]мерчант Qiwi new[:ru_RU]
version: 1.5
*/

if(!class_exists('merchant_qiwinew')){
	class merchant_qiwinew extends Merchant_Premiumbox {

		function __construct($file, $title)
		{
			$map = array(
				'API_TOKEN_KEY', 'API_WALLET', 
			);
			parent::__construct($file, $map, $title);
			
			add_action('get_merchant_admin_options_'. $this->name, array($this, 'get_merchant_admin_options'), 10, 2);
			add_filter('merchants_settingtext_'.$this->name, array($this, 'merchants_settingtext'));
			add_filter('merchant_formstep_autocheck',array($this, 'merchant_formstep_autocheck'),1,2);
			add_filter('merchant_pay_button_'.$this->name, array($this,'merchant_pay_button'),99,4);
			add_filter('get_text_pay', array($this,'get_text_pay'), 99, 3);
			add_action('myaction_merchant_'. $this->name .'_cron' . get_hash_result_url($this->name), array($this,'myaction_merchant_cron'));
		}

		function security_list(){
			return array('resulturl','show_error');
		}		
		
		function get_merchant_admin_options($options, $data){ 
			
			$text = '
			<strong>Cron:</strong> <a href="'. get_merchant_link($this->name.'_cron' . get_hash_result_url($this->name)) .'" target="_blank">'. get_merchant_link($this->name.'_cron' . get_hash_result_url($this->name)) .'</a>			
			';

			$options['private_line'] = array(
				'view' => 'line',
				'colspan' => 2,
			);			

			$options['vnaccount'] = array(
				'view' => 'select',
				'title' => __('Use wallets from Currency accounts section','pn'),
				'options' => array('0'=> __('No','pn'), '1'=> __('Yes','pn')),
				'default' => is_isset($data, 'vnaccount'),
				'name' => 'vnaccount',
				'work' => 'int',
			);

			$options['providerid'] = array(
				'view' => 'select',
				'title' => __('Payment method','pn'),
				'options' => array('0'=> 'Qiwi Wallet', '1963'=> 'Visa(RU)', '21013'=> 'MasterCard(RU)'),
				'default' => is_isset($data, 'providerid'),
				'name' => 'providerid',
				'work' => 'int',
			);			

			$options[] = array(
				'view' => 'textfield',
				'title' => '',
				'default' => $text,
			);
			
			if(isset($options['enableip'])){
				unset($options['enableip']);
			}
			if(isset($options['check_api'])){
				unset($options['check_api']);
			}
			if(isset($options['personal_secret'])){
				unset($options['personal_secret']);
			}			
			
			return $options;	
		}		
		
		function merchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data, 'API_TOKEN_KEY') 
				and is_deffin($this->m_data, 'API_WALLET') 
			){
				$text = '';
			}
			
			return $text;
		}

		function merchant_formstep_autocheck($autocheck, $m_id){
			
			if($m_id and $m_id == $this->name){
				$autocheck = 1;
			}
			
			return $autocheck;
		}		

		function get_text_pay($text, $m_id, $item){
			if($m_id and $m_id == $this->name){
				$text = str_replace('[id]','('. $item->id .')', $text);
			}
			return $text;
		}

		function merchant_pay_button($merchant_pay_button, $sum_to_pay, $bids_data, $direction){
		global $wpdb;
		
			$temp = '';
		
			$pay_sum = is_sum($sum_to_pay, 2); 
			$comment = get_text_pay($this->name, $bids_data, $pay_sum);						
				
			$data = get_merch_data($this->name);
			$vnaccount = intval(is_isset($data, 'vnaccount'));
			$providerid = intval(is_isset($data, 'providerid'));
			if(!$providerid){ $providerid = 99; }
				
			$qiwi_account = '';	
			if($vnaccount == 1){
				if(isset($bids_data->id)){
					$bid_id = $bids_data->id;
					$bid = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."exchange_bids WHERE id='$bid_id'");
					if(isset($bid->id)){
						$qiwi_account = pn_maxf_mb(pn_strip_input(is_isset($bid,'to_account')),500);
					}
				}
			}
			if(!$qiwi_account){
				$qiwi_account = is_deffin($this->m_data,'API_WALLET');
			}
			
			$qiwi_account = trim(str_replace('+','',$qiwi_account));
	
			$pay_sum = sprintf("%0.2F",$pay_sum);
			$sum = explode('.',$pay_sum);	

			$currency = 643; 
			// '643'=>'RUB',
			// '840'=>'USD',
			// '978'=>'EUR'					
		
			$temp = '<a href="https://qiwi.com/payment/form/'. $providerid .'?extra%5B%27account%27%5D=+'. $qiwi_account .'&amountInteger='. $sum[0] .'&amountFraction='. $sum[1] .'&extra%5B%27comment%27%5D='. $comment .'&currency='. $currency .'&blocked[0]=account&blocked[1]=comment&blocked[2]=sum" target="_blank" class="success_paybutton">'. __('Make a payment','pn') .'</a>';
		
			return $temp;			
		}

		function myaction_merchant_cron(){
			global $wpdb;

			$m_data = get_merch_data($this->name);
			$show_error = intval(is_isset($m_data, 'show_error'));	
			
			try {
				$class = new QIWI_API(is_deffin($this->m_data,'API_WALLET'), is_deffin($this->m_data,'API_TOKEN_KEY'), $show_error);
				$orders = $class->get_history(date('c',strtotime('-30 days')),date('c',strtotime('+1 day')));
				if(is_array($orders)){
					$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'new' AND m_in LIKE 'qiwinew%'");
					foreach($items as $item){
						$currency = $item->currency_code_give;
						$qiwi_account = pn_maxf_mb(pn_strip_input(is_isset($item,'to_account')),500);
						if(!$qiwi_account){ $qiwi_account = is_deffin($this->m_data,'API_WALLET'); }
						
						foreach($orders as $res){
							$id = $res['trans_id'];
							if($id == $item->id and $res['total_currency_sym'] == $currency and $res['status'] == 'SUCCESS'){
			
								$data = get_data_merchant_for_id($id, $item);
								
								$in_sum = $res['sum_amount'];
								$in_sum = is_sum($in_sum,2);
								$err = $data['err'];
								$status = $data['status'];
								$m_id = $data['m_id']; 
								
								$bid_currency = $data['currency'];
								
								$pay_purse = is_pay_purse(is_isset($res, 'account'), $m_data, $m_id);
									
								$bid_sum = is_sum($data['pay_sum'],2);	
								$bid_corr_sum = apply_filters('merchant_bid_sum', $bid_sum, $m_id);
								
								$invalid_ctype = intval(is_isset($m_data, 'invalid_ctype'));
								$invalid_minsum = intval(is_isset($m_data, 'invalid_minsum'));
								$invalid_maxsum = intval(is_isset($m_data, 'invalid_maxsum'));
								$invalid_check = intval(is_isset($m_data, 'check'));								
								
								if($err == 0){
									if($in_sum >= $bid_corr_sum or $invalid_minsum == 1){
										$params = array( 
											'pay_purse' => $pay_purse,
											'sum' => $in_sum,
											'bid_sum' => $bid_sum,
											'bid_corr_sum' => $bid_corr_sum,
											'to_account' => $qiwi_account,
											'trans_in' => $res['qiwi_id'],
											'invalid_ctype' => $invalid_ctype,
											'invalid_minsum' => $invalid_minsum,
											'invalid_maxsum' => $invalid_maxsum,
											'invalid_check' => $invalid_check,
											'm_place' => $m_id,
										);
										the_merchant_bid_status('realpay', $id, $params, 0); 														
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
					die($e);
				}
			}			
		}
		
	}
}

new merchant_qiwinew(__FILE__, 'Qiwi new');