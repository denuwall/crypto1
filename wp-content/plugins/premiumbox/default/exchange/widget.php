<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('siteplace_js','siteplace_js_exchange_widget');
function siteplace_js_exchange_widget(){
global $premiumbox;	
	$exch_method = intval($premiumbox->get_option('exchange','exch_method'));
	if($exch_method == 1){
?>	
jQuery(function($){ 
	if($('#hexch_html').length > 0){
		$(document).on('click', '.js_exchange_link', function(){
			if(!$(this).hasClass('active')){
				
				var direction_id = $(this).attr('data-direction-id'); 
				
				$('.hexch_ajax_wrap_abs').show();
				
				var tscroll = $('#hexch_html').offset().top - 100;
				$('body,html').animate({scrollTop : tscroll}, 500);
				
				var param = 'direction_id=' + direction_id;
				$.ajax({
					type: "POST",
					url: "<?php echo get_ajax_link('exchange_widget');?>",
					dataType: 'json',
					data: param,
					error: function(res, res2, res3){
						<?php do_action('pn_js_error_response', 'ajax'); ?>
					},					
					success: function(res)
					{
						if(res['html']){
							$('#hexch_html').html(res['html']);
						}
						if(res['status'] == 'error'){
							$('#hexch_html').html('<div class="resultfalse"><div class="resultclose"></div>'+res['status_text']+'</div>');
						}
						<?php do_action('live_change_html'); ?>
						$('.hexch_ajax_wrap_abs').hide();						
					}
				});	

			}
			
			return false;
		});
		
	}	
});
<?php	
	}
}

function the_exchange_widget(){ 
global $premiumbox;		
	$exch_method = intval($premiumbox->get_option('exchange','exch_method'));
	if($exch_method == 1){
?>
<form method="post" class="ajax_post_bids" action="<?php echo get_ajax_link('bidsform'); ?>">
	<div class="hexch_ajax_wrap">
		<div class="hexch_ajax_wrap_abs"></div>
		<div id="hexch_html"><?php //echo get_exchange_widget(32); ?></div>
	</div>
</form>
<?php
	}
} 

add_action('myaction_site_exchange_widget', 'def_myaction_ajax_exchange_widget');
function def_myaction_ajax_exchange_widget(){
global $premiumbox;
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');	
	
	$premiumbox->up_mode();
	
	$direction_id = is_param_post('direction_id');

	$exch_method = intval($premiumbox->get_option('exchange','exch_method'));
	if($exch_method == 1){
		$log['status'] = 'success';
		$log['html'] = get_exchange_widget($direction_id);
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1; 		
	}
	
	echo json_encode($log);
	exit;
} 

function get_exchange_widget($id){
global $wpdb, $premiumbox, $direction_data;
	
	$temp =' ';	
	$id = intval($id);	
		
	$direction_data = array();

	$where = get_directions_where('home');
	$dir = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE $where AND id='$id'");
	if(isset($dir->id)){
		$output = apply_filters('get_direction_output', 1, $dir, 'home');
		if($output){
		
			$currency_id_give = intval($dir->currency_id_give);
			$currency_id_get = intval($dir->currency_id_get);
				
			$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_give'");
			$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_get'");
			if(isset($vd1->id) and isset($vd2->id)){
					
				$direction_id = intval($dir->id);
					
				$direction_data['direction_id'] = intval($dir->id);	
				$direction_data['item_give'] = get_currency_title($vd1);
				$direction_data['item_get'] = get_currency_title($vd2);
				$direction_data['currency_id_give'] = $vd1->id;
				$direction_data['currency_id_get'] = $vd2->id;
				$direction_data['vd1'] = $vd1;
				$direction_data['vd2'] = $vd2;
				$direction_data['direction'] = $dir;
				if(!is_object($direction_data)){
					$direction_data = (object)$direction_data;
				}		
		
				$ui = wp_get_current_user();
				$user_id = intval($ui->ID);
		
				$show_data = pn_exchanges_output('home');
					
				if($show_data['text']){
					$temp .= '<div class="exch_error"><div class="exch_error_ins">'. $show_data['text'] .'</div></div>';
				}
				if($show_data['mode'] == 1){
					
					$direction_id = intval($direction_data->direction_id);
					$vd1 = $direction_data->vd1;
					$vd2 = $direction_data->vd2;
					$direction = $direction_data->direction;
					
					$temp .= apply_filters('before_exchange_widget','');
					$temp .= '<input type="hidden" name="direction_id" class="js_direction_id" value="'. $direction_id .'" />';
					
					/* message */
					$text = get_direction_descr('timeline_txt', $direction, $vd1, $vd2);
					$text = apply_filters('direction_instruction', $text, 'timeline_txt', $direction, $vd1, $vd2);
					$text = ctv_ml($text);
					
					$message = '';
					if($text){	
						$message = '
						<div class="hexch_message_wrap">
							<div class="hexch_message">
								<div class="hexch_message_ins">
									<div class="hexch_message_abs"></div>
									<div class="hexch_message_close"></div>
									<div class="hexch_message_title">
										<div class="hexch_message_title_ins">
											<span>'. __('Attention!','pn') .'</span>
										</div>
									</div>
									<div class="hexch_message_text">
										<div class="hexch_message_text_ins">
											'. apply_filters('comment_text', $text) .'
										</div>
									</div>
								</div>
							</div>
						</div>';
					}
					/* end message */
			
					/* description */
					$text = get_direction_descr('description_txt', $direction, $vd1, $vd2);	
					$text = apply_filters('direction_instruction', $text, 'description_txt', $direction, $vd1, $vd2);
					$text = ctv_ml($text);
					
					$description = '';	
					if($text){			
						$title = get_exchange_title();								
						$description = '
						<div class="warning_message" itemscope itemtype="http://schema.org/Article">
							<div class="warning_message_ins">
								<div class="warning_message_abs"></div>
								<div class="warning_message_close"></div>
								<div class="warning_message_title">
									<div class="warning_message_title_ins" itemprop="name">
										<span>'. $title .'</span>
									</div>
								</div>
								<div class="warning_message_text">
									<div class="warning_message_text_ins" itemprop="articleBody">
										'. apply_filters('comment_text',$text) .'
									</div>
								</div>
							</div>
						</div>';			
					}					
					/* end description */
					
					/* window */
					$text = get_direction_descr('window_txt', $direction, $vd1, $vd2);	
					$text = apply_filters('direction_instruction', $text, 'window_txt', $direction, $vd1, $vd2);
					$text = ctv_ml($text);
					
					$window_txt = '';	
					if($text){											
						$window_txt = '
						<div class="window_message" style="display: none;">
							<div class="window_message_ins">
								'. apply_filters('comment_text',$text) .'
							</div>
						</div>';			
					}					
					/* end window */					

					/* check */	
					$check_data = intval(get_pn_cookie('check_data'));
					$ch_ch = '';
					if($check_data == 1){
						$ch_ch = 'checked="checked"';				
					}
						
					$remember ='
					<div class="hexch_checkdata_div">
						<label><input type="checkbox" id="check_data" name="check_data" '. $ch_ch .' value="1" /> '. __('Remember entered data','pn') .'</label>
					</div>
					';
					
					$check = '';
					$enable_step2 = intval($premiumbox->get_option('exchange','enable_step2'));
					if($enable_step2 == 0){
						$check = '	
						<div class="hexch_checkdata_div">
							<label><input type="checkbox" name="check_rule" value="1" /> '. sprintf(__('I read and agree with <a href="%s" target="_blank">the terms and conditions</a>','pn'), $premiumbox->get_page('tos')) .'</label>
						</div>
						';
					}
					/* end check */				
				
					/* submit */	
					$submit = '
					<div class="hexch_submit_div">
						<input type="submit" formtarget="_top" class="hexch_submit" value="'. __('Exchange','pn') .'">
							<div class="clear"></div>
					</div>';					
					/* end submit */
		
					$post_sum = is_sum(get_pn_cookie('cache_sum1'));			
					$calc_data = array(
						'vd1' => $vd1,
						'vd2' => $vd2,
						'direction' => $direction,
						'user_id' => $user_id,
						'ui' => $ui,
						'post_sum' => $post_sum,
					);
					$calc_data = apply_filters('get_calc_data_params', $calc_data);
					$cdata = get_calc_data($calc_data);									

					$currency_code_give = $cdata['currency_code_give'];
					$currency_code_get = $cdata['currency_code_get'];
					$psys_give = $cdata['psys_give'];
					$psys_get = $cdata['psys_get'];						
																												
					$user_discount = $cdata['user_discount'];
					$us = '';
					if($user_discount > 0){
						$us = '<p><span class="span_skidka">'. __('Your discount','pn') .': <span class="js_direction_user_discount">'. $user_discount .'</span>%</span></p>';
					}											
										
					$comis_text1 = $cdata['comis_text1'];
					$comis_text2 = $cdata['comis_text2'];
									
					$sum1_error = $sum2_error = $sum1c_error = $sum2c_error = '';
					$sum1_error_txt = $sum2_error_txt = $sum1c_error_txt = $sum2c_error_txt = '';
																			
					$viv_com1 = 'style="display: none;"'; /* не выводим поле доп.комиссии */
					if($cdata['viv_com1'] == 1){
						$viv_com1 = '';
					}
													
					$viv_com2 = 'style="display: none;"'; /* не выводим поле доп.комиссии */
					if($cdata['viv_com2'] == 1){
						$viv_com2 = '';
					}	

					$sum1 = $cdata['sum1'];
					$sum1c = $cdata['sum1c'];
					$sum2 = $cdata['sum2'];
					$sum2c = $cdata['sum2c'];
											
					$min1 = get_min_sum_to_direction_give($direction, $vd1, $vd2);
					$max1 = get_max_sum_to_direction_give($direction, $vd1, $vd2);
					/* if($min1 > $max1 and is_numeric($max1)){ $min1 = $max1; } */								
											
					$vz1 = array();
					if($min1 > 0){
						$vz1[] = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> '.$currency_code_give;
					}
					if(is_numeric($max1)){
						$vz1[] = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> '.$currency_code_give;
					}
					$zvt1 = '';
					if(count($vz1) > 0){
						$zvt1 = '<p class="span_give_max">'. join(', ',$vz1) .'</p>';
					}
											
					$min2 = get_min_sum_to_direction_get($direction, $vd1, $vd2); 
					$max2 = get_max_sum_to_direction_get($direction, $vd1, $vd2);
					/* if($min2 > $max2 and is_numeric($max2)){ $min2 = $max2; } */
														
					$vz2 = array();	
					if($min2 > 0){
						$vz2[] = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> '.$currency_code_get;
					}
					if(is_numeric($max2)){
						$vz2[] = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> '.$currency_code_get;
					}

					$zvt2 = '';
					if(count($vz2) > 0){
						$zvt2 = '<span class="span_get_max">'. join(', ',$vz2) .'</span>';
					}											
											
					if($sum1 < $min1){
						$sum1_error = 'error';
						$sum1_error_txt = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> '. $currency_code_give;													
					}
					if($sum1 > $max1 and is_numeric($max1)){
						$sum1_error = 'error';
						$sum1_error_txt = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> '. $currency_code_give;													
					}
					if($sum1c < 0){
						$sum1c_error = 'error';
					}
					if($sum2 < $min2){
						$sum2_error = 'error';
						$sum2_error_txt = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> '. $currency_code_get;													
					}
					if($sum2 > $max2 and is_numeric($max2)){
						$sum2_error = 'error';
						$sum2_error_txt = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> '. $currency_code_get;													
					}
					if($sum2c < 0){
						$sum2c_error = 'error';
					}																																
				
					$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv, $vd2->currency_decimal, $direction),$vd2->currency_decimal, 'reserv');
				
					$meta1 = $meta2 = '';
				
					if($zvt1 or $zvt2 or $us){
						$meta1 = '
						<div class="hexch_txt_line">
							'. $zvt1 .'
						</div>';	
					}

					if($zvt1 or $zvt2 or $us){
						$meta2 = '
						<div class="hexch_txt_line">
							'. $zvt2 .'
							'. $us .'
						</div>';
					}	

					$input_give = '
					<div class="hexch_curs_input js_wrap_error js_wrap_error_br '. $sum1_error .'">';
						$input_give .= apply_filters('exchange_input', '', 'give', $cdata, $calc_data);
						$input_give .= '
						<div class="js_error js_sum1_error">'. $sum1_error_txt .'</div>					
					</div>				
					';
					
					$input_get = '
					<div class="hexch_curs_input js_wrap_error js_wrap_error_br '. $sum2_error .'">';
						$input_get .= apply_filters('exchange_input', '', 'get', $cdata, $calc_data);
						$input_get .= '
						<div class="js_error js_sum2_error">'. $sum2_error_txt .'</div>					
					</div>				
					';				
					
					$com_give = '
					<div class="hexch_curs_input js_wrap_error js_wrap_error_br '. $sum1c_error .'">';
						$com_give .= apply_filters('exchange_input', '', 'give_com', $cdata, $calc_data);
						$com_give .= '
						<div class="js_error js_sum1c_error">'. $sum1c_error_txt .'</div>
					</div>				
					';
				
					$com_give_text = '
					<div class="hexch_comis_line js_viv_com1" '. $viv_com1 .'>
						<span class="js_comis_text1">'. $comis_text1 .'</span>
					</div>				
					';
				
					$com_get = '
					<div class="hexch_curs_input js_wrap_error js_wrap_error_br '. $sum2c_error .'">';
						$com_get .= apply_filters('exchange_input', '', 'get_com', $cdata, $calc_data);
						$com_get .= '
						<div class="js_error js_sum2c_error">'. $sum2c_error_txt .'</div>
					</div>				
					';
				
					$com_get_text = '
					<div class="hexch_comis_line js_viv_com2" '. $viv_com2 .'>
						<span class="js_comis_text2">'. $comis_text2 .'</span>
					</div>				
					';				
				
					$array = array(
						'[timeline]' => $message,
						'[description]' => $description,
						'[window]' => $window_txt,
						'[other_filter]' => apply_filters('exchange_other_filter', '', $direction, $vd1, $vd2, $cdata),
						'[result]' => '<div class="ajax_post_bids_res"></div>',
						'[check]' => apply_filters('exchange_check_filter', $check, $direction, $vd1, $vd2, $cdata),
						'[remember]' => $remember,
						'[submit]' => $submit,
						'[filters]' => apply_filters('exchange_step1','', $direction, $vd1, $vd2, $cdata),
						'[reserve]' => '<span class="js_reserv_html">'. $reserv .' '. $currency_code_get .'</span>',
						'[course]' => '<span class="js_curs_html">'. apply_filters('show_table_course', $cdata['course_give'], $cdata['decimal_give']) .' '. $currency_code_give .' = '. apply_filters('show_table_course', $cdata['course_get'], $cdata['decimal_get']) .' '. $currency_code_get .'</span>',
						'[psys_give]' => $psys_give,
						'[vtype_give]' => $currency_code_give,
						'[currency_code_give]' => $currency_code_give,
						'[psys_get]' => $psys_get,
						'[vtype_get]' => $currency_code_get,
						'[currency_code_get]' => $currency_code_get,
						'[meta1]' => $meta1,
						'[meta2]' => $meta2,
						'[input_give]' => $input_give,
						'[input_get]' => $input_get,
						'[com_give]' => $com_give,
						'[com_give_text]' => $com_give_text,
						'[com_get]' => $com_get,
						'[com_get_text]' => $com_get_text,	
						'[account_give]' => get_account_wline($vd1, $direction, 1,'widget'),	
						'[account_get]' => get_account_wline($vd2, $direction, 2, 'widget'),
						'[give_field]' => get_doppole_wline($vd1, $direction, 1,'widget'),
						'[get_field]' => get_doppole_wline($vd2, $direction, 2, 'widget'),
						'[com_class_give]' => $viv_com1,
						'[com_class_get]' => $viv_com2,
					);	
					$array['[naps_field]'] = $array['[direction_field]'] = get_direction_wline($direction, 'widget');
					$array = apply_filters('exchange_html_list_ajax', $array, $direction, $vd1, $vd2, $cdata);
		
					$html = '
					[window]
					[timeline]
					[other_filter]
					
					<div class="hexch_div">
						<div class="hexch_div_ins">
							<div class="hexch_left">
								<div class="hexch_title">
									<div class="hexch_title_ins">
										<span>'. __('Send','pn') .' <span class="hexch_psys">"[psys_give] [currency_code_give]"</span></span>
									</div>
								</div>
								
								[meta1]
								
								<div class="hexch_curs_line">
									<div class="hexch_curs_label">
										<div class="hexch_curs_label_ins">
											'. __('Amount','pn') .'<span class="req">*</span>:
										</div>
									</div>											
	
									[input_give]
				
										<div class="clear"></div>
								</div>

								<div class="hexch_curs_line js_viv_com1" [com_class_give]>
									<div class="hexch_curs_label">
										<div class="hexch_curs_label_ins">
											'. __('With fees','pn') .'<span class="req">*</span>:
										</div>
									</div>
									[com_give]
		
									<div class="clear"></div>
								</div>
								[com_give_text]	

								[account_give]
								
								[give_field]								
	
							</div>
							<div class="hexch_right">
								<div class="hexch_title">
									<div class="hexch_title_ins">
										<span>'. __('Receive','pn') .' <span class="hexch_psys">"[psys_get] [currency_code_get]"</span></span>
									</div>
								</div>	
								
								[meta2]

								<div class="hexch_curs_line">
									<div class="hexch_curs_label">
										<div class="hexch_curs_label_ins">
											'. __('Amount','pn') .'<span class="req">*</span>:
										</div>
									</div>
			
									[input_get]	
			
										<div class="clear"></div>
								</div>								
		
								<div class="hexch_curs_line js_viv_com2" [com_class_get]>
									<div class="hexch_curs_label">
										<div class="hexch_curs_label_ins">
											'. __('With fees','pn') .'<span class="req">*</span>:
										</div>
									</div>
									[com_get]
			
										<div class="clear"></div>
								</div>
								[com_get_text]

								[account_get]
								
								[get_field]
							
							</div>
								<div class="clear"></div>';
								
							$html .= '
								[direction_field]
									<div class="clear"></div>
								[filters]
								[submit]
								[check]
								[remember]
								[result]
						</div>	
					</div>
					';		
		
					$html = apply_filters('exchange_html_ajax', $html, $direction, $vd1, $vd2, $cdata);			
					$temp .= get_replace_arrays($array, $html);
					$temp .= apply_filters('after_exchange_widget','');
				
				} 			
			} else {
				$temp = '<div class="hexch_error"><div class="hexch_error_ins">'. __('Error! The direction do not exist','pn') .'</div></div>';
			}
		} else {
			$temp = '<div class="hexch_error"><div class="hexch_error_ins">'. __('Error! The direction do not exist','pn') .'</div></div>';
		} 		
	} else {
		$temp = '<div class="hexch_error"><div class="hexch_error_ins">'. __('Error! The direction do not exist','pn') .'</div></div>';
	} 
	
	if(!is_object($direction_data)){
		$direction_data = (object)$direction_data;
	}
	
	return $temp;
}