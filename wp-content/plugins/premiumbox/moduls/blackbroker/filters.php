<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_direction_delete', 'pn_direction_delete_blackbroker');
function pn_direction_delete_blackbroker($item_id){
global $wpdb;	
	$wpdb->query("DELETE FROM ".$wpdb->prefix."blackbrokers_naps WHERE naps_id = '$item_id'");
}

add_action('pn_direction_copy', 'pn_direction_copy_blackbroker', 1, 2);
function pn_direction_copy_blackbroker($last_id, $new_id){
global $wpdb;

	$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."blackbrokers_naps WHERE naps_id='$last_id'"); 
	if(isset($broker->id)){
		$arr = array();
		$arr['naps_id'] = $new_id;
		$arr['site_id'] = intval($broker->site_id);
		$arr['step_column'] = intval($broker->step_column);
		$arr['step'] = is_sum($broker->step);
		$arr['cours1'] = is_sum($broker->cours1);
		$arr['cours2'] = is_sum($broker->cours2);
		$arr['min_sum'] = is_sum($broker->min_sum);
		$arr['max_sum'] = is_sum($broker->max_sum);
		$arr['item_from'] = is_xml_value($broker->item_from);
		$arr['item_to'] = is_xml_value($broker->item_to);
		$wpdb->insert($wpdb->prefix.'blackbrokers', $arr);
	}
	
}

add_filter('list_tabs_direction', 'blackbroker_list_tabs_direction');
function blackbroker_list_tabs_direction($list_tabs){
	$new_list_tabs = array();
		
	foreach($list_tabs as $k => $v){
		$new_list_tabs[$k] = $v;
		if($k == 'tab2'){
			$new_list_tabs['auto_broker'] = __('Auto broker','pn');
		}
	}
		
	return $new_list_tabs;
}

add_action('tab_direction_auto_broker', 'tab_direction_auto_broker_blackbroker',11,2);
function tab_direction_auto_broker_blackbroker($data, $data_id){	
global $wpdb;

	if(isset($data->id)){ 
		$data_id = $data->id;
		
		$step_column = 0;
		$site_id = 0;
		
		$sites = array();
		$sites[0] = '--'. __('No item','pn') .'--';
		$blackbrokers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."blackbrokers");
		foreach($blackbrokers as $blackbroker){
			$sites[$blackbroker->id] = pn_strip_input($blackbroker->title);
		}
		
		$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."blackbrokers_naps WHERE naps_id='$data_id'"); 
		if(isset($broker->id)){
			$step_column = $broker->step_column;
			$site_id = $broker->site_id;			
		}
	?>
		<tr>
			<th><?php _e('Exchange rate','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<?php echo is_sum(is_isset($data, 'course_give')); ?>
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<?php echo is_sum(is_isset($data, 'course_get')); ?>	
				</div>			
			</td>
		</tr>	
		<tr>
			<th></th>
			<td>
				<div class="premium_wrap_standart">
					<div style="margin: 0 0 10px 0;">
						<select name="bbr_site_id" autocomplete="off">
							<?php foreach($sites as $sites_id => $site_title){ ?>
								<option value="<?php echo $sites_id; ?>" <?php selected($site_id,$sites_id); ?>><?php echo $site_title; ?></option>
							<?php } ?>
						</select>					
					</div>
					<div>
						<select name="bbr_step_column" autocomplete="off">
							<option value="0" <?php selected($step_column,0); ?>><?php _e('Correct rate Send','pn'); ?></option>
							<option value="1" <?php selected($step_column,1); ?>><?php _e('Correct rate Receive','pn'); ?></option>
						</select>					
					</div>					
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<div><input type="text" name="bbr_step" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'step')); ?>" /> <?php _e('Step','pn'); ?></div>
					<div><input type="text" name="bbr_min_sum" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'min_sum')); ?>" /> <?php _e('Min rate','pn'); ?></div>
					<div><input type="text" name="bbr_max_sum" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'max_sum')); ?>" /> <?php _e('Max rate','pn'); ?></div>
				</div>							
			</td>			
		</tr>
		<tr>
			<th><?php _e('Standard rate','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bbr_cours1" style="width: 200px;" value="<?php echo is_sum(is_isset($broker, 'cours1')); ?>" />
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bbr_cours2" style="width: 200px;" value="<?php echo is_sum(is_isset($broker, 'cours2')); ?>" />	
				</div>			
			</td>
		</tr>
		<tr>
			<th><?php _e('XML currency code','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bbr_item1" style="width: 200px;" value="<?php echo is_xml_value(is_isset($broker, 'item_from')); ?>" />
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bbr_item2" style="width: 200px;" value="<?php echo is_xml_value(is_isset($broker, 'item_to')); ?>" />	
				</div>			
			</td>
		</tr>
	<?php  
	}
} 

add_action('pn_direction_edit', 'pn_direction_edit_blackbroker', 10, 2);
add_action('pn_direction_add', 'pn_direction_edit_blackbroker', 10, 2);
function pn_direction_edit_blackbroker($data_id, $array){
global $wpdb;	

	if($data_id){
		$site_id = intval(is_param_post('bbr_site_id'));
		if($site_id > 0){
			$arr = array();
			$arr['naps_id'] = $data_id;
			$arr['site_id'] = intval(is_param_post('bbr_site_id'));
			$arr['step_column'] = intval(is_param_post('bbr_step_column'));
			$arr['step'] = is_sum(is_param_post('bbr_step'));
			$arr['min_sum'] = is_sum(is_param_post('bbr_min_sum'));
			$arr['max_sum'] = is_sum(is_param_post('bbr_max_sum'));
			$arr['cours1'] = is_sum(is_param_post('bbr_cours1'));
			$arr['cours2'] = is_sum(is_param_post('bbr_cours2'));
			$arr['item_from'] = is_xml_value(is_param_post('bbr_item1'));
			$arr['item_to'] = is_xml_value(is_param_post('bbr_item2'));			
			
			$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."blackbrokers_naps WHERE naps_id='$data_id'"); 
			if(isset($broker->id)){
				$wpdb->update($wpdb->prefix."blackbrokers_naps", $arr, array('id'=>$broker->id));
			} else {
				$wpdb->insert($wpdb->prefix."blackbrokers_naps", $arr);
			}
			
			request_blackbroker();			
		} else {
			$wpdb->query("DELETE FROM ".$wpdb->prefix."blackbrokers_naps WHERE naps_id = '$data_id'");
		}
	}
}