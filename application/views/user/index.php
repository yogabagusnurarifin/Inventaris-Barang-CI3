<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card col-lg card border-top-primary shadow h-100 py-2">
        <!-- <div class="row m-3">
            <div class="col-lg">
                <h3><?= $user['name']; ?></h3>
            </div>
        </div> -->
        <div class="row mt-4">
            <div class="col-lg-4 mb-5">
                <div class="justify-content-center text-center mt-5">
                    <img width="250px" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile">
                </div>
            </div>
            <div class="col-lg-8">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a data-toggle="tab" aria-expanded="false" class="nav-link active" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" aria-expanded="false" class="nav-link" href="#edit">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" aria-expanded="false" class="nav-link" href="#gantiPassword">Ganti Password</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="profile">
                        <table class="table table-borderless">
                            <tbody class="text-dark">
                                <tr>
                                    <td>
                                        <h4>Nama</h4>
                                    </td>
                                    <td>
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><?= $user['name']; ?></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Alamat</h4>
                                    </td>
                                    <td>
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><?= $user['address']; ?></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Nomor Telepon</h4>
                                    </td>
                                    <td>
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><?= $user['phone_number']; ?></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Email</h4>
                                    </td>
                                    <td>
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><?= $user['email']; ?></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="edit">
                        <!-- <form class="form" action="<?= base_url('user/edit'); ?>" method="post" id="showProfile"> -->
                        <?php echo form_open_multipart('user/edit'); ?>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $user['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor Telepon</label>
                            <input type="number" class="form-control" id="nomor" name="nomor" value="<?= $user['phone_number']; ?>">
                        </div>
                        <div class="form-group">
                            <!-- <label for="email">Email</label> -->
                            <input type="hidden" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Upload Foto</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="gantiPassword">
                        <form action="<?= base_url('user/changepassword') ?>" method="post">
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password1">Password Baru</label>
                                <input type="password" class="form-control" id="new_password1" name="new_password1">
                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password2">Ulangi Password</label>
                                <input type="password" class="form-control" id="new_password2" name="new_password2">
                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ganti Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->