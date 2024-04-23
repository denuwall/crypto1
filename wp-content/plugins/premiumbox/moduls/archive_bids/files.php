<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('list_stat_userxch','archive_bids_list_stat_userxch', 10);
function archive_bids_list_stat_userxch($list_stat_userxch){
global $wpdb, $premiumbox;

	$lang_data = '';
	if(is_ml()){
		$lang = get_locale();
		$lang_key = get_lang_key($lang);
		$lang_data = '?lang='.$lang_key;
	}	

	$show_files = intval($premiumbox->get_option('archivebids','loadhistory'));
	if($show_files == 1){	
		$list_stat_userxch['archive'] = array(
			'title' => __('Download operations archive','pn'),
			'content' => '<a href="'. get_site_url_or() .'/request-archivebids.html'.$lang_data .'" target="_blank">'. __('Download','pn') .'</a>',
		);			
	}
	
	return $list_stat_userxch;
}

add_action('myaction_request_archivebids','def_request_archivebids');
function def_request_archivebids(){ 
global $wpdb, $premiumbox;

	$premiumbox->up_mode();

	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	

	if($user_id or current_user_can('administrator')){
	
		$lang = is_param_get('lang');
	
		$my_dir = wp_upload_dir();
		$path = $my_dir['basedir'].'/';		
		
		$file = $path.'archive-'. $user_id . '-' . date('Y-m-d-H-i') .'.txt';           
		$fs=@fopen($file, 'w');
		
		$where = '';
		if(!current_user_can('administrator')){
			$where .= " AND user_id = '$user_id'";
		}
	
		$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."archive_exchange_bids WHERE status='success' $where ORDER BY create_date DESC");
		
		$content = __('ID','pn') . ';' . __('Date','pn') . ';' . __('Rate','pn') . ';' . __('Send','pn') . ';' . __('Receive','pn') . ';' . __('Status','pn') . ';';
		$content .= "\n";
		
		$date_format = get_option('date_format');
		$time_format = get_option('time_format');
		
		if(is_array($datas)){
			foreach($datas as $item){
				$line = '';
				$line .= $item->id .';';
				$line .= get_mytime($item->create_date, "{$date_format}, {$time_format}") .';';
				$line .= is_out_sum(is_sum($item->course_give), 12, 'course') .''. is_site_value($item->currency_code_give) .'='. is_out_sum(is_sum($item->course_get), 12, 'course') .''. is_site_value($item->currency_code_get) .';';
				$line .= is_out_sum(is_sum($item->sum1dc), 12, 'all') .' '. pn_strip_input(ctv_ml($item->psys_give)) .' '. is_site_value($item->currency_code_give) .';';
				$line .= is_out_sum(is_sum($item->sum2c), 12, 'all') .' '. pn_strip_input(ctv_ml($item->psys_get)) .' '. is_site_value($item->currency_code_get) .';';
				$line .= get_bid_status($item->status).';';
				$line .= "\n";
				$content .= $line;
			}	
		}
		
		@fwrite($fs, $content);
		@fclose($fs);	
	
		if(is_file($file)) {
			if (ob_get_level()) {
				ob_end_clean();
			}
			if($lang == 'ru'){
				header('Content-Type: text/html; charset=CP1251');
			} else {
				header('Content-Type: text/html; charset=UTF8');
			}
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			unlink($file);
			exit;
		} else {
			pn_display_mess(__('Error! Unable to create file!','pn'));
		}	
		
	}	
}		