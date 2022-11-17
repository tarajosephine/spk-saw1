<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata(
				'message_menu',
				'<div class="alert alert-success" role="alert">
					New Menu Added!
				</div>'
			);
			redirect('menu');
		}
	}

	public function getMenuModal()
	{
		$data = $this->db->get_where('user_menu', ['id' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editMenuModal()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = ['menu' => $this->input->post('menu')];
			$this->menu->editMenuById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_menu',
				'<div class="alert alert-success" role="alert">
						Success Edit Menu!
					</div>'
			);
			redirect('menu');
		}
	}

	public function deleteMenuModal()
	{
		$this->menu->deleteMenuById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_menu',
			'<div class="alert alert-success" role="alert">
				Success Delete Menu!
			</div>'
		);
		redirect('menu');
	}

	// Sub Menu
	public function subMenu()
	{
		$data['title'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/subMenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata(
				'message_submenu',
				'<div class="alert alert-success" role="alert">
						New Sub Menu Added!
					</div>'
			);
			redirect('menu/subMenu');
		}
	}

	public function getSubMenuModal()
	{
		$data = $this->db->get_where('user_sub_menu', ['id' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editSubMenuModal()
	{
		$data['title'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() ==  false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/subMenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->menu->editSubMenuById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_submenu',
				'<div class="alert alert-success" role="alert">
						Success Edit Sub Menu!
					</div>'
			);
			redirect('menu/subMenu');
		}
	}

	public function deleteSubMenuModal()
	{
		$this->menu->deleteSubMenuById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_submenu',
			'<div class="alert alert-success" role="alert">
				Success Delete Sub Menu!
			</div>'
		);
		redirect('menu/subMenu');
	}
}
