<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_user_model extends CI_Model
{
    public function getUserRole()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
				  FROM `user` JOIN `user_role`
				  ON `user`.`role_id` = `user_role`.`id`
				";
        return $this->db->query($query)->result_array();
    }

    public function getUserRoleById($id)
    {
        $query = "SELECT `user`.*, `user_role`.`role`
				  FROM `user` JOIN `user_role`
				  ON `user`.`role_id` = `user_role`.`id`
                  WHERE `user`.`id`='$id'
				";
        return $this->db->query($query)->result_array();
    }

    // Data User Admin
    public function deleteUserAdminById($id)
    {
        return $this->db->delete('user', ['id' => $id]);
    }

    public function editUserAdminById($id, $data)
    {
        return $this->db->where('id', $id)->update('user', $data);
    }

    // Data User Masyarakat
    public function deleteUserMasyarakatById($id)
    {
        return $this->db->delete('user_android', ['id' => $id]);
    }

    public function editUserMasyarakatById($id, $data)
    {
        return $this->db->where('id', $id)->update('user_android', $data);
    }
}
