<?php 
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'pn_adminpage_theme_mobile_home');
function pn_adminpage_theme_mobile_home(){
global $premiumbox;

	add_submenu_page("pn_themeconfig", __('Homepage (mobile version)','pntheme'), __('Homepage (mobile version)','pntheme'), 'administrator', "pn_theme_mobile_home", array($premiumbox, 'admin_temp'));
}

add_action('pn_adminpage_title_pn_theme_mobile_home', 'pn_adminpage_title_pn_theme_mobile_home');
function pn_adminpage_title_pn_theme_mobile_home($page){
	_e('Homepage (mobile version)','pntheme');
} 

add_filter('pn_theme_mobile_home_option', 'def_pn_theme_mobile_home_option', 1);
function def_pn_theme_mobile_home_option($options){
global $wpdb, $premiumbox;

	$change = get_option('mho_change');
	
	$options['top_title'] = array(
		'view' => 'h3',
		'title' => __('Information','pntheme'),
		'submit' => __('Save','pntheme'),
		'colspan' => 2,
	);
	$options['wtitle'] = array(
		'view' => 'inputbig',
		'title' => __('Title', 'pntheme'),
		'default' => is_isset($change,'wtitle'),
		'name' => 'wtitle',
		'work' => 'input',
		'ml' => 1,
	);
	$options['wtext'] = array(
		'view' => 'editor',
		'title' => __('Text', 'pntheme'),
		'default' => is_isset($change,'wtext'),
		'name' => 'wtext',
		'work' => 'text',
		'rows' => 14,
		'media' => false,
		'ml' => 1,
	);		
	$options['center_title'] = array(
		'view' => 'h3',
		'title' => __('Welcome message','pntheme'),
		'submit' => __('Save','pntheme'),
		'colspan' => 2,
	);	
	$options['ititle'] = array(
		'view' => 'inputbig',
		'title' => __('Title', 'pntheme'),
		'default' => is_isset($change,'ititle'),
		'name' => 'ititle',
		'work' => 'input',
		'ml' => 1,
	);	
	$options['itext'] = array(
		'view' => 'editor',
		'title' => __('Text', 'pntheme'),
		'default' => is_isset($change,'itext'),
		'name' => 'itext',
		'work' => 'text',
		'rows' => 14,
		'media' => false,
		'ml' => 1,
	);		
	$options['line1'] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	$options['blocreviews'] = array(
		'view' => 'select',
		'title' => __('Reviews column','pntheme'),
		'options' => array('0'=>__('hide','pntheme'), '1'=>__('show','pntheme')),
		'default' => is_isset($change,'blocreviews'),
		'name' => 'blocreviews',
		'work' => 'int',
	);
	$options['line2'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['partners'] = array(
		'view' => 'select',
		'title' => __('Partners','pntheme'),
		'options' => array('0'=>__('hide','pntheme'), '1'=>__('show','pntheme')),
		'default' => is_isset($change,'partners'),
		'name' => 'partners',
		'work' => 'int',
	);	
	$options['line3'] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	$options['lastobmen'] = array(
		'view' => 'select',
		'title' => __('Last exchange','pntheme'),
		'options' => array('0'=>__('hide','pntheme'), '1'=>__('show','pntheme')),
		'default' => is_isset($change,'lastobmen'),
		'name' => 'lastobmen',
		'work' => 'int',
	);
	$options['line4'] = array(
		'view' => 'line',
		'colspan' => 2,
	);	
	$options['hidecurr'] = array(
		'view' => 'user_func',
		'func_data' => array(),
		'func' => 'pn_theme_home_mobile_hidecurr',
		'work' => 'input_array',
	);
	$options['line5'] = array(
		'view' => 'line',
		'colspan' => 2,
	);
	$options['blocknews'] = array(
		'view' => 'select',
		'title' => __('News column','pntheme'),
		'options' => array('0'=>__('hide','pntheme'), '1'=>__('show','pntheme')),
		'default' => is_isset($change,'blocknews'),
		'name' => 'blocknews',
		'work' => 'int',
	);

	$categories = get_categories('hide_empty=0');
	$array = array();
	$array[0] = '--'.__('All','pntheme').'--';
	if(is_array($categories)){
		foreach($categories as $cat){
			$array[$cat->cat_ID] = ctv_ml($cat->name);
		}
	}	
	
	$options['catnews'] = array(
		'view' => 'select',
		'title' => __('Category','pntheme'),
		'options' => $array,
		'default' => is_isset($change,'catnews'),
		'name' => 'catnews',
		'work' => 'int',
	);	
	
	return $options;
}

add_action('pn_adminpage_content_pn_theme_mobile_home','def_pn_adminpage_content_pn_theme_mobile_home');
function def_pn_adminpage_content_pn_theme_mobile_home(){
	
	$form = new PremiumForm();
	$params_form = array(
		'filter' => 'pn_theme_mobile_home_option',
		'method' => 'post',
	);
	$form->init_form($params_form);		
		
} 

function pn_theme_home_mobile_hidecurr($data){
	$ho_change = get_option('mho_change');
?>
	<tr>
		<th><?php _e('Hide currency reserve in widget','pntheme'); ?></th>
		<td>
			<div class="premium_wrap_standart">
				<div style="max-height: 200px; overflow-y: scroll;" class="cf_div">
					<div><label style="font-weight: 500;"><input class="check_all" type="checkbox" name="0" value="0"> <?php _e('Check all/Uncheck all','pntheme'); ?></label></div>
					<?php
					$hidecurr = explode(',',is_isset($ho_change,'hidecurr'));
					$valuts = array();
					if(function_exists('list_view_currencies')){
						$valuts = list_view_currencies();
					}
					if(is_array($valuts)){
						foreach($valuts as $item){
					?>
						<div><label><input type="checkbox" name="hidecurr[]" <?php if(in_array($item['id'], $hidecurr)){ ?>checked="checked"<?php } ?> value="<?php echo $item['id']; ?>"> <?php echo $item['title']; ?></label></div>
					<?php } 
					}
					?>
				</div>
			</div>
		</td>		
	</tr>

	<script type="text/javascript">
	jQuery(function($){
		$('.check_all').on('change', function(){
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

add_action('premium_action_pn_theme_mobile_home','def_premium_action_pn_theme_mobile_home');
function def_premium_action_pn_theme_mobile_home(){
global $wpdb;

	only_post();
	pn_only_caps(array('administrator'));

	$form = new PremiumForm();
	$data = $form->strip_options('pn_theme_mobile_home_option', 'post');

	$change = get_option('mho_change');
	if(!is_array($change)){ $hchange = array(); } 
								
	$change['blocknews'] = $data['blocknews'];
	$change['catnews'] = $data['catnews'];				
	$change['blocreviews'] = $data['blocreviews'];	
	$change['partners'] = $data['partners'];		
	$change['lastobmen'] = $data['lastobmen'];
				
	$change['wtitle'] = $data['wtitle'];
	$change['ititle'] = $data['ititle'];
			
	$change['wtext'] = $data['wtext'];
	$change['itext'] = $data['itext'];
		
	$hidecurr = is_param_post('hidecurr');
	if(is_array($hidecurr)){
		$hidecurr = join(',', $hidecurr);
	} else {
		$hidecurr = '';
	}
	$change['hidecurr'] = $hidecurr;	
					
	update_option('mho_change',$change);	
	
	$back_url = is_param_post('_wp_http_referer');
	$back_url .= '&reply=true';
	
	$form->answer_form($back_url);
}