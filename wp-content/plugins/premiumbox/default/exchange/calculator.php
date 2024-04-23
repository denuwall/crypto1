<?php
if( !defined( 'ABSPATH')){ exit(); }
	
add_action('myaction_site_exchange_changes', 'def_myaction_ajax_exchange_changes');
function def_myaction_ajax_exchange_changes(){ 
global $wpdb, $premiumbox;	
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');		

	$premiumbox->up_mode();
	
	$comis_text1 = '';
	$comis_text2 = '';
	$error_fields = array();
	$sum1 = 0;
	$sum1c = 0;
	$sum2 = 0;
	$sum2c = 0;
	$viv_com1 = $viv_com2 = 0;
	$user_discount = '0';
	$curs_html = '';
	$reserv_html = '';
	$cdata = '';
	$calc_data = '';
	
	$direction_id = intval(is_param_post('id'));
	$sum = is_sum(is_param_post('sum'));
	$dej = intval(is_param_post('dej'));
	$show_data = pn_exchanges_output('exchange');
	
	if($show_data['mode'] == 1){
		if($dej > 0 or $dej < 5){ 
			$where = get_directions_where('exchange');
			$direction = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "directions WHERE $where AND id='$direction_id'");
			if(isset($direction->id)){
				$output = apply_filters('get_direction_output', 1, $direction, 'exchange');
				if($output){
					$currency_id_give = $direction->currency_id_give;
					$currency_id_get = $direction->currency_id_get;
					$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_give'");
					$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_get'");
					if(isset($vd1->id) and isset($vd2->id)){
						if($sum > 0){
							
							$calc_data = array(
								'vd1' => $vd1,
								'vd2' => $vd2,
								'direction' => $direction,
								'user_id' => $user_id,
								'ui' => $ui,
								'post_sum' => $sum,
								'dej' => $dej,
								'check1' => intval(is_param_post('check1')),
								'check2' => intval(is_param_post('check2')),
							);
							$calc_data = apply_filters('get_calc_data_params', $calc_data, 'calculator');							
							$cdata = get_calc_data($calc_data);
							$course_give = $cdata['course_give'];
							$course_get = $cdata['course_get'];
							$decimal_give = $cdata['decimal_give'];
							$decimal_get = $cdata['decimal_get'];
							$currency_code_give = $cdata['currency_code_give'];
							$currency_code_get = $cdata['currency_code_get'];
							$sum1 = $cdata['sum1'];
							$sum1c = $cdata['sum1c'];
							$sum2 = $cdata['sum2'];
							$sum2c = $cdata['sum2c'];
							$comis_text1 = $cdata['comis_text1'];
							$comis_text2 = $cdata['comis_text2'];
							$user_discount = $cdata['user_discount'].' ';
							$viv_com1 = $cdata['viv_com1'];
							$viv_com2 = $cdata['viv_com2'];
											
							if($premiumbox->get_option('exchange','flysum') == 1){
								
								$min1 = get_min_sum_to_direction_give($direction, $vd1, $vd2);
								$max1 = get_max_sum_to_direction_give($direction, $vd1, $vd2);
								/* if($min1 > $max1 and is_numeric($max1)){ $min1 = $max1; } */

								$min2 = get_min_sum_to_direction_get($direction, $vd1, $vd2); 
								$max2 = get_max_sum_to_direction_get($direction, $vd1, $vd2);
								/* if($min2 > $max2 and is_numeric($max2)){ $min2 = $max2; } */							

								if($sum1 < $min1){
									$error_fields['sum1'] = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> ';														
								}
									
								if($sum1 > $max1 and is_numeric($max1)){
									$error_fields['sum1'] = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> ';													
								}
									
								if($sum2 < $min2){
									$error_fields['sum2'] = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> ';														
								}
									
								if($sum2 > $max2 and is_numeric($max2)){
									$error_fields['sum2'] = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> ';													
								}								
								
							}

							$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv, $vd2->currency_decimal, $direction), $vd2->currency_decimal, 'reserv');
							$reserv_html = $reserv .' ';
						
							$curs_html = apply_filters('show_table_course',$course_give, $decimal_give).' = '. apply_filters('show_table_course', $course_get, $decimal_get);									
						}
						
						if($sum1 <= 0){
							$error_fields['sum1'] = __('amount must be greater than 0','pn');
						}							
						if($sum2 <= 0){
							$error_fields['sum2'] = __('amount must be greater than 0','pn');
						}						
						if($sum1c <= 0){
							$error_fields['sum1c'] = __('amount must be greater than 0','pn');
						}							
						if($sum2c <= 0){
							$error_fields['sum2c'] = __('amount must be greater than 0','pn');
						}					
						
					}
				}
			}
		}
	}
	
	$log['sum1'] = $sum1;
	$log['sum2'] = $sum2;
	$log['sum1c'] = $sum1c;
	$log['sum2c'] = $sum2c;
	$log['viv_com1'] = $viv_com1;
	$log['viv_com2'] = $viv_com2;	
	$log['user_discount'] = $user_discount;
	$log['curs_html'] = $curs_html;
	$log['reserv_html'] = $reserv_html;
	$log['comis_text1'] = $comis_text1;
	$log['comis_text2'] = $comis_text2;
	$log['error_fields'] = $error_fields;
	$log = apply_filters('log_exchange_changes', $log, $cdata, $calc_data);
	
	echo json_encode($log);
	exit;
}