<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('siteplace_js','siteplace_js_exchange_table1');
function siteplace_js_exchange_table1(){
	if(get_type_table() == 1){
		$ajax = get_ajax_table();
?>	
jQuery(function($){
	
function go_visible_icon_start(){

	$('.js_icon_left').hide();
	$('.js_icon_left:first').show();
	
	$('.js_item_left').each(function(){
		var vtype = $(this).attr('data-type');
		$('.js_icon_left_' + vtype).show();
	});

	$('.js_icon_right').hide();
	$('.js_icon_right:first').show();
	
	<?php if($ajax == 0){ ?>
	$('.js_line_tab.active .js_item_right').each(function(){
	<?php } else { ?>
	$('.js_item_right').each(function(){
	<?php } ?>
		var vtype = $(this).attr('data-type');
		$('.js_icon_right_' + vtype).show();
	});	
	
	if($('.js_icon_right.active:visible').length == 0){
		$('.js_item_right').show();
		$('.js_icon_right').removeClass('active');
		$('.js_icon_right:first').addClass('active');
	}
	
}

function go_active_left_col(){
	
	if($('.js_item_left:visible.active').length == 0){
		$('.js_item_left').removeClass('active');
		$('.js_item_left:visible:first').addClass('active');
	} 	
	
	var valid = $('.js_item_left.active').attr('data-id');
	
	<?php if($ajax == 0){ ?>
	$('.js_line_tab').removeClass('active');
	$('#js_tabnaps_'+valid).addClass('active');
	go_visible_icon_start();
	<?php } else { ?>
	$('.xtt_html_abs').show();
	var param ='id=' + valid;
    $.ajax({
        type: "POST",
        url: "<?php echo get_ajax_link('table1_change');?>",
        dataType: 'json',
		data: param,
 		error: function(res, res2, res3){
			<?php do_action('pn_js_error_response', 'ajax'); ?>
		},       
		success: function(res)
        {
			$('.xtt_html_abs').hide();
			if(res['status'] == 'success'){
				$('#xtt_right_col_html').html(res['html']);
			} 	
			go_visible_icon_start();
        }
    });	
	<?php } ?>
}

	go_active_left_col();
 
    $(document).on('click',".js_item_left",function () {
        if(!$(this).hasClass('active')){
			
			$(".js_item_left").removeClass('active');
			$(this).addClass('active');

			go_active_left_col();
        }
        return false;
    });	
	
    $(document).on('click',".js_icon_left",function () {
        if(!$(this).hasClass('active')){
		    
			var vtype = $(this).attr('data-type');
			$(".js_icon_left").removeClass('active');
			$(this).addClass('active');
	
			if(vtype == 0){
				$('.js_item_left').show();
			} else {
				$('.js_item_left').hide();
				$('.js_item_left_'+vtype).show();
			}
			
			go_active_left_col();
			
        }
        return false;
    });
	
    $(document).on('click',".js_icon_right",function () {
        if(!$(this).hasClass('active')){
		    
			var vtype = $(this).attr('data-type');
			$(".js_icon_right").removeClass('active');
			$(this).addClass('active');
	
			if(vtype == 0){
				$('.js_item_right').show();
			} else {
				$('.js_item_right').hide();
				$('.js_item_right_'+vtype).show();
			}
			
        }
        return false;
    });

});			
<?php	
	}
}	

add_filter('exchange_table_type1','get_exchange_table1', 10, 3);
function get_exchange_table1($temp, $def_cur_from='', $def_cur_to=''){
global $wpdb, $premiumbox;	

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
	
	$all_currency_codes = array(); /* собираем все возможные типы валют */
	
	$currencies = array();
	$currencies_arr = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency WHERE auto_status = '1' ORDER BY psys_title ASC");
	foreach($currencies_arr as $currency){
		$currencies[$currency->id] = $currency;
		$all_currency_codes[] = is_site_value($currency->currency_code_title);
	}	
	$all_currency_codes = array_unique($all_currency_codes);	

	$where = get_directions_where('home');
	$directions = array();
	$directions_arr = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions.id AS direction_id FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to1 ASC");
	foreach($directions_arr as $direction){
		$output = apply_filters('get_direction_output', 1, $direction, 'home');
		if($output == 1){
			$directions[$direction->currency_id_give] = $direction;
		}
	}

	$ajax = get_ajax_table();
	if($ajax == 0){
	
		$directions2_arr = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions_order.id AS item_id FROM ".$wpdb->prefix."directions LEFT OUTER JOIN ".$wpdb->prefix."directions_order ON(".$wpdb->prefix."directions.id = ".$wpdb->prefix."directions_order.direction_id AND ".$wpdb->prefix."directions.currency_id_give = ".$wpdb->prefix."directions_order.c_id) WHERE $where ORDER BY ".$wpdb->prefix."directions_order.order1 ASC");
		$directions2 = array();
		foreach($directions2_arr as $direction){
			$output = apply_filters('get_direction_output', 1, $direction, 'home');
			if($output == 1){
				$directions2[$direction->currency_id_give][] = $direction;
			}
		}	
	
	}
	
	$tableicon = get_icon_for_table();
	
	$temp .= '
	<div class="xchange_type_table">
		<div class="xchange_type_table_ins">';
							
			$exchange_table1_head = '';				
			$hidecurrtype = get_hidecurrtype_table();		
			if($hidecurrtype == 0){		
					
				$exchange_table1_head = '	
				<div class="xtt_icon_wrap">
					<div class="xtt_left_col_icon">
					
						<div class="xtt_icon active js_icon_left" data-type="0"><div class="xtt_icon_ins"><div class="xtt_icon_abs"></div>'. __('All','pn') .'</div></div>
						';
					
							foreach($all_currency_codes as $av){
								$exchange_table1_head .= '<div class="xtt_icon js_icon_left js_icon_left_'. $av .'" style="display: none;" data-type="'. $av .'"><div class="xtt_icon_ins"><div class="xtt_icon_abs"></div>'. $av .'</div></div>';
							}
					
					$exchange_table1_head .= '
						<div class="clear"></div>
					</div>
					<div class="xtt_right_col_icon">

						<div class="xtt_icon active js_icon_right" data-type="0"><div class="xtt_icon_ins"><div class="xtt_icon_abs"></div>'. __('All','pn') .'</div></div>
						';
								
							foreach($all_currency_codes as $av){
								$exchange_table1_head .= '<div class="xtt_icon js_icon_right js_icon_right_'. $av .'" style="display: none;" data-type="'. $av .'"><div class="xtt_icon_ins"><div class="xtt_icon_abs"></div>'. $av .'</div></div>';
							}							
								
					$exchange_table1_head .= '
						<div class="clear"></div>
					</div>
						<div class="clear"></div>
				</div>';	
				
			}		
			$temp .= apply_filters('exchange_table1_head', $exchange_table1_head, $all_currency_codes);

			$temp .= '
			<div class="xtt_table_wrap">';
					
				$exchange_table1_headname = '
				<div class="xtt_table_title_wrap">
					<div class="xtt_left_col_title">
						<div class="xtt_table_title1">
							<span>'. __('You send','pn') .'</span>
						</div>
					</div>
					<div class="xtt_right_col_title">
						<div class="xtt_table_title2">
							<span>'. __('You receive','pn') .'</span>
						</div>
						<div class="xtt_table_title3">
							<span>'. __('Reserve','pn') .'</span>
						</div>
							<div class="clear"></div>
					</div>
						<div class="clear"></div>
				</div>';
				$temp .= apply_filters('exchange_table1_headname',$exchange_table1_headname);
					
				$temp .= '
				<div class="xtt_table_body_wrap">
					<div class="xtt_html_abs"></div>';
						
						$temp .= '
						<div class="xtt_left_col_table">';
							$temp .= apply_filters('exchange_table1_leftcol', '');
									
							if(is_array($directions)){		
								foreach($directions as $direction_data){ 
										
									$valsid1 = $direction_data->currency_id_give;
									if(isset($currencies[$valsid1])){
										$vd1 = $currencies[$valsid1];
										
										$cl = '';
										if($cur_from){
											if($cur_from == $vd1->xml_value){
												$cl = 'active';
											}
										}
										
										$course_give = is_course_give($direction_data->course_give, 'table1', $direction_data, $vd1, '');
										
										$currency_code_give = is_site_value($vd1->currency_code_title);
											
										$temp .= '
										<!-- one item -->
										<div class="js_item_left js_item_left_'. $currency_code_give .'  '. $cl .'" data-id="'. $valsid1 .'" data-type="'. $currency_code_give .'">
											<div class="xtt_one_line_left">
										';
											
											$tbl1_leftcol_data = array(
												'line_abs1' => '<div class="xtt_one_line_abs"></div>',
												'line_abs2' => '<div class="xtt_one_line_abs2"></div>',
												'icon' => '
												<div class="xtt_one_line_ico_left"> 
													<div class="xtt_change_ico" style="background: url('. get_currency_logo($vd1, $tableicon) .') no-repeat center center;"></div>
												</div>',
												'title' => '
												<div class="xtt_one_line_name_left">
													<div class="xtt_one_line_name">
														'. get_currency_title($vd1) .'
													</div>
												</div>
												',
												'course' => '
												<div class="xtt_one_line_curs_left">
													<div class="xtt_one_line_curs">
														'. is_out_sum($course_give, $vd1->currency_decimal, 'course') .'
													</div>	
												</div>												
												',
											);
											$tbl1_leftcol_data = apply_filters('tbl1_leftcol_data',$tbl1_leftcol_data, $direction_data, $vd1, '', $course_give, $cur_from);
											
											foreach($tbl1_leftcol_data as $value){
												$temp .= $value; 
											}

										$temp .= '
												<div class="clear"></div>
											</div>	
										</div>
										<!-- end one item -->
										';
										
									}	
								}
							}
									
							$temp .= '
						</div>		
						<div class="xtt_right_col_table">
						';	
							$temp .= apply_filters('exchange_table1_rightcol', '');	
								
							if($ajax == 0){	
								
								if(is_array($directions)){	
									foreach($directions as $direction_data){
										
										$valsid1 = $direction_data->currency_id_give;
										if(isset($currencies[$valsid1])){
											$vd1 = is_isset($currencies,$valsid1);
											
											$temp .= '
											<!-- tab currency -->
											<div class="xtt_line_tab js_line_tab" id="js_tabnaps_'. $valsid1 .'">';										
												
											if(isset($directions2[$valsid1])){
												$directions_otd = $directions2[$valsid1];
												foreach($directions_otd as $direction_data2){
														
													$valsid2 = $direction_data2->currency_id_get;
													if(isset($currencies[$valsid2])){
														
														$vd2 = is_isset($currencies,$valsid2);
															
														$v_title1 = get_currency_title($vd1);		
														$v_title2 = get_currency_title($vd2);
														 
														$course_get = is_course_get($direction_data2->course_get, 'table1', $direction_data2, $vd1, $vd2);
															
														$temp .= '
														<!-- one item -->
														<a href="'. get_exchange_link($direction_data2->direction_name) .'" class="js_exchange_link js_item_right js_item_right_'. is_site_value($vd2->currency_code_title) .'" data-type="'. is_site_value($vd2->currency_code_title) .'" data-direction-id="'. $direction_data2->direction_id .'">
															<div class="xtt_one_line_right">
														';	 
															
															$tbl1_rightcol_data = array(
																'line_abs1' => '<div class="xtt_one_line_abs"></div>',
																'line_abs2' => '<div class="xtt_one_line_abs2"></div>',
																'icon' => '
																<div class="xtt_one_line_ico_right"> 
																	<div class="xtt_change_ico" style="background: url('. get_currency_logo($vd2, $tableicon) .') no-repeat center center;"></div>
																</div>															
																',
																'title' =>'
																<div class="xtt_one_line_name_right">
																	<div class="xtt_one_line_name">
																		'. $v_title2 .'
																	</div>
																</div>														
																',
																'course' => '
																<div class="xtt_one_line_curs_right">
																	<div class="xtt_one_line_curs">
																		'. is_out_sum($course_get, $vd2->currency_decimal, 'course') .'
																	</div>	
																</div>															
																',
																'reserve' => '
																<div class="xtt_one_line_reserv_right">
																	<div class="xtt_one_line_reserv">
																		'. is_out_sum(get_direction_reserv($vd2->currency_reserv , $vd2->currency_decimal, $direction_data2), $vd2->currency_decimal, 'reserv').'
																	</div>	
																</div>															
																',
															);	
															$tbl1_rightcol_data = apply_filters('tbl1_rightcol_data',$tbl1_rightcol_data, $direction_data2, $vd1, $vd2, $course_get, $cur_to);
															
															foreach($tbl1_rightcol_data as $value){
																$temp .= $value; 
															}		
																	
														$temp .= '		
																<div class="clear"></div>
															</div>	
														</a>
														<!-- end one item -->											
														';
														
													}	
												}
											}
												
											$temp .= '
											</div>
											<!-- end tab currency -->										
											';
									
										}		
									}
								}	

							} else {
								$temp .= '
								<div id="xtt_right_col_html"></div>
								';
							}

						$temp .= '
						</div>';
						
					$temp .= '	
						<div class="clear"></div>
					</div>';
					
			$temp .= '	
				<div class="clear"></div>
			</div>';
				
	$temp .='		
		</div>
	</div>';	
	
	return $temp;
}

add_action('myaction_site_table1_change', 'def_myaction_ajax_table1_change');
function def_myaction_ajax_table1_change(){
global $wpdb, $premiumbox;	
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = '0'; 
	$log['status_text']= '';
	
	$premiumbox->up_mode();
	
	if(get_type_table() == 1 and get_ajax_table() == 1){	
	
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		
		$id = intval(is_param_post('id'));
		if($id > 0){
			
			$currencies = array();
			$currencies_arr = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency WHERE auto_status = '1' ORDER BY psys_title ASC");
			foreach($currencies_arr as $currency){
				$currencies[$currency->id] = $currency;
			}				
			
			$tableicon = get_icon_for_table();
			$where = get_directions_where('home');
			$html = '';	
			$directions = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions_order.id AS item_id FROM ".$wpdb->prefix."directions LEFT OUTER JOIN ".$wpdb->prefix."directions_order ON(".$wpdb->prefix."directions.id = ".$wpdb->prefix."directions_order.direction_id AND ".$wpdb->prefix."directions.currency_id_give = ".$wpdb->prefix."directions_order.c_id) WHERE $where AND ".$wpdb->prefix."directions.currency_id_give = '$id' ORDER BY ".$wpdb->prefix."directions_order.order1 ASC");
			foreach($directions as $direction_data2){
				$output = apply_filters('get_direction_output', 1, $direction_data2, 'home');
				if($output == 1){
					$valsid1 = $direction_data2->currency_id_give;
					$valsid2 = $direction_data2->currency_id_get;
					if(isset($currencies[$valsid1]) and isset($currencies[$valsid2])){					
						$vd1 = is_isset($currencies,$valsid1);
						$vd2 = is_isset($currencies,$valsid2);
															
						$v_title1 = get_currency_title($vd1);		
						$v_title2 = get_currency_title($vd2);
														
						$course_get = is_course_get($direction_data2->course_get, 'table1' , $direction_data2, $vd1, $vd2);
						
						$html .= '
						<!-- one item -->
						<a href="'. get_exchange_link($direction_data2->direction_name) .'" class="js_exchange_link js_item_right js_item_right_'. is_site_value($vd2->currency_code_title) .'" data-type="'. is_site_value($vd2->currency_code_title) .'" data-direction-id="'. $direction_data2->direction_id .'">
							<div class="xtt_one_line_right">
						';	 
							
							$tbl1_rightcol_data = array(
								'line_abs1' => '<div class="xtt_one_line_abs"></div>',
								'line_abs2' => '<div class="xtt_one_line_abs2"></div>',
								'icon' => '
								<div class="xtt_one_line_ico_right"> 
									<div class="xtt_change_ico" style="background: url('. get_currency_logo($vd2, $tableicon) .') no-repeat center center;"></div>
								</div>															
								',
								'title' =>'
								<div class="xtt_one_line_name_right">
									<div class="xtt_one_line_name">
										'. $v_title2 .'
									</div>
								</div>														
								',
								'course' => '
								<div class="xtt_one_line_curs_right">
									<div class="xtt_one_line_curs">
										'. is_out_sum($course_get, $vd2->currency_decimal, 'course') .'
									</div>	
								</div>															
								',
								'reserve' => '
								<div class="xtt_one_line_reserv_right">
									<div class="xtt_one_line_reserv">
										'. is_out_sum(get_direction_reserv($vd2->currency_reserv , $vd2->currency_decimal, $direction_data2), $vd2->currency_decimal, 'reserv').'
									</div>	
								</div>															
								',
							);	
							$tbl1_rightcol_data = apply_filters('tbl1_rightcol_data',$tbl1_rightcol_data, $direction_data2, $vd1, $vd2, $course_get, '');
							
							foreach($tbl1_rightcol_data as $value){
								$html .= $value; 
							}						
																	
						$html .= '
								<div class="clear"></div>
							</div>	
						</a>
						<!-- end one item -->											
						';							
					}			
				}			
			}							

			$log['status'] = 'success';
			$log['html'] = $html;			
		}
	}
	
	echo json_encode($log);
	exit;
}