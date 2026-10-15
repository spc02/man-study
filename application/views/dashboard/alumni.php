<?php 
// Calculate completion logic
$profile_completion = ($alumni && !empty($alumni['nik']) && !empty($alumni['address'])) ? 100 : ($alumni ? 70 : 15);
$tracer_completion = $tracer ? 100 : 0;
$total_legalisir = count($legalisir);

$latest_legalisir_status = 'Belum Diajukan';
$legalisir_color = 'warning';
if ($total_legalisir > 0) {
    $latest_legalisir_status = ucwords($legalisir[0]['status']);
    if ($legalisir[0]['status'] == 'selesai') $legalisir_color = 'success';
    elseif ($legalisir[0]['status'] == 'ditolak') $legalisir_color = 'danger';
    else $legalisir_color = 'primary';
}
?>

<div class="row align-items-center mb-4">
    <div class="col-md-7">
        <h3 class="fw-bold mb-2">Dashboard Alumni</h3>
        <p class="text-muted mb-0">Selamat datang kembali, <strong><?= html_escape($current_user['name']) ?></strong> 👋</p>
        <p class="text-muted small">Lengkapi data diri, isi tracer study, dan ajukan legalisir dengan mudah.</p>
    </div>
    <div class="col-md-5 d-none d-md-block">
        <div class="bg-success bg-opacity-10 rounded-3 p-3 border border-success border-opacity-25 position-relative">
            <i class="bi bi-quote position-absolute top-0 start-0 text-success opacity-25 ms-2" style="font-size: 2rem; transform: translateY(-50%);"></i>
            <p class="mb-0 text-success-emphasis fw-medium small ps-4 pe-2" style="line-height: 1.6;">
                "Teruslah melangkah, jalin koneksi, dan berikan kontribusi terbaik untuk almamater."
            </p>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Profil Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0 shadow-sm border-0 transition-hover">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon-box badge-soft-success rounded-circle" style="width: 55px; height: 55px;">
                        <i class="bi bi-person-fill text-success fs-3"></i>
                    </div>
                    <div>
                        <p class="text-dark fw-bold mb-0" style="font-size: 0.85rem;">Kelengkapan Profil</p>
                        <h2 class="mb-0 fw-bold text-success"><?= $profile_completion ?>%</h2>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 8px; border-radius: 10px; background-color: #e2e8f0;">
                    <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: <?= $profile_completion ?>%"></div>
                </div>
                <p class="text-muted small mb-0">
                    <?= $profile_completion == 100 ? 'Profil Anda sudah lengkap.' : 'Lengkapi data diri Anda' ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Tracer Study Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0 shadow-sm border-0 transition-hover">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon-box badge-soft-primary rounded-circle" style="width: 55px; height: 55px;">
                        <i class="bi bi-clipboard2-check-fill text-primary fs-3"></i>
                    </div>
                    <div>
                        <p class="text-dark fw-bold mb-0" style="font-size: 0.85rem;">Tracer Study</p>
                        <h2 class="mb-0 fw-bold text-primary"><?= $tracer_completion ?>%</h2>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 8px; border-radius: 10px; background-color: #e2e8f0;">
                    <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: <?= $tracer_completion ?>%"></div>
                </div>
                <p class="text-muted small mb-0">
                    <?= $tracer_completion == 100 ? 'Terima kasih! Anda sudah mengisi tracer study.' : 'Silakan isi tracer study Anda.' ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Legalisir Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0 shadow-sm border-0 transition-hover">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon-box badge-soft-warning rounded-circle" style="width: 55px; height: 55px;">
                        <i class="bi bi-file-earmark-plus-fill text-warning fs-3"></i>
                    </div>
                    <div>
                        <p class="text-dark fw-bold mb-0" style="font-size: 0.85rem;">Legalisir</p>
                        <h5 class="mb-0 fw-bold text-<?= $legalisir_color ?> mt-1"><?= $latest_legalisir_status ?></h5>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <p class="text-muted small mb-0">Ajukan legalisir ijazah Anda secara online.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Legalisir Card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0 shadow-sm border-0 transition-hover">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon-box rounded-circle" style="width: 55px; height: 55px; background: #f3e8ff;">
                        <i class="bi bi-clock-history fs-3" style="color: #9333ea;"></i>
                    </div>
                    <div>
                        <p class="text-dark fw-bold mb-0" style="font-size: 0.85rem;">Riwayat Legalisir</p>
                        <h2 class="mb-0 fw-bold" style="color: #9333ea;"><?= $total_legalisir ?></h2>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <p class="text-muted small mb-0">
                        <?= $total_legalisir > 0 ? 'Anda memiliki ' . $total_legalisir . ' riwayat pengajuan.' : 'Anda belum memiliki riwayat legalisir.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3">Aksi Cepat</h5>
<div class="row g-3 mb-5">
    <div class="col-md-3">
        <a href="<?= site_url('alumni/profile') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 transition-hover">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 text-success p-2 rounded">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.85rem;">Lengkapi Profil</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Perbarui data diri Anda</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-dark fw-bold"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?= site_url('tracer') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 transition-hover">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded">
                            <i class="bi bi-clipboard2-check-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.85rem;">Isi Tracer Study</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Bagikan informasi terbaru</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-dark fw-bold"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?= site_url('legalisir/create') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 transition-hover">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 text-warning p-2 rounded">
                            <i class="bi bi-file-earmark-plus-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.85rem;">Ajukan Legalisir</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Ajukan legalisir secara online</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-dark fw-bold"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?= site_url('legalisir') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 transition-hover">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 rounded" style="background: #f3e8ff; color: #9333ea;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.85rem;">Riwayat Legalisir</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Lihat status dan riwayat pengajuan</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-dark fw-bold"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="card bg-success bg-opacity-10 border-0 shadow-none mt-4 rounded-4" style="background-color: #f0fdf4 !important;">
    <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-circle shadow-sm">
                <i class="bi bi-megaphone-fill text-success fs-3"></i>
            </div>
            <div>
                <h6 class="text-success fw-bold mb-1">Informasi</h6>
                <p class="mb-0 text-dark small" style="line-height: 1.6;">
                    Dukung almamater dengan mengisi tracer study secara berkala.<br>
                    Data Anda sangat berharga untuk pengembangan madrasah.
                </p>
            </div>
        </div>
        <a href="<?= site_url('tracer') ?>" class="btn btn-outline-success fw-bold bg-white px-4 py-2 rounded-3">Lihat Pengumuman <i class="bi bi-chevron-right ms-1"></i></a>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
</style>
