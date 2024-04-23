<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_bcc', 'pn_admin_title_pn_bcc');
function pn_admin_title_pn_bcc(){
	_e('Confirmation log','pn');
}

add_action('pn_adminpage_content_pn_bcc','def_pn_admin_content_pn_bcc');
function def_pn_admin_content_pn_bcc(){

	if(class_exists('trev_bcc_List_Table')){
		$Table = new trev_bcc_List_Table();
		$Table->prepare_items();
		
		$search = array();	
		$search[] = array(
			'view' => 'input',
			'title' => __('Order ID','pn'),
			'default' => pn_strip_input(is_param_get('bid_id')),
			'name' => 'bid_id',
		);		
		pn_admin_searchbox($search, 'reply');				
?>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
} 

class trev_bcc_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'bid'){
			return '<a href="'. admin_url('admin.php?page=pn_bids&bidid='.$item->bid_id) .'" target="_blank">'. $item->bid_id .'</a>';
		} elseif($column_name == 'cc'){	
			return intval($item->counter);
		}
		
    }	
	
    function column_title($item){
        return get_mytime($item->createdate, 'd.m.Y H:i:s');
    }	
	
    function get_columns(){
        $columns = array(         
			'title'     => __('Date','pn'),
			'bid'    => __('Order ID','pn'),
			'cc'    => __('Confirmation order number','pn'),
        );
		
        return $columns;
    }

    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_bidlogs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$where = '';

		$bid_id = intval(is_param_get('bid_id'));	
        if($bid_id){ 
			$where .= " AND bid_id='$bid_id'";
		}		 		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcc_logs WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bcc_logs WHERE id > 0 $where ORDER BY createdate DESC LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }	  
	
}


add_action('premium_screen_pn_bcc','my_myscreen_pn_bcc');
function my_myscreen_pn_bcc() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_bcc_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_bcc_List_Table')){
		new trev_bcc_List_Table;
	}
}