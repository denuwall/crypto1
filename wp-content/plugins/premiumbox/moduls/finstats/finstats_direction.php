<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('pn_adminpage_title_pn_finstats_direction', 'def_adminpage_title_pn_finstats_direction');
function def_adminpage_title_pn_finstats_direction(){
	_e('Financial statistics','pn');
}

add_action('pn_adminpage_content_pn_finstats_direction','def_adminpage_content_pn_finstats_direction');
function def_adminpage_content_pn_finstats_direction(){
global $wpdb;
?>
<form action="<?php pn_the_link_post('finstats_direction_form'); ?>" class="finstats_form" method="post">
	<div class="finfiletrs">
	
		<div class="fin_list">
			<div class="fin_label"><?php _e('Start date','pn'); ?></div>
			<input type="search" name="startdate" autocomplete="off" class="pn_datepicker" value="" />
		</div>
		<div class="fin_list">
			<div class="fin_label"><?php _e('End date','pn'); ?></div>
			<input type="search" name="enddate" autocomplete="off" class="pn_datepicker" value="" />
		</div>		
			<div class="premium_clear"></div>	
	
		<?php
		$directions = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status = '1' ORDER BY site_order1 ASC");
		?>		
		<div class="fin_list">
			<div class="fin_label"><?php _e('Exchange direction','pn'); ?></div>

			<select name="direction_id" autocomplete="off">
				<option value="0">--<?php _e('No item','pn'); ?>--</option>
				<?php foreach($directions as $item){ ?>
					<option value="<?php echo $item->id; ?>"><?php echo pn_strip_input($item->tech_name); ?></option>
				<?php } ?>
			</select>
		</div>

		<?php
		$arrs = array();
		$arrs['sum1'] = __('Amount To send','pn');
		$arrs['sum1dc'] = __('Amount To send (add. fees)','pn');
		$arrs['sum1c'] = __('Amount Send (PS fee)','pn');
		?>		
		<div class="fin_list">
			<div class="fin_label"><?php _e('Amount','pn'); ?></div>

			<select name="amount_key" autocomplete="off">
				<?php foreach($arrs as $arr_key => $arr_value){ ?>
					<option value="<?php echo $arr_key; ?>"><?php echo pn_strip_input($arr_value); ?></option>
				<?php } ?>
			</select>
		</div>		
	
			<div class="premium_clear"></div>
		<input type="submit" name="submit" class="finstat_link" value="<?php _e('Display statistics','pn'); ?>" />
		<div class="finstat_ajax"></div>
		
			<div class="premium_clear"></div>
	</div>
</form>

<div id="finres"></div>

<script type="text/javascript">
jQuery(function($){
	
	$('.finstats_form').ajaxForm({
	    dataType:  'json',
        beforeSubmit: function(a,f,o) {
			
			$('.finstat_link').attr('disabled',true);
		    $('.finstat_ajax').show();
			
        },
		error: function(res, res2, res3){
			<?php do_action('pn_js_error_response'); ?>
		},		
        success: function(res) {
			
			$('.finstat_link').attr('disabled',false);
		    $('.finstat_ajax').hide();
			
			if(res['status'] == 'error'){
				<?php do_action('pn_js_alert_response'); ?>
			} else if(res['status'] == 'success') {
				$('#finres').html(res['table']);
			}
        }
    });
	
});
</script>		
<?php
}  

add_action('premium_action_finstats_direction_form', 'pn_premium_action_finstats_direction_form');
function pn_premium_action_finstats_direction_form(){
global $wpdb;

	only_post();
	$log = array();
	$log['status'] = 'success';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = '';	
	
	if(current_user_can('administrator') or current_user_can('pn_finstats')){
		
		$where = '';		
		
		$pr = $wpdb->prefix;
		
		$startdate = is_my_date(is_param_post('startdate'));
		if($startdate){
			$startdate = get_mydate($startdate,'Y-m-d 00:00');
			$where .= " AND create_date >= '$startdate'";
		}
		$enddate = is_my_date(is_param_post('enddate'));
		if($enddate){
			$enddate = get_mydate($enddate,'Y-m-d 00:00');
			$where .= " AND create_date <= '$enddate'";
		}	
		
		$direction_id = intval(is_param_post('direction_id'));
		$amount_key = pn_strip_input(is_param_post('amount_key'));
		$arrs = array('sum1','sum1dc','sum1c');
		if(!in_array($amount_key, $arrs)){ $amount_key = 'sum1'; }

		$profit = $wpdb->get_var("SELECT SUM($amount_key) FROM ".$wpdb->prefix."exchange_bids WHERE status IN('success') AND direction_id='$direction_id' $where");
		$profit = get_sum_color(is_sum($profit));		
		
		$table = '
		<div class="finresults">
			<div class="finline"><strong>'. __('Total amount','pn') .'</strong>: '. $profit .'</div>
		</div>		
		';
		
		$log['table'] = $table;
		
	} else {
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('You do not have permission','pn');
	}	
	
	echo json_encode($log);	
	exit;
}