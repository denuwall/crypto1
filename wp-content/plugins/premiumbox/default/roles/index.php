<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!function_exists('admin_menu_roles')){
	add_action('admin_menu', 'admin_menu_roles');
	function admin_menu_roles(){
	global $premiumbox;
		$hook = add_menu_page(__('User roles','pn'), __('User roles','pn'), 'administrator', "pn_roles", array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('roles') , 70);
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_roles", __('Add user role','pn'), __('Add user role','pn'), 'administrator', "pn_add_roles", array($premiumbox, 'admin_temp'));
		add_submenu_page("pn_roles", __('User role settings','pn'), __('User role settings','pn'), 'administrator', "pn_setting_roles", array($premiumbox, 'admin_temp'));
	}
	
	function is_user_role_name($name){
		if(preg_match("/^[a-zA-z0-9]{3,30}$/", $name)){
			$name = strtolower($name);
		} else {
			$name = '';
		}
		return $name;		
	}
	
	function get_pn_capabilities(){
		$pn_caps = array(
			'read' => __('Access to admin panel','pn'),
			'edit_dashboard' => __('Edit dashboard','pn'),
			'switch_themes' => __('Switch themes','pn'),
			'edit_theme_options'=> __('Edit theme options','pn'),
			'activate_plugins'=> __('Activate plugins','pn'),
			'list_users' => __('User list','pn'), 
			'add_users' => __('Add users','pn'),
			'create_users' => __('Add users','pn'),
			'edit_users' => __('Edit users','pn'),
			'remove_users' => __('Remove users','pn'),
			'delete_users' => __('Delete users','pn'),
			'upload_files' => __('Upload files','pn'),
			'edit_files' => __('Edit files','pn'),
			'unfiltered_upload' => __('Unfiltered upload','pn'),
			'unfiltered_html' => __('Unfiltered HTML','pn'),
			'edit_posts' => __('Edit posts and images','pn'),
			'edit_others_posts' => __('Edit others posts and images','pn'),		
			'edit_published_posts' => __('Edit published posts','pn'),
			'publish_posts' => __('Publish posts','pn'),
			'delete_posts' => __('Delete posts','pn'),
			'delete_others_posts' => __('Delete other posts','pn'),
			'delete_published_posts' => __('Delete published posts','pn'),		
			'edit_pages' => __('Edit pages','pn'),
			'edit_others_pages' => __('Edit other pages','pn'),
			'edit_published_pages' => __('Edit published pages','pn'),
			'publish_pages' => __('Publish pages','pn'),
			'delete_pages' => __('Delete pages','pn'),
			'delete_others_pages' => __('Delete other pages','pn'),
			'delete_published_pages' => __('Delete published pages','pn'),

			// 'delete_plugins' => 'Удалять плагины', 
			// 'delete_private_pages' => 'Удалять частные страницы',
			// 'delete_private_posts' => 'Удалять частные статьи',
			// 'delete_themes' => 'Удалять темы',
			// 'edit_plugins' => 'Редактировать плагины',
			// 'edit_private_pages' => 'Редактировать частные страницы',
			// 'edit_private_posts' => 'Редактировать частные статьи',
			// 'edit_themes' => 'Изменять темы',
			// 'export' => 'Экспорт',
			// 'import' => 'Импорт',
			// 'install_plugins' => 'Устанавливать плагины',
			// 'install_themes' => 'Устанавливать темы',
			// 'manage_categories' => 'Управление категориями',
			// 'manage_links' => 'Управление ссылками',
			// 'manage_options' => 'Управление установками',
			// 'moderate_comments' => 'Модерировать комментарии',
			// 'promote_users' => 'Продвигать пользователей',
			// 'read_private_pages' => 'Читать частные страницы',
			// 'read_private_posts' => 'Читать частные статьи',
			// 'update_core' => 'Обновлять ядро',
			// 'update_plugins' => 'Обновлять плагины',
			// 'update_themes' => 'Обновлять темы'
			
			'pn_change_notify' => __('Work with notify templates','pn'),
			'pn_test_cron' => __('Test cron tasks','pn'),
		);
		$pn_caps = apply_filters('pn_caps',$pn_caps);
		$pn_caps = (array)$pn_caps;
		return $pn_caps;
	}	
	
	global $premiumbox;
	$premiumbox->include_patch(__FILE__, 'list');
	$premiumbox->include_patch(__FILE__, 'add');
	$premiumbox->include_patch(__FILE__, 'settings');
}