<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_noticehead', 'pn_adminpage_title_pn_noticehead');
function pn_adminpage_title_pn_noticehead(){
	_e('Warning messages','pn');
}

add_action('pn_adminpage_content_pn_noticehead','def_pn_adminpage_content_pn_noticehead');
function def_pn_adminpage_content_pn_noticehead(){

	if(class_exists('trev_noticehead_List_Table')){  
		$Table = new trev_noticehead_List_Table();
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
		$options['mod2'] = array(
			'name' => 'mod2',
			'options' => array(
				'1' => __('on period of time','pn'),
				'2' => __('on schedule','pn'),
			),
			'title' => '',
		);	
		$options['mod3'] = array(
			'name' => 'mod3',
			'options' => array(
				'1' => __('header','pn'),
				'2' => __('pop-up window','pn'),
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


add_action('premium_action_pn_noticehead','def_premium_action_pn_noticehead');
function def_premium_action_pn_noticehead(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_noticehead'));
	
	$reply = '';
	$action = get_admin_action();
	
	if(isset($_POST['save'])){
						
		do_action('pn_noticehead_save');
		$reply = '&reply=true';

	} else {	
		if(isset($_POST['id']) and is_array($_POST['id'])){

			if($action == 'approve'){	
				foreach($_POST['id'] as $id){
					$id = intval($id);	
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."notice_head WHERE id='$id' AND status != '1'");
					if(isset($item->id)){
						do_action('pn_noticehead_approve_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."notice_head SET status = '1' WHERE id = '$id'");
						do_action('pn_noticehead_approve', $id, $item);
						if($result){
							do_action('pn_noticehead_approve_after', $id, $item);
						}
					}		
				}	
			}

			if($action == 'unapprove'){	
				foreach($_POST['id'] as $id){
					$id = intval($id);	
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."notice_head WHERE id='$id' AND status != '0'");
					if(isset($item->id)){	
						do_action('pn_noticehead_unapprove_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."notice_head SET status = '0' WHERE id = '$id'");
						do_action('pn_noticehead_unapprove', $id, $item);
						if($result){
							do_action('pn_noticehead_unapprove_after', $id, $item);
						}					
					}
				}		
			}				
				
			if($action == 'delete'){	
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."notice_head WHERE id='$id'");
					if(isset($item->id)){		
						do_action('pn_noticehead_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."notice_head WHERE id = '$id'");
						do_action('pn_noticehead_delete', $id, $item);
						if($result){
							do_action('pn_noticehead_delete_after', $id, $item);
						}					
					}
				}	
			}
			
			do_action('pn_noticehead_action', $action, $_POST['id']);
			$reply = '&reply=true';
		} 
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }	
	wp_redirect($url);
	exit;				
} 

class trev_noticehead_List_Table extends WP_List_Table{

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
		$notice_type = $item->notice_type;
		if($column_name == 'bydate'){
			if($notice_type == 0){
				return get_mytime($item->datestart,'d.m.Y H:i').'-'.get_mytime($item->dateend,'d.m.Y H:i');
			}
		} elseif($column_name == 'class'){
			return pn_strip_input($item->theclass);
		} elseif($column_name == 'display'){
		    if($item->notice_display == '0'){ 
			    return '<strong>'. __('header','pn') .'</strong>'; 
			} else { 
			    return '<strong>'. __('pop-up window','pn') .'</strong>'; 
			}			
		} elseif($column_name == 'ctime'){
			if($notice_type == 1){
				return $item->h1 .':'. $item->m1 .'-'. $item->h2 .':'. $item->m2;
			}
		} elseif($column_name == 'cdays'){
			if($notice_type == 1){
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
		} elseif($column_name == 'status'){
		    if($item->status == '0'){ 
			    return '<span class="bred">'. __('moderating','pn') .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('published','pn') .'</span>'; 
			}	
		}
		return apply_filters('noticehead_manage_ap_col', '', $column_name,$item);
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_noticehead&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );		
		$primary = apply_filters('noticehead_manage_ap_primary', pn_strip_text(ctv_ml($item->text)), $item);
		$actions = apply_filters('noticehead_manage_ap_actions', $actions, $item);		
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',          
			'title'     => __('Text','pn'),
			'bydate'    => __('Date','pn'),
			'ctime'     => __('Period for display (hours)','pn'),
			'cdays'     => __('Period for display (days)','pn'),
			'class'    => __('CSS class','pn'),
			'display'    => __('Location','pn'),
            'status'  => __('Status','pn'),
        );
		$columns = apply_filters('noticehead_manage_ap_columns', $columns);
        return $columns;
    }

	function get_primary_column_name() {
		return 'title';
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
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
    
    function get_sortable_columns() {
        $sortable_columns = array( 
            'bydate'     => array('bydate',false),
        );
        return $sortable_columns;
    }	
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_noticehead_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$oby = is_param_get('orderby');
		if($oby == 'bydate'){
		    $orderby = 'datestart';
		} else {
		    $orderby = 'id';
		}
		$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc';		
		if($order != 'asc'){ $order = 'desc'; }				
		
		$where = '';

		$mod = intval(is_param_get('mod'));
		if($mod == 1){
			$where .= " AND status = '1'";
		} elseif($mod == 2){
			$where .= " AND status = '0'";
		}

		$mod2 = intval(is_param_get('mod2'));
		if($mod2 == 1){
			$where .= " AND notice_type = '0'";
		} elseif($mod2 == 2){
			$where .= " AND notice_type = '1'";
		}

		$mod3 = intval(is_param_get('mod3'));
		if($mod3 == 1){
			$where .= " AND notice_display = '0'";
		} elseif($mod3 == 2){
			$where .= " AND notice_display = '1'";
		}		
		
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."notice_head WHERE auto_status = '1' $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."notice_head WHERE auto_status = '1' $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_noticehead');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>
		<?php
	}	  
}


add_action('premium_screen_pn_noticehead','my_premium_screen_pn_noticehead');
function my_premium_screen_pn_noticehead(){
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_noticehead_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_noticehead_List_Table')){
		new trev_noticehead_List_Table;
	}
}