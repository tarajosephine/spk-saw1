<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Google_login_model');
		$this->load->model('Login_model');
		$this->load->library('Ciqrcode');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		// $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			// $this->load->view('auth/login');
			$this->login();
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	public function login()
	{
		include_once APPPATH . "libraries/vendor/autoload.php";
		$google_client = new Google_Client();
		$google_client->setClientId('1018608477452-vb2o2femompddsgnu77bfng771l8ffic.apps.googleusercontent.com');
		$google_client->setClientSecret('syAhkWV-MDdPgX4dglFX2MWL');
		$google_client->setRedirectUri('http://192.168.1.253/e-ppo/');
		$google_client->addScope('email');
		$google_client->addScope('profile');
		if (isset($_GET['code'])) {
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

			if (!isset($token['error'])) {
				$google_client->setAccessToken($token['access_token']);

				$this->session->userdata('access_token', $token['access_token']);

				$google_service = new Google_Service_Oauth2($google_client);

				$data = $google_service->userinfo->get();

				$current_datetime = date('Y-m-d H:i:s');

				if ($this->Google_login_model->Is_already_register($data['id'])) {
					$user_data = [
						'first_name' => $data['given_name'],
						'last_name' => $data['family_name'],
						'email_address' => $data['email'],
						'profile_picture' => $data['picture'],
						'updated_at' => $current_datetime
					];
					$this->Google_login_model->Update_user_data($user_data, $data['id']);
				} else {
					$user_data = [
						'login_oauth_uid' => $data['id'],
						'first_name' => $data['given_name'],
						'last_name' => $data['family_name'],
						'email_address' => $data['email'],
						'profile_picture' => $data['picture'],
						'created_at' => $current_datetime
					];
					$this->Google_login_model->Insert_user_data($user_data);
				}
				$this->session->set_userdata('user_data', $user_data);
			}
		}
		if (!$this->session->userdata('access_token')) {
			$login_button = '<a class="btn btn-user" href="' . $google_client->createAuthUrl() . '"><img style="height: 110px; width: 250px;" src="' . base_url() . 'assets/img/GoogleSignUpDark.png" /></a>';
			$data['login_button'] = $login_button;
			$this->load->view('auth/login', $data);
		}
	}

	public function google_account()
	{
		$this->load->view('auth/google_login');
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$username = $this->db->get_where('user', ['username' => $email])->row_array();
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					$data_user = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
					if ($user['role_id'] == 1) {
						$data = [
							'user' => $data_user['role']
						];
						$this->session->set_userdata($data);
						redirect('admin');
					} else {
						$data = [
							'user' => $data_user['role']
						];
						$this->session->set_userdata($data);
						redirect('user');
					}
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger" role="alert">
							Wrong password!
						</div>'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
						This email has not been activated!
					</div>'
				);
				redirect('auth');
			}
		}
		if ($username) {
			if ($username['is_active'] == 1) {
				if (password_verify($password, $username['password'])) {
					$data = [
						'email' => $username['email'],
						'role_id' => $username['role_id']
					];
					$this->session->set_userdata($data);
					$data_user = $this->db->get_where('user_role', ['id' => $username['role_id']])->row_array();
					if ($username['role_id'] == 1) {
						$data = [
							'user' => $data_user['role']
						];
						$this->session->set_userdata($data);
						redirect('admin');
					} else {
						$data = [
							'user' => $data_user['role']
						];
						$this->session->set_userdata($data);
						redirect('user');
					}
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger" role="alert">
							Wrong password!
						</div>'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
						This email has not been activated!
					</div>'
				);
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger" role="alert">
					Email is not registered!
				</div>'
			);
			redirect('auth');
		}
	}

	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		// $this->form_validation->set_rules('username', 'Username', 'required|trim|valid_email|is_unique[user.email]', [
		// 	'is_unique' => 'This email has already registered!'
		// ]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'WPU User Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('username') . '@gmail.com';
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($email, true),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			// token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
					Congratulation! your account has been created. Please activate your account
				</div>'
			);
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'itdindagkopkotapekalongan@gmail.com',
			'smtp_pass' => 'tnglxnbdxmtabods',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from('itdindagkopkotapekalongan@gmail.com', 'Dindgakop Kota Pekalongan');
		if ($type == 'verify') {
			$email = $this->input->post('username') . '@gmail.com';
			$this->email->to($email);
			$this->email->subject('Account Verification');
			$this->email->message('Klik disini link untuk verifikasi akun anda : <a href="http://192.168.1.253/e-ppo/auth/verify?email=' . $email . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$email = $this->input->post('email');
			$this->email->to($email);
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="http://192.168.1.253/e-ppo/auth/resetPassword?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$user_data = [
						'is_active' => 1,
					];
					$this->Login_model->Verification($email, $user_data);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-success" role="alert">
							' . $email . ' has been activated! Please Login.
						</div>'
					);
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger" role="alert">
							Account activation failed! Token Expired.
						</div>'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
						Account activation failed! Wrong Token.
					</div>'
				);
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger" role="alert">
					Account activation failed! Wrong Email.
				</div>'
			);
			redirect('auth');
		}
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot_password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success" role="alert">
						Please check your email to reset your password!
					</div>'
				);
				redirect('auth/forgotPassword');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
						Email is not regitered activated!
					</div>'
				);
				redirect('auth/forgotPassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->session->set_userdata('reset_email', $email);
					$this->changePassword();
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger" role="alert">
							Account reset password failed! Token Expired.
						</div>'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
						Reset Password failed! Wrong Token
					</div>'
				);
				redirect('auth/forgotPassword');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger" role="alert">
					Reset Password failed! Wrong Email
				</div>'
			);
			redirect('auth/forgotPassword');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Change Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change_password');
			$this->load->view('templates/auth_footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');
			$user_data = [
				'password' => $password
			];
			$this->Login_model->PasswordReset($email, $user_data);
			$this->session->unset_userdata('reset_email');
			$this->db->delete('user_token', ['email' => $email]);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
					Password has been changed! Please Login
				</div>'
			);
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('user_data');

		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success" role="alert">
				You have been logged out!
			</div>'
		);
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = 'Access Blocked!';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('auth/blocked');
		$this->load->view('templates/footer');
	}
}
