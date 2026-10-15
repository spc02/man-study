<?php if($current_user['role_slug']!=='alumni'):?>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h4 class="fw-bold mb-0">Data Tracer Study</h4>
            <p class="text-muted small mb-0">Kelola dan ekspor data tracer study alumni.</p>
        </div>
        <a href="<?= site_url('tracer/export_excel') ?>" class="btn btn-success px-4 py-2 fw-semibold shadow-sm">
            <i class="bi bi-file-earmark-excel me-2"></i> Download Excel
        </a>
    </div>
    <hr class="text-muted opacity-25 mx-4">
    <div class="card-body px-4 pb-4">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Alumni</th>
                    <th>Status</th>
                    <th>Tanggal Isi</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $x):?>
                <tr>
                    <td class="align-middle"><?=$x['name']?></td>
                    <td class="align-middle"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1"><?= html_escape($x['status']) ?></span></td>
                    <td class="align-middle"><?=$x['submitted_at']?></td>
                    <td class="text-end">
                        <a href="<?= site_url('tracer/detail/'.$x['id']) ?>" class="btn btn-sm btn-outline-info rounded-pill px-3">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php endif;?>
