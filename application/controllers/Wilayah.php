<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pelatihan_model', 'pelatihan');
	}

	public function kecamatan()
	{

		$data['title'] = 'Data Kecamatan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();

		$this->form_validation->set_rules('nama_kec', 'Nama Kecamatan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('wilayah/kecamatan', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_kec' => $this->input->post('nama_kec'),
			];
			$this->db->insert('kecamatan', $data);
			$this->session->set_flashdata(
				'message_kecamatan',
				'<div class="alert alert-success" role="alert">
					Data Kecamatan baru telah ditambahkan!!
				</div>'
			);
			redirect('wilayah/kecamatan');
		}
	}

	public function getKecamatanModal()
	{
		$data = $this->db->get_where('kecamatan', ['id_kec' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editKecamatanModal()
	{
		$data['title'] = 'Data Kecamatan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();

		$this->form_validation->set_rules('nama_kec', 'Nama Kecamatan', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('wilayah/kecamatan', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_kec' => $this->input->post('nama_kec'),
			];
			$this->pelatihan->editKecamatanById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_kecamatan',
				'<div class="alert alert-success" role="alert">
						Success Edit Data Kecamatan!
					</div>'
			);
			redirect('wilayah/kecamatan');
		}
	}

	public function deleteKecamatanModal()
	{
		$this->pelatihan->deleteKecamatanById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_kecamatan',
			'<div class="alert alert-success" role="alert">
				Success Delete Data Kecamatan!
			</div>'
		);
		redirect('wilayah/kecamatan');
	}

	// Desa
	public function desa()
	{
		$data['title'] = 'Data Desa';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['desa'] = $this->pelatihan->showD();
		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();

		$this->form_validation->set_rules('id_kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('wilayah/desa', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_kec' => $this->input->post('id_kec'),
				'nama_desa' => $this->input->post('nama_desa'),
			];
			$this->db->insert('desa', $data);
			$this->session->set_flashdata(
				'message_desa',
				'<div class="alert alert-success" role="alert">
					Data Desa baru telah ditambahkan!!
				</div>'
			);
			redirect('wilayah/desa');
		}
	}

	public function getDesaModal()
	{
		$data = $this->db->get_where('desa', ['id_desa' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function getDesaResultModal()
	{
		$data = $this->db->get_where('desa', ['id_kec' => $_POST['id']])->result_array();
		echo json_encode($data);
	}

	public function editDesaModal()
	{
		$data['title'] = 'Data Desa';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['desa'] = $this->pelatihan->showD();
		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();

		$this->form_validation->set_rules('id_kec', 'Kecamatan', 'required');
		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('wilayah/desa', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_kec' => $this->input->post('id_kec'),
				'nama_desa' => $this->input->post('nama_desa'),
			];
			$this->pelatihan->editDesaById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_desa',
				'<div class="alert alert-success" role="alert">
						Success Edit Data Desa!
					</div>'
			);
			redirect('wilayah/desa');
		}
	}

	public function deleteDesaModal()
	{
		$this->pelatihan->deleteDesaById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_desa',
			'<div class="alert alert-success" role="alert">
				Success Delete Data Desa!
			</div>'
		);
		redirect('wilayah/desa');
	}
}