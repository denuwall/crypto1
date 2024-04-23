<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]Warning messages in header[:en_US][ru_RU:]Уведомление в шапке[:ru_RU]
description: [en_US:]Warning messages column marked in red located in header[:en_US][ru_RU:]Блок уведомления на красном фоне в шапке сайта[:ru_RU]
version: 1.5
category: [en_US:]Security[:en_US][ru_RU:]Безопасность[:ru_RU]
cat: secur
dependent: operator
*/

$path = get_extension_file(__FILE__);
$name = get_extension_name($path);

add_action('pn_moduls_active_'.$name, 'bd_pn_moduls_active_noticehead');
function bd_pn_moduls_active_noticehead(){
global $wpdb;
	
	$table_name = $wpdb->prefix ."notice_head";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',
		`notice_type` int(1) NOT NULL default '0',
		`notice_display` int(1) NOT NULL default '0',
		`datestart` datetime NOT NULL,
		`dateend` datetime NOT NULL,
		`op_status` int(5) NOT NULL default '-1',
		`h1` varchar(5) NOT NULL default '0',
		`m1` varchar(5) NOT NULL default '0',
		`h2` varchar(5) NOT NULL default '0',
		`m2` varchar(5) NOT NULL default '0',		
		`d1` int(1) NOT NULL default '0',
		`d2` int(1) NOT NULL default '0',
		`d3` int(1) NOT NULL default '0',
		`d4` int(1) NOT NULL default '0',
		`d5` int(1) NOT NULL default '0',
		`d6` int(1) NOT NULL default '0',
		`d7` int(1) NOT NULL default '0',
        `url` longtext NOT NULL,
		`text` longtext NOT NULL,
		`status` int(1) NOT NULL default '0',
		`theclass` varchar(250) NOT NULL,
		`site_order` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."notice_head LIKE 'notice_display'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."notice_head ADD `notice_display` int(1) NOT NULL default '0'");
	}	
        	
}

add_action('pn_bd_activated', 'bd_pn_moduls_migrate_noticehead');
function bd_pn_moduls_migrate_noticehead(){
global $wpdb;

	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."notice_head LIKE 'notice_display'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."notice_head ADD `notice_display` int(1) NOT NULL default '0'");
	}	
	
}

add_filter('pn_caps','noticehead_pn_caps');
function noticehead_pn_caps($pn_caps){
	$pn_caps['pn_noticehead'] = __('Warning messages in header','pn');
	return $pn_caps;
}

add_action('admin_menu', 'pn_adminpage_noticehead');
function pn_adminpage_noticehead(){
global $premiumbox;	
	if(current_user_can('administrator') or current_user_can('pn_noticehead')){
		$hook = add_menu_page(__('Warning messages','pn'), __('Warning messages','pn'), 'read', 'pn_noticehead', array($premiumbox, 'admin_temp'), $premiumbox->get_icon_link('icon'));  
		add_action( "load-$hook", 'pn_trev_hook' );
		add_submenu_page("pn_noticehead", __('Add','pn'), __('Add','pn'), 'read', "pn_add_noticehead", array($premiumbox, 'admin_temp'));	
		add_submenu_page("pn_noticehead", __('Sort','pn'), __('Sort','pn'), 'read', "pn_sort_noticehead", array($premiumbox, 'admin_temp'));	
	}
}

add_action('pn_header_theme','pn_header_theme_noticehead');
function pn_header_theme_noticehead(){
global $wpdb;

	$notice_lists = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."notice_head WHERE status='1' AND auto_status = '1' ORDER BY site_order ASC");
	foreach($notice_lists as $notice){
		$text = pn_strip_text(ctv_ml($notice->text));
		$url = pn_strip_input(ctv_ml($notice->url));
		$status = get_noticehead_status($notice);
 		$closest = intval(get_pn_cookie('hnotice'.$notice->id));
		$r=0;
		if($closest != 1 and $status == 1){
			$cl = '';
			$theclass = pn_strip_input($notice->theclass);
			if($theclass){
				$cl = ' '.$theclass;
			}
			$notice_display = intval($notice->notice_display);
			if($notice_display == 0){
	?>	
	<div class="wclosearea <?php echo $cl; ?> js_hnotice" id="hnotice_<?php echo $notice->id; ?>">
		<div class="wclosearea_ins">
			<div class="wclosearea_hide js_hnotice_close"><div class="wclosearea_hide_ins"></div></div>
			<div class="wclosearea_text">
				<div class="wclosearea_text_ins">
					<?php if($url){ ?><a href="<?php echo $url; ?>"><?php } ?>
						<?php echo $text; ?>
					<?php if($url){ ?></a><?php } ?>
				</div>	
			</div>
		</div>
	</div>
	<?php 
			} else { $r++;
				if($r==1){
	?>
	<div class="js_wc_<?php echo $notice->id; ?>" style="display: none;">
		<?php if($url){ ?><a href="<?php echo $url; ?>"><?php } ?>
			<?php echo $text; ?>
		<?php if($url){ ?></a><?php } ?>
	</div>
	
	<script type="text/javascript">
	jQuery(function($){
		$(document).JsWindow('show', {
			id: 'wc_<?php echo $notice->id; ?>',
			div_class: 'wc_window',
			close_class: 'js_hnotice_window_close',
			title: '<?php _e('Attention!','pn'); ?>!',
			div_content: '.js_wc_<?php echo $notice->id; ?>',
			shadow: 1
		});		
	});
	</script>
	
	<?php
				}
			}
		}
	} 
	
} 

add_action('siteplace_js','siteplace_js_noticehead');
function siteplace_js_noticehead(){	
?>	 
jQuery(function($){ 
    $(document).on('click', '.js_hnotice_close', function(){
		
		var thet = $(this);
		var id = $(this).parents('.js_hnotice').attr('id').replace('hnotice_','');
		thet.addClass('active');
		
		Cookies.set("hnotice"+id, 1, { expires: 7, path: '/' });
		
		$('#hnotice_' + id).hide();
		thet.removeClass('active');
 
    });
	
    $(document).on('click', '.js_hnotice_window_close', function(){
		
		var thet = $(this);
		var id = $(this).parents('.wc_window').attr('id').replace('techwindow_wc_','');
		
		Cookies.set("hnotice"+id, 1, { expires: 7, path: '/' });
 
    });	
});	
<?php	
} 

global $premiumbox;
$premiumbox->include_patch(__FILE__, 'add');
$premiumbox->include_patch(__FILE__, 'list');
$premiumbox->include_patch(__FILE__, 'sort');
$premiumbox->include_patch(__FILE__, 'cron');