/*
version: 0.1
*/
(function($) {	
	
    var defaults = { 
		id: '',
		div_class: '',
		insert_div: '',
		close_class: '',
		title: '',
		content: '',
		div_content: '',
		scrollContent: '',
		shadow: 1,
		before: function(){ },
		after: function(){ }
	};
	
    var options;
 
    $.fn.JsWindow = function(method, params){
        options = $.extend({}, defaults, options, params);
        var now_obj = $(this);
 
		var id = $.trim(options['id']);
		var div_class = $.trim(options['div_class']);
		var insert_div = $.trim(options['insert_div']);
		if(insert_div.length > 0){
			insert_div = insert_div;
		} else {
			insert_div = 'body';
		}
		var close_class = $.trim(options['close_class']);
		var shadow = $.trim(options['shadow']);
		var title = $.trim(options['title']);
		var content = $.trim(options['content']);
		var div_content = $.trim(options['div_content']);
		if(content.length < 1 && div_content.length > 0){
			content = $(div_content).html();
		}
		var scrollContent = $.trim(options['scrollContent']);
		
		var before_func = options['before'];
		var after_func = options['after'];
 
 		if(method == 'show'){
			
			before_func.apply(null, [now_obj]);
			
			$('.js_techwindow').remove();
			
			if(shadow == 1){
				$(insert_div).append('<div class="standart_shadow js_techwindow"></div>');
				jQuery('.standart_shadow').show();
			}	
			
			var scroll_html = '';
			if(scrollContent.length > 0){
				scroll_html = ''+
				'<div class="standart_window_scrollcontent">' +
					scrollContent +
				'</div>';	
			}
			
			var creating_window = '' +
			'<div class="standart_window '+ div_class +' js_techwindow" id="techwindow_'+ id +'">' +
				'<div class="standart_windowins">' +
					'<div class="standart_window_close '+ close_class +'"></div>' +
					'<div class="standart_window_title">' +
						'<div class="standart_window_title_ins">' +
						title +
						'</div>' +
					'</div>' +
					'<div class="standart_window_content">' +
						'<div class="standart_window_content_ins">' +
							content + 
							'<div class="premium_clear"></div>' +
						'</div>' +
					'</div>' +
					scroll_html +
				'</div>' +
			'</div>';
			
			$(insert_div).append(creating_window);
			
			jQuery('#techwindow_'+ id).show();
			
			var hei = Math.ceil((jQuery(window).height() - jQuery('#techwindow_'+ id).height()) / 2);
			var left = Math.ceil((jQuery(window).width() - jQuery('#techwindow_'+ id).width()) / 2);
			jQuery('#techwindow_'+ id).css({'top': hei, 'left': left});
				
			after_func.apply(null, [now_obj]);	
				
		} else if(method == 'hide'){
			
			before_func.apply(null, [now_obj]);
			$('.js_techwindow').remove();
			after_func.apply(null, [now_obj]);
			
		}
		
		$('.standart_window_close').on('click', function(){
			$('.js_techwindow').remove();
		});
 
        return this;
    };
})(jQuery);