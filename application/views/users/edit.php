<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Edit User</h5>
            </div>
            <div class="card-body">
                <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                
                <?= form_open('users/edit/'.$user['id']) ?>
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= set_value('name', $user['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= set_value('username', $user['username']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('email', $user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" minlength="6">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <?php foreach($roles as $role): ?>
                            <option value="<?= $role['id'] ?>" <?= set_select('role_id', $role['id'], $role['id'] == $user['role_id']) ?>><?= html_escape($role['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" <?= $user['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Status Aktif</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('users') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
