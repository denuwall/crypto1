<?php 
if( !defined( 'ABSPATH')){ exit(); }

//* * * */02 *  wget --spider http://site.ru/cron.html > /dev/null

if(!function_exists('pn_cron_times')){
	function pn_cron_times(){
		$cron_times = array();
		$cron_times['none'] = array(
			'time' => '-1',
			'title' => __('Never','premium'),
		);		
		$cron_times['now'] = array(
			'time' => 0,
			'title' => __('When handling','premium'),
		);
		$cron_times['2min'] = array(
			'time' => (2*60),
			'title' => __('Interval 2 minutes','premium'),
		);
		$cron_times['5min'] = array(
			'time' => (5*60),
			'title' => __('Interval 5 minutes','premium'),
		);
		$cron_times['10min'] = array(
			'time' => (11*60),
			'title' => __('Interval 10 minutes','premium'),
		);
		$cron_times['30min'] = array(
			'time' => (31*60),
			'title' => __('Interval 30 minutes','premium'),
		);
		$cron_times['1hour'] = array(
			'time' => (61*60),
			'title' => __('Interval 1 hour','premium'),
		);
		$cron_times['3hour'] = array(
			'time' => (3*60*60),
			'title' => __('Interval 3 hours','premium'),
		);
		$cron_times['05day'] = array(
			'time' => (12*60*60),
			'title' => __('Interval 12 hours','premium'),
		);
		$cron_times['1day'] = array(
			'time' => (24*60*60),
			'title' => __('Interval 24 hours','premium'),
		);		
		$cron_times = apply_filters('cron_times', $cron_times);
		return $cron_times;
	}
}

if(!function_exists('pn_cron_file_init')){
	function pn_cron_file_init(){
		pn_cron_init('file');
	}
}

if(!function_exists('pn_cron_site_init')){
	function pn_cron_site_init(){
		pn_cron_init('site');
	}
}

if(!function_exists('pn_cron_init')){
	function pn_cron_init($place=''){
		$now_time = current_time('timestamp');
		
		$pn_cron = get_option('pn_cron');
		if(!is_array($pn_cron)){ $pn_cron = array(); }
		
		$times = pn_cron_times();
		
		$update_times_all = is_isset($pn_cron, 'update_times');
		$update_times = is_isset($update_times_all, $place);
		
		$go_times = array();
		
		foreach($times as $time_key => $time_data){
			if($time_key != 'none'){
				$timer_plus = intval(is_isset($time_data, 'time'));
				$last_time = intval(is_isset($update_times, $time_key));
				$action_time = $last_time + $timer_plus;
				if($action_time < $now_time){
					$go_times[] = $time_key;
				}
			}	
		}
		
		$actions = array();
		
		$cron_func = apply_filters('list_cron_func', array());
		$cron_func = (array)$cron_func;		
		
		foreach($go_times as $time_key){
			foreach($cron_func as $func_name => $func_data){
				$work_time = trim(is_isset($func_data, $place));
				if(isset($pn_cron[$place][$func_name]['work_time'])){
					$work_time = trim($pn_cron[$place][$func_name]['work_time']);
				}
				if($work_time == $time_key){
					$actions[] = $func_name;
					$pn_cron[$place][$func_name]['last_update'] = $now_time;
				}
			}
			$pn_cron['update_times'][$place][$time_key] = $now_time;		
		}			
		
		update_option('pn_cron', $pn_cron);

		foreach($actions as $action){
			go_pn_cron_func($action, $place, 0);
		}		
		
	}
}

if(!function_exists('go_pn_cron_func')){
	function go_pn_cron_func($action='', $place='', $update_time=0){
		if($action){
			$funcs = array();
			$cron_func = apply_filters('list_cron_func', array());
			$cron_func = (array)$cron_func;
			foreach($cron_func as $func => $name){
				$funcs[] = $func;
			}
			if(in_array($action,$funcs)){ 
			
				if($update_time == 1){
					$pn_cron = get_option('pn_cron');
					if(!is_array($pn_cron)){ $pn_cron = array(); }
					$pn_cron[$place][$action]['last_update'] = current_time('timestamp');
					update_option('pn_cron', $pn_cron);
				}
			
				call_user_func($action);
			} else {
				pn_display_mess(__('Error! Invalid command for task scheduler (cron)','premium'), __('Error! Invalid command for task scheduler (cron)','premium'));
			}
		}
	}
}

if(!function_exists('pn_cron_action')){
	function pn_cron_action($action){
		if($action){
			go_pn_cron_func($action, 'file', 1);
		} else {
			pn_cron_file_init();
		}
					
		_e('Done','premium');
		exit;
	}
}

if(!function_exists('pn_cron_init_all')){
	add_action('init', 'pn_cron_init_all', 3);
	function pn_cron_init_all(){
		$data = premium_rewrite_data();
		$super_base = $data['super_base'];	
		$matches = '';	
		
		$cron_work = apply_filters('pn_cron_work', 1);
		if($cron_work == 1){
			if(preg_match("/^cron-([a-zA-Z0-9\_]+).html$/", $super_base, $matches ) or $super_base == 'cron.html'){	
				if(check_hash_cron()){				
					header('Content-Type: text/html; charset=utf-8');
					
					$action = trim(is_isset($matches,1));
					if(function_exists('pn_cron_action')){
						pn_cron_action($action);
					} else {
						_e('Cron function does not exist','premium');
					}	
				}
				exit;
			} else {
				pn_cron_site_init();
			}
		}
	}	
}	