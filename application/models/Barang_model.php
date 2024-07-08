<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function getBarangJoin()
    {
        $query = "SELECT SUM(barang_masuk.jumlah_masuk) AS jumlah_masuk, SUM(barang_keluar.jumlah_keluar) AS jumlah_keluar, barang_masuk.*, barang_keluar.* FROM barang_masuk LEFT JOIN barang_keluar ON barang_masuk.kode_barang = barang_keluar.kode_barang GROUP BY barang_masuk.kode_barang";
        return $this->db->query($query)->result_array();
    }

    public function getBarang()
    {
        $query = "SELECT * FROM stok_barang JOIN barang_masuk ON stok_barang.kode_barang = barang_masuk.kode_barang";
        return $this->db->query($query)->result_array();
    }

    public function insertkategori()
    {
        $data = [
            "kategori" => $this->input->post('kategori', true),
        ];

        $this->db->insert('kategori_barang', $data);
    }

    public function updateKategori()
    {
        $kategori = $this->input->post('kategori');
        $id = $this->input->post('id_kategori');

        $this->db->set('kategori', $kategori);
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori_barang');
    }

    public function kodeBarang()
    {
        date_default_timezone_set("Asia/jakarta");
        $jkt = date('H.i A');
        $jam = date('H:i:s');
        $hari = date('Y-m-d');
        $Thn = date('Y');
        $Bln = date('m');
        $where = "MONTH(tgl_masuk) = '$Bln' AND YEAR(tgl_masuk) = '$Thn'";

        $this->db->select('RIGHT(barang_masuk.kode_barang,2) as kode_barang', FALSE);
        $this->db->where($where);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('barang_masuk');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "BRG-" . date('dmy') . $batas;  //format kode
        return $kodetampil;
    }

    public function getBarangMasuk()
    {
        $query = "SELECT barang_masuk.*, kategori_barang.*
                    FROM barang_masuk JOIN kategori_barang
                    ON barang_masuk.kategori_barang = kategori_barang.id_kategori ORDER BY barang_masuk.tgl_masuk DESC";
        return $this->db->query($query)->result_array();
    }

    public function insertBarangMasuk()
    {
        date_default_timezone_set("Asia/jakarta");
        $jkt = date('H.i A');
        $jam = date('H:i:s');
        $hari = date('Y-m-d');

        $kode_barang = $this->input->post('kodeBarang', true);
        $jumlah_masuk = $this->input->post('jumlahMasuk', true);

        $data = [
            "kode_barang" => $kode_barang,
            "kategori_barang" => $this->input->post('kategoriBarang', true),
            "nama_barang" => $this->input->post('namaBarang', true),
            "harga" => $this->input->post('harga', true),
            "jumlah_masuk" => $jumlah_masuk,
            // "tgl_masuk" => $this->input->post('tanggalMasuk', true),
            "tgl_masuk" => $hari,
            "waktu_masuk" => $jam
        ];

        // $data2 = [
        //     "kode_barang" => $kode_barang,
        //     "masuk" => $jumlah_masuk
        // ];

        $this->db->insert('barang_masuk', $data);
        // $this->db->insert('stok_barang', $data2);
    }

    public function updateBarangMasuk()
    {

        $kategoriBarang = $this->input->post('kategoriBarang');
        $namaBarang = $this->input->post('namaBarang');
        $harga = $this->input->post('harga');
        $jumlahMasuk = $this->input->post('jumlahMasuk');
        // $tanggalMasuk = $this->input->post('tanggalMasuk');
        $idMasuk = $this->input->post('kodeBarang');

        $this->db->set('kategori_barang', $kategoriBarang);
        $this->db->set('nama_barang', $namaBarang);
        $this->db->set('harga', $harga);
        $this->db->set('jumlah_masuk', $jumlahMasuk);
        // $this->db->set('tgl_masuk', $tanggalMasuk);
        $this->db->where('kode_barang', $idMasuk);
        $this->db->update('barang_masuk');

        // update stok_barang
        // $this->db->set('masuk', $jumlahMasuk);
        // $this->db->where('kode_barang', $idMasuk);
        // $this->db->update('stok_barang');
    }

    public function deleteBarangMasuk($id)
    {
        $this->db->delete('barang_masuk', ['kode_barang' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
    }

    public function getBarangKeluar()
    {
        $query = "SELECT kategori_barang.*, stok_barang.*, barang_keluar.*, barang_masuk.*
                    FROM barang_keluar 
                    JOIN barang_masuk ON barang_keluar.kode_barang = barang_masuk.kode_barang
                    JOIN stok_barang ON barang_keluar.kode_barang = stok_barang.kode_barang JOIN kategori_barang ON barang_masuk.kategori_barang = kategori_barang.id_kategori
                    ORDER BY barang_keluar.tgl_keluar DESC";
        return $this->db->query($query)->result_array();
    }

    public function insertBarangKeluar()
    {
        date_default_timezone_set("Asia/jakarta");
        $jkt = date('H.i A');
        $jam = date('H:i:s');
        $hari = date('Y-m-d');

        $kode_barang = $this->input->post('kodeBarang', true);
        $jumlah_keluar = $this->input->post('jumlahKeluar', true);

        $data = [
            "kode_barang" => $kode_barang,
            "jumlah_keluar" => $jumlah_keluar,
            "tgl_keluar" => $hari,
            "waktu_keluar" => $jam
        ];

        $this->db->insert('barang_keluar', $data);
    }

    public function keluarSum($kode_barang)
    {
        $query = "SELECT SUM(jumlah_keluar) as sumkel FROM barang_keluar WHERE kode_barang = '$kode_barang' GROUP BY kode_barang";
        return $this->db->query($query)->result();
    }

    public function updateBarangKeluar()
    {
        $jumlah_keluar = $this->input->post('jumlahKeluar');
        // $tanggalKeluar = $this->input->post('tanggalKeluar');
        $idKeluar = $this->input->post('idKeluar');
        $kode_barang = $this->input->post('kodeBarang');

        $this->db->set('jumlah_keluar', $jumlah_keluar);
        // $this->db->set('tanggal_keluar', $tanggalKeluar);
        $this->db->where('id_keluar', $idKeluar);
        $this->db->update('barang_keluar');
    }
}
