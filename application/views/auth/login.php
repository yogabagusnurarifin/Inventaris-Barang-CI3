<div class="wrapper">
    <!-- Header Start -->
    <div class="header home">
        <div class="container-fluid">
            <div class="header-top row align-items-center">
                <div class="col-lg-2">
                    <div class="brand">
                        <a href="<?= base_url('auth') ?>">
                            <img class="img-fluid rounded mx-auto d-block" src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="brand">
                        <h2 class="text-white"><b>
                                <span class="text-warning">Dinas Sosial</span>
                                <br>Kabupaten Madiun</b></h2>
                    </div>
                    <div>
                        <h6 class="text-white">Jl. Raya Dungus KM 4, Mojopurno, Madiun, Kode Pos 63181</h6>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="topbar">
                        <div class="topbar-col">
                            <a href="tel:+0351 495359"><i class="fa fa-phone-alt"></i>0351-495359</a>
                        </div>
                        <div class="topbar-col">
                            <a href="mailto:info@example.com"><i class="fa fa-envelope"></i>@madiunkab.go.id</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero row align-items-center">
                <div class="col-md-7 text-center">
                    <h2>Aplikasi</h2>
                    <h2><span>Inventaris</span> Barang</h2>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <h3>Silakan Login</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                            <input class="form-control" type="text" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            <button class=" btn btn-block" type="submit">Login</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small text-white" href="<?= base_url('auth/registration') ?>">Register!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

</div>