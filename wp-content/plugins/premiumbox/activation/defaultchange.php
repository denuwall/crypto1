<?php
if( !defined( 'ABSPATH')){ exit(); }		

global $wpdb;
$prefix = $wpdb->prefix;

$firsten = intval(get_option('first_pn'));
if(!$firsten){	
	remove_role('editor');
	remove_role('author');
	remove_role('contributor');
	remove_role('subscriber');
	
	add_role('users', 'users', array());

	$wpdb->update( $prefix.'options' , array('option_value' => 'users'), array('option_name' => 'default_role'));
 
	update_option('template', 'exchanger');	
	update_option('stylesheet', 'exchanger');	

	wp_delete_post( 1, true );
	wp_delete_post( 2, true );

	update_option('use_smilies' , '');
	update_option('posts_per_rss',5);
	update_option('rss_use_excerpt' , '1');
	update_option('default_pingback_flag', 0);
	update_option('default_ping_status', 0);
	update_option('comments_notify', 0);
	update_option('moderation_notify', 0);
	update_option('comment_moderation', '1');
	update_option('show_avatars', '0');
	update_option('uploads_use_yearmonth_folders' , '');
	update_option('permalink_structure' , '/%postname%/');

	$wpdb->update($wpdb->prefix.'terms', array('slug'=>'norubrik'), array('term_id'=>1));

	update_option('first_pn', 1);
}	

$file = ABSPATH . '/.htaccess';
if(file_exists($file)){
	$content = @fopen($file, "r");
	$nfile = '';
	if ($content) {
		$up1 = $up2 = 1;
		while (($buffer = @fgets($content)) !== false) {
			$line_text = trim($buffer);
			if(strstr($line_text, 'Options All -Indexes')){
				$up1 = 0;
			}
			if(strstr($line_text, '<files wp-config.php>')){
				$up2 = 0;
			}				
			$nfile .= $buffer;			
		}	
			
		$upfile = '';
		if($up1){
			$upfile .= "Options All -Indexes \n\r";
		}
		if($up2){
			$upfile .= "<files wp-config.php> \n order allow,deny \n deny from all \n</files> \n\r";
		}			
		if($up1 or $up2){
			$upfile .= $nfile;
			$fs = @fopen($file, 'w+');
			@fwrite($fs, $upfile);
			@fclose($fs);
		}
	}
} else {
	$rsec_content = "Options All -Indexes \n\r";
	$rsec_content .="<files wp-config.php> \n order allow,deny \n deny from all \n</files> \n\r";
	$fs = @fopen($file, 'w+');
	@fwrite($fs, $rsec_content);
	@fclose($fs);
}
/* end work to htaccess */