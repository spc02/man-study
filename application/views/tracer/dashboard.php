<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Dashboard Analitik Tracer Study</h2>
        <p class="text-muted">Wawasan dan metrik berdasarkan respons alumni</p>
    </div>
</div>

<ul class="nav nav-pills mb-4" id="dashboardTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pendidikan-tab" data-bs-toggle="pill" data-bs-target="#pendidikan" type="button" role="tab" aria-selected="true"><i class="bi bi-book"></i> Pendidikan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pekerjaan-tab" data-bs-toggle="pill" data-bs-target="#pekerjaan" type="button" role="tab" aria-selected="false"><i class="bi bi-briefcase"></i> Pekerjaan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="wirausaha-tab" data-bs-toggle="pill" data-bs-target="#wirausaha" type="button" role="tab" aria-selected="false"><i class="bi bi-shop"></i> Wirausaha</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="evaluasi-tab" data-bs-toggle="pill" data-bs-target="#evaluasi" type="button" role="tab" aria-selected="false"><i class="bi bi-star"></i> Evaluasi Sekolah</button>
  </li>
</ul>

<div class="tab-content" id="dashboardTabsContent">
  <!-- Pendidikan Tab -->
  <div class="tab-pane fade show active" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Jenis Perguruan Tinggi</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartUniType"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Jalur Masuk PTN</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartUniPathPtn"></canvas></div>
            </div>
        </div>
    </div>
  </div>

  <!-- Pekerjaan Tab -->
  <div class="tab-pane fade" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Bidang Industri</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobIndustry"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Rentang Gaji Pertama</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobSalary"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Waktu Tunggu Mendapat Kerja</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobWaitTime"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Kesesuaian dengan Jurusan</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartJobRelevance"></canvas></div>
            </div>
        </div>
    </div>
  </div>

  <!-- Wirausaha Tab -->
  <div class="tab-pane fade" id="wirausaha" role="tabpanel" aria-labelledby="wirausaha-tab">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Bidang Usaha</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartBizField"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Omzet per Bulan</h5></div>
                <div class="card-body" style="position: relative; height: 350px; width: 100%;"><canvas id="chartBizTurnover"></canvas></div>
            </div>
        </div>
    </div>
  </div>

  <!-- Evaluasi Tab -->
  <div class="tab-pane fade" id="evaluasi" role="tabpanel" aria-labelledby="evaluasi-tab">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white"><h5 class="mb-0">Indeks Kepuasan & Evaluasi (Skala 1-5)</h5></div>
        <div class="card-body" style="position: relative; height: 450px; width: 100%;">
            <canvas id="chartEvaluasi"></canvas>
        </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const colors = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6610f2', '#fd7e14', '#20c997'];
    
    function createChart(ctxId, type, dataObj, label) {
        if (!dataObj || Object.keys(dataObj).length === 0) return;
        new Chart(document.getElementById(ctxId), {
            type: type,
            data: {
                labels: Object.keys(dataObj),
                datasets: [{
                    label: label,
                    data: Object.values(dataObj),
                    backgroundColor: type === 'pie' || type === 'doughnut' ? colors : colors[0],
                    borderWidth: 1
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

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
    new Chart(document.getElementById('chartEvaluasi'), {
        type: 'radar',
        data: {
            labels: ['Relevansi Materi', 'Kualitas Guru', 'Fasilitas', 'Administrasi', 'Persiapan Kerja', 'Kepuasan Alumni'],
            datasets: [{
                label: 'Rata-rata Nilai (1-5)',
                data: [
                    <?= $eval_relevance ?>, <?= $eval_teacher ?>, <?= $eval_facility ?>,
                    <?= $eval_admin ?>, <?= $eval_prep ?>, <?= $eval_satisfaction ?>
                ],
                backgroundColor: 'rgba(13, 110, 253, 0.2)',
                borderColor: 'rgba(13, 110, 253, 1)',
                pointBackgroundColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { r: { min: 0, max: 5 } }
        }
    });
});
</script>
