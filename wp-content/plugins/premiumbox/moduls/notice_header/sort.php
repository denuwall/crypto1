<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_noticehead', 'def_adminpage_title_pn_sort_noticehead');
function def_adminpage_title_pn_sort_noticehead($page){
	_e('Sorting notifications','pn');
}

add_action('pn_adminpage_content_pn_sort_noticehead','def_pn_adminpage_content_pn_sort_noticehead');
function def_pn_adminpage_content_pn_sort_noticehead(){
global $wpdb;

	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);

	$form = new PremiumForm();
	
	$datas = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."notice_head WHERE auto_status = '1' AND status = '1' ORDER BY site_order ASC");	
	$sort_list = array();
	foreach($datas as $item){
		$sort_list[0][] = array(
			'title' => pn_strip_input(ctv_ml($item->text)),
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
			$.post("<?php pn_the_link_post('', 'post'); ?>", order, function(theResponse){
				$('#premium_ajax').hide();
			}); 															 
		}	 				
	});
});	
</script>	
<?php 
}

add_action('premium_action_pn_sort_noticehead','def_premium_action_pn_sort_noticehead');
function def_premium_action_pn_sort_noticehead(){
global $wpdb;	

	if(current_user_can('read')){
		$number = is_param_post('number');
		$y = 0;
		if(is_array($number)){	
			foreach($number as $theid) { $y++;
				$theid = intval($theid);
				$wpdb->query("UPDATE ".$wpdb->prefix."notice_head SET site_order='$y' WHERE id = '$theid'");	
			}	
		}
	}
} 