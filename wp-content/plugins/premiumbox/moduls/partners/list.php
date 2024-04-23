<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_partners', 'pn_adminpage_title_pn_partners');
function pn_adminpage_title_pn_partners(){
	_e('Partners','pn');
}

add_action('pn_adminpage_content_pn_partners','def_pn_adminpage_content_pn_partners');
function def_pn_adminpage_content_pn_partners(){

	if(class_exists('trev_partners_List_Table')){  
		$Table = new trev_partners_List_Table();
		$Table->prepare_items();
		
		pn_admin_searchbox(array(), 'reply');
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('published','pn'),
				'2' => __('moderating','pn'),
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


add_action('premium_action_pn_partners','def_premium_action_pn_partners');
function def_premium_action_pn_partners(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$reply = '';
	$action = get_admin_action();
	
	if(isset($_POST['save'])){
						
		do_action('pn_partners_save');
		$reply = '&reply=true';

	} else {	
		if(isset($_POST['id']) and is_array($_POST['id'])){

			if($action == 'approve'){	
				foreach($_POST['id'] as $id){
					$id = intval($id);	
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."partners WHERE id='$id' AND status != '1'");
					if(isset($item->id)){
						do_action('pn_partners_approve_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."partners SET status = '1' WHERE id = '$id'");
						do_action('pn_partners_approve', $id, $item);
						if($result){
							do_action('pn_partners_approve_after', $id, $item);
						}
					}		
				}		
			}

			if($action == 'unapprove'){	
				foreach($_POST['id'] as $id){
					$id = intval($id);	
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."partners WHERE id='$id' AND status != '0'");
					if(isset($item->id)){	
						do_action('pn_partners_unapprove_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."partners SET status = '0' WHERE id = '$id'");
						do_action('pn_partners_unapprove', $id, $item);
						if($result){
							do_action('pn_partners_unapprove_after', $id, $item);
						}					
					}
				}		
			}	
		
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."partners WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_partners_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."partners WHERE id = '$id'");
						do_action('pn_partners_delete', $id, $item);
						if($result){
							do_action('pn_partners_delete_after', $id, $item);
						}
					}
				}		
			}
			
			do_action('pn_partners_action', $action, $_POST['id']);
			$reply = '&reply=true';		
		} 
	}

	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;			
}

class trev_partners_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'cimage'){
			$img = pn_strip_input($item->img);
			if($img){
				return '<img src="'. $img .'" alt="" />';	
			}	
		} elseif($column_name == 'status'){
		    if($item->status == '0'){ 
			    return '<span class="bred">'. __('moderating','pn') .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('published','pn') .'</span>'; 
			}	
		}
		return apply_filters('partners_manage_ap_col', '', $column_name,$item);
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_partners&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
 		$primary = apply_filters('partners_manage_ap_primary', pn_strip_input(ctv_ml($item->title)), $item);
		$actions = apply_filters('partners_manage_ap_actions', $actions, $item);       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',          
			'title'     => __('Title','pn'),
			'cimage'    => __('Logo','pn'),
			'status'  => __('Status','pn'),
        );
		$columns = apply_filters('partners_manage_ap_columns', $columns);
        return $columns;
    }	
	
	function single_row( $item ) {
		$class = '';
		if($item->status == 1){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
		$this->single_row_columns( $item );
		echo '</tr>';
	}
	
    function get_bulk_actions() {
        $actions = array(
			'approve'    => __('Approve','pn'),
			'unapprove'    => __('Decline','pn'),		
            'delete'    => __('Delete','pn')
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_partners_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$where = '';
		
		$mod = intval(is_param_get('mod'));
		if($mod == 1){
			$where = " AND status = '1'";
		} elseif($mod == 2){
			$where = " AND status = '0'";
		}		
		
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."partners WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."partners WHERE auto_status = '1' $where ORDER BY site_order ASC LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_partners');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
	
}


add_action('premium_screen_pn_partners','my_premium_screen_pn_partners');
function my_premium_screen_pn_partners() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_partners_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_partners_List_Table')){
		new trev_partners_List_Table;
	}
}