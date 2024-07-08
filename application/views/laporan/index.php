<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-header bg-white">
            <?= form_error('laporan', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <form action="" method="POST">
                <?php if (!isset($_POST['cari'])) : ?>
                    <div class="row">
                        <div class="col-lg-6 form-group mt-3">
                            <label for="awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="awal" id="awal" required>
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label for="akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="akhir" id="akhir" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" name="cari">Cari</button>
                <?php else : ?>
                    <div class="row">
                        <div class="col-lg-6 form-group mt-3">
                            <label for="awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="awal" id="awal" value="<?= $_POST['awal'] ?>" required>
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label for="akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="akhir" id="akhir" value="<?= $_POST['akhir'] ?>" required>
                        </div>
                    </div>
                    <button class="btn btn-secondary" name="cari">Cari</button>
                <?php endif; ?>
            </form>
        </div>
        <?php if (isset($_POST['cari'])) : ?>
            <div class="card-body">
                <div class="btn-group mb-3" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Cetak
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <form action="<?= base_url('laporan/excel/') ?>" method="POST" target="_blank">
                            <input type="text" name="awal" value="<?= $_POST['awal'] ?>" hidden>
                            <input type="text" name="akhir" value="<?= $_POST['akhir'] ?>" hidden>
                            <button class="dropdown-item btn btn-success" type="submit"><i class="fas fa-file-excel text-success"></i> Excel</button>
                        </form>
                        <form action="<?= base_url('laporan/pdf/') ?>" method="POST" target="_blank">
                            <input type="text" name="awal" value="<?= $_POST['awal'] ?>" hidden>
                            <input type="text" name="akhir" value="<?= $_POST['akhir'] ?>" hidden>
                            <button class="dropdown-item btn btn-danger"><i class="fas fa-file-pdf text-danger"></i> PDF</button>
                        </form>
                    </div>
                </div>
                <table id="dataTable" class="table table-hover table-responsive-lg text-dark">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                            <th scope="col">Total Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <?php foreach ($barang as $m) : ?>
                            <?php
                            $stok = $m->jumlah_masuk - $m->jk;
                            $total = $m->harga * $stok;
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $m->kode_barang; ?></td>
                                <td><?= $m->nama_barang; ?></td>
                                <td><?= $m->jumlah_masuk; ?></td>
                                <td><?= $m->jk; ?></td>
                                <td><?= $stok; ?></td>
                                <td><?= rupiah($m->harga); ?></td>
                                <td><?= rupiah($total); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->