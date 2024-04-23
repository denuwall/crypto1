<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_directions', 'pn_admin_title_pn_sort_directions');
function pn_admin_title_pn_sort_directions(){
	_e('Sort exchange directions','pn');
}

add_action('pn_adminpage_content_pn_sort_directions','def_pn_admin_content_pn_sort_directions');
function def_pn_admin_content_pn_sort_directions(){
global $wpdb;

	$form = new PremiumForm();

	$items = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status='1' AND direction_status='1' ORDER BY site_order1 ASC");
	$sort_list = array();
	foreach($items as $item){
		$sort_list[0][] = array(
			'title' => $item->tech_name,
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
				$.post("<?php pn_the_link_post('pn_sort_directions','post'); ?>", order, function(theResponse){
					$('#premium_ajax').hide();
				}); 															 
			}	 				
		});

	});	
	</script>	
<?php
}


add_action('premium_action_pn_sort_directions','def_premium_action_pn_sort_directions');
function def_premium_action_pn_sort_directions(){
global $wpdb;	

	if(current_user_can('administrator') or current_user_can('pn_directions')){
		only_post();
			$number = is_param_post('number');
			$y = 0;
			if(is_array($number)){
				foreach($number as $theid) { $y++;
					$theid = intval($theid);
					$wpdb->query("UPDATE ".$wpdb->prefix."directions SET site_order1='$y' WHERE id = '$theid'");
				}
			}
	}
}