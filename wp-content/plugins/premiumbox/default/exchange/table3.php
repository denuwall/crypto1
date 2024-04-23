<?php
if( !defined( 'ABSPATH')){ exit(); } 

add_action('siteplace_js','siteplace_js_exchange_table3');
function siteplace_js_exchange_table3(){
	if(get_type_table() == 3){
?>	
jQuery(function($){
	
	function get_table_exchange(id,id1,id2){
		
		$('#js_submit_button').addClass('active');		
		$('.js_loader').show();
			
		var param='id='+id+'&id1=' + id1 + '&id2=' + id2;

		$.ajax({
			type: "POST",
			url: "<?php echo get_ajax_link('table3_change_select');?>",
			dataType: 'json',
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{
					
				$('.js_loader').hide();

				$('#js_html').html(res['html']);	

				if($('#hexch_html').length > 0){
					$('#hexch_html').html('');
				}	
				
				<?php do_action('live_change_html'); ?>
					
			}
		});		
		
	}
	 
	$(document).on('change', '#js_left_sel', function(){
		var id1 = $('#js_left_sel').val();
		var id2 = $('#js_right_sel').val();
		get_table_exchange(1, id1, id2);
	});
	
	$(document).on('change', '#js_right_sel', function(){
		var id1 = $('#js_left_sel').val();
		var id2 = $('#js_right_sel').val();
		get_table_exchange(2, id1, id2);
	});	

	$(document).on('click', '#js_reload_table', function(){
		
		var id1 = $('#js_right_sel').val();
		var id2 = $('#js_left_sel').val();
		get_table_exchange(1, id1, id2);	
		
		return false;
	});
	
	$(document).on('click', '#js_submit_button', function(){
		if($(this).hasClass('active')){
			return false;
		}
	});
});	
<?php	
	}
} 	

add_filter('exchange_table_type3','get_exchange_table3', 10, 3);
function get_exchange_table3($temp, $def_cur_from='', $def_cur_to=''){
global $wpdb;	

	$temp = '';
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);

	$cur_from = is_xml_value(is_param_get('cur_from'));
	if(!$cur_from){
		$cur_from = $def_cur_from;
	}
	$cur_from = is_xml_value($cur_from);
	
	$cur_to = is_xml_value(is_param_get('cur_to'));
	if(!$cur_to){
		$cur_to = $def_cur_to;
	}	
	$cur_to = is_xml_value($cur_to);	

	$from = $to = 0;
	if($cur_from and $cur_to){
		$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status = '1' AND xml_value='$cur_from'");
		$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND currency_status = '1' AND xml_value='$cur_to'");
		if(isset($vd1->id) and isset($vd2->id)){
			$from = $vd1->id;
			$to = $vd2->id;	
		}
	} 
	
	if(!$from){
		$where = get_directions_where('home');
		$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
		foreach($direction_items as $direction){
			$output = apply_filters('get_direction_output', 1, $direction, 'home');
			if($output){
				$from = $direction->currency_id_give;
				$to = $direction->currency_id_get;
				break;
			}	
		}		
	}
	
	$temp .='
	<div class="xchange_type_list">
		<div class="xchange_type_list_ins">

			<div class="xtl_table_wrap">
				<div class="xtl_table_wrap_ins">';
				
					$exchange_table3_head ='
					<div class="xtl_table_top">
				
						<div class="xtl_left_col">
							<div class="xtl_table_title">
								<div class="xtl_table_title_ins">
									'. __('You send','pn') .'
								</div>
							</div>
								<div class="clear"></div>									
						</div>
						
						<div class="xtl_right_col">
							<div class="xtl_table_title">
								<div class="xtl_table_title_ins">
									'. __('You receive','pn') .'
								</div>
							</div>
								<div class="clear"></div>											
						</div>
							<div class="clear"></div>				
				
					</div>';
					
					$temp .= apply_filters('exchange_table3_head',$exchange_table3_head);
		
					$temp .='
					<div class="xtl_html_wrap">
						<div class="xtl_html_abs js_loader"></div>
						
						<div id="js_html">

							'. get_xtl_temp($from, $to, 1) .'
						
						</div>
					</div>';		
					
				$temp .='	
				</div>
			</div>
			
		</div>
	</div>	
	';
	
	return $temp;
}

add_action('myaction_site_table3_change_select', 'def_myaction_ajax_table3_change_select');
function def_myaction_ajax_table3_change_select(){
global $wpdb, $premiumbox;	
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = '0'; 
	$log['status_text']= '';
	$log['html'] = '';	
	
	$premiumbox->up_mode();
	
	$type_table = get_type_table();
	if($type_table == 3){	
	
		$id = intval(is_param_post('id'));
		$id1 = intval(is_param_post('id1'));
		$id2 = intval(is_param_post('id2'));	

		$log['html'] = get_xtl_temp($id1, $id2, $id);
	}
	
	echo json_encode($log);
	exit;
}

function get_xtl_temp($from, $to, $id){
global $wpdb, $premiumbox;
	
	if($id != 2){ $id = 1; }
	
	$v = array();
	$valutsn = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency WHERE auto_status = '1' ORDER BY psys_title ASC");
	foreach($valutsn as $valut){
		$v[$valut->id] = $valut;
	}	
	
	$temp = '';
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);

	$valid1 = intval($from);
	$valid2 = intval($to);	

	$where = get_directions_where('home');
	
	$v1 = $v2 = $img1 = $img2 = '';
	$tablenot = intval($premiumbox->get_option('exchange','tablenot')); 
	$tableselect = intval($premiumbox->get_option('exchange','tableselect'));
	$directions1 = $directions2 = array();

	$direction = '';
	
	if($valid1 and $valid2){ /* если есть id, выбираем направление по фильтрам и по id */
		$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_give='$valid1' AND currency_id_get='$valid2' ORDER BY to3_1 ASC");
		foreach($direction_items as $dir){
			$output = apply_filters('get_direction_output', 1, $dir, 'home');
			if($output){
				$direction = $dir;
				break;
			}	
		}	
	} 	
	
	if(isset($direction->id)){ /* если есть направление обмена */

		$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
		foreach($direction_items as $dir){
			$output = apply_filters('get_direction_output', 1, $dir, 'home');
			if($output == 1){
				$directions1[$dir->currency_id_give] = $dir;
				if($dir->currency_id_give == $valid1 or $tableselect != 1){
					$directions2[$dir->currency_id_get] = $dir;
				}
			}
		}	
	
	} else { /* если нет направления обмена */
		if($tablenot == 1){ /* 0 - ошибка */	
			if($id == 1){ /* если выбрана левая сторона */
				
				$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_give='$valid1' ORDER BY to3_1 ASC");
				foreach($direction_items as $nap){
					$output = apply_filters('get_direction_output', 1, $nap, 'home');
					if($output){
						$direction = $nap;
						break;
					}	
				}					
				
				if(isset($direction->id)){
					
					$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
					$r=0; 
					foreach($directions as $nd){ 
						$output = apply_filters('get_direction_output', 1, $nd, 'home');
						if($output){
							$directions1[$nd->currency_id_give] = $nd;
							
							if($nd->currency_id_give == $valid1){ $r++;
								if($r==1){ $valid2 = $nd->currency_id_get;}
							}
							if($nd->currency_id_give == $valid1 or $tableselect != 1){
								$directions2[$nd->currency_id_get] = $nd;
							}
						}
					}	
					
				} else {

					$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_get='$valid2' ORDER BY to3_1 ASC");
					foreach($direction_items as $nap){
						$output = apply_filters('get_direction_output', 1, $nap, 'home');
						if($output){
							$direction = $nap;
							break;
						}	
					}				
					if(isset($direction->id)){
						
						$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
						$r=0;
						foreach($directions as $nd){ 
							$output = apply_filters('get_direction_output', 1, $nd, 'home');
							if($output){
								$directions2[$nd->currency_id_get] = $nd;
								
								if($nd->currency_id_get == $valid2){ $r++;
									if($r==1){ $valid1 = $nd->currency_id_give; }
								}
								if($nd->currency_id_get == $valid2 or $tableselect != 1){
									$directions1[$nd->currency_id_give] = $nd;
								}	
							}
						}						

					}	
				
				}
				
			} else { /* если выбрана правая сторона */
			
				$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_get='$valid2' ORDER BY to3_1 ASC");
				foreach($direction_items as $nap){
					$output = apply_filters('get_direction_output', 1, $nap, 'home');
					if($output){
						$direction = $nap;
						break;
					}	
				}			
			
				if(isset($direction->id)){
					
					$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
					$r=0;
					foreach($directions as $nd){ 
						$output = apply_filters('get_direction_output', 1, $nd, 'home');
						if($output){
							$directions2[$nd->currency_id_get] = $nd;
							
							if($nd->currency_id_get == $valid2){ $r++;
								if($r==1){ $valid1 = $nd->currency_id_give; }
							}
							if($nd->currency_id_get == $valid2 or $tableselect != 1){
								$directions1[$nd->currency_id_give] = $nd;
							}
						}
					}						
					
				} else {
					
					$direction_items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where AND currency_id_give='$valid1' ORDER BY to3_1 ASC");
					foreach($direction_items as $nap){
						$output = apply_filters('get_direction_output', 1, $nap, 'home');
						if($output){
							$direction = $nap;
							break;
						}	
					}					
					if(isset($direction->id)){
						
						$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
						$r=0;
						foreach($directions as $nd){ 
							$output = apply_filters('get_direction_output', 1, $nd, 'home');
							if($output){
								$directions1[$nd->currency_id_give] = $nd;
								 
								if($nd->currency_id_give == $valid1){ $r++;
									if($r==1){ $valid2 = $nd->currency_id_get; }
								}
								if($nd->currency_id_give == $valid1 or $tableselect != 1){
									$directions2[$nd->currency_id_get] = $nd;
								}
							}
						}						
						
					}					
					
				}
			}
		}
	}
	
	if(!isset($direction->id)){
		$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to3_1 ASC");
		foreach($directions as $nd){
			$output = apply_filters('get_direction_output', 1, $nd, 'home');
			if($output){
				$directions1[$nd->currency_id_give] = $nd;
				$directions2[$nd->currency_id_give] = $nd;
				$directions1[$nd->currency_id_get] = $nd;
				$directions2[$nd->currency_id_get] = $nd;
			}
		}
	}	
	
		$v1 = $valid1;
		$v2 = $valid2;
		
		if(!isset($v[$v1]) and !isset($v[$v2])){
			return '';
		}		
		
		$vd1 = $v[$v1];
		$vd2 = $v[$v2];
		
		$tableicon = get_icon_for_table();
		
		$img1 = get_currency_logo($vd1, $tableicon);
		$img2 = get_currency_logo($vd2, $tableicon); 		
	
		if(isset($direction->id)){			
			
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
							
			$v_title1 = $psys_give .' '. $currency_code_give;				
			$v_title2 = $psys_get .' '. $currency_code_get;

			$course_give = $cdata['course_give'];			
			$course_get = $cdata['course_get'];					
			
			$viv_com1 = 'style="display: none;"'; /* не выводим поле доп.комиссии */
			if($cdata['viv_com1'] == 1){
				$viv_com1 = '';
			}
			$viv_com2 = 'style="display: none;"'; /* не выводим поле доп.комиссии */
			if($cdata['viv_com2'] == 1){
				$viv_com2 = '';
			}				
			
			$sum1_error = $sum2_error = $sum1c_error = $sum2c_error = '';
			$sum1_error_text = $sum2_error_text = $sum1c_error_text = $sum2c_error_text = '';

			if($premiumbox->get_option('exchange','flysum') == 1){
					
				$sum1 = is_sum(is_isset($cdata,'sum1'));
				$sum1c = is_sum(is_isset($cdata,'sum1c'));
				$sum2 = is_sum(is_isset($cdata,'sum2'));
				$sum2c = is_sum(is_isset($cdata,'sum2c'));
					
				$min1 = get_min_sum_to_direction_give($direction, $vd1, $vd2);
				$max1 = get_max_sum_to_direction_give($direction, $vd1, $vd2);
				/* if($min1 > $max1 and is_numeric($max1)){ $min1 = $max1; } */

				$min2 = get_min_sum_to_direction_get($direction, $vd1, $vd2); 
				$max2 = get_max_sum_to_direction_get($direction, $vd1, $vd2);
				/* if($min2 > $max2 and is_numeric($max2)){ $min2 = $max2; } */							
										
				if($sum1 < $min1){
					$sum1_error = 'error';
					$sum1_error_text = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> '. $currency_code_give;													
				}
										
				if($sum1 > $max1 and is_numeric($max1)){
					$sum1_error = 'error';
					$sum1_error_text = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> '. $currency_code_give;													
				}
										
				if($sum2 < $min2){
					$sum2_error = 'error';
					$sum2_error_text = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> '. $currency_code_get;													
				}
										
				if($sum2 > $max2 and is_numeric($max2)){
					$sum2_error = 'error';
					$sum2_error_text = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> '. $currency_code_get;													
				}
			
			}
									
		}	
	
		$class_select_table3 = array(
			'js_my_sel' => 'js_my_sel'
		);
		$class_select_table3 = apply_filters('class_select_table3', $class_select_table3);
	
		$temp .= '
		<div class="xtl_table_body_wrap">
			<div class="xtl_left_col">
									
				<div class="xtl_ico_wrap">
					<div class="xtl_ico" style="background: url('. $img1 .') no-repeat center center;"></div>
				</div>
										
				<div class="xtl_select_wrap">
					<select name="" id="js_left_sel" class="'. join(' ', $class_select_table3) .'" autocomplete="off">';
						foreach($directions1 as $key => $np){
							$temp .= '<option value="'. $key .'" '. selected($key,$v1,false) .' data-img="'. get_currency_logo($v[$key], $tableicon) .'">'. get_currency_title($v[$key]) .'</option>';		
						}
					$temp .= '	
					</select>						
				</div>													
			
			</div>
			<div class="xtl_center_col">
				<a href="#" class="xtl_change" id="js_reload_table"></a>
			</div>
			<div class="xtl_right_col">

				<div class="xtl_ico_wrap">
					<div class="xtl_ico" style="background: url('. $img2 .') no-repeat center center;"></div>
				</div>

				<div class="xtl_select_wrap">
					<select name="" id="js_right_sel" class="'. join(' ', $class_select_table3) .'" autocomplete="off">';
						foreach($directions2 as $key => $np){
							$temp .= '<option value="'. $key .'" '. selected($key,$v2,false) .' data-img="'. get_currency_logo($v[$key], $tableicon) .'">'. get_currency_title($v[$key]) .'</option>';					
						}
					$temp .= '		
					</select>						
				</div>
	
			</div>
				<div class="clear"></div>	
		</div>';			
			
		if(isset($direction->id)){
			
			$temp .= '
			<div class="xtl_table_body">				
				<div class="xtl_left_col">';

						$temp .= '
						<div class="xtl_input_wrap js_wrap_error js_wrap_error_br '. $sum1_error .'">';
						
							$temp .= apply_filters('exchange_input', '', 'give', $cdata, $calc_data);
						
							$temp .= '
							<div class="js_error js_sum1_error">'. $sum1_error_text .'</div>
						</div>';						
						
						$temp .= '
						<div class="xtl_commis_wrap js_wrap_error js_wrap_error_br '. $sum1c_error .'" '. $viv_com1 .'>';

							$temp .= apply_filters('exchange_input', '', 'give_com', $cdata, $calc_data);
						
							$temp .= '
							<div class="xtl_commis_text">'. __('With fees','pn') .'</div>
								<div class="js_error js_sum1c_error">'. $sum1c_error_text .'</div>				
							<div class="clear"></div>
						</div>';
				
						$tbl3_leftcol_data = array();
						$tbl3_leftcol_data = apply_filters('tbl3_leftcol_data', $tbl3_leftcol_data, $cdata, $vd1, $vd2, $direction, $user_id, $post_sum);			
				
						foreach($tbl3_leftcol_data as $value){
							$temp .= $value; 
						}			
				
				$temp .= '
				</div>
				<div class="xtl_center_col">
				</div>
				<div class="xtl_right_col">';

						$temp .= '
						<div class="xtl_input_wrap js_wrap_error js_wrap_error_br '. $sum2_error .'">';
						
							$temp .= apply_filters('exchange_input', '', 'get', $cdata, $calc_data);
						
							$temp .= '
							<div class="js_error js_sum2_error">'. $sum2_error_text .'</div>	
						</div>';
						
						$temp .= '
						<div class="xtl_commis_wrap js_wrap_error js_wrap_error_br '. $sum2c_error .'" '. $viv_com2 .'>';

							$temp .= apply_filters('exchange_input', '', 'get_com', $cdata, $calc_data);
						
							$temp .= '
							<div class="xtl_commis_text">'. __('With fees','pn') .'</div>
								<div class="js_error js_summ2c_error">'. $sum2c_error_text .'</div>				
								<div class="clear"></div>
						</div>';					

						$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv, $vd2->currency_decimal, $direction), $vd2->currency_decimal, 'reserv');
					
						$tbl3_rightcol_data = array(
							'rate' => '
							<div class="xtl_line xtl_exchange_rate">
								'. __('Exchange rate','pn') .': <span class="js_curs_html">'. apply_filters('show_table_course', $course_give, $cdata['decimal_give']) .' '. $currency_code_give .' = '. apply_filters('show_table_course', $course_get, $cdata['decimal_get']) .' '. $currency_code_get .'</span>
							</div>						
							',
							'zreserv' => '
							<div class="xtl_line xtl_exchange_reserve">
								'. __('Reserve','pn') .': <span class="js_reserv_html">'. $reserv .' '. $cdata['currency_code_get'] .'</span>
							</div>						
							',
						);
						$tbl3_rightcol_data = apply_filters('tbl3_rightcol_data', $tbl3_rightcol_data, $cdata, $vd1, $vd2, $direction, $user_id, $post_sum);			
				
						foreach($tbl3_rightcol_data as $value){
							$temp .= $value; 
						}					
					
				$temp .= '			
				</div>
					<div class="clear"></div>	
			</div>';		
			
			$link_class = '';
			
		} else {
			
			$link_class = 'active';
			$temp .= '<div class="xtl_error"><div class="xtl_error_ins">'. __('Selected direction does not exist','pn') .'</div></div>';

		}
		
		$direction_id = intval(is_isset($direction,'id'));
	
		$temp .='	
		<input type="hidden" name="" class="js_direction_id" value="'. $direction_id .'" />
		<div class="xtl_submit_wrap">
			<div class="xtl_submit_ins">
				<a href="'. get_exchange_link(is_isset($direction, 'direction_name')) .'" class="xtl_submit js_exchange_link '. $link_class .'" id="js_submit_button" data-direction-id="'. $direction_id .'">'. __('Exchange','pn') .'</a>
					<div class="clear"></div>
			</div>	
		</div>';	
	
	return $temp;	
}