<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Stok Barang';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['barang'] = $this->barang->getBarangJoin();
        $data['barang'] = $this->barang->getBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function kategori()
    {
        $data['title'] = 'Kategori Barang';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori_barang')->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertkategori();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('data/kategori');
        }
    }

    public function updateKategori()
    {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

        $this->barang->updateKategori();
        $this->session->set_flashdata('flash', 'Diedit');
        redirect('data/kategori');
    }

    public function deleteKategori($id)
    {
        $this->db->delete('kategori_barang', ['id_kategori' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('data/kategori');
    }

    public function barangMasuk()
    {
        $data['title'] = 'Barang Masuk';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori_barang')->result_array();
        $data['kodeBarang'] = $this->barang->kodeBarang();
        $data['barangmasuk'] = $this->barang->getBarangMasuk();

        $this->form_validation->set_rules('kodeBarang', 'Kode', 'required');
        $this->form_validation->set_rules('kategoriBarang', 'Kategori', 'required');
        $this->form_validation->set_rules('namaBarang', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlahMasuk', 'Jumlah', 'required');
        // $this->form_validation->set_rules('tanggalMasuk', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/masuk', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertBarangMasuk();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('data/barangmasuk');
        }
    }

    public function updateBarangMasuk()
    {
        $this->form_validation->set_rules('kategoriBarang', 'Kategori', 'required');
        $this->form_validation->set_rules('namaBarang', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlahMasuk', 'Jumlah', 'required');
        // $this->form_validation->set_rules('tanggalMasuk', 'Tanggal', 'required');

        $this->barang->updateBarangMasuk();
        $this->session->set_flashdata('flash', 'Diedit');
        redirect('data/barangmasuk');
    }

    public function deleteBarangMasuk($id)
    {
        $this->barang->deleteBarangMasuk($id);
        $this->db->delete('barang_masuk', ['kode_barang' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('data/barangmasuk');
    }

    public function barangKeluar()
    {
        $data['title'] = 'Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barangmasuk'] = $this->db->get('barang_masuk')->result_array();
        $data['barangkeluar'] = $this->barang->getBarangKeluar();

        $this->form_validation->set_rules('kodeBarang', 'Kode', 'required');
        $this->form_validation->set_rules('jumlahKeluar', 'Jumlah', 'required');
        // $this->form_validation->set_rules('tanggalKeluar', 'Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/keluar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->barang->insertBarangKeluar();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('data/barangkeluar');
        }
    }


    public function updateBarangKeluar()
    {
        $this->form_validation->set_rules('jumlahKeluar', 'Jumlah', 'required');
        // $this->form_validation->set_rules('tanggalMasuk', 'Tanggal', 'required');

        $this->barang->updateBarangKeluar();

        $this->session->set_flashdata('flash', 'Diedit');
        redirect('data/barangkeluar');
    }

    public function deletebarangkeluar($id)
    {
        $this->db->delete('barang_keluar', ['id_keluar' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('data/barangkeluar');
    }
}
