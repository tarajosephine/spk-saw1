<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model', 'mm');
	}

	public function index()
	{
		$data['title'] = 'Home';
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/index', $data);
		$this->load->view('templates/frondendFooter');
	}

	public function Pelayanan()
	{
		$data['title'] = 'Pelayanan';
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/pelayanan', $data);
		$this->load->view('templates/frondendFooter');
	}

	public function rekomendasi()
	{
		$data['title'] = 'Rekomendasi';
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/rekomendasi', $data);
		$this->load->view('templates/frondendFooter');
	}

	public function Tentang()
	{
		$data['title'] = 'Tentang';
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/tentang', $data);
		$this->load->view('templates/frondendFooter');
	}

	public function getDPelangan()
	{
		$keyword = $_GET['query'];
		$data = $this->mm->getAutoSearch($keyword);
		$datane = [];
		foreach ($data as $d) {
			$row = array();
			$row['value'] = $d['cid'];
			$row['nama'] = $d['cid'];
			$row['name'] = $d['nama'];
			$row['alamat'] = $d['alamat'];
			$datane[] = $row;
		}
		$output = array(
			"suggestions" => $datane,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getChekDPelangan()
	{
		$keyword = $_POST['query'];
		$data = $this->mm->getAutoSearch($keyword);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
