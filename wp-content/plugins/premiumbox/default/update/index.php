<?php
if( !defined( 'ABSPATH')){ exit(); }

global $pn_has_new;
$pn_has_new = get_option('pn_version');

add_action('pn_caps', 'pn_caps_update');
function pn_caps_update($pn_caps){
	$pn_caps['pn_dev_news'] = __('Show developer news','pn');
	return $pn_caps;	
}


add_action('pn_adminpage_js', 'pn_adminpage_js_update');
function pn_adminpage_js_update(){
	$content = '';
	if(pn_has_new()){ 
		$content = apply_filters('comment_text', pn_update_text());
	} else { 
		$content = '<p>'. __('No updates been mades been made','pn') .'</p>';
	} 
?>
	jQuery('.js_pn_version').on('click',function(){
		$(document).JsWindow('show', {
			id: 'update_info',
			div_class: 'update_window',
			title: '<?php _e('Updates','pn'); ?>',
			content: '<?php echo $content; ?>',
			shadow: 1
		});		
	});	
	
	jQuery('.js_dnews_close').on('click',function(){
		var thet = $(this);
		var id = $(this).attr('data-id');
		thet.parents('#devnews_'+id).addClass('close');
		Cookies.set("devnews"+id, 1, { expires: 7, path: '/' });
		
        return false;
    });	
	
	jQuery('.js_dnews_title').on('click',function(){
		$(this).parents('.js_dnews_line').toggleClass('open');
        return false;
    });	
<?php	
}

function pn_has_new(){
global $premiumbox, $pn_has_new;

	$plugin_vers = $premiumbox->plugin_version;
    if(isset($pn_has_new['version']) and version_compare($pn_has_new['version'], $plugin_vers) > 0){
	    return true;
    } else {
	    return false;
	}
}

function pn_update_text(){
global $pn_has_new, $locale;

	$text = '';
	if(isset($pn_has_new['text'])){
		$text = ctv_ml($pn_has_new['text']);
	}
	return $text;
} 

add_action('wp_dashboard_setup', 'update_wp_dashboard_setup_premiumbox' );
function update_wp_dashboard_setup_premiumbox(){
	if(current_user_can('administrator') or current_user_can('pn_dev_news')){
		wp_add_dashboard_widget('standart_update_dashboard_widget_premiumbox', __('News from developer','pn'), 'dashboard_update_in_admin_panel_premiumbox');
	}
}

function dashboard_update_in_admin_panel_premiumbox(){
global $pn_has_new;	
	$news = is_isset($pn_has_new, 'news');
	$r=0;
	if(is_array($news) and count($news) > 0){
		foreach($news as $news_id => $news_value){ $r++;
		?>
			<div class="one_developer_news">
				<div class="one_developer_news_title"><?php echo pn_strip_input(ctv_ml(is_isset($news_value,'title'))); ?></div>
				<div class="one_developer_news_content"><?php echo apply_filters('comment_text',ctv_ml(is_isset($news_value,'text'))); ?></div>
			</div>
		<?php
			if($r==3){ break; }
		}
	}
} 

add_action('pn_adminpage_head','pn_adminpage_head_update', 10, 2);
function pn_adminpage_head_update($page, $prefix){ 
	if($prefix == 'pn'){
		if(pn_has_new()){
	?>
		<div class="update_bigwarning">
			<?php echo apply_filters('comment_text', pn_update_text()); ?>
		</div>
	<?php	
		}
	}
}

add_action('pn_adminpage_head','pn_adminpage_head_developer_news', 10, 2);
function pn_adminpage_head_developer_news($page, $prefix){ 
global $pn_has_new;	
	if($prefix == 'pn'){
		if(current_user_can('administrator') or current_user_can('pn_dev_news')){
			$news = is_isset($pn_has_new, 'news');
			$r=0;
			if(is_array($news) and count($news) > 0){
				foreach($news as $news_id => $news_value){ $r++;
					$close_news = intval(get_pn_cookie('devnews' . $news_id));
				?>
				<div class="head_developer_news js_dnews_line <?php if($close_news == 1){ ?>close<?php } ?>" id="devnews_<?php echo $news_id; ?>">
					<div class="head_developer_news_close js_dnews_close" data-id="<?php echo $news_id; ?>"></div>
					<div class="head_developer_news_title"><span class="js_dnews_title"><?php echo pn_strip_input(ctv_ml(is_isset($news_value,'title'))); ?></span></div>
					<div class="head_developer_news_content"><?php echo apply_filters('comment_text',ctv_ml(is_isset($news_value,'text'))); ?></div>
				</div>
				<?php
					if($r==3){ break; }
				}	
			}
		}
	}
}

add_action('wp_before_admin_bar_render', 'premiumbox_update_icon_admin_bar_render');
function premiumbox_update_icon_admin_bar_render() {
global $wp_admin_bar, $wpdb, $premiumbox;
	
	$plugin_url = get_premium_url();	
    if(is_admin()){
	    if(pn_has_new()){
			$wp_admin_bar->add_menu( array(
				'id'     => 'new_pn_version',
				'href' => '#',
				'title'  => '<div style="height: 32px; width: 22px; background: url('. $plugin_url .'images/update.png) no-repeat center center"></div>',
				'meta' => array( 'title' => __('Update available','pn'), 'class' => 'js_pn_version' )		
			));	
		}		
	}
}  

add_filter('list_cron_func', 'premiumbox_update_list_cron_func');
function premiumbox_update_list_cron_func($filters){
global $premiumbox;	

	if(!$premiumbox->is_up_mode()){
		$filters['premiumbox_chkv'] = array(
			'title' => __('Check updates','pn'),
			'site' => '1day',
		);
	}
	
	return $filters;
}