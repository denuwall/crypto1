<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_currency_reserv', 'pn_admin_title_pn_currency_reserv');
function pn_admin_title_pn_currency_reserv(){
	_e('Reserve adjustment','pn');
}

add_action('pn_adminpage_content_pn_currency_reserv','def_pn_admin_content_pn_currency_reserv');
function def_pn_admin_content_pn_currency_reserv(){
	if(class_exists('trev_currency_reserv_List_Table')){  
		$Table = new trev_currency_reserv_List_Table();
		$Table->prepare_items();
		
		$search = array();
		
		$currencies = apply_filters('list_currency_manage', array(), __('All currency','pn'));
		$search[] = array(
			'view' => 'select',
			'title' => __('Currency','pn'),
			'default' => intval(is_param_get('currency_id')),
			'options' => $currencies,
			'name' => 'currency_id',
		);			
		pn_admin_searchbox($search, 'reply');		
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('expenditure','pn'),
				'2' => __('income','pn'),
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


add_action('premium_action_pn_currency_reserv','def_premium_action_pn_currency_reserv');
function def_premium_action_pn_currency_reserv(){
global $wpdb, $user_ID;

	only_post();
	pn_only_caps(array('administrator','pn_currency_reserv'));
	
	$reply = '';
	$action = get_admin_action();
			
	if(isset($_POST['save'])){
		
		do_action('pn_currency_reserv_save');
		$reply = '&reply=true';
		
	} else {			
		if(isset($_POST['id']) and is_array($_POST['id'])){					
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$item = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency_reserv WHERE id='$id'");
					if(isset($item->id)){	
						do_action('pn_currency_reserv_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."currency_reserv WHERE id = '$id'");
						do_action('pn_currency_reserv_delete', $id, $item);
						if($result){
							do_action('pn_currency_reserv_delete_after', $id, $item);
						}		
					}
				}	
			}
			
			do_action('pn_currency_reserv_action', $action, $_POST['id']);
			$reply = '&reply=true';
		}
	}	
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_currency_reserv_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'sum'){
			return get_sum_color($item->trans_sum);
		} elseif($column_name == 'create'){
			return get_mytime($item->create_date,'d.m.Y H:i');	
		} elseif($column_name == 'edit'){
			return get_mytime($item->edit_date,'d.m.Y H:i');		
		} elseif($column_name == 'currency'){
			return get_currency_title_by_id($item->currency_id, __('No item','pn'));
		} elseif($column_name == 'creator'){
			
			$user_id = $item->user_creator;
			$us = '';
			if($user_id > 0){
				$ui = get_userdata($user_id);
				$us .='<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">';
				if(isset($ui->user_login)){
					$us .= is_user($ui->user_login); 
				}
				$us .='</a>';
			}
			
		    return $us;
			
		} elseif($column_name == 'editor'){
			
			$user_id = $item->user_editor;
			$us = '';
			if($user_id > 0){
				$ui = get_userdata($user_id);
		        $us .='<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">';
				if(isset($ui->user_login)){
					$us .= is_user($ui->user_login); 
				}
		        $us .='</a>';
			}
			
		    return $us;
			
		} 
		return apply_filters('currency_reserv_manage_ap_col', '', $column_name,$item);
		
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_currency_reserv&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
 		$primary = apply_filters('currency_reserv_manage_ap_primary', pn_strip_input($item->trans_title), $item);
		$actions = apply_filters('currency_reserv_manage_ap_actions', $actions, $item);	       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Comment','pn'),
			'currency' => __('Currency name','pn'),
			'sum' => __('Amount','pn'),
			'create' => __('Creation date','pn'),
			'creator' => __('Created by','pn'),
			'edit' => __('Edit date','pn'),
			'editor' => __('Edited by','pn'),
        );
		$columns = apply_filters('currency_reserv_manage_ap_columns', $columns);
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
			'create'     => array('create',false),
			'edit'     => array('edit',false),
			'sum'     => array('sum',false),
        );
        return $sortable_columns;
    }	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_currency_reserv_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$oby = is_param_get('orderby');
		if($oby == 'sum'){
		    $orderby = '(trans_sum -0.0)';
		} elseif($oby == 'create'){
			$orderby = 'trans_create';
		} elseif($oby == 'edit'){
			$orderby = 'trans_edit';			
		} else {
		    $orderby = 'id';
	    }
		$order = is_param_get('order');
		if($order != 'asc'){ $order = 'desc'; }			
		
		$where = '';
		
        $mod = intval(is_param_get('mod'));
        if($mod == 2){ 
            $where .= " AND trans_sum > 0"; 
		} elseif($mod == 1){
			$where .= " AND trans_sum <= 0";
		}		
		
        $currency_id = intval(is_param_get('currency_id'));
        if($currency_id > 0){ 
            $where .= " AND currency_id = '$currency_id'"; 
		}		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_reserv WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency_reserv WHERE auto_status = '1' $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_currency_reserv');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php 
	}	
	
}

add_action('premium_screen_pn_currency_reserv','my_myscreen_pn_currency_reserv');
function my_myscreen_pn_currency_reserv(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_currency_reserv_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_currency_reserv_List_Table')){
		new trev_currency_reserv_List_Table;
	}
} 
