<?php
if( !defined( 'ABSPATH')){ exit(); }	

global $wpdb; 
$prefix = $wpdb->prefix; 

	/* archive_data */
	$query = $wpdb->query("SHOW COLUMNS FROM " . $wpdb->prefix . "archive_data LIKE 'meta_key3'");
    if ($query == 0){ 
		$wpdb->query("ALTER TABLE " . $wpdb->prefix . "archive_data ADD `meta_key3` varchar(250) NOT NULL");
    }
	/* end archive_data */
	
	/* psys */
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."psys LIKE 'create_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."psys ADD `create_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."psys LIKE 'edit_date'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."psys ADD `edit_date` datetime NOT NULL");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."psys LIKE 'auto_status'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."psys ADD `auto_status` int(1) NOT NULL default '1'");
	}
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."psys LIKE 'edit_user_id'");
	if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."psys ADD `edit_user_id` bigint(20) NOT NULL default '0'");
	}	
	/* end psys */		