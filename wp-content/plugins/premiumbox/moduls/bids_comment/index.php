<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Comments for orders[:en_US][ru_RU:]Комментарии к заявкам[:ru_RU]
description: [en_US:]Comments for orders for administrator and users[:en_US][ru_RU:]Комментарии к заявкам для администратора и клиентов[:ru_RU]
version: 1.5
category: [en_US:]Orders[:en_US][ru_RU:]Заявки[:ru_RU]
cat: req
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_filter('onebid_icons','onebid_icons_bidscomment',199,3);
function onebid_icons_bidscomment($onebid_icon, $item, $data_fs){
	
	$comment_user = trim(get_bids_meta($item->id,'comment_user'));
	$c_u = '';
	if($comment_user){
		$c_u = 'active';
	}	
	
	$comment_admin = trim(get_bids_meta($item->id,'comment_admin'));
	$c_a = '';
	if($comment_admin){
		$c_a = 'active';
	}	
	
	$user_comm = '<div class="bs_comus js_comment_0 js_comment '. $c_u .'" data-id="0">'. __('user comm.','pn') .'</div>';
	$onebid_icon['user_comm'] = array(
		'type' => 'html',
		'html' => $user_comm,
	);

	$admin_comm = '<div class="bs_comad js_comment_1 js_comment '. $c_a .'" data-id="1">'. __('admin comm.','pn') .'</div>';
	$onebid_icon['admin_comm'] = array(
		'type' => 'html',
		'html' => $admin_comm,
	);	
	
	return $onebid_icon;
} 

add_action('pn_adminpage_content_pn_bids', 'change_bids_filter_after_bidscomment');
function change_bids_filter_after_bidscomment(){
?>

<script type="text/javascript">
jQuery(function($){  	

	$(document).on('click', '.js_comment', function(){
		
		<?php
		$content = '<form action="'. pn_link_post('bid_user_comment') .'" class="ajaxed_comment_form" method="post"><p><textarea id="comment_the_text" name="comment"></textarea></p><p><input type="submit" name="submit" class="button-primary" value="'. __('Save','pn') .'" /></p><input type="hidden" name="id" id="comment_the_id" value="" /><input type="hidden" name="vid" id="comment_the_wid" value="0" /></form>';
		?>		
		
		$(document).JsWindow('show', {
			id: 'window_to_comment',
			div_class: 'update_window',
			title: '<div id="comment_the_title"></div>',
			content: '<?php echo $content; ?>',
			shadow: 1,
			after: init_comment_ajax_form
		});		
		
		var vid = parseInt($(this).attr('data-id'));
		var id = $(this).parents('.one_bids').attr('id').replace('bidid_','');
		$('#comment_the_id').val(id);
		$('#comment_the_wid').val(vid);
		$('.apply_loader').show();
		$('#techwindow_window_to_comment input[type=submit]').attr('disabled',true);
		
		if(vid == 0){
			$('#comment_the_title').html('<?php _e('Comment to user','pn'); ?>');
		} else {
			$('#comment_the_title').html('<?php _e('Comment to admin','pn'); ?>');
		}
		
		var param = 'id=' + id +'&vid='+ vid;
		$.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('bid_comment_get');?>",
			dataType: 'json',
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{		
				$('.apply_loader').hide();
				$('#techwindow_window_to_comment input[type=submit]').attr('disabled',false);
				if(res['status'] == 'error'){
					<?php do_action('pn_js_alert_response'); ?>
				} else if(res['status'] == 'success'){
					$('#comment_the_text').val(decodeURIComponent(res['comment']));						
				}					
			}
		});		
		
	});
	
	function init_comment_ajax_form(){
		$('.ajaxed_comment_form').ajaxForm({
			dataType:  'json',
			beforeSubmit: function(a,f,o) {
				$('#techwindow_window_to_comment input[type=submit]').attr('disabled',true);
			},
			error: function(res, res2, res3) {
				<?php do_action('pn_js_error_response', 'form'); ?>
			},			
			success: function(res) {
				$('#techwindow_window_to_comment input[type=submit]').attr('disabled',false);
				if(res['status'] == 'error'){ 
					<?php do_action('pn_js_alert_response'); ?>
				} else if(res['status'] == 'success'){
					var vid = $('#comment_the_wid').val();
					var id = $('#comment_the_id').val();
					
					if(res['comment'] == 'true'){
						$('#bidid_'+id).find('.js_comment_'+ vid).addClass('active');
					} else {
						$('#bidid_'+id).find('.js_comment_'+ vid).removeClass('active');
					}
				}
			}
		});
	}
	
});	
</script>

<?php	
}

/* comments */
add_action('premium_action_bid_comment_get', 'pn_premium_action_bid_comment_get');
function pn_premium_action_bid_comment_get(){
global $wpdb;
	only_post();
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	if(current_user_can('administrator') or current_user_can('pn_bids')){
		$id = intval(is_param_post('id'));
		$vid = intval(is_param_post('vid'));
		if($vid == 0){
			$comment = pn_strip_text(get_bids_meta($id,'comment_user'));
		} else {
			$comment = pn_strip_text(get_bids_meta($id,'comment_admin'));
		}
		$log['comment'] = $comment;
		$log['status'] = 'success';
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Authorisation Error','pn');
	}	
	echo json_encode($log);
	exit;
}

add_action('premium_action_bid_user_comment', 'pn_premium_action_bid_user_comment');
function pn_premium_action_bid_user_comment(){
global $wpdb;
	only_post();
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	if(current_user_can('administrator') or current_user_can('pn_bids')){
		$id = intval(is_param_post('id'));
		$vid = intval(is_param_post('vid'));
		$text = pn_strip_text(is_param_post('comment'));
		if($vid == 0){
			update_bids_meta($id,'comment_user',$text);
		} else {
			update_bids_meta($id,'comment_admin',$text);
		}
		if($text){
			$log['comment'] = 'true';
		} else {
			$log['comment'] = 'false';
		}
		$log['status'] = 'success';
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Authorisation Error','pn');
	}	
	echo json_encode($log);
	exit;	
}
/* end comments */

add_filter('direction_instruction', 'bidscomment_direction_instruction', 100000, 3);
function bidscomment_direction_instruction($instruction, $txt_name, $direction){
global $wpdb, $premiumbox, $bids_data;	
	
	$not_status = array('timeline_txt', 'description_txt', 'status_auto','status_new','status_techpay');
	if(!in_array($txt_name, $not_status) and isset($bids_data->id)){
		$comment_user = trim(get_bids_meta($bids_data->id, 'comment_user'));
		if($comment_user){
			if($instruction){ $instruction .= '<br />'; }
			$instruction .= '<span class="comment_user">'. $comment_user .'</span>';
		}	
	}
	
	return $instruction;
}

add_filter('notify_tags_bids', 'bidscomment_notify_tags_bids', 99, 2);
function bidscomment_notify_tags_bids($notify_tags, $obmen){
	$notify_tags['[comment_user]'] = trim(get_bids_meta($obmen->id, 'comment_user'));
	return $notify_tags;
}

add_filter('shortcode_notify_tags_bids','bidscomment_shortcode_notify_tags_bids');
function bidscomment_shortcode_notify_tags_bids($tags){
	$tags['comment_user'] = __('Comment to user','pn');
	return $tags;
}