<div class="container-fluid">
    <h1 class="h4 text-gray-900 mb-4">Ubah Data User</h1>
    <div class="row">
        <div class="col-lg">
            <div class="p-2">
                <div class="text-center">
                </div>
                <form method="post" action="<?= base_url('admin/editrole'); ?>">
                    <input type="hidden" name="id" id="id" value="<?= $user_id['id']; ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= $user_id['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" value="<?= $user_id['name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" value="<?= $user_id['address']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nomor">Nomor Telepon</label>
                        <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Masukkan nomor" value="<?= $user_id['phone_number']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Status</label>
                        <select class="form-control" id="role_id" name="role_id">
                            <?php foreach ($role as $r) : ?>
                                <?php if ($r->id_role != 1) : ?>
                                    <option value="<?= $r->id_role ?>" <?= ($r->id_role == $user_id['role_id']) ? 'selected' : '' ?>><?= $r->role ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <a class="btn btn-secondary" href="<?= base_url('admin/datausers'); ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>

</div>