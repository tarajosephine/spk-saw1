<?php
class Login_model extends CI_Model
{
	public function Verification($email, $data)
	{
		return $this->db->where('email', $email)->update('user', $data);
	}

	public function PasswordReset($email, $data)
	{
		return $this->db->where('email', $email)->update('user', $data);
	}
}
