<?php
if( !defined( 'ABSPATH')){ exit(); } 

function userxch_page_shortcode($atts, $content) {
global $wpdb;
	
	$temp = '';
	$temp .= apply_filters('before_userxch_page','');
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	if($user_id){
		
			$user_discount = get_user_discount($user_id);
			$user_exchange = get_user_count_exchanges($user_id);
			$user_exchange_sum = get_user_sum_exchanges($user_id);		
		
			$list_stat_userxch = array(
				'discount' => array(
					'title' => __('Personal discount','pn'),
					'content' => is_out_sum($user_discount, 12, 'all') .'%',
				),
				'exchanges' => array(
					'title' => __('Exchanges','pn'),
					'content' => is_out_sum($user_exchange, 12, 'all'),
				),	
				'exchange_sum' => array(
					'title' => __('Amount of exchanges','pn'),
					'content' => is_out_sum($user_exchange_sum, 12, 'all') .' '. cur_type(),				
				),
			);
			$list_stat_userxch = apply_filters('list_stat_userxch', $list_stat_userxch);
		
			$stat = '
			<table>';	
				foreach($list_stat_userxch as $list_key => $list_value){
					$stat .= '
					<tr>
						<th>'. is_isset($list_value, 'title') .'</th>
						<td>'. is_isset($list_value, 'content') .'</td>
					</tr>					
					';
				}
			$stat .= '	
			</table>
			';
		
			$lists = array(
				'before' => '<table>',
				'after' => '</table>',
				'before_head' => '<thead><tr>',
				'after_head' => '</tr></thead>',
				'head_line' => '<th class="th_[key]">[title]</th>',
				'before_body' => '<tbody>',
				'after_body' => '</tbody>',
				'body_line' => '<tr>[html]</tr>',
				'body_item' => '<td class="td_[key] [odd_even]">[content]</td>',
				'lists' => array(
					'id' => __('ID','pn'),
					'date' => __('Date','pn'),
					'rate' => __('Rate','pn'),
					'give' => __('Send','pn'),
					'get' => __('Receive','pn'),
					'status' => __('Status','pn'),
				),
				'noitem' => '<tr><td colspan="[count]"><div class="no_items"><div class="no_items_ins">[title]</div></div></td></tr>',
			);
			$lists = apply_filters('lists_userxch', $lists);
			$lists = (array)$lists;		
		
			$head_list = '';
			$c = 0;
			if(is_array($lists['lists'])){
				foreach($lists['lists'] as $key => $title){
					$c++;
					$list = is_isset($lists, 'head_line');
					$list = str_replace('[key]',$key,$list);
					$list = str_replace('[title]',$title,$list);
					$head_list .= $list;
				}
			}
			
			$table_list = is_isset($lists, 'before');
			$table_list .= is_isset($lists, 'before_head');
			$table_list .= $head_list;
			$table_list .= is_isset($lists, 'after_head');
			$table_list .= is_isset($lists, 'before_body');		
		
			$limit = apply_filters('limit_list_userxch', 15);
			$count = $wpdb->get_var("SELECT COUNT(ID) FROM ".$wpdb->prefix."exchange_bids WHERE user_id = '$user_id' AND status != 'auto'");
			$pagenavi = get_pagenavi_calc($limit,get_query_var('paged'),$count);
		
			$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."exchange_bids WHERE user_id = '$user_id' AND status != 'auto' ORDER BY create_date DESC LIMIT ". $pagenavi['offset'] .",".$pagenavi['limit']);		

			$date_format = get_option('date_format');
			$time_format = get_option('time_format');				
			
			$v = get_currency_data();
			
			$s=0;
            foreach ($datas as $item) {  $s++;
				if($s%2==0){ $odd_even = 'even'; } else { $odd_even = 'odd'; }
			
				$valid1 = $item->currency_id_give;
				$valid2 = $item->currency_id_get;
						
				if(isset($v[$valid1]) and isset($v[$valid2])){
					$vd1 = $v[$valid1];
					$vd2 = $v[$valid2];
					$decimal1 = $vd1->currency_decimal;
					$decimal2 = $vd2->currency_decimal;	
				} else {
					$decimal1 = 12;
					$decimal2 = 12;
				}			
			
				$one_line = '';
				if(is_array($lists['lists'])){
					foreach($lists['lists'] as $key => $title){
							
						$data_item = '';
						if($key == 'id'){
							$data_item = $item->id;
						}							
						if($key == 'date'){
							$data_item = get_mytime($item->create_date, "{$date_format}, {$time_format}");
						}
						if($key == 'rate'){
							$data_item = '<span class="uo_curs1"><span class="uosum">'. is_out_sum(is_sum($item->course_give), $decimal1, 'course') .'</span> '. is_site_value($item->currency_code_give) .'</span> <span class="uo_curs2"><span class="uosum">'. is_out_sum(is_sum($item->course_get), $decimal2, 'course') .'</span> '. is_site_value($item->currency_code_get) .'</span>';
						}	
						if($key == 'give'){
							$data_item = '<span class="uosum">'. is_out_sum(is_sum($item->sum1dc), $decimal1, 'all') .'</span> '. pn_strip_input(ctv_ml($item->psys_give)) .' '. is_site_value($item->currency_code_give);
						}	
						if($key == 'get'){
							$data_item = '<span class="uosum">'. is_out_sum(is_sum($item->sum2c), 12 , 'all') .'</span> '. pn_strip_input(ctv_ml($item->psys_get)) .' '. is_site_value($item->currency_code_get);
						}
						if($key == 'status'){
							$status = get_bid_status($item->status);
							$link = get_bids_url($item->hashed);
							$data_item = '<a href="'. $link .'" target="_blank" class="uostatus_link uost_'. is_status_name($item->status) .'">'. $status .'</a>';
						}
						$data_item = apply_filters('body_list_userxch', $data_item, $item, $key, $title, $date_format, $time_format, $v);
							
						if($data_item){
							$list = is_isset($lists, 'body_item');
							$list = str_replace('[key]',$key,$list);
							$list = str_replace('[title]',$title,$list);
							$list = str_replace('[content]',$data_item,$list);
							$one_line .= $list;
						}
							
					}
				}
					
				$body_list_line = is_isset($lists, 'body_line');
				$body_list_line = str_replace('[html]',$one_line,$body_list_line);
				$body_list_line = str_replace('[odd_even]',$odd_even,$body_list_line);
				$table_list .= $body_list_line;			 
					
	        }	

			if($count == 0){
				$list = is_isset($lists, 'noitem');
				$list = str_replace('[count]', $c,$list);
				$list = str_replace('[title]',__('No data','pn'),$list);
				$table_list .= $list;
			}	

			$table_list .= is_isset($lists, 'after_body');
			$table_list .= is_isset($lists, 'after');			
		
			$array = array(
				'[stat]' => $stat,
				'[table_list]' => $table_list,
				'[pagenavi]' => get_pagenavi($pagenavi),
			);	
		
			$temp_form = '
				<div class="userxch_tablediv">
					<div class="userxch_tablediv_ins">
						[stat]
					</div>
				</div>
				
				<div class="userxchtable">
					<div class="userxchtable_ins">
						<div class="userxchtable_title">
							<div class="userxchtable_title_ins">
								'. __('Your transactions','pn') .'
							</div>
						</div>	
						<div class="userxch_table">
							<div class="userxch_table_ins">
								[table_list]
							</div>	
						</div>
						
						[pagenavi]
					</div>
				</div>						
			';
		
			$temp_form = apply_filters('userxch_form_temp',$temp_form);
			$temp .= get_replace_arrays($array, $temp_form);		
	
	} else {
		$temp .= '<div class="resultfalse">'. __('Error! Page is available for authorized users only','pn') .'</div>';
	}
	
	$after = apply_filters('after_userxch_page','');
	$temp .= $after;

	return $temp;
}
add_shortcode('userxch', 'userxch_page_shortcode');