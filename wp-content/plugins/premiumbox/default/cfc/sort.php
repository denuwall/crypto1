<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_sort_cfc', 'pn_admin_title_pn_sort_cfc');
function pn_admin_title_pn_sort_cfc(){
	_e('Sort custom fields','pn');
}

add_action('pn_adminpage_content_pn_sort_cfc','def_pn_admin_content_pn_sort_cfc');
function def_pn_admin_content_pn_sort_cfc(){
global $wpdb;

	$selects = array();

	$form = new PremiumForm();
	
	$places_t =array();
	$place = is_param_get('place');
	$valuts = apply_filters('list_currency_manage', array(), __('Make a choice','pn'));
	foreach($valuts as $key => $v){
		if($key){
			$places_t[] = $key;
		}
		$selects[] = array(
			'link' => admin_url("admin.php?page=pn_sort_cfc&place=".$key),
			'title' => $v,
			'default' => $key,
		);		
	}
	
	$form->select_box($place, $selects, __('Make a choice','pn'));

	if(in_array($place, $places_t)){
		$place = intval($place);
		$datas = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency_custom_fields WHERE auto_status = '1' AND currency_id='$place' ORDER BY cf_order ASC");	
		
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
}


add_action('premium_action_pn_sort_cfc','def_premium_action_pn_sort_cfc');
function def_premium_action_pn_sort_cfc(){
global $wpdb;	
	if(current_user_can('administrator') or current_user_can('pn_cfc')){
		only_post();
		$number = is_param_post('number');
		$y = 0;
		if(is_array($number)){
			foreach($number as $theid) { $y++;
				$theid = intval($theid);
				$wpdb->query("UPDATE ".$wpdb->prefix."currency_custom_fields SET cf_order='$y' WHERE id = '$theid'");	
			}	
		}
	}
}