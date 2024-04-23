<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_bidlogs', 'pn_admin_title_pn_bidlogs');
function pn_admin_title_pn_bidlogs(){
	_e('Orders status log','pn');
}

add_action('pn_adminpage_content_pn_bidlogs','def_pn_admin_content_pn_bidlogs');
function def_pn_admin_content_pn_bidlogs(){

	if(class_exists('trev_bidlogs_List_Table')){
		$Table = new trev_bidlogs_List_Table();
		$Table->prepare_items();
		
		$search = array();
		$search[] = array(
			'view' => 'input',
			'title' => __('User login','pn'),
			'default' => pn_strip_input(is_param_get('user')),
			'name' => 'user',
		);
		$search[] = array(
			'view' => 'input',
			'title' => __('User ID','pn'),
			'default' => pn_strip_input(is_param_get('user_id')),
			'name' => 'user_id',
		);		
		$search[] = array(
			'view' => 'input',
			'title' => __('Order ID','pn'),
			'default' => pn_strip_input(is_param_get('bid_id')),
			'name' => 'bid_id',
		);		
		pn_admin_searchbox($search, 'reply');		
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('in admin panel','pn'),
				'2' => __('on a website','pn'),
			),
			'title' => '',
		);		
		pn_admin_submenu($options, 'reply');		
?>

<style>
.column-title{ width: 150px!important; }
.column-bid{ width: 100px!important; }
.column-user{ width: 150px!important; }
</style>

	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
}

add_action('premium_action_pn_bidlogs','def_premium_action_pn_bidlogs');
function def_premium_action_pn_bidlogs(){
global $wpdb;	

	only_post();
	
	pn_only_caps(array('administrator','pn_bids'));

	$reply = '';
	$action = get_admin_action();
			
	if(isset($_POST['save'])){
						
		do_action('pn_bidlogs_save');
		$reply = '&reply=true';

	} else {
				
		if(isset($_POST['id']) and is_array($_POST['id'])){				
			
			do_action('pn_bidlogs_action', $action, $_POST['id']);
			$reply = '&reply=true';
		} 
				
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_bidlogs_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'user'){
			$user_id = $item->user_id;
		    $us = '<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">'. is_user($item->user_login) . '</a>';
			
		    return $us;
		} elseif($column_name == 'bid'){
			return '<a href="'. admin_url('admin.php?page=pn_bids&bidid='.$item->bid_id) .'" target="_blank">'. $item->bid_id .'</a>';
		} elseif($column_name == 'place'){	
			return '<strong>'. pn_strip_input($item->place) .'</strong>';
		} elseif($column_name == 'who'){	
			if($item->who == 'system'){
				return '<strong>'. __('System changed','pn') .'</strong>';
			} else {
				return '<strong>'. __('User changed','pn') .'</strong>';
			}			
		} elseif($column_name == 'status'){
			return bidlogs_status($item->old_status);
		} elseif($column_name == 'newstatus'){	
			return bidlogs_status($item->new_status);
		}
		
		return apply_filters('bidlogs_manage_ap_col', '', $column_name, $item);
    }	
	
    function column_title($item){

        $actions = array(
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_bids&bidid='.$item->bid_id) .'" target="_blank">'. __('Go to order','pn') .'</a>',
        );		
		
 		$primary = apply_filters('bidlogs_manage_ap_primary', get_mytime($item->createdate, 'd.m.Y H:i:s'), $item);
		$actions = apply_filters('bidlogs_manage_ap_actions', $actions, $item);		
		
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
    }	
	
    function get_columns(){
        $columns = array(         
			'title'     => __('Date','pn'),
			'user'    => __('User','pn'),
			'bid'    => __('Order ID','pn'),
			'place'    => __('Where made','pn'),
			'who'    => __('Who made','pn'),
            'status'  => __('Old status','pn'),
			'newstatus'  => __('New status','pn'),
        );
		$columns = apply_filters('bidlogs_manage_ap_columns', $columns);
        return $columns;
    }

    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_bidlogs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$where = '';

		$user_id = intval(is_param_get('user_id'));	
        if($user_id){ 
			$where .= " AND user_id='$user_id'";
		}
		
		$bid_id = intval(is_param_get('bid_id'));	
        if($bid_id){ 
			$where .= " AND bid_id='$bid_id'";
		}		
		
		$user = is_user(is_param_get('user'));
		if($user){
			$where .= " AND user_login LIKE '%$user%'";
		}
		
        $mod = intval(is_param_get('mod'));
        if($mod==1){ 
            $where .= " AND place = 'admin'";
		} elseif($mod==2) {
			$where .= " AND place = 'site'";
		} 		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bid_logs WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bid_logs WHERE id > 0 $where ORDER BY id DESC LIMIT $offset , $per_page");  		

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
		</div>		
	<?php 
	}		
	
}


add_action('premium_screen_pn_bidlogs','my_myscreen_pn_bidlogs');
function my_myscreen_pn_bidlogs() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_bidlogs_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_bidlogs_List_Table')){
		new trev_bidlogs_List_Table;
	}
}