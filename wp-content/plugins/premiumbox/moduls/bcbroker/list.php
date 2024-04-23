<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_bc_adjs', 'def_adminpage_title_pn_bc_adjs');
function def_adminpage_title_pn_bc_adjs(){
	_e('Adjustments','pn');
}

add_action('pn_adminpage_content_pn_bc_adjs','def_pn_admin_content_pn_bc_adjs');
function def_pn_admin_content_pn_bc_adjs(){
global $wpdb;

	if(class_exists('trev_bcadjs_List_Table')){
		$Table = new trev_bcadjs_List_Table();
		$Table->prepare_items();
		
		$search = array();
		
		$options = array(
			'0' => '--'. __('All','pn').'--',
		);
		$directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND direction_status='1' ORDER BY site_order1 ASC");
		foreach($directions as $direction){ 
			$options[$direction->id]= pn_strip_input($direction->tech_name);
		}		
		$search[] = array(
			'view' => 'select',
			'title' => __('Exchange direction','pn'),
			'default' => intval(is_param_get('direction_id')),
			'options' => $options,
			'name' => 'direction_id',
		);			
		pn_admin_searchbox($search, 'reply');			
		
		$options = array(
			'1' => __('active parser','pn'),
			'2' => __('inactive parser','pn'),
		);
		pn_admin_submenu('mod', $options, 'reply'); 	
?>
<style>
.column-title{ width: 100px!important; }
</style>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>	
<?php 
	} else {
		echo 'Class not found';
	}
} 

add_action('premium_action_pn_bc_adjs','def_premium_action_pn_bc_adjs');
function def_premium_action_pn_bc_adjs(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));

	$reply = '';
	$action = get_admin_action();
		
	if(isset($_POST['filter'])){
			
		$ref = is_param_post('_wp_http_referer');
		$url = pn_admin_filter_data($ref, 'reply, curr_give, curr_get');			
			
		$curr_give = intval(is_param_post('curr_give'));
		if($curr_give){
			$url .= '&curr_give='.$curr_give;
		}
				
		$curr_get = intval(is_param_post('curr_get'));
		if($curr_get){
			$url .= '&curr_get='.$curr_get;
		}				
				
		wp_redirect($url);
		exit;
				
	} elseif(isset($_POST['back_filter'])){	
				
		$ref = is_param_post('_wp_http_referer');
		$url = pn_admin_filter_data($ref, 'reply, curr_give, curr_get');		
			
		$curr_give = intval(is_param_post('curr_give'));
		if($curr_give){
			$url .= '&curr_get=' . $curr_give;
		}
				
		$curr_get = intval(is_param_post('curr_get'));
		if($curr_get){
			$url .= '&curr_give=' . $curr_get;
		}				
				
		wp_redirect($url);
		exit;
		
	} elseif(isset($_POST['save'])){
			
		if(isset($_POST['v1']) and is_array($_POST['v1'])){
			foreach($_POST['v1'] as $id => $v1){
				$id = intval($id);
				$arr = array();
				$v1 = intval($v1);
				$arr['v1'] = intval($v1);
				$arr['v2'] = intval($_POST['v2'][$id]);
				$arr['pars_position'] = intval($_POST['pars_position'][$id]);
				$arr['step'] = pn_strip_input($_POST['step'][$id]);
				$arr['min_res'] = is_sum($_POST['min_res'][$id]);
				$arr['min_sum'] = is_sum($_POST['min_sum'][$id]);
				$arr['max_sum'] = is_sum($_POST['max_sum'][$id]);
				$arr['standart_course_give'] = is_sum($_POST['standart_course_give'][$id]);
				$arr['standart_course_get'] = is_sum($_POST['standart_course_get'][$id]);
				$arr['reset_course'] = intval($_POST['reset_course'][$id]);
				$wpdb->update($wpdb->prefix."bcbroker_directions", $arr, array('id'=>$id));				
			}
		}					
				
		do_action('pn_bcadjs_save');
		$reply = '&reply=true';

	} else {		
		if(isset($_POST['id']) and is_array($_POST['id'])){				
				
			if($action == 'active'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE id='$id' AND status != '1'");
					if(isset($item->id)){
						do_action('pn_bcadjs_active_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."bcbroker_directions SET status = '1' WHERE id = '$id'");
						do_action('pn_bcadjs_active', $id, $item);
						if($result){
							do_action('pn_bcadjs_active_after', $id, $item);
						}
					}
				}		
				$reply = '&reply=true';		
			}

			if($action == 'notactive'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE id='$id' AND status != '0'");
					if(isset($item->id)){
						do_action('pn_bcadjs_notactive_before', $id, $item);
						$result = $wpdb->query("UPDATE ".$wpdb->prefix."bcbroker_directions SET status = '0' WHERE id = '$id'");
						do_action('pn_bcadjs_notactive', $id, $item);
						if($result){
							do_action('pn_bcadjs_notactive_after', $id, $item);
						}
					}
				}	
				$reply = '&reply=true';
			}					
				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_bcadjs_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."bcbroker_directions WHERE id = '$id'");
						do_action('pn_bcadjs_delete', $id, $item);
						if($result){
							do_action('pn_bcadjs_delete_after', $id, $item);
						}
					}
				}	
				$reply = '&reply=true';		
			}
					
		} 		
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
} 

class trev_bcadjs_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
    global $wpdb;    
		if($column_name == 'status'){	
		    if($item->status == 0){ 
			    return '<span class="bred">'. __('No','pn') .'</span>'; 
			} else { 
			    return '<span class="bgreen">'. __('Yes','pn') .'</span>'; 
			}		
		} elseif($column_name == 'course'){	
			$direction_id = intval($item->direction_id);
			$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$direction_id'");
			if(isset($direction->id)){
				return is_sum($direction->course_give) . '&rarr;' . is_sum($direction->course_get);
			}
		} elseif($column_name == 'giveget'){
			$alls = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes");
			$html = '
			<div>
				<select name="v1['. $item->id .']" autocomplete="off" style="max-width: 100%;">
					<option value="0">--'. __('Give','pn') .'</option>
				';
					foreach($alls as $all){
						$html .= '<option value="'. $all->currency_code_id .'" '. selected($all->currency_code_id, $item->v1, false) .'>'. pn_strip_input($all->currency_code_title) .'</option>';
					}
				$html .= '
				</select>
			</div>
			<div>
				<select name="v2['. $item->id .']" autocomplete="off" style="max-width: 100%;">
					<option value="0">--'. __('Get','pn') .'</option>
				';
					foreach($alls as $all){
						$html .= '<option value="'. $all->currency_code_id .'" '. selected($all->currency_code_id, $item->v2, false) .'>'. pn_strip_input($all->currency_code_title) .'</option>';
					}
				$html .= '
				</select>
			</div>';			
			
			return $html;	
		} elseif($column_name == 'standart'){
			$html = '
			<div>
				<select name="reset_course['. $item->id .']" autocomplete="off" style="max-width: 100%;">
					<option value="0" '. selected(0, $item->reset_course, false) .'>'. __('Yes','pn') .'</option>
					<option value="1" '. selected(1, $item->reset_course, false) .'>'. __('No','pn') .'</option>
				</select>
			</div>
			<div>
				<input type="text" style="width: 50px;" name="standart_course_give['. $item->id .']" value="'. is_sum($item->standart_course_give) .'" /> &rarr; <input type="text" style="width: 50px;" name="standart_course_get['. $item->id .']" value="'. is_sum($item->standart_course_get) .'" />
			</div>
			';
			return $html;
		} elseif($column_name == 'position'){
			$html = '<input type="text" name="pars_position['. $item->id .']" style="width: 70px;" value="'. is_sum($item->pars_position) .'" />';
			return $html;
		} elseif($column_name == 'minres'){
			$html = '<input type="text" name="min_res['. $item->id .']" style="width: 70px;" value="'. is_sum($item->min_res) .'" />';
			return $html;
		} elseif($column_name == 'step'){
			$html = '<input type="text" name="step['. $item->id .']" style="width: 70px;" value="'. pn_strip_input($item->step) .'" />';
			return $html;
		} elseif($column_name == 'minsum'){
			$html = '<input type="text" name="min_sum['. $item->id .']" style="width: 70px;" value="'. is_sum($item->min_sum) .'" />';
			return $html;
		} elseif($column_name == 'maxsum'){
			$html = '<input type="text" name="max_sum['. $item->id .']" style="width: 70px;" value="'. is_sum($item->max_sum) .'" />';
			return $html;			
		} 
		return apply_filters('bcadjs_manage_ap_col', '', $column_name,$item);
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item->id                
        );
    }	

    function column_title($item){
	global $wpdb;
	
		$direction_id = intval($item->direction_id);
		$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$direction_id'");
		$direction_title = '';
		if(isset($direction->id)){
			$direction_title = pn_strip_input($direction->tech_name);
		}	
	
        $actions = array(
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_bc_add_adjs&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
			'view'      => '<a href="'. admin_url('admin.php?page=pn_add_directions&item_id='. $item->direction_id) .'" target="_blank">'. __('View','pn') .'</a>',
        );
 		$primary = apply_filters('bcadjs_manage_ap_primary', $direction_title, $item);
		$actions = apply_filters('bcadjs_manage_ap_actions', $actions, $item);	       
        return sprintf('%1$s %2$s',
            $primary,
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Exchange direction','pn'),
			'course'     => __('Rate','pn'),
			'giveget'     => __('Send and Receive','pn'),
			'position'    => __('Position','pn'),
			'minres'    => __('Min reserve for position','pn'),
			'step'    => __('Step','pn'),
			'minsum'    => __('Min rate','pn'),
			'maxsum'    => __('Max rate','pn'),
			'standart'    => __('Standart rate','pn'),
			'status'    => __('Status','pn'),
        );
		$columns = apply_filters('bcadjs_manage_ap_columns', $columns);
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
			'active'    => __('Activate','pn'),
			'notactive'    => __('Deactivate','pn'),
            'delete'    => __('Delete','pn'),
        );
        return $actions;
    }
	
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_bcadjs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		$orderby = 'id';				
		$order = 'desc';		
		
		$where = '';
		
        $mod = intval(is_param_get('mod'));
        if($mod == 1){ 
            $where .= " AND status='1'"; 
		} elseif($mod == 2){
			$where .= " AND status='0'";
		}		
		
        $direction_id = intval(is_param_get('direction_id'));
        if($direction_id > 0){ 
            $where .= " AND direction_id='$direction_id'"; 
		}
		
        $curr_give = intval(is_param_get('curr_give'));
        if($curr_give > 0){ 
            $where .= " AND currency_id_give = '$curr_give'"; 
		}
		
        $curr_get = intval(is_param_get('curr_get'));
        if($curr_get > 0){ 
            $where .= " AND currency_id_get = '$curr_get'"; 
		}		
		
		$where = pn_admin_search_where($where);
		
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_directions WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bcbroker_directions WHERE id > 0 $where ORDER BY $orderby $order LIMIT $offset , $per_page");  		

        $current_page = $this->get_pagenum();
        $this->items = $data;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }
	
	function extra_tablenav( $which ) {
		$currency = apply_filters('list_currency_manage', array(), __('All currency','pn'));
	?>
		<div class="alignleft actions">
<?php   
		if ( 'top' == $which ) {
			$curr_give = intval(is_param_get('curr_give'));
			$curr_get = intval(is_param_get('curr_get'));
?>
			<select name="curr_give" autocomplete="off">
            <?php
				foreach($currency as $currency_key => $currency_title){
					echo "\t<option value='" . $currency_key . "' " . selected($currency_key, $curr_give, false ) . ">". $currency_title ."</option>\n";
			    }
			?>
			</select>
			
			<input type="submit" name="back_filter" class="back_filter" value="">
			
			<select name="curr_get" autocomplete="off">
            <?php
				foreach($currency as $currency_key => $currency_title){
					echo "\t<option value='" . $currency_key . "' " . selected($currency_key, $curr_get, false ) . ">". $currency_title ."</option>\n";
			    }
			?>
			</select>			
			<input type="submit" name="filter" class="button" value="<?php _e('Filter','pn'); ?>">
<?php
		}
    ?>
	    </div>		
		<div class="alignleft actions">
			<input type="submit" name="save" class="button" value="<?php _e('Save','pn'); ?>">
            <a href="<?php echo admin_url('admin.php?page=pn_bc_add_adjs');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php 
	}	  
	
} 

add_action('premium_screen_pn_bc_adjs','my_myscreen_pn_bc_adjs');
function my_myscreen_pn_bc_adjs() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_bcadjs_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_bcadjs_List_Table')){
		new trev_bcadjs_List_Table;
	}
}