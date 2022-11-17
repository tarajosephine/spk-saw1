<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pelatihan_model', 'pelatihan');
	}

	public function getDataKegiatanModal()
	{
		$data = $this->pelatihan->get_datatablesKegiatan();
		$datane = [];
		$no = 1;
		foreach ($data as $d) {
			$row = array();
			$row['no'] = $no;
			$row['nama_kegiatan'] = $d['nama_kegiatan'];
			$row['tgl_pelatihan'] = $d['tgl_pelatihan'];
			$row['tgl_selesai_p'] = $d['tgl_selesai_p'];
			$row['waktu_pelatihan'] = $d['waktu_pelatihan'];
			$row['tempat'] = $d['tempat'];
			$row['kuota'] = $d['kuota'];
			$row['nama_usaha'] = $d['nama_usaha'];
			$row['id_p'] = $d['id_p'];
			$datane[] = $row;
		}
		$output = array(
			'draw' => intval($_POST["draw"]),
			"recordsTotal" => $this->pelatihan->count_allKegiatan(),
			"recordsFiltered" => $this->pelatihan->count_filteredKegiatan(),
			"data" => $datane,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	// Pelatihan
	public function index()
	{
		$data['title'] = 'Kegiatan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();

		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('waktu_mulai_pelatihan', 'Tanggal Pelatihan', 'required');
		$this->form_validation->set_rules('waktu_akhir_pelatihan', 'Tanggal Pelatihan', 'required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'required');
		$this->form_validation->set_rules('kuota', 'Kuota', 'required');
		$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('pemasaran/index', $data);
			$this->load->view('templates/footer');
		} else {
			$time = $this->input->post('waktu_mulai_pelatihan') . "WIB" . " Sampai " . $this->input->post('waktu_akhir_pelatihan') . "WIB";
			$data = [
				'nama_kegiatan' => $this->input->post('nama_kegiatan'),
				'tgl_pelatihan' => $this->input->post('tgl_pelatihan'),
				'tgl_selesai_p' => $this->input->post('tgl_selesai_p'),
				'waktu_pelatihan' => $time,
				'tempat' => $this->input->post('tempat'),
				'kuota' => $this->input->post('kuota'),
				'id_ju' => $this->input->post('jenis_usaha')
			];
			$this->db->insert('pelatihan', $data);
			$this->session->set_flashdata(
				'message_pelatihan',
				'<div class="alert alert-success" role="alert">
					Tambah Pelatihan Berhasil!
				</div>'
			);
			redirect('pemasaran');
		}
	}

	public function getPelatihanModal()
	{
		$data = $this->db->get_where('pelatihan', ['id_p' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editPelatihanModal()
	{
		$data['title'] = 'Pelatihan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pelatihan'] = $this->db->get('pelatihan')->result_array();

		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('tgl_pelatihan', 'Tanggal Pelatihan', 'required');
		$this->form_validation->set_rules('waktu_pelatihan', 'Waktu Pelatihan', 'required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'required');
		$this->form_validation->set_rules('kuota', 'Kuota', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('pemasaran/index', $data);
			$this->load->view('templates/footer');
		} else {
			$time = $this->input->post('waktu_mulai_pelatihan') . "WIB" . " Sampai " . $this->input->post('waktu_akhir_pelatihan') . "WIB";
			$data = [
				'nama_kegiatan' => $this->input->post('nama_kegiatan'),
				'tgl_pelatihan' => $this->input->post('tgl_pelatihan'),
				'tgl_selesai_p' => $this->input->post('tgl_selesai_p'),
				'waktu_pelatihan' => $time,
				'tempat' => $this->input->post('tempat'),
				'kuota' => $this->input->post('kuota')
			];
			$this->pelatihan->editPelatihanById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_pelatihan',
				'<div class="alert alert-success" role="alert">
						Success Edit Pelatihan!
					</div>'
			);
			redirect('pemasaran');
		}
	}

	public function deletePelatihanModal()
	{
		$this->pelatihan->deletePelatihanById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_pelatihan',
			'<div class="alert alert-success" role="alert">
				Success Hapus Pelatihan!
			</div>'
		);
		redirect('pemasaran');
	}

	// Pendaftaran Pelatihan

	public function createPendafataranPelatihan($id_p, $id_ju)
	{
		$data['title'] = 'Pelatihan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['id_P'] = $id_p;
		$data['id_JU'] = $id_ju;
		$data['pelatihan'] = $this->db->get_where('pelatihan', ['id_p' => $id_p])->result_array();
		$data['peserta'] = $this->pelatihan->showPelatihan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pemasaran/tambahpeserta', $data);
		$this->load->view('templates/footer');
	}

	public function getPeserta()
	{
		$data = $this->pelatihan->showPesertaById($_POST['id']);
		echo json_encode($data);
	}

	public function getShowPeserta()
	{
		$data = $this->pelatihan->showPelatihan();
		echo json_encode($data);
	}

	public function insertPelatihan()
	{
		$data = [
			'id_peserta' => $_POST['id'],
			'id_pelatihan' => $_POST['idPelatihan'],
			'tgl_pendaftaran' => date('y-m-d')
		];
		$this->db->insert('pendaftaran', $data);
		$dataa = [
			'validasi_p' => date('y')
		];
		$this->pelatihan->editPesertaById($_POST['id'], $dataa);
	}

	public function pendaftaranPelatihan()
	{
		$data['title'] = 'Pendaftaran Pelatihan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pendaftaran'] = $this->pelatihan->showPP();
		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['pelatihan'] = $this->db->get('pelatihan')->result_array();

		$this->form_validation->set_rules('id_peserta', 'Nama Peserta', 'required');
		$this->form_validation->set_rules('id_pelatihan', 'Pelatihan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('pemasaran/pendaftaranPelatihan', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_peserta' => $this->input->post('id_peserta'),
				'id_pelatihan' => $this->input->post('id_pelatihan'),
				'tgl_pendaftaran' => date('y-m-d')
			];
			$this->db->insert('pendaftaran', $data);
			$this->session->set_flashdata(
				'message_pendaftaranPelatihan',
				'<div class="alert alert-success" role="alert">
					Tambah Pelatihan Berhasil!
				</div>'
			);
			redirect('pemasaran/pendaftaranPelatihan');
		}
	}

	public function getPendaftarPelatihanModal()
	{
		$data = $this->db->get_where('pendaftaran', ['id_pendaftaran' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editPendaftarPelatihanModal()
	{
		$data['title'] = 'Pendaftaran Pelatihan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pendaftaran'] = $this->pelatihan->showPP();
		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['pelatihan'] = $this->db->get('pelatihan')->result_array();

		$this->form_validation->set_rules('id_peserta', 'Nama Peserta', 'required');
		$this->form_validation->set_rules('id_pelatihan', 'Pelatihan', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('pemasaran/pendaftaranPelatihan', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_peserta' => $this->input->post('id_peserta'),
				'id_pelatihan' => $this->input->post('id_pelatihan')
			];
			$this->pelatihan->editPPById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_pendaftaranPelatihan',
				'<div class="alert alert-success" role="alert">
						Success Edit Pelatihan!
					</div>'
			);
			redirect('pemasaran/pendaftaranPelatihan');
		}
	}

	public function deletePendaftarPelatihanModal()
	{
		$this->pelatihan->deletePPById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_pendaftaranPelatihan',
			'<div class="alert alert-success" role="alert">
				Success Hapus Pelatihan!
			</div>'
		);
		redirect('pemasaran/pendaftaranPelatihan');
	}
}
