<div class="row align-items-center mb-4">
    <div class="col-md-7">
        <h3 class="fw-bold mb-2">Dashboard Admin</h3>
        <p class="text-muted mb-0">Selamat datang kembali, <strong><?= html_escape($current_user['name']) ?></strong> 👋</p>
        <p class="text-muted small">Pantau semua data sistem dan analitik Tracer Study dalam satu tempat.</p>
    </div>
    <div class="col-md-5 d-none d-md-block">
        <div class="bg-success bg-opacity-10 rounded-3 p-3 border border-success border-opacity-25 position-relative">
            <i class="bi bi-quote position-absolute top-0 start-0 text-success opacity-25 ms-2" style="font-size: 2rem; transform: translateY(-50%);"></i>
            <p class="mb-0 text-success-emphasis fst-italic small ps-3">
                "Pendidikan adalah senjata paling ampuh yang bisa kamu gunakan untuk mengubah dunia."
            </p>
        </div>
    </div>
</div>

<!-- Statistik Umum -->
<div class="row g-4 mb-4">
    <?php 
    $icons = [
        'total_alumni' => ['icon' => 'bi-people-fill', 'color' => 'primary', 'bg' => 'badge-soft-primary'],
        'total_tracer' => ['icon' => 'bi-clipboard-data-fill', 'color' => 'success', 'bg' => 'badge-soft-success'],
        'total_legalisir' => ['icon' => 'bi-file-earmark-check-fill', 'color' => 'warning', 'bg' => 'badge-soft-warning'],
        'total_pengguna' => ['icon' => 'bi-person-badge-fill', 'color' => 'danger', 'bg' => 'badge-soft-danger']
    ];
    $default_icon = ['icon' => 'bi-bar-chart-fill', 'color' => 'primary', 'bg' => 'badge-soft-primary'];
    
    foreach($stats as $k => $v): 
        $icon_data = isset($icons[$k]) ? $icons[$k] : $default_icon;
        $title_label = ucwords(str_replace('_', ' ', $k));
    ?>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 mb-0 shadow-sm transition-hover">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-box <?= $icon_data['bg'] ?>">
                    <i class="bi <?= $icon_data['icon'] ?> text-<?= $icon_data['color'] ?>"></i>
                </div>
                <div>
                    <p class="text-muted small fw-semibold mb-1"><?= $title_label ?></p>
                    <h3 class="mb-0 fw-bold text-dark"><?= $v ?></h3>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>



<!-- ============================================== -->
<!-- ANALITIK TRACER STUDY (Merged)                -->
<!-- ============================================== -->
<hr class="text-muted opacity-25 mb-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Analitik Tracer Study</h4>
        <p class="text-muted small mb-0">Wawasan dan metrik berdasarkan respons alumni yang telah mengisi kuesioner.</p>
    </div>
</div>

<ul class="nav nav-pills mb-4 bg-white p-2 rounded-4 shadow-sm" id="dashboardTabs" role="tablist">
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100 active rounded-3" id="umum-tab" data-bs-toggle="pill" data-bs-target="#umum" type="button" role="tab" aria-selected="true"><i class="bi bi-pie-chart-fill me-2"></i> Umum</button>
    </li>
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100 rounded-3" id="pendidikan-tab" data-bs-toggle="pill" data-bs-target="#pendidikan" type="button" role="tab" aria-selected="false"><i class="bi bi-book-fill me-2"></i> Pendidikan</button>
    </li>
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100 rounded-3" id="pekerjaan-tab" data-bs-toggle="pill" data-bs-target="#pekerjaan" type="button" role="tab" aria-selected="false"><i class="bi bi-briefcase-fill me-2"></i> Pekerjaan</button>
    </li>
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100 rounded-3" id="wirausaha-tab" data-bs-toggle="pill" data-bs-target="#wirausaha" type="button" role="tab" aria-selected="false"><i class="bi bi-shop me-2"></i> Wirausaha</button>
    </li>
    <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100 rounded-3" id="evaluasi-tab" data-bs-toggle="pill" data-bs-target="#evaluasi" type="button" role="tab" aria-selected="false"><i class="bi bi-star-fill me-2"></i> Evaluasi</button>
    </li>
</ul>

<div class="tab-content" id="dashboardTabsContent">
    
    <!-- Tab Umum (Original Dashboard Analytics) -->
    <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h6 class="fw-bold mb-0 text-dark">Lulusan per Tahun</h6>
                    </div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;">
                        <canvas id="years"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h6 class="fw-bold mb-0 text-dark">Persentase Status Aktivitas</h6>
                    </div>
                    <div class="card-body p-4 d-flex justify-content-center align-items-center" style="position: relative; height: 350px; width: 100%;">
                        <canvas id="status"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Pendidikan -->
    <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Jenis Perguruan Tinggi</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartUniType"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Jalur Masuk PTN</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartUniPathPtn"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Pekerjaan -->
    <div class="tab-pane fade" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Bidang Industri</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobIndustry"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Rentang Gaji Pertama</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobSalary"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Waktu Tunggu Mendapat Kerja</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobWaitTime"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Kesesuaian dengan Jurusan</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobRelevance"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Wirausaha -->
    <div class="tab-pane fade" id="wirausaha" role="tabpanel" aria-labelledby="wirausaha-tab">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Bidang Usaha</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartBizField"></canvas></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Omzet per Bulan</h6></div>
                    <div class="card-body p-4" style="position: relative; height: 350px; width: 100%;"><canvas id="chartBizTurnover"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Evaluasi -->
    <div class="tab-pane fade" id="evaluasi" role="tabpanel" aria-labelledby="evaluasi-tab">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h6 class="fw-bold mb-0 text-dark">Indeks Kepuasan & Evaluasi (Skala 1-5)</h6></div>
            <div class="card-body p-4 d-flex justify-content-center" style="position: relative; height: 450px; width: 100%;">
                <canvas id="chartEvaluasi"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
    .nav-pills .nav-link {
        color: #64748b;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active {
        background-color: #198754;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 4px 6px -1px rgba(25, 135, 84, 0.2);
    }
    .nav-pills .nav-link:not(.active):hover {
        background-color: #f1f5f9;
        color: #198754;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Global Chart Configuration
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b';
    Chart.defaults.scale.grid.color = '#f1f5f9';
    
    // Gradient for Bar Charts
    const getGradient = (ctx, colorStart, colorEnd) => {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, colorStart);
        gradient.addColorStop(1, colorEnd);
        return gradient;
    };

    const colors = ['#198754', '#0d6efd', '#ffc107', '#dc3545', '#0dcaf0', '#6610f2', '#fd7e14', '#20c997'];
    
    function createChart(ctxId, type, dataObj, label) {
        if (!dataObj || Object.keys(dataObj).length === 0) return;
        const ctx = document.getElementById(ctxId).getContext('2d');
        
        let bgColors = colors;
        if (type === 'bar') {
            bgColors = getGradient(ctx, '#198754', 'rgba(25, 135, 84, 0.2)');
        }

        new Chart(ctx, {
            type: type,
            data: {
                labels: Object.keys(dataObj),
                datasets: [{
                    label: label,
                    data: Object.values(dataObj),
                    backgroundColor: type === 'pie' || type === 'doughnut' ? colors : bgColors,
                    borderWidth: 0,
                    borderRadius: type === 'bar' ? 6 : 0,
                    barThickness: type === 'bar' ? 24 : undefined
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: type === 'pie' || type === 'doughnut',
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20 }
                    }
                },
                scales: type === 'bar' ? {
                    y: { beginAtZero: true, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                } : {}
            }
        });
    }

    // Tab Umum
    const ctxYears = document.getElementById('years').getContext('2d');
    new Chart(ctxYears, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($years, 'label')) ?>,
            datasets: [{
                label: 'Jumlah Alumni',
                data: <?= json_encode(array_column($years, 'total')) ?>,
                backgroundColor: getGradient(ctxYears, '#0d6efd', 'rgba(13, 110, 253, 0.2)'),
                borderRadius: 6,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, border: { display: false } },
                x: { grid: { display: false }, border: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('status').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($status, 'label')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($status, 'total')) ?>,
                backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#dc3545', '#6f42c1'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, boxWidth: 8 } }
            }
        }
    });

    // Pendidikan
    createChart('chartUniType', 'pie', <?= json_encode($uni_type) ?>, 'Jumlah Alumni');
    createChart('chartUniPathPtn', 'bar', <?= json_encode($uni_path_ptn) ?>, 'Jumlah Alumni');

    // Pekerjaan
    createChart('chartJobIndustry', 'doughnut', <?= json_encode($job_industry) ?>, 'Jumlah Alumni');
    createChart('chartJobSalary', 'bar', <?= json_encode($job_salary) ?>, 'Jumlah Alumni');
    createChart('chartJobWaitTime', 'pie', <?= json_encode($job_wait_time) ?>, 'Jumlah Alumni');
    createChart('chartJobRelevance', 'bar', <?= json_encode($job_relevance) ?>, 'Jumlah Alumni');

    // Wirausaha
    createChart('chartBizField', 'pie', <?= json_encode($biz_field) ?>, 'Jumlah Alumni');
    createChart('chartBizTurnover', 'bar', <?= json_encode($biz_turnover) ?>, 'Jumlah Alumni');

    // Evaluasi (Radar Chart)
    new Chart(document.getElementById('chartEvaluasi').getContext('2d'), {
        type: 'radar',
        data: {
            labels: ['Relevansi Materi', 'Kualitas Guru', 'Fasilitas', 'Administrasi', 'Persiapan Kerja', 'Kepuasan Alumni'],
            datasets: [{
                label: 'Rata-rata Nilai (1-5)',
                data: [
                    <?= $eval_relevance ?>, <?= $eval_teacher ?>, <?= $eval_facility ?>,
                    <?= $eval_admin ?>, <?= $eval_prep ?>, <?= $eval_satisfaction ?>
                ],
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                pointBackgroundColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { r: { min: 0, max: 5 } },
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
