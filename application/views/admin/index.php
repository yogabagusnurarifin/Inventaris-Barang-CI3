<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Barang Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                if (!empty($barang_masuk)) { ?>
                                    <?php foreach ($barang_masuk as $bm) { ?>
                                        <?= $bm->jumlah_masuk ?? 0; ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    0
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('barang/barangmasuk'); ?>"><i class="fas fa-plus-square fa-2x text-gray-300"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Barang Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if (!empty($barang_keluar)) { ?>
                                    <?php foreach ($barang_keluar as $bk) { ?>
                                        <?= $bk->jumlah_keluar ?? 0; ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    0
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('barang/barangkeluar'); ?>"><i class="fas fa-minus-square fa-2x text-gray-300"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Stok Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $bm->jumlah_masuk - $bk->jumlah_keluar ?? 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('barang'); ?>"><i class="fas fa-box fa-2x text-gray-300"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php if (!empty($users)) : ?>
                                    <?= $users ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin/datausers'); ?>"><i class="fas fa-users fa-2x text-gray-300"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->