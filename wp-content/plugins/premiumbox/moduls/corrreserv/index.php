<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Reserve adjustment (group)[:en_US][ru_RU:]Массовая корректировка резерва[:ru_RU]
description: [en_US:]Reserve adjustment (group)[:en_US][ru_RU:]Массовая корректировка резерва[:ru_RU]
version: 1.5
category: [en_US:]Currency[:en_US][ru_RU:]Валюты[:ru_RU]
cat: currency
*/

add_action('admin_menu', 'pn_adminpage_corrreserv');
function pn_adminpage_corrreserv(){
global $premiumbox;

	if(current_user_can('administrator') or current_user_can('pn_currency_reserv')){
		add_submenu_page("pn_currency_reserv", __('Reserve adjustment (group)','pn'), __('Reserve adjustment (group)','pn'), 'read', "pn_mass_reserv", array($premiumbox, 'admin_temp'));
	}
}

add_action('pn_adminpage_title_pn_mass_reserv', 'def_adminpage_title_pn_mass_reserv');
function def_adminpage_title_pn_mass_reserv(){
	_e('Reserve adjustment (group)','pn');
}

add_action('pn_adminpage_content_pn_mass_reserv','def_pn_admin_content_pn_mass_reserv');
function def_pn_admin_content_pn_mass_reserv(){
global $wpdb;
?>
<div class="premium_body">
    <form method="post" action="<?php pn_the_link_post(); ?>">
    <table class="premium_standart_table">		
        <tr>
		    <th><?php _e('Currency name','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<?php
					$valuts = apply_filters('list_currency_manage', array(), __('Check all/Uncheck all','pn'));
					foreach($valuts as $k => $v){ 
						$cl = '';
						$style = '';
						if($k == 0){ $cl = 'check_all'; $style = 'font-weight: 500;'; }
					?>
						<div style="<?php echo $style; ?>"><label><input type="checkbox" name="currency_ids[]" class="check_once <?php echo $cl; ?>" value="<?php echo $k; ?>" /> <?php echo $v; ?></label></div>
					<?php
					}
					?>
				</div>
			</td>			
		</tr>
        <tr>
		    <th><?php _e('Amount','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="trans_sum" value="" />
				</div>
			</td>			
		</tr>
        <tr>
		    <th><?php _e('Comment','pn'); ?></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="text" name="trans_title" value="" />
				</div>
			</td>			
		</tr>		
        <tr>
		    <th></th>
			<td>
				<div class="premium_wrap_standart">
					<input type="submit" name="" class="button" value="<?php _e('Save','pn'); ?>" />
				</div>
			</td>
		</tr>		
    </table>
	</form>	
</div>
<script type="text/javascript">
jQuery(function($){
	$('.check_all').change(function(){
		if($(this).prop('checked')){
			$('.check_once').prop('checked',true);
		} else {
			$('.check_once').prop('checked',false);
		}
	});	
});
</script>
<?php	
}

add_action('premium_action_pn_mass_reserv','def_premium_action_pn_mass_reserv');
function def_premium_action_pn_mass_reserv(){
global $wpdb;	

	only_post();
	pn_only_caps(array('administrator','pn_currency_reserv'));

	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	
	$trans_title = pn_strip_input(is_param_post('trans_title'));
	$trans_sum = is_sum(is_param_post('trans_sum'));
	if($trans_sum != 0){
		$currency_ids = is_param_post('currency_ids');
		if(is_array($currency_ids) and count($currency_ids) > 0){
			foreach($currency_ids as $currency_id){
				$currency_id = intval($currency_id);
				if($currency_id){
					$array = array();
					$array['trans_title'] = $trans_title;
					$array['trans_sum'] = $trans_sum;
					$array['currency_id'] = 0;
					$array['currency_code_id'] = 0;
					$array['currency_code_title'] = '';
					$currency_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status = '1' AND id='$currency_id'");
					if(isset($currency_data->id)){
						$array['currency_id'] = $currency_data->id;
						$array['currency_code_id'] = $currency_data->currency_code_id;
						$array['currency_code_title'] = is_site_value($currency_data->currency_code_title);	
					}	
					$array['create_date'] = current_time('mysql');
					$array['user_creator'] = intval($user_id);
					$array['auto_status'] = 1;
					$wpdb->insert($wpdb->prefix.'currency_reserv', $array);
					$data_id = $wpdb->insert_id;	
					update_currency_reserv($array['currency_id']);
					do_action('pn_currency_reserv_add', $data_id, $array);
				}
			}
		}
	}

	$url = admin_url('admin.php?page=pn_currency_reserv&reply=true');
	wp_redirect($url);
	exit;
}	