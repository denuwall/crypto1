<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('InvestBox')){
	class InvestBox extends Premium {

		function __construct($debug_mode=0)
		{
		
			$this->debug_constant_name = 'INEX_RICH_TEST';
			$this->plugin_name = 'Invest';
			$this->plugin_version = '3.4';
			$this->plugin_path = INEX_PLUGIN_NAME;
			$this->plugin_dir = INEX_PLUGIN_DIR;
			$this->plugin_url = INEX_PLUGIN_URL;
			$this->plugin_prefix = 'inex';
			$this->plugin_option_name = 'inex_change';
			$this->plugin_page_name = 'inex_pages';
			
			parent::__construct($debug_mode);
			
			add_filter('pn_caps',array($this, 'pn_caps'));
			add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'), 99);
			add_filter('list_icon_indicators', array($this, 'icon_indicators'));
			add_action('wp_before_admin_bar_render', array($this, 'check_icon'));
			
			add_filter('account_list_pages', array($this, 'account_list_pages'),100);
			
			add_filter($this->plugin_prefix.'_tech_pages', array($this, 'list_tech_pages'));
			
			add_filter('list_admin_notify', array($this, 'list_admin_notify'));
			add_filter('list_user_notify', array($this, 'list_user_notify'));
			
			add_filter('list_notify_tags_mail1u', array($this, 'def_mailtemp_tags_mail1u'));
			add_filter('list_notify_tags_mail1', array($this, 'def_mailtemp_tags_mail1'));
			add_filter('list_notify_tags_mail2', array($this, 'def_mailtemp_tags_mail1'));
			add_filter('list_notify_tags_mail3', array($this, 'def_mailtemp_tags_mail3'));
		}			
		
		function list_admin_notify($places){
			$places['mail1'] = __('New deposit', $this->plugin_prefix);
			$places['mail2'] = __('Payout already requested', $this->plugin_prefix);
			$places['mail3'] = __('Prolongation of the deposit', $this->plugin_prefix);
			return $places;
		}

		function list_user_notify($places){
			$places['mail1u'] = __('Deposit period is about to reach the limit', $this->plugin_prefix);
			return $places;
		}	

		function def_mailtemp_tags_mail1u($tags){
			$tags['id'] = __('Deposit ID', $this->plugin_prefix);
			$tags['outsumm'] = __('Total amount', $this->plugin_prefix);
			return $tags;
		}


		function def_mailtemp_tags_mail1($tags){
			$tags['id'] = __('Deposit ID', $this->plugin_prefix);
			$tags['outsumm'] = __('Amount', $this->plugin_prefix);
			$tags['system'] = __('Payment system', $this->plugin_prefix);
			return $tags;
		}

		function def_mailtemp_tags_mail3($tags){
			$tags['id'] = __('Deposit ID', $this->plugin_prefix);
			$tags['newid'] = __('New deposit ID', $this->plugin_prefix);
			return $tags;
		}		
		
		function pn_caps($pn_caps){
			$pn_caps['pn_investbox'] = __('Investments',$this->plugin_prefix);
			return $pn_caps;
		}		
		
		function admin_menu(){ 
			
			if(current_user_can('administrator') or current_user_can('pn_investbox')){
				$hook = add_menu_page(__('Investments', $this->plugin_prefix), __('Investments', $this->plugin_prefix), 'read', 'inex_index', array($this, 'admin_temp'), $this->get_icon_link('invest'));  
				add_action( "load-$hook", 'pn_trev_hook' );
				
				add_submenu_page("inex_index",  __('Deposits',$this->plugin_prefix),  __('Deposits',$this->plugin_prefix), 'read', "inex_index", array($this, 'admin_temp'));
				
				add_submenu_page("inex_index", __('Add deposit',$this->plugin_prefix), __('Add deposit',$this->plugin_prefix), 'read', "inex_add_index", array($this, 'admin_temp'));
				
				$hook = add_submenu_page("inex_index", __('Payouts',$this->plugin_prefix), __('Payouts',$this->plugin_prefix), 'read', "inex_out", array($this, 'admin_temp'));
				add_action( "load-$hook", 'pn_trev_hook' );
				
				$hook = add_submenu_page("inex_index", __('Rates',$this->plugin_prefix), __('Rates',$this->plugin_prefix), 'read', "inex_tars", array($this, 'admin_temp'));
				add_action( "load-$hook", 'pn_trev_hook' );
				
				add_submenu_page("inex_index", __('Add tariff',$this->plugin_prefix), __('Add tariff',$this->plugin_prefix), 'read', "inex_add_tars", array($this, 'admin_temp'));
				
				add_submenu_page("inex_index", __('Payment systems',$this->plugin_prefix), __('Payment systems',$this->plugin_prefix), 'read', "inex_system", array($this, 'admin_temp'));
				add_submenu_page("inex_index", __('Settings',$this->plugin_prefix), __('Settings',$this->plugin_prefix), 'read', "inex_settings", array($this, 'admin_temp'));	
				add_submenu_page("inex_index",  __('Migration',$this->plugin_prefix),  __('Migration',$this->plugin_prefix), 'read', "inex_migrate", array($this, 'admin_temp'));
			}
			
		}		
		
		function wp_enqueue_scripts(){
			$plugin_url = $this->plugin_url;
			$plugin_vers = $this->plugin_version;
			if($this->is_debug_mode()){
				$plugin_vers = current_time('timestamp');
			}
			wp_enqueue_script('investbox site script', $plugin_url . 'js/inex.js', false, $plugin_vers);
			if($this->get_option('change', 'style') != 1){
				wp_enqueue_style('investbox site style', $plugin_url . 'sitestyle.css', false, $plugin_vers);
			}
		}
		
		function list_tech_pages($pages){
			
			$pages[] = array(
				'post_name'      => 'toinvest',
				'post_title'     => '[en_US:]Invest[:en_US][ru_RU:]Инвестировать[:ru_RU]',
				'post_content'   => '[toinvest]',
				'post_template'   => 'pn-pluginpage.php',
			);
			$pages[] = array(  
				'post_name'      => 'indeposit',
				'post_title'     => '[en_US:]Pay a deposit[:en_US][ru_RU:]Оплатить депозит[:ru_RU]',
				'post_content'   => '[indeposit]',
				'post_template'   => 'pn-pluginpage.php',
			);		
			
			return $pages;
		}		
		
		function icon_indicators($lists){
			$lists['new_deposit'] = __('Request for deposit payout', $this->plugin_prefix);
			return $lists;
		}		
		
		function check_icon(){
			global $wp_admin_bar, $wpdb;
			if(current_user_can('administrator') or current_user_can('pn_investbox')){
				if(function_exists('get_icon_indicators') and get_icon_indicators('new_deposit')){
					$z = $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."inex_deposit WHERE paystatus = '1' AND zakstatus='1' AND vipstatus = '0'");
					if($z > 0){
						$wp_admin_bar->add_menu( array(
							'id'     => 'new_deposit',
							'href' => admin_url('admin.php?page=inex_out&mod=1'),
							'title'  => '<div style="height: 32px; width: 22px; background: url('. $this->plugin_url .'images/pay.png) no-repeat center center"></div>',
							'meta' => array( 'title' => __('Amount of requests for deposit payout', $this->plugin_prefix).' ('. $z .')' )		
						));	
					}	
				}
			}			
		}
		
		function is_system_name($name){
			$name = pn_string($name);
			if (preg_match("/^[a-zA-z0-9_]{1,250}$/", $name, $matches )) {
				return $name;
			} else {
				return false;
			}
		}	
		
		/* инвестировали в ПС */
		function get_in_system($gid){
			global $wpdb;
			
			$gid = $this->is_system_name($gid);
			$s = $wpdb->get_var("SELECT SUM(insumm) FROM ".$wpdb->prefix."inex_deposit WHERE gid='$gid' AND paystatus='1'"); 
			
			return is_sum($s, 2);	
		}

		/* на данный момент на депозитах */
		function get_deposit_system($gid){
			global $wpdb;
			
			$gid = $this->is_system_name($gid);
			$s = $wpdb->get_var("SELECT SUM(insumm) FROM ".$wpdb->prefix."inex_deposit WHERE gid='$gid' AND paystatus='1' AND vipstatus='0'"); 
			
			return is_sum($s, 2);
		}

		/* выплачено из ПС */
		function get_outs_system($gid){
			global $wpdb;
			
			$gid = $this->is_system_name($gid);
			$s = $wpdb->get_var("SELECT SUM(outsumm) FROM ".$wpdb->prefix."inex_deposit WHERE gid='$gid' AND paystatus='1' AND vipstatus='1'"); 
			
			return is_sum($s, 2);
		}

		/* необходимо выплатить */
		function get_pays_system($gid){
			global $wpdb;
			
			$gid = $this->is_system_name($gid);
			$s = $wpdb->get_var("SELECT SUM(outsumm) FROM ".$wpdb->prefix."inex_deposit WHERE gid='$gid' AND paystatus='1' AND vipstatus='0'"); 
			
			return is_sum($s, 2);
		}	

		function get_title_ps_by_id($id){
			$systems = apply_filters('invest_systems', array());
			if(isset($systems[$id]['title'])){
				return $systems[$id]['title'];
			} else {
				return '';
			}
		}

		function get_valut_ps_by_id($id){
			$systems = apply_filters('invest_systems', array());
			if(isset($systems[$id]['valut'])){
				return $systems[$id]['valut'];
			} else {
				return '';
			}	
		}

		function check_ps($id){
			$systems = apply_filters('invest_systems', array());
			$checks = array();
			foreach($systems as $k => $v){
				$checks[] = $k;
			}
			return in_array($id, $checks);
		}		
		
		function summ_pers($summ, $pers){
			if($summ > 0 and $pers > 0){
				return $summ + ($summ / 100 * $pers);
			} else {
				return 0;
			}
		}

		function alter_summ($summ, $pers){
			if($summ > 0 and $pers > 0){
				return round(100 * $summ / (100 - $pers),2);
			} else {
				return round($summ,2);
			}
		}		
		
		function account_list_pages($account_list_pages){
			
			$inex_pages = get_option('inex_pages');
			if(isset($inex_pages['toinvest'])){
				$account_list_pages['toinvest'] = array(
					'title' => get_the_title($inex_pages['toinvest']),
					'url' => get_permalink($inex_pages['toinvest']),
					'type' => 'link',
				);
			}
		
			return $account_list_pages;			
		}
		
	}    
}