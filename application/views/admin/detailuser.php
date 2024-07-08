<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-5">
                <img src="<?= base_url('assets/img/profile/') . $user_id['image']; ?>" alt="Profile" width="200px">
                <a href="<?= base_url('admin/datausers'); ?>" class="btn btn-secondary">Kembali</a>
                <a href="<?= base_url('admin/updateuser/') ?><?= $user_id['id']; ?>" class="btn btn-warning">Edit Data</a>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title text-dark"><?= $user_id['name']; ?></h5>
                    <p class="card-text text-dark"><?= $user_id['email']; ?></p>
                    <p class="card-text text-dark"><?= $user_id['phone_number']; ?></p>
                    <p class="card-text text-dark"><?= $user_id['address']; ?></p>
                    <p class="card-text text-dark"><?= $user_id['role']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user_id['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->