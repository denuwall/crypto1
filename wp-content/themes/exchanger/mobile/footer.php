<?php if( !defined( 'ABSPATH')){ exit(); } 

$mobile_change = get_theme_option('mobile_change', array('ctext'));
?>



		</div>

		<div class="footer">
			<div class="footer_ins">
				<?php if($mobile_change['ctext']){ ?>
					<div class="copyright"><?php echo apply_filters('comment_text', $mobile_change['ctext']); ?></div>
				<?php } ?>
				
				<div class="topped js_to_top"><?php _e('to the top', 'pntheme'); ?></div>

				<a href="<?php echo web_vers_link(); ?>" class="webversion_link"><?php _e('Go to a Original version', 'pntheme'); ?></a>
			</div>
		</div>

	</div>
</div>

<?php do_action('pn_footer_theme', 'mobile'); ?>

<?php wp_footer(); ?>

</body>
</html>