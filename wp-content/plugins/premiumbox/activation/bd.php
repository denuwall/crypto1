<?php
if( !defined( 'ABSPATH')){ exit(); }		
			
global $wpdb;
$prefix = $wpdb->prefix;

	$table_name = $wpdb->prefix ."pn_options";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`meta_key` varchar(250) NOT NULL,
		`meta_key2` varchar(250) NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY ( `id` ),
		INDEX (`meta_key`),
		INDEX (`meta_key2`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
		
	$table_name = $wpdb->prefix ."auth_logs";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`auth_date` datetime NOT NULL,
		`user_id` bigint(20) NOT NULL,
		`user_login` varchar(250) NOT NULL,
		`old_user_ip` varchar(250) NOT NULL,
		`old_user_browser` varchar(250) NOT NULL,
		`now_user_ip` varchar(250) NOT NULL,
		`now_user_browser` varchar(250) NOT NULL,
		`auth_status` int(1) NOT NULL default '0',
		`auth_status_text` longtext NOT NULL,
		PRIMARY KEY ( `id` ),
		INDEX (`user_id`),
		INDEX (`auth_date`),
		INDEX (`auth_status`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);			
		
	/* users */
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'sec_lostpass'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `sec_lostpass` int(1) NOT NULL default '1'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'sec_login'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `sec_login` int(1) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'email_login'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `email_login` int(1) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'enable_ips'");
    if ($query == 0) {
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `enable_ips` longtext NOT NULL");
    }		
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'auto_login1'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `auto_login1` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'auto_login2'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `auto_login2` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'user_pin'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `user_pin` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'enable_pin'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `enable_pin` int(1) NOT NULL default '0'");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'user_browser'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `user_browser` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'user_ip'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `user_ip` varchar(250) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'user_bann'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `user_bann` int(1) NOT NULL default '0'");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'admin_comment'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `admin_comment` longtext NOT NULL");
    }	
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'last_adminpanel'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `last_adminpanel` varchar(50) NOT NULL");
    }
	$query = $wpdb->query("SHOW COLUMNS FROM ".$wpdb->prefix ."users LIKE 'user_discount'");
    if ($query == 0){
		$wpdb->query("ALTER TABLE ".$wpdb->prefix ."users ADD `user_discount` varchar(50) NOT NULL default '0'");
    }	
	/* end users */

	/* archive */
	$table_name= $wpdb->prefix ."archive_data";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`meta_key` varchar(250) NOT NULL,
		`meta_key2` varchar(250) NOT NULL,
		`meta_key3` varchar(250) NOT NULL,
		`item_id` bigint(20) NOT NULL default '0',
		`meta_value` varchar(20) NOT NULL default '0',
		PRIMARY KEY ( `id` ),
		INDEX (`meta_key`),
		INDEX (`meta_key2`),
		INDEX (`meta_key3`),
		INDEX (`meta_value`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	/* end archive */
	
	/*
	payment systems

	psys_title - значение
	psys_logo - логотип
	*/
	$table_name = $wpdb->prefix ."psys";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',		
		`psys_title` longtext NOT NULL,
		`psys_logo` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	/* end payment systems */	
	
	/*
	currency_codes

	currency_code_title - значение
	internal_rate - внутренний курс за 1 доллар
	parser - id парсера
	new_parser_id - id нового парсера из конструктора
	parser_actions - работа парсера
	*/
	$table_name = $wpdb->prefix ."currency_codes";
	$sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',	
		`currency_code_title` longtext NOT NULL,
		`internal_rate` varchar(50) NOT NULL default '0',
		`parser` bigint(20) NOT NULL default '0',
		`parser_actions` varchar(150) NOT NULL default '0',
		`new_parser` bigint(20) NOT NULL default '0',
		`new_parser_actions` varchar(150) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	/* end currency_codes */
	
	/* add currency_codes */
	$currency_codes = array('RUB','EUR','USD','UAH','AMD','KZT','GLD','BYN','UZS','BTC','TRY');
	if(is_array($currency_codes)){
		foreach($currency_codes as $cc_type){
			$cc_count = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."currency_codes WHERE currency_code_title='$cc_type'");
			if($cc_count == 0){
				$wpdb->insert($wpdb->prefix . "currency_codes", array('currency_code_title' => $cc_type, 'internal_rate' => '1'));
			}
		}
	}
	/* end add currency_codes */

/*
Дополнительные поля валют

tech_name - техническое название
cf_name - название
vid - 0 текст, 1- select
cf_req - 0-не обязательно, 1-обязательно
minzn - мин.длинна
maxzn - макс длинна
firstzn - начальное значение
helps - подсказка отдаете
datas - если селект, то массив выборки
cf_hidden - видимость на сайте
currency_id - id валюты
place_id - 0 - и там и там, 1 - отдаете, 2 - получаете
uniqueid - идентификатор для автовыплат и прочего
cifrzn - что используется (0-буквы и цифры, 1-только цифры, 2-только буквы, 3-email, 4-все символы, 5-телефон, 6-все символы, удаляя все пробелы, 7-латиница удаляя все пробелы)
*/	
	$table_name= $wpdb->prefix ."currency_custom_fields";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',		
		`tech_name` longtext NOT NULL,
		`cf_name` longtext NOT NULL,
		`vid` int(1) NOT NULL default '0',
		`currency_id` bigint(20) NOT NULL default '0',
		`cf_req` int(1) NOT NULL default '0',
		`place_id` int(1) NOT NULL default '0',
		`minzn` int(2) NOT NULL default '0',
		`maxzn` int(5) NOT NULL default '100',
		`firstzn` varchar(20) NOT NULL,
		`cifrzn` int(2) NOT NULL default '0',
		`backspace` int(1) NOT NULL default '0',
		`uniqueid` varchar(250) NOT NULL,
		`helps` longtext NOT NULL,
		`datas` longtext NOT NULL,
		`status` int(2) NOT NULL default '1',
		`cf_hidden` int(2) NOT NULL default '0',
		`cf_order` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

/*
Дополнительные поля направлений

tech_name - техническое название
cf_name - название
vid - 0 текст, 1- select
cf_req - 0-не обязательно, 1-обязательно
cf_hidden - видимость на сайте
minzn - мин.длинна
maxzn - макс длинна
firstzn - начальное значение
helps - подсказка
datas - если селект, то массив выборки
*/	
	$table_name= $wpdb->prefix ."direction_custom_fields";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',
		`tech_name` longtext NOT NULL,
		`cf_name` longtext NOT NULL,
		`vid` int(1) NOT NULL default '0',
		`cf_req` int(1) NOT NULL default '0',
		`minzn` int(2) NOT NULL default '0',
		`maxzn` int(5) NOT NULL default '100',
		`firstzn` varchar(20) NOT NULL,
		`cifrzn` int(2) NOT NULL default '0',
		`backspace` int(1) NOT NULL default '0',
		`uniqueid` varchar(250) NOT NULL,
		`helps` longtext NOT NULL,
		`cf_auto` varchar(250) NOT NULL,
		`datas` longtext NOT NULL,
		`status` int(2) NOT NULL default '1',
		`cf_hidden` int(2) NOT NULL default '0',
		`cf_order` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
	$table_name= $wpdb->prefix ."cf_directions";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`direction_id` bigint(20) NOT NULL default '0',
		`cf_id` bigint(20) NOT NULL default '0',
		`place_id` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
/*
currency

currency_logo - логотип валюты 
psys_logo - лого платежки 
psys_id - id ПС 
psys_title - название ПС 
currency_code_id - id кода валюты 
currency_code_title - название кода валюты 
currency_decimal - знаков после запятой
txt_give - название отдаете 
show_give - выводить при отдаете 
txt_get - название получаете 
show_get - выводить при получаете 
cf_hidden - видимость на сайте
helps_give - подсказка при заполнении (отдаю) 
helps_get - подсказка при заполнении (получаю) 
currency_status - активность валюты (1 - активна, 0 - не активна)
currency_reserv - резерв (автосумма)
minzn - минимальное кол-во символов
maxzn - максимальное кол-во символов
firstzn - первые буквы
cifrzn - что используется (0-буквы и цифры, 1-только цифры, 2-только буквы, 3-email, 4-все символы, 5-телефон, 6-все символы, удаляя все пробелы, 7-латиница удаляя все пробелы)
vidzn - вид счета (0-счет, 1-карта, 2-номер телефона)
lead_num - число приведения
reserv_place - откуда брать резерв (0-считать)
xml_value - значение для XML
check_text - текст проверенного кошелька
check_purse - интерфейс проверки кошелька
*/
	$table_name = $wpdb->prefix ."currency";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',
		`currency_logo` longtext NOT NULL,
		`psys_logo` longtext NOT NULL,
		`psys_id` bigint(20) NOT NULL default '0',
		`psys_title` longtext NOT NULL,		
		`currency_code_id` bigint(20) NOT NULL default '0',
		`currency_code_title` longtext NOT NULL,		
		`currency_decimal` int(2) NOT NULL default '8',
		`minzn` int(5) NOT NULL default '0',
		`maxzn` int(5) NOT NULL default '100',		
		`txt_give` longtext NOT NULL,
		`txt_get` longtext NOT NULL,
		`show_give` int(2) NOT NULL default '1',
		`show_get` int(2) NOT NULL default '1',		
		`cf_hidden` int(2) NOT NULL default '0',
		`firstzn` varchar(20) NOT NULL,
		`cifrzn` int(2) NOT NULL default '0',
		`backspace` int(1) NOT NULL default '0',
		`vidzn` int(2) NOT NULL default '0',		
		`helps_give` longtext NOT NULL,
		`helps_get` longtext NOT NULL,
		`site_order` bigint(20) NOT NULL default '0',
		`reserv_order` bigint(20) NOT NULL default '0',
		`currency_reserv` varchar(50) NOT NULL default '0',
		`currency_status` int(1) NOT NULL default '1',
		`lead_num` varchar(20) NOT NULL default '0',
		`reserv_place` varchar(150) NOT NULL default '0',
		`xml_value` varchar(250) NOT NULL,
		`check_text` longtext NOT NULL,
		`check_purse` varchar(150) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);		
	
	$table_name= $wpdb->prefix ."currency_meta";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`item_id` bigint(20) NOT NULL default '0',
		`meta_key` longtext NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY ( `id` )		
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
/* end currency */	

/*
транзакции резерва

trans_title - название транзакции
user_creator - id юзера создавшего транзакцию
user_editor - id юзера отредактировавшего транзакцию
trans_sum - сумма
currency_id - id валюты
currency_code_id - id типа валюты
currency_code_title - название типа валюты
*/
	$table_name= $wpdb->prefix ."currency_reserv";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',		
		`trans_title` longtext NOT NULL,
		`user_creator` bigint(20) NOT NULL default '0',
		`user_editor` bigint(20) NOT NULL default '0',
		`trans_sum` varchar(50) NOT NULL default '0',
		`currency_id` bigint(20) NOT NULL default '0',
		`currency_code_id` bigint(20) NOT NULL default '0',
		`currency_code_title` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);
	
/*
exchange directions
*/
	$table_name = $wpdb->prefix ."directions";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`auto_status` int(1) NOT NULL default '1',
		`edit_user_id` bigint(20) NOT NULL default '0',
		`currency_id_give` bigint(20) NOT NULL default '0',
		`currency_id_get` bigint(20) NOT NULL default '0',
		`psys_id_give` bigint(20) NOT NULL default '0',
		`psys_id_get` bigint(20) NOT NULL default '0',
		`tech_name` longtext NOT NULL,
		`direction_name` varchar(350) NOT NULL,
		`site_order1` bigint(20) NOT NULL default '0',
		`course_give` varchar(50) NOT NULL default '0',
		`course_get` varchar(50) NOT NULL default '0',
		`direction_status` int(2) NOT NULL default '1',
		`check_purse` int(1) NOT NULL default '0',
		`req_check_purse` int(1) NOT NULL default '0',		
		`enable_user_discount` int(1) NOT NULL default '1',
		`max_user_discount` varchar(5) NOT NULL default '50',
		`min_sum1` varchar(250) NOT NULL default '0',
		`min_sum2` varchar(250) NOT NULL default '0',
		`max_sum1` varchar(250) NOT NULL default '0',
		`max_sum2` varchar(250) NOT NULL default '0',
		`com_box_sum1` varchar(250) NOT NULL default '0',
		`com_box_pers1` varchar(250) NOT NULL default '0',
		`com_box_min1` varchar(250) NOT NULL default '0',
		`com_box_sum2` varchar(250) NOT NULL default '0',
		`com_box_pers2` varchar(250) NOT NULL default '0',
		`com_box_min2` varchar(250) NOT NULL default '0',
		`profit_sum1` varchar(50) NOT NULL default '0',
		`profit_sum2` varchar(50) NOT NULL default '0',
		`profit_pers1` varchar(20) NOT NULL default '0',
		`profit_pers2` varchar(20) NOT NULL default '0',		
		`com_sum1` varchar(50) NOT NULL default '0',
		`com_sum2` varchar(50) NOT NULL default '0',		
		`com_pers1` varchar(20) NOT NULL default '0',
		`com_pers2` varchar(20) NOT NULL default '0',		
		`com_sum1_check` varchar(50) NOT NULL default '0',
		`com_sum2_check` varchar(50) NOT NULL default '0',
		`com_pers1_check` varchar(20) NOT NULL default '0',
		`com_pers2_check` varchar(20) NOT NULL default '0',
		`pay_com1` int(1) NOT NULL default '0',
		`pay_com2` int(1) NOT NULL default '0',
		`nscom1` int(1) NOT NULL default '0',
		`nscom2` int(1) NOT NULL default '0',		
		`maxsum1com` varchar(250) NOT NULL default '0', 
		`maxsum2com` varchar(250) NOT NULL default '0',
		`minsum1com` varchar(50) NOT NULL default '0',  
		`minsum2com` varchar(50) NOT NULL default '0',
		`m_in` varchar(150) NOT NULL default '0',
		`m_out` varchar(150) NOT NULL default '0',		
		`to1` bigint(20) NOT NULL default '0',
		`to2_1` bigint(20) NOT NULL default '0',
		`to2_2` bigint(20) NOT NULL default '0',
		`to3_1` bigint(20) NOT NULL default '0',		
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);							
	
	$table_name = $wpdb->prefix ."directions_meta";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`item_id` bigint(20) NOT NULL default '0',
		`meta_key` longtext NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$table_name = $wpdb->prefix ."directions_order";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`direction_id` bigint(20) NOT NULL default '0',
		`c_id` bigint(20) NOT NULL default '0',
		`order1` bigint(20) NOT NULL default '0',
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);

	$table_name= $wpdb->prefix ."exchange_bids";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`create_date` datetime NOT NULL,
		`edit_date` datetime NOT NULL,
		`direction_id` bigint(20) NOT NULL default '0',
		`course_give` varchar(50) NOT NULL default '0', 
		`course_get` varchar(50) NOT NULL default '0',
		`user_id` bigint(20) NOT NULL default '0',
		`user_ip` varchar(150) NOT NULL,
		`first_name` varchar(150) NOT NULL,
		`last_name` varchar(150) NOT NULL,
		`second_name` varchar(150) NOT NULL,
		`user_phone` varchar(150) NOT NULL,
		`user_skype` varchar(150) NOT NULL,
		`user_email` varchar(150) NOT NULL,
		`user_passport` varchar(250) NOT NULL,	
		`account_give` varchar(250) NOT NULL,
		`account_get` varchar(250) NOT NULL,
		`metas` longtext NOT NULL,
		`dmetas` longtext NOT NULL,
		`unmetas` longtext NOT NULL,
		`status` varchar(35) NOT NULL,
		`bid_locale` varchar(10) NOT NULL,	
		`check_purse1` varchar(20) NOT NULL default '0',
		`check_purse2` varchar(20) NOT NULL default '0',
		`psys_give` longtext NOT NULL, 
		`psys_get` longtext NOT NULL,
		`currency_id_give` bigint(20) NOT NULL default '0', 
		`currency_id_get` bigint(20) NOT NULL default '0',
		`currency_code_give` varchar(35) NOT NULL, 
		`currency_code_get` varchar(35) NOT NULL, 
		`currency_code_id_give` bigint(20) NOT NULL default '0', 
		`currency_code_id_get` bigint(20) NOT NULL default '0',
		`psys_id_give` bigint(20) NOT NULL default '0', 
		`psys_id_get` bigint(20) NOT NULL default '0', 
		`user_discount` varchar(10) NOT NULL default '0',
		`user_discount_sum` varchar(50) NOT NULL default '0',
		`sum1` varchar(50) NOT NULL default '0', 
		`dop_com1` varchar(50) NOT NULL default '0',
		`sum1dc` varchar(50) NOT NULL default '0',
		`com_ps1` varchar(50) NOT NULL default '0',
		`com_ps2` varchar(50) NOT NULL default '0',
		`sum1c` varchar(50) NOT NULL default '0', 
		`sum1r` varchar(50) NOT NULL default '0',
		`sum2t` varchar(50) NOT NULL default '0',
		`sum2` varchar(50) NOT NULL default '0', 
		`dop_com2` varchar(50) NOT NULL default '0',
		`sum2dc` varchar(50) NOT NULL default '0',
		`sum2r` varchar(50) NOT NULL default '0',
		`sum2c` varchar(50) NOT NULL default '0',
		`exsum` varchar(50) NOT NULL default '0',
		`profit` varchar(50) NOT NULL default '0',
		`hashed` varchar(35) NOT NULL,
		`m_in` varchar(150) NOT NULL default '0',
		`m_out` varchar(150) NOT NULL default '0',
		`user_hash` varchar(150) NOT NULL,
		`trans_in` varchar(250) NOT NULL default '0',
		`trans_out` varchar(250) NOT NULL default '0',
		`to_account` varchar(250) NOT NULL, 
		`from_account` varchar(250) NOT NULL,		
		`hashdata` longtext NOT NULL,
		`pay_ac` varchar(250) NOT NULL,
		`pay_sum` varchar(50) NOT NULL default '0',				
		`exceed_pay` int(1) NOT NULL default '0',
		`touap_date` datetime NOT NULL,		
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql); 	
	
/*
мета

comment_user - комментарий для юзера
comment_admin - комментарий для админа
*/	
	$table_name= $wpdb->prefix ."bids_meta";
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT ,
		`item_id` bigint(20) NOT NULL default '0',
		`meta_key` longtext NOT NULL,
		`meta_value` longtext NOT NULL,
		PRIMARY KEY ( `id` )	
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	$wpdb->query($sql);	
	
	do_action('pn_bd_activated');				 