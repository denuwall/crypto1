<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('PremiumBox')){
	class PremiumBox extends Premium {
		
		function __construct($debug_mode=0)
		{
		
			$this->debug_constant_name = 'PN_RICH_TEST';
			$this->plugin_version = '1.5';
			$this->plugin_name = 'Premium Exchanger';
			$this->plugin_path = PN_PLUGIN_NAME;
			$this->plugin_dir = PN_PLUGIN_DIR;
			$this->plugin_url = PN_PLUGIN_URL;
			$this->plugin_prefix = 'pn';
			$this->plugin_option_name = 'pn_options';
			$this->plugin_page_name = 'the_pages';
			$this->plugin_usersess_day = PN_USERSESS_DAY;
			
			parent::__construct($debug_mode);
			
			add_filter('all_plugins', array($this, 'title_this_plugin'));

			add_action('init', array($this,'deprecated_pages')); /* off 2.0 */
			
			add_filter('query_vars', array($this, 'query_vars'));
			add_filter('generate_rewrite_rules', array($this, 'generate_rewrite_rules'));
			
			if($this->is_debug_mode()){
				add_action('wp_footer', array($this,'mobile_test_wp_footer'));
			}
		}

		public function title_this_plugin($plugins){
			global $locale;	
				
			$plugin_path = $this->plugin_path;	
				
			if($locale == 'ru_RU'){
				$name = 'Premium Exchanger';
				$description = 'Профессиональный обменный пункт';
					
				$plugins[$plugin_path]['Name'] = $name;
				$plugins[$plugin_path]['Description'] = $description;	
			} 	
				
			return $plugins;
		}

		public function deprecated_pages(){
			
			$plugin = basename($this->plugin_path,'.php');
			$wp_content = ltrim(str_replace(ABSPATH,'',WP_CONTENT_DIR),'/');
			
			add_rewrite_rule('blackping.html$', $wp_content . '/plugins/'.$plugin.'/sitepage/blackping.php', 'top');
			add_rewrite_rule('curscron.html$', $wp_content . '/plugins/'. $plugin .'/sitepage/curscron.php', 'top');
			add_rewrite_rule('sitemap.xml$', $wp_content . '/plugins/'.$plugin.'/sitepage/sitemap.php', 'top');
			add_rewrite_rule('exportxml.xml$', $wp_content .'/plugins/'.$plugin.'/sitepage/exportxml.php', 'top');
			add_rewrite_rule('exporttxt.txt$', $wp_content .'/plugins/'.$plugin.'/sitepage/exporttxt.php', 'top');
			 
		}	

		public function admin_menu(){ 
			
			add_submenu_page("index.php", __('Migration', $this->plugin_prefix), __('Migration', $this->plugin_prefix), 'administrator', "pn_migrate", array($this, 'admin_temp'));
			if(current_user_can('administrator') or current_user_can('pn_change_notify')){
				add_menu_page(__('Message settings', $this->plugin_prefix), __('Message settings', $this->plugin_prefix), 'read', 'pn_mail_temps', array($this, 'admin_temp'), $this->get_icon_link('mails'));
				add_submenu_page("pn_mail_temps", __('E-mail templates', $this->plugin_prefix), __('E-mail templates', $this->plugin_prefix), 'read', "pn_mail_temps", array($this, 'admin_temp'));
				add_submenu_page("pn_mail_temps", __('SMS templates', $this->plugin_prefix), __('SMS templates', $this->plugin_prefix), 'read', "pn_sms_temps", array($this, 'admin_temp'));
			}
			
			add_menu_page(__('Exchange office settings', $this->plugin_prefix), __('Exchange office settings', $this->plugin_prefix), 'administrator', 'pn_config', array($this, 'admin_temp'), $this->get_icon_link('settings'));
			add_submenu_page("pn_config", __('General settings', $this->plugin_prefix), __('General settings', $this->plugin_prefix), 'administrator', "pn_config", array($this, 'admin_temp'));
			add_menu_page(__('Theme settings', $this->plugin_prefix), __('Theme settings', $this->plugin_prefix), 'administrator', 'pn_themeconfig', array($this, 'admin_temp'), $this->get_icon_link('theme'));
			
			$hook = add_menu_page(__('Merchants', $this->plugin_prefix), __('Merchants', $this->plugin_prefix), 'administrator', 'pn_merchants', array($this, 'admin_temp'), $this->get_icon_link('merchants'));
			add_action( "load-$hook", 'pn_trev_hook' );
			
			$hook = add_menu_page(__('Modules', $this->plugin_prefix), __('Modules', $this->plugin_prefix), 'administrator', 'pn_moduls', array($this, 'admin_temp'), $this->get_icon_link('moduls'));
			add_action( "load-$hook", 'pn_trev_hook' );
			
		}	

		public function list_tech_pages($pages){
			 
			$pages[] = array(
				'post_name'      => 'home',
				'post_title'     => '[en_US:]Home[:en_US][ru_RU:]Главная[:ru_RU]',
				'post_content'   => '',
				'post_template'   => 'pn-homepage.php',
			);
			$pages[] = array(
				'post_name'      => 'news',
				'post_title'     => '[en_US:]News[:en_US][ru_RU:]Новости[:ru_RU]',
				'post_content'   => '',
				'post_template'   => '',
			);	
			$pages[] = array( 
				'post_name'      => 'tos',
				'post_title'     => '[en_US:]Rules[:en_US][ru_RU:]Правила сайта[:ru_RU]',
				'post_content'   => '',
				'post_template'   => '',
			);	
			$pages[] = array( 
				'post_name'      => 'notice',
				'post_title'     => '[en_US:]Warning messages[:en_US][ru_RU:]Предупреждение[:ru_RU]',
				'post_content'   => '',
				'post_template'   => '',
			);				
			$pages[] = array(
				'post_name'      => 'login',
				'post_title'     => '[en_US:]Authorization[:en_US][ru_RU:]Авторизация[:ru_RU]',
				'post_content'   => '[login_page]',
				'post_template'   => 'pn-pluginpage.php',
			);
			$pages[] = array(
				'post_name'      => 'register',
				'post_title'     => '[en_US:]Register[:en_US][ru_RU:]Регистрация[:ru_RU]',
				'post_content'   => '[register_page]',
				'post_template'   => 'pn-pluginpage.php',
			);
			$pages[] = array(
				'post_name'      => 'lostpass',
				'post_title'     => '[en_US:]Password recovery[:en_US][ru_RU:]Восстановление пароля[:ru_RU]',
				'post_content'   => '[lostpass_page]',
				'post_template'   => 'pn-pluginpage.php',
			);
			$pages[] = array(
				'post_name'      => 'account',
				'post_title'     => '[en_US:]Personal account[:en_US][ru_RU:]Личный кабинет[:ru_RU]',
				'post_content'   => '[account_page]',
				'post_template'   => 'pn-pluginpage.php',
			);	
			$pages[] = array(
				'post_name'      => 'security',
				'post_title'     => '[en_US:]Security settings[:en_US][ru_RU:]Настройки безопасности[:ru_RU]',
				'post_content'   => '[security_page]',
				'post_template'   => 'pn-pluginpage.php',
			);								
			$pages[] = array(
				'post_name'      => 'exchange',
				'post_title'     => '[en_US:]Exchange[:en_US][ru_RU:]Обмен[:ru_RU]',
				'post_content'   => '[exchange]',
				'post_template'   => 'pn-pluginpage.php',
			);	
			$pages[] = array(
				'post_name'      => 'hst',
				'post_title'     => '[en_US:]Exchange - steps[:en_US][ru_RU:]Обмен - шаги[:ru_RU]',
				'post_content'   => '[exchangestep]',
				'post_template'   => 'pn-pluginpage.php',
			);		
			
			return $pages;
		}		
		
		
		public function query_vars( $query_vars ){
			$query_vars[] = 'pnhash';
			$query_vars[] = 'hashed';

			return $query_vars;
		}

		public function general_tech_pages(){
			$g_pages = array(
				'exchange' => 'exchange_',
				'hst' => 'hst_',
			);
			
			return apply_filters('general_tech_pages', $g_pages, 'premiumbox');			
		}		
		
		public function generate_rewrite_rules($wp_rewrite) {
			
			$g_pages = $this->general_tech_pages();
			$rewrite_rules = array (
				$g_pages['exchange'] .'([\-_A-Za-z0-9]+)$' => 'index.php?pagename=exchange&pnhash=$matches[1]',
				$g_pages['hst'] .'([A-Za-z0-9]{35})$' => 'index.php?pagename=hst&hashed=$matches[1]',
			);
			$wp_rewrite->rules = array_merge($rewrite_rules, $wp_rewrite->rules);
		
		}		
		
  		public function mobile_test_wp_footer(){
			if(function_exists('mobile_vers_link')){
				if(is_mobile()){
			?>
					<div style="padding: 10px 0; text-align: center;"><a href="<?php echo web_vers_link(); ?>">Web version only</a></div>
			<?php
				} else {
			?>
					<div style="padding: 10px 0; text-align: center;"><a href="<?php echo mobile_vers_link(); ?>">Mobile version only</a></div>
			<?php
				}
			}
		}		
	}    
}