<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Barang';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->barang->getBarangJoin();
        // Kode otomatis
        $data['kodeBarang'] = $this->barang->kodeBarang();

        $this->form_validation->set_rules('namaBarang', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertBarang();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('barang');
        }
    }

    public function updateBarang()
    {
        $this->form_validation->set_rules('namaBarang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        
        $this->barang->updateBarang();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('barang');
    }

    public function deleteBarang($id)
    {
        // $this->barang->deleteBarang($id);
        $this->db->delete('barang', ['id_barang' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('barang');
    }

    public function barangMasuk()
    {
        $data['title'] = 'Barang Masuk';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barangmasuk'] = $this->barang->getBarangMasuk();
        $data['barang'] = $this->db->get('barang')->result_array();
        $data['kodeBarang'] = $this->barang->kodeBarang();

        // $this->form_validation->set_rules('idBarang', 'id', 'required');
        $this->form_validation->set_rules('jumlahMasuk', 'Jumlah', 'required');
        $this->form_validation->set_rules('tanggalMasuk', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/masuk', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertBarangMasuk();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('barang/barangmasuk');
        }
    }

    public function updateBarangMasuk()
    {
        $this->form_validation->set_rules('jumlahMasuk', 'Jumlah', 'required');
        $this->form_validation->set_rules('tanggalMasuk', 'Tanggal', 'required');
    
        $this->barang->updateBarangMasuk();
        $this->session->set_flashdata('flash', 'Diedit');
        redirect('barang/barangmasuk');
    }

    public function deleteBarangMasuk($id)
    {
        // $this->barang->deleteBarangMasuk($id);
        $this->db->delete('barang_masuk', ['id_masuk' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('barang/barangmasuk');
    }

    public function barangkeluar()
    {
        $data['title'] = 'Barang Keluar';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barangkeluar'] = $this->barang->getBarangKeluar();
        $data['barang'] = $this->db->get('barang')->result_array();

        $this->form_validation->set_rules('idBarang', 'id', 'required');
        $this->form_validation->set_rules('jumlahKeluar', 'Jumlah', 'required');
        $this->form_validation->set_rules('tanggalKeluar', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/keluar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertBarangKeluar();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('barang/barangkeluar');
        }
    }

    public function updateBarangKeluar()
    {
        $this->form_validation->set_rules('jumlahKeluar', 'Jumlah', 'required');
        $this->form_validation->set_rules('tanggalKeluar', 'Tanggal', 'required');

        $this->barang->updateBarangKeluar();
        $this->session->set_flashdata('flash', 'Diedit');
        redirect('barang/barangkeluar');
    }

    public function deleteBarangKeluar($id)
    {
        // $this->barang->deleteBarangKeluar($id);
        $this->db->delete('barang_keluar', ['id_keluar' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('barang/barangkeluar');
    }

}