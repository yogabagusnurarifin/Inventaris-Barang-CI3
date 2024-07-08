<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">   
                <?php echo form_open_multipart('barang/updatebarangmasuk'); ?> 
                <!-- <form action="<?= base_url('barang/updatebarangkeluar'); ?>" method="post"> -->
                <div class="form-group row">
                    <label for="idBarang" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="idBarang" name="idBarang" value="<?= $barang['id_barang']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaBarang" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $barang['nama_barang']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlahMasuk" class="col-sm-2 col-form-label">Jumlah Masuk</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="jumlahKeluar" name="jumlahKeluar" value="<?= $barang['jumlah_keluar']; ?>">
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <a href="<?= base_url('barang/barangkeluar'); ?>" class="btn btn-secondary">Cencel</a>
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