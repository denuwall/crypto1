<?php if( !defined( 'ABSPATH')){ exit(); } 

$ui = wp_get_current_user();
$user_id = intval($ui->ID);

global $premiumbox, $or_template_directory;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>

	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>
<div id="container">

	<?php do_action('pn_header_theme'); ?>
	
	<?php
	$h_change = get_theme_option('h_change', array('fixheader','phone','icq','skype','email','linkhead','telegram','viber','whatsup','jabber'));
	?>

	<!-- top bar -->
	<div class="topbar_wrap" <?php if($h_change['fixheader'] == 1){ ?>id="fix_div"<?php } ?>>
		<div class="topbar_ins" <?php if($h_change['fixheader'] == 1){ ?>id="fix_elem"<?php } ?>>
			<div class="topbar">
			
				<?php the_lang_list('tolbar_lang'); ?>
			
				<?php if($h_change['icq']){ ?>
					<div class="topbar_icon icq">
						<?php echo pn_strip_input($h_change['icq']); ?>
					</div>		
				<?php } ?>
				
				<?php if($h_change['telegram']){ ?>
					<div class="topbar_icon telegram">
						<a href="https://t.me/<?php echo pn_strip_input($h_change['telegram']); ?>"><?php echo pn_strip_input($h_change['telegram']); ?></a>
					</div>		
				<?php } ?>

				<?php if($h_change['viber']){ ?>
					<div class="topbar_icon viber">
						<a href="viber://chat?number=<?php echo pn_strip_input($h_change['viber']); ?>"><?php echo pn_strip_input($h_change['viber']); ?></a>
					</div>		
				<?php } ?>

				<?php if($h_change['whatsup']){ ?>
					<div class="topbar_icon whatsup">
						<a href="https://api.whatsapp.com/send?phone=<?php echo pn_strip_input($h_change['whatsup']); ?>"><?php echo pn_strip_input($h_change['whatsup']); ?></a>
					</div>		
				<?php } ?>

				<?php if($h_change['jabber']){ ?>
					<div class="topbar_icon jabber">
						<a href="xmpp:<?php echo pn_strip_input($h_change['jabber']); ?>"><?php echo pn_strip_input($h_change['jabber']); ?></a>
					</div>		
				<?php } ?>				
				
				<?php if($h_change['skype']){ ?>
					<div class="topbar_icon skype">
						<a href="skype:<?php echo pn_strip_input($h_change['skype']); ?>?add" title="<?php _e('Add to skype','pntheme'); ?>"><?php echo pn_strip_input($h_change['skype']); ?></a>
					</div>		
				<?php } ?>
				
				<?php if($h_change['email']){ ?>
					<div class="topbar_icon email">
						<a href="mailto:<?php echo antispambot($h_change['email']); ?>"><?php echo antispambot($h_change['email']); ?></a>
					</div>		
				<?php } ?>

				<?php if($h_change['phone']){ ?>
					<div class="topbar_phone">
						<?php echo pn_strip_input($h_change['phone']); ?>
					</div>		
				<?php } ?>				
			
				<?php if($user_id){ ?>
					<a href="<?php echo get_ajax_link('logout', 'get'); ?>" class="toplink toplink_exit"><?php _e('Exit','pntheme'); ?></a>
					<a href="<?php echo $premiumbox->get_page('account'); ?>" class="toplink toplink_userlogin"><?php echo get_caps_name($ui->user_login); ?></a>
				<?php } else { ?>
					<a href="<?php echo $premiumbox->get_page('register'); ?>" class="toplink toplink_signup"><?php _e('Sign up','pntheme'); ?></a>
					<a href="<?php echo $premiumbox->get_page('login'); ?>" class="toplink toplink_signin"><?php _e('Sign in','pntheme'); ?></a>
				<?php } ?>
			
					<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- end top bar -->

	<!-- top menu -->
	<div class="tophead_wrap" <?php if($h_change['fixheader'] == 2){ ?>id="fix_div"<?php } ?>>
		<div class="tophead_ins" <?php if($h_change['fixheader'] == 2){ ?>id="fix_elem"<?php } ?>>
			<div class="tophead">
			
				<div class="logoblock">
					<div class="logoblock_ins">
						<?php if($h_change['linkhead'] == 1 and !is_front_page() or $h_change['linkhead'] != 1){ ?>
							<a href="<?php echo get_site_url_ml(); ?>">
						<?php } ?>
							
							<?php
							$logo = get_logotype();
							$textlogo = get_textlogo();
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
							
						<?php if($h_change['linkhead'] == 1 and !is_front_page() or $h_change['linkhead'] != 1){ ?>	
							</a>
						<?php } ?>	
					</div>
				</div>
				
				<div class="topmenu">
					<?php
					if($user_id){
						$theme_location = 'the_top_menu_user';
						$fallback_cb = 'no_menu_standart';
					} else {
						$theme_location = 'the_top_menu';	
						$fallback_cb = 'no_menu';
					}
					wp_nav_menu(array(
						'sort_column' => 'menu_order',
						'container' => 'div',
						'container_class' => 'menu',
						'menu_class' => 'tmenu js_menu',
						'menu_id' => '',
						'depth' => '3',
						'fallback_cb' => $fallback_cb,
						'theme_location' => $theme_location
					));					
					?>				
					<div class="clear"></div>
				</div>
					<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- end top menu -->

	<div class="wrapper">
	
		<?php if(!is_front_page()){ ?>
		<div class="breadcrumb_wrap">
			<div class="breadcrumb_div">
				<div class="breadcrumb_ins" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			
					<h1 class="breadcrumb_title" id="the_title_page" itemprop="title">
						<?php if(is_category() or is_tag() or is_tax()){ ?>
							<?php single_term_title(); ?>
						<?php } elseif(is_404()){ ?>
							<?php _e('Error 404','pntheme'); ?>
						<?php } elseif(is_home()){ ?>
							<?php _e('News','pntheme'); ?>
						<?php } elseif(function_exists('is_exchange_page') and is_exchange_page()) { 
							echo get_exchange_title();	 				
						?>
						<?php } else { 
							if(function_exists('is_exchangestep_page') and is_exchangestep_page()){
								echo get_exchangestep_title();
							} else {
								the_title();
							}
							?>
						<?php } ?>
					</h1>
			
					<div class="breadcrumb">
						<?php the_breadcrumb(); ?>
					</div>
			
				</div>
			</div>
		</div>	
		<?php } ?>	
		
		<?php if(!is_front_page()){ ?>	
		<div class="contentwrap">
			<?php if(!is_page_template('pn-notsidebar.php')){ ?>
			<div class="thecontent">
			<?php } ?>
		<?php } ?>		