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
    <h1 class="h3 mb-4 text-gray-800">Barang Keluar</h1>

    <div class="card border-top-primary shadow h-100 py-2">
        <div class="card-body pb-0">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#barangKeluar">
                <i class="fas fa-plus"> </i> Tambah Barang Keluar
            </button>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-hover table-responsive-lg text-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Kategori Barang</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($barangkeluar as $bk) : ?>
                        <tr>
                            <th scope="row"><?= $i++ . '.'; ?></th>
                            <td><?= date('j F Y', strtotime($bk["tgl_keluar"])); ?></td>
                            <td><?= $bk['kode_barang']; ?></td>
                            <td><?= $bk['kategori']; ?></td>
                            <td><?= $bk['nama_barang']; ?></td>
                            <td><?= jumlah($bk['jumlah_keluar']); ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#updateBarangKeluar<?= $bk['id_keluar']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('data/deletebarangkeluar/') ?><?= $bk['id_keluar']; ?>" class="btn btn-danger btn-circle btn-sm tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                        <!-- Modal Update -->
                        <div class="modal fade" id="updateBarangKeluar<?= $bk['id_keluar']; ?>" tabindex="-1" aria-labelledby="updateBarangKeluarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateBarangKeluarLabel">Edit Barang Keluar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('data/updateBarangKeluar/'); ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="idKeluar" value="<?= $bk['id_keluar'] ?>" hidden readonly>
                                            <input type="hidden" name="kodeBarang" value="<?= $bk['kode_barang'] ?>" hidden readonly>
                                            <div class="form-group">
                                                <label for="namaBarang">Nama Barang</label>
                                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $bk['kode_barang'] . ' | ' . $bk['nama_barang']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlahKeluar">Jumlah Barang</label>
                                                <input type="number" class="form-control" id="jumlahKeluar" name="jumlahKeluar" value="<?= $bk['jumlah_keluar']; ?>">
                                            </div>
                                            <!-- <div class="form-group">
                                                    <label for="tanggalKeluar">Tanggal Keluar</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="tanggalKeluar" name="tanggalKeluar" value="<?= $bk['tgl_keluar']; ?>">
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
<!-- End of Main Content -->

<!-- Modal Insert -->
<div class="modal fade" id="barangKeluar" tabindex="-1" aria-labelledby="barangKeluarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barangKeluarLabel">Tambah Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('data/barangkeluar'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kodeBarang">Nama Barang</label>
                            <select class="form-control" id="kodeBarang" name="kodeBarang">
                                <option>Pilih Barang</option>
                                <?php foreach ($barangmasuk as $bm) : ?>
                                    <option value="<?= $bm['kode_barang'] ?>"><?= $bm['kode_barang'] . ' | ' . $bm['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlahKeluar">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlahKeluar" name="jumlahKeluar" placeholder="Jumlah">
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