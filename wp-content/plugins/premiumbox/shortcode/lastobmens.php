<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_quicktags_page','pn_adminpage_quicktags_lchanges');
function pn_adminpage_quicktags_lchanges(){
?>
edButtons[edButtons.length] = 
new edButton('premium_lchanges_form', '<?php _e('Last exchanges','pn'); ?>','[lchanges count="" logo_num="1"]');
<?php	
}

function get_lchange_line($bid, $vd1, $vd2, $place, $logo_num){

	$date_format = get_option('date_format');
	$time_format = get_option('time_format');

	$array = array( 
		'[id]' => $bid->id, 
		'[date]' => get_mytime($bid->create_date, "{$date_format}, {$time_format}"),
		'[editdate]' => get_mytime($bid->edit_date, "{$date_format}, {$time_format}"),
		'[logo1]' => get_currency_logo($vd1, $logo_num),
		'[sum1]' => is_out_sum(is_sum($bid->sum1dc, $vd1->currency_decimal), $vd1->currency_decimal, 'all'),
		'[vtype1]' => is_site_value($vd1->currency_code_title),
		'[logo2]' => get_currency_logo($vd2, $logo_num),
		'[sum2]' => is_out_sum(is_sum($bid->sum2c, $vd2->currency_decimal), $vd2->currency_decimal, 'all'),
		'[vtype2]' => is_site_value($vd2->currency_code_title),
		'[ps1]' => pn_strip_input(ctv_ml($vd1->psys_title)),
		'[ps2]' => pn_strip_input(ctv_ml($vd2->psys_title)),
		'[place]' => $place,
	);
	$array = apply_filters('get_lchange_line_data', $array, $bid, $vd1, $vd2, $place, $logo_num);
	
	$line = '
	<div class="[place]_lchange_line lchangeid_[id]">
		<div class="[place]_lchange_date">[date]</div>
			<div class="clear"></div>
								
		<div class="[place]_lchange_body">
							
			<div class="[place]_lchange_why"> 
				<div class="[place]_lchange_ico" style="background: url([logo1]) no-repeat center center;"></div>
				<div class="[place]_lchange_txt">
					<div class="[place]_lchange_sum">[sum1]</div>
					<div class="[place]_lchange_name">[vtype1]</div>
				</div>
					<div class="clear"></div>
			</div>
							
			<div class="[place]_lchange_arr"></div>
							
			<div class="[place]_lchange_why">
				<div class="[place]_lchange_ico" style="background: url([logo2]) no-repeat center center;"></div>
				<div class="[place]_lchange_txt">
					<div class="[place]_lchange_sum">[sum2]</div>
					<div class="[place]_lchange_name">[vtype2]</div>
				</div>
			</div>				
				<div class="clear"></div>
		</div>
	</div>	
	';					
						
	$line = apply_filters('lchange_'. $place .'_line', $line);
	$line = get_replace_arrays($array, $line);						
						
	return $line;					
}

function lchanges_shortcode($atts, $content) {
global $wpdb, $premiumbox;

	$html = '';				

	$count = intval(is_isset($atts,'count'));
	if($count < 1){ $count = 1; }
	$logo_num = intval(is_isset($atts,'logo_num'));
		
	$html = '
	<div class="shortcode_lchanges">';

		$v = get_currency_data();
				
		$bids = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE status = 'success' ORDER BY edit_date DESC LIMIT $count");
		if(count($bids) > 0){
			foreach($bids as $bid){
				$bid_id = $bid->id;
				$valut1 = $bid->currency_id_give;
				$valut2 = $bid->currency_id_get;
				if(isset($v[$valut1]) and isset($v[$valut2])){		
					$vd1 = $v[$valut1];
					$vd2 = $v[$valut2];

					$html .= get_lchange_line($bid, $vd1, $vd2, 'shortcode', $logo_num);
				}
			}
		} else {
			$html .= '<div class="resultfalse">'. __('No orders','pn') .'</div>';
		}
						
	$html .= '				
	</div>		
	';	

	$html = apply_filters('lchange_shortcode_block', $html);	
	
	return $html;
}
add_shortcode('lchanges', 'lchanges_shortcode');