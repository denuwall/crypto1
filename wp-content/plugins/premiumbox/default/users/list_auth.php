<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_alogs', 'pn_adminpage_title_pn_alogs');
function pn_adminpage_title_pn_alogs(){
	_e('Authorization log','pn');
}

add_action('pn_adminpage_content_pn_alogs','def_pn_adminpage_content_pn_alogs');
function def_pn_adminpage_content_pn_alogs(){

	if(class_exists('trev_alogs_List_Table')){  
		$Table = new trev_alogs_List_Table();
		$Table->prepare_items();
		
		$search = array();
		$search[] = array(
			'view' => 'input',
			'title' => __('User','pn'),
			'default' => pn_strip_input(is_param_get('user')),
			'name' => 'user',
		);		
		$search[] = array(
			'view' => 'date',
			'title' => __('Start date','pn'),
			'default' => is_my_date(is_param_get('date1')),
			'name' => 'date1',
		);
		$search[] = array(
			'view' => 'date',
			'title' => __('End date','pn'),
			'default' => is_my_date(is_param_get('date2')),
			'name' => 'date2',
		);		
		pn_admin_searchbox($search, 'reply');
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('successful authentication','pn'),
				'2' => __('unsuccessful authentication','pn'),
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


add_action('premium_action_pn_alogs','def_premium_action_pn_alogs');
function def_premium_action_pn_alogs(){
global $wpdb;
	
	only_post();
	pn_only_caps(array('administrator'));
	
	$reply = '';
	$action = get_admin_action();

	if(isset($_POST['save'])){
						
		do_action('pn_alogs_save');
		$reply = '&reply=true';

	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){
			do_action('pn_alogs_action', $action, $_POST['id']);
			$reply = '&reply=true';
		}
 	}	
		
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_alogs_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
		if($column_name == 'cuser'){
			$user_id = $item->user_id;
			$us = '';
			if($user_id > 0){
		        $us .='<a href="'. admin_url("user-edit.php?user_id=". $user_id) .'">';
				$us .= is_user($item->user_login); 
		        $us .='</a>';
			} 
		    return $us;	
		} elseif($column_name == 'cbrowser'){
		    return get_browser_name($item->now_user_browser, __('Unknown','pn'));
		} elseif($column_name == 'cip'){	
			return pn_strip_input($item->now_user_ip);
		} elseif($column_name == 'old_cbrowser'){
		    return get_browser_name($item->old_user_browser, __('Unknown','pn'));
		} elseif($column_name == 'old_cip'){	
			return pn_strip_input($item->old_user_ip);
		} elseif($column_name == 'status'){	
		    if($item->auth_status == 0){ 
			    return '<span class="bred">'. pn_strip_input($item->auth_status_text) .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('successful authentication','pn') .'</span>'; 
			}			
		}
		return apply_filters('alogs_manage_ap_col', '', $column_name,$item);
    }		
	
    function column_title($item){

        $actions = array();
		$primary = apply_filters('alogs_manage_ap_primary', get_mytime($item->auth_date, "d.m.Y, H:i:s"), $item);
		$actions = apply_filters('alogs_manage_ap_actions', $actions, $item);
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(         
			'title'     => __('Date','pn'),
			'cuser'    => __('User','pn'),
			'cip'    => __('Current IP address','pn'),
			'cbrowser'  => __('Current browser','pn'),
			'old_cip'    => __('Previous IP address','pn'),
			'old_cbrowser'  => __('Previous browser','pn'),	
			'status'  => __('Status','pn'),
        );
		$columns = apply_filters('alogs_manage_ap_columns', $columns);
        return $columns;
    }		
    
	function single_row( $item ) {
		$class = '';
		if($item->auth_status == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns($item);
		echo '</tr>';
	}	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_alogs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;		
		
		$where = '';
		
		$user = pn_sfilter(pn_strip_input(is_param_get('user')));
		if($user){
			$where .= " AND user_login LIKE '%$user%'";
		}
		
		$date1 = is_my_date(is_param_get('date1'));
		if($date1){
			$date = get_mydate($date1, 'Y-m-d');
			$where .= " AND auth_date >= '$date'";
		}
		
		$date2 = is_my_date(is_param_get('date2'));
		if($date2){
			$date = get_mydate($date2, 'Y-m-d');
			$where .= " AND auth_date < '$date'";
		}

		$mod = intval(is_param_get('mod'));
		if($mod == 1){
			$where .= " AND auth_status = '1'";
		} elseif($mod == 2){
			$where .= " AND auth_status = '0'";
		}		
		
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."auth_logs WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."auth_logs WHERE id > 0 $where ORDER BY auth_date DESC LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }	  
}


add_action('premium_screen_pn_alogs','my_premium_screen_pn_alogs');
function my_premium_screen_pn_alogs() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_alogs_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_alogs_List_Table')){
		new trev_alogs_List_Table;
	}
} 