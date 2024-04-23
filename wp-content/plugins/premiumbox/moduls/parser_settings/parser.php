<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_new_parser', 'pn_adminpage_title_pn_new_parser');
function pn_adminpage_title_pn_new_parser(){
	_e('Rates sources','pn');
}

add_action('pn_adminpage_content_pn_new_parser','def_pn_adminpage_content_pn_new_parser');
function def_pn_adminpage_content_pn_new_parser(){
global $premiumbox;
	
	$birgs = apply_filters('new_parser_links', array());
	
	$work_birgs = get_option('work_birgs');
	if(!is_array($work_birgs)){ $work_birgs = array(); }
	
	$parser_pairs = get_parser_pairs();	
	
	$date = __('No','pn');
	$time_parser = get_option('time_new_parser');
	if($time_parser){
		$date = date('d.m.Y H:i', $time_parser);
	}
	
	?>
	<div class="parser_up_time"><?php echo $date; ?></div>
		<div class="premium_clear"></div>

	<?php
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);	
	$show_block_parser = get_user_meta($user_id, 'show_block_new_parser', true);
	if(!is_array($show_block_parser)){ $show_block_parser = array(); }
	
	foreach($birgs as $birg_key => $birg_data){
		$cl = array();	
		if(in_array($birg_key, $show_block_parser)){
			$cl[]= 'open_work_parser';
		}
		$checkbox = '';
		if(in_array($birg_key, $work_birgs)){
			$cl[]= 'has_work_parser';
			$checkbox = ' checked="checked"';
		}		
	?>
	<div class="parser_birg_wrap <?php echo join(' ', $cl); ?>" data-key="<?php echo $birg_key; ?>">
		<div class="parser_birg_title"><?php echo is_isset($birg_data, 'title'); ?></div>
		<div class="parser_birg_checher"><label><input type="checkbox" class="parserchange_enable" data-key="<?php echo $birg_key; ?>" <?php echo $checkbox; ?> name="" value="1" /> <?php _e('Enable/disable source','pn'); ?></label></div>
			<div class="premium_clear"></div>
		
		<div class="parser_birg_div">
			<?php 
 			foreach($parser_pairs as $pair){
				$birg = is_isset($pair,'birg');
				if($birg == $birg_key){
					$title = is_isset($pair,'title');
					$course = is_sum(is_isset($pair,'course'), 20);
					$code = is_isset($pair,'code');
			?>
			<div class="parser_div">
				<div class="parser_title clpb_item" data-clipboard-text="[<?php echo $code; ?>]"><?php echo $title; ?></div>
				<div class="parser_curs">1 &rarr; <?php echo $course; ?></div>
					<div class="premium_clear"></div>
				<div class="parser_enable">
					<input type="text" style="width: 100%;" name="" onclick="this.select()" value="[<?php echo $code; ?>]" />
				</div>
			</div>	
			<?php
				}
			} 
			?>
			
		</div>
	</div>	
	<?php
	}	
	?>
<script type="text/javascript">	
jQuery(function($){

	var clipboard = new ClipboardJS('.clpb_item');

 	$('.parser_birg_title').on('click', function(){ 
		$(this).parents('.parser_birg_wrap').toggleClass('open_work_parser');
		
		var id_birgs = '';
		$('.parser_birg_wrap.open_work_parser').each(function(){
			var id = $(this).attr('data-key');
			id_birgs = id_birgs + ',' + id;
		});		
		
		$('#premium_ajax').show();
		var param = 'ids=' + id_birgs;
		
		$.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('user_new_parser_save'); ?>",
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
		
        return false;
	});

	$('.parserchange_enable').on('change', function(){
		
		if($(this).prop('checked')){
			$(this).parents('.parser_birg_wrap').addClass('has_work_parser');
		} else {
			$(this).parents('.parser_birg_wrap').removeClass('has_work_parser');
		}
		
		var id_parsers = '';
		$('.parserchange_enable:checked').each(function(){
			var id = $(this).attr('data-key');
			id_parsers = id_parsers + ',' + id;
		});
		
		$('#premium_ajax').show();
		var param ='ids=' + id_parsers;
		$.ajax({
			type: "POST",
			url: "<?php pn_the_link_post('work_new_parser_save'); ?>",
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
		
	});	 	 
	
});
</script>	
<?php
}

add_action('premium_action_work_new_parser_save', 'pn_premium_action_work_new_parser_save');
function pn_premium_action_work_new_parser_save(){
global $wpdb;

	only_post();

	$log = array();	
	$log['response'] = '';
	$log['status'] = '';
	$log['status_code'] = 0;
	$log['status_text'] = '';	
	
	if(current_user_can('administrator')){
		
		$ids = explode(',', is_param_post('ids'));
		$has_ids = array();
		foreach($ids as $id){
			$id = pn_string($id);
			if($id){
				$has_ids[] = $id;
			}
		}
				
		update_option('work_birgs', $has_ids);
		
	} 

	echo json_encode($log);	
	exit;	
}

add_action('premium_action_user_new_parser_save', 'pn_premium_action_user_new_parser_save');
function pn_premium_action_user_new_parser_save(){
global $wpdb;

	only_post();

	$log = array();	
	$log['response'] = '';
	$log['status'] = '';
	$log['status_code'] = 0;
	$log['status_text'] = '';	
	
	if(current_user_can('administrator')){
		
		$ids = explode(',', is_param_post('ids'));
		$has_ids = array();
		foreach($ids as $id){
			$id = pn_string($id);
			if($id){
				$has_ids[] = $id;
			}
		}
		
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);		
		
		update_user_meta($user_id, 'show_block_new_parser', $has_ids);
		
	} 

	echo json_encode($log);	
	exit;	
}