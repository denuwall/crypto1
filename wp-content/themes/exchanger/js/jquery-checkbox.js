jQuery(function($){
	
    var default_params = {};
    $.fn.JcheckboxInit = function(params){
        var options = $.extend({}, default_params, params);
		
		$('input[type=checkbox]:not(.jcheckbox, .not_jcheckbox)').each(function(){
			var this_item = $(this);
			this_item.addClass('jcheckbox');
			this_item.parents('label').wrap('<div class="checkbox">');
			if($(this).prop('checked')){
				this_item.parents('.checkbox').addClass('act');
			}
			this_item.hide();
		});	
 
        return this;
    };
	
	
    var default_params2 = {};
    $.fn.Jcheckbox = function(params){
        var options = $.extend({}, default_params2, params);
		
		$(document).on('click', '.checkbox', function(){
			if($(this).hasClass('act')){
				$(this).removeClass('act');
				$(this).find('input').prop('checked', false);
			} else {
				$(this).addClass('act');
				$(this).find('input').prop('checked', true);
			}
			$(this).find('input').trigger('change');
		});		
		
		$(document).on('click', '.checkbox label', function(){
			$(this).parents('.checkbox').trigger('click');
			return false;
		});	
 
        return this;
    };	
});