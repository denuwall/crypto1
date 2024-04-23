<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('siteplace_js','siteplace_js_zreserv');
function siteplace_js_zreserv(){	
	if(is_enable_zreserve()){
?>	
/* request reserve */
jQuery(function($){ 

	$(document).on('click', '.js_reserv', function(){
		
		$(document).JsWindow('show', {
			id: 'window_to_zreserve',
			div_class: 'update_window',
			title: '<?php echo __('Request to reserve','pn') .' "<span id="reserv_box_title"></span>"'; ?>',
			div_content: '.reserv_box_html',
			insert_div: '.reserv_box',
			shadow: 1
		});		
		
		var title = $(this).attr('data-title');
        var id = $(this).attr('data-id');		
		$('#reserv_box_title').html(title);	
		$('#reserv_box_id').attr('value',id);				
			
	    return false;
	});	
	
});
/* end request reserve */	
<?php	
	}
} 

add_action('wp_footer','wp_footer_zreserv');
function wp_footer_zreserv(){
    if(is_enable_zreserve()){
		global $wpdb;
		
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		$items = get_zreserv_form_filelds();
		$html = prepare_form_fileds($items, 'reserv_form_line', 'rb');			
		
		$array = array(
			'[result]' => '<div class="resultgo"></div>',
			'[html]' => $html,
			'[submit]' => '<input type="submit" formtarget="_top" name="submit" value="'. __('Send a request', 'pn') .'" />',
		);
		$temp = '
		<div class="reserv_box_html" style="display: none;">
			[result]
					
			[html]
					
			<p>[submit]</p>
		</div>	
		
		<form method="post" class="ajax_post_form" action="'. get_ajax_link('reservform') .'"><input type="hidden" name="id" id="reserv_box_id" value="0" />
			<div class="reserv_box"></div>
		</form>
		';
		
		$temp = apply_filters('zreserv_form_temp',$temp);
		echo get_replace_arrays($array, $temp);		
    } 
}

add_action('myaction_site_reservform', 'def_myaction_site_reservform');
function def_myaction_site_reservform(){
global $wpdb, $premiumbox;	
	
	only_post();
	
	$log = array();
	$log['response'] = '';
	$log['status'] = '';
	$log['status_code'] = 0;
	$log['status_text'] = '';
	$log['errors'] = array();
	
	$premiumbox->up_mode();
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$parallel_error_output = get_parallel_error_output();
	
	if(is_enable_zreserve()){
	
		$log = apply_filters('before_ajax_form_field', $log, 'reservform');
		$log = apply_filters('before_ajax_reservform', $log);
		
		$field_errors = array();
		
		$id = intval(is_param_post('id'));
		$sum = is_sum(is_param_post('sum'),2);
		$email = is_email(is_param_post('email'));
		$comment = pn_maxf_mb(pn_strip_input(is_param_post('comment')),500);
		
		if($sum <= 0){
			$field_errors[] = __('Error! Requested amount is lesser than zero','pn');	
		}
		if(count($field_errors) == 0 or $parallel_error_output == 1){
			if(!$email){
				$field_errors[] = __('Error! You have not entered e-mail','pn');
			}	
		}		
		if(count($field_errors) == 0 or $parallel_error_output == 1){
			$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$id' AND direction_status='1' AND auto_status='1'");
			if(!isset($direction->id)){
				$field_errors[] = __('Error! Direction does not exist','pn');
			}	
		}		

		if(count($field_errors) == 0){

			$last = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."reserve_requests WHERE user_email = '$email' AND naps_id='$id'");
					
			$array = array();
			$array['rdate'] = current_time('mysql');
			$array['naps_id'] = $id;
			$array['naps_title'] = pn_strip_input($direction->tech_name);
			$array['user_email'] = $email;
			$array['comment'] = $comment;
			$array['amount'] = $sum;
			$array['locale'] = get_locale();
					
			if(isset($last->id)){
				$wpdb->update($wpdb->prefix ."reserve_requests", $array, array('id'=>$last->id));
			} else {
				$wpdb->insert($wpdb->prefix ."reserve_requests", $array);
			}
				
			$notify_tags = array();
			$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
			$notify_tags['[sum]'] = $array['amount'];
			$notify_tags['[direction]'] = $array['naps_title'];
			$notify_tags['[email]'] = $array['user_email'];
			$notify_tags['[comment]'] = $comment;
			$notify_tags['[ip]'] = pn_real_ip();
			$notify_tags = apply_filters('notify_tags_zreserv_admin', $notify_tags, $ui);
			
			$user_send_data = array();	
			$result_mail = apply_filters('premium_send_message', 0, 'zreserv_admin', $notify_tags, $user_send_data); 										
					
			$log['status'] = 'success_clear';
			$log['status_text'] = __('Request has been successfully created','pn');
			
		} else {
			$log['status'] = 'error';
			$log['status_code'] = 1;
			$log['status_text'] = join("<br />", $field_errors);
		}
		
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! You have not entered e-mail','pn');		
	}
	
	echo json_encode($log);
	exit;
}