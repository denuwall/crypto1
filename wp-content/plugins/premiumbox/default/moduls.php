<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_moduls', 'def_adminpage_title_pn_moduls');
function def_adminpage_title_pn_moduls($page){
	_e('Modules','pn');
} 

add_action('pn_adminpage_content_pn_moduls','def_pn_adminpage_content_pn_moduls');
function def_pn_adminpage_content_pn_moduls(){

	if(class_exists('pn_moduls_List_Table')){ 
		$Table = new pn_moduls_List_Table();
		$Table->prepare_items();
		
		$search = array();
		
		$list = pn_list_extended('moduls');
		$cats = array('0'=>'--'. __('All categories','pn') .'--');
		foreach($list as $data){
			$c = is_extension_name($data['cat']);
			$n = pn_strip_input(ctv_ml($data['category']));
			if($c and $n){
				$cats[$c] = $n;
			}
		}
		
		$search[] = array(
			'view' => 'select',
			'options' => $cats,
			'title' => __('Module categories','pn'),
			'default' => is_extension_name(is_param_get('cat')),
			'name' => 'cat',
		);
		$placed = array(
			'0' => '--'. __('All locations','pn') .'--',
			'plugin' => __('Plugin','pn'),
			'theme' => __('Theme','pn'),
		);
		$search[] = array(
			'view' => 'select',
			'options' => $placed,
			'title' => __('Module locations','pn'),
			'default' => is_extension_name(is_param_get('place')),
			'name' => 'place',
		);		
		pn_admin_searchbox($search, 'reply');		
?>
	<style>
	.column-title{ width: 200px!important; }
	</style>

	<?php 
	$options = array();
	$options['mod'] = array(
		'name' => 'mod',
		'options' => array(
			'1' => __('active moduls','pn'),
			'2' => __('inactive moduls','pn'),
		),
		'title' => '',
	);
	pn_admin_submenu($options, 'reply'); 	
	?>	
	
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display(); ?>
	</form>
<?php 
	} else {
		echo 'Class not found';
	}
} 

add_action('premium_action_pn_moduls','def_premium_action_pn_moduls');
function def_premium_action_pn_moduls(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator'));

	$reply = '';
	$action = get_admin_action();
	
	if(isset($_POST['id']) and is_array($_POST['id'])){
		if($action == 'active'){
						
			$extended = get_option('pn_extended');
			if(!is_array($extended)){ $extended = array(); }
						
			foreach($_POST['id'] as $id){
				$id = is_extension_name($id);
				if($id){
					if(!isset($extended['moduls'][$id])){
						$extended['moduls'][$id] = $id;
						
						pn_include_extanded('moduls', $id);
						
						do_action('pn_moduls_active_'.$id);
						do_action('pn_moduls_active', $id);
					}
				}	
			}
			update_option('pn_extended', $extended);
			$premiumbox->plugin_create_pages();
						
			$reply = '&reply=true';		
		}
			
		if($action == 'deactive'){
						
			$extended = get_option('pn_extended');
			if(!is_array($extended)){ $extended = array(); }
						
			foreach($_POST['id'] as $id){
				$id = is_extension_name($id);
				if($id){
					if(isset($extended['moduls'][$id])){
						unset($extended['moduls'][$id]);
						do_action('pn_moduls_deactive_'.$id);
						do_action('pn_moduls_deactive', $id);
					}
				}	
			}
			update_option('pn_extended', $extended);
						
			$reply = '&reply=true';		
		}				
	}
			
	$ref = is_param_post('_wp_http_referer');
	$ref = pn_admin_filter_data($ref, 'reply, paged');
	$paged = intval(is_param_post('paged'));
	if($paged > 1){ $ref .= '&paged='.$paged; }			
	$url = $ref . $reply;
	wp_redirect($url);
	exit;			
} 

add_action('premium_action_pn_moduls_activate','def_premium_action_pn_moduls_activate');
function def_premium_action_pn_moduls_activate(){
global $wpdb, $premiumbox;

	pn_only_caps(array('administrator'));	
	
	$id = is_extension_name(is_param_get('key'));	
	if($id){
		
		$extended = get_option('pn_extended');
		if(!is_array($extended)){ $extended = array(); }
		
		if(!isset($extended['moduls'][$id])){
			$extended['moduls'][$id] = $id;
				
			pn_include_extanded('moduls', $id);
			
			do_action('pn_moduls_active_'. $id);
			do_action('pn_moduls_active', $id);
		}	

		update_option('pn_extended', $extended);
		$premiumbox->plugin_create_pages();
	}
	
	$ref = is_param_get('_wp_http_referer');
	$url = pn_admin_filter_data($ref, 'reply').'reply=true';
	wp_redirect($url);
	exit;		
}

add_action('premium_action_pn_moduls_deactivate','def_premium_action_pn_moduls_deactivate');
function def_premium_action_pn_moduls_deactivate(){
global $wpdb;	

	pn_only_caps(array('administrator'));	
	
	$id = is_extension_name(is_param_get('key'));	
	if($id){
		
		$extended = get_option('pn_extended');
		if(!is_array($extended)){ $extended = array(); }
			
		if(isset($extended['moduls'][$id])){
			unset($extended['moduls'][$id]);
			
			do_action('pn_moduls_deactive_'. $id);
			do_action('pn_moduls_deactive', $id);
		}	

		update_option('pn_extended', $extended);
		
	}
	
	$ref = is_param_get('_wp_http_referer');
	$url = pn_admin_filter_data($ref, 'reply').'reply=true';
	wp_redirect($url);
	exit;
}	

class pn_moduls_List_Table extends WP_List_Table {

    function __construct(){
        global $status, $page;
                
        parent::__construct( array(
            'singular'  => 'id',      
			'ajax' => false,  
        ) );
        
    }
	
    function column_default($item, $column_name){
        
		if($column_name == 'descr'){
			$html = '
				<div>'. pn_strip_input(ctv_ml($item['description'])) .'</div>
				<div class="active second plugin-version-author-uri">'. __('Version','pn') .': '. pn_strip_input($item['version']) .'</div>
			';
			
			return $html;
		} elseif($column_name == 'category'){	
			return '<a href="'. admin_url('admin.php?page=pn_moduls&cat='. is_isset($item, 'cat')) .'&place='. is_param_get('place') .'&mod='. is_param_get('mod') .'">'. pn_strip_input(ctv_ml($item['category'])) . '</a>';
		} elseif($column_name == 'place'){	
			$place = __('Plugin','pn');
			if(is_isset($item, 'place') == 'theme'){
				$place = __('Theme','pn');
			}
			return '<a href="'. admin_url('admin.php?page=pn_moduls&place='. is_isset($item, 'place')) .'&cat='. is_param_get('cat') .'&mod='. is_param_get('mod') .'">'. $place . '</a>';		
		} elseif($column_name == 'dependent'){	
			return pn_strip_input($item['dependent']);
		} elseif($column_name == 'name'){	
			$name = is_extension_name($item['name']);
			$name = str_replace('_theme','', $name);
			return $name;
		}
		
    }	
	
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'], 
            $item['name']                
        );
    }	

    function column_title($item){

		if($item['status'] == 'active'){
			$actions['deactive']  = '<a href="'. pn_link_post('pn_moduls_deactivate', 'post') . '&key=' . $item['name'] . '&_wp_http_referer=' . urlencode($_SERVER['REQUEST_URI']) .'">'. __('Deactivate','pn') .'</a>';
		} else {
			$actions['active']  = '<a href="'. pn_link_post('pn_moduls_activate', 'post') . '&key=' . $item['name'] . '&_wp_http_referer=' . urlencode($_SERVER['REQUEST_URI']) .'">'. __('Activate','pn') .'</a>';
		}
        
        return sprintf('%1$s %2$s',
            '<strong>'. pn_strip_input(ctv_ml($item['title'])) .'</strong>',
            $this->row_actions($actions)
        );
		
    }	
	
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
			'title'     => __('Title','pn'),
			'descr'     => __('Description','pn'),
			'category'     => __('Category','pn'),
			'place'     => __('Location','pn'),
			'name'     => __('Folder name','pn'),
			'dependent'     => __('Dependent modules','pn'),
        );
		
        return $columns;
    }	
	
	function get_primary_column_name() {
		return 'title';
	}

	function single_row( $item ) {
		$class = '';
		if($item['status'] == 'active'){
			$class = 'active';
		}
		echo '<tr class="pn_tr '. $class .'">';
			$this->single_row_columns( $item );
		echo '</tr>';
	}		

    function get_bulk_actions() {
        $actions = array(
			'active'    => __('Activate','pn'),
			'deactive'    => __('Deactivate','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('pn_moduls_per_page', 50);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();
		$offset = ($current_page-1)*$per_page;

		$list = pn_list_extended('moduls');
		$ndata = array();
		$mod = intval(is_param_get('mod'));
		$cat = is_extension_name(is_param_get('cat'));
		$place = is_extension_name(is_param_get('place'));
		
		foreach($list as $list_key => $list_value){
			$module_status = $list_value['status'];
			$module_category = is_extension_name($list_value['cat']);
			$module_place = $list_value['place'];
			
			$show = 0;
			
			if($mod == 1){
				if($module_status == 'active'){
					$show = 1;
				}
			} elseif($mod == 2){
				if($module_status == 'deactive'){
					$show = 1;
				}			
			} else {
				$show = 1;
			}
			
			if($cat){
				if($module_category != $cat){
					$show = 0;
				}
			}

			if($place){
				if($module_place != $place){
					$show = 0;
				}
			}			
			
			if($show == 1){
				$ndata[] = $list_value;
			}
		}	
		
		$data = $ndata;
		$items = array_slice($data,$offset,$per_page);
		
		$total_items = count($data);
        $current_page = $this->get_pagenum();
        $this->items = $items;
		
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)  
        ));
    }	
	
} 

add_action('premium_screen_pn_moduls','my_premium_screen_pn_moduls');
function my_premium_screen_pn_moduls() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 50,
        'option' => 'pn_moduls_per_page'
    );
    add_screen_option('per_page', $args );	
	
	if(class_exists('pn_moduls_List_Table')){
		new pn_moduls_List_Table;
	}
}