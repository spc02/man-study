<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar User</h5>
        <a href="<?=site_url('users/create')?>" class="btn btn-sm btn-primary">Tambah User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data user.</td>
                    </tr>
                    <?php else: ?>
                    <?php $i = 1; foreach($users as $user): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= html_escape($user['username']); ?></td>
                        <td><?= html_escape($user['name']); ?></td>
                        <td><?= html_escape($user['email']); ?></td>
                        <td><span class="badge bg-secondary"><?= html_escape($user['role_name']); ?></span></td>
                        <td>
                            <?php if($user['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= site_url('users/edit/'.$user['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <?php if($user['id'] !== $current_user['id']): ?>
                                <a href="<?= site_url('users/delete/'.$user['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
