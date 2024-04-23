<?php

function show_tr_cc_()
{
}

function end_time_license()
{
	return time()+86400*365;
}

function get_license_time()
{
	return time()+86400*365;
}

function get_pn_license_time()
{
	return time()+86400*365;
}

if(!function_exists('is_admin_newurl')){
	function is_admin_newurl($url){
		$url = (string)$url;
		$url = trim($url);
		if (preg_match("/^[a-zA-z0-9]{3,150}$/", $url, $matches )) {
			return strtolower($url);
		} 
		return '';
	}
}

if(!function_exists('pn_real_ip')){
	function pn_real_ip(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ips = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ips = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ips = $_SERVER['REMOTE_ADDR'];
		}
		
		$ips_arr = explode(',',$ips);
		$ip = trim($ips_arr[0]);
		$ip = apply_filters('pn_real_ip', $ip, $ips_arr);
		
		return preg_replace( '/[^0-9a-fA-F.]{0,20}/', '',$ip);	
	}
}

function pn_allow_second_name()
{
	global $premiumbox;
	return intval($premiumbox->get_option("second_name"));
}


function is_modul_name($name)
{
	$name = (string) $name;
	$name = trim($name);
	if (preg_match("/^[a-zA-z0-9_]{1,100}$/", $name, $matches)) {
		return $name;
	}
	return false;
}

function pn_allow_uv()
{
	return true;
}

function pn_change_uv()
{
	return 0;
}

function pn_include_extanded($folder, $name)
{
	global $premiumbox;
	$file = $premiumbox->plugin_dir . $folder . "/" . $name . "/index.php";

	if (file_exists($file)) {
		include_once ($file);
	}
}

function pn_include_extended($folder, $name)
{
	global $premiumbox;
	$file = $premiumbox->plugin_dir . $folder . "/" . $name . "/index.php";

	if (file_exists($file)) {
		include_once ($file);
	}
}

function pn_verify_extended($array){
			$extended = get_option('pn_extended');
	$list_merchants = apply_filters('list_merchants',array());
	$merchants = get_option('merchants');

	foreach($array as $folder)
	{
		$foldervn = PN_PLUGIN_DIR.$folder;
		if(is_dir($foldervn)){
			$dir = @opendir($foldervn);
			while(($file = @readdir($dir))){
				if(is_dir($foldervn.'/'.$file) && $file != '.' && $file != '..')
				{
					//if(file_exists($foldervn. '/'. $file.'/index.php') && file_exists($foldervn. '/'. $file.'/dostup/index.php'))
					if(file_exists($foldervn. '/'. $file.'/index.php'))
						include($foldervn. '/'. $file.'/index.php');
				}
			}
		}

	}
}

function pn_list_extended($folder){
	$extended = get_option('pn_extended');
	$lists = $extended[$folder];	
	if($folder == 'moduls')
	{
		$lists = $extended[$folder];
		foreach($lists as $key => $list)
		{
			$list = array();
			$list['name'] = $key;
			$file = PN_PLUGIN_DIR.$folder.'/'.$key.'/index.php';
			$lists[$key] = array_merge(accept_extended_data($file), $list);
		}
	}
	if($folder == 'merchants')
	{
		$lists = apply_filters('list_'.$folder,array());
		foreach($lists as $key => $list)
		{
			$list['name'] = $list['id'];
			$file = PN_PLUGIN_DIR.$folder.'/'.$list['id'].'/index.php';
			$lists[$key] = array_merge(accept_extended_data($file), $list);
		}
	}
	return $lists;
}

function pn_extended_data($file)
{
}
/*
function is_reviews_hash($hash)
{
	$hash = pn_strip_input($hash);


	if (preg_match("/^[a-zA-z0-9]{25}$/", $hash, $matches)) {

		$r = $hash;
	}

	else {

		$r = 0;
	}



	return $r;
}

function is_country_attr($hash)
{
	$hash = (string) $hash;
	$hash = trim($hash);

	if (preg_match("/^[a-zA-z]{2,3}$/", $hash, $matches)) {
		$r = $hash;
	}
	else {
		$r = 0;
	}

	return $r;
}
*/

function get_icon_indicators($name)
{
	
}

function get_hash_result_url($name)
{
	return md5($name);
}

function get_summ_color($summ, $max = "bgreen", $min = "bred")
{
	if ($summ == 0) {
		return "<span>" . $summ . "</span>";
	}

	if (0 < $summ) {
		return "<span class=\"" . $max . "\">" . $summ . "</span>";
	}

	return "<span class=\"" . $min . "\">" . $summ . "</span>";
}

function is_site_value($url)
{
	$url = (string) $url;
	$url = trim($url);
	$url = apply_filters("is_site_value", $url);

	if (preg_match("/^[a-zA-z0-9]{3,30}$/", $url, $matches)) {
		$r = $url;
	}
	else {
		$r = "";
	}

	return $r;
}

function is_xml_value($url)
{
	$url = (string) $url;
	$url = trim($url);
	$url = apply_filters("is_xml_value", $url);

	if (preg_match("/^[a-zA-z0-9_]{3,50}$/", $url, $matches)) {
		$r = $url;
	}
	else {
		$r = "";
	}

	return $r;
}

function unique_xml_value($value, $data_id)
{
	global $wpdb;
	$data_id = intval($data_id);

	if ($value) {
		$cc = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "valuts WHERE xml_value='$value' AND id != '$data_id'");

		if (0 < $cc) {
			$arr = "1,2,3,4,5,6,7,8,9";
			$array = explode(",", $arr);
			shuffle($array);
			$value = $value . $array[0];
			return unique_xml_value($value, $data_id);
		}

		return $value;
	}

	return "";
}

function is_firstzn_value($url)
{
	$url = (string) $url;
	$url = trim($url);

	if (preg_match("/^[\+a-zA-z0-9]{0,50}$/", $url, $matches)) {
		$r = $url;
	}
	else {
		$r = "";
	}

	return $r;
}

function get_valuts_data($output = "")
{
	global $wpdb;
	$where = "";

	if ((0 < count($output)) && is_array($output)) {
		$join = array();

		foreach ($output as $out ) {
			$join[] = "'" . intval($out) . "'";
		}

		$in = join(",", $join);
		$where .= "WHERE id IN($in) ";
	}

	$valuts = array();
	$valutsn = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "valuts $where");

	foreach ($valutsn as $valut ) {
		$valuts[$valut->id] = $valut;
	}

	return apply_filters("get_valuts_data", $valuts);
}

function get_valut_logo($data)
{
	if (isset($data->id)) {
		$valut_logo = esc_url($data->valut_logo);

		if (!$valut_logo) {
			$valut_logo = esc_url($data->psys_logo);
		}

		return is_ssl_url($valut_logo);
	}
}

function is_out_sum($course_give, $vd1, $nap)
{
	return number_format($course_give, $vd1, '.', '');
}

function is_course_give($sumfrom, $t1, $direction_data2, $vd1, $t2)
{
	if($sumfrom == 1) return $sumfrom / $direction_data2->course_give;
	else return $sumfrom / $direction_data2->course_give;
}

function is_course_get($sumfrom, $t1, $direction_data2, $vd1, $t2)
{
	if($sumfrom == 1) return $sumfrom / $direction_data2->course_give;
	else return $sumfrom * $direction_data2->course_give;

}

function get_psys_logo($data, $var)
{
	$valut_logo = '';
	$psys_logo = @unserialize(is_isset($data, 'psys_logo'));
	$valut_logo = is_isset($psys_logo, 'logo'.$var);

	if(preg_match('/\](.*?)\[/isu', $valut_logo, $r))
	{
		$valut_logo = $r[1];
	}

	$valut_logo = is_ssl_url($valut_logo);
	return $valut_logo;
}

function get_currency_title_by_id($valut_id){
global $wpdb;

	$valut_id = intval($valut_id);
	$valut_data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."currency WHERE id='$valut_id'");
	if(isset($valut_data->id)){
		return get_currency_title($valut_data);
	} else {
		return __('No item','pn');
	}
} 
function get_currency_logo($data, $tableicon='')
{
	$valut_logo = '';
	if (isset($data->id)) {
		$currency_logo = @unserialize(is_isset($data, 'currency_logo'));
		$valut_logo = is_isset($currency_logo, 'logo1');

		if (!$valut_logo) {
		$psys_logo = @unserialize(is_isset($data, 'psys_logo'));
		$valut_logo = is_isset($psys_logo, 'logo1');
		}

		if(preg_match('/\](.*?)\[/isu', $valut_logo, $r))
		{
			$valut_logo = $r[1];
		}
		
		$valut_logo = is_ssl_url($valut_logo);
	}
	return $valut_logo;
}

function get_icon_for_table()
{
	return;
}

function get_hidecurrtype_table()
{
	return 0;
}
function is_enable_check_purse()
{
	return true;
}
function get_valut_title($data)
{
	if (isset($data->id)) {
		return pn_strip_input(ctv_ml($data->psys_title)) . " " . is_site_value($data->vtype_title);
	}
}

function get_currency_data()
{
	global $wpdb;	
	$v = array();
	$valutsn = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."currency ORDER BY psys_title ASC");
	foreach($valutsn as $valut){
		$v[$valut->id] = $valut;
	}
	return $v;
}

function get_currency_title($data)
{
	if (isset($data->id)) {
		return pn_strip_input(ctv_ml($data->psys_title)) . " " . is_site_value($data->currency_code_title);
	}
}

function list_view_valuts($output = array(), $not = array())
{
	global $wpdb;
	$where = "";

	if ((0 < count($output)) && is_array($output)) {
		$join = array();

		foreach ($output as $out ) {
			$join[] = "'" . intval($out) . "'";
		}

		$in = join(",", $join);
		$where .= "AND id IN($in)";
	}

	if ((0 < count($not)) && is_array($not)) {
		$join = array();

		foreach ($not as $out ) {
			$join[] = "'" . intval($out) . "'";
		}

		$in = join(",", $join);
		$where .= "AND id NOT IN($in)";
	}

	$valuts = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "valuts WHERE valut_status = '1' $where ORDER BY reserv_order ASC");
	$items = array();

	foreach ($valuts as $valut ) {
		$items[] = array("id" => $valut->id, "logo" => get_valut_logo($valut), "title" => get_valut_title($valut), "psys" => pn_strip_input(ctv_ml($valut->psys_title)), "vtype" => is_site_value($valut->vtype_title), "reserv" => get_valut_reserv($valut, "v"));
	}

	return apply_filters("list_view_valuts", $items, $valuts, $output);
}
function list_view_currencies($output = array(), $not = array())
{
	global $wpdb;
	$where = "";

	if ((is_array($output) && 0 < count($output))) {
		$join = array();

		foreach ($output as $out ) {
			$join[] = "'" . intval($out) . "'";
		}

		$in = join(",", $join);
		$where .= "AND id IN($in)";
	}

	if ((0 < count($not)) && is_array($not)) {
		$join = array();

		foreach ($not as $out ) {
			$join[] = "'" . intval($out) . "'";
		}

		$in = join(",", $join);
		$where .= "AND id NOT IN($in)";
	}

	$valuts = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "currency WHERE valut_status = '1' $where ORDER BY reserv_order ASC");
	$items = array();

	foreach ($valuts as $valut ) {
		$items[] = array("id" => $valut->id, "logo" => get_currency_logo($valut), "title" => get_currency_title($valut), "decimal" => $valut->currency_decimal, "psys" => pn_strip_input(ctv_ml($valut->psys_title)), "vtype" => is_site_value($valut->vtype_title), "reserv" => get_valut_reserv($valut, "v"));
	}

	return apply_filters("list_view_currencies", $items, $valuts, $output);
}

function get_parallel_error_output()
{
	return 1;
}
function get_valut_reserv($data, $visible = "nv")
{
	$decimal = $data->valut_decimal;
	$reserv = is_sum($data->valut_reserv, $decimal);
	$reserv = apply_filters("get_valut_reserv", $reserv, $data->valut_reserv, $data->valut_decimal, $visible);
	return $reserv;
}
function get_currency_reserv($data, $visible = "nv")
{
	$decimal = $data->valut_decimal;
	$reserv = is_sum($data->valut_reserv, $decimal);
	$reserv = apply_filters("get_currency_reserv", $reserv, $data->valut_reserv, $data->valut_decimal, $visible);
	return $reserv;
}

function set_archive_data($item_id, $key1, $key2, $key3, $value)
{
	global $wpdb;
	$arch_data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "archive_data WHERE item_id='$item_id' AND meta_key='$key1' AND meta_key2='$key2' AND meta_key3='$key3'");

	if (isset($arch_data->id)) {
		$arr = array();
		$arr["meta_key"] = $key1;
		$arr["meta_key2"] = $key2;
		$arr["meta_key3"] = $key3;
		$arr["item_id"] = $item_id;
		$arr["meta_value"] = $arch_data->meta_value + $value;
		return $wpdb->update($wpdb->prefix . "archive_data", $arr, array("id" => $arch_data->id));
	}

	$arr = array();
	$arr["meta_key"] = $key1;
	$arr["meta_key2"] = $key2;
	$arr["meta_key3"] = $key3;
	$arr["item_id"] = $item_id;
	$arr["meta_value"] = is_sum($value);
	$wpdb->insert($wpdb->prefix . "archive_data", $arr);
	return $wpdb->insert_id;
}


function get_purse($account, $item)
{
	$account = (string) $account;


	if (isset($item->id)) {

		$account = trim($account);


		if ($item->vidzn == 1) {

			$minzn = intval($item->minzn);
			$maxzn = intval($item->maxzn);
			$firstzn = "";
		}

		else {

			$minzn = intval($item->minzn);
			$maxzn = intval($item->maxzn);
			$firstzn = "";


			if ($item->firstzn) {

				$firstzn = preg_quote(pn_strip_input($item->firstzn));
			}

		}



		if ((0 < $maxzn) && ($maxzn < $minzn)) {

			$maxzn = $minzn;
		}



		if (!$account) {

			return "";
		}



		if (mb_strlen($account) < $minzn) {

			return "";
		}



		if (($maxzn < mb_strlen($account)) && (0 < $maxzn)) {

			return "";
		}



		if ($item->vidzn == 1) {

			if (preg_match("/^" . $firstzn . "[0-9-]{0,300}$/", $account, $matches)) {

				return $account;
			}

		}

		else if ($item->cifrzn == 0) {

			if (preg_match("/^" . $firstzn . "[a-zA-Z0-9]{0,300}$/", $account, $matches)) {

				return $account;
			}

		}

		else if ($item->cifrzn == 1) {

			if (preg_match("/^" . $firstzn . "[0-9]{0,300}$/", $account, $matches)) {

				return $account;
			}

		}

		else if ($item->cifrzn == 2) {

			if (preg_match("/^" . $firstzn . "[a-zA-Z]{0,300}$/", $account, $matches)) {

				return $account;
			}

		}

		else if ($item->cifrzn == 3) {

			return is_email($account);
		}

		else {

			return is_email($account);
			return $account;
		}

	}



	return "";
}


function cur_type()
{
	$type = "USD";
	return apply_filters("cur_type", $type);
}

function stand_refid()
{
	$type = "rid";
	return apply_filters("refid", $type);
}

function is_domain($domain)
{
	$domain = (string) $domain;
	$domain = strtolower($domain);
	$domain = pn_strip_input($domain);
	$domain = esc_url($domain);
	$domain = str_replace(array("http://", "https://", "www."), "", $domain);
	$domain = rtrim($domain, "/");
	return $domain;
}


function get_exchange_link($name)
{
	global $premiumbox;
	$name = is_direction_premalink($name);

	if ($name) {
		$url = $premiumbox->get_page("ex");
		$url = rtrim($url, "/") . "exchange-" . $name . "/";
		return apply_filters("get_exchange_link", $url, $name);
	}

	return "#";
}

function is_direction_premalink($name)
{
	$iso9_table = array("А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Ѓ" => "G`", "Ґ" => "G`", "Д" => "D", "Е" => "E", "Ё" => "YO", "Є" => "YE", "Ж" => "ZH", "З" => "Z", "Ѕ" => "Z", "И" => "I", "Й" => "Y", "Ј" => "J", "І" => "I", "Ї" => "YI", "К" => "K", "Ќ" => "K", "Л" => "L", "Љ" => "L", "М" => "M", "Н" => "N", "Њ" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ў" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH", "Џ" => "DH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "``", "Ы" => "YI", "Ь" => "`", "Э" => "E`", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "ѓ" => "g", "ґ" => "g", "д" => "d", "е" => "e", "ё" => "yo", "є" => "ye", "ж" => "zh", "з" => "z", "ѕ" => "z", "и" => "i", "й" => "y", "ј" => "j", "і" => "i", "ї" => "yi", "к" => "k", "ќ" => "k", "л" => "l", "љ" => "l", "м" => "m", "н" => "n", "њ" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ў" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "џ" => "dh", "ш" => "sh", "щ" => "shh", "ь" => "", "ы" => "yi", "ъ" => "'", "э" => "e`", "ю" => "yu", "я" => "ya");
	$name = strtr($name, $iso9_table);
	$name = preg_replace("/[^A-Za-z0-9]/", "-", $name);
	return $name;
}

function is_naps_premalink($name)
{
	$iso9_table = array("А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Ѓ" => "G`", "Ґ" => "G`", "Д" => "D", "Е" => "E", "Ё" => "YO", "Є" => "YE", "Ж" => "ZH", "З" => "Z", "Ѕ" => "Z", "И" => "I", "Й" => "Y", "Ј" => "J", "І" => "I", "Ї" => "YI", "К" => "K", "Ќ" => "K", "Л" => "L", "Љ" => "L", "М" => "M", "Н" => "N", "Њ" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ў" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH", "Џ" => "DH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "``", "Ы" => "YI", "Ь" => "`", "Э" => "E`", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "ѓ" => "g", "ґ" => "g", "д" => "d", "е" => "e", "ё" => "yo", "є" => "ye", "ж" => "zh", "з" => "z", "ѕ" => "z", "и" => "i", "й" => "y", "ј" => "j", "і" => "i", "ї" => "yi", "к" => "k", "ќ" => "k", "л" => "l", "љ" => "l", "м" => "m", "н" => "n", "њ" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ў" => "u", "ф" => "f", "х" => "h", "ц" => "ts", "ч" => "ch", "џ" => "dh", "ш" => "sh", "щ" => "shh", "ь" => "", "ы" => "yi", "ъ" => "'", "э" => "e`", "ю" => "yu", "я" => "ya");
	$name = strtr($name, $iso9_table);
	$name = preg_replace("/[^A-Za-z0-9]/", "_", $name);
	return $name;
}

function unique_direction_name($naps_name, $data_id)
{
	global $wpdb;
	$data_id = intval($data_id);

	if ($naps_name) {
		$cc = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "directions WHERE direction_name='$naps_name' AND auto_status = '1' AND id != '$data_id'");

		if (0 < $cc) {
			$arr = "1,2,3,4,5,6,7,8,9";
			$array = explode(",", $arr);
			shuffle($array);
			$naps_name = $naps_name . $array[0];
			return unique_direction_name($naps_name, $data_id);
		}

		return $naps_name;
	}

	return "";
}
function unique_naps_name($naps_name, $data_id)
{
	global $wpdb;
	$data_id = intval($data_id);

	if ($naps_name) {
		$cc = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "naps WHERE naps_name='$naps_name' AND autostatus = '1' AND id != '$data_id'");

		if (0 < $cc) {
			$arr = "1,2,3,4,5,6,7,8,9";
			$array = explode(",", $arr);
			shuffle($array);
			$naps_name = $naps_name . $array[0];
			return unique_naps_name($naps_name, $data_id);
		}

		return $naps_name;
	}

	return "";
}

function is_naps_chpu($arg)
{
	$arg = (string) $arg;
	$arg = trim($arg);

	if (preg_match("/^[a-zA-z0-9_]{1,500}$/", $arg, $matches)) {
		$r = $arg;
	}
	else {
		$r = "";
	}

	return $r;
}

function is_direction_name($arg)
{
	$arg = (string) $arg;
	$arg = trim($arg);

	if (preg_match("/^[a-zA-z0-9\-]{1,500}$/", $arg, $matches)) {
		$r = $arg;
	}
	else {
		$r = "";
	}

	return $r;
}


function pn_parser_num($nums)
{
	$nums = (string) $nums;
	$nums = trim($nums);
	$zn = "";

	if (strstr($nums, "-")) {
		$zn = "-";
	}
	else if (strstr($nums, "*")) {
		$zn = "*";
	}
	else if (strstr($nums, "/")) {
		$zn = "/";
	}

	$nums = str_replace(array("-", "+", "*", "/"), "", $nums);
	$nums = $zn . is_sum($nums);
	return $nums;
}

function def_parser_curs($parsers, $id, $def)
{
	$curs = 0;
	if (is_array($parsers) && isset($parsers[$id]["curs"])) {
		$curs = is_sum($parsers[$id]["curs"]);
	}

	if ($curs <= 0) {
		$curs = $def;
	}

	return $curs;
}

function plus_persent_curs($curs, $elem, $nums)
{
	$ncurs = 0;

	if (0 < $curs) {
		$zn = "plus";

		if (strstr($nums, "-")) {
			$zn = "minus";
		}
		else if (strstr($nums, "*")) {
			$zn = "umnog";
		}
		else if (strstr($nums, "/")) {
			$zn = "razdel";
		}

		$nums = str_replace(array("-", "+", "*", "/"), "", $nums);
		$nums = is_sum($nums);

		if ($elem == 0) {
			if ($zn == "plus") {
				$ncurs = $curs + $nums;
			}
			else if ($zn == "minus") {
				$ncurs = $curs - $nums;
			}
			else if ($zn == "umnog") {
				$ncurs = $curs * $nums;
			}
			else if ($zn == "razdel") {
				$ncurs = $curs / $nums;
			}
		}
		else if ($zn == "plus") {
			$ncurs = $curs + (($curs / 100) * $nums);
		}
		else if ($zn == "minus") {
			$ncurs = $curs - (($curs / 100) * $nums);
		}
		else if ($zn == "umnog") {
			$ncurs = $curs * ($curs / 100) * $nums;
		}
		else if ($zn == "razdel") {
			$ncurs = $curs / (($curs / 100) * $nums);
		}
	}

	$ncurs = is_sum($ncurs);
	return $ncurs;
}

function get_direction_descr($name, $direction, $vd1, $vd2)
{
	return get_txtmeta($name, $direction->id, $direction->id);
}

function get_ajax_table()
{
	return 0;
}

function get_naps_where($place = "")
{
	$place = pn_strip_input($place);
	$where = "naps_status='1' AND autostatus='1' ";
	$where = apply_filters("get_naps_where", $where, $place);
	return $where;
}

function get_directions_where($place = "")
{
	$place = pn_strip_input($place);
	$where = "direction_status='1' AND auto_status='1' ";
	$where = apply_filters("get_directions_where", $where, $place);
	return $where;
}

function pn_exchanges_output($place = "")
{
	global $premiumbox;
	$show_data = array("mode" => 1, "text" => "");

	if ($premiumbox->get_option("up_mode") == 1) {
		$show_data = array("mode" => 0, "text" => __("Maintenance", "pn"));
	}

	$show_data = apply_filters("pn_exchanges_output", $show_data, $place);
	return $show_data;
}



function get_type_table()
{
	global $premiumbox;
	$type_table = intval($premiumbox->get_option("exchange", "tablevid"));
	$type_table = $type_table + 1;
	return $type_table;
}

function get_mobile_type_table()
{
	global $premiumbox;
	$type_table = 0;

	if (is_mobile()) {
		$type_table = intval($premiumbox->get_option("mobile", "tablevid"));
		$type_table = $type_table + 1;
	}

	return $type_table;
}

function is_enable_reserv()
{
	global $premiumbox;
	$en_reserv = intval($premiumbox->get_option("exchange", "reserv"));
	return apply_filters("is_enable_reserv", $en_reserv);
}



function get_goodly_num($sum, $decimal = 2)
{
	global $premiumbox;

	if ($premiumbox->get_option("exchange", "beautynum") == 1) {
		$sum = number_format($sum, $decimal, ".", " ");
	}
	else {
		$sum = sprintf("%0.{$decimal}F", $sum);
	}

	if ($premiumbox->get_option("exchange", "adjust") == 0) {
		if (strstr($sum, ".")) {
			$sum = rtrim($sum, "0");
			$sum = rtrim($sum, ".");
		}
	}

	return $sum;
}

function selection_email_login($email)
{
	global $wpdb;
	$email = (string) $email;
	$email = trim($email);

	if ($email) {
		$email = explode("@", $email);
		$login = is_isset($email, 0);
		$login = preg_replace("/[^A-Za-z0-9]/", "", $login);

		if ($login) {
			$cc = $wpdb->query("SELECT ID FROM " . $wpdb->prefix . "users WHERE user_login='$login'");

			if (0 < $cc) {
				$arr = "a,b,c,d,e,i,f,g,h,i,g,k,l,m,n,o,p,q,r,s,t,y,w,v,1,2,3,4,5,6,7,8,9";
				$array = explode(",", $arr);
				shuffle($array);
				$login = $login . $array[0];
				return selection_email_login($login);
			}

			return $login;
		}
	}

	return "";
}

function is_exchange_page()
{
	global $premiumbox;
	$pages = get_option($premiumbox->plugin_page_name);

	if (is_page($pages["exchange"])) {
		return 1;
	}

	return 0;
}

function is_exchangestep_page()
{
	global $premiumbox;
	$pages = get_option($premiumbox->plugin_page_name);

	if (is_page($pages["exchangestep"])) {
		return 1;
	}

	return 0;
}

function is_status_name($name)
{
	$name = (string) $name;
	$name = trim($name);

	if (preg_match("/^[a-zA-z0-9]{1,35}$/", $name, $matches)) {
		$r = $name;
	}
	else {
		$r = "";
	}

	return $r;
}

function get_lead_num($lead_num)
{
	if ($lead_num <= 0) {
		$lead_num = apply_filters("default_lead_num", 100);
	}

	return $lead_num;
}

function get_leads_field($lead_num, $curs1, $curs2, $decimal)
{
	if ((0 < $lead_num) && (0 < $curs1)) {
		$curs = ($curs2 * $lead_num) / $curs1;
		return is_sum($curs, $decimal);
	}

	return is_sum($curs2, $decimal);
}


function get_hard_percent($sum, $minsum, $osum)
{
	if (($minsum < $sum) && (0 < $sum) && (0 < $osum)) {
		$cc = intval($sum / $osum);
		$sum = $cc * $osum;
	}

	return $sum;
}

function unique_bid_hashed()
{
	global $wpdb;
	$value = wp_generate_password(35, false, false);

	if ($value) {
		$cc = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "bids WHERE hashed='$value'");

		if (0 < $cc) {
			return unique_bid_hashed();
		}

		return $value;
	}

	return "";
}

function get_profit_naps($summ1, $profit_summ1, $profit_pers1, $vtype1, $summ2, $profit_summ2, $profit_pers2, $vtype2)
{
	$profit = 0;
	$profit1 = $profit_summ1;

	if ((0 < $summ1) && (0 < $profit_pers1)) {
		$op = ($summ1 / 100) * $profit_pers1;
		$profit1 = $profit1 + $op;
	}

	$profit1 = convert_sum($profit1, $vtype1, cur_type());
	$profit2 = $profit_summ2;

	if ((0 < $summ2) && (0 < $profit_pers2)) {
		$op = ($summ2 / 100) * $profit_pers2;
		$profit2 = $profit2 + $op;
	}

	$profit2 = convert_sum($profit2, $vtype2, cur_type());
	$profit = is_sum($profit1 + $profit2);
	return $profit;
}

function enable_to_ip($ip, $not_ip)
{
	$ip = trim($ip);
	$tip = explode(".", $ip);
	$not_ip = trim($not_ip);
	if ($ip && $not_ip) {
		$items = array();

		if (preg_match_all("/\[d](.*?)\[\/d]/s", $not_ip, $match, PREG_PATTERN_ORDER)) {
			$items = $match[1];
		}

		$oip = trim($oip);
		$otip1 = explode(".", $oip);
		$otip = array();

		foreach ($otip1 as $ot1 ) {
			$ot1 = trim($ot1);

			if ($ot1) {
				$otip[] = $ot1;
			}
		}

		$cotip = count($otip);

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Warning: Invalid argument supplied for foreach() in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

#Warning: array_values() expects parameter 1 to be array, null given in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

		while ($cotip == 4) {
			if (($otip[0] == $tip[0]) && ($otip[1] == $tip[1]) && ($otip[2] == $tip[2]) && ($otip[3] == $tip[3])) {
				return 0;
			}
		}

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Warning: Invalid argument supplied for foreach() in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

#Warning: array_values() expects parameter 1 to be array, null given in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

		while ($cotip == 3) {
			if (($otip[0] == $tip[0]) && ($otip[1] == $tip[1]) && ($otip[2] == $tip[2])) {
				return 0;
			}
		}

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Warning: Invalid argument supplied for foreach() in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1938

#Notice: Undefined index: jmpins in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

#Warning: array_values() expects parameter 1 to be array, null given in I:\RE_\Декодеры\CHINA\xcache56_ioncube9\Decompiler.class.php on line 1949

		while ($cotip == 2) {
			if (($otip[0] == $tip[0]) && ($otip[1] == $tip[1])) {
				return 0;
			}
		}
	}

	return 1;
}

function get_bids_url($hash)
{
	global $premiumbox;
	$hash = trim($hash);

	if ($hash) {
		$url = $premiumbox->get_page("exchangestep");
		$url = rtrim($url, "/") . "/hst_" . $hash . "/";
		return apply_filters("get_bids_url", $url, $hash);
	}

	return "#";
}

function get_sounds_live()
{
	$sounds = array();
	$foldervn = PN_PLUGIN_DIR . "audio/";
	$url = PN_PLUGIN_URL . "audio/";

	if (is_dir($foldervn)) {
		$dir = @opendir($foldervn);
		$abc_folders = array();

		while ($file = @readdir($dir)) {
			if (!strstr($file, ".")) {
				$abc_folders[$file] = $file;
			}
		}

		asort($abc_folders);
		$new_sounds = array();

		$nf = $foldervn . $folder . "/";
		$ndir = @opendir($nf);

		if (substr($nfile, -4) == ".mp3") {
			$new_sounds[$folder]["mp3"] = $url . $folder . "/" . $nfile;
		}

		if (substr($nfile, -4) == ".ogg") {
			$new_sounds[$folder]["ogg"] = $url . $folder . "/" . $nfile;
		}

		$r = 0;

		foreach ($new_sounds as $key => $ns ) {
			if (isset($ns["mp3"]) && isset($ns["ogg"])) {
				++$r;
				$sounds[] = array("id" => $r, "title" => $key, "mp3" => $ns["mp3"], "ogg" => $ns["ogg"]);
			}
		}
	}

	return $sounds;
}



function get_bid_status($status)
{
	global $wpdb;
	$bid_status_list = apply_filters("bid_status_list", array());
	$status_title = is_isset($bid_status_list, $status);

	if (!$status_title) {
		$status_title = __("Not known", "pn");
	}

	return $status_title;
}

function is_wm_purse($wm, $b)
{
	$b = (string) $b;
	$b = trim($b);
	$wm = (string) $wm;
	$wm = trim($wm);

	if (preg_match('/^'.$b.'[0-9]{12}$/', $wm, $matches)) {
		$r = $wm;
	}
	else {
		$r = false;
	}

	return $r;
}

function is_bid_hash($hash)
{
	$hash = pn_strip_input($hash);

	if (preg_match("/^[a-zA-z0-9]{35}$/", $hash, $matches)) {
		$r = $hash;
	}
	else {
		$r = 0;
	}

	return $r;
}
function update_direction_txtmeta($data_id, $key, $value){
	return update_txtmeta('napsmeta', $data_id, $key, $value);
}
function update_direction_meta($id, $key, $value){ 
	return update_pn_meta('directions_meta', $id, $key, $value);
}

function get_currency_meta($id, $key){ 
	return get_pn_meta('currency_meta', $id, $key);
}


function get_min_sum_to_naps_give($naps, $vd)
{
	return is_sum($naps->minsumm1, $vd->valut_decimal);
}

function get_min_sum_to_naps_get($naps, $vd)
{
	return is_sum($naps->minsumm2, $vd->valut_decimal);
}

function get_max_sum_to_naps_give($naps, $vd)
{
	return is_sum($naps->maxsumm1, $vd->valut_decimal);
}

function get_max_sum_to_naps_get($naps, $vd)
{
	return is_sum($naps->maxsumm2, $vd->valut_decimal);
}

function get_min_sum_to_direction_give($naps, $vd1, $vd2)
{
	return is_sum($naps->min_sum1, $vd1->currency_decimal);
}

function get_min_sum_to_direction_get($naps, $vd1, $vd2)
{
	return is_sum($naps->min_sum2, $vd2->currency_decimal);
}

function get_max_sum_to_direction_give($naps, $vd1, $vd2)
{
	return is_sum($naps->max_sum1, $vd1->currency_decimal);
}

function get_max_sum_to_direction_get($naps, $vd1, $vd2)
{
	return is_sum($naps->max_sum2, $vd2->currency_decimal);
}

function get_reserv_status_auto()
{
	$reserv_auto = get_option("reserv_auto");

	if (!is_array($reserv_auto)) {
		$reserv_auto = array();
	}

	$status_auto = array();

	foreach ($reserv_auto as $st ) {
		$status_auto[] = "'" . $st . "'";
	}

	if (0 < count($status_auto)) {
		return join(",", $status_auto);
	}

	return 0;
}

function get_reserv_status_in()
{
	$reserv_in = get_option("reserv_in");

	if (!is_array($reserv_in)) {
		$reserv_in = array();
	}

	$status_in = array();

	foreach ($reserv_in as $st ) {
		$status_in[] = "'" . $st . "'";
	}

	if (0 < count($status_in)) {
		return join(",", $status_in);
	}

	return 0;
}

function get_reserv_status_out()
{
	$reserv_out = get_option("reserv_out");

	if (!is_array($reserv_out)) {
		$reserv_out = array();
	}

	$status_out = array();

	foreach ($reserv_out as $st ) {
		$status_out[] = "'" . $st . "'";
	}

	if (0 < count($status_out)) {
		return join(",", $status_out);
	}

	return 0;
}

function get_merchant_file($file)
{
	$plugin_patch = str_replace("\\", "/", PN_PLUGIN_DIR);
	$path = str_replace("\\", "/", dirname($file));
	$path = str_replace($plugin_patch, "", $path);
	return $path;
}

function get_merchant_name($path)
{
	$name = explode("/", $path);
	$name = end($name);
	$name = is_modul_name($name);
	return $name;
}


function get_merchant_num($name)
{
	$num = preg_replace("/[^0-9]/", "", $name);
	return $num;
}

function is_deffin($data, $arg)
{
	if (isset($data[$arg]) && !strstr(is_isset($data, $arg), "СЃСЋРґР°")) {
		return trim(is_isset($data, $arg));
	}

	return "";
}

function is_pn_crypt($hash, $arg)
{
	$arg = trim((string) $arg);
	$hash = trim((string) $hash);


	if ($hash == pn_crypt_data($arg)) {

		return 1;
	}



	return 0;
}
function update_bids_naschet($id, $schet)
{
	global $wpdb;
	$id = intval($id);
	$schet = pn_strip_input($schet);
	$arr = array();
	$arr["naschet"] = $schet;
	$arr["naschet_h"] = pn_crypt_data($schet);
	$wpdb->update($wpdb->prefix . "bids", $arr, array("id" => $id));
}


function convert_mycurs($summ, $curs, $share)
{
	global $wpdb;
	$curs = is_sum($curs);

	if (0 < $curs) {
		if ($share == 0) {
			$sum_to = is_sum($summ / $curs);
			return $sum_to;
		}

		$sum_to = is_sum($summ * $curs);
		return $sum_to;
	}

	return 0;
}

function get_last_bid($status, $visible = "nv")
{
	global $wpdb;
	$status = is_status_name($status);
	$bid = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "bids WHERE status = '$status' ORDER BY editdate DESC LIMIT 1");
	$date_format = get_option("date_format");
	$time_format = get_option("time_format");
	$last_bid = array();

	if (isset($bid->id)) {
		$valut1 = intval($bid->valut1i);
		$vd1 = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "valuts WHERE id = '$valut1'");
		$valut2 = intval($bid->valut2i);
		$vd2 = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "valuts WHERE id = '$valut2'");
		if (is_object($vd1) && is_object($vd2)) {
			$last_bid = array("id" => $bid->id, "createdate" => get_mytime($bid->createdate, "$date_format, $time_format"), "createtime" => time($bid->createdate), "logo_give" => get_valut_logo($vd1), "sum_give" => is_sum($bid->summ1_dc, $vd1->valut_decimal), "ps_give" => pn_strip_input(ctv_ml($vd1->psys_title)), "vtype_give" => is_site_value($vd1->vtype_title), "logo_get" => get_valut_logo($vd2), "sum_get" => is_sum($bid->summ2c, $vd2->valut_decimal), "ps_get" => pn_strip_input(ctv_ml($vd2->psys_title)), "vtype_get" => is_site_value($vd2->vtype_title));
			$last_bid = apply_filters("last_bid", $last_bid, $bid, $vd1, $vd2, $visible);
		}
	}

	return $last_bid;
}

function get_last_bids($status, $visible = "nv", $limit = 3, $offset = 0)
{
	global $wpdb;
	$limit = intval($limit);

	if ($limit < 1) {
		$limit = 3;
	}

	$offset = intval($offset);
	$status = is_status_name($status);
	$bids = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "bids WHERE status = '$status' ORDER BY editdate DESC LIMIT $offset, $limit");
	$date_format = get_option("date_format");
	$time_format = get_option("time_format");
	$last_bids = array();

	if (is_array($bids)) {
		foreach ($bids as $bid ) {
			if (isset($bid->id)) {
				$valut1 = intval($bid->valut1i);
				$vd1 = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "valuts WHERE id = '$valut1'");
				$valut2 = intval($bid->valut2i);
				$vd2 = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "valuts WHERE id = '$valut2'");
				if (is_object($vd1) && is_object($vd2)) {
					$last_bid = array("id" => $bid->id, "createdate" => get_mytime($bid->createdate, "$date_format, $time_format"), "createtime" => time($bid->createdate), "logo_give" => get_valut_logo($vd1), "sum_give" => is_sum($bid->summ1_dc, $vd1->valut_decimal), "ps_give" => pn_strip_input(ctv_ml($vd1->psys_title)), "vtype_give" => is_site_value($vd1->vtype_title), "logo_get" => get_valut_logo($vd2), "sum_get" => is_sum($bid->summ2c, $vd2->valut_decimal), "ps_get" => pn_strip_input(ctv_ml($vd2->psys_title)), "vtype_get" => is_site_value($vd2->vtype_title));
					$last_bids[] = apply_filters("last_bid", $last_bid, $bid, $vd1, $vd2, $visible);
				}
			}
		}
	}

	return $last_bids;
}

function get_statusbids_for_admin()
{
	global $wpdb;
	$statused = apply_filters("bid_status_list", array());

	if (!is_array($statused)) {
		$statused = array();
	}

	$st = array();

	foreach ($statused as $k => $v ) {
		$st[$k] = array("name" => $k, "title" => $v, "color" => "", "background" => "");
	}

	return apply_filters("get_statusbids_for_admin", $st);
}

function set_merchant_data($path, $map)
{
	$new_data = array();

	if (is_file(PN_PLUGIN_DIR . $path . ".php")) {
		include (PN_PLUGIN_DIR . $path . ".php");

		if (isset($marr) && is_array($marr)) {
			foreach ($map as $val ) {
				if (isset($marr[$val])) {
					$new_data[$val] = trim($marr[$val]);
				}
			}
		}
		else {
			foreach ($map as $val ) {
				$val = str_replace("\$", "", $val);

				if (isset($val)) {
					$new_data[$val] = trim($$val);
				}
			}

			foreach ($map as $val ) {
				if (defined($val)) {
					$new_data[$val] = constant($val);
				}
			}
		}
	}

	return $new_data;
}



function pn_list_user_menu()
{
	$items = get_list_user_menu();
	$list_page = "<ul>";

	if (is_array($items)) {
		foreach ($items as $data ) {
			$target = "";

			if (isset($data["target"]) && $data["target"]) {
				$target = "target=\"_blank\"";
			}

			$id = "";

			if (isset($data["id"]) && $data["id"]) {
				$id = "id=\"" . $data["id"] . "\"";
			}

			$class = is_isset($data, "class");
			$list_page .= "<li class=\"" . $class . " " . is_place_url($data["url"]) . "\" " . $id . "><a href=\"" . $data["url"] . "\" " . $target . ">" . $data["title"] . "</a></li>";
		}
	}

	$list_page .= "</ul>";
	return $list_page;
}

function admin_pass_protected($label, $text)
{
	die('error admin_pass_protected');
}

function def_admin_pass_protected()
{
	die('error def_admin_pass_protected');
}
function is_true_userhash($item)
{
}

function convert_sum($summ, $type, $totype)
{
	global $wpdb;
	$res = $wpdb->get_row("SELECT `d`.* FROM `" . $wpdb->prefix . "directions` `d`, `" . $wpdb->prefix . "currency` `c1`,  `" . $wpdb->prefix . "currency` `c2` WHERE `c1`.`currency_code_title`='".$type."' AND `c2`.`currency_code_title`='".$totype."' AND `d`.`currency_id_give`=`c1`.`id` AND `d`.`currency_id_get`=`c2`.`id` LIMIT 1");
	if($res->course_give == 1)
	{
		return $summ * $res->course_get;
	}
	else
	{
		return $summ / $res->course_get;
	}
}
function sum_after_comis($summ, $comis)
{
	return $summ - ($summ / 100) * $comis;
}

function get_caller_info() {
    $c = '';
    $file = '';
    $func = '';
    $class = '';
    $trace = debug_backtrace();
    if (isset($trace[2])) {
        $file = $trace[1]['file'];
        $func = $trace[2]['function'];
        if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
            $func = '';
        }
    } else if (isset($trace[1])) {
        $file = $trace[1]['file'];
        $func = '';
    }
    if (isset($trace[3]['class'])) {
        $class = $trace[3]['class'];
        $func = $trace[3]['function'];
        $file = $trace[2]['file'];
    } else if (isset($trace[2]['class'])) {
        $class = $trace[2]['class'];
        $func = $trace[2]['function'];
        $file = $trace[1]['file'];
    }
    if ($file != '') $file = basename($file);
    $c = $file . ": ";
    $c .= ($class != '') ? ":" . $class . "->" : "";
    $c .= ($func != '') ? $func . "(): " : "";
    return($c);
}


function get_calc_data($data)
{
	//$vd1, $vd2, $naps, $user_id, $post_sum, $check1, $check2, $dej
//var_dump($data);
//die();
	$cdata = array();
	$cdata['currency_code_give'] = $data['vd1']->currency_code_title;
	$cdata['currency_code_get'] = $data['vd2']->currency_code_title;
	$cdata['psys_give'] = $data['vd1']->psys_title;
	$cdata['psys_get'] = $data['vd2']->psys_title;
	$cdata['comis_text1'] = $data['vd1']->show_give;
	$cdata['viv_com1'] = $data['vd1']->cf_hidden;
	$cdata['comis_text2'] = $data['vd2']->show_get;
	$cdata['viv_com2'] = $data['vd2']->cf_hidden;
	$cdata['sum1'] = $data['post_sum'];
	$cdata['sum1c'] = 0;
	$cdata['sum2'] = 0;
	$cdata['sum2c'] = 0;
	$cdata['com_ps1'] = 0;
	$cdata['com_ps2'] = 0;
	$cdata['decimal_give'] = $data['vd1']->currency_decimal;
	$cdata['decimal_get'] = $data['vd2']->currency_decimal;
	$cdata['course_give'] = $data['direction']->course_give;
	$cdata['course_get'] = $data['direction']->course_get;
	$cdata['user_discount'] = 0;
	$cdata['user_discount_sum'] = 0;

	if(isset($data['ui']) && isset($data['ui']->id) && intval($data['ui']->id) > 0 && intval($data['direction']->enable_user_discount) > 0)
	{
		$cdata['user_discount'] = $data['ui']->user_discount;
		$max = 0;
		if(0 < $data['direction']->max_user_discount)
		{
			$max = ($cdata['sum1'] / 100) * $data['direction']->max_user_discount;
		}
		$cdata['user_discount_sum'] = get_us_sk($cdata['sum1'], $data['ui']->id, 1, $max);
	}


		$amount = ($cdata['sum1'] / $data['direction']->course_give) * $data['direction']->course_get;
		$cdata['sum2'] = is_sum($amount, $cdata['decimal_get']);
		
		
	if(intval($data['direction']->pay_com1) == 0)
	{
		if(intval($data['direction']->check_purse) == 1)
		{
			$cdata['com_ps1'] = get_dop_comm( $cdata['sum1'], $data['direction']->com_sum1_check, $data['direction']->com_pers1_check, $data['direction']->minsum1com);
		}
		else
		{
			$cdata['com_ps1'] = get_dop_comm( $cdata['sum1'], $data['direction']->com_sum1, $data['direction']->com_pers1, $data['direction']->minsum1com);
		}
			if($cdata['com_ps1'] > $data['direction']->maxsum1com)
				$cdata['com_ps1'] = $data['direction']->maxsum1com;
	}
	
	if(intval($data['direction']->pay_com2) == 0)
	{
		if(intval($data['direction']->check_purse) == 1)
		{
			$cdata['com_ps2'] = get_dop_comm( $cdata['sum2'], $data['direction']->com_sum2_check, $data['direction']->com_pers2_check, $data['direction']->minsum2com);
		}
		else
		{
			$cdata['com_ps2'] = get_dop_comm( $cdata['sum2'], $data['direction']->com_sum2, $data['direction']->com_pers2, $data['direction']->minsum2com);
		}
			if($cdata['com_ps2'] > $data['direction']->maxsum2com)
				$cdata['com_ps2'] = $data['direction']->maxsum2com;
	}

	/* нестандартная комиссия, тоесть списывается при входящем платеже
    ["nscom1"]=>
    string(1) "0"
    ["nscom2"]=>
    string(1) "0"
	*/
	
	// Сумма (с доп. ком. и ПС ком.)
	$cdata['sum1c'] = $cdata['sum1'] + $cdata['com_ps1'];
	$cdata['sum2c'] = $cdata['sum2'];
	$cdata['sum2'] = $cdata['sum2'] - $cdata['com_ps2'];

	// Дополнительные комиссии
	$cdata['dop_com1'] = get_dop_comm( $cdata['sum1'], $data['direction']->com_box_sum1, $data['direction']->com_box_pers1, $data['direction']->com_box_min1);
	$cdata['dop_com2'] = get_dop_comm( $cdata['sum2'], $data['direction']->com_box_sum2, $data['direction']->com_box_pers2, $data['direction']->com_box_min2);
	
	// Сумма (с доп. ком.)
	$cdata['sum1dc'] = $cdata['sum1'] + $cdata['dop_com1'];
	$cdata['sum2dc'] = $cdata['sum2'];
	$cdata['sum2'] = $cdata['sum2'] - $cdata['dop_com2'];

	$cdata['ref_id'] = 0;
	if(isset($data['ui']->data->ref_id))
	{
		$cdata['ref_id'] = intval($data['ui']->data->ref_id);
	}

	// Партнер заработал
	$cdata['partner_sum'] = 0;
	// Партнерский процент
	$cdata['partner_pers'] = 0;
	
	// дисконты - скидки
	$cdata['dis1'] = 0;
	$cdata['dis2'] = 0;
	
	// дисконты с комиссией
	$cdata['dis1c'] = 0;
	$cdata['dis2c'] = 0;

	// для реферала
	$cdata['sum1r'] = 0;
	$cdata['sum2r'] = 0;

	// Сумма для резерва
	$cdata['sum1cr'] = 0;
	$cdata['sum2cr'] = 0;

	// Сумма во внутренней валюте
	$cdata['exsum'] = 0;
	
	//Сумма по курсу
	$cdata['sum2t'] = 0;
	
	// Прибыль
	$cdata['profit'] = ($cdata['sum2'] / 100) * $data['direction']->profit_pers2;
	
	return $cdata;
}

function bid_hashdata($obmen_id, $obmen, $t='')
{
	if(is_object($obmen))
	{
		$obmen_data = array();
		foreach($obmen as $key => $value){
			$obmen_data[$key] = $value;
		}
		
		$my_dir = wp_upload_dir();
		$dir = $my_dir['basedir'].'/bids/';
		if(!is_dir($dir)){
			@mkdir($dir, 0777);
		}
					
		$htacces = $dir.'.htaccess';
		if(!is_file($htacces)){
			$nhtaccess = "Order allow,deny \n Deny from all";
			$file_open = @fopen($htacces, 'w');
			@fwrite($file_open, $nhtaccess);
			@fclose($file_open);		
		}
					
		$file = $dir . $obmen_id .'.txt';
		$file_data = serialize($obmen_data);
		$file_open = @fopen($file, 'w');
		@fwrite($file_open, $file_data);
		@fclose($file_open);
	}
}

function get_us_sk($summ, $user_id, $user_sk, $max_user_sk)
{
	if ($user_id && (0 < $summ) && ($user_sk == 1)) {
		$skidka = get_user_discount($user_id);

		if (0 < $skidka) {
			if ((0 < $max_user_sk) && ($max_user_sk < $skidka)) {
				$skidka = $max_user_sk;
			}

			return ($summ / 100) * $skidka;
		}
	}

	return 0;
}


function get_secret_value($text, $id)
{
	return $text;
}
function pers_alter_summ($summ, $pers)
{
	die('error pers_alter_summ');
}

function get_ps_comm($summ, $com_summ, $com_pers, $minsumm, $maxsumm, $standart)
{
	var_dump($summ, $com_summ, $com_pers, $minsumm, $maxsumm, $standart);
	die('error get_ps_comm');
}
function get_operator_status()
{
	die('error get_operator_status');
}

function get_cf_field($value, $item)
{
	return $value;
}
function update_vtypes_to_parser()
{
	die('error update_vtypes_to_parser');
}
function update_naps_to_parser()
{
	die('error update_naps_to_parser');
}
function update_directions_to_parser()
{
	die('error update_directions_to_parser');
}
//function pn_sfilter($arg){}

function update_naps_to_masschange($id)
{
	die('error update_naps_to_masschange');
}
function update_direction_to_masschange($id)
{
	die('error update_direction_to_masschange');
}
function get_naps_reserv($valut_reserv, $decimal, $naps, $visual)
{
	return number_format($valut_reserv, $decimal, '.', '');
}

function get_direction_reserv($valut_reserv, $decimal, $naps)
{
	return number_format($valut_reserv, $decimal, '.', '');
}

function get_course1($curs, $lead_num, $decimal, $place, $visible)
{
	var_dump($curs, $lead_num, $decimal, $place, $visible);
	die('error get_course1');
}

function get_course2($lead_num, $curs1, $curs2, $decimal, $place, $visible)
{
	var_dump($lead_num, $curs1, $curs2, $decimal, $place, $visible);
	die('error get_course2');
}



function get_dop_comm($summ, $com_box_summ, $com_box_pers, $com_box_min)
{
	$comis = floatval($com_box_min);
	if(floatval($com_box_summ) > 0)
		$comis = floatval($com_box_summ);
	elseif(floatval($com_box_pers) > 0)
	{
		$comis = ($summ / 100) * floatval($com_box_pers);
		if($comis < $com_box_min)
			$comis = $com_box_min;
	}
	return $comis;
}

function pn_crypt_data($arg)
{
	$arg = trim((string) $arg);
	return sha1($arg);
}

function update_directions_to_new_parser($data=false)
{
	return;
	var_dump($data);
	die('its update_directions_to_new_parser');
	
}


function update_currency_code_to_new_parser($data=false)
{
	return;
	var_dump($data);
	die('error update_currency_code_to_new_parser');
	
}


