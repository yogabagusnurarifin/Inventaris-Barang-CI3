<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <?php echo form_open_multipart('barang/updatebarang'); ?>
                    <!-- <form action="<?= base_url('barang/updatebarang'); ?>" method="post"> -->
                    <div class="form-group row">
                        <label for="idBarang" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="idBarang" name="idBarang" value="<?= $barang['id_barang']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $barang['nama_barang']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga Barang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RP.</div>
                                </div>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <a href="<?= base_url('barang'); ?>" class="btn btn-secondary">Cencel</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->