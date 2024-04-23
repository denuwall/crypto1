<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('myaction_request_cursparser','my_request_cursparser'); 
function my_request_cursparser(){
global $premiumbox;	
	
	$premiumbox->up_mode('get');
	
	if(function_exists('new_parser_upload_data') and check_hash_cron()){
		new_parser_upload_data();
		_e('Done','pn');
	} else {
		_e('Cron function does not exist','pn');
	}	
}

add_action('pn_adminpage_content_pn_cron','newparser_pn_adminpage_content_pn_cron',9);
add_action('pn_adminpage_content_pn_new_parser','newparser_pn_adminpage_content_pn_cron',9);
add_action('pn_adminpage_content_pn_settings_new_parser','newparser_pn_adminpage_content_pn_cron',9);
function newparser_pn_adminpage_content_pn_cron(){
?>
	<div class="premium_default_window">
		<?php _e('Cron URL for updating rates of CB and cryptocurrencies','pn'); ?><br /> 
		<a href="<?php echo get_site_url_or(); ?>/request-cursparser.html<?php echo get_hash_cron('?'); ?>" target="_blank"><?php echo get_site_url_or(); ?>/request-cursparser.html<?php echo get_hash_cron('?'); ?></a>
	</div>	
<?php
}

/* currency codes */
add_filter('pn_currency_code_addform', 'newparser_pn_currency_code_addform', 10, 2);
function newparser_pn_currency_code_addform($options, $data){
global $wpdb;
	
	$options[] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options[] = array(
		'view' => 'h3',
		'title' => '',
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	foreach($en_parsers as $item){
		$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
	}
	$options['new_parser'] = array(
		'view' => 'select',
		'title' => __('Automatic change of rate','pn'),
		'options' => $parsers,
		'default' => is_isset($data, 'new_parser'),
		'name' => 'new_parser',
		'work' => 'input',
	);	
	$options['new_parser_actions'] = array(
		'view' => 'inputbig',
		'title' => __('Add to rate','pn'),
		'default' => is_isset($data, 'new_parser_actions'),
		'name' => 'new_parser_actions',
	);
	
	return $options;
}

add_filter('pn_currency_code_addform_post', 'newparser_pn_currency_code_addform_post');
function newparser_pn_currency_code_addform_post($array){
	
	$array['new_parser'] = intval(is_param_post('new_parser'));
	$array['new_parser_actions'] = pn_parser_num(is_param_post('new_parser_actions'));
	
	return $array;
}

add_action('pn_currency_code_edit','newparser_pn_currency_code_edit', 10, 2);
add_action('pn_currency_code_add','newparser_pn_currency_code_edit', 10, 2);
function newparser_pn_currency_code_edit($data_id, $array){
	if($data_id){
		update_currency_code_to_new_parser($data_id);		
	}	
}

add_filter('currency_codes_manage_ap_columns', 'newparser_currency_codes_manage_ap_columns');
function newparser_currency_codes_manage_ap_columns($columns){
	$columns['new_parser'] = __('Rate automatic adjustment','pn');
	return $columns;
}

add_filter('currency_codes_manage_ap_col', 'newparser_currency_codes_manage_ap_col', 10, 3);
function newparser_currency_codes_manage_ap_col($html, $column_name, $item){
	
	if($column_name == 'new_parser'){	
		global $wpdb;
		$parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");

		$html = '
		<div style="width: 200px;">
		';
			$html = '
			<select name="new_parser['. $item->id .']" autocomplete="off" id="currency_code_new_parser_'. $item->id .'" class="currency_code_new_parser" style="width: 200px; display: block; margin: 0 0 10px;"> 
			';
				$enable = 0;
				$html .= '<option value="0" '. selected($item->new_parser,0,false) .'>-- '. __('No item','pn') .' --</option>';
				if(is_array($parsers)){
					foreach($parsers as $parser){
						if($item->new_parser == $parser->id){
							$enable = 1;
						}
							
						$html .= '<option value="'. $parser->id .'" '. selected($item->new_parser, $parser->id,false) .'>'. pn_strip_input($parser->title_pair_give).'-'.pn_strip_input($parser->title_pair_get).' ('. pn_strip_input(ctv_ml($parser->title_birg)) .')</option>';
					}
				}
			$style = 'style="display: none;"';	
			if($enable == 1){
				$style = '';
			}
				$html .= '
					</select>
					<div id="the_currency_code_new_parser_'. $item->id .'" '. $style .'>
						<input type="text" name="new_parser_actions['. $item->id .']" value="'. pn_strip_input($item->new_parser_actions) .'" />
					</div>		
				';
		$html .= '</div>';	
	}
	
	return $html;
}

add_action('pn_currency_codes_save','new_parser_pn_currency_codes_save');
function new_parser_pn_currency_codes_save(){
global $wpdb;
	
	$work_parser = 0;
	if(isset($_POST['new_parser']) and is_array($_POST['new_parser'])){	
		foreach($_POST['new_parser'] as $id => $parser_id){		
			$id = intval($id);
			$new_parser = intval($parser_id);
			$new_parser_actions = pn_parser_num($_POST['new_parser_actions'][$id]);							
					
			$array = array();
			if($new_parser > 0){
				$work_parser = 1;
				$array['new_parser'] = $new_parser;
				$array['new_parser_actions'] = $new_parser_actions;			
			} else {
				$array['new_parser'] = 0;
				$array['new_parser_actions'] = 0;										
			}	
			$wpdb->update($wpdb->prefix.'currency_codes', $array, array('id'=>$id));		
		}		
	}	
	if($work_parser == 1){
		update_currency_code_to_new_parser();
	}
}

add_action('pn_adminpage_content_pn_currency_codes','new_parser_pn_adminpage_content_pn_currency_codes');
function new_parser_pn_adminpage_content_pn_currency_codes(){
?>
	<style>
	.column-new_parser{ width: 200px!important; }
	</style>	
	<script type="text/javascript">
	$(function(){
		$('.currency_code_new_parser').on('change', function(){
			var id = $(this).attr('id').replace('currency_code_new_parser_','');
			var vale = $(this).val();
			if(vale > 0){
				$('#the_currency_code_new_parser_'+id).show();
			} else {
				$('#the_currency_code_new_parser_'+id).hide();
			}
		});		
	});
	</script>
<?php	
} 
/* end currency codes */

/* directions */
add_action('pn_adminpage_content_pn_directions', 'new_parser_pn_adminpage_content_pn_directions');
function new_parser_pn_adminpage_content_pn_directions(){
?>	
<style>
.column-new_parser{ width: 230px!important; }
</style>
<script type="text/javascript">
jQuery(function($){
	$('.directions_new_parser').change(function(){
		var id = $(this).attr('id').replace('directions_new_parser_','');
		var vale = $(this).val();
		if(vale > 0){
			$('#the_directions_new_parser_'+id).show();
		} else {
			$('#the_directions_new_parser_'+id).hide();
		}
	});			
});
</script>
<?php
}

add_filter('directions_manage_ap_columns', 'new_parser_directions_manage_ap_columns');
function new_parser_directions_manage_ap_columns($columns){
	
	$new_columns = array();
	foreach($columns as $k => $v){
		$new_columns[$k] = $v;
		if($k == 'course_get'){
			$new_columns['new_parser'] = __('Auto adjust rate','pn');
		}
	}
	
	return $new_columns;
}

add_action('pn_directions_save', 'new_parser_pn_directions_save');
function new_parser_pn_directions_save(){
global $wpdb;	
	
	$work_parser = 1;
	
	if(isset($_POST['new_parser']) and is_array($_POST['new_parser'])){ 	
		foreach($_POST['new_parser'] as $id => $parser_id){
						
			$id = intval($id);
			$parser = intval($parser_id);
			$nums1 = pn_parser_num($_POST['new_parser_actions_give'][$id]);			
			$nums2 = pn_parser_num($_POST['new_parser_actions_get'][$id]);
						
			$array = array();
			if($parser > 0){
				$work_parser = 1;
				$array['new_parser'] = $parser;
				$array['new_parser_actions_give'] = $nums1;			
				$array['new_parser_actions_get'] = $nums2;
			} else {
				$array['new_parser'] = 0;
				$array['new_parser_actions_give'] = 0;			
				$array['new_parser_actions_get'] = 0;							
			}
								
			$wpdb->update($wpdb->prefix.'directions', $array, array('id'=>$id));
						
		}			
	}	
	if($work_parser == 1){
		update_directions_to_new_parser();
	}
}

add_filter('directions_manage_ap_col', 'new_parser_directions_manage_ap_col', 10, 3);
function new_parser_directions_manage_ap_col($show, $column_name, $item){
	if($column_name == 'new_parser'){
		
		global $wpdb;
		$parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
			
		$html = '
		<div style="width: 230px;">
		';
			
		$html .= '
		<select name="new_parser['. $item->id .']" autocomplete="off" id="directions_new_parser_'. $item->id .'" class="directions_new_parser" style="width: 230px; display: block; margin: 0 0 10px;"> 
		';
			$enable = 0;
				$html .= '<option value="0" '. selected($item->new_parser,0,false) .'>-- '. __('No item','pn') .' --</option>';
			if(is_array($parsers)){
				foreach($parsers as $parser){
					if($item->new_parser == $parser->id){
						$enable = 1;
					}
						
					$html .= '<option value="'. $parser->id .'" '. selected($item->new_parser,$parser->id,false) .'>'. pn_strip_input($parser->title_pair_give).'-'.pn_strip_input($parser->title_pair_get).' ('. pn_strip_input(ctv_ml($parser->title_birg)) .')</option>';
				}
			}
				
		$style = 'style="display: none;"';	
		if($enable == 1){
			$style = '';
		}
				
		$html .= '
		</select>
			
		<div id="the_directions_new_parser_'. $item->id .'" '. $style .'>
			<input type="text" name="new_parser_actions_give['. $item->id .']" style="width: 95px; float: left; margin: 0px 0px 0 0;" value="'. pn_strip_input($item->new_parser_actions_give) .'" />
			<div style="float: left; margin: 3px 2px 0 2px;">=></div>
			<input type="text" name="new_parser_actions_get['. $item->id .']" style="width: 95px; float: left; margin: 0px 0px 0 0;" value="'. pn_strip_input($item->new_parser_actions_get) .'" />				
				<div class="premium_clear"></div>
		</div>		
		';
			
		$html .= '</div>';
			return $html;
	}
	
	return $show;
}

if(!has_filter('list_tabs_direction', 'parser_list_tabs_direction')){
	add_filter('list_tabs_direction', 'parser_list_tabs_direction');
	function parser_list_tabs_direction($list_tabs_direction){
		$new_list_tabs_direction = array();
		
		foreach($list_tabs_direction as $k => $v){
			$new_list_tabs_direction[$k] = $v;
			if($k == 'tab2'){
				$new_list_tabs_direction['tab3'] = __('Auto adjust rate','pn');
			}
		}
		
		return $new_list_tabs_direction;
	}
}

add_action('tab_direction_tab3', 'new_parser_tab_direction_tab3', 1, 2);
function new_parser_tab_direction_tab3($data, $data_id){

	global $wpdb;
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	if(is_array($en_parsers)){
		foreach($en_parsers as $item){
			$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
		}
	}
	?>
	<tr>
		<th><?php _e('Auto adjust rate','pn'); ?></th>
		<td>
				<div class="premium_wrap_standart">
					<select name="new_parser" id="the_new_parser_select" autocomplete="off"> 
						<?php foreach($parsers as $parser_key => $parser_title){ ?>
							<option value="<?php echo $parser_key; ?>" <?php selected(is_isset($data, 'new_parser'),$parser_key,true); ?>><?php echo $parser_title; ?></option>
						<?php } ?>
					</select>
				</div>
		</td>
		<td></td>
	</tr>
	<tr>
		<th><?php _e('Add to rate','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="new_parser_actions_give" value="<?php echo pn_strip_input(is_isset($data, 'new_parser_actions_give'));?>" />										
			</div>			
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="new_parser_actions_get" value="<?php echo pn_strip_input(is_isset($data, 'new_parser_actions_get'));?>" />											
			</div>	
		</td>
	</tr>	
<?php	
} 

add_filter('pn_direction_addform_post', 'new_parser_pn_direction_addform_post');
function new_parser_pn_direction_addform_post($array){

	$array['new_parser'] = $parser = intval(is_param_post('new_parser'));
	if($parser > 0){
		$array['new_parser_actions_give'] = pn_parser_num(is_param_post('new_parser_actions_give'));			
		$array['new_parser_actions_get'] = pn_parser_num(is_param_post('new_parser_actions_get'));
	} else {
		$array['new_parser_actions_give'] = 0;			
		$array['new_parser_actions_get'] = 0;				
	}	
	
	return $array;
}

add_action('pn_direction_edit', 'new_parser_pn_direction_edit',1,2);
add_action('pn_direction_add', 'new_parser_pn_direction_edit',1,2);
function new_parser_pn_direction_edit($data_id, $array){
	if($data_id){
		$parser = intval(is_param_post('new_parser'));
		if($parser > 0 and function_exists('update_directions_to_new_parser')){
			update_directions_to_new_parser($parser);
		}
	}	
}
/* end directions */

/* best */
add_action('pn_adminpage_content_pn_bc_adjs','new_parser_pn_admin_content_pn_bc_adjs');
function new_parser_pn_admin_content_pn_bc_adjs(){
?>	
<style>
.column-new_parser{ width: 230px!important; }
</style>
<script type="text/javascript">
jQuery(function($){
	$('.bcadjs_new_parser').change(function(){
		var id = $(this).attr('id').replace('bcadjs_new_parser_','');
		var vale = $(this).val();
		if(vale > 0){
			$('#the_bcadjs_new_parser_'+id).show();
		} else {
			$('#the_bcadjs_new_parser_'+id).hide();
		}
	});			
});
</script>
<?php
} 

add_filter('bcadjs_manage_ap_columns', 'new_parser_bcadjs_manage_ap_columns');
function new_parser_bcadjs_manage_ap_columns($columns){
	
	$new_columns = array();
	foreach($columns as $k => $v){
		$new_columns[$k] = $v;
		if($k == 'standart'){
			$new_columns['new_parser'] = __('Auto adjust rate','pn');
		}
	}
	
	return $new_columns;
}

add_action('pn_bcadjs_save', 'new_parser_pn_bcadjs_save');
function new_parser_pn_bcadjs_save(){
global $wpdb;	
	
	if(isset($_POST['standart_new_parser']) and is_array($_POST['standart_new_parser'])){ 		
		foreach($_POST['standart_new_parser'] as $id => $parser_id){
						
			$id = intval($id);
			$parser = intval($parser_id);
			$standart_parser_actions_give = pn_parser_num($_POST['standart_new_parser_actions_give'][$id]);			
			$standart_parser_actions_get = pn_parser_num($_POST['standart_new_parser_actions_get'][$id]);
						
			$array = array();
			if($parser > 0){
				$array['standart_new_parser'] = $parser;
				$array['standart_new_parser_actions_give'] = $standart_parser_actions_give;			
				$array['standart_new_parser_actions_get'] = $standart_parser_actions_get;
			} else {
				$array['standart_new_parser'] = 0;
				$array['standart_new_parser_actions_give'] = 0;			
				$array['standart_new_parser_actions_get'] = 0;							
			}
								
			$wpdb->update($wpdb->prefix.'bcbroker_directions', $array, array('id'=>$id));
						
		}			
	}	
}

add_filter('bcadjs_manage_ap_col', 'new_parser_bcadjs_manage_ap_col', 10, 3);
function new_parser_bcadjs_manage_ap_col($show, $column_name, $item){
	if($column_name == 'new_parser'){
		
		global $wpdb;
		$parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");			
			
		$html = '
		<div style="width: 230px;">
		';
			
		$html .= '
		<select name="standart_new_parser['. $item->id .']" autocomplete="off" id="bcadjs_new_parser_'. $item->id .'" class="bcadjs_new_parser" style="width: 230px; display: block; margin: 0 0 10px;"> 
		';
			$enable = 0;
				$html .= '<option value="0" '. selected($item->standart_new_parser,0,false) .'>-- '. __('No item','pn') .' --</option>';
			if(is_array($parsers)){
				foreach($parsers as $parser){
					if($item->standart_new_parser == $parser->id){
						$enable = 1;
					}
						
					$html .= '<option value="'. $parser->id .'" '. selected($item->standart_new_parser,$parser->id,false) .'>'. pn_strip_input($parser->title_pair_give).'-'.pn_strip_input($parser->title_pair_get).' ('. pn_strip_input(ctv_ml($parser->title_birg)) .')</option>';
				}
			}
				
		$style = 'style="display: none;"';	
		if($enable == 1){
			$style = '';
		}
				
		$html .= '
		</select>
			
		<div id="the_bcadjs_new_parser_'. $item->id .'" '. $style .'>
			<input type="text" name="standart_new_parser_actions_give['. $item->id .']" style="width: 95px; float: left; margin: 0px 0px 0 0;" value="'. pn_strip_input($item->standart_new_parser_actions_give) .'" />
			<div style="float: left; margin: 3px 2px 0 2px;">=></div>
			<input type="text" name="standart_new_parser_actions_get['. $item->id .']" style="width: 95px; float: left; margin: 0px 0px 0 0;" value="'. pn_strip_input($item->standart_new_parser_actions_get) .'" />				
				<div class="premium_clear"></div>
		</div>		
		';
			
		$html .= '</div>';
			return $html;
	}
	return $show;
}

add_filter('pn_bcadjs_addform', 'new_parser_pn_bcadjs_addform', 10, 2);
function new_parser_pn_bcadjs_addform($options, $data){
	
	global $wpdb;
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	if(is_array($en_parsers)){
		foreach($en_parsers as $item){
			$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
		}
	}	
		
	$new_options = array();
	foreach($options as $opt_key => $opt_val){
		$new_options[$opt_key] = $opt_val;
		
		if($opt_key == 'min_sum'){
			$new_options['minsum_new_parser_l1'] = array(
				'view' => 'line',
				'colspan' => 2,
			);			
			$new_options['minsum_new_parser'] = array(
				'view' => 'select',
				'title' => __('Auto adjust for min rate','pn'),
				'options' => $parsers,
				'default' => is_isset($data, 'minsum_new_parser'),
				'name' => 'minsum_new_parser',
				'work' => 'input',
			);	
			$new_options['minsum_new_parser_actions'] = array(
				'view' => 'inputbig',
				'title' => __('Add to min rate','pn'),
				'default' => is_isset($data, 'minsum_new_parser_actions'),
				'name' => 'minsum_new_parser_actions',
			);
			// $new_options['minsum_parser_l2'] = array(
				// 'view' => 'line',
				// 'colspan' => 2,
			// );			
		}
		if($opt_key == 'max_sum'){
			$new_options['maxsum_new_parser_l1'] = array(
				'view' => 'line',
				'colspan' => 2,
			);			
			$new_options['maxsum_new_parser'] = array(
				'view' => 'select',
				'title' => __('Auto adjust for max rate','pn'),
				'options' => $parsers,
				'default' => is_isset($data, 'maxsum_new_parser'),
				'name' => 'maxsum_new_parser',
				'work' => 'input',
			);	
			$new_options['maxsum_new_parser_actions'] = array(
				'view' => 'inputbig',
				'title' => __('Add to max rate','pn'),
				'default' => is_isset($data, 'maxsum_new_parser_actions'),
				'name' => 'maxsum_new_parser_actions',
			);
			// $new_options['maxsum_new_parser_l2'] = array(
				// 'view' => 'line',
				// 'colspan' => 2,
			// );			
		}
		if($opt_key == 'line4'){			
			$new_options['standart_new_parser'] = array(
				'view' => 'select',
				'title' => __('Automatic change of rate','pn'),
				'options' => $parsers,
				'default' => is_isset($data, 'standart_new_parser'),
				'name' => 'standart_new_parser',
				'work' => 'input',
			);	
			$new_options['standart_new_parser_actions_give'] = array(
				'view' => 'inputbig',
				'title' => __('Add to Send rate','pn'),
				'default' => is_isset($data, 'standart_new_parser_actions_give'),
				'name' => 'standart_new_parser_actions_give',
			);
			$new_options['standart_new_parser_actions_get'] = array(
				'view' => 'inputbig',
				'title' => __('Add to Receive rate','pn'),
				'default' => is_isset($data, 'standart_new_parser_actions_get'),
				'name' => 'standart_new_parser_actions_get',
			);
			// $new_options['standart_parser_l1'] = array(
				// 'view' => 'line',
				// 'colspan' => 2,
			// );			
		}
	}
	
	return $new_options;
}

add_filter('pn_bcadjs_addform_post', 'new_parser_pn_bcadjs_addform_post');
function new_parser_pn_bcadjs_addform_post($array){
	
	$array['standart_new_parser'] = intval(is_param_post('standart_new_parser'));
	$array['standart_new_parser_actions_give'] = pn_parser_num(is_param_post('standart_new_parser_actions_give'));
	$array['standart_new_parser_actions_get'] = pn_parser_num(is_param_post('standart_new_parser_actions_get'));
	$array['minsum_new_parser'] = intval(is_param_post('minsum_new_parser'));
	$array['minsum_new_parser_actions'] = pn_parser_num(is_param_post('minsum_new_parser_actions'));
	$array['maxsum_new_parser'] = intval(is_param_post('maxsum_new_parser'));
	$array['maxsum_new_parser_actions'] = pn_parser_num(is_param_post('maxsum_new_parser_actions'));
	
	return $array;
}

add_action('tab_bcbroker_min_sum', 'new_parser_tab_bcbroker_min_sum', 10, 2);
function new_parser_tab_bcbroker_min_sum($data, $broker){
	
	global $wpdb;
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	if(is_array($en_parsers)){
		foreach($en_parsers as $item){
			$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
		}
	}
	?>
	<div class="premium_wrap_standart">
		<select name="bcadjs_minsum_new_parser" autocomplete="off"> 
			<?php foreach($parsers as $parser_key => $parser_title){ ?>
				<option value="<?php echo $parser_key; ?>" <?php selected(is_isset($broker, 'minsum_new_parser'),$parser_key,true); ?>><?php echo $parser_title; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="premium_wrap_standart">
		<input type="text" name="bcadjs_minsum_new_parser_actions" value="<?php echo pn_strip_input(is_isset($broker, 'minsum_new_parser_actions'));?>" /> <?php _e('Add to rate','pn'); ?>										
	</div>				
<?php	
}

add_action('tab_bcbroker_max_sum', 'new_parser_tab_bcbroker_max_sum', 10, 2);
function new_parser_tab_bcbroker_max_sum($data, $broker){
	
	global $wpdb;
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	if(is_array($en_parsers)){
		foreach($en_parsers as $item){
			$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
		}
	}
	?>
	<div class="premium_wrap_standart">
		<select name="bcadjs_maxsum_new_parser" autocomplete="off"> 
			<?php foreach($parsers as $parser_key => $parser_title){ ?>
				<option value="<?php echo $parser_key; ?>" <?php selected(is_isset($broker, 'maxsum_new_parser'),$parser_key,true); ?>><?php echo $parser_title; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="premium_wrap_standart">
		<input type="text" name="bcadjs_maxsum_new_parser_actions" value="<?php echo pn_strip_input(is_isset($broker, 'maxsum_new_parser_actions'));?>" /> <?php _e('Add to rate','pn'); ?>										
	</div>				
<?php	
}

add_action('tab_bcbroker_standart_course', 'new_parser_tab_bcbroker_standart_course', 10, 2);
function new_parser_tab_bcbroker_standart_course($data, $broker){

	global $wpdb;
	$parsers = array();
	$parsers[0] = '-- '. __('No item','pn') .' --';
	$en_parsers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs ORDER BY menu_order ASC");
	if(is_array($en_parsers)){
		foreach($en_parsers as $item){
			$parsers[$item->id] = pn_strip_input($item->title_pair_give).'-'.pn_strip_input($item->title_pair_get).' ('. pn_strip_input(ctv_ml($item->title_birg)) .')';
		}
	}
	?>
	<tr>
		<th><?php _e('Auto adjust rate','pn'); ?></th>
		<td>
				<div class="premium_wrap_standart">
					<select name="bcadjs_standart_new_parser" autocomplete="off"> 
						<?php foreach($parsers as $parser_key => $parser_title){ ?>
							<option value="<?php echo $parser_key; ?>" <?php selected(is_isset($broker, 'standart_new_parser'),$parser_key,true); ?>><?php echo $parser_title; ?></option>
						<?php } ?>
					</select>
				</div>
		</td>
		<td></td>
	</tr>
	<tr>
		<th><?php _e('Add to rate','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="bcadjs_standart_new_parser_actions_give" value="<?php echo pn_strip_input(is_isset($broker, 'standart_new_parser_actions_give'));?>" />										
			</div>			
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="bcadjs_standart_new_parser_actions_get" value="<?php echo pn_strip_input(is_isset($broker, 'standart_new_parser_actions_get'));?>" />											
			</div>	
		</td>
	</tr>	
<?php	
}

add_filter('pn_bcadjs_tab_addform_post', 'new_parser_pn_bcadjs_tab_addform_post');
function new_parser_pn_bcadjs_tab_addform_post($array){
	
	$array['standart_new_parser'] = intval(is_param_post('bcadjs_standart_new_parser'));
	$array['standart_new_parser_actions_give'] = pn_parser_num(is_param_post('bcadjs_standart_new_parser_actions_give'));
	$array['standart_new_parser_actions_get'] = pn_parser_num(is_param_post('bcadjs_standart_new_parser_actions_get'));
	$array['minsum_new_parser'] = intval(is_param_post('bcadjs_minsum_new_parser'));
	$array['minsum_new_parser_actions'] = pn_parser_num(is_param_post('bcadjs_minsum_new_parser_actions'));
	$array['maxsum_new_parser'] = intval(is_param_post('bcadjs_maxsum_new_parser'));
	$array['maxsum_new_parser_actions'] = pn_parser_num(is_param_post('bcadjs_maxsum_new_parser_actions'));
	
	return $array;
}

add_filter('bcparser_def_course', 'new_parser_bcparser_def_course', 10, 6);
function new_parser_bcparser_def_course($darr, $item, $options, $direction, $vd1, $vd2){
global $pn_parser_pairs_cours, $wpdb;
	
	$pairs = get_parser_pairs();
	
	if(!is_array($pn_parser_pairs_cours)){
		$pn_parser_pairs_cours = array();
		$lists = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."parser_pairs");
		foreach($lists as $list){
			$pn_parser_pairs_cours[$list->id] = $list;
		}
	}
	
	$name_column = intval($item->name_column);
	$partofrate = intval(is_isset($options,'partofrate'));
	$conversion = intval(is_isset($options,'conversion'));
	
	$minsum_parser = intval($item->minsum_new_parser);
	$minsum_parser_actions = pn_strip_input($item->minsum_new_parser_actions);
	if($minsum_parser > 0 and isset($pn_parser_pairs_cours[$minsum_parser])){
		$curs_data = $pn_parser_pairs_cours[$minsum_parser];
		$curs1 = get_parser_course($curs_data->pair_give, $pairs);
		$curs2 = get_parser_course($curs_data->pair_get, $pairs);
		$curs = 0;
		if($curs1 and $curs2){
			if($name_column == 0 and $partofrate == 1){
				if($conversion == 0){
					$curs = is_sum($curs1/$curs2);
				} else {
					$curs = is_sum($curs1);
				}				
			} else {
				if($conversion == 0){
					$curs = is_sum($curs2/$curs1);
				} else {
					$curs = is_sum($curs2);
				}
			}
		}
		
		$ncurs = rate_plus_interest($curs, $minsum_parser_actions);				
		if($ncurs > 0){
			$darr['min_sum'] = $ncurs;
		}
	}

	$maxsum_parser = intval($item->maxsum_new_parser);
	$maxsum_parser_actions = pn_strip_input($item->maxsum_new_parser_actions);
	if($maxsum_parser > 0 and isset($pn_parser_pairs_cours[$maxsum_parser])){
		$curs_data = $pn_parser_pairs_cours[$maxsum_parser];
		$curs1 = get_parser_course($curs_data->pair_give, $pairs);
		$curs2 = get_parser_course($curs_data->pair_get, $pairs);		
		$curs = 0;
		if($curs1 and $curs2){
			if($name_column == 0 and $partofrate == 1){
				if($conversion == 0){
					$curs = is_sum($curs1/$curs2);
				} else {
					$curs = is_sum($curs1);
				}
			} else {
				if($conversion == 0){
					$curs = is_sum($curs2/$curs1);
				} else {
					$curs = is_sum($curs2);
				}
			}
		}
		
		$ncurs = rate_plus_interest($curs, $maxsum_parser_actions);				
		if($ncurs > 0){
			$darr['max_sum'] = $ncurs;
		}
	}	
	
	$standart_parser = intval($item->standart_new_parser);
	$standart_parser_actions_give = pn_strip_input($item->standart_new_parser_actions_give);
	$standart_parser_actions_get = pn_strip_input($item->standart_new_parser_actions_get);
	if($standart_parser > 0 and isset($pn_parser_pairs_cours[$standart_parser])){
		$curs_data = $pn_parser_pairs_cours[$standart_parser];
		$curs1 = get_parser_course($curs_data->pair_give, $pairs);
		$curs2 = get_parser_course($curs_data->pair_get, $pairs);	
		$n_course_give = is_sum(rate_plus_interest($curs1, $standart_parser_actions_give), $vd1->currency_decimal);
		$n_course_get = is_sum(rate_plus_interest($curs2, $standart_parser_actions_get), $vd2->currency_decimal);				
		if($n_course_give > 0 and $n_course_get > 0){
			$darr['standart_course_give'] = $n_course_give;
			$darr['standart_course_get'] = $n_course_get;
		}
	}				
	
	return $darr;
}
/* end best */