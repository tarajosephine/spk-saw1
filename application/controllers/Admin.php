<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['pelatihan'] = $this->db->query("SELECT * from pelatihan")->num_rows();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	// Role
	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata(
				'message_role',
				'<div class="alert alert-success" role="alert">
					New Role Added!
				</div>'
			);
			redirect('admin/role');
		}
	}

	public function roleAccess($role_id)
	{
		$data['access'] = base_url('admin/role');
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$data['menu'] = $this->db->get_where('user_menu', ['id !=' => 1])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$role_id = $this->input->post('roleId');
		$menu_id = $this->input->post('menuId');

		echo $role_id, $menu_id;

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
			$this->session->set_flashdata(
				'message_roleAccess',
				'<div class="alert alert-success" role="alert">
						Success di Tambahkan!
					</div>'
			);
		} else {
			$this->db->delete('user_access_menu', $data);
			$this->session->set_flashdata(
				'message_roleAccess',
				'<div class="alert alert-success" role="alert">
						Success di Hapus!
					</div>'
			);
		}
	}

	public function getRoleModal()
	{
		$data = $this->db->get_where('user_role', ['id' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editRoleModal()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$data = ['role' => $this->input->post('role')];
			$this->menu->editRoleById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_role',
				'<div class="alert alert-success" role="alert">
						Success Edit Role!
					</div>'
			);
			redirect('admin/role');
		}
	}

	public function deleteRoleModal()
	{
		$this->menu->deleteRoleById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_role',
			'<div class="alert alert-success" role="alert">
				Success Delete Role!
			</div>'
		);
		redirect('admin/role');
	}
}