<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_direction_copy', 'pn_direction_copy_bcbroker', 1, 2); 
function pn_direction_copy_bcbroker($last_id, $new_id){
global $wpdb;
	$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id='$last_id'"); 
	if(isset($broker->id)){
		$arr = array();
		foreach($broker as $k => $v){
			$arr[$k] = $v;
		}
		$arr['direction_id'] = $new_id;		
		$wpdb->insert($wpdb->prefix.'bcbroker_directions', $arr);
	}
}

add_filter('list_tabs_direction', 'bcbroker_list_tabs_direction');
function bcbroker_list_tabs_direction($list_tabs){
	$new_list_tabs = array();
		
	foreach($list_tabs as $k => $v){
		$new_list_tabs[$k] = $v;
		if($k == 'tab2'){
			$new_list_tabs['bcbroker'] = __('BestChange parser','pn');
		}
	}
		
	return $new_list_tabs;
}
 
add_action('tab_direction_bcbroker', 'def_tab_direction_bcbroker');
function def_tab_direction_bcbroker($data){	
global $wpdb;
	if(isset($data->id)){ 
		$data_id = $data->id;
		
		$name_column = 0;
		$now_sort = 0;
		$v1 = 0;
		$v2 = 0;
		$reset_course = 0;
		$status = 0;
		
		$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id='$data_id'"); 
		if(isset($broker->id)){
			$name_column = $broker->name_column;
			$now_sort = $broker->now_sort;
			$v1 = $broker->v1;
			$v2 = $broker->v2;
			$reset_course = $broker->reset_course;
			$status = $broker->status;
		}
		
		$alls = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes ORDER BY currency_code_title ASC"); 
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
			<th><?php _e('Enable parser','pn'); ?></th>
			<td colspan="2">
				<div class="premium_wrap_standart">
					<select name="bcbroker_status" autocomplete="off">
						<option value="0" <?php selected($status,0); ?>><?php _e('No','pn'); ?></option>
						<option value="1" <?php selected($status,1); ?>><?php _e('Yes','pn'); ?></option>
					</select>
				</div>	
			</td>
		</tr>	
		<tr>
			<th></th>
			<td>
				<div class="premium_wrap_standart">
					<select name="bcbroker_v1" autocomplete="off">
						<option value="0">--<?php _e('Send','pn'); ?>--</option>
						<?php foreach($alls as $all){ ?>
							<option value="<?php echo $all->currency_code_id; ?>" <?php if($all->currency_code_id == $v1){ ?>selected="selected"<?php } ?>><?php echo pn_strip_input($all->currency_code_title); ?></option>
						<?php } ?>
					</select>					
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<select name="bcbroker_v2" autocomplete="off">
						<option value="0">--<?php _e('Receive','pn'); ?>--</option>
						<?php foreach($alls as $all){ ?>
							<option value="<?php echo $all->currency_code_id; ?>" <?php if($all->currency_code_id == $v2){ ?>selected="selected"<?php } ?>><?php echo pn_strip_input($all->currency_code_title); ?></option>
						<?php } ?>
					</select>
				</div>							
			</td>			
		</tr>
		<tr>
			<th></th>
			<td>
				<div class="premium_wrap_standart">
					<select name="bcbroker_name_column" autocomplete="off">
						<option value="0" <?php selected($name_column,0); ?>><?php printf(__('Correct rate "%s"','pn'), __('Send','pn')); ?></option>
						<option value="1" <?php selected($name_column,1); ?>><?php printf(__('Correct rate "%s"','pn'), __('Receive','pn')); ?></option>
					</select>					
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<select name="bcbroker_now_sort" autocomplete="off">
						<option value="0" <?php selected($now_sort,0); ?>><?php _e('Sort rate by desc','pn'); ?></option>
						<option value="1" <?php selected($now_sort,1); ?>><?php _e('Sort rate by asc','pn'); ?></option>
					</select>
				</div>							
			</td>			
		</tr>		
		<tr>
			<th></th>
			<td>
				<div class="premium_wrap_standart">
					<div><input type="text" name="bcbroker_pars_position" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'pars_position')); ?>" /> <?php _e('Position','pn'); ?></div>
					<div><input type="text" name="bcbroker_min_res" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'min_res')); ?>" /> <?php _e('Min reserve for position','pn'); ?></div>
				</div>
			</td>
			<td>
				<div class="premium_wrap_standart">
					<div><input type="text" name="bcbroker_step" style="width: 100px;" value="<?php echo pn_strip_input(is_isset($broker, 'step')); ?>" /> <?php _e('Step','pn'); ?></div>	
				</div>
			</td>
		</tr>		
		<tr>
			<th></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bcbroker_min_sum" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'min_sum')); ?>" /> <?php _e('Min rate','pn'); ?>
				</div>
				<?php do_action('tab_bcbroker_min_sum', $data, $broker); ?>
			</td>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bcbroker_max_sum" style="width: 100px;" value="<?php echo is_sum(is_isset($broker, 'max_sum')); ?>" /> <?php _e('Max rate','pn'); ?>	
				</div>
				<?php do_action('tab_bcbroker_max_sum', $data, $broker); ?>
			</td>
		</tr>		
		<tr>
			<th><?php _e('Reset to standard rate','pn'); ?></th>
			<td colspan="2">
				<div class="premium_wrap_standart">
					<select name="bcbroker_reset_course" autocomplete="off">
						<option value="0" <?php selected($reset_course,0); ?>><?php _e('Yes','pn'); ?></option>
						<option value="1" <?php selected($reset_course,1); ?>><?php _e('No','pn'); ?></option>
					</select>
				</div>	
			</td>
		</tr>		
		<tr>
			<th><?php _e('Standard rate','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bcbroker_standart_course_give" style="width: 200px;" value="<?php echo is_sum(is_isset($broker, 'standart_course_give')); ?>" />
				</div>			
			</td>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="bcbroker_standart_course_get" style="width: 200px;" value="<?php echo is_sum(is_isset($broker, 'standart_course_get')); ?>" />	
				</div>			
			</td>
		</tr>
		<?php do_action('tab_bcbroker_standart_course', $data, $broker); ?>
	<?php  
	} 
}  

add_action('pn_direction_edit', 'pn_direction_edit_bcbroker', 10, 2);
add_action('pn_direction_add', 'pn_direction_edit_bcbroker', 10, 2);
function pn_direction_edit_bcbroker($direction_id, $direction_array){
global $wpdb;
	
	if($direction_id){
		$vid1 = intval(is_param_post('bcbroker_v1'));
		$vid2 = intval(is_param_post('bcbroker_v2'));
		if($vid1 > 0 and $vid2 > 0){
			$v1 = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes WHERE currency_code_id='$vid1'");
			$v2 = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_currency_codes WHERE currency_code_id='$vid2'");
			if(isset($v1->id) and isset($v2->id)){
				
				$arr = array();
				$arr['direction_id'] = $direction_id;
				$arr['v1'] = intval($v1->currency_code_id);
				$arr['v2'] = intval($v2->currency_code_id);
				$arr['currency_id_give'] = $direction_array['currency_id_give'];
				$arr['currency_id_get'] = $direction_array['currency_id_get'];
				$arr['now_sort'] = intval(is_param_post('bcbroker_now_sort'));
				$arr['name_column'] = intval(is_param_post('bcbroker_name_column'));
				$pars_position = intval(is_param_post('bcbroker_pars_position'));
				if($pars_position < 0){ $pars_position = 0; }
				$arr['pars_position'] = $pars_position;
				
				$arr['step'] = pn_strip_input(is_param_post('bcbroker_step'));
				$arr['min_res'] = is_sum(is_param_post('bcbroker_min_res'));
				$arr['min_sum'] = is_sum(is_param_post('bcbroker_min_sum'));
				$arr['max_sum'] = is_sum(is_param_post('bcbroker_max_sum'));
				$arr['standart_course_give'] = is_sum(is_param_post('bcbroker_standart_course_give'));
				$arr['standart_course_get'] = is_sum(is_param_post('bcbroker_standart_course_get'));
				$arr['reset_course'] = intval(is_param_post('bcbroker_reset_course'));
				$arr['status'] = intval(is_param_post('bcbroker_status'));
				
				$broker = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id='$direction_id'"); 
				$arr = apply_filters('pn_bcadjs_tab_addform_post', $arr, $broker, $direction_id, $direction_array);
				
				if(isset($broker->id)){
					do_action('pn_bcadjs_tab_edit_before', $broker->id, $arr, $broker, $direction_id, $direction_array);
					$wpdb->update($wpdb->prefix."bcbroker_directions", $arr, array('id'=>$broker->id));
					do_action('pn_bcadjs_tab_edit', $broker->id, $arr, $broker, $direction_id, $direction_array);
				} else {
					$wpdb->insert($wpdb->prefix."bcbroker_directions", $arr);
					$broker_id = $wpdb->insert_id;	
					do_action('pn_bcadjs_tab_add', $broker_id, $arr, $direction_id, $direction_array);
				}
				
			} else {
				$wpdb->query("DELETE FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id = '$direction_id'");
			}
		} else {
			$wpdb->query("DELETE FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id = '$direction_id'");
		}
	}
}

add_action('pn_direction_delete', 'pn_direction_delete_bcbroker', 10, 2);
function pn_direction_delete_bcbroker($item_id, $item){
global $wpdb;	

	$wpdb->query("DELETE FROM ".$wpdb->prefix."bcbroker_directions WHERE direction_id = '$item_id'");
}

add_action('pn_direction_notactive', 'bcbroker_direction_notactive', 10, 2);
function bcbroker_direction_notactive($id, $item){
global $wpdb;
	
	$wpdb->query("UPDATE ".$wpdb->prefix."bcbroker_directions SET status = '0' WHERE direction_id = '$id'");
}