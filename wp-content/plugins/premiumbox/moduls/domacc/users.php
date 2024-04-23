<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action( 'show_user_profile', 'pn_edit_user_domacc');
add_action( 'edit_user_profile', 'pn_edit_user_domacc');
function pn_edit_user_domacc($user){
global $wpdb;	
	$user_id = $user->ID;
	$currency_codes = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."currency_codes WHERE auto_status = '1'");	
	?>	
	<h3><?php _e('Internal account','pn') ?></h3>
	<table class="form-table">
		<?php foreach($currency_codes as $currency_code){ ?>
			<tr>
				<th style="padding: 5px;">
					<?php echo is_site_value($currency_code->currency_code_title); ?>
				</th>
				<td style="padding: 5px;">
					<?php echo get_user_domacc($user_id, $currency_code->id); ?>
				</td>
			</tr>
		<?php } ?>	
    </table>		
	<?php
}