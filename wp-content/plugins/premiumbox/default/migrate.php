<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_migrate', 'pn_adminpage_title_pn_migrate');
function pn_adminpage_title_pn_migrate($page){
	_e('Migration','pn');
} 

/* настройки */
add_action('pn_adminpage_content_pn_migrate','def_pn_adminpage_content_pn_migrate');
function def_pn_adminpage_content_pn_migrate(){
	
	$form = new PremiumForm();
?>
<div class="premium_body">
	<table class="premium_standart_table">
		<?php
		$form->h3(sprintf(__('Migration (if version is lesser than %s)','pn'),'1.0'), '');
		 		
		$r=0;
		while($r++<18){
		?>		
		<tr>
			<td>		
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=1_<?php echo $r; ?>" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Step %s','pn'),$r); ?>" />	
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=1_<?php echo $r; ?>&tech=1" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Technical step %s','pn'),$r); ?>" />		
			</td>
		</tr>
		<?php 
		} 
		?>
	</table>
</div>

<div class="premium_body">
	<table class="premium_standart_table">
		<?php
		$form->h3(sprintf(__('Migration (if version is lesser than %s)','pn'),'1.2'), '');
		
 		$r=0;
		while($r++<6){
		?>		
		<tr>
			<td>		
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=2_<?php echo $r; ?>" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Step %s','pn'),$r); ?>" />	
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=2_<?php echo $r; ?>&tech=1" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Technical step %s','pn'),$r); ?>" />		
			</td>
		</tr>
		<?php 
		} 
		?>
	</table>
</div>

<div class="premium_body">
	<table class="premium_standart_table">
		<?php
		$form->h3(sprintf(__('Migration (if version is lesser than %s)','pn'),'1.3'), '');
		
 		$r=0;
		while($r++<7){
		?>		
		<tr>
			<td>		
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=3_<?php echo $r; ?>" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Step %s','pn'),$r); ?>" />	
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count','post'); ?>&step=3_<?php echo $r; ?>&tech=1" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Technical step %s','pn'),$r); ?>" />		
			</td>
		</tr>
		<?php 
		}
		?>
	</table>
</div>

<div class="premium_body">
	<table class="premium_standart_table">
		<?php
		$form->h3(sprintf(__('Migration (if version is lesser than %s)','pn'),'1.4'), '');
		
 		$r=0;
		while($r++<36){
		?>		
		<tr>
			<td>		
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count', 'post'); ?>&step=4_<?php echo $r; ?>" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Step %s','pn'),$r); ?>" />	
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count', 'post'); ?>&step=4_<?php echo $r; ?>&tech=1" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Technical step %s','pn'),$r); ?>" />		
			</td>
		</tr>
		<?php 
		}
		?>
	</table>
</div>

<div class="premium_body">
	<table class="premium_standart_table">
		<?php
		$form->h3(sprintf(__('Migration (if version is lesser than %s)','pn'),'1.5'), '');
		
 		$r=0;
		while($r++<3){
		?>		
		<tr>
			<td>		
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count', 'post'); ?>&step=5_<?php echo $r; ?>" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Step %s','pn'),$r); ?>" />	
				<input name="submit" type="submit" class="button pn_prbar" data-count-url="<?php pn_the_link_post('migrate_step_count', 'post'); ?>&step=5_<?php echo $r; ?>&tech=1" data-title="<?php printf(__('Step %s','pn'),$r); ?>" value="<?php printf(__('Technical step %s','pn'),$r); ?>" />		
			</td>
		</tr>
		<?php 
		}
		?>
	</table>
</div>
	
<div class="premium_shadow js_techwindow"></div>
<div class="prbar_wrap js_techwindow">
	<div class="prbar_wrap_ins">
		<div class="prbar_close"></div>
		<div class="prbar_title"></div>
		<div class="prbar_content">
		
			<div class="prbar_num">
				<?php printf(__('Found: %1s %2s %3s requests','pn'), '<input type="text" name="" class="prbar_num_count" value="','0','" />'); ?>
			</div>
			<div class="prbar_control">
				<div class="prbar_input">
					<?php _e('Perform','pn'); ?>: <input type="text" name="" class="prbar_count" value="100" />
				</div>
				<div class="prbar_submit"><?php _e('Run','pn'); ?></div>
					<div class="premium_clear"></div>
			</div>
			
			<div class="prbar_ind"><div class="prbar_ind_abs"></div><div class="prbar_ind_text">0%</div></div>
			<div class="prbar_log_wrap">
				<div class="prbar_log"></div>			
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(function($){
	$(document).PrBar({ 
		trigger: '.pn_prbar',
		start_title: '<?php _e('determining the number of requests','pn'); ?>...',
		end_title: '<?php _e('number of requests defined','pn'); ?>',
		line_text: '<?php _e('%now% of %max% steps completed','pn'); ?>',
		line_success: '<?php _e('step %now% is successful','pn'); ?>',
		end_progress: '<?php _e('action is completed','pn'); ?>',
		success: function(res){
			res.prop('disabled', true);
		}
	});
});
</script>
<?php
}

add_action('premium_action_migrate_step_count','def_premium_action_migrate_step_count');
function def_premium_action_migrate_step_count(){
global $wpdb;	

	only_post();

	$log = array();
	$log['status'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = '';
	$log['count'] = 0;
	$log['link'] = '';
	
	$step = is_param_get('step');
	$tech = intval(is_param_get('tech'));
	if(current_user_can('administrator')){
		$count = 0;
		
		if(!$tech){
			
			if($step == '1_2'){
				$count = 1;				
			}
			
			if($step == '1_3'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."valuts");
				}	
			}	

			if($step == '1_5'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){				
					$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'naps_lang'");
					if ($query == 1){
						$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."naps");
					}
				}
			}

			if($step == '1_6'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){				
					$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'not_country'");
					if ($query == 1){
						$count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."naps WHERE autostatus='1'");
					}
				}	
			}

			if($step == '1_7'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){				
					$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'not_ip'");
					if ($query == 1){
						$count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."naps WHERE autostatus='1'");
					}
				}
			}	
			
			if($step == '1_9'){	
				$tables = array(
					'_user_fav','_reviews','_reviews_meta', '_partners','_user_discounts','_archive_data','_psys',
					'_blacklist','_bids_meta','_bidstatus','_valuts_account','_bid_logs','_naps_sumcurs',
					'_geoip_blackip','_geoip_whiteip','_geoip_template','_geoip_iplist','_geoip_country',
					'_plinks','_partner_pers','_uv_field','_uv_field_user',
				);
				$count = count($tables);
			}
			
			if($step == '1_10'){
				$count = 1;				
			}
			
			if($step == '1_11'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."valuts");
				}	
			}	

			if($step == '1_14'){
				$count = 1;				
			}

			if($step == '1_16'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."maintrance");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."maintrance");	
				}	
			}

			if($step == '1_17'){
				$arr = array(
					array(
						'tbl' => 'users',
						'row' => 'user_discount',
					),
					array(
						'tbl' => 'user_discounts',
						'row' => 'sumec',					
					),
					array(
						'tbl' => 'user_discounts',
						'row' => 'discount',					
					),		
					array(
						'tbl' => 'users',
						'row' => 'partner_pers',					
					),
					array(
						'tbl' => 'partner_pers',
						'row' => 'sumec',					
					),
					array(
						'tbl' => 'partner_pers',
						'row' => 'pers',
					),	
					array(
						'tbl' => 'naps_sumcurs',
						'row' => 'sum_val',
					),
					array(
						'tbl' => 'naps_sumcurs',
						'row' => 'curs1',
					),
					array(
						'tbl' => 'naps_sumcurs',
						'row' => 'curs2',
					),				
				);
				
				$count = count($arr);			
			}

			if($step == '2_1'){	
				$count = 1;
			}

			if($step == '3_1'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."vtypes");
				}	
			}

			if($step == '3_2'){
				$count = 1;		
			}	

			if($step == '3_3'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."naps");	
				}
			}

			if($step == '3_4'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."naps");
				}	
			}

			if($step == '3_7'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_naps");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_naps");
				}	
			}	

			if($step == '4_1'){	
				$count = 1;
			}

			if($step == '4_2'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."change");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."change");
				}
			}

			if($step == '4_3'){	
				$count = 1;
			}

			if($step == '4_4'){
				$count = $wpdb->get_var("SELECT COUNT(ID) FROM ". $wpdb->prefix ."users");		
			}

			if($step == '4_5'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."head_mess");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."head_mess");
				}
			}

			if($step == '4_6'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."warning_mess");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."warning_mess");
				}
			}

			if($step == '4_7'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."operator_schedules");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."operator_schedules");
				}
			}

			if($step == '4_8'){
				$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."psys");
			}

			if($step == '4_9'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."vtypes");
				}
			}

			if($step == '4_10'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."valuts");
				}	
			}

			if($step == '4_11'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts_meta");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."valuts_meta");
				}	
			}

			if($step == '4_12'){
				$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency");	
			}

			if($step == '4_13'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."trans_reserv");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."trans_reserv");
				}		
			}

			if($step == '4_14'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."naps");
				}		
			}

			if($step == '4_15'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps_meta");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."naps_meta");
				}		
			}

			if($step == '4_16'){
				$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency WHERE auto_status = '1'");				
			}

			if($step == '4_17'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."custom_fields_valut");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."custom_fields_valut");
				}				
			}

			if($step == '4_18'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."custom_fields");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."custom_fields");
				}				
			}

			if($step == '4_19'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."cf_naps");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."cf_naps");
				}				
			}

			if($step == '4_20'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."user_accounts");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_accounts");
				}				
			}

			if($step == '4_21'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."uv_accounts");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_accounts");
				}				
			}

			if($step == '4_22'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."uv_accounts_files");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_accounts_files");
				}				
			}			
			
			if($step == '4_23'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_vtypes");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_vtypes");
				}				
			}

			if($step == '4_24'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_naps");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_naps");
				}				
			}

			if($step == '4_25'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bids");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bids");
				}				
			}

			if($step == '4_26'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."exchange_bids");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids");
				}				
			}

			if($step == '4_27'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."payoutuser");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."payoutuser");
				}				
			}

			if($step == '4_28'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts_fstats");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."valuts_fstats");
				}				
			}

			if($step == '4_29'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes_fstats");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."vtypes_fstats");
				}				
			}	

			if($step == '4_30'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bids_fstats");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bids_fstats");
				}				
			}

			if($step == '4_31'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."userverify");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."userverify");
				}				
			}

			if($step == '4_32'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."archive_bids");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_bids");	
				}	
			}

			if($step == '4_33'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."archive_exchange_bids");
				if($query == 1){
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids");	
				}	
			}

			if($step == '4_34'){
				$count = 1;
			}

			if($step == '4_35'){
				$count = 1;
			}

			if($step == '4_36'){
				$count = 1;
			}

			if($step == '5_1'){
				$count = 1;
			}

			if($step == '5_2'){
				$count = 1;
			}

			if($step == '5_3'){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."autodel_bids_time");
				if($query == 1){				
					$count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."autodel_bids_time");
				}
			}			
		}
		
		$log['status'] = 'success';
		$log['count'] = $count;
		$log['link'] = pn_link_post('migrate_step_request','post').'&step='.$step;
		$log['status_text'] = __('Ok!','pn');

	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! Insufficient privileges','pn');
	}
	
	echo json_encode($log);
	exit;	
}

add_action('premium_action_migrate_step_request','def_premium_action_migrate_step_request');
function def_premium_action_migrate_step_request(){
global $wpdb, $premiumbox;	

	only_post();

	$log = array();
	$log['status'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = '';
	$log['count'] = 0;
	$log['link'] = '';
	
	$step = is_param_get('step');
	$idspage = intval(is_param_post('idspage'));
	$limit = intval(is_param_post('limit')); if($limit < 1){ $limit = 1; }
	$offset = ($idspage - 1) * $limit;
	if(current_user_can('administrator')){	

		if($step == '1_2'){	 /*****************/

			$val = trim($premiumbox->get_option('exchange','techregtext'));
			if($val){
				$premiumbox->update_option('tech','text',$val);
				$premiumbox->update_option('exchange','techregtext','');
			}
			$val = trim($premiumbox->get_option('exchange','techreg'));
			if($val){
				$premiumbox->update_option('tech','manualy',$val);
				$premiumbox->update_option('exchange','techreg','');
			}			
		
		}
		
		if($step == '1_3'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
			if($query == 1){
		
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."valuts LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$reserv_place = is_isset($data, 'reserv_place');
					if($reserv_place){					
						$reserv_place = str_replace('m1_','perfectmoney_',$reserv_place);
						$reserv_place = str_replace('m12_','nixmoney_',$reserv_place);
						$reserv_place = str_replace('m3_','webmoney_',$reserv_place);
						$reserv_place = str_replace('m8_','okpay_',$reserv_place);
						$reserv_place = str_replace('m29_','blockio_',$reserv_place);
						$reserv_place = str_replace('m23_','btce_',$reserv_place);
						$reserv_place = str_replace('m28_','livecoin_',$reserv_place);
						$reserv_place = str_replace('m5_','privat_',$reserv_place);
						$reserv_place = str_replace('m4_','yamoney_',$reserv_place);					
						$wpdb->query("UPDATE ". $wpdb->prefix ."valuts SET reserv_place = '$reserv_place' WHERE id = '$id'");
					}
				}
			
			}
		}
		
		if($step == '1_5'){	 /*****************/
		
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){				
				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'naps_lang'");
				if ($query == 1){
					$all = '';
					$langs = get_langs_ml();
					foreach($langs as $lang){
						$all .= '[d]'. $lang .'[/d]';
					}				
					$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps LIMIT {$offset},{$limit}");
					foreach($datas as $data){
						$id = $data->id;
						$naps_lang = pn_strip_input($data->naps_lang);
						$naps_lang = str_replace('0','',$naps_lang);
						if(!strstr($naps_lang, '[d]')){
							if($naps_lang){
								$naps_lang = '[d]'.$naps_lang.'[/d]';
							} else {
								$naps_lang = $all;
							}
							$arr = array();
							$arr['naps_lang'] = $naps_lang;
							$wpdb->update($wpdb->prefix.'naps', $arr, array('id'=>$id));					
						}
					}						
				}
			}			
			
		}

		if($step == '1_6'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){		
				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'not_country'");
				if ($query == 1){
					$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps WHERE autostatus='1' LIMIT {$offset},{$limit}");
					foreach($datas as $data){
						$id = $data->id;					
						$not_country = @unserialize($data->not_country);
						if(is_array($not_country)){
							if(count($not_country) > 0){							
								$country = '';
								foreach($not_country as $cou){
									$country .= '[d]'. $cou .'[/d]';
								}							
								$arr = array();
								$arr['not_country'] = $country;
								$wpdb->update($wpdb->prefix.'naps', $arr, array('id'=>$id));														
							}					
						}
					}
				}
			}
		}
		
		if($step == '1_7'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){
				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."naps LIKE 'not_ip'");
				if ($query == 1){
					$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps WHERE autostatus='1' LIMIT {$offset},{$limit}");
					foreach($datas as $data){
						$id = $data->id;
						$not_ip = $data->not_ip;
						if(!strstr($not_ip, '[d]') and $not_ip){
							$not_ip = explode("\n",$not_ip);
							if(count($not_ip) > 0){
								$item = '';
								foreach($not_ip as $v){
									$v = trim($v);
									if($v){
										$item .= '[d]'. $v .'[/d]';
									}
								}	
								$arr = array();
								$arr['not_ip'] = $item;
								$wpdb->update($wpdb->prefix.'naps', $arr, array('id'=>$id));							
							}
						}
					}
				}		
			}
		}

		if($step == '1_9'){	 /*****************/

			$tables = array(
				'_user_fav', '_reviews','_reviews_meta','_partners','_user_discounts','_archive_data','_psys',
				'_blacklist','_bids_meta','_bidstatus','_valuts_account','_bid_logs','_naps_sumcurs',
				'_geoip_blackip','_geoip_whiteip','_geoip_template','_geoip_iplist','_geoip_country',
				'_plinks','_partner_pers','_uv_field','_uv_field_user',
			);	
			$array = array_slice($tables, $offset, $limit);
			foreach($array as $tb){
				$tb = ltrim($tb,'_');
				$table = $wpdb->prefix . $tb;
				$query = $wpdb->query("CHECK TABLE {$table}");
				if($query == 1){
					$wpdb->query("ALTER TABLE {$table} ENGINE=InnoDB");
				}
			}

		}
		
		if($step == '1_10'){	 /*****************/		
		
			$globalajax = trim($premiumbox->get_option('globalajax'));
			if($globalajax){
				$premiumbox->update_option('ga','ga_admin', 1);
				$premiumbox->update_option('ga','ga_site', 1);
				$premiumbox->delete_option('globalajax');
			}		
			
			$adminpass = trim($premiumbox->get_option('adminpass'));
			if(!is_numeric($adminpass)){
				$premiumbox->update_option('adminpass','', 1);
			}				
		
		}	

		if($step == '1_11'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
			if($query == 1){
		
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."valuts LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$helps2 = trim(is_isset($data,'helps2'));
					if(!$helps2){					
						$arr = array(
							'helps2' => is_isset($data, 'helps'),
						);
						$wpdb->update($wpdb->prefix.'valuts', $arr, array('id'=>$data->id));						
					}
				}
			
			}
		}		

		if($step == '1_14'){	 /*****************/

			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."term_meta");
			if($query == 1){		
				$items = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."term_meta");
				foreach($items as $item){
					$id = $item->id;
					$arr = array(
						'term_id' => $item->item_id,
						'meta_key' => $item->meta_key,
						'meta_value' => $item->meta_value,
					);
					$wpdb->insert($wpdb->prefix.'termmeta', $arr);
					$wpdb->query("DELETE FROM ". $wpdb->prefix ."term_meta WHERE id = '$id'");
				}
			}				

		}		
		
		if($step == '1_16'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."maintrance");
			if($query == 1){
				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."maintrance LIKE 'page_files'");
				if ($query){ 
				
					$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."maintrance LIMIT {$offset},{$limit}");
					foreach($datas as $data){
						$pages_law = array();
						$pages_law['files'] = is_isset($data,'page_files');
						$pages_law['smxml'] = is_isset($data,'page_xml');
						$pages_law['sm'] = is_isset($data,'page_sitemap');
						$pages_law['tar'] = is_isset($data,'page_tarifs');
						$pages_law['home'] = is_isset($data,'page_home');
						$pages_law['exchange'] = is_isset($data,'page_exchange');
						$pages_law = serialize($pages_law);
						$wpdb->update($wpdb->prefix.'maintrance', array('pages_law'=>$pages_law), array('id'=>$data->id));						
					}				

				} 					
			}
		}	

		if($step == '1_17'){	 /*****************/

			$arr = array(
				array(
					'tbl' => 'users',
					'row' => 'user_discount',
				),
				array(
					'tbl' => 'user_discounts',
					'row' => 'sumec',					
				),
				array(
					'tbl' => 'user_discounts',
					'row' => 'discount',					
				),		
				array(
					'tbl' => 'users',
					'row' => 'partner_pers',					
				),				
				array(
					'tbl' => 'partner_pers',
					'row' => 'sumec',					
				),
				array(
					'tbl' => 'partner_pers',
					'row' => 'pers',
				),	
				array(
					'tbl' => 'naps_sumcurs',
					'row' => 'sum_val',
				),
				array(
					'tbl' => 'naps_sumcurs',
					'row' => 'curs1',
				),
				array(
					'tbl' => 'naps_sumcurs',
					'row' => 'curs2',
				),				
			);
			$arr = array_slice($arr, $offset, $limit);
			
			foreach($arr as $data){
				$table = $wpdb->prefix. $data['tbl'];
				$query = $wpdb->query("CHECK TABLE {$table}");
				if($query == 1){
					$row = $data['row'];
					$que = $wpdb->query("SHOW COLUMNS FROM {$table} LIKE '{$row}'");
					if ($que) {
						$wpdb->query("ALTER TABLE {$table} CHANGE `{$row}` `{$row}` varchar(50) NOT NULL default '0'");
					}	
				}
			}			

		}			

		if($step == '2_1'){	 /*****************/
		
			$sn = trim($premiumbox->get_option('second_name'));
			if(!is_numeric($sn)){
				$sn = 1;
			}	
			$ch_mail = trim($premiumbox->get_option('change_email'));
			if(!is_numeric($ch_mail)){
				$ch_mail = 1;
			}
			
			$fields = array(
				'login' => 1,
				'last_name' => 1,
				'first_name' => 1,
				'second_name' => $sn,
				'user_phone' => 1,
				'user_skype' => 1,
				'website' => 1,
				'user_passport' => 1,
			);	
			$premiumbox->update_option('user_fields','',$fields);
			
			$fields = array(
				'user_email' => $ch_mail,
				'last_name' => 1,
				'first_name' => 1,
				'second_name' => 1,
				'user_phone' => 1,
				'user_skype' => 1,
				'website' => 1,
				'user_passport' => 1,
			);			
			$premiumbox->update_option('user_fields_change','',$fields);
			
			$premiumbox->delete_option('second_name');
			$premiumbox->delete_option('change_email');
		
		}					

		if($step == '3_1'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."vtypes");
				foreach($datas as $data){
					$id = $data->id;
					$elem = intval(is_isset($data, 'elem'));
					$nums = $data->nums;
					if($elem == 1){
						$nums = str_replace('%','',$nums);
						$nums .= ' %';	
					}
					$arr = array();
					$arr['nums'] = $nums;
					$wpdb->update($wpdb->prefix.'vtypes', $arr, array('id'=>$data->id));
				} 
			}
		}

		if($step == '3_2'){	 /*****************/
			$premiumbox->update_option('usve','disable_mtype_check', 1);
			$premiumbox->update_option('exchange','enable_step2', 1);
			$premiumbox->update_option('exchange','avsumbig', 1);
			
			$premiumbox->update_option('archivebids','txt', 1);
			//$premiumbox->update_option('archivebids','loadhistory', 1);
			
			$places = apply_filters('list_directions_temp',array());
			foreach($places as $place => $title){
				if($place != 'success'){
					$premiumbox->update_option('naps_ap_instruction', $place, 0);
				}
			}
			
			$av_status_button = get_option('av_status_button');
			if(!is_array($av_status_button)){ 
				$av_status_button = array('realpay','verify','payed');
				update_option('av_status_button',$av_status_button);
			}
			//$av_status_timeout = get_option('av_status_timeout');
			//if(!is_array($av_status_timeout)){ 
				//$av_status_timeout = array('realpay','verify','payed');
				//update_option('av_status_timeout',$av_status_timeout);
			//}			
			
			$checks = array('0', '1', '2', '3', '4', '5');
			$premiumbox->update_option('blacklist', 'check', $checks);
		}

		if($step == '3_3'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){		
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;

					$arr = array();
					
					$melem1 = intval(is_isset($data, 'melem1'));
					$mnums1 = trim(is_isset($data, 'mnums1'));
					if($melem1 == 1){
						$mnums1 = str_replace('%','',$mnums1);
						$mnums1 .= ' %';	
					}				
					if($mnums1){
						$arr['mnums1'] = $mnums1;
					}
					
					$melem2 = intval(is_isset($data, 'melem2'));
					$mnums2 = trim(is_isset($data, 'mnums2'));
					if($melem2 == 1){
						$mnums2 = str_replace('%','',$mnums2);
						$mnums2 .= ' %';	
					}
					if($mnums2){
						$arr['mnums2'] = $mnums2;
					}

					$elem1 = intval(is_isset($data, 'elem1'));
					$nums1 = trim(is_isset($data, 'nums1'));
					if($elem1 == 1){
						$nums1 = str_replace('%','',$nums1);
						$nums1 .= ' %';	
					}
					if($nums1){
						$arr['nums1'] = $nums1;
					}
					
					$elem2 = intval(is_isset($data, 'elem2'));
					$nums2 = trim(is_isset($data, 'nums2'));
					if($elem2 == 1){
						$nums2 = str_replace('%','',$nums2);
						$nums2 .= ' %';	
					}
					if($nums2){
						$arr['nums2'] = $nums2;
					}	
					
					if(count($arr) > 0){
						$wpdb->update($wpdb->prefix.'naps', $arr, array('id'=>$data->id));
					}
				}
			}
		}	

		if($step == '3_4'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){		
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$maxexip = intval(is_isset($data,'maxexip'));
					if($maxexip > 0){
						$naps_constraints = array(
							'max_ip' => $maxexip,
						);
						update_direction_meta($data->id, 'naps_constraints', $naps_constraints);
					}
				} 					
			}
		}					
		
		if($step == '3_7'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_naps");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bcbroker_naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;

					$arr = array();
					
					$elem = intval(is_isset($data, 'elem1'));
					$nums = trim(is_isset($data, 'nums1'));
					if($elem == 1){
						$nums = str_replace('%','',$nums);
						$nums .= ' %';	
					}
					if($nums){
						$arr['nums1'] = $nums;
					}

					$elem = intval(is_isset($data, 'elem2'));
					$nums = trim(is_isset($data, 'nums2'));
					if($elem == 1){
						$nums = str_replace('%','',$nums);
						$nums .= ' %';	
					}
					if($nums){
						$arr['nums2'] = $nums;
					}
					
					if(count($arr) > 0){
						$wpdb->update($wpdb->prefix.'bcbroker_naps', $arr, array('id'=>$data->id));
					}
				}
			}
		}

		if($step == '4_1'){	 /*****************/
			$wpdb->update($wpdb->prefix.'usermeta', array('meta_key' => ''), array('meta_key' => 'locale'));
			$premiumbox->update_option('admin_panel_captcha','', 1);
			$premiumbox->update_option('wchecks', '', 1);
			
			$tableicon = intval($premiumbox->get_option('mobile','tableicon'));
			if($tableicon == 1){
				$premiumbox->update_option('mobile','tableicon', 0);
			}
			
			$mailtemp = get_option('mailtemp');
			if($mailtemp){
				$pn_notify = array();
				$pn_notify['email'] = $mailtemp;
				update_option('pn_notify', $pn_notify);
				delete_option('mailtemp');
			}
		}

		if($step == '4_2'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."change");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."change LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$meta_key = $data->meta_key;
					$meta_key2 = $data->meta_key2;
					$meta_value = $data->meta_value;
					
					if($meta_key == 'up_mode'){
						$premiumbox->update_option('up_mode', '', 1);
					} else {	
						$premiumbox->update_option($meta_key, $meta_key2, $meta_value);
					}
				}
			}
		}

		if($step == '4_3'){	 /*****************/
			$pn_cron = get_option('pn_cron');
			$pn_cron = (array)$pn_cron;
			
			$old_cron = intval($premiumbox->get_option('cron',''));
			$place1 = 'site';
			$place2 = 'file';
			if($old_cron == 1){
				$place1 = 'file';
				$place2 = 'site';
			} 
			
			if(!isset($pn_cron['site'])){
				
				$array = array(
					'10min' => array('acp_del_img','captcha_del_img'),
					'1day' => array('premiumbox_chkv','del_autologs','del_courselogs','delete_auto_directions'),
					'1hour' => array('parser_upload_data'),
				);
				
				foreach($array as $k => $func_names){
					foreach($func_names as $func_name){
						$pn_cron[$place1][$func_name]['work_time'] = $k;
						$pn_cron[$place2][$func_name]['work_time'] = 'none';
					}
				}
				
				$times = pn_cron_times();
				$time_now = current_time('timestamp');
				foreach($times as $time_key => $time_data){
					if($time_key != 'none'){
						$pn_cron['update_times']['site'][$time_key] = $time_now;
						$pn_cron['update_times']['file'][$time_key] = $time_now;
					}
				}
				
				update_option('pn_cron', $pn_cron);	
				
				$premiumbox->delete_option('cron','');
			}
		}


		if($step == '4_4'){	 /*****************/
			$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."users LIMIT {$offset},{$limit}");
			foreach($datas as $data){
				$id = $data->ID;
				
				$array = array();
				$array['user_browser'] = get_user_meta($id, 'user_browser', true);
				$array['user_ip'] = get_user_meta($id, 'user_ip', true);
				$array['user_bann'] = get_user_meta($id, 'user_bann', true);
				$array['admin_comment'] = get_user_meta($id, 'admin_comment', true);
				$array['last_adminpanel'] = get_user_meta($id, 'admin_time_last', true);
				$wpdb->update($wpdb->prefix ."users", $array, array('ID'=> $id));	

				delete_user_meta($id, 'user_browser');
				delete_user_meta($id, 'user_ip');
				delete_user_meta($id, 'user_bann');
				delete_user_meta($id, 'admin_comment');
				delete_user_meta($id, 'admin_time_last');
			} 
		}

		if($step == '4_5'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."head_mess");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."head_mess LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['notice_type'] = 1;
					$array['op_status'] = $data->op_status;					
					$array['h1'] = $data->h1;
					$array['m1'] = $data->m1;
					$array['h2'] = $data->h2;
					$array['m2'] = $data->m2;
					$array['d1'] = $data->d1;
					$array['d2'] = $data->d2;
					$array['d3'] = $data->d3;
					$array['d4'] = $data->d4;
					$array['d5'] = $data->d5;
					$array['d6'] = $data->d6;
					$array['d7'] = $data->d7;
					$array['url'] = $data->url;
					$array['text'] = $data->text;
					$array['status'] = $data->status;
					$array['theclass'] = is_isset($data,'theclass');
					
					$cc_count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."notice_head WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."notice_head", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."notice_head", $array, array('id'=> $id));	
					}										
					
				}
			}
		}

		if($step == '4_6'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."warning_mess");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."warning_mess LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;

					$array = array();
					$array['datestart'] = $data->datestart;
					$array['dateend'] = $data->dateend;
					$array['url'] = $data->url;
					$array['text'] = $data->text;
					$array['status'] = $data->status;
					$array['theclass'] = is_isset($data,'theclass');
					
					$cc_count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."notice_head WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."notice_head", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."notice_head", $array, array('id'=> $id));	
					}					

				}
			}
		}

		if($step == '4_7'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."operator_schedules");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."operator_schedules LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;

					$array = array();
					$array['status'] = $data->status;
					$array['save_order'] = $data->save_order;
					$array['h1'] = $data->h1;
					$array['m1'] = $data->m1;
					$array['h2'] = $data->h2;
					$array['m2'] = $data->m2;
					$array['d1'] = $data->d1;
					$array['d2'] = $data->d2;
					$array['d3'] = $data->d3;
					$array['d4'] = $data->d4;
					$array['d5'] = $data->d5;
					$array['d6'] = $data->d6;
					$array['d7'] = $data->d7;
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."schedule_operators WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."schedule_operators", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."schedule_operators", $array, array('id'=> $id));	
					}					
				}
			}
		}

		if($step == '4_8'){	 /*****************/
			$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."psys LIMIT {$offset},{$limit}");
			foreach($datas as $data){
				$id = $data->id;
				$psys_title_arr = @unserialize(is_isset($data, 'psys_logo'));
				if(!is_array($psys_title_arr)){
					$array = array();
					$psys_logo = array(
						'logo1' => esc_url(is_isset($data, 'psys_logo')),
						'logo2' => esc_url(is_isset($data, 'psys_logo')),
					);
					$array['psys_logo'] = @serialize($psys_logo);
					$wpdb->update($wpdb->prefix ."psys", $array, array('id'=>$id));
				}
			}
		}

		if($step == '4_9'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."vtypes LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['currency_code_title'] = $data->vtype_title;					
					$array['internal_rate'] = $data->vncurs;
					$array['parser_actions'] = $data->nums;
					$array['parser'] = $data->parser;
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_codes WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_codes", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_codes", $array, array('id'=> $id));	
					}				
				}
			}
		}

		if($step == '4_10'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."valuts LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['auto_status'] = 1;
					$array['currency_logo'] = is_isset($data,'valut_logo');
					$array['psys_logo'] = is_isset($data,'psys_logo');
					$array['psys_id'] = is_isset($data,'psys_id');
					$array['psys_title'] = is_isset($data,'psys_title');
					$array['currency_code_id'] = is_isset($data,'vtype_id');
					$array['currency_code_title'] = is_isset($data,'vtype_title');
					$array['currency_decimal'] = is_isset($data,'valut_decimal');
					$array['currency_status'] = is_isset($data,'valut_status');
					$array['currency_reserv'] = is_isset($data,'valut_reserv');
					$array['helps_give'] = is_isset($data,'helps');
					$array['helps_get'] = is_isset($data,'helps2');					
					$array['show_give'] = is_isset($data,'show1');
					$array['show_get'] = is_isset($data,'show2');					
					$array['txt_give'] = is_isset($data,'txt1');
					$array['txt_get'] = is_isset($data,'txt2');									
					$array['cf_hidden'] = is_isset($data,'cf_hidden');
					$array['site_order'] = is_isset($data,'site_order');
					$array['reserv_order'] = is_isset($data,'reserv_order');					
					$array['minzn'] = is_isset($data,'minzn');
					$array['maxzn'] = is_isset($data,'maxzn');	
					$array['firstzn'] = is_isset($data,'firstzn');
					$array['cifrzn'] = is_isset($data,'cifrzn');
					$array['vidzn'] = is_isset($data,'vidzn');
					$array['lead_num'] = is_isset($data,'lead_num');
					$array['reserv_place'] = is_isset($data,'reserv_place');
					$array['xml_value'] = is_isset($data,'xml_value');
					$array['check_text'] = is_isset($data,'check_text');
					$array['check_purse'] = is_isset($data,'check_purse');				
					
					$modules_bds = array(
						'max_reserv' => 'max_reserv',
						'user_accounts' => 'user_wallets',
						'inday1' => 'inday1',
						'inday2' => 'inday2',
						'inmon1' => 'inmon1',
						'inmon2' => 'inmon2',
						'paybonus' => 'paybonus',
						'pvivod' => 'p_payout',
						'payout_com' => 'payout_com',
					);
					
					foreach($modules_bds as $modules_bd_old => $modules_bd_new){
						$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE '{$modules_bd_new}'");
						if ($query == 1){
							$array[$modules_bd_new] = is_isset($data, $modules_bd_old);
						}	
					}

					$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency LIKE 'user_wallets'");
					if ($query == 1){
						$array['user_wallets'] = 1;
					}					
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency", $array, array('id'=> $id));	
					}				
				}
			}
		}

		if($step == '4_11'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts_meta");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."valuts_meta LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['item_id'] = $data->item_id;					
					$array['meta_key'] = $data->meta_key;
					$array['meta_value'] = $data->meta_value;
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_meta WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_meta", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_meta", $array, array('id'=> $id));	
					}					
				}
			}
		}

		if($step == '4_12'){	 /*****************/
			$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency LIMIT {$offset},{$limit}");
			foreach($datas as $data){
				$id = $data->id;
				$currency_title_arr = @unserialize(is_isset($data, 'currency_logo'));
				if(!is_array($currency_title_arr)){
					$array = array();
					$currency_logo = array(
						'logo1' => esc_url(is_isset($data, 'currency_logo')),
						'logo2' => esc_url(is_isset($data, 'currency_logo')),
					);
					$array['currency_logo'] = @serialize($currency_logo);
					$psys_id = $data->psys_id;
					$psys_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."psys WHERE id='$psys_id'");
					$array['psys_logo'] = is_isset($psys_data, 'psys_logo');
					$wpdb->update($wpdb->prefix ."currency", $array, array('id'=>$id));
				}
			}
		}

		if($step == '4_13'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."trans_reserv");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."trans_reserv LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['trans_title'] = $data->trans_title;
					$array['create_date'] = $data->trans_create;
					$array['edit_date'] = $data->trans_edit;
					$array['user_creator'] = $data->user_creator;
					$array['user_editor'] = $data->user_editor;
					$array['trans_sum'] = $data->trans_summ;
					$array['currency_id'] = $data->valut_id;
					$array['currency_code_id'] = $data->vtype_id;
					$array['currency_code_title'] = $data->vtype_title;
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_reserv WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_reserv", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_reserv", $array, array('id'=> $id));	
					}					
				}
			}
		}

		if($step == '4_14'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['auto_status'] = is_isset($data,'autostatus');
					$array['create_date'] = is_isset($data,'createdate');
					$array['edit_date'] = is_isset($data,'editdate');
					$array['currency_id_give'] = is_isset($data,'valut_id1');
					$array['currency_id_get'] = is_isset($data,'valut_id2');
					$array['psys_id_give'] = is_isset($data,'psys_id1');
					$array['psys_id_get'] = is_isset($data,'psys_id2');
					$array['tech_name'] = is_isset($data,'tech_name');
					$array['direction_name'] = is_isset($data,'naps_name');
					$array['direction_status'] = is_isset($data,'naps_status');
					$array['site_order1'] = is_isset($data,'site_order1');
					$array['course_give'] = is_isset($data,'curs1');
					$array['course_get'] = is_isset($data,'curs2');
					$array['to1'] = is_isset($data,'to1');
					$array['to2_1'] = is_isset($data,'to2_1');
					$array['to2_2'] = is_isset($data,'to2_2');
					$array['to3_1'] = is_isset($data,'to3_1');
					$array['check_purse'] = is_isset($data,'check_purse');
					$array['req_check_purse'] = is_isset($data,'req_check_purse');
					$array['max_user_discount'] = is_isset($data,'max_user_sk');
					$array['enable_user_discount'] = is_isset($data,'user_sk');
					$array['min_sum1'] = is_isset($data,'minsumm1');
					$array['min_sum2'] = is_isset($data,'minsumm2');
					$array['max_sum1'] = is_isset($data,'maxsumm1');
					$array['max_sum2'] = is_isset($data,'maxsumm2');
					$array['com_box_sum1'] = is_isset($data,'com_box_summ1');
					$array['com_box_pers1'] = is_isset($data,'com_box_pers1');
					$array['com_box_min1'] = is_isset($data,'com_box_min1');
					$array['com_box_sum2'] = is_isset($data,'com_box_summ2');
					$array['com_box_pers2'] = is_isset($data,'com_box_pers2');
					$array['com_box_min2'] = is_isset($data,'com_box_min2');									
					$array['profit_sum1'] = is_isset($data,'profit_summ1');
					$array['profit_pers1'] = is_isset($data,'profit_pers1');
					$array['profit_sum2'] = is_isset($data,'profit_summ2');
					$array['profit_pers2'] = is_isset($data,'profit_pers2');
					$array['com_sum1'] = is_isset($data,'com_summ1');
					$array['com_sum2'] = is_isset($data,'com_summ2');
					$array['com_pers1'] = is_isset($data,'com_pers1');
					$array['com_pers2'] = is_isset($data,'com_pers2');
					$array['m_in'] = is_isset($data,'m_in');
					$array['m_out'] = is_isset($data,'m_out');
					$array['com_sum1_check'] = is_isset($data,'com_summ1_check');
					$array['com_sum2_check'] = is_isset($data,'com_summ2_check');
					$array['com_pers1_check'] = is_isset($data,'com_pers1_check');
					$array['com_pers2_check'] = is_isset($data,'com_pers2_check');
					$array['pay_com1'] = is_isset($data,'pay_com1');
					$array['pay_com2'] = is_isset($data,'pay_com2');
					$array['nscom1'] = is_isset($data,'nscom1');
					$array['nscom2'] = is_isset($data,'nscom2');
					$array['maxsum1com'] = is_isset($data,'maxsumm1com');
					$array['maxsum2com'] = is_isset($data,'maxsumm2com');
					$array['minsum1com'] = is_isset($data,'minsumm1com');
					$array['minsum2com'] = is_isset($data,'minsumm2com');
					
					$modules_bds = array(
						'filecourse' => 'filecourse',
						'mobile' => 'mobile',
						'maxnaps' => 'maxnaps',
						'hidegost' => 'hidegost',
						'naps_lang' => 'naps_lang',
						'reserv_place' => 'reserv_place',
						'parser' => 'parser',
						'nums1' => 'nums1',
						'nums2' => 'nums2',
						'naps_reserv' => 'direction_reserv',
						'show_file' => 'show_file',
						'xml_city' => 'xml_city',
						'xml_manual' => 'xml_manual',
						'xml_juridical' => 'xml_juridical',
						'xml_show1' => 'xml_show1',
						'xml_show2' => 'xml_show2',
						'not_ip' => 'not_ip',
						'not_country' => 'not_country',
						'only_country' => 'only_country',
					);
					foreach($modules_bds as $modules_bd_old => $modules_bd_new){
						$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."directions LIKE '{$modules_bd_new}'");
						if ($query == 1){
							$array[$modules_bd_new] = is_isset($data, $modules_bd_old);
						}	
					}						
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."directions", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."directions", $array, array('id'=> $id));	
					}				
				}
			}
		}

		if($step == '4_15'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."naps_meta");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."naps_meta LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();
					$array['item_id'] = $data->item_id;					
					$array['meta_key'] = $data->meta_key;
					$array['meta_value'] = $data->meta_value;
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions_meta WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."directions_meta", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."directions_meta", $array, array('id'=> $id));	
					}					
				}
			}
		}	

		if($step == '4_16'){	 /*****************/
			$currencies = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency WHERE auto_status = '1' LIMIT {$offset},{$limit}");
			$directions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions WHERE auto_status = '1'");
			foreach($currencies as $currency){
				$currency_id = $currency->id;
				foreach($directions as $direction){
					$direction_id = $direction->id;
					$cc = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."directions_order WHERE direction_id='$direction_id' AND c_id='$currency_id'");
					if($cc == 0){
						$arr = array(
							'direction_id' => $direction_id,
							'c_id' => $currency_id,
						);
						$wpdb->insert($wpdb->prefix.'directions_order', $arr);
					}
				}			
			}		
		}

		if($step == '4_17'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."custom_fields_valut");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."custom_fields_valut LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();
					$tech_name = pn_strip_input(is_isset($data,'tech_name'));
					if(!$tech_name){ $tech_name = pn_strip_input($data->cf_name); }
					
					$array['tech_name'] = $tech_name;					
					$array['cf_name'] = is_isset($data, 'cf_name');
					$array['vid'] = is_isset($data, 'vid');
					$array['currency_id'] = is_isset($data, 'valut_id');
					$array['cf_req'] = is_isset($data, 'cf_req');
					$array['place_id'] = is_isset($data, 'place_id');
					$array['minzn'] = is_isset($data, 'minzn');
					$array['maxzn'] = is_isset($data, 'maxzn');
					$array['firstzn'] = is_isset($data, 'firstzn');
					$array['uniqueid'] = is_isset($data, 'uniqueid');
					$array['helps'] = is_isset($data, 'helps');
					$array['datas'] = is_isset($data, 'datas');
					$array['status'] = is_isset($data, 'status');
					$array['cf_hidden'] = is_isset($data, 'cf_hidden');
					$array['cf_order'] = is_isset($data, 'cf_order');
					$array['cifrzn'] = 4;

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_custom_fields WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_custom_fields", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_custom_fields", $array, array('id'=> $id));	
					}			
				}
			}
		}

		if($step == '4_18'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."custom_fields");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."custom_fields LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();
					$tech_name = pn_strip_input(is_isset($data,'tech_name'));
					if(!$tech_name){ $tech_name = pn_strip_input($data->cf_name); }
					
					$array['tech_name'] = $tech_name;					
					$array['cf_name'] = is_isset($data, 'cf_name');
					$array['vid'] = is_isset($data, 'vid');
					$array['cf_auto'] = is_isset($data, 'cf_auto');
					$array['cf_req'] = is_isset($data, 'cf_req');
					$array['minzn'] = is_isset($data, 'minzn');
					$array['maxzn'] = is_isset($data, 'maxzn');
					$array['firstzn'] = is_isset($data, 'firstzn');
					$array['uniqueid'] = is_isset($data, 'uniqueid');
					$array['helps'] = is_isset($data, 'helps');
					$array['datas'] = is_isset($data, 'datas');
					$array['status'] = is_isset($data, 'status');
					$array['cf_hidden'] = is_isset($data, 'cf_hidden');
					$array['cf_order'] = is_isset($data, 'cf_order');
					$array['cifrzn'] = 4;

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."direction_custom_fields WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."direction_custom_fields", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."direction_custom_fields", $array, array('id'=> $id));	
					}			
				}
			}
		}

		if($step == '4_19'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."cf_naps");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."cf_naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();					
					$array['direction_id'] = $direction_id = is_isset($data, 'naps_id');
					$array['cf_id'] = is_isset($data, 'cf_id');
					$array['place_id'] = $place_id = is_isset($data, 'place_id');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."cf_directions WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."cf_directions", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."cf_directions", $array, array('id'=> $id));	
					}			
				}
			}
		}

		if($step == '4_20'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."user_accounts");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."user_accounts LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();

					$array['user_id'] = is_isset($data, 'user_id');
					$array['user_login'] = is_isset($data, 'user_login');
					$array['currency_id'] = is_isset($data, 'valut_id');
					$array['accountnum'] = is_isset($data, 'accountnum');
					$array['verify'] = is_isset($data, 'verify');
					$array['vidzn'] = is_isset($data, 'vidzn');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_wallets WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."user_wallets", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."user_wallets", $array, array('id'=> $id));	
					}			
				}
			}						
		}

		if($step == '4_21'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."uv_accounts");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."uv_accounts LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();

					$array['create_date'] = is_isset($data, 'createdate');
					$array['user_id'] = is_isset($data, 'user_id');
					$array['user_login'] = is_isset($data, 'user_login');
					$array['user_email'] = is_isset($data, 'user_email');
					$array['user_ip'] = is_isset($data, 'theip');
					$array['currency_id'] = is_isset($data, 'valut_id');
					$array['user_wallet_id'] = is_isset($data, 'usac_id');
					$array['wallet_num'] = is_isset($data, 'accountnum');
					$array['locale'] = is_isset($data, 'locale');
					$array['status'] = is_isset($data, 'status');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_wallets WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."uv_wallets", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."uv_wallets", $array, array('id'=> $id));	
					}			
				}
			}						
		}

		if($step == '4_22'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."uv_accounts_files");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."uv_accounts_files LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();

					$array['user_id'] = is_isset($data, 'user_id');
					$array['uv_data'] = is_isset($data, 'uv_data');
					$array['uv_wallet_id'] = is_isset($data, 'uv_id');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."uv_wallets_files WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."uv_wallets_files", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."uv_wallets_files", $array, array('id'=> $id));	
					}			
				}
			}						
		}	

		if($step == '4_23'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_vtypes");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bcbroker_vtypes LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();

					$array['currency_code_id'] = is_isset($data, 'vtype_id');
					$array['currency_code_title'] = is_isset($data, 'vtype_title');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_currency_codes WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."bcbroker_currency_codes", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."bcbroker_currency_codes", $array, array('id'=> $id));	
					}			
				}
			}						
		}

		if($step == '4_24'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bcbroker_naps");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bcbroker_naps LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$array = array();

					$direction_id = $data->naps_id;
					$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE id='$direction_id'");
					
					$array['direction_id'] = is_isset($data, 'naps_id');
					$array['currency_id_give'] = is_isset($direction, 'currency_id_give');
					$array['currency_id_get'] = is_isset($direction, 'currency_id_get');
					$array['status'] = is_isset($data, 'status');
					$array['v1'] = is_isset($data, 'v1');
					$array['v2'] = is_isset($data, 'v2');
					$array['now_sort'] = is_isset($data, 'now_sort');
					$array['name_column'] = is_isset($data, 'name_column');
					$array['pars_position'] = is_isset($data, 'pars_position');
					$array['min_res'] = is_isset($data, 'min_res');
					$array['step'] = is_isset($data, 'step');
					$array['reset_course'] = is_isset($data, 'reset_course');
					$array['standart_course_give'] = is_isset($data, 'cours1');
					$array['standart_course_get'] = is_isset($data, 'cours2');
					$array['min_sum'] = is_isset($data, 'min_sum');
					$array['max_sum'] = is_isset($data, 'max_sum');
					$array['standart_parser'] = is_isset($data, 'parser');
					$array['standart_parser_actions_give'] = is_isset($data, 'nums1');
					$array['standart_parser_actions_get'] = is_isset($data, 'nums2');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."bcbroker_directions WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."bcbroker_directions", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."bcbroker_directions", $array, array('id'=> $id));	
					}			
				}
			}						
		}

		if($step == '4_25'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bids");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bids LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;			
			
					$array = array();
					if(isset($data->domacc)){
						$domacc = is_isset($data,'domacc');
						if($domacc == 1){
							$arr['domacc1'] = '1';
						} else {
							$arr['domacc2'] = '1';
						}						
					} 
					$pay_sum = get_bids_meta($id,'pay_sum'); 
					if(isset($data->pay_sum)){
						$pay_sum = $data->pay_sum;
					}
					$array['pay_sum'] = $pay_sum;
					$pay_ac = get_bids_meta($id,'pay_ac'); 
					if(isset($data->pay_ac)){
						$pay_ac = $data->pay_ac;
					}
					$array['pay_ac'] = $pay_ac;					
					$array['create_date'] = is_isset($data,'createdate');
					$array['edit_date'] = is_isset($data,'editdate');
					$array['direction_id'] = is_isset($data,'naps_id');
					$array['course_give'] = is_isset($data,'curs1');
					$array['course_get'] = is_isset($data,'curs2');
					$array['account_give'] = is_isset($data,'account1');
					$array['account_get'] = is_isset($data,'account2');
					$array['metas'] = is_isset($data,'metas');
					$array['dmetas'] = is_isset($data,'dmetas');
					$array['unmetas'] = is_isset($data,'unmetas');
					$status = is_isset($data,'status');
					if($status == 'my'){
						$status = 'my'. is_isset($data,'mystatus');
					}
					$array['status'] = $status;
					$array['bid_locale'] = is_isset($data,'bid_locale');
					$array['check_purse1'] = is_isset($data,'check_purse1');
					$array['check_purse2'] = is_isset($data,'check_purse2');
					$array['psys_give'] = is_isset($data,'valut1');
					$array['psys_get'] = is_isset($data,'valut2');
					$array['currency_id_give'] = is_isset($data,'valut1i');
					$array['currency_id_get'] = is_isset($data,'valut2i');
					$array['currency_code_give'] = is_isset($data,'vtype1');
					$array['currency_code_get'] = is_isset($data,'vtype2');
					$array['currency_code_id_give'] = is_isset($data,'vtype1i');
					$array['currency_code_id_get'] = is_isset($data,'vtype2i');
					$array['psys_id_give'] = is_isset($data,'psys1i');
					$array['psys_id_get'] = is_isset($data,'psys2i');
					$array['user_discount'] = is_isset($data,'user_sk');
					$array['user_discount_sum'] = is_isset($data,'user_sksumm');
					$array['sum1'] = is_isset($data,'summ1');
					$array['dop_com1'] = is_isset($data,'dop_com1');
					$array['sum1dc'] = is_isset($data,'summ1_dc');
					$array['com_ps1'] = is_isset($data,'com_ps1');
					$array['com_ps2'] = is_isset($data,'com_ps2');									
					$array['sum1c'] = is_isset($data,'summ1c');
					$array['sum1r'] = is_isset($data,'summ1cr');
					$array['sum2t'] = is_isset($data,'summ2t');
					$array['sum2'] = is_isset($data,'summ2');
					$array['dop_com2'] = is_isset($data,'dop_com2');
					$array['sum2dc'] = is_isset($data,'summ2_dc');
					$array['sum2r'] = is_isset($data,'summ2cr');
					$array['sum2c'] = is_isset($data,'summ2c');
					$array['exsum'] = is_isset($data,'exsum');
					$array['profit'] = is_isset($data,'profit');
					$array['hashed'] = is_isset($data,'hashed');
					$array['m_in'] = is_isset($data,'m_in');
					$array['m_out'] = is_isset($data,'m_out');
					$array['user_passport'] = is_isset($data,'user_passport');
					$array['user_email'] = is_isset($data,'user_email');
					$array['user_skype'] = is_isset($data,'user_skype');
					$array['user_phone'] = is_isset($data,'user_phone');
					$array['second_name'] = is_isset($data,'second_name');
					$array['last_name'] = is_isset($data,'last_name');
					$array['first_name'] = is_isset($data,'first_name');
					$array['user_ip'] = is_isset($data,'user_ip');
					$array['user_id'] = is_isset($data,'user_id');
					$array['user_hash'] = is_isset($data,'user_hash');
					$array['trans_in'] = is_isset($data,'trans_in');
					$array['trans_out'] = is_isset($data,'trans_out');
					$array['to_account'] = is_isset($data,'naschet');
					$array['from_account'] = is_isset($data,'soschet');
					$array['exceed_pay'] = is_isset($data,'exceed_pay');
					$array['touap_date'] = is_isset($data,'touap_date');
					
					$modules_bds = array(
						'device' => 'device',
						'new_user' => 'new_user',
						'user_country' => 'user_country',
						'napsidenty' => 'identy',
						'sumbonus' => 'sumbonus',
						'ref_id' => 'ref_id',
						'pcalc' => 'pcalc',
						'summp' => 'partner_sum',
						'partpr' => 'partner_pers',
						'domacc1' => 'domacc1',
						'domacc2' => 'domacc2',
						'recalcdate' => 'recalc_date',
						'btc_code' => 'btc_code',
						'btc_code_info' => 'btc_code_info',
					);
					foreach($modules_bds as $modules_bd_old => $modules_bd_new){
						$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."exchange_bids LIKE '{$modules_bd_new}'");
						if ($query == 1){
							$array[$modules_bd_new] = is_isset($data, $modules_bd_old);
						}	
					}						
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."exchange_bids", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."exchange_bids", $array, array('id'=> $id));	
					}				
				}
			}
		}

		if($step == '4_26'){ /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."exchange_bids");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."exchange_bids LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					bid_hashdata($id, $data, '');
				}
			}						
		}

		if($step == '4_27'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."payoutuser");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."payoutuser LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['pay_date'] = is_isset($data,'pay_date');
					$array['user_id'] = is_isset($data,'user_id');
					$array['user_login'] = is_isset($data,'user_login');
					$array['pay_sum'] = is_isset($data,'pay_sum');
					$array['pay_sum_or'] = is_isset($data,'pay_sum_or');
					$array['currency_id'] = is_isset($data,'valut_id');
					$array['psys_title'] = is_isset($data,'psys_title');
					$array['pay_account'] = is_isset($data,'pay_account');
					$array['status'] = is_isset($data,'status');
					$array['comment'] = is_isset($data,'comment');
					$array['currency_code_id'] = is_isset($data,'vtype_id');
					$array['currency_code_title'] = is_isset($data,'vtype_title');					

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."user_payouts WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."user_payouts", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."user_payouts", $array, array('id'=> $id));	
					}					
				}
			}
		}

		if($step == '4_28'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."valuts_fstats");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."valuts_fstats LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['currency_id'] = is_isset($data,'valut_id');
					$array['com_sum'] = is_isset($data,'com_summ');
					$array['com_pers'] = is_isset($data,'com_pers');
					$array['nscom'] = is_isset($data,'nscom');
					$array['minsumcom'] = is_isset($data,'minsummcom');
					$array['maxsumcom'] = is_isset($data,'maxsummcom');					
										
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_fstats WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_fstats", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_fstats", $array, array('id'=> $id));	
					}					
				}
			}
		}

		if($step == '4_29'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."vtypes_fstats");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."vtypes_fstats LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['currency_code_id'] = is_isset($data,'vtype_id');	
					$array['internal_rate'] = is_isset($data,'vncurs');	
					$array['parser'] = is_isset($data,'parser');	
					$array['parser_actions'] = is_isset($data,'nums');						
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_codes_fstats WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."currency_codes_fstats", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."currency_codes_fstats", $array, array('id'=> $id));	
					}										
				}
			}
		}

		if($step == '4_30'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."bids_fstats");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."bids_fstats LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['bid_id'] = is_isset($data,'bid_id');
					$array['status_date'] = is_isset($data,'statusdate');
					$array['direction_id'] = is_isset($data,'naps_id');
					$array['currency_give'] = is_isset($data,'valut1');
					$array['currency_get'] = is_isset($data,'valut2');
					$array['account_give'] = is_isset($data,'account1');
					$array['account_get'] = is_isset($data,'account2');
					$array['user_phone'] = is_isset($data,'user_phone');
					$array['user_fio'] = is_isset($data,'user_fio');
					$array['user_email'] = is_isset($data,'user_email');
					$array['partner_sum'] = is_isset($data,'partner_sum');
					$array['sum1or'] = is_isset($data,'sum1or');
					$array['sum2or'] = is_isset($data,'sum2or');
					$array['cours1'] = is_isset($data,'cours1');
					$array['cours2'] = is_isset($data,'cours2');
					$array['comis_or'] = is_isset($data,'comis_or');
					$array['profit_sum'] = is_isset($data,'profit_sum');
					$array['pcours1'] = is_isset($data,'pcours1');
					$array['pcours2'] = is_isset($data,'pcours2');
					$array['status'] = is_isset($data,'status');

					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."exchange_bids_fstats WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."exchange_bids_fstats", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."exchange_bids_fstats", $array, array('id'=> $id));	
					}
				}
			}
		}

		if($step == '4_31'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."userverify");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."userverify LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['create_date'] = is_isset($data,'createdate');
					$array['user_id'] = is_isset($data,'user_id');
					$array['user_login'] = is_isset($data,'user_login');
					$array['user_email'] = is_isset($data,'user_email');
					$array['user_ip'] = is_isset($data,'theip');
					$array['comment'] = is_isset($data,'comment');
					$array['locale'] = is_isset($data,'locale');
					$array['status'] = is_isset($data,'status');
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."verify_bids WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."verify_bids", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."verify_bids", $array, array('id'=> $id));	
					}										
				}
			}
		}

		if($step == '4_32'){	 /*****************/ 
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."archive_bids");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."archive_bids LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					$arch = @unserialize($data->archive_content);
					
					$array = array();
					$array['archive_date'] = is_isset($data,'archive_date');
					$array['create_date'] = is_isset($data,'createdate');
					$array['edit_date'] = is_isset($data,'editdate');
					$array['bid_id'] = is_isset($data,'bid_id');
					$array['user_id'] = is_isset($data,'user_id');
					$array['ref_id'] = is_isset($data,'ref_id');
					$array['archive_content'] = is_isset($data,'archive_content');
					$array['account_give'] = is_isset($data,'account1');
					$array['account_get'] = is_isset($data,'account2');
					$array['first_name'] = is_isset($data,'first_name');
					$array['last_name'] = is_isset($data,'last_name');
					$array['second_name'] = is_isset($data,'second_name');
					$array['user_phone'] = is_isset($data,'user_phone');
					$array['user_skype'] = is_isset($data,'user_skype');
					$array['user_email'] = is_isset($data,'user_email');
					$array['user_passport'] = is_isset($data,'user_passport');
					$array['psys_give'] = is_isset($data,'valut1');
					$array['psys_get'] = is_isset($data,'valut2');
					$array['currency_id_give'] = is_isset($data,'valut1i');
					$array['currency_id_get'] = is_isset($data,'valut2i');
					$array['status'] = is_isset($data,'status');
					$array['direction_id'] = is_isset($arch,'naps_id');
					$array['course_give'] = is_isset($arch,'curs1');
					$array['course_get'] = is_isset($arch,'curs2');
					$array['user_ip'] = is_isset($arch,'user_ip');
					$array['currency_code_give'] = is_isset($arch,'vtype1');
					$array['currency_code_get'] = is_isset($arch,'vtype2');
					$array['currency_code_id_give'] = is_isset($arch,'vtype1i');
					$array['currency_code_id_get'] = is_isset($arch,'vtype2i');
					$array['psys_id_give'] = is_isset($arch,'psys1i');
					$array['psys_id_get'] = is_isset($arch,'psys2i');
					$array['user_discount'] = is_isset($arch,'user_sk');
					$array['user_discount_sum'] = is_isset($arch,'user_sksumm');					
					$array['profit'] = is_isset($arch,'profit');
					$array['exsum'] = is_isset($arch,'exsum');
					$array['pay_ac'] = is_isset($arch,'pay_ac');
					$array['pay_sum'] = is_isset($arch,'pay_sum');
					$array['trans_in'] = is_isset($arch,'trans_in');
					$array['trans_out'] = is_isset($arch,'trans_out');
					$array['to_account'] = is_isset($arch,'naschet');
					$array['from_account'] = is_isset($arch,'soschet');	
					$array['sum1'] = is_isset($arch,'summ1');
					$array['dop_com1'] = is_isset($arch,'dop_com1');
					$array['sum1dc'] = is_isset($arch,'summ1_dc');
					$array['com_ps1'] = is_isset($arch,'com_ps1');
					$array['com_ps2'] = is_isset($arch,'com_ps2');									
					$array['sum1c'] = is_isset($arch,'summ1c');
					$array['sum1r'] = is_isset($arch,'summ1cr');
					$array['sum2t'] = is_isset($arch,'summ2t');
					$array['sum2'] = is_isset($arch,'summ2');
					$array['dop_com2'] = is_isset($arch,'dop_com2');
					$array['sum2dc'] = is_isset($arch,'summ2_dc');
					$array['sum2r'] = is_isset($arch,'summ2cr');
					$array['sum2c'] = is_isset($arch,'summ2c');										
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."archive_exchange_bids WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."archive_exchange_bids", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."archive_exchange_bids", $array, array('id'=> $id));	
					}										
				}
			}						
		}

		if($step == '4_33'){	 /*****************/ 
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."archive_exchange_bids");
			if($query == 1){
				if($offset == 0){
					$wpdb->query("DELETE FROM ". $wpdb->prefix ."archive_data WHERE meta_key != 'plinks'"); 
				}
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."archive_exchange_bids ORDER BY id ASC LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					
					$status = $data->status;
					$id = $data->bid_id;	
					$user_id = $data->user_id;
					$arch = @unserialize($data->archive_content);
					
					$currency_code_id_give = is_isset($data, 'currency_code_id_give');
					$currency_code_id_get = is_isset($data, 'currency_code_id_get');
					$currency_id_give = is_isset($data, 'currency_id_give');					
					$currency_id_get = is_isset($data, 'currency_id_get');					

					$sum1c = is_isset($arch, 'summ1c');
					if(isset($arch['sum1c'])){
						$sum1c = $arch['sum1c'];
					}

					$sum2c = is_isset($arch, 'summ2c');
					if(isset($arch['sum2c'])){
						$sum2c = $arch['sum2c'];
					}					

					$partner_sum = is_isset($arch, 'summp');
					if(isset($arch['partner_sum'])){
						$partner_sum = $arch['partner_sum'];
					}

					$sum1r = is_isset($arch, 'summ1cr');
					if(isset($arch['sum1r'])){
						$sum1r = $arch['sum1r'];
					}

					$sum2r = is_isset($arch, 'summ2cr');
					if(isset($arch['sum2r'])){
						$sum2r = $arch['sum2r'];
					}
					
					$pcalc = intval(is_isset($arch, 'pcalc'));
					$domacc = intval(is_isset($arch, 'domacc'));
					$domacc1 = intval(is_isset($arch, 'domacc1'));
					$domacc2 = intval(is_isset($arch, 'domacc2'));
			
					if($status == 'success'){
						if($user_id > 0){
							set_archive_data($user_id, 'user_exsum', '', '', is_sum($arch['exsum'], 20));	
						}
						if($pcalc == 1){
							set_archive_data($arch['ref_id'], 'pbids', '', '', 1);
							set_archive_data($arch['ref_id'], 'pbids_sum', '', '', is_sum($partner_sum, 20));
							set_archive_data($arch['ref_id'], 'pbids_exsum', '', '', is_sum($arch['exsum'], 20));
						}
					}
					
					set_archive_data($currency_code_id_give, 'currency_code_give', $status, '', is_sum($sum1r, 20));
					set_archive_data($currency_code_id_get, 'currency_code_get', $status, '', is_sum($sum2r, 20));
					set_archive_data($currency_id_give, 'currency_give', $status, '', is_sum($sum1r, 20));
					set_archive_data($currency_id_get, 'currency_get', $status, '', is_sum($sum2r, 20));
					set_archive_data($data->direction_id, 'direction_give', $status, '', is_sum($sum1r, 20));
					set_archive_data($data->direction_id, 'direction_get', $status, '', is_sum($sum2r, 20));
					
					if($user_id > 0){
						set_archive_data($user_id, 'user_bids', $status, '', 1);
						
						if($domacc == 1 or $domacc1 == 1){
							set_archive_data($user_id, 'domacc1_currency_code', $status, $currency_code_id_give, is_sum($sum1c, 20));
						}
						if($domacc == 2 or $domacc2 == 1){
							set_archive_data($user_id, 'domacc2_currency_code', $status, $currency_code_id_get, is_sum($sum2c, 20));
						}				
					}
					
				}
			}				
		}

		if($step == '4_34'){	 /*****************/
			$prefix = $wpdb->prefix;
			$wp_user_roles = get_option($prefix . 'user_roles');
			if(isset($wp_user_roles['meneger']) and $wp_user_roles['meneger']['name'] == 'meneger'){
				$wp_user_roles['meneger']['name'] = __('Operator','pn');
			}
			if(isset($wp_user_roles['topmeneger']) and $wp_user_roles['topmeneger']['name'] == 'topmeneger'){
				$wp_user_roles['topmeneger']['name'] = __('Manager','pn');
			}
			if(isset($wp_user_roles['user']) and $wp_user_roles['user']['name'] == 'user'){
				$wp_user_roles['user']['name'] = __('User','pn');
			}			
			update_option($prefix.'user_roles', $wp_user_roles);
		}
		
		if($step == '4_35'){	 /*****************/
			$result = get_curl_parser('https://premiumexchanger.com/migrate/step35.xml', array(), 'migration');
			if(!$result['err']){
				$out = $result['output'];
				if(is_string($out)){
					if(strstr($out, '<?xml')){
						$res = @simplexml_load_string($out);
						if(is_object($res)){
							foreach($res->item as $item){
								$arr = (array)$item;
								if(isset($arr['id'])){
									unset($arr['id']);
								}
								
								$wpdb->insert($wpdb->prefix . 'parser_pairs', $arr);
							}
						}
					}
				}
			}
		}

		if($step == '4_36'){	 /*****************/
			$indexes = $wpdb->query("SHOW INDEX FROM ".$wpdb->prefix ."currency_meta");
			if($indexes > 1){
				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency_meta LIKE 'meta_value'");
				if ($query == 1){
					$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency_meta DROP INDEX `meta_value`");
					$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency_meta CHANGE  `meta_value` `meta_value` LONGTEXT NOT NULL");
				}

				$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."currency_meta LIKE 'meta_key'");
				if ($query == 1){
					$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency_meta DROP INDEX `meta_key`");
					$wpdb->query("ALTER TABLE ".$wpdb->prefix ."currency_meta CHANGE  `meta_key` `meta_key` LONGTEXT NOT NULL");
				}
			}
		}		
		
		if($step == '5_1'){	 /*****************/
			$tables = array(
				'login_check', 'admin_captcha_plus', 'admin_captcha', 'standart_captcha_plus','user_accounts','uv_wallets_files',
				'standart_captcha','warning_mess','head_mess', 'operator_schedules','vtypes','valuts_meta','trans_reserv',
				'custom_fields_valut','naps_meta','naps_order','change','term_meta','cf_naps','custom_fields','userverify',
				'payoutuser','bcbroker_vtypes','bcbroker_naps','masschange','valuts_fstats','vtypes_fstats','bids_fstats',
			);
			foreach($tables as $tbl){
				$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix . $tbl);
				if($query == 1){
					$wpdb->query("DROP TABLE ". $wpdb->prefix . $tbl);
				}	
			}
		}
		
		if($step == '5_2'){	 /*****************/
			$premiumbox->update_option('usve', 'wallet_new_account', 1);
			$premiumbox->update_option('usve', 'delete_verify_wallets', 1);
			$premiumbox->update_option('archivebids', 'limit_archive', 5);
		}
		
		if($step == '5_3'){	 /*****************/
			$query = $wpdb->query("CHECK TABLE ". $wpdb->prefix ."autodel_bids_time");
			if($query == 1){
				$datas = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."autodel_bids_time LIMIT {$offset},{$limit}");
				foreach($datas as $data){
					$id = $data->id;
					
					$array = array();
					$array['direction_id'] = is_isset($data, 'naps_id');
					$array['enable_autodel'] = is_isset($data, 'enable_autodel');
					$array['cou_hour'] = is_isset($data, 'cou_hour');
					$array['cou_minute'] = is_isset($data, 'cou_minute');
					$array['statused'] = is_isset($data, 'statused');
					
					$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."auto_removal_bids WHERE id='$id'");
					if($cc_count == 0){
						$array['id'] = $id;
						$wpdb->insert($wpdb->prefix ."auto_removal_bids", $array);	
					} else {
						$wpdb->update($wpdb->prefix ."auto_removal_bids", $array, array('id'=> $id));	
					}										
					
				}
			}
		}		
		
		$log['status'] = 'success';	
		$log['status_text'] = __('Ok!','pn');		
		
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! Insufficient privileges','pn');
	}
	
	echo json_encode($log);
	exit;	
}