<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('siteplace_js','siteplace_js_tarifs');
function siteplace_js_tarifs(){	
?>	
/* tarifs */
jQuery(function($){ 
	$('.javahref').on('click', function(){
	    var the_link = $(this).attr('name');
	    window.location = the_link;
	});
});		
/* end tarifs */
<?php	
} 

function tarifs_shortcode($atts, $content) {
global $wpdb, $post;
        
	$temp = '';
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
		
	$temp .= apply_filters('before_tarifs_page','');		
		
	$show_data = pn_exchanges_output('tar'); 
	if($show_data['text']){
		$temp .= '<div class="resultfalse"><div class="resultclose"></div>'. $show_data['text'] .'</div>';
	}			
	
	if($show_data['mode'] == 1){
		
		$v = get_currency_data();

		$sort_tarifs_method = apply_filters('sort_tarifs_method', 0);
		$sort_tarifs_method = intval($sort_tarifs_method);
		
		$where = get_directions_where('tar');
		
		if($sort_tarifs_method == 0){
		
			$directions_lists = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE $where ORDER BY site_order1 ASC");
			$directions = $directions2 = array();
			foreach($directions_lists as $direction){
				$output = apply_filters('get_direction_output', 1, $direction, 'tar');
				if($output){
					$directions[$direction->currency_id_give] = $direction;
					$directions2[$direction->currency_id_give][] = $direction;
				}
			}
			
		} elseif($sort_tarifs_method == 1){
			$directions = array();
			$directions_arr = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions.id AS direction_id FROM ".$wpdb->prefix."directions WHERE $where ORDER BY to1 ASC");
			foreach($directions_arr as $direction){
				$output = apply_filters('get_direction_output', 1, $direction, 'tar');
				if($output == 1){
					$directions[$direction->currency_id_give] = $direction;
				}
			}			
			
			$directions2_arr = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions_order.id AS item_id FROM ".$wpdb->prefix."directions LEFT OUTER JOIN ".$wpdb->prefix."directions_order ON(".$wpdb->prefix."directions.id = ".$wpdb->prefix."directions_order.direction_id AND ".$wpdb->prefix."directions.currency_id_give = ".$wpdb->prefix."directions_order.c_id) WHERE $where ORDER BY ".$wpdb->prefix."directions_order.order1 ASC");
			$directions2 = array();
			foreach($directions2_arr as $direction){
				$output = apply_filters('get_direction_output', 1, $direction, 'tar');
				if($output == 1){
					$directions2[$direction->currency_id_give][] = $direction;
				}
			}	
		}
		
		$temp .='
		<div class="tarif_div">
			<div class="tarif_div_ins">
		';	
		
			foreach($directions as $data){
				$currency_id = $data->currency_id_give;
				if(isset($v[$currency_id])){	
					$vd = $v[$currency_id];
					
					$tarif_title = get_currency_title($vd);
					$tarif_logo = get_currency_logo($vd);
					
					$temp .= '
					<div class="tarif_block">
						<div class="tarif_block_ins">';
					
						$one_tarifs_title = '
						<div class="tarif_title">
							<div class="tarif_title_ins">
								<div class="tarif_title_abs"></div>
								'. $tarif_title .'
							</div>
								<div class="clear"></div>
						</div>
							<div class="clear"></div>';
						$temp .= apply_filters('one_tarifs_title', $one_tarifs_title, $tarif_title, $tarif_logo, $vd);

						$before_one_tarifs_block = '
						<table class="tarif_table">
							<tr>
								<th colspan="2" class="tarif_table_out">'. __('You send','pn') .'</th>
								<th class="tarif_table_arr"></th>
								<th colspan="2" class="tarif_table_in">'. __('You receive','pn') .'</th>
								<th class="tarif_table_reserv">'. __('Reserve','pn') .'</th>
							</tr>							
						';
						$temp .= apply_filters('before_one_tarifs_block',$before_one_tarifs_block, $tarif_title, $vd);

						if(is_array($directions2[$currency_id])){
							$tarifs = $directions2[$currency_id];
							foreach($tarifs as $tar){
								
								$valsid1 = $tar->currency_id_give;
								$valsid2 = $tar->currency_id_get;
								
								if(isset($v[$valsid1]) and isset($v[$valsid2])){
								
									$vd1 = $v[$valsid1];
									$vd2 = $v[$valsid2];
								
									$course_give = is_course_give($tar->course_give, 'tar', $tar, $vd1, $vd2);
									$course_get = is_course_get($tar->course_get, 'tar', $tar, $vd1, $vd2);
									
									$course_give = is_out_sum($course_give, $vd1->currency_decimal, 'course');
									$course_get = is_out_sum($course_get, $vd2->currency_decimal, 'course');
								
									$reserv = is_out_sum(get_direction_reserv($vd2->currency_reserv , $vd2->currency_decimal, $tar), $vd2->currency_decimal, 'reserv');
								
									$one_tarifs_line = '
									<tr class="javahref" name="'. get_exchange_link($tar->direction_name) .'">
										<td class="tarif_curs_out"><div class="tarif_curs_out_ins">'. $course_give .'&nbsp;'. is_site_value($vd1->currency_code_title) .'</div></td>
										<td class="tarif_curs_title_out">
											<div class="tarif_curs_title_out_ins">
												'. get_currency_title($vd1) .'
											</div>
										</td>
										<td class="tarif_curs_arr">
											<div class="tarif_curs_arr_ins"></div>
										</td>
										<td class="tarif_curs_in"><div class="tarif_curs_in_ins">'. $course_get .'&nbsp;'. is_site_value($vd2->currency_code_title) .'</div></td>
										<td class="tarif_curs_title_in">
											<div class="tarif_curs_title_in_ins">
												'. get_currency_title($vd2) .'
											</div>
										</td>	
										<td class="tarif_curs_reserv">
											<div class="tarif_curs_reserv_ins">'. $reserv .'</div>
										</td>
									</tr>
									';
						    
									$temp .= apply_filters('one_tarifs_line',$one_tarifs_line, $tar, $course_give, $course_get, $reserv, $vd1, $vd2);
							
								}
							}
						}

						$after_one_tarifs_block = '
						</table>';
						$temp .= apply_filters('after_one_tarifs_block',$after_one_tarifs_block, $tarif_title, $vd);
					
					$temp .= '
						</div>
					</div>
					';					
					
				}
			}		
	
		$temp .='
			</div>
		</div>';	
		 
	} 
	
	$temp .= apply_filters('after_tarifs_page','');
	return $temp;
}
add_shortcode('tarifs', 'tarifs_shortcode');