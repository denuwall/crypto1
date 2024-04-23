<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_schedule_operators', 'pn_adminpage_title_pn_add_schedule_operators');
function pn_adminpage_title_pn_add_schedule_operators(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."schedule_operators WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix.'schedule_operators', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."schedule_operators WHERE id='$data_id'");
		}	
	}
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit schedule','pn');
	} else {
		_e('Add schedule','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_schedule_operators','def_pn_adminpage_content_pn_add_schedule_operators');
function def_pn_adminpage_content_pn_add_schedule_operators(){
global $bd_data, $wpdb;	
	
	$form = new PremiumForm();
	
	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit schedule','pn');
	} else {
		$title = __('Add schedule','pn');
	}	
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_schedule_operators'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_schedule_operators'),
			'title' => __('Add new','pn')
		);	
	}	
	$form->back_menu($back_menu, $bd_data);	
	
	$statused = array();
	$status_operator = apply_filters('status_operator', array());
	if(is_array($status_operator)){
		foreach($status_operator as $key => $val){
			$statused[$key] = $val;
		}
	}	
	
	$days = array(
		'd1' => __('monday','pn'),
		'd2' => __('tuesday','pn'),
		'd3' => __('wednesday','pn'),
		'd4' => __('thursday','pn'),
		'd5' => __('friday','pn'),
		'd6' => '<span class="bred">'. __('saturday','pn') .'</span>',
		'd7' => '<span class="bred">'. __('sunday','pn') .'</span>',
	);	
?>	
<div class="premium_body">	
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<input type="hidden" name="data_id" value="<?php echo $data_id; ?>" />
		
		<table class="premium_standart_table">
			<?php
				$form->h3($title, __('Save','pn'), 2);
				?>
				<tr>
					<th><?php _e('Status','pn'); ?></th>
					<td><?php $form->select('status', $statused, is_isset($bd_data, 'status')); ?></td>
				</tr>	
				<tr>
					<th><?php _e('Work time','pn'); ?></th>
					<td>
						<div class="premium_wrap_standart">
							<select name="h1" style="width: 50px;" autocomplete="off">	
								<?php
								$r=-1;
								while($r++<23){
								?>
								<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($bd_data, 'h1')),$r);?>><?php echo zeroise($r,2); ?></option>
								<?php } ?>
							</select>
							:
							<select name="m1" style="width: 50px;" autocomplete="off">	
								<?php
								$r=-1;
								while($r++<59){
								?>
								<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($bd_data, 'm1')),$r);?>><?php echo zeroise($r,2); ?></option>
								<?php } ?>
							</select>							
							-
							
							<select name="h2" style="width: 50px;" autocomplete="off">	
								<?php
								$r=-1;
								while($r++<23){
								?>
								<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($bd_data, 'h2')),$r);?>><?php echo zeroise($r,2); ?></option>
								<?php } ?>
							</select>	
							:
							<select name="m2" style="width: 50px;" autocomplete="off">	
								<?php
								$r=-1;
								while($r++<59){
								?>
								<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($bd_data, 'm2')),$r);?>><?php echo zeroise($r,2); ?></option>
								<?php } ?>
							</select>							
								<div class="premium_clear"></div>
						</div>
					</td>		
				</tr>				
				<tr>
					<th><?php _e('Work days','pn'); ?></th>
					<td>
						<div class="premium_wrap_standart">
							<?php foreach($days as $key => $val){ ?>
							<div><label><input type="checkbox" name="<?php echo $key; ?>" <?php checked(is_isset($bd_data,$key), 1);?> value="1" /> <?php echo $val; ?></label></div>
							<?php } ?>
						</div>
					</td>		
				</tr>					
				<?php				
				
				do_action('pn_schedule_operators_addform', $bd_data);
				
				$form->h3('', __('Save','pn'), 2);	
			?>
		</table>
	</form>		
</div>		
<?php 
}

add_action('premium_action_pn_add_schedule_operators','def_premium_action_pn_add_schedule_operators');
function def_premium_action_pn_add_schedule_operators(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator'));
	
	$form = new PremiumForm();
	
	$data_id = intval(is_param_post('data_id')); 
	
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "schedule_operators WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['status'] = intval(is_param_post('status'));
	$array['h1'] = $h1 = zeroise(intval(is_param_post('h1')),2);
	$array['h2'] = $h2 = zeroise(intval(is_param_post('h2')),2);
	$array['m1'] = $m1 = zeroise(intval(is_param_post('m1')),2);
	$array['m2'] = $m2 = zeroise(intval(is_param_post('m2')),2);
			
	$time1 = strtotime('01-01-2020 '. $h1 .':'. $m1 .':00');
	$time2 = strtotime('01-01-2020 '. $h2 .':'. $m2 .':00');
			
	if($time1 > $time2){
		$array['h1'] = $h2; 
		$array['h2'] = $h1;
		$array['m1'] = $m2;
		$array['m2'] = $m1;
	}
			
	$array['d1'] = intval(is_param_post('d1'));
	$array['d2'] = intval(is_param_post('d2'));
	$array['d3'] = intval(is_param_post('d3'));
	$array['d4'] = intval(is_param_post('d4'));
	$array['d5'] = intval(is_param_post('d5'));
	$array['d6'] = intval(is_param_post('d6'));
	$array['d7'] = intval(is_param_post('d7'));
			
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');			
	$array = apply_filters('pn_schedule_operators_addform_post', $array, $last_data);
			
	if($data_id){	
		if(is_isset($last_data, 'auto_status') == 1){	
			do_action('pn_schedule_operators_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'schedule_operators', $array, array('id' => $data_id));
			do_action('pn_schedule_operators_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_schedule_operators_edit_after', $data_id, $array, $last_data);
			}	
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'schedule_operators', $array, array('id' => $data_id));
			if($result){
				do_action('pn_schedule_operators_add', $data_id, $array);
			}	
		}
	}

	$url = admin_url('admin.php?page=pn_add_schedule_operators&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	