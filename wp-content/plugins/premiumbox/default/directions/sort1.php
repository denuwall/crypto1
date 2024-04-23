<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_table1', 'pn_admin_title_pn_sort_table1');
function pn_admin_title_pn_sort_table1(){
	printf(__('Sort exchange direction for exchange table %s','pn'),'1,4');
}

add_action('pn_adminpage_content_pn_sort_table1','def_pn_admin_content_pn_sort_table1');
function def_pn_admin_content_pn_sort_table1(){
global $wpdb;

	$form = new PremiumForm();

	$places = $places_t = array();
	$place = is_param_get('place');
	$datas = $wpdb->get_results("SELECT DISTINCT(currency_id_give) FROM ".$wpdb->prefix."directions WHERE auto_status='1' AND direction_status='1' ORDER BY to1 ASC");
	foreach($datas as $val){
		$places[$val->currency_id_give] = get_currency_title_by_id($val->currency_id_give);
		$places_t[] = $val->currency_id_give;
	}
	$selects = array();
	$selects[] = array(
		'link' => admin_url("admin.php?page=pn_sort_table1"),
		'title' => '--' . __('Left column','pn') . '--',
		'background' => '',
		'default' => '',
	);		
	if(is_array($places)){ 
		foreach($places as $key => $val){ 
			$selects[] = array(
				'link' => admin_url("admin.php?page=pn_sort_table1&place=".$key),
				'title' => $val,
				'background' => '',
				'default' => $key,
			);		
		}
	}		
	$form->select_box($place, $selects, __('Setting up','pn'));

if(in_array($place, $places_t)){
	$place = intval($place);
	$items = $wpdb->get_results("SELECT *, ".$wpdb->prefix."directions_order.id AS item_id FROM ".$wpdb->prefix."directions LEFT OUTER JOIN ".$wpdb->prefix."directions_order ON(".$wpdb->prefix."directions.id = ".$wpdb->prefix."directions_order.direction_id) WHERE ".$wpdb->prefix."directions.auto_status='1' AND ".$wpdb->prefix."directions.direction_status='1' AND ".$wpdb->prefix."directions.currency_id_give='$place' AND ".$wpdb->prefix."directions_order.c_id='$place'  ORDER BY ".$wpdb->prefix."directions_order.order1 ASC");	

	$sort_list = array();
	foreach($items as $item){
		$sort_list[0][] = array(
			'title' => get_currency_title_by_id($item->currency_id_get),
			'id' => $item->id,
			'number' => $item->id,
		);		
	}
	$form->sort_one_screen($sort_list);	
?>	
	<script type="text/javascript">
	$(document).ready(function(){ 									   
		$(".thesort ul").sortable({ 
			opacity: 0.6, 
			cursor: 'move',
			revert: true,
			update: function() {
				$('#premium_ajax').show();
				var order = $(this).sortable("serialize"); 
				$.post("<?php pn_the_link_post('pn_sort_table1_sort','post'); ?>", order, function(theResponse){
					$('#premium_ajax').hide();
				}); 															 
			}	 				
		});
	});	
	</script>	
<?php
} else {
	$sort_list = array();
	foreach($datas as $item){
		$sort_list[0][] = array(
			'title' => get_currency_title_by_id($item->currency_id_give),
			'id' => $item->currency_id_give,
			'number' => $item->currency_id_give,
		);		
	}
	$form->sort_one_screen($sort_list);	
?>	
	<script type="text/javascript">
	$(document).ready(function(){ 									   
		$(".thesort ul").sortable({ 
			opacity: 0.6, 
			cursor: 'move',
			revert: true,
			update: function() {
				$('#premium_ajax').show();
				var order = $(this).sortable("serialize"); 
				$.post("<?php pn_the_link_post('pn_sort_table1_left','post'); ?>", order, function(theResponse){
					$('#premium_ajax').hide();
				}); 															 
			}	 				
		});
	});	
	</script>	
<?php
} 	
}

add_action('premium_action_pn_sort_table1_left','def_premium_action_pn_sort_table1_left');
function def_premium_action_pn_sort_table1_left(){
global $wpdb;	
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		only_post();
	
			$number = is_param_post('number');
			$y = 0;
			if(is_array($number)){
				foreach($number as $theid) { $y++;
					$theid = intval($theid);
					$wpdb->query("UPDATE ".$wpdb->prefix."directions SET to1='$y' WHERE currency_id_give = '$theid'");
				}
			}
	}
}

add_action('premium_action_pn_sort_table1_sort','def_premium_action_pn_sort_table1_sort');
function def_premium_action_pn_sort_table1_sort(){
global $wpdb;	
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		only_post();
	
		$number = is_param_post('number');
		$y = 0;
		if(is_array($number)){	
			foreach($number as $theid) { $y++;
				$theid = intval($theid);
				$wpdb->query("UPDATE ".$wpdb->prefix."directions_order SET order1='$y' WHERE id = '$theid'");	
			}	
		}
	}
}