<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Tambah Data Alumni</h5>
            </div>
            <div class="card-body">
                <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                
                <?= form_open('alumni/create') ?>
                
                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="<?= set_value('nisn') ?>" required>
                    <small class="text-muted">NISN akan otomatis digunakan sebagai Username dan Password default untuk akun alumni.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan_id" class="form-select" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <?php foreach($jurusan as $j): ?>
                            <option value="<?= $j['id'] ?>" <?= set_select('jurusan_id', $j['id']) ?>><?= html_escape($j['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Lulus</label>
                    <select name="tahun_lulus_id" class="form-select" required>
                        <option value="">-- Pilih Tahun Lulus --</option>
                        <?php foreach($tahun as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= set_select('tahun_lulus_id', $t['id']) ?>><?= html_escape($t['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('alumni') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Alumni</button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
