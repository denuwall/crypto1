<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_userwallets_verify', 'pn_admin_title_pn_userwallets_verify');
function pn_admin_title_pn_userwallets_verify(){
	_e('Account verification','pn');
}

add_action('pn_adminpage_content_pn_userwallets_verify','def_pn_admin_content_pn_userwallets_verify');
function def_pn_admin_content_pn_userwallets_verify(){
global $wpdb;

 	if(class_exists('trev_usac_List_Table')){
		$Table = new trev_usac_List_Table();
		$Table->prepare_items();
			
		$search = array();
		$search['user_login'] = array(
			'view' => 'input',
			'title' => __('User login','pn'),
			'default' => is_user(is_param_get('user_login')),
			'name' => 'user_login',
		);
		$search['wallet_num'] = array(
			'view' => 'input',
			'title' => __('Account number','pn'),
			'default' => pn_strip_input(is_param_get('wallet_num')),
			'name' => 'wallet_num',
		);
		$search['user_ip'] = array(
			'view' => 'input',
			'title' => __('IP','pn'),
			'default' => pn_strip_input(is_param_get('user_ip')),
			'name' => 'user_ip',
		);		
		
		$currency = apply_filters('list_currency_manage', array(), __('All currency','pn'));
		$search[] = array(
			'view' => 'select',
			'options' => $currency,
			'title' => __('Currency','pn'),
			'default' => pn_strip_input(is_param_get('currency_id')),
			'name' => 'currency_id',
		);		
		pn_admin_searchbox($search, 'reply');			
			
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('pending request','pn'),
				'2' => __('verified request','pn'),
				'3' => __('unverified request','pn'),
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
	
    $(document).on('click', '.js_usac_del', function(){
		var id = $(this).attr('data-id');
		var thet = $(this);
		if(!thet.hasClass('act')){
			if(confirm("<?php _e('Are you sure you want to delete the file?','pn'); ?>")){
				thet.addClass('act');
				var param ='id=' + id;
				$.ajax({
				type: "POST",
				url: "<?php echo get_ajax_link('delete_accverify');?>",
				dataType: 'json',
				data: param,
				error: function(res, res2, res3){
					<?php do_action('pn_js_error_response', 'ajax'); ?>
				},			
				success: function(res)
				{
					if(res['status'] == 'success'){
						$('.accline_' + id).remove();
					} 
					if(res['status'] == 'error'){
						<?php do_action('pn_js_alert_response'); ?>
					}
					thet.removeClass('act');
				}
				});
			}
		}
        return false;
    });	
	
/* comment */

	<?php
	$content = '<form action="'. pn_link_post('add_uv_wallets_comment') .'" class="ajaxed_comment_form" method="post"><p><textarea id="comment_the_text" name="comment"></textarea></p><p><input type="submit" name="submit" class="button-primary" value="'. __('Save','pn') .'" /></p><input type="hidden" name="id" id="comment_the_id" value="" /></form>';
	?>

	$('.uthametka').click(function(){
		
		$(document).JsWindow('show', {
			id: 'window_to_comment',
			div_class: 'update_window',
			title: '<?php _e('Comment','pn'); ?>',
			content: '<?php echo $content; ?>',
			shadow: 1,
			after: init_comment_ajax_form
		});		
		
		var id = $(this).attr('id').replace('uthame-','');
		$('#comment_the_id').val(id);
		$('#techwindow_window_to_comment input[type=submit]').prop('disabled',true);
		$('#comment_the_text').val('');
		
		var param = 'id=' + id;
		$.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('uv_wallets_comment_get');?>",
			dataType: 'json',
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{		
				$('#techwindow_window_to_comment input[type=submit]').prop('disabled',false);
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
				$('#techwindow_window_to_comment input[type=submit]').prop('disabled',true);
			},
			error: function(res, res2, res3) {
				<?php do_action('pn_js_error_response', 'form'); ?>
			},		
			success: function(res){
				$('#techwindow_window_to_comment input[type=submit]').prop('disabled',false);
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

					$(document).JsWindow('hide');
				}
			}
		});	
	}
/* end comment */	
	
});
</script>		
	<?php 
	} else {
		echo 'Class not found';
	}  
}

/* comments */
add_action('premium_action_uv_wallets_comment_get', 'pn_premium_action_uv_wallets_comment_get');
function pn_premium_action_uv_wallets_comment_get(){
global $wpdb;
	only_post();

	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');	

	if(current_user_can('administrator') or current_user_can('pn_userwallets')){
		$id = intval(is_param_post('id'));
		$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE id='$id'");
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

add_action('premium_action_add_uv_wallets_comment', 'pn_premium_action_add_uv_wallets_comment');
function pn_premium_action_add_uv_wallets_comment(){
global $wpdb;
	only_post();

	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');
	
	if(current_user_can('administrator') or current_user_can('pn_userwallets')){
		$id = intval(is_param_post('id'));
		$text = pn_strip_input(is_param_post('comment'));
		$wpdb->update($wpdb->prefix.'uv_wallets', array('comment'=>$text), array('id'=>$id));
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
/* end comments */

add_action('premium_action_pn_userwallets_verify','def_premium_action_pn_userwallets_verify');
function def_premium_action_pn_userwallets_verify(){
global $wpdb;

	only_post();
	pn_only_caps(array('administrator','pn_userwallets'));	

	$reply = '';
	$action = get_admin_action();
		
	if(isset($_POST['save'])){
						
		do_action('pn_uv_wallets_save');
		$reply = '&reply=true';

	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){				
			if($action == 'true'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);		
					$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE id = '$id' AND status != '1'");
					if(isset($item->id)){
						$user_wallet_id = $item->user_wallet_id;
									
						$arr = array();
						$arr['status'] = 1;
						$wpdb->update($wpdb->prefix . 'uv_wallets', $arr, array('id'=>$item->id));

						$arr = array();
						$arr['verify'] = 1;
						$wpdb->update($wpdb->prefix.'user_wallets', $arr, array('id'=>$user_wallet_id));								

						do_action('pn_uv_wallets_verify', $user_wallet_id, $item);
										
						$user_locale = pn_strip_input($item->locale);
						$purse = pn_strip_input($item->wallet_num);
						
						$notify_tags = array();
						$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
						$notify_tags['[user_login]'] = $item->user_login;
						$notify_tags['[purse]'] = $purse;
						$notify_tags['[comment]'] = $item->comment;
						$notify_tags = apply_filters('notify_tags_userverify3_u', $notify_tags, $item);					
					
						$user_send_data = array(
							'user_email' => is_email($item->user_email),
							'user_phone' => '',
						);	
						$result_mail = apply_filters('premium_send_message', 0, 'userverify3_u', $notify_tags, $user_send_data, $user_locale); 								
								
					}
				}			
			}

			if($action == 'false'){			
				foreach($_POST['id'] as $id){
					$id = intval($id);		
					$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE id = '$id' AND status != '2'");
					if(isset($item->id)){
						$user_wallet_id = $item->user_wallet_id;
									
						$arr = array();
						$arr['status'] = 2;
						$wpdb->update($wpdb->prefix . 'uv_wallets', $arr, array('id'=>$item->id));

						$verify_request = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_wallets WHERE user_wallet_id='$user_wallet_id' AND status='1'");
						if($verify_request == 0){
										
							$arr = array();
							$arr['verify'] = 0;
							$wpdb->update($wpdb->prefix.'user_wallets', $arr, array('id'=>$user_wallet_id));								

							do_action('pn_uv_wallets_notverify', $user_wallet_id, $item);							

							$user_locale = pn_strip_input($item->locale);
							$purse = pn_strip_input($item->wallet_num);
							
							$notify_tags = array();
							$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
							$notify_tags['[user_login]'] = $item->user_login;
							$notify_tags['[purse]'] = $purse;
							$notify_tags['[comment]'] = $item->comment;
							$notify_tags = apply_filters('notify_tags_userverify4_u', $notify_tags, $item);					
					
							$user_send_data = array(
								'user_email' => is_email($item->user_email),
								'user_phone' => '',
							);	
							$result_mail = apply_filters('premium_send_message', 0, 'userverify4_u', $notify_tags, $user_send_data, $user_locale);								
								
						}
					}
				}			
			}				
					
			if($action == 'delete'){			
				foreach($_POST['id'] as $id){
					$id = intval($id);			
					$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE id = '$id'");
					if(isset($item->id)){
						do_action('pn_uv_wallets_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."uv_wallets WHERE id = '$id'");
						do_action('pn_uv_wallets_delete', $id, $item);
						if($result){
							do_action('pn_uv_wallets_delete_after', $id, $item);
						}
					}
				}			
			}
			
			do_action('pn_uv_wallets_action', $action, $_POST['id']);
			$reply = '&reply=true';
		} 
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_usac_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ));
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'cnums'){
			return pn_strip_input($item->wallet_num);
		} elseif($column_name == 'create_date'){	
			return get_mytime($item->create_date,'d.m.Y, H:i');
		} elseif($column_name == 'cip'){
			return pn_strip_input($item->user_ip);
		} elseif($column_name == 'cuser'){
		    $user_id = $item->user_id;
		    $us = '<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">'. is_user($item->user_login) . '</a>';
		    return $us;
		} elseif($column_name == 'cps'){ 	
			return get_currency_title_by_id($item->currency_id);
		} elseif($column_name == 'cfiles'){	
			return get_usac_files($item->user_wallet_id);
		} elseif($column_name == 'cstatus'){
			
			if($item->status == 1){
				$status ='<span class="bgreen">'. __('Verified','pn') .'</span>';
			} elseif($item->status == 2){
				$status ='<span class="bred">'. __('Unverified','pn') .'</span>';
			} else {
				$status = '<b>'.  __('Pending verification','pn')  .'</b>';
			}
 	
			return $status;
		} elseif($column_name == 'comment') {
			$id = $item->id;
			$comment_text = trim($item->comment);
			if($comment_text){ $cl='active'; } else { $cl=''; }		
			return '<div class="uthametka question_div '. $cl .'" id="uthame-'. $id .'"></div>';			
		} 
		
		return apply_filters('uv_wallets_manage_ap_col', '', $column_name,$item);
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item->id                
        );
    }			
	
	function single_row( $item ) {
		$class = '';
		if($item->status == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns( $item );
		echo '</tr>';
	}	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'create_date'     => __('Creation date','pn'),
			'cuser'     => __('User','pn'),
			'cip' => __('IP','pn'),
			'cps' => __('PS','pn'),
			'cnums' => __('Account number','pn'),
			'cfiles' => __('Files','pn'),
			'cstatus'  => __('Status','pn'),
			'comment'     => __('Comment','pn'),
        );
		$columns = apply_filters('uv_wallets_manage_ap_columns', $columns);
        return $columns;
    }	
	

    function get_bulk_actions() {
        $actions = array(
			'true'    => __('Verify','pn'),
			'false'    => __('Unverify','pn'),
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_usac_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$where = '';

        $mod = intval(is_param_get('mod'));
        if($mod==1){ //в ожидании
            $where .= " AND status = '0'";
		} elseif($mod==2) { //верифицированные
			$where .= " AND status = '1'";
		} elseif($mod==3) { //не верифицированные
			$where .= " AND status = '2'";
		}  		

		$user_login = is_user(is_param_get('user_login'));
		if($user_login){
		    $where .= " AND user_login LIKE '%$user_login%'";
		}

		$user_ip = pn_sfilter(pn_strip_input(is_param_get('user_ip')));
		if($user_ip){
		    $where .= " AND user_ip LIKE '%$user_ip%'";
		}

		$wallet_num = pn_sfilter(pn_strip_input(is_param_get('wallet_num')));
		if($wallet_num){
		    $where .= " AND wallet_num LIKE '%$wallet_num%'";
		}

		$currency_id = intval(is_param_get('currency_id'));
        if($currency_id){ 
            $where .= " AND currency_id = '$currency_id'";
		}		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_wallets WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."uv_wallets WHERE id > 0 $where ORDER BY id DESC LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }	
	
}  

add_action('premium_screen_pn_userwallets_verify','my_myscreen_pn_userwallets_verify');
function my_myscreen_pn_userwallets_verify() {
	$args = array(
		'label' => __('Display','pn'),
		'default' => 20,
		'option' => 'trev_usac_per_page'
	);
	add_screen_option('per_page', $args );
	if(class_exists('trev_usac_List_Table')){
		new trev_usac_List_Table;
	}
} 