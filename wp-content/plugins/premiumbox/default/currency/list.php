<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_currency', 'pn_admin_title_pn_currency');
function pn_admin_title_pn_currency(){
	_e('Currency','pn');
}

add_action('pn_adminpage_content_pn_currency','def_pn_admin_content_pn_currency');
function def_pn_admin_content_pn_currency(){

	if(class_exists('trev_currency_List_Table')){  
		$Table = new trev_currency_List_Table();
		$Table->prepare_items();
		
		$search = array();
		
		$currency_codes = apply_filters('list_currency_codes_manage', array(), __('All codes','pn'));
		$search[] = array(
			'view' => 'select',
			'title' => __('Code','pn'),
			'default' => intval(is_param_get('currency_code_id')),
			'options' => $currency_codes,
			'name' => 'currency_code_id',
		);	
		$psys = apply_filters('list_psys_manage', array(), __('All payment systems','pn'));	
		$search[] = array(
			'view' => 'select',
			'title' => __('Payment system','pn'),
			'default' => intval(is_param_get('psys_id')),
			'options' => $psys,
			'name' => 'psys_id',
		);		
		pn_admin_searchbox($search, 'reply');			
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('active currency','pn'),
				'2' => __('inactive currency','pn'),
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
		$(document).on('click', '.js_button_small', function(){
			var id = $(this).attr('data-id');
			var thet = $(this);
			thet.addClass('active');
			
			$('#premium_ajax').show();
			var dataString='id=' + id;
			
			$.ajax({
				type: "POST",
				url: "<?php pn_the_link_post('pn_currency_updatereserv'); ?>",
				dataType: 'json',
				data: dataString,
				error: function(res, res2, res3){
					<?php do_action('pn_js_error_response', 'ajax'); ?>
				},			
				success: function(res)
				{
					$('#premium_ajax').hide();	
					thet.removeClass('active');
					
					if(res['status'] == 'success'){
						$('.js_reserve_'+id).html(res['reserv']);
					}
					
				}
			});
		
			return false;
		});		
	});
	</script>	
<?php 
	} else {
		echo 'Class not found';
	}
}

add_action('premium_action_pn_currency_updatereserv', 'pn_premium_action_pn_currency_updatereserv');
function pn_premium_action_pn_currency_updatereserv(){
global $wpdb;

	only_post();
	$log = array();
	$log['status'] = 'error';
	$log['status_code'] = 1;
	$log['status_text'] = '';
	
	if(current_user_can('administrator') or current_user_can('pn_currency')){
		$data_id = intval(is_param_post('id'));
		if($data_id){
			
			if(function_exists('update_currency_reserv')){ 
				update_currency_reserv($data_id);
			}
			$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency WHERE id='$data_id' AND auto_status='1'");
			if(isset($item->id)){
				$log['status'] = 'success';
				$log['reserv'] = get_sum_color(is_sum($item->currency_reserv, $item->currency_decimal));
			}
			
		}	
	}  		
		
	echo json_encode($log);
	exit;	
}


add_action('premium_action_pn_currency','def_premium_action_pn_currency');
function def_premium_action_pn_currency(){
global $wpdb;	

	only_post();
	
	pn_only_caps(array('administrator','pn_currency'));

	$reply = '';
	$action = get_admin_action();
			
	if(isset($_POST['save'])){
				
		if(isset($_POST['currency_decimal']) and is_array($_POST['currency_decimal'])){
			foreach($_POST['currency_decimal'] as $id => $currency_decimal){
				$id = intval($id);
				$currency_decimal = intval($currency_decimal);
				if($currency_decimal < 0){ $currency_decimal = 8; }
							
				$wpdb->query("UPDATE ".$wpdb->prefix."currency SET currency_decimal = '$currency_decimal' WHERE id = '$id'");
			}
		}										
				
		do_action('pn_currency_save');
		$reply = '&reply=true';

	} else {
				
		if(isset($_POST['id']) and is_array($_POST['id'])){				
				
			if($action == 'active'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency WHERE id='$id' AND currency_status != '1'");
					if(isset($item->id)){
						do_action('pn_currency_active_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."currency SET currency_status = '1' WHERE id = '$id'");
						do_action('pn_currency_active', $id, $item);
						if($result){
							do_action('pn_currency_active_after', $id, $item);
						}
					}
				}	
			}

			if($action == 'notactive'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency WHERE id='$id' AND currency_status != '0'");
					if(isset($item->id)){
						do_action('pn_currency_notactive_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."currency SET currency_status = '0' WHERE id = '$id'");
						do_action('pn_currency_notactive', $id, $item);
						if($result){
							do_action('pn_currency_notactive_after', $id, $item);
						}
					}
				}
			}					
				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_currency_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."currency WHERE id = '$id'");
						do_action('pn_currency_delete', $id, $item);
						if($result){
							do_action('pn_currency_delete_after', $id, $item);
						}
					}
				}		
			}
			
			do_action('pn_currency_action', $action, $_POST['id']);
			$reply = '&reply=true';
		} 
				
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_currency_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'cid'){
			return $item->id;
		} elseif($column_name == 'code'){
			return is_site_value($item->currency_code_title);		
		} elseif($column_name == 'xml_value'){
			return is_xml_value($item->xml_value);		
		} elseif($column_name == 'reserve'){
			$html = '
			<div class="js_reserve_'. $item->id .'">'. get_sum_color(is_sum($item->currency_reserv, $item->currency_decimal)) .'</div>
			<a href="#" data-id="'. $item->id .'" class="js_button_small">'. __('Update','pn') .'</a><div class="premium_clear"></div>
			';	
			return $html;
		} elseif($column_name == 'received'){
			return is_sum(get_currency_in($item->id), $item->currency_decimal);
		} elseif($column_name == 'issued'){
			return is_sum(get_currency_out($item->id), $item->currency_decimal);		
		} elseif($column_name == 'decimal'){		
		    return '<input type="text" style="width: 50px;" name="currency_decimal['. $item->id .']" value="'. intval($item->currency_decimal) .'" />';				
		} elseif($column_name == 'status'){	
		    if($item->currency_status == 0){ 
			    return '<span class="bred">'. __('inactive currency','pn') .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('active currency','pn') .'</span>'; 
			}			
		} 
		return apply_filters('currency_manage_ap_col', '', $column_name, $item);
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_currency&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
 		$primary = apply_filters('currency_manage_ap_primary', pn_strip_input(ctv_ml($item->psys_title)), $item);
		$actions = apply_filters('currency_manage_ap_actions', $actions, $item);	       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'cid'     => __('ID','pn'),
			'title'     => __('Currency name','pn'),
			'code' => __('Currency code','pn'),
			'reserve' => __('Reserve','pn'),
			'received' => __('Received','pn').' &larr;',
			'issued' => __('Sent','pn').' &rarr;',
			'decimal' => __('Amount of Decimal places','pn'),
			'xml_value' => __('XML name','pn'),
			'status'    => __('Status','pn'),
        );
		$columns = apply_filters('currency_manage_ap_columns', $columns);
        return $columns;
    }	
	
	function single_row( $item ) {
		$class = '';
		if($item->currency_status == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns( $item );
		echo '</tr>';
	}
	
    function get_bulk_actions() {
        $actions = array(
			'active'    => __('Activate','pn'),
			'notactive'    => __('Deactivate','pn'),
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function get_sortable_columns() {
        $sortable_columns = array( 
			'cid'     => array('cid',false),
            'title'     => array('title',false),
			'code'     => array('code',false),
        );
        return $sortable_columns;
    }	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_currency_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$oby = is_param_get('orderby');
		if($oby == 'title'){
		    $orderby = 'psys_title';
		} elseif($oby == 'code'){	
			$orderby = 'currency_code_title';
		} elseif($oby == 'cid'){	
			$orderby = 'id';			
		} else {
		    $orderby = 'site_order';
		}
		$order = is_param_get('order');		
		if($order != 'desc'){ $order = 'asc'; }		
		
		$where = '';
		
        $mod = intval(is_param_get('mod'));
        if($mod == 1){ 
            $where .= " AND currency_status='1'"; 
		} elseif($mod == 2){
			$where .= " AND currency_status='0'";
		}		
		
        $currency_code_id = intval(is_param_get('currency_code_id'));
        if($currency_code_id > 0){ 
            $where .= " AND currency_code_id='$currency_code_id'"; 
		}
		
        $psys_id = intval(is_param_get('psys_id'));
        if($psys_id > 0){ 
            $where .= " AND psys_id='$psys_id'"; 
		}		
		
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_currency');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php 
	}	  
	
}

add_action('premium_screen_pn_currency','my_myscreen_pn_currency');
function my_myscreen_pn_currency(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_currency_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_currency_List_Table')){
		new trev_currency_List_Table;
	}
}