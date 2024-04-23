<?php
if( !defined( 'ABSPATH')){ exit(); } 

add_action('template_redirect','direction_initialization',0);
function direction_initialization(){
global $wpdb, $direction_data, $premiumbox;

	$direction_data = array();
	$pnhash = is_direction_name(get_query_var('pnhash'));
	if(is_exchange_page() and $pnhash){
		$where = get_directions_where('exchange');
		$dir = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_name='$pnhash' AND $where");
		if(isset($dir->id)){
			$output = apply_filters('get_direction_output', 1, $dir, 'exchange');
			if($output){
				$currency_id_give = intval($dir->currency_id_give);
				$currency_id_get = intval($dir->currency_id_get);
				
				$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_give'");
				$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_get'");
				if(isset($vd1->id) and isset($vd2->id)){
					
					$direction_data['direction_id'] = intval($dir->id);
					$direction_data['item_give'] = get_currency_title($vd1);
					$direction_data['item_get'] = get_currency_title($vd2);
					$direction_data['currency_id_give'] = $vd1->id;
					$direction_data['currency_id_get'] = $vd2->id;
					$direction_data['vd1'] = $vd1;
					$direction_data['vd2'] = $vd2;
					$direction_data['direction'] = $dir;
					
				}
			}
		}
	} 
	$direction_data = (object)$direction_data;
}
 
add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_direction');
function wp_before_admin_bar_render_direction(){
global $wp_admin_bar, $direction_data;
	
    if(current_user_can('administrator') or current_user_can('pn_directions')){
		if(!is_admin()){
			if(isset($direction_data->direction_id)){
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_directions',
					'href' => admin_url('admin.php?page=pn_add_directions&item_id='. $direction_data->direction_id),
					'title'  => __('Edit direction exchange','pn'),	
				));	
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_currency_give',
					'parent' => 'edit_directions',
					'href' => admin_url('admin.php?page=pn_add_currency&item_id='. $direction_data->currency_id_give),
					'title'  => sprintf(__('Edit "%s"','pn'), $direction_data->item_give),	
				));
				$wp_admin_bar->add_menu( array(
					'id'     => 'edit_currency_get',
					'parent' => 'edit_directions',
					'href' => admin_url('admin.php?page=pn_add_currency&item_id='. $direction_data->currency_id_get),
					'title'  => sprintf(__('Edit "%s"','pn'), $direction_data->item_get),	
				));				
			}
		}
	}
}

add_action('siteplace_js','siteplace_js_exchange_step1');
function siteplace_js_exchange_step1(){
?>	
jQuery(function($){ 

 	function get_exchange_step1(id){
		
		var id1 = $('#select_give').val();
		var id2 = $('#select_get').val();
		
		$('.exch_ajax_wrap_abs').show();
			
		var param='id='+id+'&id1=' + id1 + '&id2=' + id2;
		$.ajax({
			type: "POST",
			url: "<?php echo get_ajax_link('exchange_step1');?>",
			dataType: 'json',
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{
					
				$('.exch_ajax_wrap_abs').hide();
				
				if(res['status'] == 'success'){
					$('#exch_html').html(res['html']);	

					if($('#the_title_page').length > 0){
						$('#the_title_page, .direction_title').html(res['titlepage']);
					}	
					
					$('title').html(res['title']);
					
					if($('meta[name=keywords]').length > 0){
						$('meta[name=keywords]').attr('content', res['keywords']);
					}
					if($('meta[name=description]').length > 0){
						$('meta[name=description]').attr('content', res['description']);
					}
					
					var thelink = res['thelink'];
					if(thelink){
						window.history.replaceState(null, null, thelink);
					}				
					
					<?php do_action('live_change_html'); ?>
				} else {
					<?php do_action('pn_js_alert_response'); ?>
				}
					
			}
		});		
		
	}
	$(document).on('change', '#select_give', function(){
		get_exchange_step1(1);
	});
	
	$(document).on('change', '#select_get', function(){
		get_exchange_step1(2);
	});	
	
});	
<?php	
}

add_action('myaction_site_exchange_step1', 'def_myaction_ajax_exchange_step1');
function def_myaction_ajax_exchange_step1(){
global $wpdb, $premiumbox, $direction_data;	
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');		
	
	$premiumbox->up_mode();
	
	$id = intval(is_param_post('id'));
	$id1 = intval(is_param_post('id1')); if($id1 < 0){ $id1 = 0; }
	$id2 = intval(is_param_post('id2')); if($id2 < 0){ $id2 = 0; }	
	
	$where = get_directions_where('exchange');
	$dir = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE $where AND currency_id_give='$id1' AND currency_id_get='$id2'");
	if(isset($dir->id)){
		$output = apply_filters('get_direction_output', 1, $dir, 'exchange');
		if(!$output){
			$dir = '';
		}
	}
	
	if(!isset($dir->id)){
		$tablenot = intval($premiumbox->get_option('exchange','tablenot'));
		if($tablenot == 1){
			if($id == 1){
				$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_give = '$id1' ORDER BY site_order1 ASC");
				foreach($direction_items as $nap){
					$output = apply_filters('get_direction_output', 1, $nap, 'exchange');
					if($output){
						$dir = $nap;
						break;
					}	
				}				
			} else {
				$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_get='$id2' ORDER BY site_order1 ASC");
				foreach($direction_items as $nap){
					$output = apply_filters('get_direction_output', 1, $nap, 'exchange');
					if($output){
						$dir = $nap;
						break;
					}	
				}				
			}
		}
	}	
			
	if(isset($dir->id)){
		
		$currency_id_give = intval($dir->currency_id_give);
		$currency_id_get = intval($dir->currency_id_get);
				
		$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_give'");
		$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status='1' AND id='$currency_id_get'");
		if(isset($vd1->id) and isset($vd2->id)){
					
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
						
			$log['status'] = 'success';
			$log['thelink'] = get_exchange_link($dir->direction_name);
			$log['html'] = get_exchange_html($id);

			$name = get_option('blogname');								
			$titlepage = get_exchange_title();	
									
			$log['title'] = $name . '- '. $titlepage;
			$log['titlepage'] = $titlepage;
			$log['keywords'] = '';
			$log['description'] = '';
			$log = apply_filters('exchange_step1_log', $log);
			
		} else {	
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = __('Error! The direction do not exist','pn');
		}	
		
	} else {	
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! The direction do not exist','pn');
	}
	
	if(!is_object($direction_data)){
		$direction_data = (object)$direction_data;
	}	
	
	echo json_encode($log);
	exit;
}

function get_exchange_html($place){
global $wpdb, $direction_data, $premiumbox;	
	
	$temp = '';	
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	
	$place = intval($place);
	
	$show_data = pn_exchanges_output('exchange');
	
	if($show_data['text']){
		$temp .= '<div class="exch_error"><div class="exch_error_ins">'. $show_data['text'] .'</div></div>';
	}	
	
	if($show_data['mode'] == 1 and isset($direction_data->direction_id) and $direction_data->direction_id > 0){
		
		$direction_id = intval($direction_data->direction_id);
		$vd1 = $direction_data->vd1;
		$vd2 = $direction_data->vd2;
		$direction = $direction_data->direction;
		
		$temp .= apply_filters('before_exchange_table','');
		$temp .= '<input type="hidden" name="direction_id" class="js_direction_id" value="'. $direction_id .'" />';
			
		/* message */	
		$text = get_direction_descr('timeline_txt', $direction, $vd1, $vd2);
		$text = apply_filters('direction_instruction', $text, 'timeline_txt', $direction, $vd1, $vd2);
		$text = ctv_ml($text);
		
		$message = '';		
		if($text){	
			$message = '
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
		<div class="xchange_checkdata_div">
			<label><input type="checkbox" id="check_data" name="check_data" '. $ch_ch .' value="1" /> '. __('Remember entered data','pn') .'</label>
		</div>
		';
		
		$check = '';
		$enable_step2 = intval($premiumbox->get_option('exchange','enable_step2'));
		if($enable_step2 == 0){
			$check ='	
			<div class="xchange_checkdata_div">
				<label><input type="checkbox" name="check_rule" value="1" /> '. sprintf(__('I read and agree with <a href="%s" target="_blank">the terms and conditions</a>','pn'), $premiumbox->get_page('tos')) .'</label>
			</div>
			';
		}		
		/* end check */	
			
		/* submit */	
		$submit = '
		<div class="xchange_submit_div">
			<input type="submit" formtarget="_top" class="xchange_submit" name="" value="'. __('Exchange','pn') .'" /> 
				<div class="clear"></div>
		</div>';
		/* end submit */	
	
		$post_sum = is_sum(is_param_get('get_sum'));
		if($post_sum <= 0){
			$post_sum = is_sum(get_pn_cookie('cache_sum1'));
		}		
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
			$us = '<span class="span_skidka">'. __('Your discount','pn') .': <span class="js_direction_user_discount">'. $user_discount .'</span>%</span>';
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
			$sum1_error_txt = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> '.$currency_code_give;													
		}
		if($sum1 > $max1 and is_numeric($max1)){
			$sum1_error = 'error';
			$sum1_error_txt = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> '.$currency_code_give;													
		}
		if($sum1c < 0){
			$sum1c_error = 'error';
		}
		if($sum2 < $min2){
			$sum2_error = 'error';
			$sum2_error_txt = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> '.$currency_code_get;													
		}
		if($sum2 > $max2 and is_numeric($max2)){
			$sum2_error = 'error';
			$sum2_error_txt = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> '.$currency_code_get;													
		}
		if($sum2c < 0){
			$sum2c_error = 'error';
		}	

		$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv,$vd2->currency_decimal, $direction),$vd2->currency_decimal, 'reserv');
				
		$meta1 = $meta2 = $meta1d = $meta2d = '';	
		if($zvt1){
			$meta1d = '<div class="xchange_info_line"></div>';
		}	

		if($zvt1){
			$meta1 = '<div class="xchange_info_line">'. $zvt1 .'</div>';
		}

		if($zvt2 or $us){
			$meta2d = '<div class="xchange_info_line">'. $us .'</div>';
		}		
		
		if($zvt2 or $us){
			$meta2 = '<div class="xchange_info_line">'. $zvt2 .'</div>';
		}

		/* selects */
		$directions1 = $directions2 = array();
			
		$valid1 = $vd1->id;
		$valid2 = $vd2->id;
			
		$select_give = $select_get = '';
			
		$tableselect = intval($premiumbox->get_option('exchange','tableselect'));	
		$tableicon = get_icon_for_table();
		if(function_exists('is_mobile') and is_mobile()){
			$tableicon = get_mobile_icon_for_table();
		}
			
		$v = get_currency_data();	
			
		$where = get_directions_where('exchange');			
		$directions_arr = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY site_order1 ASC");
		foreach($directions_arr as $nd){
			$output = apply_filters('get_direction_output', 1, $nd, 'exchange');
			if($output){
				if($tableselect == 1){
					if($place == 1){ /* если выбрана левая сторона */
						$directions1[$nd->currency_id_give] = $nd;
						if($nd->currency_id_give == $valid1){
							$directions2[$nd->currency_id_get] = $nd;
						}
					} else { /* если выбрана правая сторона */
						$directions2[$nd->currency_id_get] = $nd;
						if($nd->currency_id_get == $valid2){
							$directions1[$nd->currency_id_give] = $nd;
						}						
					}
				} else {
					$directions1[$nd->currency_id_give] = $nd;
					$directions2[$nd->currency_id_get] = $nd;					
				}
			}
		}		
		
		$select_give = '
		<select name="" class="imager" autocomplete="off" id="select_give">'; 
			foreach($directions1 as $key => $np){
				$select_give .= '<option value="'. $key .'" '. selected($key,$valid1,false) .' data-img="'. get_currency_logo($v[$key], $tableicon) .'">'. get_currency_title($v[$key]) .'</option>';
			}
		$select_give .= '
		</select>';	

		$select_get = '
		<select name="" class="imager" autocomplete="off" id="select_get">';
			foreach($directions2 as $key => $np){					
				$select_get .= '<option value="'. $key .'" '. selected($key,$valid2,false) .' data-img="'. get_currency_logo($v[$key], $tableicon) .'">'. get_currency_title($v[$key]) .'</option>';					
			}
		$select_get .= '
		</select>';	
		/* end selects */
		
		$com_give_text = '
		<div class="xchange_sumandcom js_viv_com1" '. $viv_com1 .'>
			<span class="js_comis_text1">'. $comis_text1 .'</span>
		</div>';		
		
		$com_get_text = '
		<div class="xchange_sumandcom js_viv_com2" '. $viv_com2 .'>
			<span class="js_comis_text2">'. $comis_text2 .'</span>
		</div>';		
		
		$input_give ='
		<div class="xchange_sum_input js_wrap_error js_wrap_error_br '. $sum1_error .'">';
			$input_give .= apply_filters('exchange_input', '', 'give', $cdata, $calc_data);
			$input_give .= '
			<div class="js_error js_sum1_error">'. $sum1_error_txt .'</div>
		</div>
		';	

		$input_get ='
		<div class="xchange_sum_input js_wrap_error js_wrap_error_br '. $sum2_error .'">';
			$input_get .= apply_filters('exchange_input', '', 'get', $cdata, $calc_data);
			$input_get .= '
			<div class="js_error js_sum2_error">'. $sum2_error_txt .'</div>
		</div>
		';	

		$com_give ='
		<div class="xchange_sum_input js_wrap_error js_wrap_error_br '. $sum1c_error .'">';
			$com_give .= apply_filters('exchange_input', '', 'give_com', $cdata, $calc_data);
			$com_give .= '
			<div class="js_error js_sum1c_error">'. $sum1c_error_txt .'</div>
		</div>';

		$com_get ='
		<div class="xchange_sum_input js_wrap_error js_wrap_error_br '. $sum2c_error .'">';
			$com_get .= apply_filters('exchange_input', '', 'get_com', $cdata, $calc_data);
			$com_get .= '
			<div class="js_error js_sum2c_error">'. $sum2c_error_txt .'</div>
		</div>';		
		
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
			'[meta1d]' => $meta1d,
			'[meta2]' => $meta2,
			'[meta2d]' => $meta2d,
			'[select_give]' => $select_give,
			'[select_get]' => $select_get,
			'[input_give]' => $input_give,
			'[input_get]' => $input_get,
			'[com_give]' => $com_give,
			'[com_give_text]' => $com_give_text,
			'[com_get]' => $com_get,
			'[com_get_text]' => $com_get_text,	
			'[account_give]' => get_account_wline($vd1, $direction, 1,'shortcode'),	
			'[account_get]' => get_account_wline($vd2, $direction, 2,'shortcode'),
			'[give_field]' => get_doppole_wline($vd1, $direction, 1, 'shortcode'),
			'[get_field]' => get_doppole_wline($vd2, $direction, 2, 'shortcode'),
			'[com_class_give]' => $viv_com1,
			'[com_class_get]' => $viv_com2,
		);
		$array['[naps_field]'] = $array['[direction_field]'] = get_direction_wline($direction, $place);
		$array = apply_filters('exchange_html_list', $array, $direction, $vd1, $vd2, $cdata);

		$html = '
			[window]
			[timeline]
			[other_filter]
	
			<div class="xchange_div">
				<div class="xchange_div_ins">
					<div class="xchange_data_title otd">
						<div class="xchange_data_title_ins">
							<span>'. __('Send','pn') .'</span>
						</div>	
					</div>
					<div class="xchange_data_div">
						<div class="xchange_data_ins">
							<div class="xchange_data_left">
								[meta1d]
							</div>	
							<div class="xchange_data_right">
								[meta1]
							</div>
								<div class="clear"></div>
					
							<div class="xchange_data_left">
								<div class="xchange_select">
									[select_give]						
								</div>
							</div>	
							<div class="xchange_data_right">
								<div class="xchange_sum_line">
									<div class="xchange_sum_label">
										'. __('Amount','pn') .'<span class="req">*</span>:
									</div>
									[input_give]
										<div class="clear"></div>
								</div>
							</div>
								<div class="clear"></div>										
							<div class="xchange_data_left">
								[com_give_text]
							</div>	
							<div class="xchange_data_right">
								<div class="xchange_sum_line js_viv_com1" [com_class_give]>
									<div class="xchange_sum_label">
										'. __('Amount','pn') .'<span class="req">*</span>:
									</div>
									[com_give]
										<div class="clear"></div>
								</div>
							</div>
								<div class="clear"></div>										
							<div class="xchange_data_left">
								[account_give]
								[give_field]
							</div>	
								<div class="clear"></div>
						</div>
					</div>					
					<div class="xchange_data_title pol">
						<div class="xchange_data_title_ins">
							<span>'. __('Receive','pn') .'</span>
						</div>	
					</div>
					<div class="xchange_data_div">
						<div class="xchange_data_ins">					
							<div class="xchange_data_left">
								[meta2d]
							</div>
							<div class="xchange_data_right">
								[meta2]
							</div>
								<div class="clear"></div>
								
							<div class="xchange_data_left">
								<div class="xchange_select">
									[select_get]						
								</div>									
							</div>
							<div class="xchange_data_right">
								<div class="xchange_sum_line">
									<div class="xchange_sum_label">
										'. __('Amount','pn') .'<span class="req">*</span>:
									</div>
									[input_get]
										<div class="clear"></div>
									</div>									
								</div>
									<div class="clear"></div>
							<div class="xchange_data_left">
								[com_get_text]
							</div>
							<div class="xchange_data_right">
								<div class="xchange_sum_line js_viv_com2" [com_class_get]>
									<div class="xchange_sum_label">
										'. __('Amount','pn') .'<span class="req">*</span>:
									</div>
									[com_get]
										<div class="clear"></div>
								</div>									
							</div>
								<div class="clear"></div>
							<div class="xchange_data_left">	
								[account_get]
								[get_field]
							 </div>					
								<div class="clear"></div>	
						</div>
					</div>			
					[direction_field]
						<div class="clear"></div>
					[filters]
					[submit]
					[check]
					[remember]
					[result]
				</div>
			</div>
			
			[description]
		';

		$html = apply_filters('exchange_html', $html, $direction, $vd1, $vd2, $cdata);			
		$temp .= get_replace_arrays($array, $html);	
	
		$temp .= apply_filters('after_exchange_table','');
	} else {
		$temp .= '<div class="exch_error"><div class="exch_error_ins">'. __('Error! The direction do not exist','pn') .'</div></div>';
	}
	
	return $temp;
}

function exchange_page_shortcode($atts, $content) {
global $wpdb, $premiumbox;
	
	$temp = '';
	
	$temp .= apply_filters('before_exchange_page','');
	$temp .= '
	<form method="post" class="ajax_post_bids" action="'. get_ajax_link('bidsform') .'">
		<div class="exch_ajax_wrap">
			<div class="exch_ajax_wrap_abs"></div>
			<div id="exch_html">'. get_exchange_html(1) .'</div>
		</div>
	</form>
	';
	$temp .= apply_filters('after_exchange_page','');
	
	return $temp;
}
add_shortcode('exchange', 'exchange_page_shortcode');