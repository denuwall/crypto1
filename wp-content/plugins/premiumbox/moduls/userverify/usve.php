<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_usve', 'pn_admin_title_pn_usve');
function pn_admin_title_pn_usve(){
	_e('Identity verification','pn');
}

add_action('pn_adminpage_content_pn_usve','def_pn_admin_content_pn_usve');
function def_pn_admin_content_pn_usve(){
global $wpdb;

 	if(class_exists('trev_usve_List_Table')){
		$Table = new trev_usve_List_Table();
		$Table->prepare_items();
			
		$search = array();
		$search[] = array(
			'view' => 'input',
			'title' => __('User login','pn'),
			'default' => pn_strip_input(is_param_get('user_login')),
			'name' => 'user_login',
		);
		$search[] = array(
			'view' => 'input',
			'title' => __('IP','pn'),
			'default' => pn_strip_input(is_param_get('user_ip')),
			'name' => 'user_ip',
		);		
		pn_admin_searchbox($search, 'reply');		
			
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('pending request','pn'),
				'2' => __('confirmed request','pn'),
				'3' => __('cancelled request','pn'),
			),
			'title' => '',
		);
		pn_admin_submenu($options, 'reply');					
	?>
		<form method="post" action="<?php pn_the_link_post(); ?>">
			<?php $Table->display() ?>
		</form>

<script type="text/javascript">
jQuery(function($){	 

	<?php
	$content = '<form action="'. pn_link_post('add_reason_usve') .'" class="ajaxed_comment_form" method="post"><p><textarea id="comment_the_text" name="comment"></textarea></p><p><input type="submit" name="submit" class="button-primary" value="'. __('Save','pn') .'" /></p><input type="hidden" name="id" id="comment_the_id" value="" /></form>';
	?>

	$('.uthametka').on('click', function(){
		
		$(document).JsWindow('show', {
			id: 'window_to_comment',
			div_class: 'update_window',
			title: '<?php _e('Failure reason','pn'); ?>',
			content: '<?php echo $content; ?>',
			shadow: 1,
			after: init_comment_ajax_form
		});			
		
		var id = $(this).attr('id').replace('uthame-','');
		$('#comment_the_id').val(id);
		$('#techwindow_window_to_comment input[type=submit]').attr('disabled',true);
		$('#comment_the_text').val('');
		
		var param = 'id=' + id;
		$.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('reason_usve_get');?>",
			dataType: 'json',
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{		
				$('#techwindow_window_to_comment input[type=submit]').attr('disabled',false);
				if(res['status'] == 'error'){
					<?php do_action('pn_js_alert_response'); ?>
				} else {
					$('#comment_the_text').val(res['comment']);						
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
				} else {
					var id = $('#comment_the_id').val();
					var comf = $('#uthame-'+id);
					
					if(res['comment'] == 'true'){
						comf.addClass('active');
					} else {
						comf.removeClass('active');
					}
				}
			}
		});	
	}

});
</script>		
	<?php 
	} else {
		echo 'Class not found';
	} 
} 

add_action('premium_action_reason_usve_get', 'pn_premium_action_reason_usve_get');
function pn_premium_action_reason_usve_get(){
global $wpdb;
	only_post();

	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');		

	if(current_user_can('administrator') or current_user_can('pn_userverify')){
		$id = intval(is_param_post('id'));
		$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."verify_bids WHERE id='$id'");
		$comment = pn_strip_text(is_isset($item,'comment'));
		$log['status'] = 'success';
		$log['comment'] = $comment;
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Authorisation Error','pn');
	}	
	
	echo json_encode($log);
	exit;
}

add_action('premium_action_add_reason_usve', 'pn_premium_action_add_reason_usve');
function pn_premium_action_add_reason_usve(){
global $wpdb;
	only_post();

	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');
	
	if(current_user_can('administrator') or current_user_can('pn_userverify')){
	
		$id = intval(is_param_post('id'));
		$text = pn_strip_input(is_param_post('comment'));
		
		$wpdb->update($wpdb->prefix.'verify_bids', array('comment'=>$text), array('id'=>$id));
		
		$log['status'] = 'success';
		if($text){
			$log['comment'] = 'true';
		} else {
			$log['comment'] = 'false';
		}
		
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Authorisation Error','pn');
	}	
	
	echo json_encode($log);	
	exit;
}

add_action('premium_action_enable_userverify','def_premium_action_enable_userverify');
function def_premium_action_enable_userverify(){
global $wpdb;	
	
	pn_only_caps(array('administrator','pn_userverify'));
			
	$id = intval(is_param_get('id'));
	$place = trim(is_param_get('place'));
	$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."verify_bids WHERE id='$id'");	
	if(isset($data->id)){
		$data_id = $data->id;
			
		$array = array();
		$array['status'] = 2;
		$array['comment'] = '';
		$wpdb->update($wpdb->prefix.'verify_bids', $array, array('id'=>$id));
		
		$user_id = $data->user_id;
		$arr = array();
		$arr['user_verify'] = 1;
		$wpdb->update($wpdb->prefix.'users', $arr, array('ID'=>$user_id));
			
		$uv_auto = array();			

		$fields = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uv_field LEFT OUTER JOIN ". $wpdb->prefix ."uv_field_user ON(".$wpdb->prefix."uv_field.id = ". $wpdb->prefix ."uv_field_user.uv_field) WHERE fieldvid = '0' AND uv_id='$data_id' ORDER BY uv_order ASC");
		foreach($fields as $field){
			if($field->uv_auto){
				$uv_auto[$field->uv_auto] = apply_filters('uv_strip_filed_value', $field->uv_data, $field->uv_auto);
			}
		}
			
			if(isset($uv_auto['first_name']) and pn_verify_uv('first_name')){
				update_user_meta( $user_id, 'first_name', $uv_auto['first_name']) or add_user_meta($user_id, 'first_name', $uv_auto['first_name'], true);
			}
			if(isset($uv_auto['second_name']) and pn_verify_uv('second_name')){
				update_user_meta( $user_id, 'second_name', $uv_auto['second_name']) or add_user_meta($user_id, 'second_name', $uv_auto['second_name'], true);
			}
			if(isset($uv_auto['last_name']) and pn_verify_uv('last_name')){
				update_user_meta( $user_id, 'last_name', $uv_auto['last_name']) or add_user_meta($user_id, 'last_name', $uv_auto['last_name'], true);
			}
			if(isset($uv_auto['user_passport']) and pn_verify_uv('user_passport')){
				update_user_meta( $user_id, 'user_passport', $uv_auto['user_passport']) or add_user_meta($user_id, 'user_passport', $uv_auto['user_passport'], true);
			}
			if(isset($uv_auto['user_phone']) and pn_verify_uv('user_phone')){
				update_user_meta( $user_id, 'user_phone', $uv_auto['user_phone']) or add_user_meta($user_id, 'user_phone', $uv_auto['user_phone'], true);
			}			
			if(isset($uv_auto['user_skype']) and pn_verify_uv('user_skype')){
				update_user_meta( $user_id, 'user_skype', $uv_auto['user_skype']) or add_user_meta($user_id, 'user_skype', $uv_auto['user_skype'], true);
			}
			if(isset($uv_auto['user_email']) and pn_verify_uv('user_email')){
				if (!email_exists($uv_auto['user_email'])){
					$wpdb->update($wpdb->prefix.'users', array('user_email' => $uv_auto['user_email']), array('ID'=>$user_id));
				}
			}

			if($data->status != 2){
				$user_locale = pn_strip_input($data->locale);
				$user_email = is_email($data->user_email);
				
				$notify_tags = array();
				$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
				$notify_tags = apply_filters('notify_tags_userverify1_u', $notify_tags);		

				$user_send_data = array(
					'user_email' => $user_email,
					'user_phone' => '',
				);	
				$result_mail = apply_filters('premium_send_message', 0, 'userverify1_u', $notify_tags, $user_send_data);							
			}
	}
	
	if($place == 'all'){
		$url = admin_url('admin.php?page=pn_usve&reply=true');
		$paged = intval(is_param_post('paged'));
		if($paged > 1){ $url .= '&paged='.$paged; }			
	} else {	
		$url = admin_url('admin.php?page=pn_add_usve&item_id='. $id .'&reply=true');
	}	
	wp_redirect($url);
	exit;		
}	

add_action('premium_action_disable_userverify','def_premium_action_disable_userverify');
function def_premium_action_disable_userverify(){
global $wpdb;	

	pn_only_caps(array('administrator','pn_userverify'));
	
	$id = intval(is_param_get('id'));
	$place = trim(is_param_get('place'));
	$data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."verify_bids WHERE id='$id'");	
	if(isset($data->id)){
		$data_id = $data->id;
			
		$array = array();
		$array['status'] = 3;
		if(isset($_POST['textstatus'])){
			$array['comment'] = $textstatus = pn_strip_input(is_param_post('textstatus'));
		} else {
			$textstatus = pn_strip_input($data->comment);
		}
		$wpdb->update($wpdb->prefix.'verify_bids', $array, array('id'=>$id));
		
		$user_id = $data->user_id;
		$cc = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."verify_bids WHERE user_id = '$user_id' AND status = '2' AND id != '$data_id'");
		if($cc == 0){
			$arr = array();
			$arr['user_verify'] = 0;
			$wpdb->update($wpdb->prefix.'users', $arr, array('ID'=>$user_id));
		}
			
		if($data->status != 3){
			$user_locale = pn_strip_input($data->locale);
			$user_email = is_email($data->user_email);
			
			$notify_tags = array();
			$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
			$notify_tags['[text]'] = $textstatus;
			$notify_tags = apply_filters('notify_tags_userverify2_u', $notify_tags);		

			$user_send_data = array(
				'user_email' => $user_email,
				'user_phone' => '',
			);	
			$result_mail = apply_filters('premium_send_message', 0, 'userverify2_u', $notify_tags, $user_send_data, $user_locale);						
		}
	}
	
	if($place == 'all'){
		$url = admin_url('admin.php?page=pn_usve&reply=true');
		$paged = intval(is_param_post('paged'));
		if($paged > 1){ $url .= '&paged='.$paged; }			
	} else {	
		$url = admin_url('admin.php?page=pn_add_usve&item_id='. $id .'&reply=true');
	}
	wp_redirect($url);
	exit;		
}

add_action('premium_action_pn_usve','def_premium_action_pn_usve');
function def_premium_action_pn_usve(){ 
global $wpdb;
	
	only_post();
	pn_only_caps(array('administrator','pn_userverify'));	

	$reply = '';
	$action = get_admin_action();
	
	if(isset($_POST['save'])){
					
		do_action('pn_usve_save');
		$reply = '&reply=true';

	} else {	
		if(isset($_POST['id']) and is_array($_POST['id'])){				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."verify_bids WHERE id = '$id'");
					if(isset($data->id)){		
						do_action('pn_usve_delete_before', $id, $data);			
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."verify_bids WHERE id = '$id'");
						do_action('pn_usve_delete', $id, $data);
						if($result){
							do_action('pn_usve_delete_after', $id, $data);
						}		
					}		
				}
				
				do_action('pn_usve_action', $action, $_POST['id']);
				$reply = '&reply=true';
				
			}
		} 
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_usve_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'cnum'){
			return $item->id;
		} elseif($column_name == 'create_date'){	
			return get_mytime($item->create_date,'d.m.Y, H:i');			
		} elseif($column_name == 'cip'){
			return pn_strip_input($item->user_ip);
		} elseif($column_name == 'cuser'){
			return '<a href="'. admin_url('user-edit.php?user_id='. $item->user_id) .'">'. is_user($item->user_login) .'</a>';
		} elseif($column_name == 'cstatus'){
			if($item->status == 1){
				$status='<b>'. __('Awaiting request','pn') .'</b>';
			} elseif($item->status == 2){
				$status='<span class="bgreen">'. __('Confirmed request','pn') .'</span>';
			} elseif($item->status == 3){
				$status='<span class="bred">'. __('Request is declined','pn') .'</span>';
			} else {
				$status='<b>'. __('automatic','pn') .'</b>';
			}
			return $status;
		} elseif($column_name == 'reason'){
			$id = $item->id;
			$text_comment = trim($item->comment);
			if($text_comment){ $cl='active'; } else { $cl=''; }		
			return '<div class="uthametka question_div '. $cl .'" id="uthame-'. $id .'""></div>';
		} 
		return apply_filters('usve_manage_ap_col', '', $column_name, $item);
		
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item->id                
        );
    }	
	
    function column_title($item){
		$paged = intval(is_param_get('paged'));
        $actions = array(
			'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_usve&item_id='. $item->id) .'">'. __('Edit data','pn') .'</a>',
			//'enable'      => '<a href="'. pn_link_post('enable_userverify') .'&id='. $item->id .'&paged='. $paged .'&place=all" class="bgreen">'. __('Approve','pn') .'</a>',
			'disable'      => '<a href="'. pn_link_post('disable_userverify') .'&id='. $item->id .'&paged='. $paged .'&place=all" class="bred">'. __('Decline verification','pn') .'</a>',
        );
        
 		$primary = apply_filters('usve_manage_ap_primary', '<a href="'. admin_url('user-edit.php?user_id='. $item->user_id) .'">'. is_user($item->user_login) .'</a>', $item);
		$actions = apply_filters('usve_manage_ap_actions', $actions, $item);		
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
    }		
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', 
			'create_date'     => __('Creation date','pn'),	
			'title'     => __('User','pn'),
			'cip' => __('IP','pn'),
			'cstatus'  => __('Status','pn'),
			'reason' => __('Failure reason','pn'),
        );
		$columns = apply_filters('usve_manage_ap_columns', $columns);
        return $columns;
    }	
	
	function single_row( $item ) {
		$class = '';
		if($item->status == 2){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns( $item );
		echo '</tr>';
	}	
	
    function get_bulk_actions() {
        $actions = array(
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_usve_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$where = '';

        $mod = intval(is_param_get('mod'));
        if($mod==1){ //на модерации
            $where .= " AND status = '1'";
		} elseif($mod==2){ //активен
			$where .= " AND status = '2'";
		} elseif($mod==3){ //завершен
			$where .= " AND status = '3'";
		} else { //все, кроме автозаявок
			$where .= " AND status != '0'";
		}  		

		$user_login = pn_sfilter(pn_strip_input(is_param_get('user_login')));
		if($user_login){
		    $where .= " AND user_login LIKE '%$user_login%'";
		}

		$user_ip = pn_sfilter(pn_strip_input(is_param_get('user_ip')));
		if($user_ip){
		    $where .= " AND user_ip LIKE '%$user_ip%'";
		}		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."verify_bids WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."verify_bids WHERE auto_status = '1' $where ORDER BY id DESC LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }	

	function extra_tablenav( $which ) {
    ?>
		<div class="alignleft actions">
			<input type="submit" name="save" class="button" value="<?php _e('Save','pn'); ?>">
            <a href="<?php echo admin_url('admin.php?page=pn_add_usve');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	
	
} 

add_action('premium_screen_pn_usve','my_myscreen_pn_usve');
function my_myscreen_pn_usve() {
	$args = array(
		'label' => __('Display','pn'),
		'default' => 20,
		'option' => 'trev_usve_per_page'
	);
	add_screen_option('per_page', $args );
	if(class_exists('trev_usve_List_Table')){
		new trev_usve_List_Table;
	}
}