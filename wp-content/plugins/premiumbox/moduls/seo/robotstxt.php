<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_robotstxt', 'pn_adminpage_title_pn_robotstxt');
function pn_adminpage_title_pn_robotstxt($page){
	_e('Robots.txt settings','pn');
} 

add_action('pn_adminpage_content_pn_robotstxt','def_pn_adminpage_content_pn_robotstxt');
function def_pn_adminpage_content_pn_robotstxt(){
global $premiumbox;	
?>
	<div class="premium_default_window">
		<?php _e('Robots.txt URL','pn'); ?>:<br /> 
		<a href="<?php echo get_site_url_or(); ?>/robots.txt" target="_blank"><?php echo get_site_url_or(); ?>/robots.txt</a>
	</div>	
<?php	
	$form = new PremiumForm();
	
	$options = array();
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Robots.txt settings','pn'),
		'submit' => __('Save','pn'),
		'colspan' => 2,
	);		
	$options['txt'] = array( 
		'view' => 'textarea',
		'title' => __('Text','pn'),
		'default' => $premiumbox->get_option('robotstxt','txt'),
		'name' => 'txt',
		'width' => '',
		'height' => '300px',
	);

	$params_form = array(
		'filter' => 'robotstxt_changeform',
		'method' => 'post',
		'button_title' => __('Save','pn'),
	);
	$form->init_form($params_form, $options);	
} 

add_action('premium_action_pn_robotstxt','def_premium_action_pn_robotstxt');
function def_premium_action_pn_robotstxt(){
global $wpdb, $premiumbox;	

	only_post();
	pn_only_caps(array('administrator', 'pn_seo'));
	
	$form = new PremiumForm();
	
	$options = array('txt');	
					
	foreach($options as $key){
		$val = pn_strip_input(is_param_post($key));
		$premiumbox->update_option('robotstxt',$key,$val);
	}				

	do_action('robotstxt_changeform_post');
	
	$url = admin_url('admin.php?page=pn_robotstxt&reply=true');
	$form->answer_form($url);
} 