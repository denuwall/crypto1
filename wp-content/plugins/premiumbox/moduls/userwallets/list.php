<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_userwallets', 'pn_adminpage_title_pn_userwallets');
function pn_adminpage_title_pn_userwallets(){
	_e('User accounts','pn');
}

add_action('pn_adminpage_content_pn_userwallets','def_pn_adminpage_content_pn_userwallets');
function def_pn_adminpage_content_pn_userwallets(){
	if(class_exists('trev_userwallets_List_Table')){ 
		$Table = new trev_userwallets_List_Table();
		$Table->prepare_items();
		
		$search = array();
		$search[] = array(
			'view' => 'input',
			'title' => __('User','pn'),
			'default' => pn_strip_input(is_param_get('user')),
			'name' => 'user',
		);
		$search[] = array(
			'view' => 'input',
			'title' => __('Account number','pn'),
			'default' => pn_strip_input(is_param_get('accountnum')),
			'name' => 'accountnum',
		);		
		$currency = apply_filters('list_currency_manage', array(), __('All currency','pn'));
		$search[] = array(
			'view' => 'select',
			'options' => $currency,
			'title' => __('Currency','pn'),
			'default' => intval(is_param_get('currency_id')),
			'name' => 'currency_id',
		);			
		pn_admin_searchbox($search, 'reply');		

		$options = array();		
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

add_action('premium_action_pn_userwallets','def_premium_action_pn_userwallets');
function def_premium_action_pn_userwallets(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_userwallets'));
	
	$reply = '';
	$action = get_admin_action();

	if(isset($_POST['save'])){
						
		do_action('pn_userwallets_save');
		$reply = '&reply=true';

	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){
		
			if($action == 'delete'){
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."user_wallets WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_userwallets_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ". $wpdb->prefix ."user_wallets WHERE id = '$id'");
						do_action('pn_userwallets_delete', $id, $item);
						if($result){
							do_action('pn_userwallets_delete_after', $id, $item);
						}
					}
				}
			}
			
			do_action('pn_userwallets_action', $action, $_POST['id']);
			$reply = '&reply=true';
		}
 	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
} 

class trev_userwallets_List_Table extends WP_List_Table {

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
		    $us = '<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">' . is_user($item->user_login) . '</a>'; 
			
		    return $us;	
		
		} elseif($column_name == 'cps'){ 	
			
			return get_currency_title_by_id($item->currency_id);		
		
		} 
		return apply_filters('userwallets_manage_ap_col', '', $column_name,$item);
		
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_userwallets&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
   		$primary = apply_filters('userwallets_manage_ap_primary', pn_strip_input($item->accountnum), $item);
		$actions = apply_filters('userwallets_manage_ap_actions', $actions, $item);       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',          
			'title'     => __('Account number','pn'),
			'user'    => __('User','pn'),
			'cps' => __('PS','pn'),
        );
		$columns = apply_filters('userwallets_manage_ap_columns', $columns);
        return $columns;
    }	
	
	function single_row( $item ) {
		$class = '';
		if(is_isset($item, 'verify') == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
		$this->single_row_columns( $item );
		echo '</tr>';
	}
	
    function get_bulk_actions() {
        $actions = array(
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_userwallets_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$where = '';

		$user = pn_sfilter(pn_strip_input(is_param_get('user')));
        if($user){ 
            $where .= " AND user_login LIKE '%$user%'";
		}

		$accountnum = pn_sfilter(pn_strip_input(is_param_get('accountnum')));
        if($accountnum){ 
            $where .= " AND accountnum LIKE '%$accountnum%'";
		}

		$currency_id = intval(is_param_get('currency_id'));
        if($currency_id){ 
            $where .= " AND currency_id = '$currency_id'";
		}		
				
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_wallets WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."user_wallets WHERE id > 0 $where ORDER BY id DESC LIMIT $offset , $per_page");  		
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
            <a href="<?php echo admin_url('admin.php?page=pn_add_userwallets');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
	
}

add_action('premium_screen_pn_userwallets','my_premium_screen_pn_userwallets');
function my_premium_screen_pn_userwallets() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_userwallets_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_userwallets_List_Table')){
		new trev_userwallets_List_Table;
	}
}