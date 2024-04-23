<?php

function check_podmena($item, $data_fs)
{
	return 0;
}

function get_valut_in($valut_id, $zn = 2)
{
	global $wpdb;
	$valut_id = intval($valut_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE valut1i='$valut_id' AND status = 'success'");
	$sum = is_sum($sum + $sum1, $zn);
	$sum = apply_filters("get_valut_in", $sum, $valut_id, $zn, "success");
	return $sum;
}

function get_currency_in($valut_id, $zn = 2)
{
	global $wpdb;
	$valut_id = intval($valut_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE valut1i='$valut_id' AND status = 'success'");
	$sum = is_sum($sum + $sum1, $zn);
	$sum = apply_filters("get_currency_in", $sum, $valut_id, $zn, "success");
	return $sum;
}

function get_currency_out($valut_id, $zn = 2)
{
	global $wpdb;
	$valut_id = intval($valut_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE valut2i='$valut_id' AND status = 'success'");
	$sum = is_sum($sum + $sum1, $zn);
	$sum = apply_filters("get_currency_out", $sum, $valut_id, $zn, "success");
	return $sum;
}

function get_valut_out($valut_id, $zn = 2)
{
	global $wpdb;
	$valut_id = intval($valut_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE valut2i='$valut_id' AND status = 'success'");
	$sum = is_sum($sum + $sum1, $zn);
	$sum = apply_filters("get_valut_out", $sum, $valut_id, $zn, "success");
	return $sum;
}

function get_sum_valut($valut_id, $method = "in", $date = "")
{
	global $wpdb;
	$valut_id = intval($valut_id);

	if ($method != "in") {
		$method = "out";
	}

	$date = pn_strip_input($date);
	$where = "";

	if ($method == "in") {
		$st = get_reserv_status_in();
	}
	else {
		$st = get_reserv_status_out();
	}

	if ($st) {
		$where = " AND status IN($st)";
	}
	else {
		$where = " AND status = 'success'";
	}

	if ($date) {
		$where .= " AND createdate >= '$date'";
	}

	$sum = 0;

	if ($method == "in") {
		$sum1 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE valut1i='$valut_id' $where");
	}
	else {
		$sum1 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE valut2i='$valut_id' $where");
	}

	$sum = is_sum($sum + $sum1);
	return $sum;
}

function get_summ_naps_all($naps_id, $method = "out", $date = "")
{
	global $wpdb;
	$naps_id = intval($naps_id);

	if ($method != "in") {
		$method = "out";
	}

	$date = pn_strip_input($date);
	$where = "";

	if ($method == "in") {
		$st = get_reserv_status_in();
	}
	else {
		$st = get_reserv_status_out();
	}

	if ($st) {
		$where = " AND status IN($st)";
		$filter_status = $st;
	}
	else {
		$where = " AND status = 'success'";
		$filter_status = "'success'";
	}

	if ($date) {
		$where .= " AND createdate >= '$date'";
	}

	$sum = 0;

	if ($method == "in") {
		$sum1 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE naps_id='$naps_id' $where");
	}
	else {
		$sum1 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE naps_id='$naps_id' $where");
	}

	$sum = is_sum($sum + $sum1);
	$sum = apply_filters("get_summ_naps_all", $sum, $naps_id, $method, $filter_status, $date);
	return $sum;
}

function get_reserv_vtype($vtype_id)
{
	global $wpdb;
	$vtype_id = intval($vtype_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(trans_summ) FROM " . $wpdb->prefix . "trans_reserv WHERE vtype_id='$vtype_id'");
	$sum2 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE vtype1i='$vtype_id' AND status = 'success'");
	$sum3 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE vtype2i='$vtype_id' AND status = 'success'");
	$sum = is_sum(($sum + $sum1 + $sum2) - $sum3);
	$sum = apply_filters("get_reserv_vtype", $sum, $vtype_id);
	return $sum;
}

function get_vaccount_sum($accountnum, $method = "in", $date = "")
{
	global $wpdb;
	$accountnum = pn_strip_input($accountnum);
	$date = pn_strip_input($date);
	$where = "";

	if ($method == "in") {
		$st = get_reserv_status_in();
	}
	else {
		$st = get_reserv_status_out();
	}

	if ($st) {
		$where = " AND status IN($st)";
	}
	else {
		$where = " AND status = 'success'";
	}

	if ($date) {
		$where .= " AND createdate >= '$date'";
	}

	$sum = 0;

	if ($method == "in") {
		$sum1 = $wpdb->get_var("SELECT SUM(summ1cr) FROM " . $wpdb->prefix . "bids WHERE naschet='$accountnum' $where");
	}
	else {
		$sum1 = $wpdb->get_var("SELECT SUM(summ2cr) FROM " . $wpdb->prefix . "bids WHERE naschet='$accountnum' $where");
	}

	$sum = is_sum($sum + $sum1);
	return $sum;
}

function get_sum_for_autopay($m_id, $date = "")
{
	global $wpdb;
	$where = "";

	if ($date) {
		$where .= " AND createdate >= '$date'";
	}

	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summ2c) FROM " . $wpdb->prefix . "bids WHERE m_out='$m_id' AND status IN('success','coldsuccess') $where");
	$sum = is_sum($sum + $sum1);
	return $sum;
}

function get_partner_plinks($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$count_real = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "plinks WHERE user_id='$user_id'");
	$count_arch = $wpdb->get_var("SELECT SUM(meta_value) FROM " . $wpdb->prefix . "archive_data WHERE meta_key='plinks' AND item_id='$user_id'");
	$count = $count_arch + $count_real;
	$count = apply_filters("partner_plinks", $count, $user_id);
	return $count;
}

function get_user_pers_refobmen($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sk = 0;
	$ui = get_userdata($user_id);

	if (isset($ui->partner_pers)) {
		$partner_pers = is_sum($ui->partner_pers);

		if (0 < $partner_pers) {
			$sk = $partner_pers;
		}
		else {
			$sm = is_sum(get_user_sum_refobmen($user_id));
			$data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "partner_pers WHERE ('$sm' -0.0) >= sumec ORDER BY (sumec -0.0) DESC");

			if (isset($data->pers)) {
				$sk = is_sum($data->pers);
			}
		}
	}

	$sk = apply_filters("user_pers_refobmen", $sk, $user_id);
	return $sk;
}

function get_user_discount($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sk = 0;
	$ui = get_userdata($user_id);

	if (isset($ui->user_discount)) {
		$user_discount = is_sum($ui->user_discount);

		if (0 < $user_discount) {
			$sk = $user_discount;
		}
	}

	$sk = apply_filters("user_discount", $sk, $user_id);
	return $sk;
}

function get_partner_payout($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(pay_sum_or) FROM " . $wpdb->prefix . "payoutuser WHERE user_id='$user_id' AND status='1'");
	$sum = $sum + $sum1;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("partner_payout", $d_sum, $sum, $user_id);
	return $d_sum;
}

function get_user_count_refobmen($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$count = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "bids WHERE pcalc='1' AND status='success' AND ref_id='$user_id'");
	$count = apply_filters("user_count_refobmen", $count, $user_id);
	return $count;
}

function get_user_count_exchanges($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$summ = 0;
	$sum1 = $wpdb->query("SELECT id FROM " . $wpdb->prefix . "bids WHERE user_id='$user_id' AND status='success'");
	$summ = $summ + $sum1;
	//$summ = apply_filters("user_count_exchanges", $summ, $user_id);
	return $summ;
}

function get_user_sum_refobmen($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(exsum) FROM " . $wpdb->prefix . "bids WHERE pcalc='1' AND status='success' AND ref_id='$user_id'");
	$sum = $sum + $sum1;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("user_sum_refobmen", $d_sum, $sum, $user_id);
	return $d_sum;
}

function get_user_sum_exchanges($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(exsum) FROM " . $wpdb->prefix . "bids WHERE status='success' AND user_id='$user_id'");
	$sum = $sum + $sum1;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("user_sum_exchanges", $d_sum, $sum, $user_id);
	return $d_sum;
}

function get_partner_earn_all($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summp) FROM " . $wpdb->prefix . "bids WHERE pcalc='1' AND status='success' AND ref_id='$user_id'");
	$sum = $sum + $sum1;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("get_partner_earn_all", $d_sum, $sum, $user_id);
	return $d_sum;
}

function get_partner_money($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summp) FROM " . $wpdb->prefix . "bids WHERE pcalc='1' AND status='success' AND ref_id='$user_id'");
	$sum2 = $wpdb->get_var("SELECT SUM(pay_sum_or) FROM " . $wpdb->prefix . "payoutuser WHERE user_id='$user_id' AND status ='1'");
	$sum = ($sum + $sum1) - $sum2;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("partner_money", $d_sum, $sum, $user_id);
	return $d_sum;
}

function get_partner_money_now($user_id)
{
	global $wpdb;
	$user_id = intval($user_id);
	$sum = 0;
	$sum1 = $wpdb->get_var("SELECT SUM(summp) FROM " . $wpdb->prefix . "bids WHERE pcalc='1' AND status='success' AND ref_id='$user_id'");
	$sum2 = $wpdb->get_var("SELECT SUM(pay_sum_or) FROM " . $wpdb->prefix . "payoutuser WHERE user_id='$user_id' AND status IN('0','1')");
	$sum = ($sum + $sum1) - $sum2;
	$d_sum = is_sum($sum);
	$d_sum = apply_filters("partner_money_now", $d_sum, $sum, $user_id);
	return $d_sum;
}

function update_valut_reserv($valut_id, $item)
{
	
}

function update_currency_reserv($valut_id, $item=false)
{
	if($item)
	{
		global $wpdb;
		$sum = floatval($item->reserv_place);
		$wpdb->query("UPDATE ". $wpdb->prefix ."currency_reserv SET trans_sum = '$sum' WHERE currency_id = '$valut_id'");
	}
}


?>
