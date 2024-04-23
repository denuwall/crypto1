<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_table3', 'pn_admin_title_pn_sort_table3');
function pn_admin_title_pn_sort_table3(){
	printf(__('Sort exchange direction for exchange table %s','pn'),'3');
}

add_action('pn_adminpage_content_pn_sort_table3','def_pn_admin_content_pn_sort_table3');
function def_pn_admin_content_pn_sort_table3(){
global $wpdb;

	$form = new PremiumForm();

	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status='1' AND direction_status='1' ORDER BY to3_1 ASC");	
	$sort_list = array();
	foreach($items as $item){
		$sort_list[0][] = array(
			'title' => pn_strip_input($item->tech_name),
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
				$.post("<?php pn_the_link_post('sort_naps_table3','post'); ?>", order, function(theResponse){
					$('#premium_ajax').hide();
				}); 															 
			}	 				
		});
	});	
	</script>	
<?php
}

add_action('premium_action_sort_naps_table3','def_premium_action_sort_naps_table3');
function def_premium_action_sort_naps_table3(){
global $wpdb;	
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		only_post();
			$number = is_param_post('number');
			$y = 0;
			if(is_array($number)){
				foreach($number as $theid) { $y++;
					$theid = intval($theid);
					$wpdb->query("UPDATE ".$wpdb->prefix."directions SET to3_1='$y' WHERE id = '$theid'");
				}
			}
	}
}