<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_discount', 'pn_adminpage_title_pn_discount');
function pn_adminpage_title_pn_discount(){
	_e('User discounts','pn');
}

add_action('pn_adminpage_content_pn_discount','def_pn_adminpage_content_pn_discount');
function def_pn_adminpage_content_pn_discount(){

	if(class_exists('trev_discount_List_Table')){  
		$Table = new trev_discount_List_Table();
		$Table->prepare_items();
		
		pn_admin_searchbox(array(), 'reply');	
		
		pn_admin_submenu(array(), 'reply');
?>
	<div class="premium_clear"></div>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
}


add_action('premium_action_pn_discount','def_premium_action_pn_discount');
function def_premium_action_pn_discount(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_discount'));
	
	$reply = '';
	$action = get_admin_action();
	if(isset($_POST['save'])){
						
		do_action('pn_discount_save');
		$reply = '&reply=true';

	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."user_discounts WHERE id='$id'");
					if(isset($item->id)){	
						do_action('pn_discount_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."user_discounts WHERE id = '$id'");
						do_action('pn_discount_delete', $id, $item);
						if($result){
							do_action('pn_discount_delete_after', $id, $item);
						}
					}	
				}			
			}	
			do_action('pn_discount_action', $action, $_POST['id']);
			$reply = '&reply=true';
		}
	}	
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_discount_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'discount'){
			
		    return is_sum($item->discount) . '%';	
			
		} 
		
		return apply_filters('discount_manage_ap_col', '', $column_name,$item);
		
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_discount&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
        
		$primary = apply_filters('discount_manage_ap_primary', '>' . is_sum($item->sumec), $item);
		$actions = apply_filters('discount_manage_ap_actions', $actions, $item);
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',          
			'title'     => __('Total amount of exchanges (in USD)','pn'),
			'discount'    => __('Discount (%)','pn'),
        );
		$columns = apply_filters('discount_manage_ap_columns', $columns);
        return $columns;
    }	
	
    function get_bulk_actions() {
        $actions = array(
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
	
    function get_sortable_columns() {
        $sortable_columns = array( 
			'discount'     => array('discount',false),
            'title'     => array('title',false),
        );
        return $sortable_columns;
    }	
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_discount_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$oby = is_param_get('orderby');
		if($oby == 'title'){
		    $orderby = '(sumec -0.0)';
		} else {
		    $orderby = '(discount -0.0)';
		}
		$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc';		
		if($order != 'asc'){ $order = 'desc'; }		

		$where = pn_admin_search_where('');
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_discounts WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."user_discounts WHERE id > 0 $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_discount');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
	
}

add_action('premium_screen_pn_discount','my_premium_screen_pn_discount');
function my_premium_screen_pn_discount() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_discount_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_discount_List_Table')){
		new trev_discount_List_Table;
	}
}