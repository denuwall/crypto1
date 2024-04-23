<?php
if( !defined( 'ABSPATH')){ exit(); }

add_filter('account_list_pages','account_list_pages_pp',99);
function account_list_pages_pp($account_list_pages){
global $premiumbox;
	
	$pages = $premiumbox->get_option('partners','pages');
	if(!is_array($pages)){ $pages = array(); }
	
	foreach($pages as $page){
		$account_list_pages[$page] = array('type' => 'page');
	}
	
	return $account_list_pages;
}

add_filter('banner_pages', 'def_banner_pages');
function def_banner_pages($banner_pages){
global $premiumbox;
	
	$text_banners = intval($premiumbox->get_option('partners','text_banners'));
	if(!$text_banners){
		if(isset($banner_pages['text'])){
			unset($banner_pages['text']);
		}
	}
	
	return $banner_pages;
}

add_filter('pp_banners','def_pp_banners');
function def_pp_banners($banners){
	
	$banners = array(
		'text'=> __('Text materials','pn'),
		'banner1'=> sprintf(__('Banners %s','pn'),'(468 x 60)'),
		'banner2'=> sprintf(__('Banners %s','pn'),'(200 x 200)'),
		'banner3'=> sprintf(__('Banners %s','pn'),'(120 x 600)'),
		'banner4'=> sprintf(__('Banners %s','pn'),'(100 x 100)'),
		'banner5'=> sprintf(__('Banners %s','pn'),'(88 x 31)'),
		'banner6'=> sprintf(__('Banners %s','pn'),'(336 x 280)'),
		'banner7'=> sprintf(__('Banners %s','pn'),'(250 x 250)'),
		'banner8'=> sprintf(__('Banners %s','pn'),'(240 x 400)'),
		'banner9'=> sprintf(__('Banners %s','pn'),'(234 x 60)'),
		'banner10'=> sprintf(__('Banners %s','pn'),'(120 x 90)'),
		'banner11'=> sprintf(__('Banners %s','pn'),'(120 x 60)'),
		'banner12'=> sprintf(__('Banners %s','pn'),'(120 x 240)'),
		'banner13'=> sprintf(__('Banners %s','pn'),'(125 x 125)'),
		'banner14'=> sprintf(__('Banners %s','pn'),'(300 x 600)'),
		'banner15'=> sprintf(__('Banners %s','pn'),'(300 x 250)'),
		'banner16'=> sprintf(__('Banners %s','pn'),'(80 x 150)'),
		'banner17'=> sprintf(__('Banners %s','pn'),'(728 x 90)'),
		'banner18'=> sprintf(__('Banners %s','pn'),'(160 x 600)'),
		'banner19'=> sprintf(__('Banners %s','pn'),'(80 x 15)'),
	);	
	
	return $banners;
}

add_filter('list_icon_indicators', 'pp_user_payouts_icon_indicators');
function pp_user_payouts_icon_indicators($lists){
	$lists['pp_user_payouts'] = __('Requests for payouts','pn');
	return $lists;
}

add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_payouts');
function wp_before_admin_bar_render_payouts() {
global $wp_admin_bar, $wpdb, $premiumbox;
	
    if(current_user_can('administrator') or current_user_can('pn_pp')){
		if(get_icon_indicators('pp_user_payouts')){
			$count = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."user_payouts WHERE status = '0'");
			if($count > 0){
				$wp_admin_bar->add_menu( array(
					'id'     => 'new_payoutuser',
					'href' => admin_url('admin.php?page=pn_payouts&mod=1'),
					'title'  => '<div style="height: 32px; width: 22px; background: url('. $premiumbox->plugin_url .'images/newpayout.png) no-repeat center center"></div>',
					'meta' => array( 'title' => sprintf(__('Requests for payouts (%s)','pn'), $count) ) 		
				));	
			}
		}
	}
}

add_filter('pn_currency_addform','pn_currency_addform_pp', 10, 2);
function pn_currency_addform_pp($options, $data){
		
	$options['line_pvivod'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['p_payout'] = array(
		'view' => 'select',
		'title' => __('Allow affiliate money withdrawal','pn'),
		'options' => array('1'=>__('Yes','pn'),'0'=>__('No','pn')),
		'default' => is_isset($data, 'p_payout'),
		'name' => 'p_payout',
	);
	$options['payout_com'] = array(
		'view' => 'input',
		'title' => __('Fee of payment system for payout of funds to partner','pn'),
		'default' => is_isset($data, 'payout_com'),
		'name' => 'payout_com',
	);		
	
	return $options;
}

add_filter('pn_currency_addform_post', 'pn_currency_addform_post_pp');
function pn_currency_addform_post_pp($array){
	
	$array['p_payout'] = intval(is_param_post('p_payout'));
	$array['payout_com'] = is_sum(is_param_post('payout_com'));
	
	return $array;
}

add_filter('update_currency_reserv', 'update_currency_reserv_pp', 10, 2);
function update_currency_reserv_pp($currency_reserv, $currency_id){
global $wpdb, $premiumbox;	
	
	$reserv = $premiumbox->get_option('partners','reserv');
	if(!is_array($reserv)){ $reserv = array(); }

	$status = array();
	foreach($reserv as $st){
		$st = pn_strip_input($st);
		$status[] = "'". $st ."'";
	}
	if(count($status) > 0){
		$st = join(',',$status);
		$sum = $wpdb->get_var("SELECT SUM(pay_sum) FROM ".$wpdb->prefix."user_payouts WHERE currency_id='$currency_id' AND status IN($st)");
		$currency_reserv = is_sum($currency_reserv - $sum);
	} 	
	
	return $currency_reserv;
}

add_action('myaction_request_affiliate', 'myaction_request_affiliate_pp');
function myaction_request_affiliate_pp(){
global $premiumbox;
	
	$ref = 'register+cookie';
	if(intval($premiumbox->get_option('partners','wref')) == 1){
		$ref = 'cookie';
	}

	$log = array(
		'status' => 'enable',
		'ref' => $ref,
	);
	
	echo json_encode($log);
	exit;	
}

add_action('change_bidstatus_all', 'change_bidstatus_all_pp',1,3);
function change_bidstatus_all_pp($status, $item_id, $item){
global $wpdb, $premiumbox;

	$not = array('realdelete','autodelete','auto','archived');
	if(!in_array($status, $not)){
		if($status == 'success'){
			$calc = intval($premiumbox->get_option('partners','calc'));
			if($calc == 0 or $calc == 1 and $item->user_id > 0){
				$ref_id = $item->ref_id;
				$partner_sum = is_sum($item->partner_sum);
				if($ref_id and $partner_sum > 0){
					$rd = get_userdata($ref_id);
					$ctype = cur_type();
					
					if(isset($rd->user_email)){
						$ref_email = is_email($rd->user_email);
						$wpdb->update($wpdb->prefix.'exchange_bids', array('pcalc'=> 1), array('id'=>$item_id));
				
						$notify_tags = array();
						$notify_tags['[sitename]'] = pn_strip_input(get_bloginfo('sitename'));
						$notify_tags['[sum]'] = $partner_sum;
						$notify_tags['[ctype]'] = $ctype;
						$notify_tags = apply_filters('notify_tags_partprofit', $notify_tags);		

						$user_send_data = array(
							'user_email' => $ref_email,
							'user_phone' => '',
						);	
						$result_mail = apply_filters('premium_send_message', 0, 'partprofit', $notify_tags, $user_send_data);						
					}
				}
			}
		} else {
			$wpdb->update($wpdb->prefix.'exchange_bids', array('pcalc'=> 0), array('id'=>$item_id));
		}
	}
}

add_filter('list_tabs_direction','list_tabs_direction_pp');
function list_tabs_direction_pp($list_tabs){
	$list_tabs['tab100'] = __('Affiliate program','pn');
	return $list_tabs;
}

add_action('tab_direction_tab100','tab_direction_tab_pp',99,2);
function tab_direction_tab_pp($data, $data_id){
?>	
	<tr>
		<th><?php _e('Affiliate payments','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php 
					$p_enable = get_direction_meta($data_id, 'p_enable');
					if(!is_numeric($p_enable)){ $p_enable = 1; } 
				?>									
				<select name="p_enable" autocomplete="off"> 
					<option value="0" <?php selected($p_enable,0); ?>><?php _e('not to pay','pn'); ?></option>
					<option value="1" <?php selected($p_enable,1); ?>><?php _e('pay','pn'); ?></option>
				</select>
			</div>
		</td>
		<td>			
		</td>
	</tr>
	<tr>
		<th><?php _e('Fixed amount of payment for benefit of partner','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="p_ind_sum" style="width: 100px;" value="<?php echo is_sum(get_direction_meta($data_id, 'p_ind_sum')); ?>" /><?php echo cur_type(); ?>
			</div>
		</td>
		<td>			
		</td>
	</tr>	
	<tr>
		<th><?php _e('Min. amount of payment for benefit of partner','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="p_min_sum" style="width: 100px;" value="<?php echo is_sum(get_direction_meta($data_id, 'p_min_sum')); ?>" /><?php echo cur_type(); ?>
			</div>
		</td>
		<td>			
		</td>
	</tr>	
	<tr>
		<th><?php _e('Max. amount of payment for benefit of partner','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="p_max_sum" style="width: 100px;" value="<?php echo is_sum(get_direction_meta($data_id, 'p_max_sum')); ?>" /><?php echo cur_type(); ?>
			</div>
		</td>
		<td>			
		</td>
	</tr>	
	<tr>
		<th><?php _e('Individual percent given by an affiliate program','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="p_pers" style="width: 100px;" value="<?php echo is_sum(get_direction_meta($data_id, 'p_pers')); ?>" />%
			</div>
		</td>
		<td>			
		</td>
	</tr>	
	<tr>
		<th><?php _e('Maximum percent given by an affiliate program','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<input type="text" name="p_max" style="width: 100px;" value="<?php echo is_sum(get_direction_meta($data_id, 'p_max')); ?>" />%
			</div>
		</td>
		<td>			
		</td>
	</tr>	
<?php
}
 
add_action('pn_direction_edit','pn_direction_edit_pp');
add_action('pn_direction_add','pn_direction_edit_pp');
function pn_direction_edit_pp($data_id){
	
	$p_enable = intval(is_param_post('p_enable'));
	update_direction_meta($data_id, 'p_enable', $p_enable);
	
	$p_pers = is_sum(is_param_post('p_pers'));
	update_direction_meta($data_id, 'p_pers', $p_pers);	
	
	$p_max = is_sum(is_param_post('p_max'));
	update_direction_meta($data_id, 'p_max', $p_max);

	$p_ind_sum = is_sum(is_param_post('p_ind_sum'));
	update_direction_meta($data_id, 'p_ind_sum', $p_ind_sum);

	$p_min_sum = is_sum(is_param_post('p_min_sum'));
	update_direction_meta($data_id, 'p_min_sum', $p_min_sum);
	
	$p_max_sum = is_sum(is_param_post('p_max_sum'));
	update_direction_meta($data_id, 'p_max_sum', $p_max_sum);
	
} 

add_filter('get_calc_data', 'pp_get_calc_data', 2000, 2);
function pp_get_calc_data($cdata, $calc_data){
global $premiumbox, $wpdb;
	
	$ref_id = 0;
	$partner_pers = 0;
	$partner_sum = 0;
	
	$user_id = is_isset($calc_data,'user_id');	
	$direction = $calc_data['direction'];
	$dej = intval(is_isset($calc_data,'dej'));
	
	$direction_id = $direction->id;
	
	if($dej == 1){
		$p_enable = 0;
		if(isset($direction->p_enable)){
			$p_enable = intval(is_isset($direction,'p_enable'));
		} else {
			$p_enable = intval(get_direction_meta($direction_id, 'p_enable'));
		}		
		
		if($p_enable == 1){
				
			$ref_id = 0;
			if(intval($premiumbox->get_option('partners','wref')) == 0 and $user_id){
				$ui = get_userdata($user_id);
				if(isset($ui->ref_id)){
					$ref_id = $ui->ref_id;
				}	
			}
			
			if(!$ref_id){
				$ref_id = intval(get_pn_cookie('ref_id')); 
			}			
				
			$profit = is_sum($cdata['profit']);	
			$user_discount = is_sum($cdata['user_discount']);
			if($ref_id and $ref_id != $user_id){
				$ref_cou = $wpdb->get_var("SELECT COUNT(ID) FROM ". $wpdb->prefix ."users WHERE ID='$ref_id'");
				if($ref_cou > 0){
					$p_ind_sum = 0;
					if(isset($direction->p_ind_sum)){
						$p_ind_sum = is_sum(is_isset($direction,'p_ind_sum'));
					} else {
						$p_ind_sum = is_sum(get_direction_meta($direction_id, 'p_ind_sum'));
					}	
					if($p_ind_sum > 0){
						$partner_sum = $p_ind_sum;
					} elseif($profit > 0) {
						$p_pers = 0;
						if(isset($direction->p_pers)){
							$p_pers = is_sum(is_isset($direction,'p_pers'), 2);
						} else {
							$p_pers = is_sum(get_direction_meta($direction_id, 'p_pers'));
						}						
						if($p_pers > 0){
							$partner_pers = $p_pers;
						} else {
							$partner_pers = get_user_pers_refobmen($ref_id);
							$p_max = 0;
							if(isset($direction->p_max)){
								$p_max = is_sum(is_isset($direction,'p_max'));
							} else {
								$p_max = is_sum(get_direction_meta($direction_id, 'p_max'));
							}							
							if($p_max > 0 and $partner_pers > $p_max){ $partner_pers = $p_max; }
						}	
						if($partner_pers > 0){
							$partner_sum = $profit / 100 * $partner_pers;
							$partner_sum = is_sum($partner_sum, 2);
						}						
					}				
					if($premiumbox->get_option('partners','uskidka') == 1 and $user_discount > 0 and $partner_sum > 0){
						$one_pers = $partner_sum / 100;
						$partner_sum = $partner_sum - ($one_pers * $user_discount);
					}
					$p_min_sum = 0;
					if(isset($direction->p_min_sum)){
						$p_min_sum = is_sum(is_isset($direction,'p_min_sum'));
					} else {
						$p_min_sum = is_sum(get_direction_meta($direction_id, 'p_min_sum'));
					}
					$p_max_sum = 0;
					if(isset($direction->p_max_sum)){
						$p_max_sum = is_sum(is_isset($direction,'p_max_sum'));
					} else {
						$p_max_sum = is_sum(get_direction_meta($direction_id, 'p_max_sum'));
					}					
					if($partner_sum < $p_min_sum){ $partner_sum = $p_min_sum; }
					if($p_max_sum > 0 and $partner_sum > $p_max_sum){ $partner_sum = $p_max_sum; }
				} else {
					$ref_id = 0;
				}
			}  
		}
	}
	
	$cdata['ref_id'] = $ref_id;
	$cdata['partner_sum'] = $partner_sum;
	$cdata['partner_pers'] = $partner_pers;

	return $cdata;
}

add_filter('array_data_create_bids', 'pp_array_data_create_bids', 10, 5);
add_filter('array_data_recalculate_bids', 'pp_array_data_create_bids', 10, 5);
function pp_array_data_create_bids($array, $direction, $vd1, $vd2, $cdata){
global $wpdb, $premiumbox;	
	
	$array['ref_id'] = $cdata['ref_id'];
	$array['partner_sum'] = $cdata['partner_sum'];
	$array['partner_pers'] = $cdata['partner_pers'];	
	
	return $array;
}

add_filter('change_bids_filter_list', 'pp_change_bids_filter_list'); 
function pp_change_bids_filter_list($lists){
global $wpdb;
	
	$lists['user']['ref_id'] = array(
		'title' => __('Partner ID','pn'),
		'name' => 'ref_id',
		'view' => 'input',
		'work' => 'input',
	);		
	
	return $lists;
}

add_filter('where_request_sql_bids', 'pp_where_request_sql_bids', 10,2);
function pp_where_request_sql_bids($where, $pars_data){
global $wpdb;	
	
	$pr = $wpdb->prefix;
	$ref_id = intval(is_isset($pars_data,'ref_id'));
	if($ref_id > 0){
		$where = " AND {$pr}exchange_bids.ref_id='$ref_id'";
	}	
	
	return $where;
}

add_filter('onebid_hidecol1', 'pp_onebid_hidecol1', 10, 4);
function pp_onebid_hidecol1($cols, $item, $data_fs, $v){
	
	$cols['referal'] = array(
		'type' => 'text',
		'title' => __('Referal','pn'),
		'label' => '[referal]',
	);
	$cols['partner_sum'] = array(
		'type' => 'text',
		'title' => __('Partner earned','pn'),
		'label' => '[partner_sum] USD',
	);
	$cols['partner_pers'] = array(
		'type' => 'text',
		'title' => __('Partner percent','pn'),
		'label' => '[partner_pers] %',
	);		
	
	return $cols;
}

add_filter('get_bids_replace_text', 'pp_get_bids_replace_text', 10, 4);
function pp_get_bids_replace_text($text, $item, $data_fs, $v){
	
	if(strstr($text, '[referal]')){
		if(isset($item->ref_id)){
			$rui = get_userdata($item->ref_id);
			$ref_login = is_isset($rui, 'user_login');
		} else {
			$ref_login = '---';
		}		
		
		$text = str_replace('[referal]', '<span class="onebid_item item_referal clpb_item" data-clipboard-text="' . $ref_login . '">' . $ref_login . '</span>',$text);
	}

	if(strstr($text, '[partner_sum]')){	
		$text = str_replace('[partner_sum]', '<span class="onebid_item item_partner_sum clpb_item" data-clipboard-text="' . is_sum($item->partner_sum) . '">' . is_sum($item->partner_sum) . '</span>',$text);
	}

	if(strstr($text, '[partner_pers]')){	
		$text = str_replace('[partner_pers]', '<span class="onebid_item item_partner_pers clpb_item" data-clipboard-text="' . is_sum($item->partner_pers) . '">' . is_sum($item->partner_pers) . '</span>',$text);
	}	
	
	return $text;
}