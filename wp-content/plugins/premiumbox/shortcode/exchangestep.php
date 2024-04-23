<?php
if( !defined( 'ABSPATH')){ exit(); } 

add_action('template_redirect','bids_initialization');
function bids_initialization(){
global $wpdb, $bids_data;

	$bids_data = array();

	$hashed = is_bid_hash(get_query_var('hashed'));
	if($hashed){
		$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
		if(isset($data->id)){
			$bids_data = $data;
		}
	} 
	
	$bids_data = (object)$bids_data;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_exchangestep');
function wp_before_admin_bar_render_exchangestep() {
global $wp_admin_bar, $bids_data;
	
    if(current_user_can('administrator') or current_user_can('pn_bids')){
		if(!is_admin()){
			if(isset($bids_data->id)){
				$wp_admin_bar->add_menu( array(
					'id'     => 'show_bids',
					'href' => admin_url('admin.php?page=pn_bids&bidid='.$bids_data->id),
					'title'  => __('Go to order','pn'),	
				));	
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_directions',
					'parent' => 'show_bids',
					'href' => admin_url('admin.php?page=pn_add_directions&item_id='.$bids_data->direction_id),
					'title'  => __('Edit direction exchange','pn'),	
				));				
				
				$item_title1 = pn_strip_input(ctv_ml($bids_data->psys_give)).' '.pn_strip_input($bids_data->currency_code_give);
				$item_title2 = pn_strip_input(ctv_ml($bids_data->psys_get)).' '.pn_strip_input($bids_data->currency_code_get);
				
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_currency1',
					'parent' => 'show_bids',
					'href' => admin_url('admin.php?page=pn_add_currency&item_id='.$bids_data->currency_id_give),
					'title'  => sprintf(__('Edit "%s"','pn'), $item_title1),	
				));
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_currency2',
					'parent' => 'show_bids',
					'href' => admin_url('admin.php?page=pn_add_currency&item_id='.$bids_data->currency_id_get),
					'title'  => sprintf(__('Edit "%s"','pn'), $item_title2),	
				));			
			}
		}
	}
}

add_action('siteplace_js','siteplace_js_exchange_checkrule');
function siteplace_js_exchange_checkrule(){
?>
jQuery(function($){ 
	
	$('#check_rule_step').on('change',function(){
		if($(this).prop('checked')){
			$('#check_rule_step_input').prop('disabled',false);
		} else {
			$('#check_rule_step_input').prop('disabled',true);
		}
	});

	$('#check_rule_step_input').on('click',function(){
		$(this).parents('.ajax_post_form').find('.resultgo').html('<div class="resulttrue"><?php echo esc_attr(__('Processing. Please wait','pn')); ?></div>');
	});
	
	$('.iam_pay_bids').on('click',function(){
		if (!confirm("<?php echo esc_attr(__('Are you sure that you paid your order?','pn')); ?>")){
			return false;
		}
	});		
			
});		
<?php 
}

add_action('siteplace_js','siteplace_js_exchange_timer');
function siteplace_js_exchange_timer(){
?>
jQuery(function($){
	
	if($('.check_payment_hash').length > 0){
		var nowdata = 0;
		var redir = 0;	
		var second = parseInt($('.check_payment_hash').attr('data-time'));

		function check_payment_now(){	
			nowdata = parseInt(nowdata) + 1;
			if(nowdata < second){
				$('.block_check_payment_abs').html(nowdata);
				var wid = $('.block_check_payment').width();
				if(wid > 1){
					var onepr = wid / second;
					var nwid = onepr * nowdata;
					$('.block_check_payment_ins').animate({'width': nwid},500);
				}				
			} else {
				if(redir == 0){
					var durl = $('.check_payment_hash').attr('data-hash');
					redir = 1;
					if(durl.length > 0){
						$('.exchange_status_abs').show();
						
						var dataString='hashed='+durl+'&auto_check=1';
						$.ajax({
							type: "POST",
							url: "<?php echo get_ajax_link('refresh_status_bids');?>",
							dataType: 'json',
							data: dataString,
							error: function(res, res2, res3){
								<?php do_action('pn_js_error_response', 'ajax'); ?>
							},			
							success: function(res)
							{
								$('.exchange_status_abs').hide();
								if(res['html']){
									$('#exchange_status_html').html(res['html']);
									<?php do_action('live_change_html'); ?>
									redir = 0;
									nowdata = 0;
								} 
							}
						});	
					}					
				}
			}
		}
		setInterval(check_payment_now,1000);	
	}
	
});		
<?php 
}

add_action('myaction_site_refresh_status_bids', 'def_myaction_site_refresh_status_bids');
function def_myaction_site_refresh_status_bids(){
global $wpdb, $bids_data, $premiumbox;
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = '0'; 
	$log['status_text']= '';
	$log['html'] = '';	
	
	$premiumbox->up_mode();
	
	$hashed = is_bid_hash(is_param_post('hashed'));
	if($hashed){
		$bids_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
		if(isset($bids_data->id)){
			$html = apply_filters('exchangestep_'. is_status_name($bids_data->status), '', $bids_data);
			$html .= apply_filters('exchangestep_all', '', is_status_name($bids_data->status), $bids_data);
		} else {
			$html = '<div class="resultfalse">'. __('Error! Order do not exist','pn') .'</div>';
		}
		$log['html'] = $html;
	} 	
	
	echo json_encode($log);
	exit;
}

/* шорткод статусов */
function exchangestep_page_shortcode($atts, $content){
global $wpdb, $bids_data;
	
	$temp = '<div class="resultfalse">'. __('Error! Order do not exist','pn') .'</div>';

	if(isset($bids_data->id)){
			
		$temp = apply_filters('before_exchangestep_page','', $bids_data);
		$temp .= '
		<div class="exchange_status_html">
			<div class="exchange_status_abs"></div>
			<div id="exchange_status_html">';	
				$temp .= apply_filters('exchangestep_'. is_status_name($bids_data->status), '', $bids_data);
				$temp .= apply_filters('exchangestep_all', '', is_status_name($bids_data->status), $bids_data);
			$temp .= '
			</div>
		</div>';	
		$temp .= apply_filters('after_exchangestep_page','', $bids_data);
			
	}
	
	return $temp;
}
add_shortcode('exchangestep', 'exchangestep_page_shortcode');

/* auto */
add_filter('exchangestep_auto','get_exchangestep_auto',1);
function get_exchangestep_auto($temp){
global $wpdb, $premiumbox, $bids_data;

    $temp = '';
	
	if(isset($bids_data->id)){
		
		$direction_id = intval($bids_data->direction_id);
		
		$item_id = intval($bids_data->id);
		
		$hashed = is_bid_hash($bids_data->hashed);		
		
		$currency_id_give = intval($bids_data->currency_id_give);
		$currency_id_get = intval($bids_data->currency_id_get);
		
		$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_give' AND auto_status='1'");
		$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_get' AND auto_status='1'");
	
		$where = get_directions_where('exchange');
		$direction_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE $where AND id='$direction_id'");
		if(isset($direction_data->id)){
			$output = apply_filters('get_direction_output', 1, $direction_data, 'exchange');
			if($output != 1){
				$direction_data = array();
			}
		}
		if(!isset($direction_data->id)){
			return '<div class="exch_error"><div class="exch_error_ins">'. __('Exchange direction is disabled','pn') .'</div></div>';
		}	
		
		$direction = array();
		foreach($direction_data as $direction_key => $direction_val){
			$direction[$direction_key] = $direction_val;
		}
		$naps_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$direction_id'");
		foreach($naps_meta as $naps_item){
			$direction[$naps_item->meta_key] = $naps_item->meta_value;
		}	
		$direction = (object)$direction;
		
		$dmetas = @unserialize($bids_data->dmetas);
		$metas = @unserialize($bids_data->metas);
	
		$status = is_status_name($bids_data->status);
	
		/* timeline */	
		$text = get_direction_descr('timeline_txt', $direction, $vd1, $vd2);
		$text = apply_filters('direction_instruction', $text, 'timeline_txt', $direction, $vd1, $vd2);
		$text = ctv_ml($text);
		
		$timeline = '';		
		if($text){	
			$timeline = '
			<div class="notice_message">
				<div class="notice_message_ins">
					<div class="notice_message_abs"></div>
					<div class="notice_message_close"></div>
					<div class="notice_message_title">
						<div class="notice_message_title_ins">
							<span>'. __('Attention!','pn') .'</span>
						</div>
					</div>
					<div class="notice_message_text">
						<div class="notice_message_text_ins">
							'. apply_filters('comment_text',$text) .'
						</div>
					</div>
				</div>
			</div>';
		}
		/* end timeline */		
		
		$pay_com1 = pn_strip_input($direction->pay_com1);
		$pay_com2 = pn_strip_input($direction->pay_com2);
		
		$com_ps1 = pn_strip_input($bids_data->com_ps1);
		if($pay_com1 == 1){
			$com_ps1 = 0;
		}
		 
		$comis_text1 = get_comis_text($com_ps1, $bids_data->dop_com1, ctv_ml(is_isset($vd1,'psys_title')), is_isset($vd1,'currency_code_title'), 1, 0);
		
		$com_ps2 = pn_strip_input($bids_data->com_ps2);		
		if($pay_com2 == 1){
			$com_ps2 = 0;
		}		
		
		$comis_text2 = get_comis_text($com_ps2, $bids_data->dop_com2, ctv_ml(is_isset($vd2,'psys_title')), is_isset($vd2,'currency_code_title'), 2,0);		
		
		$com_give_text = $com_get_text = '';
		if($comis_text1){
			$com_give_text ='
			<div class="block_xchdata_comm">
				'. $comis_text1 .'
			</div>	
			';
		}
		if($comis_text2){
			$com_get_text ='
			<div class="block_xchdata_comm">
				'. $comis_text2 .'
			</div>	
			';
		}	

		$account_give = $account_get = '';
		if($bids_data->account_give){
			$txt = pn_strip_input(ctv_ml(is_isset($vd1,'txt1')));
			if(!$txt){ $txt = __('From account','pn'); }
			$account = $bids_data->account_give;
			$account = apply_filters('show_user_account', $account, $bids_data, $direction, $vd1);						
			$account_give = '<div class="block_xchdata_line"><span>'. $txt .':</span> '. get_secret_value($account, $premiumbox->get_option('exchange','an1_hidden')) .'</div>';
		}	

		if($bids_data->account_get){
			$txt = pn_strip_input(ctv_ml(is_isset($vd2,'txt2')));
			if(!$txt){ $txt = __('Into account','pn'); }
			$account = $bids_data->account_get;
			$account = apply_filters('show_user_account', $account, $bids_data, $direction, $vd2);									
			$account_get = '<div class="block_xchdata_line"><span>'. $txt .':</span> '. get_secret_value($account, $premiumbox->get_option('exchange','an2_hidden')) .'</div>';
		}		
	
		$give_field = $get_field = '';
	
		if(isset($dmetas[1]) and is_array($dmetas[1])){
			foreach($dmetas[1] as $value){					
				$title = pn_strip_input(ctv_ml(is_isset($value,'title')));
				$data = pn_strip_input(is_isset($value,'data'));
				$hidden = intval(is_isset($value,'hidden'));
				if(trim($data)){
					$give_field .= '<div class="block_xchdata_line"><span>'. $title .':</span> '. get_secret_value($data, $hidden) .'</div>';
				}
			}
		}

		if(isset($dmetas[2]) and is_array($dmetas[2])){
			foreach($dmetas[2] as $value){					
				$title = pn_strip_input(ctv_ml(is_isset($value,'title')));
				$data = pn_strip_input(is_isset($value,'data'));
				$hidden = intval(is_isset($value,'hidden'));
				if(trim($data)){
					$get_field .= '<div class="block_xchdata_line"><span>'. $title .':</span> '. get_secret_value($data, $hidden) .'</div>';
				}
			}
		}		

		$personal_data = '';
		if(isset($metas) and is_array($metas) and count($metas) > 0){
				
			$personal_data = '
			<div class="block_persdata">
				<div class="block_persdata_ins">
					<div class="block_persdata_title">
						<div class="block_persdata_title_ins">
							<span>'. apply_filters('exchnage_personaldata_title',__('Personal data','pn')) .'</span>
						</div>
					</div>
					<div class="block_persdata_info">';	
						foreach($metas as $value){				
							$title = pn_strip_input(ctv_ml(is_isset($value,'title')));
							$data = pn_strip_input(is_isset($value,'data'));
							$hidden = intval(is_isset($value,'hidden'));
							if(trim($data)){			
								$personal_data .= '<p><span>'. $title .':</span> '. get_secret_value($data, $hidden) .'</p>';			
							}	
						}							
					$personal_data .= '
					</div>
				</div>
			</div>';
				
		}	
		
		$check_rule = '<label><input type="checkbox" id="check_rule_step" name="check_rule" value="1" /> '. sprintf(__('I read and agree with <a href="%s" target="_blank">the terms and conditions</a>','pn'), $premiumbox->get_page('tos') ) .'</label>';
	
		$submit = '<input type="submit" name="" formtarget="_top" id="check_rule_step_input" disabled="disabled" value="'. __('Create order','pn') .'" />';

		$array = array(
			'[timeline]' => $timeline,
			'[status]' => 'auto',
			'[result]' => '<div class="ajax_post_bids_res"><div class="resultgo"></div></div>',
			'[submit]' => $submit,
			'[check_rule]' => $check_rule,
			'[personal_data]' => $personal_data,
			'[give_field]' => $give_field,
			'[get_field]' => $get_field,
			'[account_give]' => $account_give,
			'[account_get]' => $account_get,
			'[com_give_text]' => $com_give_text,
			'[com_get_text]' => $com_get_text,	
			'[sum_give]' => pn_strip_input($bids_data->sum1c),	
			'[sum_get]' => pn_strip_input($bids_data->sum2c),
			'[give_currency]' => get_currency_title($vd1),
			'[get_currency]' => get_currency_title($vd2),
			'[give_currency_logo]' => get_currency_logo($vd1),
			'[get_currency_logo]' => get_currency_logo($vd2),
		);
		$array = apply_filters('exchangestep_auto_html_list', $array, $bids_data, $direction, $vd1, $vd2);	
	
		$temp .= '
		<form action="'. get_ajax_link('createbids') .'" class="ajax_post_form" method="post">
			<input type="hidden" name="hash" value="'. $hashed .'" />
		';
	
		$html = '
		[timeline]
			
		<div class="block_xchangedata">
			<div class="block_xchangedata_ins">
			
				<div class="block_xchdata">
					<div class="block_xchdata_ins">	

						<div class="block_xchdata_title otd give">
							<span>'. __('Send','pn') .'</span>
						</div>	

						[com_give_text]
						
						<div class="block_xchdata_info">
							<div class="block_xchdata_info_left">
								<div class="block_xchdata_line"><span>'. __('Amount','pn') .':</span> [sum_give] [give_currency]</div>
								
								[account_give]
								
								[give_field]

							</div>
							<div class="block_xchdata_info_right"> 
								<div class="block_xchdata_ico" style="background: url([give_currency_logo]) no-repeat center center"></div>
								<div class="block_xchdata_text">[give_currency]</div>
									<div class="clear"></div>
							</div>		
								<div class="clear"></div>
						</div>
						
					</div>
				</div>
				<div class="block_xchdata">
					<div class="block_xchdata_ins">
						<div class="block_xchdata_title pol get">							
							<span>'. __('Receive','pn') .'</span>
						</div>
						
						[com_get_text]
						
						<div class="block_xchdata_info">
							<div class="block_xchdata_info_left">
								<div class="block_xchdata_line"><span>'. __('Amount','pn') .':</span> [sum_get] [get_currency]</div>
								
								[account_get]
								
								[get_field]

							</div>
							<div class="block_xchdata_info_right">
								<div class="block_xchdata_ico" style="background: url([get_currency_logo]) no-repeat center center;"></div>
								<div class="block_xchdata_text">[get_currency]</div>
									<div class="clear"></div>
							</div>		
								<div class="clear"></div>
						</div>
						
					</div>
				</div>

				[personal_data]
				
				<div class="block_checked_rule">
					[check_rule]
				</div>				
				<div class="block_warning">
					<div class="block_warning_ins">
						<div class="block_warning_title">
							<div class="block_warning_title_ins">
								<span>'. __('Attention!','pn') .'</span>
							</div>
						</div>
						<div class="block_warning_text">
							<div class="block_warning_text_ins">
								<p>'. __('Clicking on button "Create a order" means that you accept all the basic terms and conditions.','pn') .'</p>
							</div>
						</div>
					</div>
				</div>				
				<div class="block_rule_info">
					'. __('Thoroughly check all data before creating a order!','pn') .'
				</div>
				
				<div class="block_submitbutton">
					[submit]
				</div>
				
				[result]
		
			</div>
		</div>		
		';

		$html = apply_filters('exchangestep_auto_html', $html, $bids_data, $direction, $vd1, $vd2);			
		$temp .= get_replace_arrays($array, $html);	

		$temp .= '
		</form>
		';		
	
	}
	
	return $temp;
}
/* end auto */

/* new */
add_filter('exchangestep_new','get_exchangestep_new',1,2);
add_filter('exchangestep_techpay','get_exchangestep_new',1,2); 
function get_exchangestep_new($temp){
global $wpdb, $premiumbox, $bids_data;

	$temp = '';
	
	if(isset($bids_data->id)){
	
		$direction_id = intval($bids_data->direction_id);
	
		$item_id = intval($bids_data->id);
		
		$hashed = is_bid_hash($bids_data->hashed);
	
		$currency_id_give = intval($bids_data->currency_id_give);
		$currency_id_get = intval($bids_data->currency_id_get);
		
		$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_give' AND auto_status='1'");
		$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_get' AND auto_status='1'");	
	
		$where = get_directions_where('exchange');
		$direction_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE $where AND id='$direction_id'");
		if(isset($direction_data->id)){
			$output = apply_filters('get_direction_output', 1, $direction_data, 'exchange');
			if($output != 1){
				$direction_data = array();
			}
		}
		if(!isset($direction_data->id)){
			return '<div class="exch_error"><div class="exch_error_ins">'. __('Exchange direction is disabled','pn') .'</div></div>';
		}		
		
		$direction = array();
		foreach($direction_data as $direction_key => $direction_val){
			$direction[$direction_key] = $direction_val;
		}
		$naps_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$direction_id'");
		foreach($naps_meta as $naps_item){
			$direction[$naps_item->meta_key] = $naps_item->meta_value;
		}	
		$direction = (object)$direction; /* вся информация о направлении */		
		
		$dmetas = @unserialize($bids_data->dmetas);
		$metas = @unserialize($bids_data->metas);		
		
		$status = is_status_name($bids_data->status);
		
		/* timeline */	
		$text = get_direction_descr('timeline_txt', $direction, $vd1, $vd2);
		$text = apply_filters('direction_instruction', $text, 'timeline_txt', $direction, $vd1, $vd2);
		$text = ctv_ml($text);
		
		$timeline = '';		
		if($text){	
			$timeline = '
			<div class="notice_message">
				<div class="notice_message_ins">
					<div class="notice_message_abs"></div>
					<div class="notice_message_close"></div>
					<div class="notice_message_title">
						<div class="notice_message_title_ins">
							<span>'. __('Attention!','pn') .'</span>
						</div>
					</div>
					<div class="notice_message_text">
						<div class="notice_message_text_ins">
							'. apply_filters('comment_text',$text) .'
						</div>
					</div>
				</div>
			</div>';
		}
		/* end timeline */				
		
		$js_autocheck = get_direction_tempdata($status, 'naps_timer'); 
		$status_text = get_direction_tempdata($status, 'naps_status');
		$status_title = get_direction_tempdata($status, 'naps_title'); 		
		
		$date_format = get_option('date_format');
		$time_format = get_option('time_format');		
		$status_date = get_mytime($bids_data->edit_date, "{$date_format}, {$time_format}");		
		
		$m_in = apply_filters('get_merchant_id','', is_isset($direction, 'm_in'), $bids_data);
		$sum_to_pay = apply_filters('sum_to_pay', is_sum($bids_data->sum1dc), $m_in , $bids_data, $direction);						
		
		$instruction = get_direction_descr('status_'.$status, $direction, $vd1, $vd2); 
		$instruction = apply_filters('instruction_merchant', $instruction, $m_in, $direction, $vd1, $vd2);	
		$instruction = ctv_ml($instruction);
		$instruction = apply_filters('direction_instruction', $instruction, 'status_'.$status, $direction, $vd1, $vd2);
		$instruction = ctv_ml($instruction);
		
		$instruct = '';
		if($instruction){
			$instruct = '
			<div class="block_statusnew_instruction block_instruction">
				<div class="block_instruction_ins">
					'. apply_filters('comment_text', $instruction) .'
				</div>	
			</div>			
			';
		}	
	
		$action_or_error = '';
	
		if(is_true_userhash($bids_data)){
			
			$pay_button_visible = apply_filters('merchant_pay_button_visible', 1, $m_in, $bids_data, $direction, $vd1, $vd2);
			
			$action_or_error = '
			<div class="block_paybutton">
				<div class="block_paybutton_ins">';
								
					$action_or_error .= '<a href="'. get_ajax_link('canceledbids') .'&hash='. is_bid_hash($bids_data->hashed) .'" class="cancel_paybutton">'. __('Cancel a order','pn') .'</a>';
							
					if($pay_button_visible == 1){
						if($m_in){		
							$merchant_pay_button = '<a href="'. get_ajax_link('payedmerchant') .'&hash='. is_bid_hash($bids_data->hashed) .'" target="_blank" class="success_paybutton">'. __('Make a payment','pn') .'</a>';
							$action_or_error .= apply_filters('merchant_pay_button_'.$m_in, $merchant_pay_button, $sum_to_pay, $bids_data, $direction);		
						} else {
							$action_or_error .= '<a href="'. get_ajax_link('payedbids') .'&hash='. is_bid_hash($bids_data->hashed) .'" class="success_paybutton iam_pay_bids">'. __('Paid','pn') .'</a>';
						}
					}
							
					$action_or_error .= '
						<div class="clear"></div>
				</div>
			</div>
			';
				
		} else {
					
			$action_or_error = '
			<div class="block_change_browse">
				<div class="block_change_browse_ins">	
					<p>'. __('Error! You cannot control this order in another browser','pn') .'</p>	
				</div>
			</div>					
			';
					
		}	
		
		$autocheck = apply_filters('merchant_formstep_autocheck', 0, $m_in);
		$autocheck_html = '';
		if($autocheck and !$js_autocheck){
			if(isset($_GET['auto_check']) or isset($_POST['auto_check'])){	

				$autocheck_html .= '
				<div class="block_check_payment check_payment_hash" data-time="30" data-hash="'. is_bid_hash($bids_data->hashed) .'">
					<div class="block_check_payment_abs"></div>
					<div class="block_check_payment_ins"></div>
				</div>
					
				<div class="block_warning_merch">
					<div class="block_warning_merch_ins">
						<p>'. sprintf(__('We check the payment every %s seconds.','pn'), 30) .'</p>
					</div>
				</div>				
					
				<div class="block_paybutton_merch">
					<div class="block_paybutton_merch_ins">	
						<a href="'. get_bids_url($bids_data->hashed) .'" class="merch_paybutton">'. __('Cancel','pn') .'</a>		
					</div>
				</div>					
				';						
						
			} else {
						
				$autocheck_html .= '
				<div class="block_warning_merch">
					<div class="block_warning_merch_ins">
						
						<p>'. __('Attention! Click "Check payment", if you have aready paid the order.','pn') .'</p>
						<p>'. sprintf(__('Then the check will be automatically performed every %s seconds.','pn'), 30) .'</p>
						
					</div>
				</div>
					
				<div class="block_paybutton_merch">
					<div class="block_paybutton_merch_ins">
								
						<a href="'. get_bids_url($bids_data->hashed) .'?auto_check=true" class="merch_paybutton">'. __('Verify a payment','pn') .'</a>
								
					</div>
				</div>					
				';										
						
			}
		}			

		$merchant_action = '';
		if(is_true_userhash($bids_data)){
			$merchant_action = apply_filters('merchant_formstep_after', '', $m_in, $direction, $vd1, $vd2);
		}
	
		$array = array(
			'[timeline]' => $timeline,
			'[status]' => $status,
			'[status_title]' => $status_title,
			'[status_date]' => $status_date,
			'[status_text]' => $status_text,			
			'[summ_to_pay]' => $sum_to_pay,
			'[sum_get]' => pn_strip_input($bids_data->sum2c),
			'[instruction]' => $instruct,
			'[ps_give]' => pn_strip_input(ctv_ml($bids_data->psys_give)),
			'[ps_get]' => pn_strip_input(ctv_ml($bids_data->psys_get)),
			'[action_or_error]' => $action_or_error,
			'[merchant_action]' => $merchant_action,
			'[autocheck]' => $autocheck_html,	
			'[vtype_give]' => pn_strip_input($bids_data->currency_code_give),
			'[vtype_get]' => pn_strip_input($bids_data->currency_code_get),
		);
		$array = apply_filters('exchangestep_'. $status .'_html_list', $array, $bids_data, $direction, $vd1, $vd2);
		$array = apply_filters('exchangestep_all_html_list', $array, $bids_data, $direction, $vd1, $vd2);
	
		$html = '
		[timeline]
		
		<div class="block_statusbids block_status_[status]">
			<div class="block_statusbids_ins">
				<div class="block_statusbid_title">
					<div class="block_statusbid_title_ins">
						<span>[status_title]</span>
					</div>
				</div>
				
				<div class="block_payinfo">
					<div class="block_payinfo_ins">	
						[instruction]	

						<div class="block_payinfo_sum block_payinfo_line">
							<p><strong>'. __('Amount of payment','pn') .':</strong> [summ_to_pay] <span class="ps">[ps_give] [vtype_give]</span></p>
						</div>
						
						<div class="block_payinfo_sum block_payinfo_line">
							<p><strong>'. __('Amount to receive','pn') .':</strong> [sum_get] <span class="ps">[ps_get] [vtype_get]</span></p>
						</div>						
						
						<div class="block_payinfo_warning">
							<span class="req">'. __('Please be careful!','pn') .'</span> '. __('All fields must be filled in accordance with the instructions. Otherwise, the payment may be cancelled.','pn') .' 
						</div>			
					</div>
				</div>

				<div class="block_status">
					<div class="block_status_ins">
						<div class="block_status_time"><span>'. __('Creation time','pn') .':</span> [status_date]</div>
						<div class="block_status_text"><span class="block_status_text_info">'. __('Status of order','pn') .':</span> <span class="block_status_bids bstatus_[status]">[status_text]</span></div>
					</div>
				</div>
				
				[action_or_error]
				[merchant_action]
				[autocheck]
		
			</div>
		</div>		
		';		
		
		$html = apply_filters('exchangestep_'. $status .'_html', $html, $bids_data, $direction, $vd1, $vd2);
		$html = apply_filters('exchangestep_all_html', $html, $bids_data, $direction, $vd1, $vd2);
		
		if($js_autocheck){
			$temp .= '<div class="check_payment_hash" data-time="30" data-hash="'. is_bid_hash($bids_data->hashed) .'"></div>';
		}		
		
		$temp .= get_replace_arrays($array, $html, 1);		
		
	}
	
	return $temp;
}
/* end new */							

add_filter('exchangestep_all','get_exchangestep_all',1,2);
function get_exchangestep_all($temp, $status){
global $wpdb, $premiumbox, $bids_data;

	$temp = '';
	
	$not_status = array('auto','new','techpay');
	
	if(isset($bids_data->id) and !in_array($status, $not_status)){
		
		$direction_id = intval($bids_data->direction_id);
		
		$item_id = intval($bids_data->id);
		
		$hashed = is_bid_hash($bids_data->hashed);
		
		$currency_id_give = intval($bids_data->currency_id_give);
		$currency_id_get = intval($bids_data->currency_id_get);
		
		$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_give' AND auto_status='1'");
		$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_get' AND auto_status='1'");		
		
		$direction_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
		if(!isset($direction_data->id)){
			return '<div class="exch_error"><div class="exch_error_ins">'. __('Exchange direction is disabled','pn') .'</div></div>';
		}
		
		$direction = array();
		foreach($direction_data as $direction_key => $direction_val){
			$direction[$direction_key] = $direction_val;
		}
		$naps_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$direction_id'");
		foreach($naps_meta as $naps_item){
			$direction[$naps_item->meta_key] = $naps_item->meta_value;
		}	
		$direction = (object)$direction; /* вся информация о направлении */		
		
		$dmetas = @unserialize($bids_data->dmetas);
		$metas = @unserialize($bids_data->metas);		
		
		$status = is_status_name($bids_data->status);
		
		/* timeline */	
		$text = get_direction_descr('timeline_txt', $direction, $vd1, $vd2);
		$text = apply_filters('direction_instruction', $text, 'timeline_txt', $direction, $vd1, $vd2);
		$text = ctv_ml($text);
		
		$timeline = '';		
		if($text){	
			$timeline = '
			<div class="notice_message">
				<div class="notice_message_ins">
					<div class="notice_message_abs"></div>
					<div class="notice_message_close"></div>
					<div class="notice_message_title">
						<div class="notice_message_title_ins">
							<span>'. __('Attention!','pn') .'</span>
						</div>
					</div>
					<div class="notice_message_text">
						<div class="notice_message_text_ins">
							'. apply_filters('comment_text',$text) .'
						</div>
					</div>
				</div>
			</div>';
		}
		/* end timeline */		
		
		$js_autocheck = get_direction_tempdata($status, 'naps_timer'); 
		$status_text = get_direction_tempdata($status, 'naps_status');
		$status_title = get_direction_tempdata($status, 'naps_title'); 		
		
		$date_format = get_option('date_format');
		$time_format = get_option('time_format');		
		$status_date = get_mytime($bids_data->edit_date, "{$date_format}, {$time_format}");		
		
		$m_out = apply_filters('get_paymerchant_id', 0, is_isset($bids_data, 'm_out'), $bids_data);
				
		$pay_instruction = intval($premiumbox->get_option('naps_ap_instruction', 'status_'.$status)); 				
		
		$instruction = get_direction_descr('status_'.$status, $direction, $vd1, $vd2); 			
		if($pay_instruction == 1){
			$instruction = apply_filters('instruction_paymerchant', $instruction, $m_out, $direction, $vd1, $vd2);
			$instruction = ctv_ml($instruction);
		}	
		$instruction = apply_filters('direction_instruction', $instruction, 'status_'.$status, $direction, $vd1, $vd2);
		$instruction = ctv_ml($instruction);		
		
		$instruct = '';
		if($instruction){
			$instruct = '
			<div class="block_statusnew_instruction block_instruction">
				<div class="block_instruction_ins">
					'. apply_filters('comment_text', $instruction) .'
				</div>	
			</div>			
			';
		}

		$account_give = $account_get = '';
		if($bids_data->account_give){
			$txt = pn_strip_input(ctv_ml(is_isset($vd1,'txt1')));
			if(!$txt){ $txt = __('From account','pn'); }
			$account = $bids_data->account_give;
			$account = apply_filters('show_user_account', $account, $bids_data, $direction, $vd1);						
			$account_give = ', <span>'. $txt .'</span>: '. get_secret_value($account, $premiumbox->get_option('exchange','an1_hidden'));
		}	

		if($bids_data->account_get){
			$txt = pn_strip_input(ctv_ml(is_isset($vd2,'txt2')));
			if(!$txt){ $txt = __('Into account','pn'); }
			$account = $bids_data->account_get;
			$account = apply_filters('show_user_account', $account, $bids_data, $direction, $vd2);									
			$account_get = ', <span>'. $txt .'</span>: '. get_secret_value($account, $premiumbox->get_option('exchange','an2_hidden'));
		}		
		
		$array = array(
			'[timeline]' => $timeline,
			'[status]' => $status,
			'[status_title]' => $status_title,
			'[status_date]' => $status_date,
			'[status_text]' => $status_text,			
			'[instruction]' => $instruct,
			'[ps_give]' => pn_strip_input(ctv_ml($bids_data->psys_give)),
			'[ps_get]' => pn_strip_input(ctv_ml($bids_data->psys_get)),
			'[sum_give]' => pn_strip_input($bids_data->sum1c),
			'[sum_get]' => pn_strip_input($bids_data->sum2c),
			'[vtype_give]' => is_site_value($bids_data->currency_code_give),
			'[vtype_get]' => is_site_value($bids_data->currency_code_get),			
			'[account_give]' => $account_give,
			'[account_get]' => $account_get,	
		);
		$array = apply_filters('exchangestep_'. $status .'_html_list', $array, $bids_data, $direction, $vd1, $vd2);
		$array = apply_filters('exchangestep_all_html_list', $array, $bids_data, $direction, $vd1, $vd2);
		
		$html = '
		<div class="block_statusbids block_status_[status]">
			<div class="block_statusbids_ins">
		
				<div class="block_statusbid_title">
					<div class="block_statusbid_title_ins">
						<span>[status_title]</span>
					</div>
				</div>
			
				<div class="block_payinfo">
					<div class="block_payinfo_ins">
						[instruction]
					
						<div class="block_payinfo_line">
							<span>'. __('Send','pn') .':</span> [sum_give] [ps_give] [vtype_give] [account_give]
						</div>
						<div class="block_payinfo_line">
							<span>'. __('Receive','pn') .':</span> [sum_get] [ps_get] [vtype_get] [account_get]
						</div>						
					</div>
				</div>					
				
				<div class="block_status">
					<div class="block_status_ins">
						<div class="block_status_time"><span>'. __('Creation time','pn') .':</span> [status_date]</div>
						<div class="block_status_text"><span class="block_status_text_info">'. __('Status of order','pn') .':</span> <span class="block_status_bids bstatus_[status]">[status_text]</span></div>
					</div>
				</div>';
				
			$html .= '	
			</div>
		</div>		
		';
		
		$html = apply_filters('exchangestep_'. $status .'_html', $html, $bids_data, $direction, $vd1, $vd2);
		$html = apply_filters('exchangestep_all_html', $html, $bids_data, $direction, $vd1, $vd2);
		if($js_autocheck){
			$temp .= '<div class="check_payment_hash" data-time="30" data-hash="'. is_bid_hash($bids_data->hashed) .'"></div>';
		}
		$temp .= get_replace_arrays($array, $html);				
		
	}
	
	return $temp;
}