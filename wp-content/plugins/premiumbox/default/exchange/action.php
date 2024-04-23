<?php
if( !defined( 'ABSPATH')){ exit(); }
	
add_action('siteplace_js','siteplace_js_exchange_action'); 
function siteplace_js_exchange_action(){
?>	
jQuery(function($){
	
	function checknumbr(mixed_var) {
		return ( mixed_var == '' ) ? false : !isNaN( mixed_var );
	}	
	
	$(document).on('change', 'input', function(){
		$(this).parents('.js_wrap_error').removeClass('error');
	});
	$(document).on('click', 'input', function(){
		$(this).parents('.js_wrap_error').removeClass('error');
	});	
	
	$(document).on('click', '.js_amount', function(){
		var amount = $(this).html();
		var id = $(this).attr('data-id');
		$('input.js_'+id).val(amount).trigger('change');
		$('.js_'+id + '_html').html(amount);
	});	
	
	function cache_exchange_data(thet){
		var ind = 0;
		if(thet.hasClass('check_cache')){
			if($('#check_data').length > 0){
				if($('#check_data').prop('checked')){
					ind = 1;
				}
			}	
		} else {
			ind = 1;
		}
		if(ind == 1){
			var id = thet.attr('cash-id');
			var v = thet.val();
			Cookies.set("cache_"+id, v, { expires: 7, path: '/' });			
		}
	}
	
	$(document).on('change', '.cache_data', function(){
		cache_exchange_data($(this));
	});
	$(document).on('keyup', '.cache_data', function(){
		cache_exchange_data($(this));
	});	
	
	$(document).on('change', '#check_data', function(){
		if($(this).prop('checked')){
			Cookies.set("check_data", 1, { expires: 7, path: '/' });
			$('.check_cache').each(function(){
				var id = $(this).attr('name');
				var v = $(this).val();
				Cookies.set("cache_"+id, v, { expires: 7, path: '/' });	
			});
		} else {
			Cookies.set("check_data", 0, { expires: 7, path: '/' });
			$('.check_cache').each(function(){
				var id = $(this).attr('cash-id');
				Cookies.remove("cache_"+id);	
			});			
		}
	});
	
	function add_error_field(id, text){
		$('.js_'+ id).parents('.js_wrap_error').addClass('error');
		if(text.length > 0){
			$('.js_'+ id +'_error').html(text);
		}
	}
	
	function remove_error_field(id){
		$('.js_'+ id).parents('.js_wrap_error').removeClass('error');
	}	
	
	$(document).on('click', '.ajax_post_bids input[type=submit]', function(){
		var count_window = $('.window_message').length;
		if(count_window > 0){
			
			$(document).JsWindow('show', {
				id: 'window_to_direction',
				div_class: 'update_window',
				close_class: 'js_direction_window_close',
				title: '<?php _e('Attention!','pn'); ?>',
				div_content: '.window_message',
				shadow: 1
			});			
			
			return false;
		} 
	});
	
    $(document).on('click', '.js_direction_window_close', function(){
		$('.ajax_post_bids').submit();
    });	
	
    $('.ajax_post_bids').ajaxForm({
        dataType:  'json',
		beforeSubmit: function(a,f,o) {
			f.addClass('thisactive');
			$('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled',true);
			$('.ajax_post_bids_res').html('<div class="resulttrue"><?php echo esc_attr(__('Processing. Please wait','pn')); ?></div>');
        },
		error: function(res, res2, res3) {
			<?php do_action('pn_js_error_response', 'form'); ?>
		},		
        success: function(res) { 
		
			if(res['error_fields']){
				$.each(res['error_fields'], function(index, value){
					add_error_field(index, value);
				});					
			}			
				
			if(res['status'] && res['status'] == 'error'){
				$('.ajax_post_bids_res').html('<div class="resultfalse"><div class="resultclose"></div>'+res['status_text']+'</div>');
				if($('.js_wrap_error.error').length > 0){
					var ftop = $('.js_wrap_error.error:first').offset().top - 100;
					$('body,html').animate({scrollTop: ftop},500);
				}
			}
			if(res['status'] && res['status'] == 'success'){
				$('.ajax_post_bids_res').html('<div class="resulttrue"><div class="resultclose"></div>'+res['status_text']+'</div>');
			}				
		
			if(res['url']){
				window.location.href = res['url']; 
			}
			
			<?php do_action('ajax_post_form_jsresult', 'site'); ?>
		
		    $('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled',false);
			$('.thisactive').removeClass('thisactive');
			
        }
    });	
	
	function go_exchange_calc(sum, dej){
		
		var id = $('.js_direction_id:first').val();
		
		var check1 = 0;
		var check2 = 0;
		<?php if(is_enable_check_purse()){ ?>
		if($('input[name=check_purse1]').length > 0){
			if($('input[name=check_purse1]').prop('checked')){
				var check1 = 1;
			}
		}
		if($('input[name=check_purse2]').length > 0){
			if($('input[name=check_purse2]').prop('checked')){
				var check2 = 1;
			}
		}	
		<?php } ?>
		var param = 'id='+id+'&sum='+sum+'&dej='+dej+'&check1='+check1+'&check2='+check2;
		
		$('.exch_ajax_wrap_abs, .hexch_ajax_wrap_abs, .js_loader').show();
		
        $.ajax({
            type: "POST",
            url: "<?php echo get_ajax_link('exchange_changes');?>",
            data: param,
	        dataType: 'json',
 			error: function(res, res2, res3){
				<?php do_action('pn_js_error_response', 'ajax'); ?>
			},           
			success: function(res){ 
				
				if(dej !== 1){
					$('input.js_sum1').val(res['sum1']);
					$('.js_sum1_html').html(res['sum1']);
					Cookies.set("cache_sum1", res['sum1'], { expires: 7, path: '/' });
				}
				if(dej !== 2){
					$('input.js_sum2').val(res['sum2']);
					$('.js_sum2_html').html(res['sum2']);
				}
				if(dej !== 3){
					$('input.js_sum1c').val(res['sum1c']);
					$('.js_sum1c_html').html(res['sum1c']);
				}
				if(dej !== 4){
					$('input.js_sum2c').val(res['sum2c']);
					$('.js_sum2c_html').html(res['sum2c']);
				}
				
				$('.js_comis_text1').html(res['comis_text1']);
				$('.js_comis_text2').html(res['comis_text2']);
				
				remove_error_field('sum1');
				remove_error_field('sum2');
				remove_error_field('sum1c');
				remove_error_field('sum2c');
				
				if(res['error_fields']){
					$.each(res['error_fields'], function(index, value){
						add_error_field(index, value);
					});					
				}				
				
				if(res['curs_html'] && res['curs_html'].length > 0){
					$('.js_curs_html').html(res['curs_html']);
				}
				if(res['reserv_html'] && res['reserv_html'].length > 0){
					$('.js_reserv_html').html(res['reserv_html']);
				}
				if(res['user_discount'] && res['user_discount'].length > 0){
					$('.js_direction_user_discount').html(res['user_discount']);
				}	
				if(res['viv_com1'] && res['viv_com1'] == 1){
					$('.js_viv_com1').show();
				} else {
					$('.js_viv_com1').hide();
				}
				if(res['viv_com2'] && res['viv_com2'] == 1){
					$('.js_viv_com2').show();
				} else {
					$('.js_viv_com2').hide();
				}				
				
				$('.exch_ajax_wrap_abs, .hexch_ajax_wrap_abs, .js_loader').hide();
            }
		});	
	}
	
		var gp = 0;
		var go_int = 0;
		var field_id = '';
		var old_field_id = '';
		var now_sum = 0;
		var old_sum = 0;
		var up_form = 0;
		var start_ex_timer = 1;
		
		function clear_ind(){
			gp=0;
		}

		function start_exchange_timer(){
			if(start_ex_timer == 1){
				start_ex_timer = 0;
				
				setInterval(function(){
					if(go_int == 1 && gp == 0){
						go_int = 0;
						if(now_sum !== old_sum || field_id != old_field_id || up_form == 1){ 
							old_sum = now_sum;
							old_field_id = field_id;
							go_exchange_calc(now_sum, field_id);
						}
					}		
				}, 500);
			}
		}

		function go_calc(obj, f_id, req){
			
			var vale = obj.val().replace(/,/g,'.');
			if (checknumbr(vale)) {
				
				obj.parents('.js_wrap_error').removeClass('error');
				
				if(f_id == 1){
					$('input.js_sum1:not(:focus)').val(vale);
					$('.js_sum1_html').html(vale);
				} else if(f_id == 2){
					$('input.js_sum2:not(:focus)').val(vale);
					$('.js_sum2_html').html(vale);
				} else if(f_id == 3){
					$('input.js_sum1c:not(:focus)').val(vale);
					$('.js_sum1c_html').html(vale);
				} else if(f_id == 4){
					$('input.js_sum2c:not(:focus)').val(vale);
					$('.js_sum2c_html').html(vale);
				}
				
				now_sum = vale;
				up_form = req;
				go_int = 1;
				field_id = f_id;
				gp = 1;
				setTimeout(clear_ind, 1000);
				
			} else {
				obj.parents('.js_wrap_error').addClass('error');
			}	

			start_exchange_timer();
			
		}

		function set_input_decimal(obj){
			var dec = obj.attr('data-decimal');
			var sum = obj.val().replace(new RegExp(",",'g'),'.');
			var len_arr = sum.split('.');
			var len_data = len_arr[1];
			if(len_data !== undefined){
				var len = len_data.length;
				if(len > dec){
					var new_data = len_data.substr(0, dec);
					obj.val(len_arr[0]+'.'+new_data);
				}
			}			
		}
		
		$(document).on('keyup', '.js_decimal', function(){
			set_input_decimal($(this));
		});
		$(document).on('change', '.js_decimal', function(){
			set_input_decimal($(this));
		});		
		
		$(document).on('keyup', '.js_sum1', function(){
			var thet = $(this);
			go_calc(thet,1,0);
		});
		$(document).on('change', '.js_sum1', function(){
			var thet = $(this);
			go_calc(thet,1,0);
		});

		$(document).on('keyup', '.js_sum2', function(){
			var thet = $(this);
			go_calc(thet,2,0);
		});
		$(document).on('change', '.js_sum2', function(){
			var thet = $(this);
			go_calc(thet,2,0);
		});

		$(document).on('keyup', '.js_sum1c', function(){
			var thet = $(this);
			go_calc(thet,3,0);
		});
		$(document).on('change', '.js_sum1c', function(){
			var thet = $(this);
			go_calc(thet,3,0);
		});

		$(document).on('keyup', '.js_sum2c', function(){
			var thet = $(this);
			go_calc(thet,4,0);
		});
		$(document).on('change', '.js_sum2c', function(){
			var thet = $(this);
			go_calc(thet,4,0);
		});			
		
		<?php if(is_enable_check_purse()){ ?>
		$(document).on('change','.js_check_purse',function(){
			var thet = $('.js_sum1');
			go_calc(thet,1,1);
		});
		<?php } ?>
	
	<?php do_action('exchange_action_jquery'); ?>
	
});	
<?php	
} 
 
/* bids add */
add_action('myaction_site_bidsform', 'def_myaction_ajax_bidsform');
function def_myaction_ajax_bidsform(){
global $wpdb, $premiumbox;	
	
	$ui = wp_get_current_user();
	$user_id = intval($ui->ID);
	
	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');	

	$premiumbox->up_mode();

	$direction_id = intval(is_param_post('direction_id'));
	
	$check_rule = intval(is_param_post('check_rule'));
	$enable_step2 = intval($premiumbox->get_option('exchange','enable_step2'));
	if(!$check_rule and $enable_step2 == 0){
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! You have not accepted the terms and conditions of the User Agreement','pn');
		echo json_encode($log);
		exit;		
	}	
	
	$log = apply_filters('before_ajax_form_field', $log, 'exchangeform');
	$log = apply_filters('before_ajax_bidsform', $log, $direction_id);	
	
	if(!$direction_id){
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! The direction do not exist','pn');
		echo json_encode($log);
		exit;		
	}
	
	$direction_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
	if(!isset($direction_data->id)){
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! The direction do not exist','pn');
		echo json_encode($log);
		exit;		
	}
	
	$direction = array();
	foreach($direction_data as $direction_key => $direction_val){
		$direction[$direction_key] = $direction_val;
	}
	$directions_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$direction_id'");
	foreach($directions_meta as $direction_item){
		$direction[$direction_item->meta_key] = $direction_item->meta_value;
	}	
	$direction = (object)$direction; /* вся информация о направлении */
	
	$currency_id_give = intval($direction->currency_id_give);
	$currency_id_get = intval($direction->currency_id_get);
	
	$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_give'");
	$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$currency_id_get'");

	if(!isset($vd1->id) or !isset($vd2->id)){
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! The direction do not exist','pn');
		echo json_encode($log);
		exit;		
	}	
	
	$error_fields = array();
	$error_text = array();	
	
	/* счета валют */
	$account1 = $account2 = '';
	
	$show = apply_filters('form_bids_account_give', $vd1->show_give, $direction, $vd1);
	if($show == 1){
		$account1 = is_param_post('account1');
		$account1 = get_purse($account1, $vd1);
		if(!$account1){
			$error_fields['account1'] = __('invalid account number','pn');
		}
	}
	
	$show = apply_filters('form_bids_account_get', $vd2->show_get, $direction, $vd2);
	if($show == 1){
		$account2 = is_param_post('account2');
		$account2 = get_purse($account2, $vd2);
		if(!$account2){
			$error_fields['account2'] = __('invalid account number','pn');
		}
	}
	/* end счета валют */
	
	$check_purse1 = 0;
	$check_purse2 = 0;
	
	/* чекер аккаунтов */
	if(is_enable_check_purse()){
		$check_enable = intval($direction->check_purse);
		if($account1){
			if($check_enable == 1 or $check_enable == 3){
				$check_purse1 = apply_filters('set_check_account_give', 0, $account1, $vd1->check_purse);
			}
		}
		if($account2){
			if($check_enable == 2 or $check_enable == 3){
				$check_purse2 = apply_filters('set_check_account_get', 0, $account2, $vd2->check_purse);
			}
		}	
		
		$req_check_purse = intval($direction->req_check_purse);
		if($req_check_purse == 1 or $req_check_purse == 3){
			if($check_purse1 != 1){
				$error_fields['account1'] = apply_filters('check_purse_text_give', __('account has invalid status','pn'), $vd1->check_purse);		
			}
		}
		if($req_check_purse == 2 or $req_check_purse == 3){
			if($check_purse2 != 1){
				$error_fields['account2'] = apply_filters('check_purse_text_get', __('account has invalid status','pn'), $vd2->check_purse);			
			}
		}	
	}
	/* end чекер аккаунтов */
	
	$post_sum = is_sum(is_param_post('sum1'));
	$calc_data = array(
		'vd1' => $vd1,
		'vd2' => $vd2,
		'direction' => $direction,
		'user_id' => $user_id,
		'ui' => $ui,
		'post_sum' => $post_sum,
		'check1' => $check_purse1,
		'check2' => $check_purse2,
	);
	$calc_data = apply_filters('get_calc_data_params', $calc_data, 'action');
	$cdata = get_calc_data($calc_data);
	
	$decimal_give = $cdata['decimal_give'];
	$decimal_get = $cdata['decimal_get'];
	$currency_code_give = $cdata['currency_code_give'];
	$currency_code_get = $cdata['currency_code_get'];
	$psys_give = $cdata['psys_give'];
	$psys_get = $cdata['psys_get'];	
	$course_give = $cdata['course_give'];
	$course_get = $cdata['course_get'];	
	
	$sum1 = $cdata['sum1'];
	$sum1c = $cdata['sum1c'];
	$sum2 = $cdata['sum2'];
	$sum2c = $cdata['sum2c'];	
	
	/* максимум и минимум */
	$min1 = get_min_sum_to_direction_give($direction, $vd1, $vd2);
	$max1 = get_max_sum_to_direction_give($direction, $vd1, $vd2);
	/* if($min1 > $max1 and is_numeric($max1)){ $min1 = $max1; } */

	$min2 = get_min_sum_to_direction_get($direction, $vd1, $vd2); 
	$max2 = get_max_sum_to_direction_get($direction, $vd1, $vd2);
	/* if($min2 > $max2 and is_numeric($max2)){ $min2 = $max2; } */		

	if($sum1 < $min1){
		$error_fields['sum1'] = __('min','pn').'.: <span class="js_amount" data-id="sum1">'. $min1 .'</span> '.$currency_code_give;													
	}						
	if($sum1 > $max1 and is_numeric($max1)){
		$error_fields['sum1'] = __('max','pn').'.: <span class="js_amount" data-id="sum1">'. $max1 .'</span> '.$currency_code_give;													
	}						
	if($sum2 < $min2){
		$error_fields['sum2'] = __('min','pn').'.: <span class="js_amount" data-id="sum2">'. $min2 .'</span> '.$currency_code_get;													
	}							
	if($sum2 > $max2 and is_numeric($max2)){
		$error_fields['sum2'] = __('max','pn').'.: <span class="js_amount" data-id="sum2">'. $max2 .'</span> '.$currency_code_get;													
	}								
	if($sum1 <= 0){
		$error_fields['sum1'] = __('amount must be greater than 0','pn');
	}							
	if($sum2 <= 0){
		$error_fields['sum2'] = __('amount must be greater than 0','pn');
	}						
	if($sum1c <= 0){
		$error_fields['sum1c'] = __('amount must be greater than 0','pn');
	}							
	if($sum2c <= 0){
		$error_fields['sum2c'] = __('amount must be greater than 0','pn');
	}		
	/* end максимум и минимум */
	
	/* данные по валютам */
	$psys_give = pn_strip_input($vd1->psys_title);
	$psys_get = pn_strip_input($vd2->psys_title);
	$currency_id_give = $vd1->id;
	$currency_id_get = $vd2->id;
	$currency_code_give = $vd1->currency_code_title;
	$currency_code_get = $vd2->currency_code_title;
	$currency_code_id_give = $vd1->currency_code_id;
	$currency_code_id_get = $vd2->currency_code_id;	
	$psys_id_give = $vd1->psys_id;
	$psys_id_get = $vd2->psys_id;	
	/* end данные по валютам */
	
	$unmetas = array();
	$auto_data = array();
	$metas = array();
	$dmetas = array();
	
	/* основные поля */
	$osnpoles = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."direction_custom_fields LEFT OUTER JOIN ". $wpdb->prefix ."cf_directions ON(".$wpdb->prefix."direction_custom_fields.id = ". $wpdb->prefix ."cf_directions.cf_id) WHERE auto_status='1' AND status='1' AND ". $wpdb->prefix ."cf_directions.direction_id = '$direction_id' ORDER BY cf_order ASC");
	foreach($osnpoles as $op_item){
		$op_id = $op_item->cf_id;
		$op_vid = $op_item->vid;
		$op_name = pn_strip_input($op_item->cf_name);
		$op_req = $op_item->cf_req;
		$op_hidden = $op_item->cf_hidden;
		$op_value = is_param_post('cf'.$op_id);

		$op_uniq = '';
		if($op_vid == 0){
			$op_value = $op_uniq = get_cf_field($op_value,$op_item);
		} else {
			$op_value = intval($op_value);
		}
	
		$op_auto = $op_item->cf_auto;
		if(!$op_auto){ /* если не авто поле */
			if($op_vid == 0){
				
				$metas[] = array(
					'title' => $op_name,
					'data' => $op_value,
					'hidden' => $op_hidden,
				);
				
				if(!$op_value and $op_req == 1){
					$error_fields['cf'.$op_id] = __('field is filled with errors','pn');
				}
				
			} else { /* select */
			
				$op_datas = explode("\n",ctv_ml($op_item->datas));
				foreach($op_datas as $key => $da){
					$da = pn_strip_input($da);
					if($da){
						if($key == $op_value){
							$op_uniq = $op_name;
							$metas[] = array(
								'title' => $op_name,
								'data' => $da,
								'hidden' => $op_hidden,
							);
						}		
					}
				}
				
			}
		} else {
						
			$op_value = $op_uniq = apply_filters('cf_strip_auto_value',$op_value, $op_auto, $op_item ,$direction, $cdata);
			
			if(!$op_value and $op_req == 1){
				$error_fields['cf'.$op_id] = __('field is filled with errors','pn');	
			} 
			
			$cauv = array(
				'error' => 0,
				'error_text' => ''
			);
			$cauv = apply_filters('cf_auto_form_value',$cauv,$op_value,$op_item, $direction, $cdata);
			
			if($cauv['error'] == 1){
				$error_fields['cf'.$op_id] = $cauv['error_text'];				
			}
			
			$metas[] = array(
				'title' => $op_name,
				'data' => $op_value,
				'hidden' => $op_hidden,
				'auto' => $op_auto,
			);				
			$auto_data[$op_auto] = $op_value;
			
		}
		
		$uniqueid = pn_strip_input($op_item->uniqueid);
		if($uniqueid){
			$unmetas[$uniqueid] = $op_uniq;
		}		
	}
	/* end основные поля */		
	
	/* дополнительные поля */
	$dmetas[1] = $dmetas[2] = array();	
	
	$doppoles = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency_custom_fields WHERE auto_status = '1' AND currency_id='$currency_id_give' AND status='1' AND place_id IN('0','1') OR currency_id='$currency_id_get' AND status='1' AND place_id IN('0','2') ORDER BY cf_order ASC");
	foreach($doppoles as $dp_item){
		$dp_id = $dp_item->id;
		$dp_vid = $dp_item->vid;
		$dp_name = pn_strip_input($dp_item->cf_name);
		$dp_req = $dp_item->cf_req;
		$dp_hidden = $dp_item->cf_hidden;
		$dp_value = is_param_post('cfc'.$dp_id);
		$dp_uniq = '';
		if($dp_vid == 0){
			$dp_value = $dp_uniq = get_cf_field($dp_value,$dp_item);
		} else {
			$dp_value = intval($dp_value);
		}		
		
		$place_id = 1;
		if($dp_item->currency_id == $currency_id_get){
			$place_id = 2;
		}
		
		if($dp_vid == 0){
				
			$dmetas[$place_id][] = array(
				'title' => $dp_name,
				'data' => $dp_value,
				'hidden' => $dp_hidden,
			);
				
			if(!$dp_value and $dp_req == 1){
				$error_fields['cfc'.$dp_id] = __('field is filled with errors','pn');
			}
				
		} else { /* select */
		
			$dp_datas = explode("\n",ctv_ml($dp_item->datas));
			foreach($dp_datas as $key => $da){
				$da = pn_strip_input($da);
				if($da){
					if($key == $dp_value){
						$dp_uniq = $dp_name;
						$dmetas[$place_id][] = array(
							'title' => $dp_name,
							'data' => $da,
							'hidden' => $dp_hidden,
						);
					}		
				}
			}
				
		}
		
		$uniqueid = pn_strip_input($dp_item->uniqueid);
		if($uniqueid){
			$unmetas[$uniqueid] = $dp_uniq;
		}		
	}	
	/* end доп.поля */	

	/* фильтры счета валют */
	if($account1){
		$account1_bids = array(
			'error' => 0,
			'error_text' => ''
		);
		$account1_bids = apply_filters('account1_bids', $account1_bids, $account1, $direction, $vd1, $auto_data, $cdata);
		if($account1_bids['error'] == 1){
			$error_fields['account1'] = $account1_bids['error_text'];
		}
	}

	if($account2){
		$account2_bids = array(
			'error' => 0,
			'error_text' => ''
		);
		$account2_bids = apply_filters('account2_bids', $account2_bids, $account2, $direction, $vd2, $auto_data, $cdata);
		if($account2_bids['error'] == 1){
			$error_fields['account2'] = $account2_bids['error_text'];
		}		
	}	
	/* end фильтры счета валют */	
	
	$user_ip = pn_real_ip();
	
	/* проверки на обмен */
	$error_bids = array(
		'error_text' => $error_text,
		'error_fields' => $error_fields,
	);
	$error_bids = apply_filters('error_bids', $error_bids, $account1, $account2, $direction, $vd1, $vd2, $auto_data, $unmetas, $cdata);
	$error_text = $error_bids['error_text'];
	$error_fields = $error_bids['error_fields'];			
	/* end проверки */
	
	if(count($error_text) > 0 or count($error_fields) > 0){
		
		$log['status'] = 'error';
		$log['status_code'] = 1;
		if(is_array($error_text) and count($error_text) > 0){ 
			$error_text = join('<br />',$error_text);
		} else {
			$error_text = __('Error!','pn'); 
		}
		$log['status_text'] = $error_text;
		
	} else {
		
		$datetime = current_time('mysql');
		$hashed = unique_bid_hashed();
		
		$array = array();
		$array['create_date'] = $datetime;
		$array['edit_date'] = $datetime;
		$array['hashed'] = $hashed;
		$array['status'] = 'auto';
		$array['bid_locale'] = get_locale();
		$array['direction_id'] = $direction_id;
		$array['m_in'] = is_extension_name($direction->m_in); 
		$array['m_out'] = is_extension_name($direction->m_out);
		$array['course_give'] = $course_give;
		$array['course_get'] = $course_get;
		$array['currency_code_give'] = $currency_code_give;
		$array['currency_code_get'] = $currency_code_get;
		$array['currency_id_give'] = $currency_id_give;
		$array['currency_id_get'] = $currency_id_get;
		$array['psys_give'] = $psys_give;
		$array['psys_get'] = $psys_get;
		$array['currency_code_id_give'] = $currency_code_id_give;
		$array['currency_code_id_get'] = $currency_code_id_get;
		$array['psys_id_give'] = $psys_id_give;
		$array['psys_id_get'] = $psys_id_get;
		$array['user_id'] = $user_id;
		$array['user_ip'] = $user_ip;
		$array['first_name'] = is_isset($auto_data, 'first_name');
		$array['last_name'] = is_isset($auto_data, 'last_name');
		$array['second_name'] = is_isset($auto_data, 'second_name');
		$array['user_phone'] = is_isset($auto_data, 'user_phone');
		$array['user_skype'] = is_isset($auto_data, 'user_skype');
		$array['user_email'] = is_isset($auto_data, 'user_email');
		$array['user_passport'] = is_isset($auto_data, 'user_passport');
		$array['account_give'] = $account1;
		$array['account_get'] = $account2;
		$array['metas'] = serialize($metas);	
		$array['dmetas'] = serialize($dmetas);
		$array['unmetas'] = serialize($unmetas);

		$array['user_discount'] = $cdata['user_discount'];
		$array['user_discount_sum'] = $cdata['user_discount_sum'];		
		$array['exsum'] = $cdata['exsum'] = 0;
		$array['sum1'] = $sum1;
		$array['dop_com1'] = $cdata['dop_com1'] = 0;
		$array['sum1dc'] = $cdata['sum1dc'];
		$array['com_ps1'] = $cdata['com_ps1'] = 0;
		$array['sum1c'] = $sum1c;
		$array['sum1r'] = $cdata['sum1r'] = 0;
		$array['sum2t'] = $cdata['sum2t'] = 0;
		$array['sum2'] = $sum2;
		$array['dop_com2'] = $cdata['dop_com2'] = 0;
		$array['com_ps2'] = $cdata['com_ps2'] = 0;
		$array['sum2dc'] = $cdata['sum2dc'];
		$array['sum2c'] = $sum2c;
		$array['sum2r'] = $cdata['sum2r'] = 0;
		$array['profit'] = $cdata['profit'] = 0;		
		
		$array['check_purse1'] = $check_purse1;
		$array['check_purse2'] = $check_purse2;
		$array = apply_filters('array_data_create_bids', $array, $direction, $vd1, $vd2, $cdata);
		$wpdb->insert($wpdb->prefix.'exchange_bids', $array);
		$exchange_id = $wpdb->insert_id;
		if($exchange_id > 0){
			$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$exchange_id' AND status='auto'");

			if(isset($obmen->id)){
				do_action('change_bidstatus_all', 'auto',  $obmen->id, $obmen, 'exchange_button', 'user');
				do_action('change_bidstatus_auto', $obmen->id, $obmen, 'exchange_button', 'user'); 

			$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$exchange_id' AND status='auto'");
			
				set_action_bidstatus_new(0, $obmen, $direction, $vd1, $vd2);
			$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE id='$exchange_id' AND status='auto'");

				$log['url'] = get_bids_url($hashed);
				$log['status'] = 'success';
				$log['status_text'] = __('Your order successfully created','pn');	
			} else {
				$log['status'] = 1;
				$log['status_text'] = __('Error! System error','pn');				
			}
		} else {
			$log['status'] = 1;
			$log['status_text'] = __('Error! Database error','pn');
		}
	}
	
	$log['error_fields'] = $error_fields;
	$log['error_text'] = $error_text;	
	
	echo json_encode($log);
	exit;
}

function set_action_bidstatus_new($place, $obmen, $direction, $vd1, $vd2){
global $wpdb, $premiumbox;

	$place = intval($place);
	$enable_step2 = intval($premiumbox->get_option('exchange','enable_step2'));
	
	if($place == 0 and $enable_step2 == 0 or $place == 1 and $enable_step2 == 1){
		if($place == 1){
	
			$max1 = get_max_sum_to_direction_give($direction, $vd1, $vd2); 
			$max2 = get_max_sum_to_direction_get($direction, $vd1, $vd2);
					
			$sum1 = pn_strip_input($obmen->sum1);
			$sum2 = pn_strip_input($obmen->sum2);
									
			if($sum1 > $max1 and is_numeric($max1) or $sum2 > $max2 and is_numeric($max2)){
				$log['status'] = 'error';
				$log['status_code'] = 1;
				$log['status_text'] = __('Error! Not enough reserve for the exchange','pn');
				echo json_encode($log);
				exit;													
			}									
		}

		add_pn_cookie('cache_sum1', 0);			

		bid_hashdata($obmen->id, $obmen, '');
		
		$datetime = current_time('mysql');
		$array = array();
		$array['create_date'] = $datetime;
		$array['edit_date'] = $datetime;
		$array['status'] = 'new';

		$array['user_hash'] = get_user_hash();
		
		$array = apply_filters('array_data_bids_new', $array, $obmen);
		
		$wpdb->update($wpdb->prefix.'exchange_bids', $array, array('id'=>$obmen->id));
		
		do_action('change_bidstatus_all', 'new',  $obmen->id, $obmen, 'exchange_button', 'user');	
		do_action('change_bidstatus_new', $obmen->id, $obmen, 'exchange_button', 'user');		
		
	} 
}

/* bids add */
add_action('myaction_site_createbids', 'def_myaction_ajax_createbids');
function def_myaction_ajax_createbids(){
global $wpdb, $premiumbox;	

	$log = array();
	$log['status'] = '';
	$log['response'] = '';
	$log['status_code'] = 0; 
	$log['status_text'] = __('Error','pn');		

	$premiumbox->up_mode();
	
	$check_rule = intval(is_param_post('check_rule'));
	$enable_step2 = intval($premiumbox->get_option('exchange','enable_step2'));
	if(!$check_rule and $enable_step2 == 1){
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! You have not accepted the terms and conditions of the User Agreement','pn');
		echo json_encode($log);
		exit;		
	}	
	
	$log = apply_filters('before_ajax_form_field', $log, 'createbids');
	$log = apply_filters('before_ajax_createbids', $log);
	
	$hashed = is_bid_hash(is_param_post('hash'));
	
	if(!$hashed){
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! System error','pn');
		echo json_encode($log);
		exit;		
	}
	
	$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed' AND status='auto'");
	if(!isset($obmen->id)){
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! System error','pn');
		echo json_encode($log);
		exit;		
	}
	
	$currency_id_give = intval($obmen->currency_id_give);
	$currency_id_get = intval($obmen->currency_id_get);
	
	$vd1 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status='1' AND id='$currency_id_give'");
	$vd2 = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE auto_status='1' AND id='$currency_id_get'");

	if(!isset($vd1->id) or !isset($vd2->id)){
		$log['status'] = 'error';
		$log['status_code'] = 1;
		$log['status_text'] = __('Error! System error','pn');
		echo json_encode($log);
		exit;		
	}

	$direction_id = intval($obmen->direction_id);
	
	$direction_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
	if(!isset($direction_data->id)){
		$log['status'] = 'error';
		$log['status_code'] = 1; 
		$log['status_text'] = __('Error! The direction do not exist','pn');
		echo json_encode($log);
		exit;		
	}
	
	$direction = array();
	foreach($direction_data as $direction_key => $direction_val){
		$direction[$direction_key] = $direction_val;
	}
	$naps_meta = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."directions_meta WHERE item_id='$direction_id'");
	foreach($naps_meta as $naps_item){
		$direction[$naps_item->meta_key] = $naps_item->meta_value;
	}	
	$direction = (object)$direction; /* вся информация о направлении */		

	set_action_bidstatus_new(1, $obmen, $direction, $vd1, $vd2);
	
	$log['url'] = get_bids_url($obmen->hashed);
	$log['status'] = 'success';
	$log['status_text'] = __('Your order successfully created','pn');		
	
	echo json_encode($log);
	exit;
}

/* bids cancel */
add_action('myaction_site_canceledbids', 'def_myaction_ajax_canceledbids');
function def_myaction_ajax_canceledbids(){
global $wpdb, $premiumbox;	
	
	$premiumbox->up_mode();

	$hashed = is_bid_hash(is_param_get('hash'));
	if($hashed){
		$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
		if(isset($obmen->id)){
			
			do_action('before_bidaction', 'canceledbids', $obmen);
			do_action('before_bidaction_canceledbids', $obmen);
			
			if($obmen->status == 'new'){
				if(is_true_userhash($obmen)){
					$result = $wpdb->update($wpdb->prefix.'exchange_bids', array('status'=>'cancel','edit_date'=>current_time('mysql')), array('id'=>$obmen->id));
					if($result == 1){
						do_action('change_bidstatus_all', 'cancel', $obmen->id, $obmen, 'exchange_button','user');
						do_action('change_bidstatus_cancel', $obmen->id, $obmen, 'exchange_button','user');
					}
				}
			}
		}
	} 
		$url = get_bids_url($hashed);
		wp_redirect($url);
		exit;
}

/* bids payed */
add_action('myaction_site_payedbids', 'def_myaction_ajax_payedbids');
function def_myaction_ajax_payedbids(){
global $wpdb, $premiumbox;
	
	$premiumbox->up_mode();
	
	$hashed = is_bid_hash(is_param_get('hash'));
	if($hashed){
		$obmen = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed'");
		if(isset($obmen->id)){
			
			do_action('before_bidaction', 'payedbids', $obmen);
			do_action('before_bidaction_payedbids', $obmen);
			
			if($obmen->status == 'new'){
				if(is_true_userhash($obmen)){					
					$direction_id = intval($obmen->direction_id);
					$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE direction_status='1' AND auto_status='1' AND id='$direction_id'");
					$m_in = apply_filters('get_merchant_id','', is_isset($direction,'m_in'), $obmen);
					if(!$m_in){
						$result = $wpdb->update($wpdb->prefix.'exchange_bids', array('status'=>'payed','edit_date'=>current_time('mysql')), array('id'=>$obmen->id));
						if($result == 1){
							do_action('change_bidstatus_all', 'payed', $obmen->id, $obmen, 'exchange_button', 'user');
							do_action('change_bidstatus_payed', $obmen->id, $obmen, 'exchange_button', 'user');
						}
					}					
				}
			}
		}
	} 
		$url = get_bids_url($hashed);
		wp_redirect($url);
		exit;		
}

/* merchant payed */
add_action('myaction_site_payedmerchant', 'def_myaction_ajax_payedmerchant'); 
function def_myaction_ajax_payedmerchant(){
global $wpdb, $premiumbox;	
	
	$premiumbox->up_mode();
	
	$error = 1;
	$hashed = is_bid_hash(is_param_get('hash'));
	if($hashed){
		
		$bids_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."exchange_bids WHERE hashed='$hashed' AND status IN('new','techpay','coldpay')");
		if(isset($bids_data->id)){
			
			do_action('before_bidaction', 'payedmerchant', $bids_data);
			do_action('before_bidaction_payedmerchant', $bids_data);
			
			$direction_id = intval($bids_data->direction_id);
			$direction = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."directions WHERE auto_status='1' AND id='$direction_id'");
			if(isset($direction->m_in)){
				$m_in = apply_filters('get_merchant_id','',$direction->m_in, $bids_data, $direction);
				if($m_in){
						
					$error = 0;
					$sum_to_pay = apply_filters('sum_to_pay', is_sum($bids_data->sum1dc), $m_in , $bids_data, $direction);	
						
					echo apply_filters('merchant_header', '', $bids_data, $direction);	
					
						$action = apply_filters('merchant_bidaction_'. $m_in, '', $sum_to_pay, $bids_data, $direction);
						$form = apply_filters('merchant_bidform_'. $m_in, '', $sum_to_pay, $bids_data, $direction);
						
						if($action){
							echo $action;
							?>
							<script type="text/javascript">
							jQuery(function($){							
								var clipboard = new ClipboardJS('.clpb_item');
								
								$('.clpb_item').on('click', function(){
									$('.zone_div').removeClass('active');
									$(this).parents('.zone_div').addClass('active');
								});							
							});
							</script>
							<?php
						}
						if($form){
							echo '<div id="goedform" style="display: none;">';
							echo $form;
							echo '</div>';
							echo '<div id="redirect_text" class="success_div" style="display: none;">'. __('Redirecting. Please wait','pn') .'</div>';
							?>
							<script type="text/javascript">
							jQuery(function($){
								document.oncontextmenu=function(e){return false};
								window.history.replaceState(null, null, '<?php echo get_bids_url($hashed); ?>');
								$('#redirect_text').show();
								$('#goedform form').attr('target','_self').submit();
							});
							</script>							
							<?php
						}	
					
					echo apply_filters('merchant_footer', '', $bids_data, $direction);
				} 
			} 
			
		} 
	}  
	
	if($error == 1){
		$url = get_bids_url($hashed);
		wp_redirect($url);
		exit;	
	}
}