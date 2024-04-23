<?php
if( !defined( 'ABSPATH')){ exit(); }

/*
title: [en_US:]JS alert[:en_US][ru_RU:]JS alert[:ru_RU]
description: [en_US:]Window with an error message[:en_US][ru_RU:]Окошко с сообщением об ошибке[:ru_RU]
version: 1.5
category: [en_US:]Javascript[:en_US][ru_RU:]Javascript[:ru_RU]
cat: js
*/

remove_action('pn_js_alert_response', 'jserror_js_alert_response');

add_action('pn_js_alert_response', 'jsalert_js_alert_response');
function jsalert_js_alert_response(){ 
?>
	if(res['status_text']){
		
		$(document).JsWindow('show', {
			id: 'js_alert_window',
			div_class: 'alert_window',
			title: '<?php _e('Attention!','pn'); ?>',
			content: res['status_text'],
			shadow: 1
		});		
		
	}
<?php
}