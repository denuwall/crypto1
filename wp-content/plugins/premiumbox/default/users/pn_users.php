<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action( 'profile_update', 'premiumbox_profile_update');
function premiumbox_profile_update($user_id){
	global $change_ld_account, $wpdb;
	$change_ld_account = 1;
		
	if(isset($_POST['premiumbox_profile_update'])){
		
		$array = array();
		$array['user_discount'] = is_sum(is_param_post('user_discount'));
		$wpdb->update($wpdb->prefix ."users", $array, array('ID'=>$user_id));
		
	}
}		


add_action('show_user_profile', 'premiumbox_edit_user');
add_action('edit_user_profile', 'premiumbox_edit_user');	
function premiumbox_edit_user($user){
	$user_id = $user->ID;
	$user_discount = is_sum(is_isset($user,'user_discount'));
	?>
	<input type="hidden" name="premiumbox_profile_update" value="1" />
	<h3><?php _e('User data','pn'); ?></h3>

	<table class="form-table">
		<tr>
			<th>
				<label><?php _e('Orders','pn'); ?></label>
			</th>
			<td>
				<a href="<?php echo admin_url('admin.php?page=pn_bids&iduser='. $user_id); ?>" class="button" target="_blank"><?php _e('User orders','pn'); ?></a>
			</td>
		</tr>		
		<tr>
			<th>
				<label for="user_discount"><?php _e('Personal discount','pn'); ?></label>
			</th>
			<td>
				<input type="text" name="user_discount" id="user_discount" autocomplete="off" value="<?php echo $user_discount;?>" />%
			</td>
		</tr>
		<tr>
			<th>
				<?php _e('Discount (%)','pn'); ?>
			</th>
			<td>
				<?php echo get_user_discount($user_id);?>%
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e('User exchange list','pn'); ?></label>
			</th>
			<td>
				<?php echo get_user_count_exchanges($user_id); ?> ( <?php echo get_user_sum_exchanges($user_id); ?> <?php echo cur_type(); ?>)
			</td>
		</tr>		
    </table>	
	<?php
}

add_filter('manage_users_columns', 'premiumbox_users_columns',10);
function premiumbox_users_columns($columns) {

	$columns['userskidka'] = __('Discount (%)','pn');
	$columns['countobmen'] = __('User exchange list','pn');
			
	return $columns;
}
	
add_filter('manage_users_custom_column', 'premiumbox_manage_users_custom_column', 10, 3);
function premiumbox_manage_users_custom_column($empty='', $column_name, $user_id){
			
	if($column_name == 'userskidka'){
	   return get_user_discount($user_id).'%';
	}
	if($column_name == 'countobmen'){
	   return get_user_count_exchanges($user_id).'<br />(<strong>'. get_user_sum_exchanges($user_id) .'</strong>&nbsp;'. cur_type() .')';
	}	
			
	return $empty;	
}	