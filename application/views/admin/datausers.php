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
    <h1 class="h3 mb-4 text-gray-800">Data Users</h1>

    <div class="card border-top-primary shadow h-100 py-2">
        <div class="card-body pb-0">
            <a href="<?= base_url('admin/insertuser'); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-hover table-responsive-lg text-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($alluser as $u) : ?>
                        <?php if ($u['role_id'] != 1) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $u['name']; ?></td>
                                <td><?= $u['email']; ?></td>
                                <td><?= $u['role']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') ?><?= $u['id']; ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="<?= base_url('admin/updateuser/') ?><?= $u['id']; ?>" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/deleteUser/') ?><?= $u['id']; ?>" class="btn btn-danger btn-circle btn-sm tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                                    <?php if ($u['is_active'] == 1) : ?>
                                        <a href="<?= base_url('admin/nonaktifUser/') . $u['id'] . '/0'; ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fas fa-power-off"></i></a>
                                    <?php else : ?>
                                        <a href="<?= base_url('admin/nonaktifUser/') . $u['id'] . '/1'; ?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-power-off"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->