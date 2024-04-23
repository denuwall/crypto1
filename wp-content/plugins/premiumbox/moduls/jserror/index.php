<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]JS error[:en_US][ru_RU:]JS error[:ru_RU]
description: [en_US:]Display errors on the website[:en_US][ru_RU:]Вывод ошибок на сайте[:ru_RU]
version: 1.5
category: [en_US:]Javascript[:en_US][ru_RU:]Javascript[:ru_RU]
cat: js
*/

remove_action('pn_js_error_response', 'jserror_js_error_response');

add_action('pn_js_error_response', 'modul_jserror_js_error_response');
function modul_jserror_js_error_response($type){
?>

	<?php if($type == 'ajax'){ ?>
		var res_content = res2;
	<?php } else { ?>
		var res_content = res3;
	<?php } ?>
	
	$(document).JsWindow('show', {
		id: 'js_error_window',
		div_class: 'error_window',
		title: '<?php _e('An error has occurred','pn'); ?>',
		content: res_content,
		shadow: 1
	});	
	
<?php
} 