<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_parser_pairs', 'pn_admin_title_pn_parser_pairs');
function pn_admin_title_pn_parser_pairs(){
	_e('Rates','pn');
} 

add_action('pn_adminpage_content_pn_parser_pairs','def_pn_admin_content_pn_parser_pairs');
function def_pn_admin_content_pn_parser_pairs(){

	if(class_exists('trev_parser_pairs_List_Table')){  
		$Table = new trev_parser_pairs_List_Table();
		$Table->prepare_items();
		
		global $wpdb;
		
		$form = new PremiumForm();
		
		$options = array();
		$options[0] = '--'. __('All','pn') .'--';
		
		$items = $wpdb->get_results("SELECT DISTINCT(title_birg) FROM ". $wpdb->prefix ."parser_pairs");  		
		foreach($items as $item){
			$options[$item->title_birg] = pn_strip_input(ctv_ml($item->title_birg));
		}
		
		$search = array();
		$search[] = array(
			'view' => 'select',
			'title' => __('Source name','pn'),
			'default' => is_param_get('title_birg'),
			'options' => $options,
			'name' => 'title_birg',
		);		
		
		pn_admin_searchbox($search, 'reply');
		
		pn_admin_submenu(array(), 'reply');
?>
	<div style="margin: 0 0 10px 0;">
		<?php 
		$text = sprintf(__('For creating an exchange rate you can use the following mathematical operations:<br><br> 
		* multiplication<br> 
		/ division<br> 
		- subtraction<br> 
		+ addition<br><br> 
		An example of a formula where two exchange rates are multiplied: [bitfinex_btcusd_last_price] * [cbr_usdrub]<br> 
		For more detailed instructions, follow the <a href="%s" target="_blank">link</a>.','pn'), 'https://premiumexchanger.com/wiki/parseryi-kursov-valyut/');
		$form->help(__('Example of formulas for parser','pn'), $text);
		?>
	</div>
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
} 


add_action('premium_action_pn_parser_pairs','def_premium_action_pn_parser_pairs');
function def_premium_action_pn_parser_pairs(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));

	$reply = '';
	$action = get_admin_action();
			
	if(isset($_POST['save'])){
				
		if(isset($_POST['pair_give']) and is_array($_POST['pair_give']) and isset($_POST['pair_get']) and is_array($_POST['pair_get'])){
			foreach($_POST['pair_give'] as $id => $pair_give){
						
				$id = intval($id);
				$pair_give = pn_parser_actions($pair_give);
				$pair_get = pn_parser_actions($_POST['pair_get'][$id]);	
						
				$array = array();	
				$array['pair_give'] = $pair_give;
				$array['pair_get'] = $pair_get;
				$wpdb->update($wpdb->prefix."parser_pairs", $array, array('id'=>$id));
						
				update_directions_to_new_parser($id);
						
			}					
		}
				
		do_action('pn_parser_pairs_save');
		$reply = '&reply=true';

	} else {
				
		if(isset($_POST['id']) and is_array($_POST['id'])){				
				
			if($action == 'delete'){		
				foreach($_POST['id'] as $id){
					$id = intval($id);
							
					$item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."parser_pairs WHERE id='$id'");
					if(isset($item->id)){
						do_action('pn_parser_pairs_delete_before', $id, $item);
						$result = $wpdb->query("DELETE FROM ".$wpdb->prefix."parser_pairs WHERE id = '$id'");
						do_action('pn_parser_pairs_delete', $id, $item);
						if($result){
							$wpdb->update($wpdb->prefix."directions", array('new_parser'=>'0'), array('new_parser'=>$id));
							$wpdb->update($wpdb->prefix."currency_codes", array('new_parser'=>'0'), array('new_parser'=>$id));
							do_action('pn_parser_pairs_delete_after', $id, $item);
						}
					}		
				}
			}
			
			do_action('pn_parser_pairs_action', $action, $_POST['id']);
			$reply = '&reply=true';					
		} 
				
	}
			
	$url = is_param_post('_wp_http_referer') . $reply;
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $url .= '&paged='.$paged; }		
	wp_redirect($url);
	exit;			
}  

class trev_parser_pairs_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'source'){
			return pn_strip_input(ctv_ml($item->title_birg)); 
		} elseif($column_name == 'calc1'){		
		    return '<input type="text" style="width: 150px;" name="pair_give['. $item->id .']" value="'. pn_strip_input($item->pair_give) .'" />';	
		} elseif($column_name == 'calc2'){	
		    return '<input type="text" style="width: 150px;" name="pair_get['. $item->id .']" value="'. pn_strip_input($item->pair_get) .'" />';
		} elseif($column_name == 'rate1'){
			return get_parser_course($item->pair_give);
		} elseif($column_name == 'rate2'){
			return get_parser_course($item->pair_get);
		} 
		
		return apply_filters('parser_pairs_manage_ap_col', '', $column_name, $item);
		
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
            'edit'      => '<a href="'. admin_url('admin.php?page=pn_add_parser_pairs&item_id='. $item->id) .'">'. __('Edit','pn') .'</a>',
        );
        
        return sprintf('%1$s %2$s',
            pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get),
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Rate name','pn'),
			'source'     => __('Source name','pn'),
			'calc1' => __('Rate formula for Send','pn'),
			'calc2' => __('Rate formula for Receive','pn'),
			'rate1' => __('Rate for Send','pn'),
			'rate2' => __('Rate for Receive','pn'),			
        );
		
		$columns = apply_filters('parser_pairs_manage_ap_columns', $columns);
		
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
		
        $per_page = $this->get_items_per_page('trev_parser_pairs_per_page', 20);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();

		$offset = ($current_page-1)*$per_page;
		
		$where = '';
		
		$title_birg = pn_sfilter(trim(is_param_get('title_birg')));
		if($title_birg){
			$where .= " AND title_birg = '$title_birg'";
		}
		
		$where = pn_admin_search_where($where);
		$total_items = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."parser_pairs WHERE id > 0 $where");
		$data = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs WHERE id > 0 $where ORDER BY menu_order ASC LIMIT $offset , $per_page");  		

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
            <a href="<?php echo admin_url('admin.php?page=pn_add_parser_pairs');?>" class="button"><?php _e('Add new','pn'); ?></a>
		</div>		
	<?php 
	}	  
	
}

add_action('premium_screen_pn_parser_pairs','my_myscreen_pn_parser_pairs');
function my_myscreen_pn_parser_pairs() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 20,
        'option' => 'trev_parser_pairs_per_page'
    );
    add_screen_option('per_page', $args );
	if(class_exists('trev_parser_pairs_List_Table')){
		new trev_parser_pairs_List_Table;
	}
}