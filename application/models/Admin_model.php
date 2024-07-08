<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function numrows($tabel)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->get();
        return $query->num_rows();
    }
    
    public function getSumStokBarang($table, $field) 
    {
        $query = $this->db->select_sum($field)
            ->from($table)
            ->get();
        return $query->result();
    }

    public function getAllDataUser()
    {
        $query = "SELECT * FROM user JOIN user_role ON user.role_id = user_role.id_role";
        return $this->db->query($query)->result_array();
    }

    public function insertUsers()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'address' => $this->input->post('address', true),
            'phone_number' => $this->input->post('nomor', true),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => $this->input->post('role_id', true),
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->db->insert('user', $data);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM user JOIN user_role ON user.role_id = user_role.id_role WHERE id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getAllRole()
    {
        $query = "SELECT * FROM user_role";
        return $this->db->query($query)->result();
    }

    public function setUserById($id)
    {
        $role_id = $this->db->input->post('role_id');
        $id = $this->db->input->post('id');

        $this->db->set('role_id', $role_id);
        $this->db->where('id', $id);
        $this->db->update('user');
    }

    public function deleteDataUser($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }


}
