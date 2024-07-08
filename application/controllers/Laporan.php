<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Css\Style;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Laporan_model', 'laporan');
    }

    public function index()
    {
        $data['title'] = "Cetak Laporan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->laporan->getBarang();
        // $this->laporan->dataCetak();

        // $data['masuk'] = $this->laporan->getBarangMasukByTgl();
        // $data['keluar'] = $this->laporan->getBarangKeluarByTgl();

        $this->form_validation->set_rules('awal', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Tanggal Akhir', 'required');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function pdf()
    {
        $title = 'Laporan Stok Barang';
        $this->load->library('fungsi');
        // $data['barang'] = $this->laporan->getBarang();
        $data['bsum'] = $this->laporan->getBarangSum();
        $view = $this->load->view('laporan/pdf', $data, true);
        $this->fungsi->PdfGenerator($view, $title, 'F4', 'potrait');
    }

    public function excel()
    {
        $this->load->library('excel');
        $textCenter = $this->excel->textCenter();
        // $data = $this->laporan->getBarang();
        $data = $this->laporan->getBarangSum();

        $spreadsheet = new Spreadsheet;

        // Sheet 0 (Laporan Stok Barang)
        $sheet0 = $spreadsheet->getActiveSheet('Laporan Stok Barang');
        $sheet0Set = $spreadsheet->setActiveSheetIndex(0);
        $sheet0->setTitle('Laporan Stok Barang');

        $sheet0->getStyle('A')->applyFromArray($textCenter);
        $sheet0->getStyle('A6:I6')->applyFromArray($textCenter);
        $sheet0->getStyle('E:G')->applyFromArray($textCenter);
        $sheet0->getColumnDimension('A')->setWidth(30, 'px');
        $sheet0->getColumnDimension('B')->setAutoSize(true);
        $sheet0->getColumnDimension('C')->setAutoSize(true);
        $sheet0->getColumnDimension('D')->setAutoSize(true);
        $sheet0->getColumnDimension('G')->setAutoSize(true);
        $sheet0->getColumnDimension('H')->setAutoSize(true);
        $sheet0->getColumnDimension('I')->setAutoSize(true);
        $sheet0Set->setCellValue('A1', 'PEMERINTAH KABUPATEN MADIUN')->mergeCells('A1:I1');
        $sheet0Set->setCellValue('A2', 'DINAS SOSIAL')->mergeCells('A2:I2');
        $sheet0Set->setCellValue('A3', 'JL. Raya Dungus KM 4, Mojopurno, Madiun, Kode Pos 63181 ')->mergeCells('A3:I3');
        $sheet0Set->setCellValue('A4', 'LAPORAN STOK BARANG')->mergeCells('A4:I4')->getStyle('A4')->applyFromArray($this->excel->cellColor('279bc2'));
        $sheet0Set
            ->setCellValue('A6', 'No')
            ->setCellValue('B6', 'Kode Barang')
            ->setCellValue('C6', 'Kategori Barang')
            ->setCellValue('D6', 'Nama Barang')
            ->setCellValue('E6', 'Masuk')
            ->setCellValue('F6', 'Keluar')
            ->setCellValue('G6', 'Jumlah Stok')
            ->setCellValue('H6', 'Harga')
            ->setCellValue('I6', 'Total');
        $sheet0Set->getStyle('A6:I6')->applyFromArray($this->excel->cellColor('279bc2'));

        $baris = 7;
        $nomor = 1;

        foreach ($data as $d) {

            $jum = $d->jumlah_masuk - $d->jumlah_keluar;
            $total = $jum * $d->harga;
            $sheet0Set
                ->setCellValue('A' . $baris, $nomor)
                ->setCellValue('B' . $baris, $d->kode_barang)
                ->setCellValue('C' . $baris, $d->kategori)
                ->setCellValue('D' . $baris, $d->nama_barang)
                ->setCellValue('E' . $baris, $d->jumlah_masuk)
                ->setCellValue('F' . $baris, $d->jumlah_keluar)
                ->setCellValue('G' . $baris, $jum)
                ->setCellValue('H' . $baris, rupiah($d->harga))
                ->setCellValue('I' . $baris, rupiah($total));
            $sheet0Set->getStyle('A6:I' . $baris)->applyFromArray($this->excel->border());
            $baris++;
            $nomor++;
        }
        $brs = $baris++;
        $sum = 0;
        foreach ($data as $ba) {
            $sum += $ba->total;
        }

        $sheet0Set->setCellValue('A' . $brs, 'Total')->mergeCells('A' . $brs . ':H' . $brs);
        $sheet0Set->setCellValue('I' . $brs, rupiah($sum));
        $sheet0Set->getStyle('A' . $brs . ':I' . $brs)->applyFromArray($this->excel->border())->applyFromArray($this->excel->cellColor('279bc2'));

        $b1 = $baris + 2;
        $sheet0Set->setCellValue('G' . $b1, hari() . ', ' . date('d') . ' ' . bulan() . ' ' . date('Y'))->mergeCells('G' . $b1 . ':I' . $b1);
        $b2 = $b1 + 2;
        $sheet0Set->setCellValue('A' . $b2, 'Mengetahui')->mergeCells('A' . $b2 . ':I' . $b2);
        $b3 = $b2 + 2;
        $sheet0Set
            ->setCellValue('B' . $b3, 'Bendahara')->mergeCells('B' . $b3 . ':D' . $b3)
            ->setCellValue('E' . $b3, 'Atasan')->mergeCells('E' . $b3 . ':H' . $b3);
        $b4 = $b3 + 4;
        $sheet0Set
            ->setCellValue('B' . $b4, '( Diah Ayu Intan Kusuma, S.Sos )')->mergeCells('B' . $b4 . ':D' . $b4)
            ->setCellValue('E' . $b4, '( Erna Rachmawati, S.IP., M.M )')->mergeCells('E' . $b4 . ':H' . $b4);
        $sheet0->getStyle('B' . $b3 . ':B' . $b4)->applyFromArray($textCenter);

        // Sheet 1
        $spreadsheet->createSheet(1);
        $sheet1 = $spreadsheet->getSheet(1)->setTitle('Barang Masuk');
        $sheet1 = $spreadsheet->getSheetByName('Barang Masuk');
        $sheet1->getStyle('A')->applyFromArray($textCenter);
        $sheet1->getStyle('A6:H6')->applyFromArray($textCenter);
        $sheet1->getStyle('F')->applyFromArray($textCenter);
        $sheet1->getColumnDimension('A')->setWidth(30, 'px');
        $sheet1->getColumnDimension('B')->setAutoSize(true);
        $sheet1->getColumnDimension('C')->setAutoSize(true);
        $sheet1->getColumnDimension('D')->setAutoSize(true);
        $sheet1->getColumnDimension('E')->setAutoSize(true);
        $sheet1->getColumnDimension('G')->setAutoSize(true);
        $sheet1->getColumnDimension('H')->setAutoSize(true);
        $sheet1->setCellValue('A1', 'PEMERINTAH KABUPATEN MADIUN')->mergeCells('A1:H1')->getStyle('A1')->applyFromArray($textCenter);
        $sheet1->setCellValue('A2', 'DINAS SOSIAL')->mergeCells('A2:H2')->getStyle('A2')->applyFromArray($textCenter);
        $sheet1->setCellValue('A3', 'JL. Raya Dungus KM 4, Mojopurno, Madiun, Kode Pos 63181')->mergeCells('A3:H3')->getStyle('A3')->applyFromArray($textCenter);
        $sheet1->setCellValue('A4', 'LAPORAN STOK BARANG MASUK')->mergeCells('A4:H4')->getStyle('A4')->applyFromArray($textCenter)->applyFromArray($this->excel->cellColor('279bc2'));
        $sheet1->setCellValue('A6', 'No.')
            ->setCellValue('B6', 'Tanggal')
            ->setCellValue('C6', 'Kode Barang')
            ->setCellValue('D6', 'Kategori Barang')
            ->setCellValue('E6', 'Nama Barang')
            ->setCellValue('F6', 'Masuk')
            ->setCellValue('G6', 'Harga')
            ->setCellValue('H6', 'Total');
        $sheet1->getStyle('A6:H6')->applyFromArray($textCenter)->applyFromArray($this->excel->cellColor('279bc2'))->applyFromArray($this->excel->border());

        $barisM = 6;
        $nomorM = 1;
        $masuk = $this->laporan->getBarangMasukByTgl();
        foreach ($masuk as $m) {
            $sheet1
                ->setCellValue('A' . $barisM, $nomorM . '.')
                ->setCellValue('B' . $barisM, $m->tgl_masuk)
                ->setCellValue('C' . $barisM, $m->kode_barang)
                ->setCellValue('D' . $barisM, $m->kategori)
                ->setCellValue('E' . $barisM, $m->nama_barang)
                ->setCellValue('F' . $barisM, $m->jm)
                ->setCellValue('G' . $barisM, $m->harga)
                ->setCellValue('H' . $barisM, $m->jm * $m->harga);

            $sheet1->getStyle('A' . $barisM . ':H' . $barisM)->applyFromArray($this->excel->border());
            $barisM++;
            $nomorM++;
        }
        $brsM = $barisM++;
        $sumM = 0;
        foreach ($masuk as $tm) {
            $sumM += $tm->totalm;
        }
        $sheet1->setCellValue('A' . $brsM, 'Total')->mergeCells('A' . $brsM . ':G' . $brsM);
        $sheet1->setCellValue('H' . $brsM, rupiah($sumM));
        $sheet1->getStyle('A' . $brsM . ':H' . $brsM)->applyFromArray($this->excel->border())->applyFromArray($this->excel->cellColor('279bc2'));
        // end sheet 1


        // Sheet 2
        $spreadsheet->createSheet(2);
        $sheet2 = $spreadsheet->getSheet(2)->setTitle('Barang Keluar');
        $sheet2 = $spreadsheet->getSheetByName('Barang Keluar');
        $sheet2->getStyle('A')->applyFromArray($textCenter);
        $sheet2->getStyle('A6:H6')->applyFromArray($textCenter);
        $sheet2->getStyle('F')->applyFromArray($textCenter);
        $sheet2->getColumnDimension('A')->setWidth(30, 'px');
        $sheet2->getColumnDimension('B')->setAutoSize(true);
        $sheet2->getColumnDimension('C')->setAutoSize(true);
        $sheet2->getColumnDimension('D')->setAutoSize(true);
        $sheet2->getColumnDimension('E')->setAutoSize(true);
        $sheet2->getColumnDimension('G')->setAutoSize(true);
        $sheet2->getColumnDimension('H')->setAutoSize(true);
        $sheet2->setCellValue('A1', 'PEMERINTAH KABUPATEN MADIUN')->mergeCells('A1:H1')->getStyle('A1')->applyFromArray($textCenter);
        $sheet2->setCellValue('A2', 'DINAS SOSIAL')->mergeCells('A2:H2')->getStyle('A2')->applyFromArray($textCenter);
        $sheet2->setCellValue('A3', 'JL. Raya Dungus KM 4, Mojopurno, Madiun, Kode Pos 63181')->mergeCells('A3:H3')->getStyle('A3')->applyFromArray($textCenter);
        $sheet2->setCellValue('A4', 'LAPORAN STOK BARANG KELUAR')->mergeCells('A4:H4')->getStyle('A4')->applyFromArray($textCenter)->applyFromArray($this->excel->cellColor('279bc2'));
        $sheet2->setCellValue('A6', 'No.')
            ->setCellValue('B6', 'Tanggal')
            ->setCellValue('C6', 'Kode Barang')
            ->setCellValue('D6', 'Kategori Barang')
            ->setCellValue('E6', 'Nama Barang')
            ->setCellValue('F6', 'Keluar')
            ->setCellValue('G6', 'Harga')
            ->setCellValue('H6', 'Total');
        $sheet2->getStyle('A6:H6')->applyFromArray($textCenter)->applyFromArray($this->excel->cellColor('279bc2'))->applyFromArray($this->excel->border());

        $barisK = 6;
        $nomorK = 1;
        $keluar = $this->laporan->getBarangKeluarByTgl();
        foreach ($keluar as $k) {
            $sheet2
                ->setCellValue('A' . $barisK, $nomorK++ . '.')
                ->setCellValue('B' . $barisK, $k->tgl_keluar)
                ->setCellValue('C' . $barisK, $k->kode_barang)
                ->setCellValue('D' . $barisK, $k->kategori)
                ->setCellValue('E' . $barisK, $k->nama_barang)
                ->setCellValue('F' . $barisK, $k->jk)
                ->setCellValue('G' . $barisK, $k->harga)
                ->setCellValue('H' . $barisK, $k->jk * $k->harga);
            $sheet2->getStyle('A' . $barisK . ':H' . $barisK)->applyFromArray($this->excel->border());
            $barisK++;
        }

        $brsK = $barisK++;
        $sumK = 0;
        foreach ($keluar as $tk) {
            $sumK += $tk->totalk;
        }
        $sheet2->setCellValue('A' . $brsK, 'Total')->mergeCells('A' . $brsK . ':G' . $brsK);
        $sheet2->setCellValue('H' . $brsK, rupiah($sumK));
        $sheet2->getStyle('A' . $brsK . ':H' . $brsK)->applyFromArray($this->excel->border())->applyFromArray($this->excel->cellColor('279bc2'));

        // end sheet 2


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Barang ' . date('d-m-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
