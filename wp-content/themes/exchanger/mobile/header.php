<?php if( !defined( 'ABSPATH')){ exit(); } 

$ui = wp_get_current_user();
$user_id = intval($ui->ID);

global $premiumbox, $or_template_directory;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="PalmComputingPlatform" content="true" />
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>
			
	<?php wp_head(); ?>	
	
</head>
<body <?php body_class(); ?>>
<div id="container">
	<?php do_action('pn_header_theme', 'mobile'); ?>
	
	<?php
	$mobile_change = get_theme_option('mobile_change', array('logo','phone','icq','skype','email','linkhead','telegram','viber','whatsup','jabber'));
	?>	
	
	<!-- header -->
	<div class="header">
	
		<a href="#slide_menu" class="js_slide_menu topbar_link menu" title="<?php _e('Menu','pntheme'); ?>"></a>
	
		<div class="logo">
			<div class="logo_ins">
				<?php if($mobile_change['linkhead'] == 1 and !is_front_page() or $mobile_change['linkhead'] != 1){ ?>
					<a href="<?php echo get_site_url_ml(); ?>">
				<?php } ?>
									
					<?php
					$logo = get_mobile_logotype();
					$textlogo = get_mobile_textlogo();
					if($logo){
					?>
						<img src="<?php echo $logo; ?>" alt="" />
					<?php } elseif($textlogo){ ?>
						<?php echo $textlogo; ?>	
					<?php } else { 
						$textlogo = str_replace(array('http://','https://','www.'),'',get_site_url_or()); 
					?>
						<?php echo get_caps_name($textlogo); ?>
					<?php } ?>
									
				<?php if($mobile_change['linkhead'] == 1 and !is_front_page() or $mobile_change['linkhead'] != 1){ ?>	
					</a>
				<?php } ?>
			</div>
		</div>
		
		<a href="#slide_contacts" class="js_slide_menu topbar_link contacts" title="<?php _e('Contacts','pntheme'); ?>"></a>
		
		<?php if(is_ml()){ ?>
			<a href="#slide_lang" class="js_slide_menu topbar_link language" title="<?php _e('Language selection','pntheme'); ?>"></a>
		<?php } ?>		
		
			<div class="clear"></div>
	</div>
	<!-- end header -->		
	
	<div class="wrapper">
	
		<div class="slide_window toleft" id="slide_menu">
			<div class="slide_window_ins">
				
				<div class="logmenu">
					<div class="logmenu_ins">
						<?php 
						if($user_id){ 
						?>
							<a href="<?php echo $premiumbox->get_page('account'); ?>" class="toplink toplink_userlogin"><span><?php echo get_caps_name($ui->user_login); ?></span></a>
							<a href="<?php echo get_ajax_link('logout', 'get'); ?>" class="toplink toplink_exit"><span><?php _e('Exit','pntheme'); ?></span></a>
						<?php } else { ?>
							<a href="<?php echo $premiumbox->get_page('login'); ?>" class="toplink toplink_signin"><span><?php _e('Sign in','pntheme'); ?></span></a>
							<a href="<?php echo $premiumbox->get_page('register'); ?>" class="toplink toplink_signup"><span><?php _e('Sign up','pntheme'); ?></span></a>
						<?php 
						} 
						?>
							<div class="clear"></div>
					</div>	
				</div>
			
				<div class="topmenu">
					<?php
					if($user_id){
						$theme_location = 'mobile_top_menu_user';
						$fallback_cb = 'no_menu';
					} else {
						$theme_location = 'mobile_top_menu';	
						$fallback_cb = 'no_menu';
					}
					wp_nav_menu(array(
						'sort_column' => 'menu_order',
						'container' => 'div',
						'container_class' => 'menu',
						'menu_class' => 'tmenu',
						'menu_id' => '',
						'depth' => '1',
						'fallback_cb' => $fallback_cb,
						'theme_location' => $theme_location
					));	
					?>
						<div class="clear"></div>
				</div>	
			
			</div>	
		</div>	
	
		<?php if(is_ml()){ ?>
			<div class="slide_window toright" id="slide_lang">
				<div class="slide_window_ins">
					<div class="slide_window_abs"></div>
					<div class="slide_window_title"><?php _e('Language selection','pntheme'); ?></div>
				
					<div class="langmenu">
						<ul>
							<?php
							$lang = get_locale();
							$langs = get_langs_ml();
							foreach($langs as $lan){
								$cl = '';
								if($lan == $lang){ $cl = 'current-menu-item';}
							?>
								<li class="<?php echo $cl; ?>">
									<a href="<?php echo lang_self_link($lan); ?>">
										<div class="langlist_liimg">
											<img src="<?php echo get_lang_icon($lan); ?>" alt="" />
										</div>
										<?php echo get_title_forkey($lan); ?>
									</a>
								</li>	
							<?php } ?>
						</ul>
					</div>				
				
				</div>	
			</div>
		<?php } ?>

		<div class="slide_window toright" id="slide_contacts">
			<div class="slide_window_ins">
				<div class="slide_window_abs"></div>
				<div class="slide_window_title"><?php _e('Contacts','pntheme'); ?></div>
			
					<div class="cmenu">
						<ul>
							<?php if($mobile_change['icq']){ ?>
							<li class="icq">
								<span><?php echo pn_strip_input($mobile_change['icq']); ?></span>
							</li>
							<?php } ?>
							<?php if($mobile_change['telegram']){ ?>
							<li class="telegram">
								<span><a href="https://t.me/<?php echo pn_strip_input($mobile_change['telegram']); ?>"><?php echo pn_strip_input($mobile_change['telegram']); ?></a></span>
							</li>
							<?php } ?>
							<?php if($mobile_change['viber']){ ?>
							<li class="viber">
								<span><a href="viber://chat?number=<?php echo pn_strip_input($mobile_change['viber']); ?>"><?php echo pn_strip_input($mobile_change['viber']); ?></a></span>
							</li>		
							<?php } ?>
							<?php if($mobile_change['whatsup']){ ?>
							<li class="whatsup">
								<span><a href="https://api.whatsapp.com/send?phone=<?php echo pn_strip_input($mobile_change['whatsup']); ?>"><?php echo pn_strip_input($mobile_change['whatsup']); ?></a></span>
							</li>		
							<?php } ?>

							<?php if($mobile_change['jabber']){ ?>
							<li class="jabber">
								<span><a href="xmpp:<?php echo pn_strip_input($mobile_change['jabber']); ?>"><?php echo pn_strip_input($mobile_change['jabber']); ?></a></span>
							</li>		
							<?php } ?>				
							
							<?php if($mobile_change['skype']){ ?>
							<li class="skype">
								<span><a href="skype:<?php echo pn_strip_input($mobile_change['skype']); ?>?add" title="<?php _e('Add to skype','pntheme'); ?>"><?php echo pn_strip_input($mobile_change['skype']); ?></a></span>
							</li>		
							<?php } ?>
							
							<?php if($mobile_change['email']){ ?>
							<li class="email">
								<span><a href="mailto:<?php echo antispambot($mobile_change['email']); ?>"><?php echo antispambot($mobile_change['email']); ?></a></span>
							</li>		
							<?php } ?>

							<?php if($mobile_change['phone']){ ?>
							<li class="phone">
								<span><?php echo pn_strip_input($mobile_change['phone']); ?></span>
							</li>		
							<?php } ?>				
						</ul>
					</div>				
			
			</div>	
		</div>	

		<div class="content" id="content_wrap">