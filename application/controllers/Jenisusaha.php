<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenisusaha extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pelatihan_model', 'pelatihan');
    }

    public function index()
    {
        $data['title'] = 'Daftar Bidang Usaha';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();

        $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Usaha', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenisusaha/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_usaha' => $this->input->post('nama_usaha'),
                'keterangan' => $this->input->post('keterangan'),
            ];
            $this->db->insert('jenis_usaha', $data);
            $this->session->set_flashdata(
                'message_jenisUsaha',
                '<div class="alert alert-success" role="alert">
					Jenis usaha baru telah ditambahkan!!
				</div>'
            );
            redirect('jenisusaha');
        }
    }

    public function getJenisUsahaModal()
    {
        $data = $this->db->get_where('jenis_usaha', ['id_ju' => $_POST['id']])->row_array();
        echo json_encode($data);
    }

    public function editJenisUsahaModal()
    {
        $data['title'] = 'Daftar Jenis Usaha';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();

        $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Usaha', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenisusaha/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_usaha' => $this->input->post('nama_usaha'),
                'keterangan' => $this->input->post('keterangan'),
            ];
            $this->pelatihan->editJenisUsahaById($_POST['id'], $data);
            $this->session->set_flashdata(
                'message_jenisUsaha',
                '<div class="alert alert-success" role="alert">
						Success Edit Jenis Usaha!
					</div>'
            );
            redirect('jenisusaha');
        }
    }

    public function deleteJenisUsahaModal()
    {
        $this->pelatihan->deleteJenisUsahaById($this->input->post('id_s'));

        $this->session->set_flashdata(
            'message_jenisUsaha',
            '<div class="alert alert-success" role="alert">
				Success Delete Jenis Usaha!
			</div>'
        );
        redirect('jenisusaha');
    }

    // Sub Jenis Usaha
    public function subJenisUsaha()
    {
        $data['title'] = 'Daftar Jenis Usaha';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
        $data['sub_ju'] = $this->pelatihan->showJenisUsaha();

        $this->form_validation->set_rules('id_jenis', 'Nama Jenis Usaha', 'required');
        $this->form_validation->set_rules('nama_subjenisusaha', 'Nama Jenis Usaha', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Usaha', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenisusaha/sub_jenisusaha', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_ju' => $this->input->post('id_jenis'),
                'nama_sub' => $this->input->post('nama_subjenisusaha'),
                'ket' => $this->input->post('keterangan')
            ];
            $this->db->insert('subjenis_usaha', $data);
            $this->session->set_flashdata(
                'message_subjenisUsaha',
                '<div class="alert alert-success" role="alert">
					Sub Jenis usaha baru telah ditambahkan!!
				</div>'
            );
            redirect('jenisusaha/subJenisUsaha');
        }
    }

    public function getSubJenisUsahaByidModal()
    {
        $data = $this->db->get_where('subjenis_usaha', ['id_ju' => $_POST['id']])->result_array();
        echo json_encode($data);
    }

    public function getSubJenisUsahaModal()
    {
        $data = $this->db->get_where('subjenis_usaha', ['id_subju' => $_POST['id']])->row_array();
        echo json_encode($data);
    }

    public function editSubJenisUsahaModal()
    {
        $data['title'] = 'Daftar Sub Jenis Usaha';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_usaha'] = $this->db->get('jenis_usaha')->result_array();
        $data['sub_ju'] = $this->db->get('subjenis_usaha')->result_array();

        $this->form_validation->set_rules('id_jenis', 'Nama Jenis Usaha', 'required');
        $this->form_validation->set_rules('nama_subjenisusaha', 'Nama Jenis Usaha', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Usaha', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenisusaha/sub_jenisusaha', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_ju' => $this->input->post('id_jenis'),
                'nama_sub' => $this->input->post('nama_subjenisusaha'),
                'ket' => $this->input->post('keterangan')
            ];
            $this->pelatihan->editSubJenisUsahaById($_POST['id'], $data);
            $this->session->set_flashdata(
                'message_subjenisUsaha',
                '<div class="alert alert-success" role="alert">
						Success Edit Sub Jenis Usaha!
					</div>'
            );
            redirect('jenisusaha/subJenisUsaha');
        }
    }

    public function deleteSubJenisUsahaModal()
    {
        $this->pelatihan->deleteSubJenisUsahaById($this->input->post('id_s'));

        $this->session->set_flashdata(
            'message_subjenisUsaha',
            '<div class="alert alert-success" role="alert">
				Success Delete Sub Jenis Usaha!
			</div>'
        );
        redirect('jenisusaha/subJenisUsaha');
    }
}
