<div class="d-flex align-items-center mb-4">
    <a href="<?= site_url('tracer') ?>" class="btn btn-link text-dark p-0 me-3"><i class="bi bi-arrow-left fs-4"></i></a>
    <h3 class="fw-bold mb-0">Detail Tracer Study</h3>
</div>

<div class="row g-4">
    <!-- Info Profil Alumni -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4 sticky-top" style="top: 2rem;">
            <div class="card-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1"><?= html_escape($tracer['name']) ?></h5>
                <p class="text-muted small mb-3">NISN: <?= html_escape($tracer['nisn']) ?></p>
                
                <hr class="text-muted opacity-25">
                
                <div class="d-flex flex-column gap-2 text-start mt-3">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Tahun Lulus</span>
                        <span class="fw-semibold text-dark"><?= html_escape($tracer['graduation_year'] ?: '-') ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">NIK</span>
                        <span class="fw-semibold text-dark"><?= html_escape($tracer['nik'] ?: '-') ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Status Form</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1"><?= html_escape($tracer['status']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Tgl Submit</span>
                        <span class="fw-semibold text-dark"><?= date('d M Y H:i', strtotime($tracer['submitted_at'])) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Jawaban -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="bi bi-list-check fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Riwayat Jawaban</h4>
                        <p class="text-muted small mb-0">Berikut adalah data yang telah diisikan oleh alumni.</p>
                    </div>
                </div>
                <hr class="text-muted opacity-25">
            </div>
            
            <div class="card-body p-4">
                <?php foreach($grouped_questions as $cat => $questions): ?>
                    <?php 
                    $has_answer = false;
                    foreach($questions as $q) {
                        if (isset($existing_answers[$q['id']]) && $existing_answers[$q['id']] !== '') {
                            $has_answer = true;
                            break;
                        }
                    }
                    if ($has_answer): 
                    ?>
                    <div class="mb-4 bg-light p-4 rounded-4 border border-light-subtle">
                        <h6 class="text-success text-uppercase fw-bold mb-3 d-flex align-items-center" style="letter-spacing: 0.5px;">
                            <i class="bi bi-bookmarks-fill me-2 fs-5"></i> <?= html_escape($cat) ?>
                        </h6>
                        <div class="row g-4">
                            <?php foreach($questions as $q): ?>
                                <?php if(isset($existing_answers[$q['id']]) && $existing_answers[$q['id']] !== ''): ?>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-white rounded-3 shadow-sm h-100 border-start border-4 border-primary">
                                            <span class="text-muted d-block mb-1" style="font-size: 0.75rem; line-height: 1.4;"><?= html_escape($q['question']) ?></span>
                                            <strong class="text-dark d-block" style="font-size: 0.95rem;"><?= html_escape($existing_answers[$q['id']]) ?></strong>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <?php if(empty($existing_answers)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3 mb-0">Belum ada jawaban yang tersimpan untuk alumni ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
