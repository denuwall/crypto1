<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Verification by SMS code[:en_US][ru_RU:]SMS верификация[:ru_RU]
description: [en_US:]SMS verification for From account, To account, Phone number fields[:en_US][ru_RU:]SMS верификация для полей Со счета, На счет, Номер телефона[:ru_RU]
version: 1.5
category: [en_US:]Exchange directions[:en_US][ru_RU:]Направления обменов[:ru_RU]
cat: directions
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('tab_direction_tab8', 'napssms_tab_direction_tab8', 30, 2);
function napssms_tab_direction_tab8($data, $data_id){
?>
	<tr>
		<th><?php _e('Verify by SMS code','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="sms_button" autocomplete="off">
					<?php 
					$sms_button = intval(get_direction_meta($data_id, 'sms_button')); 
					?>						
					<option value="0" <?php selected($sms_button,0); ?>><?php _e('No','pn');?></option>
					<option value="1" <?php selected($sms_button,1); ?>><?php _e('Yes','pn');?></option>						
				</select>
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<select name="sms_button_verify" autocomplete="off">
					<?php 
					$sms_button_verify = intval(get_direction_meta($data_id, 'sms_button_verify')); 
					?>						
					<option value="0" <?php selected($sms_button_verify,0); ?>><?php _e('Default','pn');?></option>
					<option value="1" <?php selected($sms_button_verify,1); ?>><?php _e('Account Send','pn');?></option>
					<option value="2" <?php selected($sms_button_verify,2); ?>><?php _e('Account Receive','pn');?></option>
					<option value="3" <?php selected($sms_button_verify,3); ?>><?php _e('Phone number','pn');?></option>					
				</select>
			</div>
		</td>		
	</tr>	
<?php	
}

add_action('pn_direction_edit_before','pn_direction_edit_napssms');
add_action('pn_direction_add','pn_direction_edit_napssms');
function pn_direction_edit_napssms($data_id){
	$sms_button = intval(is_param_post('sms_button'));
	update_direction_meta($data_id, 'sms_button', $sms_button);
	
	$sms_button_verify = intval(is_param_post('sms_button_verify'));
	update_direction_meta($data_id, 'sms_button_verify', $sms_button_verify);	
}

add_action('admin_menu', 'pn_adminpage_napssms');
function pn_adminpage_napssms(){
global $premiumbox;		
	add_submenu_page("pn_moduls", __('Verify by SMS code settings','pn'), __('Verify by SMS code settings','pn'), 'administrator', "pn_napssms", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_napssms', 'pn_admin_title_pn_napssms');
function pn_admin_title_pn_napssms($page){
	_e('Verification by SMS code','pn');
}

add_action('pn_adminpage_content_pn_napssms','pn_admin_content_pn_napssms');
function pn_admin_content_pn_napssms(){
global $wpdb, $premiumbox;

	$form = new PremiumForm();

	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Verify by SMS code settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['vid'] = array(
		'view' => 'select',
		'title' => __('Code type','pn'),
		'options' => array('0'=>__('Digits','pn'),'1'=>__('Letters','pn')),
		'default' => $premiumbox->get_option('napssms','vid'),
		'name' => 'vid',
		'work' => 'int',
	);	
	$options['sendto'] = array(
		'view' => 'select',
		'title' => __('Send SMS for','pn'),
		'options' => array('0'=>__('All users','pn'),'1'=>__('Newcomer','pn')),
		'default' => $premiumbox->get_option('napssms','sendto'),
		'name' => 'sendto',
		'work' => 'int',
	);
	$options['time_check'] = array(
		'view' => 'input',
		'title' => __('Timeout (seconds)','pn'),
		'default' => $premiumbox->get_option('napssms','time_check'),
		'name' => 'time_check',
		'work' => 'int',
	);	
	$options['max_check'] = array(
		'view' => 'input',
		'title' => __('Max amount of resended SMS','pn'),
		'default' => $premiumbox->get_option('napssms','max_check'),
		'name' => 'max_check',
		'work' => 'int',
	);	
	$options['field'] = array(
		'view' => 'select',
		'title' => __('Verification option','pn'),
		'options' => array('0'=>__('Account Send','pn'),'1'=>__('Account Receive','pn'),'2'=>__('Phone no.','pn')),
		'default' => $premiumbox->get_option('napssms','field'),
		'name' => 'field',
		'work' => 'int',
	);	
	$options['text'] = array(
		'view' => 'textareatags',
		'title' => __('Text','pn'),
		'default' => $premiumbox->get_option('napssms','text'),
		'tags' => array('code' => __('Code','pn')),
		'width' => '',
		'height' => '50px',
		'prefix1' => '[',
		'prefix2' => ']',
		'name' => 'text',
		'work' => 'text',
		'ml' => 1,
	);	
	$options['hideinstruction'] = array(
		'view' => 'select',
		'title' => __('Hide payment instruction','pn'),
		'options' => array('0'=>__('No','pn'),'1'=>__('Yes','pn')),
		'default' => $premiumbox->get_option('napssms','hideinstruction'),
		'name' => 'hideinstruction',
		'work' => 'int',
	);

	$params_form = array(
		'filter' => 'pn_napssms_options',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);  
}  

add_action('premium_action_pn_napssms','def_premium_action_pn_napssms');
function def_premium_action_pn_napssms(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$vid = intval(is_param_post('vid'));
	$premiumbox->update_option('napssms', 'vid', $vid);
	
	$field = intval(is_param_post('field'));
	$premiumbox->update_option('napssms', 'field', $field);	
	
	$sendto = intval(is_param_post('sendto'));
	$premiumbox->update_option('napssms', 'sendto', $sendto);

	$max_check = intval(is_param_post('max_check'));
	$premiumbox->update_option('napssms', 'max_check', $max_check);	
	
	$time_check = intval(is_param_post('time_check'));
	$premiumbox->update_option('napssms', 'time_check', $time_check);	

	$hideinstruction = intval(is_param_post('hideinstruction'));
	$premiumbox->update_option('napssms', 'hideinstruction', $hideinstruction);	
	
	$text = pn_strip_text(is_param_post('text'));
	$premiumbox->update_option('napssms', 'text', $text);					

	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
			
	$form->answer_form($back_url);
} 

function get_sms_to_user_phone($bid_id){
global $wpdb, $premiumbox;

	$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."exchange_bids WHERE id='$bid_id' AND status IN('new','techpay')");
	if(isset($item->id)){
		$new_user_option = intval($premiumbox->get_option('napssms','sendto'));
		if($new_user_option == 0 or isset($item->new_user) and $item->new_user == 1 and $new_user_option == 1){
			$direction_id = $item->direction_id;
			$button = intval(get_direction_meta($direction_id, 'sms_button'));
			if($button == 1){
				$word = pn_strip_input(get_bids_meta($bid_id, 'sms_word'));
				if(!$word){ /* если нет слова */
					$word = get_rand_word(4, $premiumbox->get_option('napssms','vid'));
					update_bids_meta($bid_id, 'sms_word', $word);
				}
				$field_now = intval(get_direction_meta($direction_id, 'sms_button_verify'));
				if($field_now == 0){
					$field = intval($premiumbox->get_option('napssms','field'));
					if($field == 0){
						$user_phone = pn_strip_input($item->account_give);
					} elseif($field == 1){
						$user_phone = pn_strip_input($item->account_get);
					} elseif($field == 2){	
						$user_phone = pn_strip_input($item->user_phone);
					}
				} elseif($field_now == 1){
					$user_phone = pn_strip_input($item->account_give);
				} elseif($field_now == 2){
					$user_phone = pn_strip_input($item->account_get);
				} elseif($field_now == 3){
					$user_phone = pn_strip_input($item->user_phone);
				}
				
				if($user_phone){ /* если есть телефон */
					$time = current_time('timestamp');
					update_bids_meta($bid_id, 'sms_checker_time', $time);
					$checker_count = intval(get_bids_meta($bid_id, 'sms_checker_count')) + 1;
					update_bids_meta($bid_id, 'sms_checker_count', $checker_count);
				
					$text_sms = pn_strip_input(ctv_ml($premiumbox->get_option('napssms','text')));
					$text_sms = str_replace('[code]',$word,$text_sms);
					if(!$text_sms){ $text_sms = $word; }
				
					do_action('pn_sms_send', $text_sms, $user_phone);
					
					return 1;
				}
			}
		}
	} 
		return 0;
}

add_filter('direction_instruction', 'napssms_direction_instruction', 10000, 5);
function napssms_direction_instruction($instruction, $txt_name, $direction, $vd1, $vd2){
global $premiumbox, $bids_data;
	
	if(isset($bids_data->id)){
		$hideinstruction = intval($premiumbox->get_option('napssms','hideinstruction'));
		if($hideinstruction == 1){
			$new_user_option = intval($premiumbox->get_option('napssms','sendto'));
			if($new_user_option == 0 or isset($bids_data->new_user) and $bids_data->new_user == 1 and $new_user_option == 1){
				$direction_id = $direction->id;
				$bid_id = $bids_data->id;
				$button = intval(get_direction_meta($direction_id, 'sms_button'));
				if($button == 1){ /* если включена */
					$checker = intval(get_bids_meta($bid_id, 'sms_checker'));
					if($checker != 1){ /* если не чек */
						return '';
					}
				}
			}
		}
	}
	
	return $instruction;
}

add_filter('merchant_pay_button_visible','napssms_merchant_pay_button_visible', 0, 6);
function napssms_merchant_pay_button_visible($ind, $m_in, $bids_data, $direction, $vd1, $vd2){
global $premiumbox;	
	if($ind == 1){
		$new_user_option = intval($premiumbox->get_option('napssms','sendto'));
		if($new_user_option == 0 or isset($bids_data->new_user) and $bids_data->new_user == 1 and $new_user_option == 1){
			$direction_id = $direction->id;
			$bid_id = $bids_data->id;
			$sms_button = intval(get_direction_meta($direction_id, 'sms_button'));
			if($sms_button == 1){ /* если включена sms */
				$sms_checker = intval(get_bids_meta($bid_id, 'sms_checker'));
				if($sms_checker != 1){ /* если не чек */
					
					$sms_checker_count = intval(get_bids_meta($bid_id, 'sms_checker_count')); /* кол-во отправленных смс */
					if($sms_checker_count < 1){
						get_sms_to_user_phone($bid_id);
					}
				
					return 0;
				}
			}
		}
	}
	return $ind;
}

add_action('before_bidaction_payedbids', 'napssms_before_bidaction_payedbids');
function napssms_before_bidaction_payedbids($item){
global $premiumbox;	
	$new_user_option = intval($premiumbox->get_option('napssms','sendto'));
	if($new_user_option == 0 or isset($item->new_user) and $item->new_user == 1 and $new_user_option == 1){
		$direction_id = $item->direction_id;
		$bid_id = $item->id;
		$sms_button = intval(get_direction_meta($direction_id, 'sms_button'));
		if($sms_button == 1){ /* если включена sms */
			$sms_checker = intval(get_bids_meta($bid_id, 'sms_checker'));
			if($sms_checker != 1){ /* если не чек */
			
				$sms_checker_count = intval(get_bids_meta($bid_id, 'sms_checker_count')); /* кол-во отправленных смс */
				if($sms_checker_count < 1){
					get_sms_to_user_phone($bid_id);
				}				
			
				$url = get_bids_url($item->hashed);
				wp_redirect($url);
				exit;					
			}
		}
	}		
}

add_filter('merchant_formstep_after','napssms_merchant_formstep_after', 9999, 5);
function napssms_merchant_formstep_after($html, $m_in, $direction, $vd1, $vd2){
global $premiumbox, $bids_data;	

	$new_user_option = intval($premiumbox->get_option('napssms','sendto'));
	if($new_user_option == 0 or isset($bids_data->new_user) and $bids_data->new_user == 1 and $new_user_option == 1){	
		$direction_id = $direction->id;
		$bid_id = $bids_data->id;
		$sms_button = intval(get_direction_meta($direction_id, 'sms_button'));
		if($sms_button == 1){ 
			$sms_checker = intval(get_bids_meta($bid_id, 'sms_checker'));
			if($sms_checker != 1){ 
				$html = '
				<div class="block_smsbutton napssms_block">
					<div class="block_smsbutton_ins">
						<div class="block_smsbutton_label">
							<div class="block_smsbutton_label_ins">
								'. __('Enter code specified in SMS:','pn') .'
							</div>
						</div>
						<div class="block_smsbutton_action">
							<input type="text" name="" maxlength="4" placeholder="'. __('Enter code','pn') .'" id="smsbutton_text" value="" />
							<input type="submit" name="" data-id="'. $bid_id .'" id="smsbutton_send" value="'. __('Confirm code','pn') .'" />
							<input type="submit" name="" data-id="'. $bid_id .'" data-timer="1" disabled="disabled" id="smsbutton_reload" value="'. __('Resend','pn') .'" />
								<div class="clear"></div>
						</div>
					</div>
				</div>
				';			
			}
		}
	}
	
	return $html;
} 

add_action('siteplace_js','siteplace_js_napssms');
function siteplace_js_napssms(){
global $premiumbox;	
	$time_check = intval($premiumbox->get_option('napssms','time_check'));
	if($time_check < 1){ $time_check = 60; }
?>	
jQuery(function($){ 

	if($('.napssms_block').length > 0){

		var ch_sec = parseInt('<?php echo $time_check; ?>');
		var now = ch_sec;	
	
		function interval_smsbutton(){
			if($('#smsbutton_reload').attr('data-timer') == 1){
				if(now > 1){
					now = now - 1;
					$('#smsbutton_reload').val('<?php _e('Resend','pn'); ?> ('+ now +')');
				} else {
					$('#smsbutton_reload').val('<?php _e('Resend','pn'); ?>');
					$('#smsbutton_reload').attr('data-timer', 0);
					$('#smsbutton_reload').prop('disabled', false);
				}
			} 
		}
		setInterval(interval_smsbutton, 1000);
		
		$(document).on('click', '#smsbutton_reload', function(){
			if(!$(this).prop('disabled')){
				
				var id = $(this).attr('data-id');
				var thet = $(this);
				thet.prop('disabled', true);
				var param='id=' + id;
				$.ajax({
					type: "POST",
					url: "<?php echo get_ajax_link('resend_sms_bids');?>",
					dataType: 'json',
					data: param,
					error: function(res, res2, res3){
						<?php do_action('pn_js_error_response', 'ajax'); ?>
					},			
					success: function(res)
					{
						now = ch_sec;
						if(res['status'] == 'success'){
							now = ch_sec;
							$('#smsbutton_reload').attr('data-timer', 1);
						} 
						if(res['status'] == 'error'){
							thet.prop('disabled', false);
						}
						<?php do_action('pn_js_alert_response'); ?>
					}
				});
			}
		
			return false;
		});

		$(document).on('click', '#smsbutton_send', function(){
			if(!$(this).prop('disabled')){
				
				var id = $(this).attr('data-id');
				var txt = $('#smsbutton_text').val();
				var thet = $(this);
				thet.prop('disabled', true);

				var param='id=' + id + '&txt=' + txt;
				$.ajax({
					type: "POST",
					url: "<?php echo get_ajax_link('repair_sms_bids');?>",
					dataType: 'json',
					data: param,
					error: function(res, res2, res3){
						<?php do_action('pn_js_error_response', 'ajax'); ?>
					},			
					success: function(res)
					{
						if(res['status'] == 'success'){
							window.location.href = '';
						} 
						if(res['status'] == 'error'){
							<?php do_action('pn_js_alert_response'); ?>
							thet.prop('disabled', false);
						}
					}
				});
		
			}
		
			return false;
		});		
	
	}
	
});		
<?php	
} 

add_action('myaction_site_repair_sms_bids', 'def_myaction_ajax_repair_sms_bids');
function def_myaction_ajax_repair_sms_bids(){
global $or_site_url, $wpdb, $premiumbox;	
	
	only_post();
	
	$log = array();
	$log['response'] = '';
	$log['status'] = '';
	$log['status_text'] = '';
	$log['status_code'] = 0;
	
	$premiumbox->up_mode();
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	$bid_id = intval(is_param_post('id'));
	$txt = strtoupper(is_param_post('txt'));
	if($bid_id and $txt){
		$sms_word = pn_strip_input(get_bids_meta($bid_id, 'sms_word'));
		if($sms_word == $txt){
			
			update_bids_meta($bid_id, 'sms_checker', 1);
			
			$log['status'] = 'success';
			$log['status_code'] = 0;		
		} else {
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('You have entered the wrong code','pn');
		}
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('You have not entered the code','pn');		
	}
	
	echo json_encode($log);
	exit;
}

add_action('myaction_site_resend_sms_bids', 'def_myaction_ajax_resend_sms_bids');
function def_myaction_ajax_resend_sms_bids(){
global $or_site_url, $wpdb, $premiumbox;	
	
	only_post();
	
	$log = array();
	$log['response'] = '';
	$log['status'] = '';
	$log['status_text'] = '';
	$log['status_code'] = 0;
	
	$premiumbox->up_mode();
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$bid_id = intval(is_param_post('id'));
	if($bid_id){		
		$checker = intval(get_bids_meta($bid_id, 'sms_checker'));
		if($checker != 1){ /* если не чек */
			$checker_count = intval(get_bids_meta($bid_id, 'sms_checker_count')); /* кол-во отправленных смс */
			$checker_time = get_bids_meta($bid_id, 'sms_checker_time'); /* время последней отправки */
			$time = current_time('timestamp');
			$razn = $time - $checker_time; /* кол-во секунд после последней отправки */
			$max_check = intval($premiumbox->get_option('napssms','max_check'));
			if($max_check < 1){ $max_check = 1; }
			$check_second = intval($premiumbox->get_option('napssms','time_check'));
			if($check_second < 1){ $check_second = 60; }
			$next = $check_second - $razn;
			if($checker_count < $max_check){
				if($razn > ($check_second-1)){
					if(get_sms_to_user_phone($bid_id)){
						$log['status'] = 'success';
						$log['status_code'] = 0;
						$log['status_text'] = __('SMS resent','pn');							
					} else {
						$log['status'] = 'error';
						$log['status_code'] = 1;
						$log['status_text'] = __('SMS sending error','pn');							
					}
				} else {
					$log['status'] = 'error';
					$log['status_code'] = 1;
					$log['status_text'] = sprintf(__('Sending is possible not earlier than %1s seconds','pn'), $next);					
				}
			} else {
				$log['status'] = 'error';
				$log['status_code'] = 1;
				$log['status_text'] = sprintf(__('You have been sent the maximum number of SMS (%1s of %2s)','pn'), $checker_count, $max_check);				
			}
		} else {
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('Code has already been confirmed. Refresh the page','pn');
		}
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('SMS sending error','pn');		
	}
	
	echo json_encode($log);
	exit;
}