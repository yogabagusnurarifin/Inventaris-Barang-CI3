<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->admin->numrows('user');
        $data['barang_masuk'] = $this->admin->getSumStokBarang('barang_masuk', 'jumlah_masuk');
        $data['barang_keluar'] = $this->admin->getSumStokBarang('barang_keluar', 'jumlah_keluar');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id_role' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Access Change!</div>');
    }

    public function datausers()
    {
        $data['title'] = 'Data Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['alluser'] = $this->admin->getAllDataUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/datausers', $data);
        $this->load->view('templates/footer');
    }

    public function insertUser()
    {
        $data['title'] = 'Tambah Data Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Alamat Email Sudah Terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambahuser');
            $this->load->view('templates/footer');
        } else {
            $this->admin->insertUsers();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('admin/datausers');
        }
    }

    public function detailuser($id)
    {

        $data['title'] = 'Detail User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_id'] = $this->admin->getUserById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailuser', $data);
        $this->load->view('templates/footer');
    }

    public function updateuser($id)
    {
        $data['title'] = 'Edit Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_id'] = $this->admin->getUserById($id);
        $data['role'] = $this->admin->getAllRole();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edituser', $data);
            $this->load->view('templates/footer');
        } else {
            // $this->admin->setUserById($id);
            // $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/datausers');
        }
    }

    public function editrole()
    {
        $this->form_validation->set_rules('role_id', 'Role_Id', 'required|trim');

        $role_id = $this->input->post('role_id');
        $id = $this->input->post('id');

        $this->db->set('role_id', $role_id);
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('flash', 'Dirubah');
        redirect('admin/datausers');
    }

    public function deleteUser($id)
    {
        $this->admin->deleteDataUser($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/datausers');
    }

    public function nonaktifUser($id, $active)
    {
        $data = array(
            'is_active' => $active
        );

        $this->db->where('id', $id);
        $this->db->update('user', $data);
        if ($active > 0) {
            $this->session->set_flashdata('flash', 'Diaktifkan');
        } else {
            $this->session->set_flashdata('flash', 'Dinonaktifkan');
        }
        redirect('admin/datausers');
    }
}
