<?php

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('role_id');
		$menu = $ci->uri->segment(1);

		$queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
		$menu_id = $queryMenu['id'];

		$userAccess = $ci->db->get_where('user_access_menu', [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		]);

		if ($userAccess->num_rows() < 1) {
			redirect('auth/blocked');
		}
	}
}

function check_access($role_id, $menu_id)
{
	$ci = get_instance();

	$result = $ci->db->get_where('user_access_menu', [
		'role_id' => $role_id,
		'menu_id' => $menu_id
	]);

	if ($result->num_rows() > 0) {
		return "checked='checked'";
	}
}

function longdate_indo($tanggal)
{
	$ubah = gmdate($tanggal, time() + 60 * 60 * 8);
	$pecah = explode("-", $ubah);
	$tgl = $pecah[2];

	$nama = date("l", mktime(0, 0, 0, $tgl));
	$nama_hari = "";
	if ($nama == "Sunday") {
		$nama_hari = "Minggu";
	} else if ($nama == "Monday") {
		$nama_hari = "Senin";
	} else if ($nama == "Tuesday") {
		$nama_hari = "Selasa";
	} else if ($nama == "Wednesday") {
		$nama_hari = "Rabu";
	} else if ($nama == "Thursday") {
		$nama_hari = "Kamis";
	} else if ($nama == "Friday") {
		$nama_hari = "Jumat";
	} else if ($nama == "Saturday") {
		$nama_hari = "Sabtu";
	}
	return $nama_hari;
}

function tgl_angka($tanggal)
{
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2];
}

function bln_indo($tanggal)
{
	$bulan = [
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	];
	$pecahkan = explode('-', $tanggal);
	return $bulan[(int)$pecahkan[1]];
}

function thn_angka($tanggal)
{
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[0];
}

function tgl_indo($tanggal)
{
	$bulan = [
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	];
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgl_indo2($tanggal)
{
	$bulan = [
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	];
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
}

function rupiah($angka)
{
	$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}

function angkaa($angka)
{
	$hasil_rupiah = number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}
