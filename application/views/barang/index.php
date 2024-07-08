<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php if ($this->session->flashdata('flash')) : ?>
        <!-- <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data barang <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div> -->
    <?php endif; ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Barang</h1>

    <?= form_error('barang', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <div class="card border-top-primary shadow h-100 py-2">
        <div class="card-body pb-0">
            <a class="btn btn-success" href="<?= base_url('data/barangmasuk'); ?>"><i class="fas fa-plus"></i> Tambah Barang Masuk</a>
            <a class="btn btn-danger" href="<?= base_url('data/barangkeluar'); ?>"><i class="fas fa-plus"></i> Tambah Barang Keluar</a>
        </div>


        <!-- Button trigger modal -->
        <div class="card-body">
            <table id="dataTable" class="table table-hover table-responsive-lg text-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Keluar</th>
                        <th scope="col">Stok Akhir</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <td><?= $i++ . '.'; ?></td>
                            <td><?= $b['kode_barang']; ?></td>
                            <td><?= $b['nama_barang']; ?></td>
                            <td><?= jumlah($b['masuk'] ?? 0); ?></td>
                            <td><?= jumlah($b['keluar'] ?? 0); ?></td>
                            <td><?= jumlah($b['masuk'] - $b['keluar']); ?></td>
                            <td><?= rupiah($b['harga']); ?></td>
                            <td><?= rupiah(($b['masuk'] - $b['keluar']) * $b['harga']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->