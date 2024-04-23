<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_cf', 'pn_admin_title_pn_sort_cf');
function pn_admin_title_pn_sort_cf(){
	_e('Sort custom fields','pn');
}

add_action('pn_adminpage_content_pn_sort_cf','def_pn_admin_content_pn_sort_cf');
function def_pn_admin_content_pn_sort_cf(){
global $wpdb;

	$form = new PremiumForm();

	$datas = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."direction_custom_fields WHERE auto_status = '1' ORDER BY cf_order ASC");
	$sort_list = array();
	foreach($datas as $item){
		$sort_list[0][] = array(
			'title' => pn_strip_input(ctv_ml($item->tech_name)),
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
			$.post("<?php pn_the_link_post('','post'); ?>", order, function(theResponse){
				$('#premium_ajax').hide();
			}); 															 
		}	 				
	});

});	
</script>	
<?php 
}


add_action('premium_action_pn_sort_cf','def_premium_action_pn_sort_cf');
function def_premium_action_pn_sort_cf(){
global $wpdb;	
	only_post();
	if(current_user_can('administrator') or current_user_can('pn_directions')){
		$number = is_param_post('number');
		$y = 0;
		if(is_array($number)){	
			foreach($number as $theid) { $y++;
				$theid = intval($theid);
				$wpdb->query("UPDATE ".$wpdb->prefix."direction_custom_fields SET cf_order='$y' WHERE id = '$theid'");
			}
		}
	}
}