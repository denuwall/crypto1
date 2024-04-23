<?php
/*
title: [en_US:]Webmoney Light[:en_US][ru_RU:]Webmoney Light[:ru_RU]
description: [en_US:]Webmoney Light automatic payouts[:en_US][ru_RU:]авто выплаты Webmoney Light[:ru_RU]
version: 1.5
*/

if(!class_exists('paymerchant_webmoney_light')){
	class paymerchant_webmoney_light extends AutoPayut_Premiumbox{

		function __construct($file, $title)
		{
			$map = array(
				'BUTTON', 'WMID', 'KEYPATH', 'KEYPASS', 'CERTPATH',
				'WMZ_PURSE', 'WMR_PURSE',
				'WME_PURSE', 'WMU_PURSE', 'WMB_PURSE',
				'WMY_PURSE', 'WMG_PURSE', 'WMX_PURSE', 
				'WMK_PURSE', 'WML_PURSE', 'WMH_PURSE',
				
			);
			parent::__construct($file, $map, $title, 'AP_BUTTON');
			
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
					
			if(isset($options['resulturl'])){
				unset($options['resulturl']);
			}
			
			$html_request = '';
			$num_request = intval(get_option('old_webmoney_id'));
			$new_request = intval(is_isset($data, 'num_request'));
			if($num_request > 0 and $new_request < 1){
				$html_request = ' ('. $num_request . ')';
			}
			
			if(isset($options['checkpay'])){
				unset($options['checkpay']);
			}				
			
			$options[] = array(
				'view' => 'input',
				'title' => __('Current payment ID','pn') . $html_request,
				'default' => is_isset($data, 'num_request'),
				'name' => 'num_request',
				'work' => 'int',
			);								
			
			return $options;
		}			
		
		function paymerchants_settingtext(){
			$text = '| <span class="bred">'. __('Config file is not set up','pn') .'</span>';
			if(
				is_deffin($this->m_data,'WMID') 
				and is_deffin($this->m_data,'KEYPASS')  
			){
				$text = '';
			}
			
			return $text;
		}

		function get_reserve_lists(){
			
			$purses = array(
				$this->name.'_1' => is_deffin($this->m_data,'WMZ_PURSE'),
				$this->name.'_2' => is_deffin($this->m_data,'WMR_PURSE'),
				$this->name.'_3' => is_deffin($this->m_data,'WME_PURSE'),
				$this->name.'_4' => is_deffin($this->m_data,'WMU_PURSE'),
				$this->name.'_5' => is_deffin($this->m_data,'WMB_PURSE'),
				$this->name.'_6' => is_deffin($this->m_data,'WMY_PURSE'),
				$this->name.'_7' => is_deffin($this->m_data,'WMG_PURSE'),
				$this->name.'_8' => is_deffin($this->m_data,'WMX_PURSE'),
				$this->name.'_9' => is_deffin($this->m_data,'WMK_PURSE'),
				$this->name.'_10' => is_deffin($this->m_data,'WML_PURSE'),
				$this->name.'_11' => is_deffin($this->m_data,'WMH_PURSE'),
			);
			
			return $purses;
		}		
		
		function reserv_place_list($list){
			
			$purses = $this->get_reserve_lists();
			foreach($purses as $k => $v){
				$v = trim($v);
				if($v){
					$list[$k] = 'Webmoney Light '. $v.' ['. $this->name .']';
				}
			}
			
			return $list;						
		}

		function update_currency_autoreserv($ind, $key, $currency_id){
			$ind = intval($ind);
			if($ind == 0){
				if($this->check_reserv_list($key)){
				
					$purses = $this->get_reserve_lists();
					
					$purse = trim(is_isset($purses, $key));
					if($purse){
						
						try{
					
							$oWMXI = new WMXI( PN_PLUGIN_DIR .'paymerchants/'. $this->name .'/classed/wmxi.crt', 'UTF-8' );
							$oWMXI->Light( array( 'key' => is_deffin($this->m_data,'KEYPATH'), 'cer' => is_deffin($this->m_data,'CERTPATH'), 'pass' => is_deffin($this->m_data,'KEYPASS') ) );
							$aResponse = $oWMXI->X9( is_deffin($this->m_data,'WMID') )->toObject();
							$server_reply = is_isset($aResponse, 'retval');
							if($server_reply == '0'){
								
								if(isset($aResponse->purses->purse)){
									$wmid_purses = $aResponse->purses->purse;
								
									$rezerv = '-1';
								
									foreach($wmid_purses as $wp){
										if( $wp->pursename == $purse ){
											$rezerv = (string)$wp->amount;
											break;
										}
									}						
								
									if($rezerv != '-1'){
										pm_update_vr($currency_id, $rezerv);
									}
								
								}

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
			if(!$ind){
				if($this->check_reserv_list($key)){
					$purses = $this->get_reserve_lists();
					$purse = trim(is_isset($purses, $key));
					if($purse){
						
						try{
								
							$oWMXI = new WMXI( PN_PLUGIN_DIR .'paymerchants/'. $this->name .'/classed/wmxi.crt', 'UTF-8' );
							$oWMXI->Light( array( 'key' => is_deffin($this->m_data,'KEYPATH'), 'cer' => is_deffin($this->m_data,'CERTPATH'), 'pass' => is_deffin($this->m_data,'KEYPASS') ) );
							$aResponse = $oWMXI->X9( is_deffin($this->m_data,'WMID') )->toObject();
							$server_reply = is_isset($aResponse, 'retval');
							if($server_reply == '0'){
								
								if(isset($aResponse->purses->purse)){
									$wmid_purses = $aResponse->purses->purse;
								
									$rezerv = '-1';
								
									foreach($wmid_purses as $wp){
										if( $wp->pursename == $purse ){
											$rezerv = (string)$wp->amount;
											break;
										}
									}						
								
									if($rezerv != '-1'){
										pm_update_nr($direction_id, $rezerv);
									}
								
								}

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
			$item_id = $item->id;
			$trans_id = 0;			
			
			$vtype = mb_strtoupper($item->currency_code_get);
			$vtype = str_replace(array('WMZ','USD'),'Z',$vtype);
			$vtype = str_replace(array('RUR','WMR','RUB'),'R',$vtype);
			$vtype = str_replace(array('WME','EUR'),'E',$vtype);
			$vtype = str_replace(array('WMU','UAH'),'U',$vtype);
			$vtype = str_replace(array('WMB','BYR'),'B',$vtype);
			$vtype = str_replace(array('WMY','UZS'),'Y',$vtype);
			$vtype = str_replace(array('WMG','GLD'),'G',$vtype);
			$vtype = str_replace(array('WMX','BTC'),'X',$vtype);
			$vtype = str_replace(array('WMK','KZT'),'K',$vtype);
			$vtype = str_replace(array('WML','LTC'),'L',$vtype);
			$vtype = str_replace(array('WMH','BCH'),'H',$vtype);					

			$enable = array('Z','R','E','U','B','Y','G','X','K','L','H');
			if(!in_array($vtype, $enable)){
				$error[] = __('Wrong currency code','pn'); 
			}						
						
			$account = $item->account_get;
			$account = mb_strtoupper($account);
			if(!is_wm_purse($account, $vtype)){
				$error[] = __('Client wallet type does not match with currency code','pn');
			}		
					
			$site_purse = is_deffin($this->m_data,'WM'. $vtype .'_PURSE');
			$site_purse = mb_strtoupper($site_purse);
			if(!is_wm_purse($site_purse, $vtype)){
				$error[] = __('Your account set on website does not match with currency code','pn');
			}	

			$sum = is_sum(is_paymerch_sum($this->name, $item, $paymerch_data), 2);	
					
			if(count($error) == 0){

				$result = $this->set_ap_status($item);					
				if($result){					
					
					$notice = get_text_paymerch($this->name, $item);
					if(!$notice){ $notice = sprintf(__('ID order %s','pn'), $item->id); }
					$notice = trim(pn_maxf($notice,245));
							
					if(is_file(PN_PLUGIN_DIR .'paymerchants/'. $this->name .'/classed/wmxi.crt') and is_deffin($this->m_data,'KEYPASS') and is_deffin($this->m_data,'KEYPATH')){
							
						$num_request = intval(is_isset($paymerch_data, 'num_request'));
						$num_request = $num_request + 1;
						
						$save_data = get_option('paymerch_data');
						$save_data = (array)$save_data;
						$save_data[$this->name]['num_request'] = $num_request;
						update_option('paymerch_data', $save_data);		 				
							
						try{
							
							$oWMXI = new WMXI( PN_PLUGIN_DIR .'paymerchants/'. $this->name .'/classed/wmxi.crt', 'UTF-8' );
							$oWMXI->Light( array( 'key' => is_deffin($this->m_data,'KEYPATH'), 'cer' => is_deffin($this->m_data,'CERTPATH'), 'pass' => is_deffin($this->m_data,'KEYPASS') ) );
								
							$aResponse = $oWMXI->X2($num_request, $site_purse, $account, $sum , 0, '', $notice, 0, 0)->toObject();
							$server_reply = is_isset($aResponse, 'retval');
								
							if($server_reply != '0'){
								$error[] = is_isset($aResponse, 'retdesc').' Code:'.$server_reply;
								$pay_error = 1;
							} 
								
						}
						catch (Exception $e)
						{
							$error[] = $e;
							$pay_error = 1;
						} 
							
					} else {
						$error[] = 'Error interfaice';
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
					'from_account' => $site_purse,
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

global $premiumbox;
$path = get_extension_file(__FILE__);
$premiumbox->file_include($path . '/classed/wmxicore.class');	
$premiumbox->file_include($path . '/classed/wmxi.class');
$premiumbox->file_include($path . '/classed/wmxilogin.class');
$premiumbox->file_include($path . '/classed/wmxiresult.class');
$premiumbox->file_include($path . '/classed/wmxilogger.class');
$premiumbox->file_include($path . '/classed/wminterfaces.class');
$premiumbox->file_include($path . '/classed/wmsigner.class');

new paymerchant_webmoney_light(__FILE__, 'Webmoney Light');