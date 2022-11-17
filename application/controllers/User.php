<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			// cek image
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
				$config['max_size']     = '5048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$data = [
						'email' => $this->input->post('email'),
						'name' => $this->input->post('name'),
						'image' => $new_image
					];
					$this->menu->editUserById($_POST['id'], $data);
					$this->session->set_flashdata(
						'message_user',
						'<div class="alert alert-success" role="alert">
								Success Edit User!
							</div>'
					);
					redirect('user');
				} else {
					echo $this->upload->display_errors();
				}
			} else {
				$data = [
					'email' => $this->input->post('email'),
					'name' => $this->input->post('name'),
					'image' => $this->input->post('img')
				];
				$this->menu->editUserById($_POST['id'], $data);
				$this->session->set_flashdata(
					'message_user',
					'<div class="alert alert-success" role="alert">
							Success Edit User!
						</div>'
				);
				redirect('user');
			}
		}
	}

	public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confrim New Password', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changePassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata(
					'message_user_password',
					'<div class="alert alert-danger" role="alert">
							Wrong Current Password!
						</div>'
				);
				redirect('user/changePassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata(
						'message_user_password',
						'<div class="alert alert-danger" role="alert">
								New Password cannot be the same as Current Password!
							</div>'
					);
					redirect('user/changePassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$data = [
						'password' => $password_hash
					];
					$this->menu->editPasswordUserById($_POST['id'], $data);
					$this->session->set_flashdata(
						'message_user_password',
						'<div class="alert alert-success" role="alert">
								Password Changed!
							</div>'
					);
					redirect('user/changePassword');
				}
			}
		}
	}
}
