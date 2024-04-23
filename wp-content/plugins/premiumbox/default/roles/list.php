<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_roles', 'pn_admin_title_pn_roles');
function pn_admin_title_pn_roles(){
	_e('User roles','pn');
}

add_action('pn_adminpage_content_pn_roles','def_pn_admin_content_pn_roles');
function def_pn_admin_content_pn_roles(){
	if(class_exists('pn_user_roles_List_Table')){ 
		$Table = new pn_user_roles_List_Table();
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

add_action('premium_action_pn_roles','def_premium_action_pn_roles');
function def_premium_action_pn_roles(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));	

	$reply = '';
	$action = get_admin_action();
		
		if(isset($_POST['id']) and is_array($_POST['id'])){				
				
			if($action=='delete'){
				foreach($_POST['id'] as $id){
					$name = is_user_role_name($id);
					if($name){
						if($name != 'administrator' and $name != 'users'){
							remove_role($name);
						} 
					}					
					
				}
				$reply = '&reply=true';
			}
					
		} 
				
	$url = pn_back_action_link($reply);
	wp_redirect($url);
	exit;			
}

class pn_user_roles_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
		if($column_name == 'role_name'){
			return is_isset($item, 'name');		
		} 
    }	
	
    function column_cb($item){
		$name = is_isset($item, 'name');
		if($name != 'administrator' and $name != 'users'){
			return sprintf(
				'<input type="checkbox" name="%1$s[]" value="%2$s" />',
				$this->_args['singular'], 
				is_isset($item, 'name')                
			);
		}
    }	

    function column_title($item){

        $actions = array(
            'edit' => '<a href="'. admin_url('admin.php?page=pn_add_roles&item_key='. is_isset($item, 'name')) .'">'. __('Edit','pn') .'</a>',
        );
  		$primary = pn_strip_input(is_isset($item, 'title'));       
        
		return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
    }	
	
    function get_columns(){
		
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Role name','pn'),
			'role_name'     => __('System role name','pn'),
        );
		
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
		
        $per_page = $this->get_items_per_page('pn_user_roles_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$start_items = array();
		
		global $wp_roles;
		if (!isset($wp_roles)){
			$wp_roles = new WP_Roles();
		}		
		if(isset($wp_roles)){
			foreach($wp_roles->role_names as $role => $name){
				$start_items[] = array(
					'title' => $name,
					'name' => is_user_role_name($role),
				);
			}
		}
			
		$items = array_slice($start_items, $offset, $per_page);

        $total_items = count($start_items);
        $this->items = $items;		
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }
	
	function extra_tablenav($which){		  	
	?>
		<div class="alignleft actions">
            <a href="<?php echo admin_url('admin.php?page=pn_add_roles');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php 
	}	  
	
}

add_action('premium_screen_pn_roles','my_myscreen_pn_roles');
function my_myscreen_pn_roles() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'pn_user_roles_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('pn_user_roles_List_Table')){
		new pn_user_roles_List_Table;
	}
}