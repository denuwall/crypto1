<?php
if( !defined( 'ABSPATH')){ exit(); }

if(!class_exists('PremiumForm')){
	class PremiumForm {
		
		public $version = "0.1";
		private $page_name = '';

		function __construct()
		{

		
		
		}
		
		function prepare_attr($atts){
			
			if(isset($atts['wrap_class'])){ unset($atts['wrap_class']); }
			
			$attr_arr = array();
			foreach($atts as $atts_key => $atts_value){
				$attr_arr[] = $atts_key . '="' . $atts_value . '"';
			}
			
			return join(' ', $attr_arr);
		}
		
		function substrate($text=''){
			echo $this->get_substrate($text);
		}  		
		
		function get_substrate($text=''){
			$temp = '
			<div class="premium_default_window">
				'. $text .'
			</div>';
			
			return $temp;
		}
		
		function select_search($name='', $options = array(), $default='', $atts = array(), $option_styles = array()){
			echo $this->get_select_search($name, $options, $default, $atts, $option_styles);
		}	

		function get_select_search($name='', $options = array(), $default='', $atts = array(), $option_styles = array()){
			$temp = '';
			$name = pn_string($name);
			$options = (array)$options;
			$default = pn_string($default);
			$atts = (array)$atts;
			$option_styles = (array)$option_styles;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
			if(!isset($atts['autocomplete'])){ $atts['autocomplete'] = 'off'; }
			
			$temp .= '<div class="'. $wrap_class .'">';
			$temp .= '<select name="'. $name .'" '. $this->prepare_attr($atts) .'>';
				foreach($options as $option_key => $option_value){
					$bg = '';
					if(isset($option_styles[$option_key])){
						$bg = 'style="'. $option_styles[$option_key] .'"';
					}
					$temp .= '<option value="'. $option_key .'" '. selected($default, $option_key, false) .' '. $bg .'>'. pn_strip_input($option_value) .'</option>';
				}
			$temp .= '</select><input type="search" name="" class="js_select_search premium_input" placeholder="'. __('Search...','premium') .'" value="" />';	
			$temp .= '</div>';		
			
			return $temp;			
		}
		
		function select($name='', $options = array(), $default='', $atts = array(), $option_styles = array()){
			echo $this->get_select($name, $options, $default, $atts, $option_styles);
		}	

		function get_select($name='', $options = array(), $default='', $atts = array(), $option_styles = array()){
			$temp = '';
			$name = pn_string($name);
			$options = (array)$options;
			$default = pn_string($default);
			$atts = (array)$atts;
			$option_styles = (array)$option_styles;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
			if(!isset($atts['autocomplete'])){ $atts['autocomplete'] = 'off'; }
			
			$temp .= '<div class="'. $wrap_class .'">';
			$temp .= '<select name="'. $name .'" '. $this->prepare_attr($atts) .'>';
				foreach($options as $option_key => $option_value){
					$bg = '';
					if(isset($option_styles[$option_key])){
						$bg = 'style="'. $option_styles[$option_key] .'"';
					}
					$temp .= '<option value="'. $option_key .'" '. selected($default, $option_key, false) .' '. $bg .'>'. pn_strip_input($option_value) .'</option>';
				}
			$temp .= '</select>';	
			$temp .= '</div>';		
			
			return $temp;
		}

		function uploader($name='', $default='', $ml=0){
			echo $this->get_uploader($name, $default, $ml);
		}
		
		function get_uploader($name='', $default='', $atts = array(), $ml=''){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$ml = intval($ml);
			$atts = (array)$atts;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(function_exists('is_ml') and is_ml() and $ml == 1){
				
				$langs = get_langs_ml();
				$admin_lang = get_admin_lang();
				$temp .= '
				<div class="multi_wrapper">
					<div class="premium_title_multi">';
						 
						foreach($langs as $key){ 
							$cl = '';
								if($key == $admin_lang){ $cl = 'active'; }
							$temp .= '
							<div name="tab_'. $name .'_'. $key .'" class="tab_multi_title '. $cl .'">
								<div class="tab_multi_flag"><img src="'. get_lang_icon($key) .'" alt="" /></div>
								<span class="tab_multi_flag_name">'. get_title_forkey($key) .'</span>
							</div>';
						} 
						
						$temp .= '
							<div class="premium_clear"></div>
					</div>';		
					
					$value_ml = get_value_ml($default);
					foreach($langs as $key){ 
						$cl = '';
						if($key == $admin_lang){ $cl = 'active'; }
						
						$val = '';
						if(isset($value_ml[$key])){
							$val = $value_ml[$key];
						}
						$temp .= '				
						<div class="premium_wrap_multi '. $cl .'" id="tab_'. $name .'_'. $key .'">
							<div class="'. $wrap_class .'">
								<div class="premium_uploader">
									<div class="premium_uploader_img">
						';
									if($val){ $temp .= '<img src="'. $val .'" alt="" />'; } 
									$temp .= '
									</div>
									<div class="premium_uploader_input">
										<input type="text" name="'. $name.'_'.$key .'" id="pn_'. $name.'_'.$key .'_value" value="'. pn_strip_input($val) .'" />
									</div>
									<div class="premium_uploader_show tgm-open-media" id="pn_'. $name.'_'.$key .'"></div>
									<div class="premium_uploader_hide ';
										if($default){ 
											$temp .= 'act'; 
										} 
									$temp .= '"></div>								 			
									<div class="premium_clear"></div>
								</div>
							</div>
						</div>';
					} 	
				$temp .= '</div>';
				
			} else {
				
				$temp .= '
				<div class="'. $wrap_class .'">
					<div class="premium_uploader">
						<div class="premium_uploader_img">'; 
							if($default){ $temp .= '<img src="'. $default .'" alt="" />'; } 
						$temp .= '
						</div>
						<div class="premium_uploader_input">
								<input type="text" name="'. $name .'" id="pn_'. $name .'_value" value="'. pn_strip_input($default) .'" />
						</div>
						<div class="premium_uploader_show tgm-open-media" id="pn_'. $name .'"></div>
						<div class="premium_uploader_hide ';
							if($default){ 
								$temp .= 'act'; 
							} 
						$temp .= '"></div>
						<div class="premium_clear"></div>
					</div>
				</div>
				';
				
			}			
			return $temp;
		}
		
		function hidden_input($name='', $default=''){
			echo $this->get_hidden_input($name, $default);
		}
		
		function get_hidden_input($name='', $default=''){
			$temp = '<input type="hidden" name="'. $name .'" value="'. pn_strip_input($default) .'" />';
			return $temp;
		}							
		
		function textarea($name='', $default='', $width='', $height='100px', $atts = array(), $ml=0){
			echo $this->get_textarea($name, $default, $width, $height, $atts, $ml);
		}		
		
		function get_textarea($name='', $default='', $width='', $height='100px', $atts = array(), $ml=0){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$ml = intval($ml);
			$atts = (array)$atts;
			if(!$width){ $width = '100%'; }
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }

			if(function_exists('is_ml') and is_ml() and $ml == 1){
				$langs = get_langs_ml();
				$admin_lang = get_admin_lang();	
				
				$temp .= '
				<div class="multi_wrapper">
					<div class="premium_title_multi">';	
						foreach($langs as $key){ 
							$cl = '';
							if($key == $admin_lang){ $cl = 'active'; }
					
							$temp .= '
							<div name="tab_'. $name .'_'. $key .'" class="tab_multi_title '. $cl .'">
								<div class="tab_multi_flag"><img src="'. get_lang_icon($key) .'" alt="" /></div>
								<span class="tab_multi_flag_name">'. get_title_forkey($key) .'</span>
							</div>
							';
						}
				$temp .= '
						<div class="clear_multi_title" title="'. __('Clear field','premium') .'"></div>
						<div class="premium_clear"></div>
					</div>
				';
				
				$value_ml = get_value_ml($default);
				foreach($langs as $key){
					$cl = '';
					if($key == $admin_lang){ $cl = 'active'; }
					
					$val = '';
					if(isset($value_ml[$key])){
						$val = $value_ml[$key];
					}	
					
					$temp .= '
					<div class="premium_wrap_multi '. $cl .'" id="tab_'. $name .'_'. $key .'">
						<div class="'. $wrap_class .'">
							<textarea name="'. $name .'_'. $key .'" style="width: '. $width .'; height: '. $height .';">'. pn_strip_text($val) .'</textarea>
						</div>
					</div>
					';
					
				}
				
				$temp .= '	
				</div>';	
			} else { 
				$default = ctv_ml($default);
				$temp .= '<div class="'. $wrap_class .'">';
				$temp .= '<textarea name="'. $name .'" id="pn_'. $name .'" style="width: '. $width .'; height: '. $height .';">'. pn_strip_text($default) .'</textarea>';
				$temp .= '</div>';		
			} 			
			
			return $temp;
		}
		
		function textareatags($name='', $default='', $tags='', $prefix1='[', $prefix2=']', $width='', $height='100px', $atts = array(), $ml=0){
			echo $this->get_textareatags($name, $default, $tags, $prefix1, $prefix2, $width, $height, $atts, $ml);
		}
		
		function get_textareatags($name='', $default='', $tags='', $prefix1='[', $prefix2=']', $width='', $height='100px', $atts = array(), $ml=0){
			$temp='';
			$name = pn_string($name);
			$default = pn_string($default);
			$ml = intval($ml);
			$atts = (array)$atts;
			
			if(!$width){ $width = '100%'; }
			$tags = (array)$tags;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(function_exists('is_ml') and is_ml() and $ml == 1){
				
				$langs = get_langs_ml();
				$admin_lang = get_admin_lang();		
				$temp .= '
				<div class="multi_wrapper">
					<div class="premium_title_multi">';
						foreach($langs as $key){ 
							$cl = '';
							if($key == $admin_lang){ $cl = 'active'; }
							$temp .= '	
							<div name="tab_'. $name .'_'. $key .'" class="tab_multi_title '. $cl .'">
								<div class="tab_multi_flag"><img src="'. get_lang_icon($key) .'" alt="" /></div>
								<span class="tab_multi_flag_name">'. get_title_forkey($key) .'</span>
							</div>';
						} 	
						$temp .= '		
							<div class="clear_multi_title" title="'. __('Clear field','premium') .'"></div>
								<div class="premium_clear"></div>
						</div>';	 
						$value_ml = get_value_ml($default);
						foreach($langs as $key){ 
							$cl = '';
							if($key == $admin_lang){ $cl = 'active'; }	
							$val = '';
							if(isset($value_ml[$key])){
								$val = $value_ml[$key];
							}	
							$temp .= '	
							<div class="premium_wrap_multi '. $cl .'" id="tab_'. $name .'_'. $key .'">
								<div class="'. $wrap_class .'">
									<div class="prem_tagtext_wrap">
										<div class="prem_tagtext">';
											if(is_array($tags)){						
												foreach($tags as $tag => $value){ 
													$temp .= '
													<span title="'. $prefix1 . trim($tag) . $prefix2 .'">
														<div class="prem_span_hide">'. $prefix1 . trim($tag) . $prefix2 .'</div>
														'. trim($value) .'
													</span>  
													';
												}
											}					
											$temp .= '
												<div class="premium_clear"></div>
										</div>
										<textarea name="'. $name .'_'. $key .'" style="width: '. $width .'; height: '. $height .';">'. pn_strip_text($val) .'</textarea>
									</div>
								</div>		
							</div>';
						} 	
				$temp .= '	
				</div>';
				
			} else { 
			
				$temp .= '
				<div class="'. $wrap_class .'">
				<div class="prem_tagtext_wrap">
					<div class="prem_tagtext">
				';	
					foreach($tags as $tag => $value){ 
						$temp .= '
						<span title="'. $prefix1 . trim($tag) . $prefix2 .'">
							<div class="prem_span_hide">'. $prefix1 . trim($tag) . $prefix2 .'</div>
							'. trim($value) .'
						</span>
						';		
					}						
					$temp .= '
						<div class="premium_clear"></div>
					</div>
					<textarea name="'. $name .'" style="width: '. $width .'; height: '. $height .';">'. pn_strip_text($default) .'</textarea>';
					
				$temp .= '
					</div>
				</div>';	
			}			
				
			return $temp;			
		}	
		
		function input($name='', $default='', $atts = array(), $ml=0){
			echo $this->get_input($name, $default, $atts, $ml);
		}	

		function get_input($name='', $default='', $atts = array(), $ml=0){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$ml = intval($ml);
			$atts = (array)$atts;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(isset($atts['class'])){
				$atts['class'] .= ' premium_input';
			} else {
				$atts['class'] = 'premium_input';
			}
			
			if(function_exists('is_ml') and is_ml() and $ml == 1){
				
				if(isset($atts['id'])){ unset($atts['id']); }
				
				$langs = get_langs_ml();
				$admin_lang = get_admin_lang();
				$temp .= '
				<div class="multi_wrapper">
					<div class="premium_title_multi">
				';
					foreach($langs as $key){ 
						$cl = '';
						if($key == $admin_lang){ $cl = 'active'; }
						$temp .= '
						<div name="tab_'. $name .'_'. $key .'" class="tab_multi_title '. $cl .'">
							<div class="tab_multi_flag"><img src="'. get_lang_icon($key) .'" alt="" /></div>
							<span class="tab_multi_flag_name">'. get_title_forkey($key) .'</span>
						</div>
						';
					}				
				$temp .= '
						<div class="clear_multi_title" title="'. __('Clear field','premium') .'"></div>
							<div class="premium_clear"></div>
					</div>
				';
				
				$value_ml = get_value_ml($default);
				foreach($langs as $key){ 
					$cl = '';
					if($key == $admin_lang){ $cl = 'active'; }	
					$val = '';
					if(isset($value_ml[$key])){
						$val = $value_ml[$key];
					}
					$temp .= '			
					<div class="premium_wrap_multi '. $cl .'" id="tab_'. $name .'_'. $key .'">
						<div class="'. $wrap_class .'">
							<input type="text" name="'. $name .'_'. $key .'" '. $this->prepare_attr($atts) .' value="'. pn_strip_input($val) .'" />
						</div>		
					</div>
					';
				} 				
							
				$temp .= '</div>';	

			} else {
				
				if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
				
				$temp .= '<div class="'. $wrap_class .'">';
				$temp .= '<input type="text" name="'. $name .'" '. $this->prepare_attr($atts) .' value="'. pn_strip_input($default) .'" />';
				$temp .= '</div>';											
			}
			
			return $temp;
		}		
		
		function datetime($name='', $default='', $atts = array()){
			echo $this->get_datetime($name, $default, $atts);
		}
		
		function get_datetime($name='', $default='', $atts = array()){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$atts = (array)$atts;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(isset($atts['class'])){
				$atts['class'] .= ' pn_timepicker premium_input big_input';
			} else {
				$atts['class'] = 'pn_timepicker premium_input big_input';
			}			
			
			if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
			
			if($default){
				$dforv = get_mytime($default,'d.m.Y H:i');
			} else {
				$dforv = date('d.m.Y H:i',current_time('timestamp'));
			}			
			$temp .= '<div class="'. $wrap_class .'">';
			$temp .= '<input type="text" name="'. $name .'" '. $this->prepare_attr($atts) .' value="'. pn_strip_input($dforv) .'" />';
			$temp .= '</div>';			
		
			return $temp;	
		}

		function date($name='', $default='', $atts = array()){
			echo $this->get_date($name, $default, $atts);
		}
		
		function get_date($name='', $default='', $atts = array()){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$atts = (array)$atts;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }
			
			if(isset($atts['class'])){
				$atts['class'] .= ' pn_datepicker premium_input big_input';
			} else {
				$atts['class'] = 'pn_datepicker premium_input big_input';
			}			
			
			if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
			
			if($default){
				$dforv = get_mydate($default,'d.m.Y');
			} else {
				$dforv = date('d.m.Y', current_time('timestamp'));
			}			
			$temp .= '<div class="'. $wrap_class .'">';
			$temp .= '<input type="text" name="'. $name .'" '. $this->prepare_attr($atts) .' value="'. pn_strip_input($dforv) .'" />';
			$temp .= '</div>';			
		
			return $temp;	
		}

		function checkbox($name='', $text='', $value='', $default='', $atts = array()){
			echo $this->get_checkbox($name, $text, $value, $default, $atts);
		}
		
		function get_checkbox($name='', $text='', $value='', $default='', $atts = array()){
			$temp = '';
			$name = pn_string($name);
			$default = pn_string($default);
			$atts = (array)$atts;
			
			$wrap_class = trim(is_isset($atts, 'wrap_class'));
			if(!$wrap_class){ $wrap_class = 'premium_wrap_standart'; }			
			
			if(!isset($atts['id'])){ $atts['id'] = 'pn_'. $name; }
			
			$checked = '';
			if(is_array($default)){
				if(in_array($value, $default)){
					$atts['checked'] = 'checked';
				}		
			} else {
				if($default == $value){
					$atts['checked'] = 'checked';
				}		
			}
									
			$temp .= '<div class="'. $wrap_class .'">';
			$temp .= '<label><input type="checkbox" name="'. $name .'" '. $this->prepare_attr($atts) .' value="'. $value .'" />'. $text .'</label>';
			$temp .= '</div>';			
		
			return $temp;	
		}		
		
		function help($title, $content=''){
			echo $this->get_help($title, $content);
		}
		
		function get_help($title, $content=''){
			$temp = '
			<div class="premium_wrap_help">
				<div class="premium_helptitle"><span>'. $title .'</span></div>
				<div class="premium_helpcontent">'. $content .'</div>
			</div>
			';		
			return $temp;
		}
		
		function warning($content='', $atts=array()){
			echo $this->get_warning($content, $atts);
		}
		
		function get_warning($content='', $atts=array()){
			$temp = '
			<div class="premium_wrap_warning">'. $content .'</div>
			';		
			return $temp;
		}

		function textfield($content='', $atts=array()){
			echo $this->get_textfield($content, $atts);
		}
		
		function get_textfield($content='', $atts=array()){
			$temp = '
			<div class="premium_wrap_standart">'. $content .'</div>
			';		
			return $temp;
		}		

		function h3($title=false, $submit=false, $colspan=2){
			echo $this->get_h3($title, $submit, $colspan);	
		}	

		function get_h3($title=false, $submit=false, $colspan=2){	
			$temp = '<tr><td colspan="'. $colspan .'">';			
			$temp .= '<div class="premium_h3">'. $title .'</div>';
			if($submit){
				$temp .= '<div class="premium_h3submit"><input type="submit" formtarget="_top" name="" class="button" value="'. pn_strip_input($submit) .'" /></div>';
			}			
			$temp .= '<div class="premium_clear"></div></td></tr>';			
			return $temp;
		}	

		function line($colspan=2){
			echo $this->get_line($colspan);		
		}
		
		function get_line($colspan=2){
			$temp = '';
			$temp .= '<tr><td colspan="'. $colspan .'"><div class="premium_line"></div></td></tr>';
			return $temp;
		}		

		function editor($name, $default, $rows, $media, $ml=0){
			$ml = intval($ml);
			if(function_exists('is_ml') and is_ml() and $ml == 1){
 				$langs = get_langs_ml();
				$admin_lang = get_admin_lang();
			?>	
				<div class="multi_wrapper">
					<div class="premium_title_multi">
						<?php 
						foreach($langs as $key){ 
							$cl = '';
							if($key == $admin_lang){ $cl = 'active'; }
						?>
							<div name="tab_<?php echo $name;?>_<?php echo $key; ?>" class="tab_multi_title <?php echo $cl; ?>">
								<div class="tab_multi_flag"><img src="<?php echo get_lang_icon($key); ?>" alt="" /></div>
								<span class="tab_multi_flag_name"><?php echo get_title_forkey($key); ?></span>
							</div>
						<?php } ?>
							<div class="premium_clear"></div>
					</div>		
					<?php 
					$value_ml = get_value_ml($default);
					foreach($langs as $key){ 
						$cl = '';
						if($key == $admin_lang){ $cl = 'active'; }
									
						$val = '';
						if(isset($value_ml[$key])){
							$val = $value_ml[$key];
						}
						?>				
						<div class="premium_wrap_multi <?php echo $cl; ?>" id="tab_<?php echo $name;?>_<?php echo $key; ?>">
							<div class="premium_wrap_standart">
												
								<?php 		
								$settings['wpautop'] = true;
								$settings['media_buttons'] = $media;
								$settings['teeny'] = true;
								$settings['tinymce'] = true;
								$settings['textarea_rows'] = $rows;
								wp_editor(pn_strip_text($val), $name.'_'.$key ,$settings); 
								?>								

							</div>	
						</div>
					<?php } ?>
				</div>				
			<?php 
			} else {
				$default = pn_strip_text(ctv_ml($default));

				echo '<div class="premium_wrap_standart">';
			
				$settings = array();
				$settings['wpautop'] = true;
				$settings['media_buttons'] = $media;
				$settings['teeny'] = true;
				$settings['tinymce'] = true;
				$settings['textarea_rows'] = $rows;
				wp_editor($default,$name,$settings); 	
			
				echo '</div>';		
			}
		}	

		function back_menu($back_menu, $data){
			$page = pn_strip_input(is_param_get('page'));
			$back_menu = apply_filters('pn_admin_back_menu_'.$page, $back_menu, $data);
			$back_menu = (array)$back_menu;
		?>
			<div style="margin: 0 0 10px 0;">
				<?php foreach($back_menu as $item){ 
					$target_html = '';
					$target = intval(is_isset($item, 'target'));
					if($target){
						$target_html = 'target="_blank"';
					}
				?>
					<a href="<?php echo is_isset($item,'link');?>" <?php echo $target_html; ?> class="button"><?php echo is_isset($item,'title');?></a>
				<?php } ?>
					<div class="premium_clear"></div>
			</div>	
		<?php
		}	
		
		function select_box($place, $selects, $title=''){
			?>
			<div class="premium_default_window">
				<?php echo $title; ?> &rarr;
						
				<select name="" onchange="location = this.options[this.selectedIndex].value;" autocomplete="off">
					<?php 
					foreach($selects as $item){ 
						$style = '';
						$background = is_isset($item,'background');
						if($background){
							$style = 'background: '. $background .';';
						}
					?>
						<option value="<?php echo is_isset($item,'link');?>" <?php selected(is_isset($item,'default'), $place);?> style="<?php echo $style; ?>"><?php echo is_isset($item,'title');?></option>
					<?php } ?>
				</select>				
			</div>			
			<?php
		} 		
		
		function error_form($text, $signal='', $back_url=''){
			$back_url = trim($back_url);
			$signal = trim($signal);
			if(!$signal){ $signal = 'error'; }
			$form_method = trim(is_param_post('form_method'));
			if($form_method == 'ajax'){
				$log = array();
				$log['status'] = 'error';
				$log['status_code'] = '1'; 
				$log['status_text']= $text;
				if($back_url){
					$log['url']= $back_url;
				}
				echo json_encode($log);
				exit;				
			} else {
				pn_display_mess($text, $text, $signal);				
			}			
		}
		
		function answer_form($back_url){
			$form_method = trim(is_param_post('form_method'));
			if($form_method == 'ajax'){
				$log = array();
				$log['status'] = 'success';
				$log['status_code'] = '0'; 
				$log['status_text']= '';
				$log['url']= $back_url;
				echo json_encode($log);
				exit;				
			} else {
				wp_safe_redirect($back_url);
				exit;				
			}
		}
		
		function init_form($params=array(), $options=''){
		global $init_page_form;	
			$init_page_form = intval($init_page_form);
			$init_page_form++;
			
			$filter = trim(is_isset($params, 'filter'));
			$method = trim(is_isset($params, 'method'));
			$target = trim(is_isset($params, 'target'));
			$form_target = '';
			if($target == 'blank'){
				$form_target = 'target="_blank"';
			}
			$form_link = trim(is_isset($params, 'form_link'));
			$data = is_isset($params, 'data');
			$template = is_isset($params, 'template');
			if(!is_array($template)){
				$template = array(
					'before' => '<tr class="[class]">',
					'after' => '</tr>',
					'before_title' => '<th>',
					'after_title' => '</th>',
					'before_content' => '<td>',
					'after_content' => '</td>',
					'label' => 1,
				);				
			}		

			$button_title = trim(is_isset($params, 'button_title'));
			if(!$button_title){ $button_title = __('Save','premium'); }
			
			$button_colspan = trim(is_isset($params, 'button_colspan'));
			if(!$button_colspan){ $button_colspan = 2; }
			
			$m = 'post';
			if($method == 'get'){
				$m = 'get';
			}
			
			if(!$form_link){ $form_link = pn_link_post('', $m); }

			if(!is_array($options)){
				$options = array();
			}
			if($filter){
				$options = apply_filters($filter, $options, $data);
			}			

			$options['bottom_title'] = array(
				'view' => 'h3',
				'title' => '',
				'submit' => $button_title,
				'colspan' => $button_colspan,
			);			
			
			$form_m = 'post';
			$form_class = '';
			
			if($method == 'get'){
				$form_m = 'get';				
			}
			if($method == 'ajax'){
				$form_class = 'admin_ajax_form';				
			}			
			
			?>
			<form method="<?php echo $form_m; ?>" class="<?php echo $form_class; ?>" <?php echo $form_target; ?> action="<?php echo $form_link; ?>">
				<input type="hidden" name="form_method" value="<?php echo $method; ?>" />
				<?php wp_referer_field(); ?>
				
				<div class="premium_body">
					<div class="premium_ajax_loader"></div>
					<table class="premium_standart_table">
						<?php $this->form_prepare_options($options, $template); ?>
					</table>
				</div>
			</form>
			<?php
			
			if($init_page_form == 1){
			?>
			<script type="text/javascript">
			jQuery(function($){
				$('.admin_ajax_form').ajaxForm({
					dataType:  'json',
					beforeSubmit: function(a,f,o) {
						f.addClass('thisactive');
						$('.thisactive').find('.premium_ajax_loader').show();
					},
					error: function(res, res2, res3) {
						<?php do_action('pn_js_error_response', 'form'); ?>
					},
					success: function(res) {
						if(res['status'] == 'error'){
							if(res['status_text']){
								$('#premium_reply_wrap').html('<div class="premium_reply theerror js_reply_wrap"><div class="premium_reply_close js_reply_close"></div>'+ res['status_text'] +'</div>');
							}
						}			
						if(res['status'] == 'success'){
							if(res['status_text']){
								$('#premium_reply_wrap').html('<div class="premium_reply thesuccess js_reply_wrap"><div class="premium_reply_close js_reply_close"></div>'+ res['status_text'] +'</div>');
							}
						}			
						if(res['url']){
							window.location.href = res['url']; 
						}
						$('.thisactive').find('.premium_ajax_loader').hide();
						$('.thisactive').removeClass('thisactive');
					}
				});	
			});	 		
			</script>
			<?php
			}
		}

		function set_option_template($data){
			$array = array();
			$template = array(
				'before' => '',
				'after' => '',
				'before_title' => '',
				'after_title' => '',
				'before_content' => '',
				'after_content' => '',
				'label' => '',
			);		
			foreach($template as $key => $val){
				$array[$key] = trim(is_isset($data, $key));
			}
				return $array;
		}		
		
		function form_prepare_options($options, $template){
			$options = (array)$options;
			foreach($options as $option){
				$view = trim(is_isset($option,'view'));
				$title = trim(is_isset($option,'title'));
				$name = trim(is_isset($option,'name'));
				$default = is_isset($option,'default');
				$class = trim(is_isset($option,'class'));
				$ml = intval(is_isset($option,'ml'));
				
				if($view == 'h3'){
					$submit = trim(is_isset($option,'submit'));
					$colspan = trim(is_isset($option,'colspan'));
					$this->h3($title, $submit, $colspan);
				} elseif($view == 'clear_table'){
					?>
					</table>				
				</div>
				<div class="premium_body">
					<table class="premium_standart_table">			
					<?php
				} elseif($view == 'user_func'){
					$func = trim(is_isset($option,'func'));
					$func_data = is_isset($option,'func_data');
					if($func){
						call_user_func($func, $func_data);
					}
				} elseif($view == 'line'){
					$colspan = trim(is_isset($option,'colspan'));
					$this->line($colspan);				
				} elseif($view == 'hidden_input'){
					$this->hidden_input($name, $default);
				} elseif($view == 'editor'){
					$rows = trim(is_isset($option,'rows'));		
					$media = is_isset($option,'media');
					
					$temp = '';			
					$temp .= $template['before'];
					$temp .= $template['before_title'];	
					if($template['label'] and $view != 'help'){	
						$temp .= '<label for="pn_'. $name .'">'. $title .'</label>';
					}	
					$temp .= $template['after_title'];
					$temp .= $template['before_content'];
					echo $temp;
					
					$this->editor($name, $default, $rows, $media, $ml);

					$temp = $template['after_content'];
					$temp .= $template['after'];
					$temp = str_replace("[class]", $class, $temp);
					echo $temp;
				} else {
					$template = $this->set_option_template($template);

					$temp = '';			
					$temp .= $template['before'];
					$temp .= $template['before_title'];	
					if($template['label'] and $view != 'help'){	
						$temp .= '<label for="pn_'. $name .'">'. $title .'</label>';
					}	
					$temp .= $template['after_title'];
					$temp .= $template['before_content'];					
				
					$atts = array();
				
					if($view == 'input'){ /**/
						$not_auto = trim(is_isset($option,'not_auto'));
						if($not_auto == 1){
							$atts['autocomplete'] = 'off';
						}
						$temp .= $this->get_input($name, $default, $atts, $ml);
					} elseif($view == 'inputbig'){ /**/
						$not_auto = trim(is_isset($option,'not_auto'));
						$atts['class'] = 'big_input';
						if($not_auto == 1){
							$atts['autocomplete'] = 'off';
						}		
						$temp .= $this->get_input($name, $default, $atts, $ml);	
					} elseif($view == 'select'){ /**/
						$sel_options = is_isset($option,'options');	
						$temp .= $this->get_select($name, $sel_options, $default, $atts);
					} elseif($view == 'uploader'){ /**/
						$temp .= $this->get_uploader($name, $default, $atts, $ml);						
					} elseif($view == 'help'){ /**/
						$temp .= $this->get_help($title, $default);
					} elseif($view == 'textareatags'){ /**/	
						$tags = is_isset($option,'tags');
						$width = trim(is_isset($option,'width'));
						$height = trim(is_isset($option,'height'));
						$prefix1 = trim(is_isset($option,'prefix1'));
						$prefix2 = trim(is_isset($option,'prefix2'));
						$temp .= $this->get_textareatags($name, $default, $tags, $prefix1, $prefix2, $width, $height, $atts, $ml);	
					} elseif($view == 'textarea'){ /**/
						$width = trim(is_isset($option,'width'));
						$height = trim(is_isset($option,'height'));
						$temp .= $this->get_textarea($name, $default, $width, $height, $atts, $ml);
					} elseif($view == 'datetime'){ /**/
						$atts['autocomplete'] = 'off';
						$temp .= $this->get_datetime($name, $default, $atts);
					} elseif($view == 'date'){ /**/
						$atts['autocomplete'] = 'off';
						$temp .= $this->get_date($name, $default, $atts);						
					} elseif($view == 'select_search'){ /**/
						$sel_options = is_isset($option,'options');
						$temp .= $this->get_select_search($name, $sel_options, $default, $atts);
					} elseif($view == 'select_disabled'){ /**/
						$sel_options = is_isset($option,'options');
						$atts['disabled'] = 'disabled';
						$temp .= $this->get_select($name, $sel_options, $default, $atts);						
					} elseif($view == 'warning'){	 /**/
						$temp .= $this->get_warning($default, $atts);
					} elseif($view == 'textfield'){	 /**/
						$temp .= $this->get_textfield($default, $atts);
					} elseif($view == 'checkbox'){	 /**/
						$second_title = is_isset($option,'second_title');
						$value = is_isset($option,'value');
						$temp .= $this->get_checkbox($name, $second_title, $value, $default, $atts);
					}						
				
					$temp .= $template['after_content'];
					$temp .= $template['after'];
					$temp = str_replace("[class]", $class, $temp);
					echo $temp;
				}
			}
		}
		
		function strip_options($filter, $method='post', $options=''){
			
			$new = array();
			$filter = trim($filter);
			if(!is_array($options)){
				$options = array();
			}	
			if($filter){
				$options = apply_filters($filter, $options, '');
			}	
			foreach($options as $option){
				$name = trim(is_isset($option,'name'));
				$work = trim(is_isset($option,'work'));
				$ml = intval(is_isset($option,'ml'));
				if($name and $work){
					if($ml and is_ml()){
						if($method == 'post'){
							$val = is_param_post_ml($name);
						} else {
							$val = is_param_get_ml($name);
						}
					} else {
						if($method == 'post'){
							$val = is_param_post($name);
						} else {
							$val = is_param_get($name);
						}						
					}		
					if($work == 'int'){
						$new[$name] = intval($val);
					} elseif($work == 'none'){
						$new[$name] = $val;						
					} elseif($work == 'input'){
						$new[$name] = pn_strip_input($val);
					} elseif($work == 'sum'){
						$new[$name] = is_sum($val);				
					} elseif($work == 'text'){
						$new[$name] = pn_strip_text($val);					
					} elseif($work == 'email'){
						$new[$name] = is_email($val);					
					} elseif($work == 'input_array'){
						$new[$name] = pn_strip_input_array($val);
					} elseif($work == 'symbols'){
						$new[$name] = pn_strip_symbols($val);					
					}
				}
			}	
			return $new;
		
		}

		function get_sort_ul($items, $num){
			if(isset($items[$num]) and is_array($items[$num])){
				if(count($items[$num]) > 0){
			?>
			<ul>
				<?php 
				foreach($items[$num] as $item){ 
					$item_id = is_isset($item,'id');
				?>
					<li id="number_<?php echo is_isset($item,'number'); ?>">
						<div class="premium_sort_block"><?php echo is_isset($item,'title');?></div>
							<div class="premium_clear"></div>
							<?php 
							$this->get_sort_ul($items, $item_id); 
							?>					
					</li>		
				<?php 
				} 
				?>
			</ul>
			<?php
				}
			} 
		}		
		
		function sort_one_screen($items, $title=''){
			$title = trim($title);
			if(!$title){ $title = __('Put in the correct order','premium'); }
			?>
			<div class="premium_sort_wrap thesort">
				<div class="premium_sort_title"><?php echo $title; ?></div>
				<?php 
				$this->get_sort_ul($items,0); 
				?>	    
			</div>
			<?php
		}		
		
	}
}