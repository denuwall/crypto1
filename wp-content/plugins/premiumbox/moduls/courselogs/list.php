<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_courselogs', 'pn_admin_title_pn_courselogs');
function pn_admin_title_pn_courselogs(){ 
	_e('Log of rates','pn');
}

add_action('pn_adminpage_content_pn_courselogs','def_pn_admin_content_pn_courselogs');
function def_pn_admin_content_pn_courselogs(){

	if(class_exists('trev_courselogs_List_Table')){  
		$Table = new trev_courselogs_List_Table();
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
			'title' => __('Exchange direction ID','pn'),
			'default' => pn_strip_input(is_param_get('direction_id')),
			'name' => 'direction_id',
		);		
		pn_admin_searchbox($search, 'reply');

		pn_admin_submenu(array(), 'reply');
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

add_action('premium_action_pn_courselogs','def_premium_action_pn_courselogs');
function def_premium_action_pn_courselogs(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$reply = '';
	$action = get_admin_action();

	if(isset($_POST['save'])){
						
		do_action('pn_courselogs_save');
		$reply = '&reply=true';

	} else {
		if(isset($_POST['id']) and is_array($_POST['id'])){
			
			do_action('pn_courselogs_action', $action, $_POST['id']);
			$reply = '&reply=true';
			
		}
 	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
}

class trev_courselogs_List_Table extends WP_List_Table {

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
			if($user_id){
				$us = '<a href="'. admin_url('user-edit.php?user_id='. $user_id) .'">'. is_user($item->user_login) . '</a>';
			
				return $us;
			}
		} elseif($column_name == 'naps'){
			return '<a href="'. admin_url('admin.php?page=pn_add_directions&item_id='.$item->naps_id) .'" target="_blank">'. $item->naps_id .'</a>';
		} elseif($column_name == 'old_curs'){	
			return is_sum($item->lcurs1) . '&rarr;' . is_sum($item->lcurs2);
		} elseif($column_name == 'new_curs'){	
			return is_sum($item->curs1) . '&rarr;' . is_sum($item->curs2);			
		} elseif($column_name == 'who'){	
			return pn_strip_input($item->who);			
		}
		
    }	
	
    function column_title($item){

        $actions = array(
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_courselogs&direction_id='.$item->naps_id) .'" target="_blank">'. __('Go to exchange direction','pn') .'</a>',
        );		
		
        return sprintf('%1$s %2$s',
            get_mytime($item->createdate, 'd.m.Y H:i:s'),
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(         
			'title'     => __('Date','pn'),
			'user'    => __('User','pn'),
			'naps'    => __('Exchange direction ID','pn'),
            'old_curs'  => __('Old rate','pn'),
			'new_curs'  => __('New rate','pn'),
			'who'    => __('Changed by','pn'),
        );
		
        return $columns;
    }

    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_courselogs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$where = '';

		$user_id = intval(is_param_get('user_id'));	
        if($user_id){ 
			$where .= " AND user_id='$user_id'";
		}
		
		$direction_id = intval(is_param_get('direction_id'));	
        if($direction_id){ 
			$where .= " AND naps_id='$direction_id'";
		}		
		
		$user = is_user(is_param_get('user'));
		if($user){
			$where .= " AND user_login LIKE '%$user%'";
		} 		
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."course_logs WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."course_logs WHERE id > 0 $where ORDER BY id DESC LIMIT $offset , $per_page");  		

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


add_action('premium_screen_pn_courselogs','my_myscreen_pn_courselogs');
function my_myscreen_pn_courselogs() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_courselogs_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_courselogs_List_Table')){
		new trev_courselogs_List_Table;
	}
}