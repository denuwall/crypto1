<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_smsgate', 'pn_admin_title_pn_smsgate');
function pn_admin_title_pn_smsgate($page){
	_e('SMS gate settings','pn');
} 

add_action('pn_adminpage_content_pn_smsgate','def_pn_admin_content_pn_smsgate');
function def_pn_admin_content_pn_smsgate(){

	if(class_exists('trev_smsgate_List_Table')){ 
		$Table = new trev_smsgate_List_Table();
		$Table->prepare_items();
		
		$search = array();
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
		
		$options = array();
		$options['mod'] = array(
			'name' => 'mod',
			'options' => array(
				'1' => __('active SMS gate','pn'),
				'2' => __('inactive SMS gate','pn'),
			),
			'title' => '',
		);		
		pn_admin_submenu($options, 'reply');
?>
<style>
.column-title{ width: 200px!important; }
</style>

	<form method="post" action="<?php pn_the_link_post(); ?>">
		<?php $Table->display() ?>
	</form>
	
<script type="text/javascript">	
$(function(){

	$('select.merchant_change').on('change', function(){ 
		var id = $(this).attr('data-id');
		var wid = $(this).val();
		var thet = $(this);
		thet.prop('disabled',true);
		
		$('#premium_ajax').show();
		var param='id=' + id + '&wid=' + wid;
		
        $.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('smsgate_settings_save'); ?>",
			data: param,
			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},			
			success: function(res)
			{
				$('#premium_ajax').hide();	
				thet.prop('disabled',false);
			}
        });
	
        return false;
	});	
	
});
</script>	
	
<?php 
	} else {
		echo 'Class not found';
	}
	
} 

add_action('premium_action_smsgate_settings_save', 'pn_premium_action_smsgate_settings_save');
function pn_premium_action_smsgate_settings_save(){
global $wpdb;

	only_post();
	
	if(current_user_can('administrator') or current_user_can('pn_merchants')){
		
		$id = is_extension_name(is_param_post('id'));
		$wid = intval(is_param_post('wid'));
		
		$merchants = get_option('smsgate');
		if(!is_array($merchants)){ $merchants = array(); }
		
		$merchants[$id] = $wid;
		
		$merchants = apply_filters('smsgate_settings_save', $merchants, $id, $wid);
		
		update_option('smsgate', $merchants);
			
	}  		
}
	
add_action('premium_action_pn_smsgate','def_premium_action_pn_smsgate');
function def_premium_action_pn_smsgate(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_merchants'));
	
	$reply = '';
	$action = get_admin_action();
	
	if(isset($_POST['id']) and is_array($_POST['id'])){

		if($action == 'active'){
					
			$extended = get_option('pn_extended');
			if(!is_array($extended)){ $extended = array(); }
					
			foreach($_POST['id'] as $id){
				$id = is_extension_name($id);
				if($id){
					if(!isset($extended['sms'][$id])){
						$extended['sms'][$id] = $id;
						
						pn_include_extanded('sms', $id);
						
						do_action('pn_smsgate_active_'.$id);
						do_action('pn_smsgate_active', $id);
					}
				}	
			}
			update_option('pn_extended', $extended);
					
			$reply = '&reply=true';	
		}

		if($action == 'deactive'){
					
			$extended = get_option('pn_extended');
			if(!is_array($extended)){ $extended = array(); }
					
			foreach($_POST['id'] as $id){
				$id = is_extension_name($id);
				if($id){
					if(isset($extended['sms'][$id])){
						unset($extended['sms'][$id]);
						
						do_action('pn_smsgate_deactive_'.$id);
						do_action('pn_smsgate_deactive', $id);
								
						$merchants = get_option('smsgate');
						if(!is_array($merchants)){ $merchants = array(); }
						$merchants[$id] = 0;
						update_option('smsgate', $merchants);							
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

add_action('premium_action_pn_smsgate_activate','def_premium_action_pn_smsgate_activate');
function def_premium_action_pn_smsgate_activate(){
global $wpdb;	

	pn_only_caps(array('administrator','pn_merchants'));
	
	$id = is_extension_name(is_param_get('key'));	
	if($id){
		
		$extended = get_option('pn_extended');
		if(!is_array($extended)){ $extended = array(); }
			
		if(!isset($extended['sms'][$id])){
			$extended['sms'][$id] = $id;
				
			pn_include_extanded('sms', $id);
			
			do_action('pn_smsgate_active_'.$id);
			do_action('pn_smsgate_active', $id);
		}	

		update_option('pn_extended', $extended);
	}
		
	$ref = is_param_get('_wp_http_referer');
	$url = pn_admin_filter_data($ref, 'reply').'reply=true';		
	
	wp_redirect($url);
	exit;		
}

add_action('premium_action_pn_smsgate_deactivate','def_premium_action_pn_smsgate_deactivate');
function def_premium_action_pn_smsgate_deactivate(){
global $wpdb;	

	pn_only_caps(array('administrator','pn_merchants'));
			
	$id = is_extension_name(is_param_get('key'));	
	if($id){
		
		$extended = get_option('pn_extended');
		if(!is_array($extended)){ $extended = array(); }
			
		if(isset($extended['sms'][$id])){
			unset($extended['sms'][$id]);
			
			do_action('pn_smsgate_deactive_'.$id);
			do_action('pn_smsgate_deactive', $id);
				
			$merchants = get_option('smsgate');
			if(!is_array($merchants)){ $merchants = array(); }
			$merchants[$id] = 0;
			update_option('smsgate', $merchants);				
		}	

		update_option('pn_extended', $extended);
		
	}

	$ref = is_param_get('_wp_http_referer');
	$url = pn_admin_filter_data($ref, 'reply').'reply=true';		
	
	wp_redirect($url);
	exit;		
}	

class trev_smsgate_List_Table extends WP_List_Table { 

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
				<div class="active second plugin-version-author-uri">'. __('Version','pn') .': '. pn_strip_input($item['version']) .' '. apply_filters('smsgate_settingtext_'. $item['name'],'') .'</div>
			';
			
			return $html;
		} elseif($column_name == 'name'){
			$name = is_extension_name($item['name']);
			$name = str_replace('_theme','', $name);
			return $name;
		} elseif($column_name == 'place'){	
			$place = __('Plugin','pn');
			if(is_isset($item, 'place') == 'theme'){
				$place = __('Theme','pn');
			}
			return '<a href="'. admin_url('admin.php?page=pn_smsgate&place='. is_isset($item, 'place')) .'&mod='. is_param_get('mod') .'">'. $place . '</a>';			
		} elseif($column_name == 'status'){
			if($item['status'] == 'active'){
			
				$default = is_enable_smsgate($item['name']);
			
				$html = '
				<select name="" data-id="'. $item['name'] .'" class="merchant_change" autocomplete="off">	
					<option value="0" '. selected($default,0,false) .'>'. __('Deactivated','pn') .'</option>
					<option value="1" '. selected($default,1,false) .'>'. __('Activated','pn') .'</option>
				</select>
				';
				
				return $html;
			}
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
			$actions['deactive']  = '<a href="'. pn_link_post('pn_smsgate_deactivate'). '&key='. $item['name'] .'&_wp_http_referer=' . urlencode($_SERVER['REQUEST_URI']) .'">'. __('Deactivated','pn') .'</a>';
		} else {
			$actions['active']  = '<a href="'. pn_link_post('pn_smsgate_activate'). '&key='. $item['name'] .'&_wp_http_referer=' . urlencode($_SERVER['REQUEST_URI']) .'">'. __('Activated','pn') .'</a>';
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
			'name' => __('Folder name','pn'),
			'descr'     => __('SMS gate description','pn'),
			'place'     => __('Location','pn'),
			'status'     => __('Status','pn'),
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
			'active'    => __('Activated','pn'),
			'deactive'    => __('Deactivated','pn'),
        );
        return $actions;
    }
    
    function prepare_items() {
        global $wpdb; 
		
        $per_page = $this->get_items_per_page('trev_smsgate_per_page', 50);
        $current_page = $this->get_pagenum();
        
        $this->_column_headers = $this->get_column_info();
		$offset = ($current_page-1)*$per_page;

		$list = pn_list_extended('sms');
		$ndata = array();
		$mod = intval(is_param_get('mod'));
		$place = is_extension_name(is_param_get('place'));
		
		foreach($list as $list_key => $list_value){
			$module_status = $list_value['status'];
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

add_action('premium_screen_pn_smsgate','my_myscreen_pn_smsgate');
function my_myscreen_pn_smsgate() {
    $args = array(
        'label' => __('Display','pn'),
        'default' => 50,
        'option' => 'trev_smsgate_per_page'
    );
    add_screen_option('per_page', $args );	
	if(class_exists('trev_smsgate_List_Table')){
		new trev_smsgate_List_Table;
	}
}