<div class="card mb-4">
    <!-- Card Header -->
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h5 class="mb-0">Data Alumni</h5>
        <?php if(in_array($current_user['role_slug'], array('super_admin', 'tu'))): ?>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?=site_url('alumni/create')?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Data</a>
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload me-1"></i>Import CSV</button>
            <a href="<?=site_url('alumni/credentials')?>" target="_blank" class="btn btn-sm btn-info text-white"><i class="bi bi-printer me-1"></i>Cetak Akun</a>
        </div>
        <?php endif; ?>
    </div>

    <!-- TABLE VIEW: Desktop only -->
    <div class="card-body d-none d-md-block">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr><th>NISN</th><th>Nama</th><th>Jurusan</th><th>Tahun</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php foreach($items as $x):?>
                    <tr>
                        <td><?=html_escape($x['nisn'])?></td>
                        <td><?=html_escape($x['name'])?></td>
                        <td><?=html_escape($x['jurusan'])?></td>
                        <td><?=html_escape($x['tahun'])?></td>
                        <td>
                            <?php if($x['verification_status'] == 'verified'): ?>
                                <span class="badge bg-success">Terverifikasi</span>
                            <?php elseif($x['verification_status'] == 'pending'): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?=html_escape($x['verification_status'])?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(in_array($current_user['role_slug'],array('super_admin','tu'))&&$x['verification_status']==='pending'):?>
                                <?= form_open('alumni/verify/'.$x['id'], ['class' => 'd-inline']) ?>
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" class="btn btn-sm btn-success" data-confirm="Yakin ingin memverifikasi alumni ini?">Verifikasi</button>
                                <?= form_close() ?>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CARD VIEW: Mobile only -->
    <div class="d-block d-md-none">
        <?php if(empty($items)): ?>
            <p class="text-muted text-center py-4">Tidak ada data alumni.</p>
        <?php else: ?>
        <?php foreach($items as $x): ?>
        <div class="border-bottom px-3 py-3">
            <!-- Name & Status Row -->
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <div class="fw-bold text-dark" style="font-size:0.95rem;"><?=html_escape($x['name'])?></div>
                    <div class="text-muted small"><?=html_escape($x['nisn'])?></div>
                </div>
                <?php if($x['verification_status'] == 'verified'): ?>
                    <span class="badge bg-success">Terverifikasi</span>
                <?php elseif($x['verification_status'] == 'pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php else: ?>
                    <span class="badge bg-danger"><?=html_escape($x['verification_status'])?></span>
                <?php endif; ?>
            </div>
            <!-- Detail Row -->
            <div class="d-flex gap-3 text-muted small mb-2">
                <span><i class="bi bi-bookmark me-1"></i><?=html_escape($x['jurusan'])?></span>
                <span><i class="bi bi-calendar me-1"></i><?=html_escape($x['tahun'])?></span>
            </div>
            <!-- Action -->
            <?php if(in_array($current_user['role_slug'],array('super_admin','tu'))&&$x['verification_status']==='pending'):?>
            <div class="mt-1">
                <?= form_open('alumni/verify/'.$x['id'], ['class' => 'd-inline']) ?>
                    <input type="hidden" name="status" value="verified">
                    <button type="submit" class="btn btn-sm btn-success w-100" data-confirm="Yakin ingin memverifikasi alumni ini?">
                        <i class="bi bi-check-circle me-1"></i>Verifikasi
                    </button>
                <?= form_close() ?>
            </div>
            <?php endif;?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<?php if(in_array($current_user['role_slug'], array('super_admin', 'tu'))): ?>
<!-- Modal Import CSV -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Data Alumni (CSV)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open_multipart('alumni/import') ?>
      <div class="modal-body">
        <p>Gunakan file berformat CSV (Comma Separated Values) dengan struktur kolom baris pertama sebagai Header (judul). Kolom-kolomnya adalah:</p>
        <ol>
            <li>NISN</li>
            <li>Nama Lengkap</li>
            <li>ID Jurusan (Angka)</li>
            <li>ID Tahun Lulus (Angka)</li>
        </ol>
        <div class="mb-3">
            <label class="form-label">Pilih File CSV</label>
            <input type="file" name="file" class="form-control" accept=".csv" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Mulai Import</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<?php endif; ?>
