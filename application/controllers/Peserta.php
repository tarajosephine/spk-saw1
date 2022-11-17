<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pelatihan_model', 'pelatihan');
	}
	private $filename = "import_data"; // Kita tentukan nama filenya
	private $filename2 = "import_data2"; // Kita tentukan nama filenya
	private $filename3 = "import_data3"; // Kita tentukan nama filenya

	// Peserta
	public function index()
	{
		$data['title'] = 'Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$this->form_validation->set_rules('nama_peserta', 'Nama Peserta', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('id_desa', 'Desa', 'required');
		$this->form_validation->set_rules('no_telpon', 'No Telpon', 'required');
		// $this->form_validation->set_rules('no_kk', 'No KK', 'required');
		$this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|is_unique[peserta.no_ktp]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('j_kel', 'Jenis Kelamin', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peserta/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_peserta' => $this->input->post('nama_peserta'),
				'alamat' => $this->input->post('alamat'),
				'id_desa' => $this->input->post('id_desa'),
				'no_telpon' => $this->input->post('no_telpon'),
				'no_kk' => $this->input->post('no_kk'),
				'no_ktp' => $this->input->post('no_ktp'),
				'tempat_lhr' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'j_kel' => $this->input->post('j_kel'),
				'validasi_du' => 0,
				'validasi_ud' => 0,
				'validasi_p' => 0
			];
			$this->db->insert('peserta', $data);
			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
						Tambah Peserta Berhasil!
					</div>'
			);
			redirect('peserta');
		}
	}

	public function formDaftarPeserta()
	{
		$data = array(); // Buat variabel $data sebagai array
		$data['title'] = 'Import Daftar Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->pelatihan->upload_file($this->filename);

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true);

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			} else { // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peserta/formDaftarPeserta');
		$this->load->view('templates/footer');
	}

	public function import()
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true);

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();

		$numrow = 1;
		foreach ($sheet as $row) {
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if ($numrow > 1) {
				// Kita push (add) array data ke variabel data
				array_push($data, [
					'nama_peserta' => $row['A'], // Insert data nis dari kolom A di excel
					'alamat' => $row['B'], // Insert data nama lengkap dari kolom B di excel
					'id_desa' => $row['C'], // Insert data alamat kelamin dari kolom C di excel
					'no_telpon' => $row['D'], // Insert data tempat dari kolom D di excel
					'no_ktp' => $row['E'], // Insert data agama dari kolom F di excel
					'tempat_lhr' => $row['F'], // Insert data jenis kelamin dari kolom G di excel
					'tgl_lahir' => $row['G'], // Insert data Periode Pemilihan dari kolom G di excel
					'j_kel' => $row['H'], // Insert data tps dari kolom H di excel
					'validasi_du' => 0, // Insert data tps dari kolom H di excel
					'validasi_ud' => 0, // Insert data tps dari kolom H di excel
					'validasi_p' => 0000, // Insert data tps dari kolom H di excel
				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->pelatihan->insert_multiple($data);

		$this->session->set_flashdata(
			'peserta',
			'<div class="alert alert-success" role="alert">
					Success Import Data Excel!
				</div>'
		);
		redirect("peserta"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function formBerkasPeserta()
	{
		$data = array(); // Buat variabel $data sebagai array
		$data['title'] = 'Import Berkas Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->pelatihan->upload_file($this->filename2);

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/excel/' . $this->filename2 . '.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true, true, true, true, true, true, true);

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			} else { // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peserta/formBerkasPeserta');
		$this->load->view('templates/footer');
	}

	public function import2()
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/excel/' . $this->filename2 . '.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true, true, true, true, true, true, true);

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$dataa = array();

		$numrow = 1;
		foreach ($sheet as $row) {
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if ($numrow > 1) {
				// Kita push (add) array data ke variabel data
				array_push($data, [
					'id_peserta' => $row['A'], // Insert data nis dari kolom A di excel
					'nama_usaha' => $row['B'], // Insert data nama lengkap dari kolom B di excel
					'alamat_usaha' => $row['C'], // Insert data alamat kelamin dari kolom C di excel
					'id_desa_jp' => $row['D'], // Insert data tempat dari kolom D di excel
					'jml_pria' => $row['E'], // Insert data agama dari kolom F di excel
					'jml_wanita' => $row['F'], // Insert data jenis kelamin dari kolom G di excel
					'id_ju' => $row['G'], // Insert data Periode Pemilihan dari kolom G di excel
					'id_subju' => $row['H'], // Insert data tps dari kolom H di excel
					'aset' => $row['I'], // Insert data tps dari kolom H di excel
					'omset' => $row['J'], // Insert data tps dari kolom H di excel
					'modal_mandiri' => $row['K'], // Insert data tps dari kolom H di excel
					'modal_luar' => $row['L'], // Insert data tps dari kolom H di excel
					'kapasitas_produksi' => $row['M'], // Insert data tps dari kolom H di excel
					'satuan' => $row['N'], // Insert data tps dari kolom H di excel
				]);
				array_push($dataa, [
					'id_peserta' => $row['A'], // Insert data nis dari kolom A di excel
					'validasi_du' => 1, // Insert data nis dari kolom A di excel
				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->pelatihan->insert_multiple2($data, $dataa);

		$this->session->set_flashdata(
			'peserta',
			'<div class="alert alert-success" role="alert">
					Success Import Data Excel!
				</div>'
		);
		redirect("peserta"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function formJangkauanPasarPeserta()
	{
		$data = array(); // Buat variabel $data sebagai array
		$data['title'] = 'Import Jangkauan Pasar Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->pelatihan->upload_file($this->filename3);

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/excel/' . $this->filename3 . '.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true, true);

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			} else { // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peserta/formJangkauanPasarPeserta');
		$this->load->view('templates/footer');
	}

	public function import3()
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/excel/' . $this->filename3 . '.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true, true, true, true, true, true);

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();

		$numrow = 1;
		foreach ($sheet as $row) {
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if ($numrow > 1) {
				// Kita push (add) array data ke variabel data
				array_push($data, [
					'id_peserta' => $row['A'], // Insert data nis dari kolom A di excel
					'nama_jp' => $row['B'], // Insert data nama lengkap dari kolom B di excel
					'dn_prov' => $row['C'], // Insert data alamat kelamin dari kolom C di excel
					'dn_kab_kot' => $row['D'], // Insert data tempat dari kolom D di excel
					'benua' => $row['E'], // Insert data agama dari kolom F di excel
					'negara' => $row['F'], // Insert data jenis kelamin dari kolom G di excel
					'volume' => $row['G'], // Insert data Periode Pemilihan dari kolom G di excel
					'satuan_v' => $row['H'], // Insert data tps dari kolom H di excel
					'nilai_ex' => $row['I'], // Insert data tps dari kolom H di excel
				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->pelatihan->insert_multiple3($data);

		$this->session->set_flashdata(
			'peserta',
			'<div class="alert alert-success" role="alert">
					Success Import Data Excel!
				</div>'
		);
		redirect("peserta"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function getPesertaModal()
	{
		$data = $this->db->get_where('peserta', ['id_peserta' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function getJPModal()
	{
		$data = $this->db->get_where('jangkauan_pasar', ['id_peserta' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function getPesertaDataModal()
	{
		if ($_POST['kecamatan'] == null | $_POST['kecamatan'] == "Pilih Kecamatan") {
			$kecamatan = 0;
		} else {
			$kecamatan = $_POST['kecamatan'];
		}
		if ($_POST['desa'] == null | $_POST['desa'] == "") {
			$desa = 0;
		} else {
			$desa = $_POST['desa'];
		}
		if ($_POST['JUsaha'] == null | $_POST['JUsaha'] == "Pilih menu") {
			$JUsaha = 0;
		} else {
			$JUsaha = $_POST['JUsaha'];
		}
		if ($_POST['subJUsaha'] == null | $_POST['subJUsaha'] == "") {
			$subJUsaha = 0;
		} else {
			$subJUsaha = $_POST['subJUsaha'];
		}
		$data = [
			'kecamatan' => $kecamatan,
			'desa' => $desa,
			'JUsaha' => $JUsaha,
			'subJUsaha' => $subJUsaha
		];

		$datanu = $this->pelatihan->get_datatablesFilter($data);
		$datane = [];
		$no = 1;
		foreach ($datanu as $d) {
			$row = array();
			$row['no'] = $no;
			$row['nu_peserta'] = $d['nu_peserta'];
			$row['nama_peserta'] = $d['nama_peserta'];
			$row['no_telpon'] = $d['no_telpon'];
			$row['alamat'] = $d['alamat'];
			$row['nama_usaha'] = $d['nama_usaha'];
			$row['nama_sub'] = $d['nama_sub'];
			$row['kegiatan'] = $this->pelatihan->count_allPendataanPelatihanbyid($d['idPeserta']);
			$row['idPeserta'] = $d['idPeserta'];
			$row['validasi_du'] = $d['validasi_du'];
			$datane[] = $row;
		}
		$outpute = array(
			'draw' => intval($_POST["draw"]),
			"recordsTotal" => $this->pelatihan->count_allFilter(),
			"recordsFiltered" => $this->pelatihan->count_filteredFilter($data),
			"data" => $datane,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($outpute));
	}

	public function getDataPesertaModal()
	{
		$data = $this->pelatihan->get_datatables();
		$datane = [];
		$no = 1;
		foreach ($data as $d) {
			$row = array();
			$row['no'] = $no;
			$row['nama_peserta'] = $d['nama_peserta'];
			$row['alamat'] = $d['alamat'];
			$row['no_telpon'] = $d['no_telpon'];
			$row['j_kel'] = $d['j_kel'];
			$row['validasi_du'] = $d['validasi_du'];
			$row['validasi_ud'] = $d['validasi_ud'];
			$row['id_peserta'] = $d['id_peserta'];
			$datane[] = $row;
		}
		$output = array(
			'draw'    => intval($_POST["draw"]),
			"recordsTotal" => $this->pelatihan->count_all(),
			"recordsFiltered" => $this->pelatihan->count_filtered(),
			"data" => $datane,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getDataPelatihanModal($id)
	{
		$data = $this->pelatihan->get_datatablesPelatihan($id);
		$datane = [];
		$no = 1;
		foreach ($data as $d) {
			$row = array();
			$row['no'] = $no;
			$row['nama_kegiatan'] = $d['nama_kegiatan'];
			$row['tgl_pelatihan'] = $d['tgl_pelatihan'];
			$row['waktu_pelatihan'] = $d['waktu_pelatihan'];
			$row['tempat'] = $d['tempat'];
			$datane[] = $row;
		}
		$output = array(
			'draw' => intval($_POST["draw"]),
			"recordsTotal" => $this->pelatihan->count_allPelatihan($id),
			"recordsFiltered" => $this->pelatihan->count_filteredPelatihan($id),
			"data" => $datane,
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function detailPeserta($id)
	{
		$data['title'] = 'Detail Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['idDetail'] = $id;
		$data['peserta'] = $this->pelatihan->showDetailPelatihanById($id);
		$data['sosial_media'] = $this->db->get_where('sosialmedia', ['id_peserta' => $id])->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['sub_ju'] = $this->db->get('subjenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peserta/detail', $data);
		$this->load->view('templates/footer');
	}

	public function getSosialMediaModal()
	{
		$data = $this->db->get_where('sosialmedia', ['id_sm' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function sosialMedia()
	{
		$data['title'] = 'Detail Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->pelatihan->showDetailPelatihanById($_POST['id']);
		$data['sosial_media'] = $this->db->get_where('sosialmedia', ['id_peserta' => $_POST['id']])->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['sub_ju'] = $this->db->get('subjenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$idPeserta = $this->input->post('id');
		$this->form_validation->set_rules('nama_sosmed', 'Nama Sosisal Media', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('akun', 'Akun', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peserta/detail', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_peserta' => $idPeserta,
				'nama_sosmed' => $this->input->post('nama_sosmed'),
				'akun' => $this->input->post('akun'),
				'url' => $this->input->post('url')
			];
			$this->db->insert('sosialmedia', $data);
			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
					Tambah Sosisal Media Berhasil!
				</div>'
			);
			redirect('peserta/detailPeserta/' . $idPeserta);
		}
	}

	public function editSosialMediaModal()
	{
		$data['title'] = 'Detail Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->pelatihan->showDetailPelatihanById($_POST['id']);
		$data['sosial_media'] = $this->db->get_where('sosialmedia', ['id_peserta' => $_POST['id']])->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['sub_ju'] = $this->db->get('subjenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$idPeserta = $this->input->post('id_peserta');
		$this->form_validation->set_rules('nama_sosmed', 'Nama Sosisal Media', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('akun', 'Akun', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peserta/detail', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_peserta' => $idPeserta,
				'nama_sosmed' => $this->input->post('nama_sosmed'),
				'akun' => $this->input->post('akun'),
				'url' => $this->input->post('url')
			];
			$this->pelatihan->editSosialMediaById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_Peserta',
				'<div class="alert alert-success" role="alert">
						Success Edit Sosisal Media!
					</div>'
			);
			redirect('peserta/detailPeserta/' . $idPeserta);
		}
	}

	public function deleteSosialMediaModal()
	{
		$this->pelatihan->deleteSosialMediaById($this->input->post('id_s'));
		$idPeserta = $this->input->post('id_pesertas');

		$this->session->set_flashdata(
			'message_peserta',
			'<div class="alert alert-success" role="alert">
				Success Hapus Sosisal Media!
			</div>'
		);
		redirect('peserta/detailPeserta/' . $idPeserta);
	}

	public function editPesertaModal()
	{
		$data['title'] = 'Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$this->form_validation->set_rules('nama_peserta', 'Nama Peserta', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('id_desa', 'Desa', 'required');
		$this->form_validation->set_rules('no_telpon', 'No Telpon', 'required');
		// $this->form_validation->set_rules('no_kk', 'No KK', 'required');
		$this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|is_unique[peserta.no_ktp]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('j_kel', 'Jenis Kelamin', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peserta/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_peserta' => $this->input->post('nama_peserta'),
				'alamat' => $this->input->post('alamat'),
				'id_desa' => $this->input->post('id_desa'),
				'no_telpon' => $this->input->post('no_telpon'),
				'no_kk' => $this->input->post('no_kk'),
				'no_ktp' => $this->input->post('no_ktp'),
				'tempat_lhr' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'j_kel' => $this->input->post('j_kel')
			];
			$this->pelatihan->editPesertaById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_Peserta',
				'<div class="alert alert-success" role="alert">
						Success Edit Peserta!
					</div>'
			);
			redirect('peserta');
		}
	}

	public function deletePesertaModal()
	{
		$this->pelatihan->deletePesertaById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_peserta',
			'<div class="alert alert-success" role="alert">
				Success Hapus Peserta!
			</div>'
		);
		redirect('peserta');
	}

	public function tambahUsaha()
	{
		$data['title'] = 'Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
		$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
		$this->form_validation->set_rules('jp', 'Jangkauan Pasar', 'required');
		$this->form_validation->set_rules('omset', 'Omset', 'required');
		$this->form_validation->set_rules('modal_mandiri', 'Modal Mandiri', 'required');
		$this->form_validation->set_rules('modal_luar', 'Modal Luar', 'required');
		$this->form_validation->set_rules('n_kp', 'Nilai Kapasitas Produk', 'required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peserta/index', $data);
			$this->load->view('templates/footer');
		} else {
			$dataa = [
				'validasi_du' => 1
			];
			$this->pelatihan->editPesertaById($_POST['id_tu'], $dataa);

			if ($this->input->post('id_c') == 1) :
				$datajp = [
					'id_peserta' => $this->input->post('id_tu'),
					'nama_jp' => $this->input->post('jp'),
					'dn_prov' => $this->input->post('dn_prov'),
					'dn_kab_kot' => $this->input->post('dn_kab_kot')
				];
			elseif ($this->input->post('id_c') == 2) :
				$datajp = [
					'id_peserta' => $this->input->post('id_tu'),
					'nama_jp' => $this->input->post('jp'),
					'benua' => $this->input->post('benua'),
					'negara' => $this->input->post('negara'),
					'volume' => $this->input->post('volume'),
					'satuan_v' => $this->input->post('satuan_v'),
					'nilai_ex' => $this->input->post('nilai_ex')
				];
			endif;
			$this->db->insert('jangkauan_pasar', $datajp);

			$data = [
				'id_peserta' => $this->input->post('id_tu'),
				'nama_usaha' => $this->input->post('nama_usaha'),
				'alamat_usaha' => $this->input->post('alamat_usaha'),
				'id_desa_jp' => $this->input->post('id_desa_jp'),
				'jml_pria' => $this->input->post('jmlh_karyawan_pria'),
				'jml_wanita' => $this->input->post('jmlh_karyawan_wanita'),
				'id_ju' => $this->input->post('jenis_usaha'),
				'id_subju' => $this->input->post('subjenis_usaha'),
				'aset' => $this->input->post('aset'),
				'omset' => $this->input->post('omset'),
				'modal_mandiri' => $this->input->post('modal_mandiri'),
				'modal_luar' => $this->input->post('modal_luar'),
				'kapasitas_produksi' => $this->input->post('n_kp'),
				'satuan' => $this->input->post('satuan')
			];
			$this->db->insert('data_usaha', $data);
			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
					Tambah Data Usaha Berhasil!
				</div>'
			);
			redirect('peserta');
		}
	}

	public function getDataUsahaModal()
	{
		$data = $this->db->get_where('data_usaha', ['id_peserta' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editUsaha()
	{
		$data['title'] = 'Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
		$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
		$this->form_validation->set_rules('jp', 'Jangkauan Pasar', 'required');
		$this->form_validation->set_rules('omset', 'Omset', 'required');
		$this->form_validation->set_rules('modal_mandiri', 'Modal Mandiri', 'required');
		$this->form_validation->set_rules('modal_luar', 'Modal Luar', 'required');
		$this->form_validation->set_rules('n_kp', 'Nilai Kapasitas Produk', 'required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/footer');
			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-danger" role="alert">
					Tidak bisa di Edit Data Usaha karena data masih ada yang kosong!
				</div>'
			);
			redirect('peserta');
		} else {
			if ($this->input->post('id_c') == 1) :
				$datajp = [
					'id_peserta' => $this->input->post('id_tu'),
					'nama_jp' => $this->input->post('jp'),
					'dn_prov' => $this->input->post('dn_prov'),
					'dn_kab_kot' => $this->input->post('dn_kab_kot')
				];
			elseif ($this->input->post('id_c') == 2) :
				$datajp = [
					'id_peserta' => $this->input->post('id_tu'),
					'nama_jp' => $this->input->post('jp'),
					'benua' => $this->input->post('benua'),
					'negara' => $this->input->post('negara'),
					'volume' => $this->input->post('volume'),
					'satuan_v' => $this->input->post('satuan_v'),
					'nilai_ex' => $this->input->post('nilai_ex')
				];
			endif;
			$this->pelatihan->editJangkauanPasarById($_POST['id_Pa'], $datajp);

			$data = [
				'nama_usaha' => $this->input->post('nama_usaha'),
				'jml_pria' => $this->input->post('jmlh_karyawan_pria'),
				'jml_wanita' => $this->input->post('jmlh_karyawan_wanita'),
				'id_ju' => $this->input->post('jenis_usaha'),
				'id_subju' => $this->input->post('subjenis_usaha'),
				'aset' => $this->input->post('aset'),
				'omset' => $this->input->post('omset'),
				'modal_mandiri' => $this->input->post('modal_mandiri'),
				'modal_luar' => $this->input->post('modal_luar'),
				'kapasitas_produksi' => $this->input->post('n_kp'),
				'satuan' => $this->input->post('satuan')
			];
			$this->pelatihan->editDataUsahaById($_POST['id_tu'], $data);
			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
					Success Edit Data Usaha!
				</div>'
			);
			redirect('peserta');
		}
	}

	public function uploadData()
	{
		$data['title'] = 'Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['peserta'] = $this->db->get('peserta')->result_array();
		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();

		$config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
		$config['max_size']     = '5048';
		$config['upload_path'] = './assets/images/data-peserta/';
		$this->load->library('upload', $config);
		$idPeserta = $this->input->post('id_peserta');
		$new_image1 = "";
		$new_image2 = "";
		$new_image3 = "";
		$new_image4 = "";
		$new_image5 = "";
		$new_image6 = "";

		$data_image1 = $this->input->post('img_1');
		$data_image2 = $this->input->post('img_2');
		$data_image3 = $this->input->post('img_3');
		$data_image4 = $this->input->post('img_4');
		$data_image5 = $this->input->post('img_5');
		$data_image6 = $this->input->post('img_6');

		if ($data_image1 !== "" | $data_image2 !== "" | $data_image3 !== "" | $data_image4 !== "" | $data_image5 !== "" | $data_image6 !== "") :

			if ($data_image1) :
				if ($this->upload->do_upload('image_1')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image1);
					$data_image1 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_1')) :
					$data_image1 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image2) :
				if ($this->upload->do_upload('image_2')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image2);
					$data_image2 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_2')) :
					$data_image2 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image3) :
				if ($this->upload->do_upload('image_3')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image3);
					$data_image3 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_3')) :
					$data_image3 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image4) :
				if ($this->upload->do_upload('image_4')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image4);
					$data_image4 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_4')) :
					$data_image4 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image5) :
				if ($this->upload->do_upload('image_5')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image5);
					$data_image5 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_5')) :
					$data_image5 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image6) :
				if ($this->upload->do_upload('image_6')) :
					unlink(FCPATH . 'assets/images/data-peserta/' . $data_image6);
					$data_image6 = $this->upload->data('file_name');
				endif;
			else :
				if ($this->upload->do_upload('image_6')) :
					$data_image6 = $this->upload->data('file_name');
				endif;
			endif;

			if ($data_image1 !== "" && $data_image2 !== "" && $data_image3 !== "" && $data_image4 !== "" && $data_image5 !== "" && $data_image6 !== "") :
				$dataa = [
					'validasi_ud' => 2
				];
			elseif ($data_image1 !== "" || $data_image2 !== "" || $data_image3 !== "" || $data_image4 !== "" || $data_image5 !== "" || $data_image6 !== "") :
				$dataa = [
					'validasi_ud' => 1
				];
			endif;

			$this->pelatihan->editPesertaById($_POST['id_peserta'], $dataa);
			$data = [
				'id_peserta' => $idPeserta,
				'nib' => $data_image1,
				'prit' => $data_image2,
				'sertivikat' => $data_image3,
				'npwp' => $data_image4,
				'ktp' => $data_image5,
				'brand' => $data_image6
			];
			$this->pelatihan->editUploadPesertaById($_POST['id_peserta'], $data);

			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
						Tambahan Upload Berkas Berhasil Di Input!
					</div>'
			);

		else :

			if ($this->upload->do_upload('image_1')) :
				$new_image1 = $this->upload->data('file_name');
			endif;

			// $config['upload_path'] = './assets/images/prit/';
			if ($this->upload->do_upload('image_2')) :
				$new_image2 = $this->upload->data('file_name');
			endif;

			// $config['upload_path'] = './assets/images/sertivikat/';
			if ($this->upload->do_upload('image_3')) :
				$new_image3 = $this->upload->data('file_name');
			endif;

			// $config['upload_path'] = './assets/images/npwp/';
			if ($this->upload->do_upload('image_4')) :
				$new_image4 = $this->upload->data('file_name');
			endif;

			// $config['upload_path'] = './assets/images/ktp/';
			if ($this->upload->do_upload('image_5')) :
				$new_image5 = $this->upload->data('file_name');
			endif;

			// $config['upload_path'] = './assets/images/brand/';
			if ($this->upload->do_upload('image_6')) :
				$new_image6 = $this->upload->data('file_name');
			endif;

			if ($new_image1 !== "" && $new_image2 !== "" && $new_image3 !== "" && $new_image4 !== "" && $new_image5 !== "" && $new_image6 !== "") :
				$dataa = [
					'validasi_ud' => 2
				];
			elseif ($new_image1 !== "" || $new_image2 !== "" || $new_image3 !== "" || $new_image4 !== "" || $new_image5 !== "" || $new_image6 !== "") :
				$dataa = [
					'validasi_ud' => 1
				];
			endif;

			$this->pelatihan->editPesertaById($_POST['id_peserta'], $dataa);
			$data = [
				'id_peserta' => $idPeserta,
				'nib' => $new_image1,
				'prit' => $new_image2,
				'sertivikat' => $new_image3,
				'npwp' => $new_image4,
				'ktp' => $new_image5,
				'brand' => $new_image6
			];
			$this->db->insert('upload_data', $data);

			$this->session->set_flashdata(
				'message_peserta',
				'<div class="alert alert-success" role="alert">
						Upload Berkas Berhasil Di Input!
					</div>'
			);
		endif;

		if ($this->input->post('id_v')) :
			redirect('peserta');
		else :
			redirect('peserta/detailPeserta/' . $idPeserta);
		endif;
	}

	public function getUploadDataModal()
	{
		$data = $this->db->get_where('upload_data', ['id_peserta' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function filter()
	{
		$data['title'] = 'Filter Data Peserta';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
		$data['sub_ju'] = $this->db->get('subjenis_usaha')->result_array();
		$data['desa'] = $this->db->get('desa')->result_array();
		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('peserta/filter_data', $data);
		$this->load->view('templates/footer');
	}
}