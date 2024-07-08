<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    // public function getAllBarang()
    // {
    //     date_default_timezone_set("Asia/jakarta");
    //     $hari = date('Y-m-d');
    //     $awal = $this->input->post('awal', true);
    //     $akhir = $this->input->post('akhir', true);
    //     $query = "SELECT SUM(barang_masuk.jumlah_masuk) AS jumlah_masuk, SUM(barang_keluar.jumlah_keluar) AS jumlah_keluar, kategori_barang.*, barang_masuk.*, barang_keluar.*  FROM kategori_barang 
    //                 LEFT JOIN barang_masuk ON kategori_barang.id_kategori = barang_masuk.kategori_barang
    //                 LEFT JOIN barang_keluar ON barang_masuk.kode_barang = barang_keluar.kode_barang GROUP BY barang_masuk.kode_barang ASC
    //     ";
    //     return $this->db->query($query)->result_array();
    // }

    public function getBarang()
    {
        date_default_timezone_set("Asia/jakarta");
        $jkt = date('H.i A');
        $jam = date('H:i:s');
        $hari = date('Y-m-d');

        $awal = $this->input->post('awal', true);
        $akhir = $this->input->post('akhir', true);
        $query = "SELECT DISTINCT SUM(barang_masuk.jumlah_masuk) AS jm, SUM(barang_keluar.jumlah_keluar) AS jk, kategori_barang.*, barang_masuk.*, barang_keluar.* FROM kategori_barang INNER JOIN barang_masuk ON barang_masuk.kategori_barang = kategori_barang.id_kategori INNER JOIN barang_keluar ON barang_keluar.kode_barang = barang_masuk.kode_barang WHERE barang_masuk.tgl_masuk BETWEEN '$awal' AND '$akhir' AND barang_keluar.tgl_keluar BETWEEN '$awal' AND '$akhir' GROUP BY barang_masuk.kode_barang ASC
        ";
        return $this->db->query($query)->result();
    }

    public function getBarangSum()
    {
        date_default_timezone_set("Asia/jakarta");
        $jkt = date('H.i A');
        $jam = date('H:i:s');
        $hari = date('Y-m-d');

        $awal = $this->input->post('awal', true);
        $akhir = $this->input->post('akhir', true);
        $query = "SELECT barang_masuk.kode_barang, kategori_barang.*, barang_masuk.*, barang_keluar.*,
        SUM(barang_masuk.jumlah_masuk) AS masuk, 
        SUM(barang_keluar.jumlah_keluar) AS keluar, 
        barang_masuk.jumlah_masuk - SUM(barang_keluar.jumlah_keluar) AS stok, 
        (barang_masuk.jumlah_masuk - SUM(barang_keluar.jumlah_keluar)) * barang_masuk.harga AS total 
        FROM barang_masuk 
        JOIN kategori_barang ON barang_masuk.kategori_barang = kategori_barang.id_kategori
        JOIN barang_keluar ON barang_masuk.kode_barang = barang_keluar.kode_barang  WHERE barang_masuk.tgl_masuk BETWEEN '$awal' AND '$akhir' AND barang_keluar.tgl_keluar BETWEEN '$awal' AND '$akhir' GROUP BY barang_masuk.kode_barang ASC";
        // $query = "SELECT barang_masuk.kode_barang, barang_masuk.nama_barang,barang_masuk.jumlah_masuk ,SUM(barang_keluar.jumlah_keluar) AS keluar, 
        // barang_masuk.jumlah_masuk - SUM(barang_keluar.jumlah_keluar) AS stok, 
        // barang_masuk.harga, (barang_masuk.jumlah_masuk - SUM(barang_keluar.jumlah_keluar)) * barang_masuk.harga AS total 
        // FROM barang_masuk JOIN barang_keluar ON barang_masuk.kode_barang = barang_keluar.kode_barang  WHERE barang_masuk.tgl_masuk BETWEEN '$awal' AND '$akhir' AND barang_keluar.tgl_keluar BETWEEN '$awal' AND '$akhir' GROUP BY barang_masuk.kode_barang ASC";
        return $this->db->query($query)->result();
    }


    public function getBarangMasukByTgl()
    {
        $awal = $this->input->post('awal', true);
        $akhir = $this->input->post('akhir', true);
        $query = "SELECT kategori_barang.*, barang_masuk.*, SUM(barang_masuk.jumlah_masuk) AS jm, SUM(barang_masuk.jumlah_masuk) * barang_masuk.harga AS totalm FROM barang_masuk JOIN kategori_barang ON barang_masuk.kategori_barang = kategori_barang.id_kategori WHERE barang_masuk.tgl_masuk BETWEEN '$awal' AND '$akhir' GROUP BY barang_masuk.kode_barang ASC
        ";
        return $this->db->query($query)->result();
    }

    public function getBarangKeluarByTgl()
    {
        $awal = $this->input->post('awal', true);
        $akhir = $this->input->post('akhir', true);
        $query = "SELECT kategori_barang.*, barang_masuk.*, barang_keluar.*, barang_masuk.kode_barang, SUM(barang_keluar.jumlah_keluar) AS jk, SUM(barang_keluar.jumlah_keluar) * barang_masuk.harga AS totalk FROM barang_keluar JOIN barang_masuk ON barang_keluar.kode_barang = barang_masuk.kode_barang JOIN kategori_barang ON barang_masuk.kategori_barang = kategori_barang.id_kategori WHERE barang_keluar.tgl_keluar BETWEEN '$awal' AND '$akhir' GROUP BY barang_masuk.kode_Barang ASC
        ";
        return $this->db->query($query)->result();
    }
}
