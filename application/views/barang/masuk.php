<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php if ($this->session->flashdata('flash')) : ?>
        <!-- <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div> -->
    <?php endif; ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Barang Masuk</h1>
    <div class="card border-top-primary shadow h-100 py-2">
        <div class="card-body pb-0">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#barangMasuk">
                <i class="fas fa-plus"> </i> Tambah Barang Masuk
            </button>
            <a href="<?= base_url('data/kategori'); ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Kategori</a>
        </div>

        <div class="card-body">
            <table id="dataTable" class="table table-hover table-responsive-xl text-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($barangmasuk as $bm) : ?>
                        <?php
                        $total = $bm['jumlah_masuk'] * $bm['harga'];
                        ?>
                        <tr>
                            <th scope="row"><?= $i++ . '.'; ?></th>
                            <td><?= date('j F Y', strtotime($bm["tgl_masuk"])); ?></td>
                            <td><?= $bm['kode_barang']; ?></td>
                            <td><?= $bm['kategori']; ?></td>
                            <td><?= $bm['nama_barang']; ?></td>
                            <td><?= rupiah($bm['harga']); ?></td>
                            <td><?= jumlah($bm['jumlah_masuk']); ?></td>
                            <td><?= rupiah($total); ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#updateBarangMasuk<?= $bm['kode_barang']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('data/deleteBarangMasuk/') ?><?= $bm['kode_barang']; ?>" class="btn btn-danger btn-circle btn-sm tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                        <!-- Modal Update-->
                        <div class="modal fade" id="updateBarangMasuk<?= $bm['kode_barang']; ?>" tabindex="-1" aria-labelledby="updateBarangMasukLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="barangMasukLabel">Edit Barang Masuk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('data/updateBarangMasuk/'); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kodeBarang">Kode Barang</label>
                                                <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" value="<?= $bm['kode_barang']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategoriBarang">Kategori Barang</label>
                                                <select class="form-control" id="kategoriBarang" name="kategoriBarang">
                                                    <?php foreach ($kategori as $k) : ?>
                                                        <?php if ($k['id_kategori'] == $bm['kategori_barang']) : ?>
                                                            <option value="<?= $k['id_kategori']; ?>" selected><?= $k['kategori']; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $k['id_kategori']; ?>"><?= $k['kategori']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="namaBarang">Nama Barang</label>
                                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $bm['nama_barang']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga Barang</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">RP.</div>
                                                    </div>
                                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $bm['harga']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlahMasuk">Jumlah Barang</label>
                                                <input type="number" class="form-control" id="jumlahMasuk" name="jumlahMasuk" value="<?= $bm['jumlah_masuk']; ?>">
                                            </div>
                                            <!-- <div class="form-group">
                                                    <label for="tanggalMasuk">Tanggal Masuk</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="tanggalMasuk" name="tanggalMasuk" value="<?= $bm['tgl_masuk']; ?>">
                                                    </div>
                                                </div> -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="barangMasuk" tabindex="-1" aria-labelledby="barangMasukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barangMasukLabel">Tambah Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('data/barangmasuk'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kodeBarang">Kode Barang</label>
                            <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" value="<?= $kodeBarang; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kategoriBarang">Kategori Barang</label>
                            <select class="form-control" id="kategoriBarang" name="kategoriBarang" required>
                                <option>Pilih Barang</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id_kategori'] ?>"><?= $k['kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RP.</div>
                                </div>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlahMasuk">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlahMasuk" name="jumlahMasuk" placeholder="Jumlah" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>