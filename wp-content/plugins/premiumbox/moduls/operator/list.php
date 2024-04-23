<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_schedule_operators', 'def_adminpage_title_pn_schedule_operators');
function def_adminpage_title_pn_schedule_operators(){
	_e('Schedules','pn');
}

add_action('pn_adminpage_content_pn_schedule_operators','def_pn_adminpage_content_pn_schedule_operators');
function def_pn_adminpage_content_pn_schedule_operators(){

	if(class_exists('trev_schedule_operators_List_Table')){ 
		$Table = new trev_schedule_operators_List_Table();
		$Table->prepare_items();
		
		pn_admin_searchbox(array(), 'reply');
		
		pn_admin_submenu(array(), 'reply'); 
?>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>	
<?php 
	} else {
		echo 'Class not found';
	}
}


add_action('premium_action_pn_schedule_operators','def_premium_action_pn_schedule_operators');
function def_premium_action_pn_schedule_operators(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$reply = '';
	$action = get_admin_action();
	if(isset($_POST['save'])){
						
		do_action('pn_schedule_operators_save');
		$reply = '&reply=true';

	} else {	
		if(isset($_POST['id']) and is_array($_POST['id'])){					
			if($action == 'delete'){						
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."schedule_operators WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_schedule_operators_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."schedule_operators WHERE id = '$id'");
						do_action('pn_schedule_operators_delete', $id, $item);
						if($result){
							do_action('pn_schedule_operators_delete_after', $id, $item);
						}
					}
				}
			}
			do_action('pn_schedule_operators_action', $action, $_POST['id']);
			$reply = '&reply=true';			
		}
	}	
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_schedule_operators_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'ctime'){
			return $item->h1 .':'. $item->m1 .'-'. $item->h2 .':'. $item->m2;
		} elseif($column_name == 'cdays'){
			$days = array(
				'd1' => __('monday','pn'),
				'd2' => __('tuesday','pn'),
				'd3' => __('wednesday','pn'),
				'd4' => __('thursday','pn'),
				'd5' => __('friday','pn'),
				'd6' => '<span class="bred">'. __('saturday','pn') .'</span>',
				'd7' => '<span class="bred">'. __('sunday','pn') .'</span>',
			);
			$ndays = array();
			foreach($days as $k => $v){
				if(is_isset($item, $k) == 1){
					$ndays[] = $v;
				}
			}
		
			echo join(', ',$ndays);
		} 
		return apply_filters('schedule_operators_manage_ap_col', '', $column_name,$item);
		
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item->id                
        );
    }	

    function column_title($item){
	global $premiumbox;
	
        $actions = array(
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_schedule_operators&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
 		$primary = apply_filters('schedule_operators_manage_ap_primary', pn_strip_text(ctv_ml($premiumbox->get_option('statuswork','text'. $item->status))), $item);
		$actions = apply_filters('schedule_operators_manage_ap_actions', $actions, $item);       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Status','pn'),
			'ctime'     => __('Work time','pn'),
			'cdays'     => __('Work days','pn'),
        );
		$columns = apply_filters('schedule_operators_manage_ap_columns', $columns);
        return $columns;
    }	
	

    function get_bulk_actions() {
        $actions = array(
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_schedule_operators_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$where = pn_admin_search_where('');
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."schedule_operators WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."schedule_operators WHERE auto_status = '1' $where ORDER BY id DESC LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }
	
	function extra_tablenav($which){
    ?>
		<div class="alignleft actions">
			<input type="submit" name="save" class="button" value="<?php _e('Save','pn'); ?>">
            <a href="<?php echo admin_url('admin.php?page=pn_add_schedule_operators');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
	
}


add_action('premium_screen_pn_schedule_operators','my_premium_screen_pn_schedule_operators');
function my_premium_screen_pn_schedule_operators(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_schedule_operators_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_schedule_operators_List_Table')){
		new trev_schedule_operators_List_Table;
	}
}