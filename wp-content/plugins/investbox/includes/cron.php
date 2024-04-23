<?php
if( !defined( 'ABSPATH')){ exit(); }

function request_investcron(){
global $wpdb;	
	
	/* удаляем не оплаченные депозиты, через 7 дней */
	$time = current_time('timestamp') - (7 * DAY_IN_SECONDS);
    $ldate = date('Y-m-d H:00:00', $time);
	$appls = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."inex_deposit WHERE createdate < '$ldate' AND paystatus='0'");
	foreach($appls as $item){
		$id = $item->id;	
	    $wpdb->query("DELETE FROM ".$wpdb->prefix."inex_deposit WHERE id = '$id'");
	}	
	/* end удаляем не оплаченные депозиты, через 7 дней */
	
	/* уведомление клиенту о окончании депозита */
	$date = current_time('mysql');
	$aus = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."inex_deposit WHERE paystatus='1' AND mail1='0' AND enddate < '$date'");
	foreach($aus as $au){
		$auid = $au->id;
		$wpdb->update($wpdb->prefix.'inex_deposit', array('mail1'=> 1), array('id'=> $auid));
		
		$user_email = is_email($au->user_email);
		if($user_email){
					
			$locale = pn_strip_input($au->locale);
					
			$notify_tags = array();
			$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
			$notify_tags['[outsumm]'] = pn_strip_input($au->outsumm .' '. $au->gvalut);
			$notify_tags['[id]'] = $au->id;
			$notify_tags = apply_filters('notify_tags_mail1u', $notify_tags);		

			$user_send_data = array(
				'user_email' => $user_email,
				'user_phone' => '',
			);	
			$result_mail = apply_filters('premium_send_message', 0, 'mail1u', $notify_tags, $user_send_data, $locale);					
					
		}						
	}		
}

add_filter('list_cron_func', 'request_investcron_list_cron_func');
function request_investcron_list_cron_func($filters){

	$filters['request_investcron'] = array(
		'title' => __('E-mail notification of deposit expiry and deleting of unpaid deposits','inex'),
		'site' => 'now',
	);
	
	return $filters;
}