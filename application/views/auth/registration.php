<div class="wrapper">
    <!-- Header Start -->
    <div class="header home">
        <div class="container-fluid">
            <div class="hero row align-items-center justify-content-md-center">
                <div class="col-lg-8">
                    <div class="form">
                        <h3 class="text-center mb-3">Registrasi</h3>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Masukkan Alamat...." value="<?= set_value('address'); ?>">
                                <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nomor" name="nomor" placeholder="Nomor Telepon" value="<?= set_value('nomor'); ?>">
                                <?= form_error('nomor', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-user btn-block">
                                Daftar akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <!-- <a class="small text-white" href="<?= base_url('auth') ?>">Lupa kata sandi?</a> -->
                        </div>
                        <div class="text-center">
                            <a class="small text-white" href="<?= base_url('auth') ?>">Sudah memiliki akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

</div>