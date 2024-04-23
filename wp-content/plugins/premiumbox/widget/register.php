<?php
class pn_register_Widget extends WP_Widget {
	
 	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('get_pn_register', __('Sign up','pn'), $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);

		global $wpdb, $premiumbox;	
		
		$ui = wp_get_current_user();
		$user_id = intval($ui->ID);
		
		if(!$user_id){
		
			if(is_ml()){
				$lang = get_locale();
				$title_widget = pn_strip_input(is_isset($instance,'title'.$lang));
			} else {
				$title_widget = pn_strip_input(is_isset($instance,'title'));	
			}
			if(!$title_widget){ $title_widget = __('Sign up','pn'); }
		
			$items = get_register_form_filelds('widget');
			$html = prepare_form_fileds($items, 'widget_register_form_line', 'widget_reg');			
	
			$array = array(
				'[form]' => '<form method="post" class="ajax_post_form" action="'. get_ajax_link('registerform') .'">',
				'[/form]' => '</form>',
				'[result]' => '<div class="resultgo"></div>',
				'[html]' => $html,
				'[submit]' => '<input type="submit" formtarget="_top" name="submit" class="widget_reg_submit" value="'. __('Sign up', 'pn') .'" />',
				'[toslink]' => $premiumbox->get_page('tos'),
				'[loginlink]' => $premiumbox->get_page('login'),
				'[lostpasslink]' => $premiumbox->get_page('lostpass'),
				'[return_link]' => '<input type="hidden" name="return_url" value="'. esc_url(pn_strip_input(is_param_get('return_url'))) .'" />',
				'[agreement]' => '<label><input type="checkbox" name="rcheck" value="1" /> '. sprintf(__('I read and agree with <a href="%s" target="_blank">the terms and conditions</a>','sa'), $premiumbox->get_page('terms') ) .'</label>',
				'[title]' => $title_widget,
			);	
	
			$temp_form = '
			<div class="register_widget">
				<div class="register_widget_ins">
					[form]
						[return_link]
						
						<div class="register_widget_title">
							<div class="register_widget_title_ins">
								[title]
							</div>
						</div>
						
						[result]
				
						<div class="register_widget_body">
							<div class="register_widget_body_ins">
							
								[html]
								
								<div class="widget_reg_line">
									[agreement]
								</div>
								
								<div class="widget_reg_line_subm">
									[submit]
								</div>				
		 
							</div>
						</div>

					[/form]
				</div>	
			</div>
			';
	
			$temp_form = apply_filters('widget_register_form_temp',$temp_form);
			echo get_replace_arrays($array, $temp_form);			
		}
	
	}


	public function form($instance){ 

	?>
		<?php if(is_ml()){ 
			$langs = get_langs_ml();
			foreach($langs as $key){
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title_'.$key); ?>"><?php _e('Title'); ?> (<?php echo get_title_forkey($key); ?>): </label><br />
			<input type="text" name="<?php echo $this->get_field_name('title'.$key); ?>" id="<?php $this->get_field_id('title'.$key); ?>" class="widefat" value="<?php echo is_isset($instance,'title'.$key); ?>">
		</p>		
			<?php } ?>
		
		<?php } else { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>: </label><br />
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" class="widefat" value="<?php echo is_isset($instance,'title'); ?>">
		</p>
		<?php } ?>
	
	<?php

	}  
}

register_widget('pn_register_Widget');