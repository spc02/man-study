<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Tambah <?= html_escape($title) ?></h5>
            </div>
            <div class="card-body">
                <?= form_open('master/index/'.$key) ?>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan teks di sini..." required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Daftar <?= html_escape($title) ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($items)): ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data.</td>
                            </tr>
                            <?php else: ?>
                                <?php $i = 1; foreach($items as $x): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= html_escape($x['name']) ?></td>
                                    <td class="text-center">
                                        <?= form_open('master/delete/'.$key.'/'.$x['id'], ['class' => 'd-inline']) ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm="Apakah Anda yakin ingin menghapus data ini?">Hapus</button>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
