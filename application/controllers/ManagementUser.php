<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManagementUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Management_user_model', 'managementuser');
    }

    public function index()
    {
        $data['title'] = 'Data User Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User'] = $this->managementuser->getUserRole();
        $data['User_Role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('is_active') == null) {
                $is_active = '0';
            } else {
                $is_active = $this->input->post('is_active');
            }
            $data = [
                'name' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => $is_active,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata(
                'message_managementUser',
                '<div class="alert alert-success" role="alert">
            		New User Added!
            	</div>'
            );
            redirect('managementUser');
            // echo json_encode($data);
        }
    }

    public function getUserAdminModal()
    {
        $data = $this->db->get_where('user', ['id' => $_POST['id']])->row_array();
        echo json_encode($data);
    }

    public function editUserAdminModal()
    {
        $data['title'] = 'Data User Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User'] = $this->managementuser->getUserRole();
        $data['User_Role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('is_active') == null) {
                $is_active = '0';
            } else {
                $is_active = $this->input->post('is_active');
            }
            if ($this->input->post('password') == null) {
                $data = [
                    'name' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => $is_active
                ];
            } else {
                $data = [
                    'name' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => $is_active
                ];
            }
            // echo json_encode($data);
            $this->managementuser->editUserAdminById($_POST['id'], $data);
            $this->session->set_flashdata(
                'message_managementUser',
                '<div class="alert alert-success" role="alert">
            			Success Edit User Admin!
            		</div>'
            );
            redirect('managementUser');
        }
    }

    public function deleteUserAdminModal()
    {
        $this->managementuser->deleteUserAdminById($this->input->post('id_s'));

        $this->session->set_flashdata(
            'message_managementUser',
            '<div class="alert alert-success" role="alert">
				Success Delete User Admin!
			</div>'
        );
        redirect('managementUser');
    }

    // Detail User Admin
    public function detailUserAdmin($id)
    {
        $data['title'] = 'User Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['UserById'] = $this->managementuser->getUserRoleById($id);

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser/detailUserAdmin', $data);
            $this->load->view('templates/footer');
        } else {
        }
    }

    // Data User Masyarakat
    public function userMasyarakat()
    {
        $data['title'] = 'Data User Masyarakat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User_masyarakat'] = $this->db->get('user_android')->result_array();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Telphone', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser/userMasyarakat', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('is_active') == null) {
                $is_active = '0';
            } else {
                $is_active = $this->input->post('is_active');
            }
            $data = [
                'nik' => $this->input->post('nik'),
                'nama_lengkap' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'jekel' => $this->input->post('jekel'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'phone' => $this->input->post('phone'),
                'image' => 'person.png',
                'is_active' => $is_active
            ];
            $this->db->insert('user_android', $data);
            $this->session->set_flashdata(
                'message_managementUserMasyarakat',
                '<div class="alert alert-success" role="alert">
            		New User Masyarakat Added!
            	</div>'
            );
            redirect('managementUser/userMasyarakat');
            // echo json_encode($data);
        }
    }

    public function getUserMasyarakatModal()
    {
        $data = $this->db->get_where('user_android', ['id' => $_POST['id']])->row_array();
        echo json_encode($data);
    }

    public function editUserMasyarakatModal()
    {
        $data['title'] = 'Data User Masyarakat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User_masyarakat'] = $this->db->get('user_android')->result_array();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Telphone', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser/userMasyarakat', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('is_active') == null) {
                $is_active = '0';
            } else {
                $is_active = $this->input->post('is_active');
            }
            if ($this->input->post('password') == null) {
                $data = [
                    'nik' => $this->input->post('nik'),
                    'nama_lengkap' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'jekel' => $this->input->post('jekel'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'phone' => $this->input->post('phone'),
                    'image' => 'person.png',
                    'is_active' => $is_active
                ];
            } else {
                $data = [
                    'nik' => $this->input->post('nik'),
                    'nama_lengkap' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'jekel' => $this->input->post('jekel'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'phone' => $this->input->post('phone'),
                    'image' => 'person.png',
                    'is_active' => $is_active
                ];
            }
            // echo json_encode($data);
            $this->managementuser->editUserMasyarakatById($_POST['id'], $data);
            $this->session->set_flashdata(
                'message_managementUserMasyarakat',
                '<div class="alert alert-success" role="alert">
            			Success Edit User Masyarakat!
            		</div>'
            );
            redirect('managementUser/userMasyarakat');
        }
    }

    public function deleteUserMasyarakatModal()
    {
        $this->managementuser->deleteUserMasyarakatById($this->input->post('id_s'));

        $this->session->set_flashdata(
            'message_managementUserMasyarakat',
            '<div class="alert alert-success" role="alert">
				Success Delete User Masyarakat!
			</div>'
        );
        redirect('managementUser/userMasyarakat');
    }

    // Detail User Masyarakat
    public function detailUserMasyarakat($id)
    {
        $data['title'] = 'User Masyarakat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User_masyarakatById'] = $this->db->get_where('user_android', ['id' => $id])->result_array();

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managementUser/detailUserMasyarakat', $data);
            $this->load->view('templates/footer');
        } else {
        }
    }
}
