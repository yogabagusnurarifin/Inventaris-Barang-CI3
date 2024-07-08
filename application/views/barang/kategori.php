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
    <h1 class="h3 mb-4 text-gray-800">Kategori Barang</h1>

    <?= form_error('kategori', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <div class="col-xl-8">
        <div class="card border-top-primary shadow h-100 py-2">
            <div class="card-body pb-0">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#barangMasuk">
                    <i class="fas fa-plus"> </i> Tambah Kategori
                </button>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-hover table-responsive-lg text-dark">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kategori as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i++ . '.'; ?></th>
                                <td><?= $k['kategori']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#updateBarangMasuk<?= $k['id_kategori']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('data/deleteKategori/') ?><?= $k['id_kategori']; ?>" class="btn btn-danger btn-circle tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>

                            <!-- Modal Update-->
                            <div class="modal fade" id="updateBarangMasuk<?= $k['id_kategori']; ?>" tabindex="-1" aria-labelledby="updateBarangMasukLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="barangMasukLabel">Edit Kategori Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo form_open_multipart('data/updateKategori/'); ?>
                                            <div class="modal-body">
                                                <input type="text" value="<?= $k['id_kategori'] ?>" name="id_kategori" hidden>
                                                <div class="form-group">
                                                    <label for="kategori">Nama Barang</label>
                                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $k['kategori']; ?>">
                                                </div>
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
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="barangMasuk" tabindex="-1" aria-labelledby="barangMasukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barangMasukLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('data/kategori'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori Barang</label>
                            <input type="text" class="form-control" id="kategori" name="kategori">
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