<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_directions', 'pn_adminpage_title_pn_directions');
function pn_adminpage_title_pn_directions(){
	_e('Exchange directions','pn');
}

add_action('pn_adminpage_content_pn_directions','def_pn_admin_content_pn_directions');
function def_pn_admin_content_pn_directions(){

	if(class_exists('trev_directions_List_Table')){ 
		$Table = new trev_directions_List_Table();
		$Table->prepare_items();
?>

<style>
.column-cid{ width: 50px!important; }
.column-merchant, .column-paymerchant{ width: 150px!important; }
</style>

<script type="text/javascript">
jQuery(function($){
 	$(document).on('change', '.m_in', function(){  
		var id = $(this).attr('name');
		var wid = $(this).val();
		var thet = $(this);
		thet.attr('disabled',true);
		
		$('#premium_ajax').show();
		var param='id=' + id + '&wid=' + wid;
		
        $.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('merchant_direction_save'); ?>",
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{
				$('#premium_ajax').hide();	
				thet.attr('disabled',false);
			}
        });
	
        return false;
	});
	
	$(document).on('change', '.m_out', function(){
		var id = $(this).attr('name');
		var wid = $(this).val();
		var thet = $(this);
		thet.attr('disabled',true);
		
		$('#premium_ajax').show();
		var param='id=' + id + '&wid=' + wid;
		
        $.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('paymerchant_direction_save'); ?>",
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{
				$('#premium_ajax').hide();	
				thet.attr('disabled',false);
			}
        });
	
        return false;
	});	 
});
</script>	
	<?php
	pn_admin_searchbox(array(), 'reply');
	
	$options = array();
	$options['mod'] = array(
		'name' => 'mod',
		'options' => array(
			'1' => __('active direction','pn'),
			'2' => __('inactive direction','pn'),
		),
		'title' => '',
	);	
	pn_admin_submenu($options, 'reply');		
	?>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
}

add_action('premium_action_merchant_direction_save', 'pn_premium_action_merchant_direction_save');
function pn_premium_action_merchant_direction_save(){
global $wpdb;

	only_post();
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$data_id = intval(is_param_post('id'));
		if($data_id){
			$wid = is_extension_name(is_param_post('wid'));
			$array = array();
			$array['m_in'] = $wid;
			$wpdb->update($wpdb->prefix.'directions', $array, array('id'=>$data_id));
			$wpdb->query("UPDATE ".$wpdb->prefix."exchange_bids SET m_in = '$wid' WHERE direction_id = '$data_id'");
		}	
	}  		
		
}

add_action('premium_action_paymerchant_direction_save', 'pn_premium_action_paymerchant_direction_save');
function pn_premium_action_paymerchant_direction_save(){
global $wpdb;

	only_post();
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$data_id = intval(is_param_post('id'));
		if($data_id){
			$wid = is_extension_name(is_param_post('wid'));
			$array = array();
			$array['m_out'] = $wid;
			$wpdb->update($wpdb->prefix.'directions', $array, array('id'=>$data_id));
			$wpdb->query("UPDATE ".$wpdb->prefix."exchange_bids SET m_out = '$wid' WHERE direction_id = '$data_id'");
		}	
	}  		
		
}

add_action('premium_action_pn_directions','def_premium_action_pn_directions');
function def_premium_action_pn_directions(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_directions'));

	$reply = '';
	$action = get_admin_action();
			
	if(isset($_POST['filter'])){
			
		$ref = is_param_post('_wp_http_referer');
		$url = pn_admin_filter_data($ref, 'reply, curr_give, curr_get');			
			
		$curr_give = intval(is_param_post('curr_give'));
		if($curr_give){
			$url .= '&curr_give='.$curr_give;
		}
				
		$curr_get = intval(is_param_post('curr_get'));
		if($curr_get){
			$url .= '&curr_get='.$curr_get;
		}				
				
		wp_redirect($url);
		exit;
				
	} elseif(isset($_POST['back_filter'])){	
				
		$ref = is_param_post('_wp_http_referer');
		$url = pn_admin_filter_data($ref, 'reply, curr_give, curr_get');		
			
		$curr_give = intval(is_param_post('curr_give'));
		if($curr_give){
			$url .= '&curr_get=' . $curr_give;
		}
				
		$curr_get = intval(is_param_post('curr_get'));
		if($curr_get){
			$url .= '&curr_give=' . $curr_get;
		}				
				
		wp_redirect($url);
		exit;				
			
	} elseif(isset($_POST['save'])){
				
		if(isset($_POST['course_give']) and is_array($_POST['course_give']) and isset($_POST['course_get']) and is_array($_POST['course_get'])){	
			$now_date = current_time('mysql');	
			foreach($_POST['course_give'] as $id => $course_give){
				$id = intval($id);
				$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status = '1' AND id='$id'");
				if(isset($item->id)){
					$course_give = is_sum($course_give);
					$course_get = is_sum($_POST['course_get'][$id]);
							
					$arr = array();				
					if($course_give != $item->course_give or $course_get != $item->course_get){
						$arr['course_give'] = $course_give;
						$arr['course_get'] = $course_get;
					}
					if(count($arr) > 0){
						$arr['edit_date'] = $now_date;
						$wpdb->update($wpdb->prefix.'directions', $arr, array('id'=>$id));
						do_action('direction_change_course', $id, $item, $course_give, $course_get, 'edit_list_directions');
					}
				}	
			}
		}	 		
				
		do_action('pn_directions_save');
		$reply = '&reply=true';

	} else {	
		if(isset($_POST['id']) and is_array($_POST['id'])){				
				
			if($action == 'active'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE id='$id' AND direction_status != '1'");
					if(isset($item->id)){
						do_action('pn_direction_active_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."directions SET direction_status = '1' WHERE id = '$id'");
						do_action('pn_direction_active', $id, $item);
						if($result){
							do_action('pn_direction_active_after', $id, $item);
						}
					}
				}			
			}

			if($action == 'notactive'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE id='$id' AND direction_status != '0'");
					if(isset($item->id)){							
						do_action('pn_direction_notactive_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."directions SET direction_status = '0' WHERE id = '$id'");
						do_action('pn_direction_notactive', $id, $item);
						if($result){
							do_action('pn_direction_notactive_after', $id, $item);
						}
					}
				}		
			}					
				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_direction_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."directions WHERE id = '$id'");
						do_action('pn_direction_delete', $id, $item);
						if($result){
							do_action('pn_direction_delete_after', $id, $item);
						}
					}
				}			
			}
			
			do_action('pn_directions_action', $action, $_POST['id']);
			$reply = '&reply=true';
					
		} 	
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_directions_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
		
		if($column_name == 'course_give'){		
		    return '<input type="text" style="width: 100%; max-width: 80px;" name="course_give['. $item->id .']" value="'. is_sum($item->course_give) .'" />';
		} elseif($column_name == 'course_get'){		
		    return '<input type="text" style="width: 100%; max-width: 80px;" name="course_get['. $item->id .']" value="'. is_sum($item->course_get) .'" />';			
		} elseif($column_name == 'merchant'){	

			$list_merchants = apply_filters('list_merchants',array());
			$m_in = is_extension_name(is_isset($item, 'm_in')); 
			
			$html ='
			<select name="'. $item->id .'" class="m_in" style="width: 150px;" autocomplete="off"> 
				<option value="0" '. selected($m_in,0, false) .'>--'. __('No item','pn') .'--</option>';
											
					foreach($list_merchants as $merch_data){ 
						$merch_id = is_extension_name(is_isset($merch_data,'id'));
						$merch_title = is_isset($merch_data,'title');
						$merch_en = intval(is_enable_merchant($merch_id));
						$enable_title = __('inactive merchant','pn'); if($merch_en == 1){ $enable_title = __('active merchant','pn'); }
						
						$html .='<option value="'. $merch_id .'" '. selected($m_in,$merch_id, false) .'>'. $merch_title .' ['. $enable_title .']</option>';
					} 
					
			$html .='
			</select>			
			';
			
			return $html;

		} elseif($column_name == 'paymerchant'){	

			$list_merchants = apply_filters('list_paymerchants',array());
			$m_out = is_extension_name(is_isset($item, 'm_out')); 
			
			$html ='
			<select name="'. $item->id .'" class="m_out" style="width: 150px;" autocomplete="off"> 
				<option value="0" '. selected($m_out,0, false) .'>--'. __('No item','pn') .'--</option>';
											
					foreach($list_merchants as $merch_data){ 
						$merch_id = is_extension_name(is_isset($merch_data,'id'));
						$merch_title = is_isset($merch_data,'title');
						$merch_en = intval(is_enable_paymerchant($merch_id));
						$enable_title = __('inactive automatic payout','pn');
						if($merch_en == 1){ $enable_title = __('active automatic payout','pn'); }
						
						$html .='<option value="'. $merch_id .'" '. selected($m_out,$merch_id, false) .'>'. $merch_title .' ['. $enable_title .']</option>';
					} 
					
			$html .='
			</select>			
			';
			
			return $html;			
			
		} elseif($column_name == 'status'){
		    if($item->direction_status == 0){ 
			    return '<span class="bred">'. __('inactive direction','pn') .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('active direction','pn') .'</span>'; 
			}	
		} elseif($column_name == 'cid'){
			return '<strong>'. $item->id .'</strong>';	
		} 
		return apply_filters('directions_manage_ap_col', '', $column_name,$item);
		
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item->id                
        );
    }	

    function column_title($item){

        $actions = array(
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_directions&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
		
		if($item->direction_status == 1){
			$actions['view'] = '<a href="'. get_exchange_link($item->direction_name) .'" target="_blank">'. __('View','pn') .'</a>';
		}
   		$primary = apply_filters('directions_manage_ap_primary', pn_strip_input($item->tech_name), $item);
		$actions = apply_filters('directions_manage_ap_actions', $actions, $item);       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
	function single_row( $item ) {
		$class = '';
		if($item->direction_status == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns( $item );
		echo '</tr>';
	}	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'cid'     => __('ID','pn'),
			'title'     => __('Direction','pn'),
			'course_give' => __('Exchange rate 1','pn'),
			'course_get' => __('Exchange rate 2','pn'),
			'merchant' => __('Merchant','pn'),
			'paymerchant' => __('Automatic payouts','pn'),
			'status'    => __('Status','pn'),
        );
		$columns = apply_filters('directions_manage_ap_columns', $columns);
        return $columns;
    }	
	
    function get_sortable_columns() {
        $sortable_columns = array( 
			'course_give'     => array('course_give',false),
			'course_get'     => array('course_get',false),
			'cid' => array('cid',false),
        );
        return $sortable_columns;
    }
	
    function get_bulk_actions() {
        $actions = array(
			'active'    => __('Activate','pn'),
			'notactive'    => __('Deactivate','pn'),
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_directions_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$oby = is_param_get('orderby');
		if($oby == 'course_give'){
			$orderby = '(course_give -0.0)';
		} elseif($oby == 'course_get'){
			$orderby = '(course_get -0.0)';
		} else {
		    $orderby = 'id';
		}
		$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc';
		if($order != 'asc'){ $order = 'desc'; }		
		
		$where = '';
		
        $mod = intval(is_param_get('mod'));
        if($mod == 1){ 
            $where .= " AND direction_status='1'"; 
		} elseif($mod == 2){
			$where .= " AND direction_status='0'";
		}		
		
        $curr_give = intval(is_param_get('curr_give'));
        if($curr_give > 0){ 
            $where .= " AND currency_id_give = '$curr_give'"; 
		}
        $curr_get = intval(is_param_get('curr_get'));
        if($curr_get > 0){ 
            $where .= " AND currency_id_get = '$curr_get'"; 
		}		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status = '1' $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }
	
	function extra_tablenav( $which ) {
 		global $wpdb;
		
		$currency = apply_filters('list_currency_manage', array(), __('All currency','pn'));	
    ?>
		<div class="alignleft actions">
<?php   
		if ( 'top' == $which ) {
			$curr_give = intval(is_param_get('curr_give'));
			$curr_get = intval(is_param_get('curr_get'));
?>
			<select name="curr_give" autocomplete="off">
            <?php
				foreach($currency as $currency_key => $currency_title){
					echo "\t<option value='" . $currency_key . "' " . selected($currency_key, $curr_give, false ) . ">". $currency_title ."</option>\n";
			    }
			?>
			</select>
			
			<input type="submit" name="back_filter" class="back_filter" value="">
			
			<select name="curr_get" autocomplete="off">
            <?php
				foreach($currency as $currency_key => $currency_title){
					echo "\t<option value='" . $currency_key . "' " . selected($currency_key, $curr_get, false ) . ">". $currency_title ."</option>\n";
			    }
			?>
			</select>			
			<input type="submit" name="filter" class="button" value="<?php _e('Filter','pn'); ?>">
<?php
		}
    ?>
	    </div>	
	
		<div class="alignleft actions">
			<input type="submit" name="save" class="button" value="<?php _e('Save','pn'); ?>">
            <a href="<?php echo admin_url('admin.php?page=pn_add_directions');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php  
	}	  
	
}

add_action('premium_screen_pn_directions','my_myscreen_pn_directions');
function my_myscreen_pn_directions(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_directions_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_directions_List_Table')){
		new trev_directions_List_Table;
	}
} 