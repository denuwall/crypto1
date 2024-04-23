<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_config_blacklist', 'pn_admin_title_pn_config_blacklist');
function pn_admin_title_pn_config_blacklist(){
	_e('Settings','pn');
}

add_action('pn_adminpage_content_pn_config_blacklist','def_pn_admin_content_pn_config_blacklist');
function def_pn_admin_content_pn_config_blacklist(){
global $premiumbox;
	
	$form = new PremiumForm();
	
	$options = array();	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);		
	$options['check'] = array(
		'view' => 'user_func',
		'func_data' => array(),
		'func' => 'pn_checkblacklist_option',	
	);	
	
	$params_form = array(
		'filter' => 'pn_blacklist_configform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
	
}

function pn_checkblacklist_option(){
global $premiumbox;
	
	$checks = $premiumbox->get_option('blacklist','check');
	if(!is_array($checks)){ $checks = array(); }
	
	$fields = array(
		'0'=> __('Invoice Send','pn'),
		'1'=> __('Invoice Receive','pn'),
		'2'=> __('Phone no.','pn'),
		'3'=> __('Skype','pn'),
		'4'=> __('E-mail','pn'),
		'5'=> __('IP', 'pn'),
	);
	?>
	<tr>
		<th><?php _e('Check selected fields','pn'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<?php 
				if(is_array($fields)){
					foreach($fields as $key => $val){ 
					?>
						<div><label><input type="checkbox" name="check[]" <?php if(in_array($key,$checks)){ ?>checked="checked"<?php } ?> value="<?php echo $key; ?>" /> <?php echo $val; ?></label></div>
					<?php 
					} 
				}
				?>							
			</div>
		</td>		
	</tr>				
	<?php	
}

add_action('premium_action_pn_config_blacklist','def_premium_action_pn_config_blacklist');
function def_premium_action_pn_config_blacklist(){
global $wpdb, $premiumbox;

	only_post();
	pn_only_caps(array('administrator','pn_blacklist'));

	$form = new PremiumForm();
	
	$check = is_param_post('check');
	$premiumbox->update_option('blacklist', 'check', $check);

	do_action('pn_blacklist_configform_post');
			
	$url = admin_url('admin.php?page=pn_config_blacklist&reply=true');
	$form->answer_form($url);
}	