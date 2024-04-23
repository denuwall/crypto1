<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_noticehead', 'pn_adminpage_title_pn_add_noticehead');
function pn_adminpage_title_pn_add_noticehead(){
global $bd_data, $wpdb;
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."notice_head WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix.'notice_head', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."notice_head WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit message','pn');
	} else {
		_e('Add message','pn');
	}
}

add_action('pn_adminpage_content_pn_add_noticehead','def_pn_adminpage_content_pn_add_noticehead');
function def_pn_adminpage_content_pn_add_noticehead(){
global $bd_data, $wpdb;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit message','pn');
	} else {
		$title = __('Add message','pn');
	}	
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_noticehead'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_noticehead'),
			'title' => __('Add new','pn')
		);	
	}
	$form->back_menu($back_menu, $bd_data);	
	
	$options = array();
	$options['hidden_block'] = array(
		'view' => 'hidden_input',
		'name' => 'data_id',
		'default' => $data_id,
	);	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => $title,
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);
	$options['notice_display'] = array(
		'view' => 'select',
		'title' => __('Location','pn'),
		'options' => array('0'=> __('header','pn'), '1'=> __('pop-up window','pn')),
		'default' => is_isset($bd_data, 'notice_display'),
		'name' => 'notice_display',
	);	
	$options['notice_type'] = array(
		'view' => 'select',
		'title' => __('Notification type','pn'),
		'options' => array('0'=> __('on period of time','pn'), '1'=> __('on schedule','pn')),
		'default' => is_isset($bd_data, 'notice_type'),
		'name' => 'notice_type',
	);
	$notice_type = intval(is_isset($bd_data, 'notice_type'));
	if($notice_type == 0){
		$class_1 = '';
		$class_2 = 'pn_hide';
	} else {
		$class_1 = 'pn_hide';
		$class_2 = '';			
	}	
	$options['datestart'] = array(
		'view' => 'datetime',
		'title' => __('Start date','pn'),
		'default' => is_isset($bd_data, 'datestart'),
		'name' => 'datestart',
		'work' => 'datetime',
		'class' => 'thevib thevib0 '. $class_1,
	);
	$options['dateend'] = array(
		'view' => 'datetime',
		'title' => __('End date','pn'),
		'default' => is_isset($bd_data, 'dateend'),
		'name' => 'dateend',
		'work' => 'datetime',
		'class' => 'thevib thevib0 '. $class_1,
	);
	$statused = array();
	$statused['-1'] = '--'. __('Any status','pn') .'--';
	$status_operator = apply_filters('status_operator', array());
	if(is_array($status_operator)){
		foreach($status_operator as $key => $val){
			$statused[$key] = $val;
		}
	}
	$options['op_status'] = array(
		'view' => 'select',
		'title' => __('Status of operator','pn'),
		'options' => $statused,
		'default' => is_isset($bd_data, 'op_status'),
		'name' => 'op_status',
		'work' => 'int',
		'class' => 'thevib thevib1 '. $class_2,
	);	
	$options['datetime'] = array(
		'view' => 'user_func',
		'func_data' => $bd_data,
		'func' => 'pn_noticehead_datetime',
	);	
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['theclass'] = array(
		'view' => 'inputbig',
		'title' => __('CSS class','pn'),
		'default' => is_isset($bd_data, 'theclass'),
		'name' => 'theclass',
		'work' => 'input',
	);	
	$options['url'] = array(
		'view' => 'inputbig',
		'title' => __('Link','pn'),
		'default' => is_isset($bd_data, 'url'),
		'name' => 'url',
		'work' => 'input',
		'ml' => 1,
	);
	$options['text'] = array(
		'view' => 'textarea',
		'title' => __('Text','pn'),
		'default' => is_isset($bd_data, 'text'),
		'name' => 'text',
		'width' => '',
		'height' => '150px',
		'work' => 'text',
		'ml' => 1,
	);		
	$options['status'] = array(
		'view' => 'select',
		'title' => __('Status','pn'),
		'options' => array('1'=>__('published','pn'),'0'=>__('moderating','pn')),
		'default' => is_isset($bd_data, 'status'),
		'name' => 'status',
		'work' => 'int',
	);

	$params_form = array(
		'filter' => 'pn_noticehead_addform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);
	
?>
<script type="text/javascript">
$(function(){ 
	$('#pn_notice_type').on('change',function(){
		var id = $(this).val();
		$('.thevib').hide();
		$('.thevib' + id).show();
		
		return false;
	});
});
</script>
<?php
}

function pn_noticehead_datetime($data){
	
	$notice_type = intval(is_isset($data, 'notice_type'));
	if($notice_type == 0){
		$class_2 = 'pn_hide';
	} else {
		$class_2 = '';			
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
	<tr class="thevib thevib1 <?php echo $class_2; ?>">
		<th><?php _e('Period for display (hours)','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="h1" style="width: 50px;" autocomplete="off">	
					<?php
					$r=-1;
					while($r++<23){
					?>
					<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($data, 'h1')),$r);?>><?php echo zeroise($r,2); ?></option>
					<?php } ?>
				</select>
					:
				<select name="m1" style="width: 50px;" autocomplete="off">	
					<?php
					$r=-1;
					while($r++<59){
					?>
					<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($data, 'm1')),$r);?>><?php echo zeroise($r,2); ?></option>
					<?php } ?>
				</select>							
				-
							
				<select name="h2" style="width: 50px;" autocomplete="off">	
					<?php
					$r=-1;
					while($r++<23){
					?>
					<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($data, 'h2')),$r);?>><?php echo zeroise($r,2); ?></option>
					<?php } ?>
				</select>	
				:
				<select name="m2" style="width: 50px;" autocomplete="off">	
					<?php
					$r=-1;
					while($r++<59){
					?>
					<option value="<?php echo $r; ?>" <?php selected(intval(is_isset($data, 'm2')),$r);?>><?php echo zeroise($r,2); ?></option>
					<?php } ?>
				</select>							
					<div class="premium_clear"></div>
			</div>
		</td>		
	</tr>				
	<tr class="thevib thevib1 <?php echo $class_2; ?>">
		<th><?php _e('Period for display (days)','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php foreach($days as $key => $val){ ?>
					<div><label><input type="checkbox" name="<?php echo $key; ?>" <?php checked(is_isset($data,$key), 1);?> value="1" /> <?php echo $val; ?></label></div>
				<?php } ?>
			</div>
		</td>		
	</tr>				
<?php
}

add_action('premium_action_pn_add_noticehead','def_premium_action_pn_add_noticehead');
function def_premium_action_pn_add_noticehead(){
global $wpdb;

	only_post();
	pn_only_caps(array('administrator','pn_noticehead'));
	
	$data_id = intval(is_param_post('data_id'));

	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "notice_head WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
	
	$array = array();
	$array['notice_type'] = intval(is_param_post('notice_type'));
	$array['notice_display'] = intval(is_param_post('notice_display'));
	
	$array['url'] = pn_strip_input(is_param_post_ml('url'));
	$array['text'] = pn_strip_input(is_param_post_ml('text'));
	$array['theclass'] = pn_strip_input(is_param_post('theclass'));
	$array['status'] = intval(is_param_post('status'));
	
	$array['datestart'] = get_mytime(is_param_post('datestart'),'Y-m-d H:i:s');
	$array['dateend'] = get_mytime(is_param_post('dateend'),'Y-m-d H:i:s');

	$array['op_status'] = intval(is_param_post('op_status'));
	$array['h1'] = zeroise(intval(is_param_post('h1')),2);
	$array['h2'] = zeroise(intval(is_param_post('h2')),2);
	$array['m1'] = zeroise(intval(is_param_post('m1')),2);
	$array['m2'] = zeroise(intval(is_param_post('m2')),2);
			
	$array['d1'] = intval(is_param_post('d1'));
	$array['d2'] = intval(is_param_post('d2'));
	$array['d3'] = intval(is_param_post('d3'));
	$array['d4'] = intval(is_param_post('d4'));
	$array['d5'] = intval(is_param_post('d5'));
	$array['d6'] = intval(is_param_post('d6'));
	$array['d7'] = intval(is_param_post('d7'));	
	
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');
	$array = apply_filters('pn_noticehead_addform_post', $array, $last_data);	
	
	$form = new PremiumForm();
	
	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			do_action('pn_noticehead_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'notice_head', $array, array('id' => $data_id));
			do_action('pn_noticehead_edit', $data_id, $array, $last_data);
			if($result){
				do_action('pn_noticehead_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'notice_head', $array, array('id' => $data_id));
			if($result){
				do_action('pn_noticehead_add', $data_id, $array);
			}
		}
	}	
	
	$url = admin_url('admin.php?page=pn_add_noticehead&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);	
}