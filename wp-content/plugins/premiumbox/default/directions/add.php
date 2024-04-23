<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_add_directions', 'pn_admin_title_pn_add_directions');
function pn_admin_title_pn_add_directions(){
global $bd_data, $wpdb;	
	
	$data_id = 0;
	$item_id = intval(is_param_get('item_id'));
	$bd_data = '';
	
	if($item_id){
		$bd_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE id='$item_id'");
		if(isset($bd_data->id)){
			$data_id = $bd_data->id;
		}	
	}	
	
	if(!$data_id){
		$array = array();
		$array['create_date'] = current_time('mysql');
		$array['auto_status'] = 0;		
		$wpdb->insert($wpdb->prefix . 'directions', $array);
		$data_id = $wpdb->insert_id;
		if($data_id){
			$bd_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "directions WHERE id='$data_id'");
		}	
	}	
	
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		_e('Edit exchange direction','pn');
	} else {
		_e('Add exchange direction','pn');
	}	
}

add_action('pn_adminpage_content_pn_add_directions','def_pn_admin_content_pn_add_directions');
function def_pn_admin_content_pn_add_directions(){
global $bd_data, $wpdb, $premiumbox;

	$form = new PremiumForm();

	$data_id = intval(is_isset($bd_data,'id'));
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$title = __('Edit exchange direction','pn');
	} else {
		$title = __('Add exchange direction','pn');
	}
	
	$title .= '"<span id="title1"></span>-<span id="title2"></span>"';
	
	$back_menu = array();
	$back_menu['back'] = array(
		'link' => admin_url('admin.php?page=pn_directions'),
		'title' => __('Back to list','pn')
	);
	if($data_id and is_isset($bd_data, 'auto_status') == 1){
		$back_menu['add'] = array(
			'link' => admin_url('admin.php?page=pn_add_directions'),
			'title' => __('Add new','pn')
		);			
		if(is_isset($bd_data,'direction_status') == 1){
			$back_menu['direction_link'] = array(
				'link' => get_exchange_link($bd_data->direction_name),
				'title' => __('View','pn'),
				'target' => 1,
			);			
		}
	}
	$form->back_menu($back_menu, $bd_data);
	
?>	
<div class="premium_body">	
	<form method="post" action="<?php pn_the_link_post(); ?>">
		<input type="hidden" name="data_id" value="<?php echo $data_id; ?>" />
		
		<div class="add_tabs_title"><?php echo $title; ?></div>
		
		<?php
		$form = new PremiumForm();
		
		$list_tabs_direction = array(
			'tab1' => __('General settings','pn'),
			'tab2' => __('Rate','pn'),
			'tab4' => __('Payment system fees','pn'),
			'tab5' => __('Exchange office fees','pn'),
			'tab6' => __('Exchange amount','pn'),
			'tab7' => __('Customer information','pn'),
			'tab8' => __('Limitations and checking','pn'),
			'tab9' => __('Custom fields','pn'),
			'tab11' => __('Merchants and payouts','pn'),
		);
		$list_tabs_direction = apply_filters('list_tabs_direction',$list_tabs_direction);		
		?>
		<?php if(is_array($list_tabs_direction)){ ?>
		
		<div class="add_tabs_wrap">
		
			<div class="add_tabs_menu">

				<?php foreach($list_tabs_direction as $tab_key => $title){ ?>
					<div class="one_tabs_menu" id="menu_<?php echo $tab_key; ?>"><?php echo $title; ?></div>
				<?php } ?>
				
			</div>		
		
			<div class="add_tabs_body">
		
			<?php foreach($list_tabs_direction as $tab_key => $title){ ?>
				<div class="one_tabs_body" id="<?php echo $tab_key; ?>">
	
				<table class="premium_standart_table">	
					<tr>
						<td colspan="3">
							<div class="premium_h3submit">
								<input type="submit" name="" class="button" value="<?php _e('Save'); ?>" />
							</div>
						</td>
					</tr>	
						
						<?php if($tab_key == 'tab6'){ ?>
						
							<tr>
								<th><?php _e('Minimum amount','pn'); ?></th>
								<td>
									<div class="premium_wrap_standart">
										<input type="text" name="min_sum1" style="width: 200px;" value="<?php echo pn_strip_input(is_isset($bd_data, 'min_sum1')); ?>" />
									</div>			
								</td>
								<td>
									<div class="premium_wrap_standart">
										<input type="text" name="min_sum2" style="width: 200px;" value="<?php echo pn_strip_input(is_isset($bd_data, 'min_sum2')); ?>" />	
									</div>			
								</td>
							</tr>
							<tr>
								<th><?php _e('Maximum amount','pn'); ?></th>
								<td>
									<div class="premium_wrap_standart">
										<input type="text" name="max_sum1" style="width: 200px;" value="<?php echo pn_strip_input(is_isset($bd_data, 'max_sum1')); ?>" />
									</div>			
								</td>
								<td>
									<div class="premium_wrap_standart">
										<input type="text" name="max_sum2" style="width: 200px;" value="<?php echo pn_strip_input(is_isset($bd_data, 'max_sum2')); ?>" />	
									</div>			
								</td>
							</tr>						
						
						<?php }  ?>						
					
						<?php
						if($tab_key == 'tab7'){ 
							$list_directions_temp = apply_filters('list_directions_temp',array());
							$r=0;
							if(is_array($list_directions_temp)){
								foreach($list_directions_temp as $key => $title){ $r++;

									$text = trim(get_direction_txtmeta($data_id, $key));									
									if(!$text){ 
										$text = $premiumbox->get_option('naps_temp',$key); 
									} 
							?>
								<?php
								if($r > 1){ 
								?>
								<tr>
									<td colspan="3">
										<div class="premium_h3submit">
											<input type="submit" name="" class="button" value="<?php _e('Save'); ?>" />
										</div>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<th><?php echo $title; ?></th>
									<td colspan="2">
										<?php $form->editor($key, $text, 8, false, 1); ?>
									</td>
								</tr>							
							<?php 
								}
							} 
						}
						?>
					
						<?php if($tab_key == 'tab9'){ ?>
						
							<?php
							$cfs_in = array();
							$cf_directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."cf_directions WHERE direction_id='$data_id'");
							foreach($cf_directions as $cf){
								$cfs_in[] = $cf->cf_id;
							}
							
							$custom_fields = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."direction_custom_fields WHERE auto_status = '1' AND status='1' ORDER BY cf_order ASC");
							?>
						
							<tr>
								<td colspan="2">
								    <div class="cf_div">
										<div style="font-weight: 500;"><label><input type="checkbox" class="check_all" name="" value="1" /> <?php _e('Check all/Uncheck all','pn'); ?></label></div>
									<?php 
									$cfs_in_count = count($cfs_in);
									foreach($custom_fields as $cf_data){
										$cl = '';
										if($cf_data->cf_auto == 'user_email'){
											$cl = 'bred';
										}
										$tech_title = pn_strip_input(ctv_ml($cf_data->tech_name));
										if(!$tech_title){ $tech_title = pn_strip_input(ctv_ml($cf_data->cf_name)); }
									?>
										<div class="<?php echo $cl; ?>"><label><input type="checkbox" name="cf[<?php echo $cf_data->id; ?>]" <?php if(in_array($cf_data->id,$cfs_in) or $cfs_in_count == 0 and $cf_data->cf_auto == 'user_email'){ ?>checked="checked"<?php } ?> value="1" /> <?php echo $tech_title ?></label></div>
									<?php
									}
									?>
									</div>
								</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3">
									<?php $form->warning(__('Check E-mail field. It is necessary in order to notify users via e-mail','pn')); ?>
								</td>
							</tr>							
							
						<?php }  ?>													
							
						<?php if($tab_key == 'tab11'){ ?>
						
							<tr>
								<th><?php _e('Merchant','pn'); ?></th> 
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$list_merchants = apply_filters('list_merchants',array());
										$m_in = is_extension_name(is_isset($bd_data, 'm_in')); 
										?>									
									
										<select name="m_in" autocomplete="off"> 
											<option value="0" <?php selected($m_in,0); ?>>--<?php _e('No item','pn'); ?>--</option>
											
											<?php foreach($list_merchants as $merch_data){ 
												$merch_id = is_extension_name(is_isset($merch_data,'id'));
												$merch_title = is_isset($merch_data,'title');
												$merch_en = intval(is_enable_merchant($merch_id));
												$enable_title = __('inactive merchant','pn');
												if($merch_en == 1){ $enable_title = __('active merchant','pn'); }
											?>
												<option value="<?php echo $merch_id; ?>" <?php selected($m_in,$merch_id); ?>><?php echo $merch_title; ?> [<?php echo $enable_title; ?>]</option>
											<?php } ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th><?php _e('Automatic payouts','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$list_paymerchants = apply_filters('list_paymerchants',array());
										$m_out = is_extension_name(is_isset($bd_data, 'm_out')); 
										?>									
									
										<select name="m_out" autocomplete="off"> 
											<option value="0" <?php selected($m_out,0); ?>>--<?php _e('No item','pn'); ?>--</option>
											
											<?php foreach($list_paymerchants as $merch_data){ 
												$merch_id = is_extension_name(is_isset($merch_data,'id'));
												$merch_title = is_isset($merch_data,'title');
												$merch_en = intval(is_enable_paymerchant($merch_id));
												$enable_title = __('inactive automatic payout','pn');
												if($merch_en == 1){ $enable_title = __('active automatic payout','pn'); }
											?>
												<option value="<?php echo $merch_id; ?>" <?php selected($m_out,$merch_id); ?>><?php echo $merch_title; ?> [<?php echo $enable_title; ?>]</option>
											<?php } ?>
										</select>
									</div>
								</td>
							</tr>

							<?php
							$paymerch_data = get_direction_meta($bd_data->id, 'paymerch_data');
							?>
							<tr>
								<th><?php _e('Automatic payout when order has status "Paid order"','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_realpay = intval(is_isset($paymerch_data, 'm_out_realpay')); 
										?>									
										<select name="m_out_realpay" autocomplete="off"> 
											<option value="0" <?php selected($m_out_realpay,0); ?>>--<?php _e('Default','pn'); ?>--</option>
											<option value="1" <?php selected($m_out_realpay,1); ?>><?php _e('No','pn'); ?></option>
											<option value="2" <?php selected($m_out_realpay,2); ?>><?php _e('Yes','pn'); ?></option>
										</select>
									</div>
								</td>
							</tr>

							<tr>
								<th><?php _e('Automatic payout when order has status "Order is on checking"','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_verify = intval(is_isset($paymerch_data, 'm_out_verify')); 
										?>									
										<select name="m_out_verify" autocomplete="off"> 
											<option value="0" <?php selected($m_out_verify,0); ?>>--<?php _e('Default','pn'); ?>--</option>
											<option value="1" <?php selected($m_out_verify,1); ?>><?php _e('No','pn'); ?></option>
											<option value="2" <?php selected($m_out_verify,2); ?>><?php _e('Yes','pn'); ?></option>
										</select>
									</div>
								</td>
							</tr>

							<tr>
								<th><?php _e('Max. amount for daily automatic payouts','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_max = is_sum(is_isset($paymerch_data, 'm_out_max')); 
										?>			
										<input type="text" name="m_out_max" style="width: 200px;" value="<?php echo $m_out_max; ?>" />
									</div>
								</td>
							</tr>

							<tr>
								<th><?php _e('Max. amount of automatic payouts due to order','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_max_sum = is_sum(is_isset($paymerch_data, 'm_out_max_sum')); 
										?>			
										<input type="text" name="m_out_max_sum" style="width: 200px;" value="<?php echo $m_out_max_sum; ?>" />
									</div>
								</td>
							</tr>
							
							<tr>
								<th><?php _e('Automatic payout delay (hrs)','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_timeout = intval(is_isset($paymerch_data, 'm_out_timeout')); 
										?>			
										<input type="text" name="m_out_timeout" style="width: 200px;" value="<?php echo $m_out_timeout; ?>" />
									</div>
								</td>
							</tr>

							<tr>
								<th><?php _e('Whom the delay is for','pn'); ?></th>
								<td colspan="2">
									<div class="premium_wrap_standart">
										<?php 
										$m_out_timeout_user = intval(is_isset($paymerch_data, 'm_out_timeout_user')); 
										?>
										<select name="m_out_timeout_user" autocomplete="off"> 
											<option value="0" <?php selected($m_out_timeout_user,0); ?>><?php _e('everyone','pn'); ?></option>
											<option value="1" <?php selected($m_out_timeout_user,1); ?>><?php _e('newcomers','pn'); ?></option>
											<option value="2" <?php selected($m_out_timeout_user,2); ?>><?php _e('not registered users','pn'); ?></option>
											<option value="3" <?php selected($m_out_timeout_user,3); ?>><?php _e('not verified users','pn'); ?></option>
										</select>										
									</div>
								</td>
							</tr>
						<?php }  ?>						
						
						<?php do_action('tab_direction_'.$tab_key, $bd_data, $data_id); ?>
						
					<tr>
						<td colspan="3">
							<div class="premium_h3submit">
								<input type="submit" name="" class="button" value="<?php _e('Save'); ?>" />
							</div>						
						</td>
					</tr>					
				</table>				
				
				</div>
			<?php } ?>
			
			</div>
				<div class="premium_clear"></div>
		</div>
		<?php } ?>
		
	</form>		
</div>	

<script type="text/javascript">
$(function(){
	
	/* tabs */
	var current_tab = $('.one_tabs_menu:first').attr('id').replace('menu_','');
	var cook_tab = Cookies.get("current_tab");
	if(cook_tab){
		current_tab = cook_tab;
	}
	
	$('#menu_'+current_tab).addClass('active');
	$('#'+current_tab).addClass('active');
	
	$(document).on('click', '.one_tabs_menu', function(){ 
		var id = $(this).attr('id').replace('menu_','');
		Cookies.set("current_tab", id);
		$('.one_tabs_menu, .one_tabs_body').removeClass('active');
		$(this).addClass('active');
		$('#'+id).addClass('active');
		
		return false;
	});
	/* end tabs */
	
	/* visible title */
	function set_visible_title(){
		var direction_status = $('#direction_status').val();
		if(direction_status == 1){
			$('.add_tabs_title').removeClass('notactive');
		} else {
			$('.add_tabs_title').addClass('notactive');
		}
		
		var title1 = $('#currency_id_give option:selected').html().replace(new RegExp("-",'g'),'');
		var title2 = $('#currency_id_get option:selected').html().replace(new RegExp("-",'g'),'');
		$('#title1').html(title1);
		$('#title2').html(title2);
	}
	$('#direction_status, #currency_id_give, #currency_id_get').change(function(){
		set_visible_title();
	});
	set_visible_title();
	/* end visible title */
	
	/* tech title */
	function set_tech_title(){
		var title = $.trim($('.tech_name').val());
		if(title.length > 0){
			$('title').html(title);
		}
	}
	$('.tech_name').change(function(){
		set_tech_title();
	});
	set_tech_title();
	/* end tech title */
	
	/* set decimal */
	function set_now_decimal(obj, dec){
		var sum = obj.val().replace(new RegExp(",",'g'),'.');
		var len_arr = sum.split('.');
		var len_data = len_arr[1];
		if(len_data !== undefined){
			var len = len_data.length;
			if(len > dec){
				var new_data = len_data.substr(0, dec);
				obj.val(len_arr[0]+'.'+new_data);
			}
		}
	}
	
	function set_valut_decimal(){
		var decimal1 = $('#currency_id_give option:selected').attr('data-decimal');
		var decimal2 = $('#currency_id_get option:selected').attr('data-decimal');
		set_now_decimal($('#course_give'), decimal1);
		set_now_decimal($('#course_get'), decimal2);
	}
	$('#direction_status, #currency_id_give, #currency_id_get').change(function(){
		set_valut_decimal();
	});
	$('#course_give, #course_get').change(function(){
		set_valut_decimal();
	});
	$('#course_give, #course_get').keyup(function(){
		set_valut_decimal();
	});	
	set_valut_decimal();	
	/* end set decimal */	
	
	$(document).on('click', '.check_all', function(){
		var par = $(this).parents('.cf_div');
		if($(this).prop('checked')){
			par.find('input').prop('checked',true);
		} else {
			par.find('input').prop('checked',false);
		}
	});
	
});
</script>	
<?php
}  

/* обработка формы */
add_action('premium_action_pn_add_directions','def_premium_action_pn_add_directions');
function def_premium_action_pn_add_directions(){
global $wpdb;

	$form = new PremiumForm();

	only_post();
	pn_only_caps(array('administrator', 'pn_directions'));
	
	$data_id = intval(is_param_post('data_id'));
	
	$last_data = '';
	if($data_id > 0){
		$last_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "directions WHERE id='$data_id'");
		if(!isset($last_data->id)){
			$data_id = 0;
		}
	}	
		
	$array = array();
	
	/* tab1 */
	$array['currency_id_give'] = $currency_id_give = intval(is_param_post('currency_id_give'));
	$array['currency_id_get'] = $currency_id_get = intval(is_param_post('currency_id_get'));
				
	if($currency_id_give == $currency_id_get){
		$form->error_form(__('Error! Send and Receive currency cannot be the same','pn'));
	}
			
	$xml_value1 = $xml_value2 = '';
	$title_value1 = $title_value2 = '';
	$status_currency1 = $status_currency2 = 0;
			
	$currency_data1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND id='$currency_id_give'");
	if(isset($currency_data1->id)){
		$array['psys_id_give'] = $currency_data1->psys_id;
		$xml_value1 = is_xml_value($currency_data1->xml_value);
		$title_value1 = pn_strip_input(ctv_ml($currency_data1->psys_title)).' '.pn_strip_input(ctv_ml($currency_data1->currency_code_title));
		$status_currency1 = intval($currency_data1->currency_status);
	} else {
		$form->error_form(__('Error! Send currency does not exist','pn'));
	}
			
	$currency_data2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND id='$currency_id_get'");
	if(isset($currency_data2->id)){
		$array['psys_id_get'] = $currency_data2->psys_id;
		$xml_value2 = is_xml_value($currency_data2->xml_value);
		$title_value2 = pn_strip_input(ctv_ml($currency_data2->psys_title)).' '.pn_strip_input(ctv_ml($currency_data2->currency_code_title));
		$status_currency2 = intval($currency_data2->currency_status);
	} else {
		$form->error_form(__('Error! Receive currency does not exist','pn'));
	}
	
	if($status_currency1 != 1){
		$form->error_form(__('Error! Send currency deactivated','pn'));
	}
	
	if($status_currency2 != 1){
		$form->error_form(__('Error! Receive currency deactivated','pn'));
	}	

	$array['direction_status'] = intval(is_param_post('direction_status'));
			
	$tech_name = pn_strip_input(is_param_post('tech_name'));
	if(!$tech_name){
		$tech_name = $title_value1 .' &rarr; '. $title_value2;
	}
	$array['tech_name'] = $tech_name;
			
	$direction_name = trim(is_param_post('direction_name'));
	if($direction_name){
		$direction_name = is_direction_premalink($direction_name);
	} 
	if(!$direction_name){
		$direction_premalink_temp = apply_filters('direction_premalink_temp','[xmlv1]_to_[xmlv2]');
		$direction_premalink_temp = str_replace('[xmlv1]',$xml_value1,$direction_premalink_temp);
		$direction_premalink_temp = str_replace('[xmlv2]',$xml_value2,$direction_premalink_temp);
		$direction_name = is_direction_premalink($direction_premalink_temp);
	}		
			
	$array['direction_name'] = unique_direction_name($direction_name, $data_id);
	/* end tab1 */
			
	/* tab2 */			
	$course_give = is_sum(is_param_post('course_give'), intval($currency_data1->currency_decimal));
	$course_get = is_sum(is_param_post('course_get'), intval($currency_data2->currency_decimal));
			
	if($course_give <= 0){
		$course_give = 1;
	}
	if($course_get <= 0){
		$course_get = 1;
	}	
	$array['course_give'] = $course_give;
	$array['course_get'] = $course_get;
	
	$array['profit_sum1'] = is_sum(is_param_post('profit_sum1'));	
	$array['profit_pers1'] = is_sum(is_param_post('profit_pers1'));
	$array['profit_sum2'] = is_sum(is_param_post('profit_sum2'));	
	$array['profit_pers2'] = is_sum(is_param_post('profit_pers2'));			
	/* end tab2 */
			
	/* tab4 */
	$array['pay_com1'] = intval(is_param_post('pay_com1'));
	$array['pay_com2'] = intval(is_param_post('pay_com2'));
	$array['nscom1'] = intval(is_param_post('nscom1'));
	$array['nscom2'] = intval(is_param_post('nscom2'));	
	$array['com_sum1'] = $array['com_sum1_check'] = is_sum(is_param_post('com_sum1'));	
	$array['com_pers1'] = $array['com_pers1_check'] = is_sum(is_param_post('com_pers1'));
	$array['com_sum2'] = $array['com_sum2_check'] = is_sum(is_param_post('com_sum2'));	
	$array['com_pers2'] = $array['com_pers2_check'] = is_sum(is_param_post('com_pers2'));
	if(is_enable_check_purse()){
		$array['com_sum1_check'] = is_sum(is_param_post('com_sum1_check'));	
		$array['com_pers1_check'] = is_sum(is_param_post('com_pers1_check'));
		$array['com_sum2_check'] = is_sum(is_param_post('com_sum2_check'));	
		$array['com_pers2_check'] = is_sum(is_param_post('com_pers2_check'));
	}	
	$array['maxsum1com'] = is_sum(is_param_post('maxsum1com'));
	$array['maxsum2com'] = is_sum(is_param_post('maxsum2com'));
	$array['minsum1com'] = is_sum(is_param_post('minsum1com'));
	$array['minsum2com'] = is_sum(is_param_post('minsum2com'));			
	/* end tab4 */
			
	/* tab5 */
	$array['com_box_sum1'] = is_sum(is_param_post('com_box_sum1'));	
	$array['com_box_pers1'] = is_sum(is_param_post('com_box_pers1'));
	$array['com_box_min1'] = is_sum(is_param_post('com_box_min1'));				
	$array['com_box_sum2'] = is_sum(is_param_post('com_box_sum2'));	
	$array['com_box_pers2'] = is_sum(is_param_post('com_box_pers2'));
	$array['com_box_min2'] = is_sum(is_param_post('com_box_min2'));			
	/* end tab5 */
			
	/* tab6 */
	$array['min_sum1'] = is_sum(is_param_post('min_sum1'));
	$array['max_sum1'] = is_sum(is_param_post('max_sum1'));
	$array['min_sum2'] = is_sum(is_param_post('min_sum2'));
	$array['max_sum2'] = is_sum(is_param_post('max_sum2'));			
	/* end tab6 */
			
	/* tab11 */
	$array['m_in'] = $m_in = is_extension_name(is_param_post('m_in'));
	$array['m_out'] = $m_out = is_extension_name(is_param_post('m_out'));	
	/* end tab11 */
			
	/* tab8 */
	$array['enable_user_discount'] = intval(is_param_post('enable_user_discount'));
	$array['max_user_discount'] = is_sum(is_param_post('max_user_discount'));
	if(is_enable_check_purse()){
		$array['check_purse'] = intval(is_param_post('check_purse'));
		$array['req_check_purse'] = intval(is_param_post('req_check_purse'));
	}
	/* end tab8 */
	$array['auto_status'] = 1;
	$array['edit_date'] = current_time('mysql');	
	$array = apply_filters('pn_direction_addform_post', $array, $last_data);

	if($data_id){
		if(is_isset($last_data, 'auto_status') == 1){
			//do_action('pn_direction_edit_before', $data_id, $array, $last_data);
			$result = $wpdb->update($wpdb->prefix.'directions', $array, array('id' => $data_id));
			//do_action('pn_direction_edit', $data_id, $array, $last_data);

			do_action('direction_change_course', $data_id, $last_data, is_isset($array,'course_give'), is_isset($array,'course_get'), 'edit_direction');

			if($result){
				//do_action('pn_direction_edit_after', $data_id, $array, $last_data);
			}
		} else {
			$array['create_date'] = current_time('mysql');
			$result = $wpdb->update($wpdb->prefix.'directions', $array, array('id' => $data_id));
			if($result){
				do_action('pn_direction_add', $data_id, $array);
			}
		}
	}	
			
	if($data_id){
				
		$paymerch_data = array();
		$paymerch_data['m_out_realpay'] = intval(is_param_post('m_out_realpay'));
		$paymerch_data['m_out_verify'] = intval(is_param_post('m_out_verify')); 
		$paymerch_data['m_out_max'] = is_sum(is_param_post('m_out_max'));
		$paymerch_data['m_out_max_sum'] = is_sum(is_param_post('m_out_max_sum'));
		$paymerch_data['m_out_timeout'] = intval(is_param_post('m_out_timeout'));
		$paymerch_data['m_out_timeout_user'] = intval(is_param_post('m_out_timeout_user'));
		update_direction_meta($data_id, 'paymerch_data', $paymerch_data);

		/* merchants */
		$wpdb->query("UPDATE ".$wpdb->prefix."exchange_bids SET m_in = '$m_in', m_out = '$m_out' WHERE direction_id = '$data_id'");
		/* end merchants */
					
		/* custom fields */
		$cfs_del = array();
		$cf_directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."cf_directions WHERE direction_id='$data_id'");
		foreach($cf_directions as $cf_item){
			$cfs_del[$cf_item->cf_id] = $cf_item->cf_id;
		}	
		if(isset($_POST['cf']) and is_array($_POST['cf'])){
			$cf = $_POST['cf'];	
			foreach($cf as $cfid => $cfzn){
				$cfid = intval($cfid);
				if(!in_array($cfid,$cfs_del)){		
					$arr = array();
					$arr['direction_id'] = $data_id;
					$arr['cf_id'] = $cfid;
					$wpdb->insert($wpdb->prefix.'cf_directions', $arr);	
				} else {
					unset($cfs_del[$cfid]);
				}
			}
		}		
		foreach($cfs_del as $tod){
			$wpdb->query("DELETE FROM ".$wpdb->prefix."cf_directions WHERE cf_id = '$tod' AND direction_id='$data_id'");			
		}					
		/* end custom fields */
					
		/* template */
		$list_directions_temp = apply_filters('list_directions_temp',array());
		if(is_array($list_directions_temp)){
			foreach($list_directions_temp as $key => $title){						
				$value = pn_strip_text(is_param_post_ml($key));
				$res = update_direction_txtmeta($data_id, $key, $value);
				if($res != 1){
					$form->error_form(sprintf(__('Error! Directory <b>%s</b> do not exist or cannot be written! Create this directory or get permission 777.','pn'),'/wp-content/uploads/napsmeta/'));
				}
			}
		}
		/* end template */
					
		/* order */
		$currencies = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency WHERE auto_status = '1'");
		foreach($currencies as $currency){
			$currency_id = $currency->id;
			
			$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions_order WHERE direction_id='$data_id' AND c_id='$currency_id'");
			if($cc == 0){
				$arr = array(
					'direction_id' => $data_id,
					'c_id' => $currency_id,
				);
				$wpdb->insert($wpdb->prefix.'directions_order', $arr);
			}
		}					
		/* end order */
					
	}

	$url = admin_url('admin.php?page=pn_add_directions&item_id='. $data_id .'&reply=true');
	$form->answer_form($url);
}	
/* end обработка формы */

/* данные формы */
add_action('tab_direction_tab1', 'direction_tab_direction_tab1', 10, 2);
function direction_tab_direction_tab1($data, $data_id){
	$currencies = apply_filters('list_currency_manage', array(), __('No item','pn'), 1);
?>
	<tr>
		<th width="150"></th>
		<td><?php _e('Send','pn'); ?></td>
		<td><?php _e('Receive','pn'); ?></td>
	</tr>							
	<tr>
		<th><?php _e('Direction','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="currency_id_give" id="currency_id_give" autocomplete="off">
					<?php foreach($currencies as $key => $val){ ?>
						<option value="<?php echo $key;?>" <?php selected(is_isset($data, 'currency_id_give'),$key,true); ?> data-decimal="<?php echo $val['decimal'];?>"><?php echo $val['title'];?></option>
					<?php } ?>
				</select>
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<select name="currency_id_get" id="currency_id_get" autocomplete="off">
					<?php foreach($currencies as $key => $val){ ?>
						<option value="<?php echo $key;?>" <?php selected(is_isset($data, 'currency_id_get'),$key,true); ?> data-decimal="<?php echo $val['decimal'];?>"><?php echo $val['title'];?></option>
					<?php } ?>
				</select>
			</div>			
		</td>
	</tr>
<?php	
}

add_action('tab_direction_tab1', 'techname_tab_direction_tab1', 20, 2);
function techname_tab_direction_tab1($data, $data_id){
?>
	<tr>
		<th><?php _e('Technical name','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<input type="text" name="tech_name" class="tech_name" style="width: 100%;" value="<?php echo pn_strip_input(is_isset($data, 'tech_name')); ?>" />
			</div>
		</td>
	</tr>
<?php	
} 

add_action('tab_direction_tab1', 'permalink_tab_direction_tab1', 30, 2);
function permalink_tab_direction_tab1($data, $data_id){
global $premiumbox;	

	$form = new PremiumForm();

	$gp = $premiumbox->general_tech_pages();
	$permalink = rtrim(get_site_url_ml(),'/').'/' . is_isset($gp, 'exchange');
?>
	<tr>
		<th><?php _e('Permalink','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php echo $permalink; ?><input type="text" name="direction_name" style="width: 260px;" value="<?php //echo is_direction_premalink(is_isset($data, 'direction_name')); ?>" />
			</div>
		</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<?php $form->help(__('More info','pn'), sprintf(__('Permanent link for exchange direction: %sPERMANENTLINK','pn'), $permalink)); ?>
		</td>
	</tr>

<?php	
}

add_action('tab_direction_tab1', 'status_tab_direction_tab1', 40, 2);
function status_tab_direction_tab1($data, $data_id){
?>	
	<tr>
		<th><?php _e('Status','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="direction_status" id="direction_status" autocomplete="off">
					<?php 
						$direction_status = is_isset($data, 'direction_status'); 
						if(!is_numeric($direction_status)){ $direction_status = 1; }
					?>						
					<option value="1" <?php selected($direction_status,1); ?>><?php _e('active direction','pn');?></option>
					<option value="0" <?php selected($direction_status,0); ?>><?php _e('inactive direction','pn');?></option>						
				</select>
			</div>
		</td>
		<td></td>
	</tr>
<?php								
}

add_action('tab_direction_tab2', 'rate_tab_direction_tab2', 10, 2);
function rate_tab_direction_tab2($data, $data_id){		
?>
	<tr>
		<th><?php _e('Exchange rate','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="course_give" id="course_give" style="width: 200px;" value="<?php echo is_sum(is_isset($data, 'course_give')); ?>" />
			</div>			
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="course_get" id="course_get" style="width: 200px;" value="<?php echo is_sum(is_isset($data, 'course_get')); ?>" />	
			</div>			
		</td>
	</tr>
<?php
} 	

add_action('tab_direction_tab2', 'profit_tab_direction_tab2', 20, 2);
function profit_tab_direction_tab2($data, $data_id){
	$form = new PremiumForm();
?>
	<tr>
		<th><?php _e('Profit','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="profit_sum1" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'profit_sum1')); ?>" /> S</div>
				<div><input type="text" name="profit_pers1" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'profit_pers1')); ?>" /> %</div>
			</div>	
		</td>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="profit_sum2" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'profit_sum2')); ?>" /> S</div>
				<div><input type="text" name="profit_pers2" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'profit_pers2')); ?>" /> %</div>	
			</div>	
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<?php $form->help(__('More info','pn'), __('Enter profit amount for this direction. Profit may be set in numbers (S) or in percent (%). This value is used for the affiliate program.','pn')); ?>
		</td>
	</tr>
<?php
} 		

add_action('tab_direction_tab4', 'fees_tab_direction_tab4', 10, 2);
function fees_tab_direction_tab4($data, $data_id){
?>
	<tr>
		<th width="150"></th>
		<td><?php _e('User &rarr; Exchange','pn'); ?></td>
		<td><?php _e('Exchange &rarr; User','pn'); ?></td>
	</tr>						
	<tr>
		<th><?php _e('Fees for non-verified account','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="com_sum1" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_sum1')); ?>" /> S</div>
				<div><input type="text" name="com_pers1" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_pers1')); ?>" /> %</div>
			</div>			
		</td>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="com_sum2" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_sum2')); ?>" /> S</div>
				<div><input type="text" name="com_pers2" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_pers2')); ?>" /> %</div>	
			</div>	
		</td>
	</tr>
	<?php if(is_enable_check_purse()){ ?>
	<tr>
		<th><?php _e('Fees for verified account','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="com_sum1_check" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_sum1_check')); ?>" /> S</div>
				<div><input type="text" name="com_pers1_check" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_pers1_check')); ?>" /> %</div>
			</div>			
		</td>
		<td>
			<div class="premium_wrap_standart">
				<div><input type="text" name="com_sum2_check" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_sum2_check')); ?>" /> S</div>
				<div><input type="text" name="com_pers2_check" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'com_pers2_check')); ?>" /> %</div>	
			</div>	
		</td>
	</tr>
	<?php } ?>
<?php
}

add_action('tab_direction_tab4', 'payfees_tab_direction_tab4', 20, 2);
function payfees_tab_direction_tab4($data, $data_id){
	$form = new PremiumForm();
?>							
	<tr>
		<th></th>
		<td>
			<div class="premium_wrap_standart">
				<label><input type="checkbox" name="pay_com1" <?php checked(is_isset($data, 'pay_com1'),1); ?> value="1" /> <?php _e('exchange pays fee','pn'); ?></label>
			</div>								
		</td>
		<td>	
			<div class="premium_wrap_standart">
				<label><input type="checkbox" name="pay_com2" <?php checked(is_isset($data, 'pay_com2'),1); ?> value="1" /> <?php _e('exchange pays fee','pn'); ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<?php $form->help(__('More info','pn'), __('Check this box if you are to pay a payment system fee instead of client','pn')); ?>
		</td>
	</tr>							
	<tr>
		<th></th>
		<td>
			<div class="premium_wrap_standart">
				<label><input type="checkbox" name="nscom1" <?php checked(is_isset($data, 'nscom1'),1); ?> value="1" /> <?php _e('non standard fees','pn'); ?></label>
			</div>								
		</td>
		<td>	
			<div class="premium_wrap_standart">
				<label><input type="checkbox" name="nscom2" <?php checked(is_isset($data, 'nscom2'),1); ?> value="1" /> <?php _e('non standard fees','pn'); ?></label>
			</div>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">
			<?php $form->help(__('More info','pn'), __('Check this box if a payment system takes a fee for incoming payment.','pn')); ?>
		</td>
	</tr>

<?php
} 

add_action('tab_direction_tab4', 'maxfees_tab_direction_tab4', 30, 2);
function maxfees_tab_direction_tab4($data, $data_id){
?>								
	<tr>  
		<th><?php _e('Min. amount of fees','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="minsum1com" value="<?php echo is_sum(is_isset($data, 'minsum1com')); ?>" />		
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="minsum2com" value="<?php echo is_sum(is_isset($data, 'minsum2com')); ?>" />				
			</div>
		</td>
	</tr>		
	<tr>
		<th><?php _e('Max. amount of fees','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="maxsum1com" value="<?php echo is_sum(is_isset($data, 'maxsum1com')); ?>" />		
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="maxsum2com" value="<?php echo is_sum(is_isset($data, 'maxsum2com')); ?>" />				
			</div>
		</td>
	</tr>
<?php
}
 
add_action('tab_direction_tab5', 'combox1_tab_direction_tab5', 10, 2);
function combox1_tab_direction_tab5($data, $data_id){		
	$com_box_sum1 = is_sum(is_isset($data, 'com_box_sum1'));
	$com_box_pers1 = is_sum(is_isset($data, 'com_box_pers1'));
	?>						
	<tr>
		<th><?php _e('Additional sender fee','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_sum1" id="com_box_sum1" value="<?php echo $com_box_sum1; ?>" /> S		
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_pers1" id="com_box_pers1" value="<?php echo $com_box_pers1; ?>" /> %		
			</div>
		</td>
	</tr>
	<tr>
		<th><?php _e('Minimum sender fee','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_min1" value="<?php echo is_sum(is_isset($data, 'com_box_min1')); ?>" /> S		
			</div>
		</td>
		<td></td>
	</tr>
<?php
} 

add_action('tab_direction_tab5', 'combox2_tab_direction_tab5', 20, 2);
function combox2_tab_direction_tab5($data, $data_id){		
	$com_box_sum2 = is_sum(is_isset($data, 'com_box_sum2'));
	$com_box_pers2 = is_sum(is_isset($data, 'com_box_pers2'));
	?>														
	<tr>
		<th><?php _e('Additional recipient fee','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_sum2" id="com_box_sum2" value="<?php echo $com_box_sum2; ?>" /> S		
			</div>
		</td>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_pers2" id="com_box_pers2" value="<?php echo $com_box_pers2; ?>" /> %		
			</div>		
		</td>
	</tr>
	<tr>
		<th><?php _e('Minimum recipient fee','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="com_box_min2" value="<?php echo is_sum(is_isset($data, 'com_box_min2')); ?>" /> S		
			</div>
		</td>
		<td></td>
	</tr>
<?php
}

add_action('tab_direction_tab8', 'udiscount_tab_direction_tab8', 10, 2);
function udiscount_tab_direction_tab8($data, $data_id){		
?>
	<tr>
		<th><?php _e('User discount','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<?php 
				$enable_user_discount = is_isset($data, 'enable_user_discount'); 
				if(!is_numeric($enable_user_discount)){ $enable_user_discount = 1; }
				?>														
				<select name="enable_user_discount" autocomplete="off">
					<option value="1" <?php selected($enable_user_discount,1); ?>><?php _e('Yes','pn'); ?></option>
					<option value="0" <?php selected($enable_user_discount,0); ?>><?php _e('No','pn'); ?></option>
				</select>
			</div>
		</td>
	</tr>

	<tr>
		<th><?php _e('Max. user discount','pn'); ?></th>
		<td colspan="2">
			<div class="premium_wrap_standart">
				<input type="text" name="max_user_discount" style="width: 100px;" value="<?php echo is_sum(is_isset($data, 'max_user_discount')); ?>" />%
			</div>
		</td>
	</tr>
<?php
}
	
add_action('tab_direction_tab8', 'wchecks_tab_direction_tab8', 20, 2);
function wchecks_tab_direction_tab8($data, $data_id){	
	if(is_enable_check_purse()){	
?>
	<tr>
		<th><?php _e('Checking account for verification in PS','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="check_purse" id="check_purse" autocomplete="off">
					<option value="0" <?php selected(is_isset($data, 'check_purse'), 0); ?>><?php _e('No','pn'); ?></option>
					<option value="1" <?php selected(is_isset($data, 'check_purse'), 1); ?>><?php _e('Account Send','pn'); ?></option>
					<option value="2" <?php selected(is_isset($data, 'check_purse'), 2); ?>><?php _e('Account Receive','pn'); ?></option>
					<option value="3" <?php selected(is_isset($data, 'check_purse'), 3); ?>><?php _e('Account Send and Receive','pn'); ?></option>
				</select>
			</div>
		</td>
	</tr>
	<tr>
		<th><?php _e('Require account verification in PS','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<select name="req_check_purse" id="req_check_purse" autocomplete="off">
					<option value="0" <?php selected(is_isset($data, 'req_check_purse'), 0); ?>><?php _e('No','pn'); ?></option>
					<option value="1" <?php selected(is_isset($data, 'req_check_purse'), 1); ?>><?php _e('Account Send','pn'); ?></option>
					<option value="2" <?php selected(is_isset($data, 'req_check_purse'), 2); ?>><?php _e('Account Receive','pn'); ?></option>
					<option value="3" <?php selected(is_isset($data, 'req_check_purse'), 3); ?>><?php _e('Account Send and Receive','pn'); ?></option>
				</select>
			</div>
		</td>
	</tr>
<?php
	}
}		
/* end данные формы */