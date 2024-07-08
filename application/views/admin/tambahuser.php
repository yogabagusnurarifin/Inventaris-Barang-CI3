<div class="container-fluid">
    <h1 class="h4 text-gray-900 mb-4">Tambah Data User</h1>
    <div class="card">
        <div class="row">
            <div class="col-lg">
                <div class="p-2">
                    <div class="text-center">
                    </div>
                    <form method="post" action="<?= base_url('admin/insertuser'); ?>">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor Telepon</label>
                            <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Masukkan nomor">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="row">
                                <div class="col">
                                    <input type="password" class="form-control" name="password1" placeholder="Masukkan Password">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="password2" placeholder="Masukkan Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Status</label>
                            <select class="form-control" id="role_id" name="role_id">
                                <option>Pilih Status</option>
                                <option value="1">Admin</option>
                                <option value="2">Petugas</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                        <a class="btn btn-secondary" href="<?= base_url('admin/datausers'); ?>">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>