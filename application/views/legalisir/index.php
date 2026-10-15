<?php if($current_user['role_slug']==='alumni'):?>
<div class="mb-3">
    <a class="btn btn-primary" href="<?=site_url('legalisir/create')?>"><i class="bi bi-plus-circle me-1"></i> Ajukan Legalisir Baru</a>
</div>
<?php endif;?>

<div class="card mb-4">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h5 class="mb-0">Daftar Pengajuan Legalisir</h5>
    </div>

    <!-- TABLE VIEW: Desktop -->
    <div class="card-body d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle datatable">
                <thead class="table-light">
                    <tr>
                        <th width="50">ID</th>
                        <th>Alumni</th>
                        <th>Jumlah Lbr</th>
                        <th>Status</th>
                        <th>Tgl Pengajuan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $x):?>
                    <tr>
                        <td>#<?= $x['id'] ?></td>
                        <td><?= html_escape($x['name']) ?></td>
                        <td><?= $x['quantity'] ?></td>
                        <td>
                            <?php if($x['status'] == 'completed'): ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php elseif($x['status'] == 'processing'): ?>
                                <span class="badge bg-warning text-dark">Diproses</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= $x['status'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y H:i', strtotime($x['created_at'])) ?></td>
                        <td class="text-center">
                            <?php if(in_array($current_user['role_slug'], array('super_admin','tu')) && $x['status'] !== 'completed'): ?>
                                <?php if($x['status'] === 'pending'): ?>
                                    <?= form_open('legalisir/status/'.$x['id'], ['class' => 'd-inline']) ?>
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" class="btn btn-sm btn-warning">Proses</button>
                                    <?= form_close() ?>
                                <?php endif; ?>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#completeModal<?= $x['id'] ?>">Selesai</button>
                                <!-- Modal Complete -->
                                <div class="modal fade text-start" id="completeModal<?= $x['id'] ?>" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog"><div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Selesaikan Legalisir #<?= $x['id'] ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <?= form_open_multipart('legalisir/status/'.$x['id']) ?>
                                    <input type="hidden" name="status" value="completed">
                                    <div class="modal-body">
                                      <div class="mb-3">
                                        <label class="form-label">Upload File Legalisir (PDF)</label>
                                        <input type="file" name="result_file" class="form-control" accept=".pdf" required>
                                        <small class="text-muted">File ini dapat diunduh alumni sebagai bukti.</small>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-success">Upload & Selesaikan</button>
                                    </div>
                                    <?= form_close() ?>
                                  </div></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($x['diploma_file'])): ?>
                                <a href="<?= site_url('download/legalisir/'.$x['diploma_file']) ?>" class="btn btn-sm btn-secondary" target="_blank"><i class="bi bi-file-pdf"></i> Ijazah</a>
                            <?php endif; ?>
                            <?php if($x['status'] === 'completed' && !empty($x['result_file'])): ?>
                                <a href="<?= site_url('download/legalisir/'.$x['result_file']) ?>" class="btn btn-sm btn-info text-white" target="_blank"><i class="bi bi-file-pdf-fill"></i> Lihat PDF</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CARD VIEW: Mobile -->
    <div class="d-block d-md-none">
        <?php if(empty($items)): ?>
            <p class="text-muted text-center py-4">Belum ada pengajuan legalisir.</p>
        <?php else: ?>
        <?php foreach($items as $x): ?>
        <div class="px-3 py-3 border-bottom">
            <!-- Header row: alumni name + status -->
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <div class="fw-bold" style="font-size:0.95rem;"><?= html_escape($x['name']) ?></div>
                    <div class="text-muted small">#<?= $x['id'] ?> &bull; <?= $x['quantity'] ?> lembar</div>
                </div>
                <?php if($x['status'] == 'completed'): ?>
                    <span class="badge bg-success">Selesai</span>
                <?php elseif($x['status'] == 'processing'): ?>
                    <span class="badge bg-warning text-dark">Diproses</span>
                <?php else: ?>
                    <span class="badge bg-secondary"><?= $x['status'] ?></span>
                <?php endif; ?>
            </div>
            <!-- Date -->
            <div class="text-muted small mb-2">
                <i class="bi bi-calendar me-1"></i><?= date('d M Y H:i', strtotime($x['created_at'])) ?>
            </div>
            <!-- Actions -->
            <?php $showActions = in_array($current_user['role_slug'], array('super_admin','tu')) && $x['status'] !== 'completed'; ?>
            <?php if($showActions || !empty($x['diploma_file']) || ($x['status'] === 'completed' && !empty($x['result_file']))): ?>
            <div class="d-flex flex-wrap gap-2 mt-2">
                <?php if($showActions): ?>
                    <?php if($x['status'] === 'pending'): ?>
                        <?= form_open('legalisir/status/'.$x['id'], ['class' => 'd-inline']) ?>
                            <input type="hidden" name="status" value="processing">
                            <button type="submit" class="btn btn-sm btn-warning">Proses</button>
                        <?= form_close() ?>
                    <?php endif; ?>
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#completeModal<?= $x['id'] ?>">Selesai</button>
                    <!-- Modal (reused) -->
                    <div class="modal fade text-start" id="completeModal<?= $x['id'] ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog"><div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Selesaikan #<?= $x['id'] ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <?= form_open_multipart('legalisir/status/'.$x['id']) ?>
                        <input type="hidden" name="status" value="completed">
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Upload File Legalisir (PDF)</label>
                            <input type="file" name="result_file" class="form-control" accept=".pdf" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Upload & Selesaikan</button>
                        </div>
                        <?= form_close() ?>
                      </div></div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($x['diploma_file'])): ?>
                    <a href="<?= site_url('download/legalisir/'.$x['diploma_file']) ?>" class="btn btn-sm btn-secondary" target="_blank"><i class="bi bi-file-pdf"></i> Ijazah</a>
                <?php endif; ?>
                <?php if($x['status'] === 'completed' && !empty($x['result_file'])): ?>
                    <a href="<?= site_url('download/legalisir/'.$x['result_file']) ?>" class="btn btn-sm btn-info text-white" target="_blank"><i class="bi bi-file-pdf-fill"></i> Lihat PDF</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

