<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_currency_codes', 'pn_admin_title_pn_currency_codes');
function pn_admin_title_pn_currency_codes(){
	_e('Currency codes','pn');
}

add_action('pn_adminpage_content_pn_currency_codes','def_pn_admin_content_pn_currency_codes');
function def_pn_admin_content_pn_currency_codes(){

	if(class_exists('trev_currency_codes_List_Table')){  
		$Table = new trev_currency_codes_List_Table();
		$Table->prepare_items();
		
		pn_admin_searchbox(array(), 'reply');
		
		pn_admin_submenu(array(), 'reply');
?>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
	<style>
	.column-cid{ width: 80px!important; }
	</style>
<?php 
	} else {
		echo 'Class not found';
	}
}

add_action('premium_action_pn_currency_codes','def_premium_action_pn_currency_codes');
function def_premium_action_pn_currency_codes(){
global $wpdb;
	
	only_post();
	
	pn_only_caps(array('administrator','pn_vtypes'));
	
	$reply = '';
	$action = get_admin_action();
	if(isset($_POST['save'])){
				
		if(isset($_POST['internal_rate']) and is_array($_POST['internal_rate'])){
			foreach($_POST['internal_rate'] as $id => $internal_rate){
				$id = intval($id);
				$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency_codes WHERE auto_status = '1' AND id='$id'");
				if(isset($item->id)){
					$internal_rate = is_sum($internal_rate);
					if($internal_rate <= 0){ $internal_rate = 1; }
							
					$arr = array();				
					if($internal_rate != $item->internal_rate){
						$arr['internal_rate'] = $internal_rate;
					}
					if(count($arr) > 0){
						$arr['edit_date'] = current_time('mysql');
						$wpdb->update($wpdb->prefix.'currency_codes', $arr, array('id'=>$id));
						do_action('currency_code_change_course', $id, $item, $internal_rate, 'edit_list_currency');
					}					
				}
			}
		}				
				
		do_action('pn_currency_codes_save');
		$reply = '&reply=true';
		
	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){				
			if($action == 'delete'){
				foreach($_POST['id'] as $id){
					$id = intval($id);		
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."currency_codes WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_currency_code_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."currency_codes WHERE id = '$id'");
						do_action('pn_currency_code_delete', $id, $item);
						if($result){
							do_action('pn_currency_code_delete_after', $id, $item);
						}
					}
				}		
			}
			do_action('pn_currency_codes_action', $action, $_POST['id']);
			$reply = '&reply=true';
		} 
	}
					
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_currency_codes_List_Table extends WP_List_Table {

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
		} elseif($column_name == 'reserve'){
			return get_sum_color(get_reserv_currency_code($item->id));
		} elseif($column_name == 'od'){	
		    return '<input type="text" style="width: 100px;" name="internal_rate['. $item->id .']" value="'. is_sum($item->internal_rate) .'" />';			
		} 
		return apply_filters('currency_codes_manage_ap_col', '', $column_name,$item);
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_currency_codes&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
  		$primary = apply_filters('currency_codes_manage_ap_primary', is_site_value($item->currency_code_title), $item);
		$actions = apply_filters('currency_codes_manage_ap_actions', $actions, $item);        
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'cid' => __('ID','pn'),
			'title'     => __('Currency code','pn'),
			'reserve'     => __('Reserve','pn'),
			'od'    => __('Internal rate per','pn'). ' 1 '. cur_type() .'',
        );
		$columns = apply_filters('currency_codes_manage_ap_columns', $columns);
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
			'cid'     => array('cid',false),
            'title'     => array('title',false),
			'od'     => array('od',false),
        );
        return $sortable_columns;
    }	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_currency_codes_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$oby = is_param_get('orderby');
		if($oby == 'title'){
		    $orderby = 'currency_codes_title';
		} elseif($oby == 'od'){
			$orderby = '(internal_rate -0.0)';
		} else {
		    $orderby = 'id';
		}
		$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc';		
		if($order != 'asc'){ $order = 'desc'; }
		
		$where = '';
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_codes WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency_codes WHERE auto_status = '1' $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_currency_codes');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
}


add_action('premium_screen_pn_currency_codes','my_myscreen_pn_currency_codes');
function my_myscreen_pn_currency_codes(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_currency_codes_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_currency_codes_List_Table')){
		new trev_currency_codes_List_Table;
	}
}