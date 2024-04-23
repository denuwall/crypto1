<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('pn_caps_cron')){
	
	add_action('admin_menu', 'admin_menu_cron');
	function admin_menu_cron(){
	global $premiumbox;	
		if(current_user_can('administrator') or current_user_can('pn_test_cron')){
			add_submenu_page("pn_config", __('Cron','pn'), __('Cron','pn'), 'read', "pn_cron", array($premiumbox, 'admin_temp'));
		}
	}

	add_action('pn_adminpage_title_pn_cron', 'def_pn_adminpage_title_pn_cron');
	function def_pn_adminpage_title_pn_cron($page){
		_e('Cron','pn');
	} 

 	add_action('pn_adminpage_content_pn_cron','def_pn_adminpage_content_pn_cron');
	function def_pn_adminpage_content_pn_cron(){
	global $premiumbox;

		$site_url = get_site_url_or();
		$text = __('If for some reason your tasks do not work then you can use direct link','pn').'<br />
		<a href="'. $site_url .'/cron.html'. get_hash_cron('?') .'" target="_blank">'. $site_url .'/cron.html'. get_hash_cron('?') .'</a>
		';
		
		$form = new PremiumForm();
		$form->substrate($text);
		?>
		<div class="premium_body">
			<table class="premium_standart_table">
				<?php
					$form->h3(__('Cron tasks','pn'), '');	
				?>
			</table>
			
			<?php
			$pn_cron = get_option('pn_cron');
			$pn_cron = (array)$pn_cron;
			
			$cron_times = pn_cron_times();
			
			$cron_func = apply_filters('list_cron_func', array());
			$cron_func = (array)$cron_func;
			?>
			<div class="crontab">
			
				<?php
				foreach($cron_func as $func_name => $func_data){
					$func_title = trim(is_isset($func_data, 'title'));

					$site_time = $file_time = '---';
					if(isset($pn_cron['site'][$func_name]['last_update'])){
						$site_time = date('d-m-Y H:i:s', $pn_cron['site'][$func_name]['last_update']);
					}
					if(isset($pn_cron['file'][$func_name]['last_update'])){
						$file_time = date('d-m-Y H:i:s', $pn_cron['file'][$func_name]['last_update']);
					}	

					$site_work_time = trim(is_isset($func_data, 'site'));
					$file_work_time = trim(is_isset($func_data, 'file'));
					if(isset($pn_cron['site'][$func_name]['work_time'])){
						$site_work_time = trim($pn_cron['site'][$func_name]['work_time']);
					}
					if(isset($pn_cron['file'][$func_name]['work_time'])){
						$file_work_time = trim($pn_cron['file'][$func_name]['work_time']);
					}
				?>	
				<div class="one_cron_action">
					<form method="post" action="<?php pn_the_link_post('pn_cron_func'); ?>">
						<?php wp_referer_field(); ?>
						<input type="hidden" name="action" value="<?php echo $func_name; ?>" />
						<input type="submit" name="submit" class="button one_cron_run" value="<?php _e('Run','pn'); ?>" />	
					</form>
					<a href="<?php echo $site_url;?>/cron-<?php echo $func_name;?>.html<?php echo get_hash_cron('?'); ?>" class="button one_cron_run" target="_blank"><?php _e('Cron file','pn'); ?></a>
					<div class="one_cron_title"><?php echo $func_title; ?></div>
						<div class="premium_clear"></div>
						
					<div class="one_cron_place_title"><?php _e('On website','pn'); ?>:</div>
					<div class="one_cron_place_time"><?php echo $site_time; ?></div>
					<div class="one_cron_place_select">	
						<select name="" class="js_cron_place_site" autocomplete="off" data-key="<?php echo $func_name; ?>">
							<?php foreach($cron_times as $cron_time_key => $cron_time_data){ ?>
								<option value="<?php echo $cron_time_key; ?>" <?php selected($site_work_time, $cron_time_key); ?>><?php echo is_isset($cron_time_data, 'title'); ?></option>
							<?php } ?>
						</select>
					</div>	
						<div class="premium_clear"></div>
					
					<div class="one_cron_place_title"><?php _e('On server','pn'); ?>:</div>
					<div class="one_cron_place_time"><?php echo $file_time; ?></div>
					<div class="one_cron_place_select">	
						<select name="" class="js_cron_place_file" autocomplete="off" data-key="<?php echo $func_name; ?>">
							<?php foreach($cron_times as $cron_time_key => $cron_time_data){ ?>
								<option value="<?php echo $cron_time_key; ?>" <?php selected($file_work_time, $cron_time_key); ?>><?php echo is_isset($cron_time_data, 'title'); ?></option>
							<?php } ?>
						</select>
					</div>
				
						<div class="premium_clear"></div>					
				</div>				
				<?php
				}
				?>

			</div>
		</div>
	
<script type="text/javascript">	
jQuery(function($){

function cron_change_request(){
	var place_site = '';
	$('.js_cron_place_site').each(function(){
		var id = $(this).attr('data-key');
		var value = $(this).val();
		place_site = place_site + ',' + id + '*' + value;
	});
	
	var place_file = '';
	$('.js_cron_place_file').each(function(){
		var id = $(this).attr('data-key');
		var value = $(this).val();
		place_file = place_file + ',' + id + '*' + value;
	});	
	
	$('#premium_ajax').show();
	var param ='place_site=' + place_site + '&place_file=' + place_file;
    $.ajax({
		type: "POST",
		url: "<?php pn_the_link_post('cron_change_save'); ?>",
		dataType: 'json',
		data: param,
		error: function(res, res2, res3){
			<?php do_action('pn_js_error_response', 'ajax'); ?>
		},			
		success: function(res)
		{
			$('#premium_ajax').hide();	
		}
    });	
}	
	
	$('.js_cron_place_site, .js_cron_place_file').on('change', function(){
		cron_change_request();
	}); 	
	
});
</script>	
	<?php
	}  

	add_action('premium_action_cron_change_save', 'pn_premium_action_cron_change_save');
	function pn_premium_action_cron_change_save(){
	global $wpdb;

		only_post();
		
		$log = array();	
		$log['response'] = '';
		$log['status'] = '';
		$log['status_code'] = 0;
		$log['status_text'] = '';	
		
		if(current_user_can('administrator') or current_user_can('pn_test_cron')){
			
			$pn_cron = get_option('pn_cron');
			$pn_cron = (array)$pn_cron;
			
			$place_site = explode(',', trim(is_param_post('place_site')));
			$place_file = explode(',', trim(is_param_post('place_file')));
			
			foreach($place_site as $k => $v){
				$value = explode('*', $v);
				$func_name = is_isset($value, 0);
				$work_time = is_isset($value, 1);
				
				$pn_cron['site'][$func_name]['work_time'] = $work_time;
			}
			foreach($place_file as $k => $v){
				$value = explode('*', $v);
				$func_name = is_isset($value, 0);
				$work_time = is_isset($value, 1);
				
				$pn_cron['file'][$func_name]['work_time'] = $work_time;
			}			
				
			update_option('pn_cron', $pn_cron);	
			
		}  	

		echo json_encode($log);	
		exit;
	}	
	
	add_action('premium_action_pn_cron_func','def_premium_action_pn_cron_func');
	function def_premium_action_pn_cron_func(){
	global $wpdb;	

		only_post();
		
		pn_only_caps(array('administrator','pn_test_cron'));
		
			$action = trim(is_param_post('action'));
			go_pn_cron_func($action, 'site', 1);	
		
		$back_url = is_param_post('_wp_http_referer');
		$back_url .= '&reply=true';
				
		wp_safe_redirect($back_url);
		exit;
	}

}