jQuery(function($){

	var default_params = {  
		class_with_img: '.imager',
		class_not_img: '.js_my_sel',
	};
    $.fn.Jselect = function(params){
        var options = $.extend({}, default_params, params);
 
		$('select'+ options.class_not_img +':not(.jsw)').hide();
		$('select'+ options.class_not_img +':not(.jsw)').each(function(){
			var thet = $(this);
			thet.addClass('jsw');
			thet.wrap('<div class="select_js">');
			var par = thet.parents('.select_js');
			var opt_txt = '';
			var sel_title = '';
		
			thet.find('option').each(function(){				
				if($(this).prop('selected')){
					opt_txt = opt_txt + '<div class="select_js_ulli active" data-value="'+ $(this).val() +'"><div class="select_txt">'+ $(this).html() +'</div><div class="select_js_abs"></div><div style="clear: both;"></div></div>';
					sel_title = $(this).html();
				} else {
					opt_txt = opt_txt + '<div class="select_js_ulli" data-value="'+ $(this).val() +'"><div class="select_txt">'+ $(this).html() +'</div><div class="select_js_abs"></div><div style="clear: both;"></div></div>';
				}
			});	
			
			var sel_txt = '<div class="select_js_title"><div class="select_js_title_ins">'+ sel_title +'</div><div class="select_js_abs"></div><div style="clear: both;"></div></div><div class="select_js_ul"><div class="select_js_ul_ins">' + opt_txt + '</div></div>';
			thet.parents('.select_js').find('select').after(sel_txt);
		});
		
		$('select'+ options.class_with_img +':not(.jsw)').hide();
		$('select'+ options.class_with_img +':not(.jsw)').each(function(){
			var thet = $(this);
			thet.addClass('jsw');
			thet.wrap('<div class="select_js">');
			var par = thet.parents('.select_js');
			var opt_txt = '';
			var sel_title = '';
			
			thet.find('option').each(function(){
				var im = $(this).attr('data-img');
				var sel_ico = '';
				if (typeof im !== typeof undefined && im !== false) {
					sel_ico = '<div class="select_ico" style="background: url(' + im + ') no-repeat center center;"></div>';
					par.addClass('iselect_js');
				} 			
				
				if($(this).prop('selected')){
					opt_txt = opt_txt + '<div class="select_js_ulli active" data-value="'+ $(this).val() +'">'+ sel_ico +'<div class="select_txt">'+ $(this).html() +'</div><div class="select_js_abs"></div><div style="clear: both;"></div></div>';
					sel_title = sel_ico +'<div class="select_txt">'+ $(this).html() +'</div><div style="clear: both;"></div>';
				} else {
					opt_txt = opt_txt + '<div class="select_js_ulli" data-value="'+ $(this).val() +'">'+ sel_ico +'<div class="select_txt">'+ $(this).html() +'</div><div class="select_js_abs"></div><div style="clear: both;"></div></div>';
				}
			});

			var sel_txt = '<div class="select_js_title"><div class="select_js_title_ins">'+ sel_title +'<div class="select_js_abs"></div></div><div style="clear: both;"></div></div><div class="select_js_ul"><div class="select_js_ul_ins">' + opt_txt + '</div></div>';
			thet.parents('.select_js').find('select').after(sel_txt);
		});

		$('.select_js_title').on('click', function(){
			$('.select_js_ul').hide();
			$(this).parents('.select_js').addClass('open');
			$(this).parents('.select_js').find('.select_js_ul').show();
		});		
		
		$('.select_js_ulli').on('click', function(){
			var title = $(this).html();
			var vale = $(this).attr('data-value');
			var def = $(this).parents('.select_js').find('select').val();
			$(this).parents('.select_js').find('.select_js_title_ins').html(title);
			$(this).parents('.select_js').find('select').val(vale);
			$(this).parents('.select_js').removeClass('open');
			$(this).parents('.select_js').find('.select_js_ulli').removeClass('active');
			$(this).addClass('active');
			
			$(this).parents('.select_js').find('.select_js_ul').hide();
			if(def != vale){
				$(this).parents('.select_js').find('select').trigger("change");
		    }
		});
		
		$(document).on('click', function(event){
			if ($(event.target).closest(".select_js").length) return;
			$('.select_js_ul').hide();
			$('.select_js').removeClass('open');
			event.stopPropagation();
		});		
 
        return this;
    };
});