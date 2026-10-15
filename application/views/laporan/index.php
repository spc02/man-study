<?php
// Helper for tracer status color
function statusBadge($status) {
    $map = [
        'Kuliah'    => 'primary',
        'Bekerja'   => 'success',
        'Wirausaha' => 'warning',
        'pending'   => 'secondary',
        ''          => 'light',
    ];
    $color = isset($map[$status]) ? $map[$status] : 'secondary';
    $label = $status ?: '-';
    return "<span class=\"badge bg-{$color}\">{$label}</span>";
}
?>

<!-- Filter bar -->
<div class="card mb-3">
    <div class="card-body py-3 px-3">
        <?= form_open('laporan', 'get') ?>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <div class="input-group input-group-sm flex-grow-1" style="max-width:200px;">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-funnel text-muted"></i></span>
                <select name="tahun" class="form-select border-start-0" style="border-radius:0 6px 6px 0;">
                    <option value="">Semua Tahun</option>
                    <?php foreach($years as $y): ?>
                    <option value="<?= $y['id'] ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $y['id']) ? 'selected' : '' ?>><?= $y['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary btn-sm px-3" type="submit">
                <i class="bi bi-funnel-fill me-1"></i>Filter
            </button>
            <button onclick="window.print()" type="button" class="btn btn-outline-secondary btn-sm px-3">
                <i class="bi bi-printer me-1"></i>Cetak
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>

<!-- TABLE VIEW: Desktop -->
<div class="card d-none d-md-block">
    <div class="card-header"><h5 class="mb-0">Laporan Alumni</h5></div>
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>NISN</th><th>Nama</th><th>Jurusan</th><th>Tahun</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $x): ?>
                <tr>
                    <td><?= html_escape($x['nisn']) ?></td>
                    <td><?= html_escape($x['name']) ?></td>
                    <td><?= html_escape($x['jurusan']) ?></td>
                    <td><?= html_escape($x['tahun']) ?></td>
                    <td><?= html_escape($x['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CARD LIST VIEW: Mobile -->
<div class="card d-block d-md-none">
    <div class="card-header py-3">
        <h6 class="mb-0 fw-bold">Laporan Alumni</h6>
        <small class="text-muted"><?= count($items) ?> data ditemukan</small>
    </div>

    <!-- Search & show controls -->
    <div class="px-3 pt-3 pb-2 border-bottom">
        <div id="mobileSearch" class="input-group input-group-sm">
            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-start-0" id="mobileSearchInput" placeholder="Cari: kata kunci pencarian" oninput="filterMobileList(this.value)">
        </div>
    </div>
    <div class="px-3 py-2 border-bottom d-flex align-items-center gap-2">
        <small class="text-muted">Tampilkan</small>
        <select class="form-select form-select-sm w-auto" id="mobilePageSize" onchange="renderMobileList()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <small class="text-muted">entri</small>
    </div>

    <!-- List items -->
    <div id="mobileListContainer"></div>

    <!-- Pagination info & controls -->
    <div class="px-3 py-2 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
        <small class="text-muted" id="mobilePagingInfo"></small>
        <div class="d-flex gap-1 flex-wrap" id="mobilePagingBtns"></div>
    </div>
</div>

<script>
// Raw data from PHP
var mobileData = <?= json_encode(array_values($items)) ?>;
var mobileFiltered = mobileData.slice();
var mobilePage = 1;

function statusLabel(status) {
    var map = {'Kuliah':'primary','Bekerja':'success','Wirausaha':'warning'};
    var color = map[status] || 'secondary';
    var label = status || '-';
    return '<span class="badge bg-' + color + '">' + label + '</span>';
}

function filterMobileList(q) {
    q = q.toLowerCase();
    mobileFiltered = mobileData.filter(function(x) {
        return (x.nisn||'').toLowerCase().includes(q)
            || (x.name||'').toLowerCase().includes(q)
            || (x.jurusan||'').toLowerCase().includes(q)
            || (x.tahun||'').toLowerCase().includes(q)
            || (x.status||'').toLowerCase().includes(q);
    });
    mobilePage = 1;
    renderMobileList();
}

function renderMobileList() {
    var pageSize = parseInt(document.getElementById('mobilePageSize').value) || 10;
    var totalPages = Math.max(1, Math.ceil(mobileFiltered.length / pageSize));
    if (mobilePage > totalPages) mobilePage = totalPages;
    var start = (mobilePage - 1) * pageSize;
    var end = Math.min(start + pageSize, mobileFiltered.length);
    var slice = mobileFiltered.slice(start, end);

    var html = '';
    if (slice.length === 0) {
        html = '<p class="text-muted text-center py-4 mb-0">Tidak ada data.</p>';
    } else {
        slice.forEach(function(x, i) {
            var num = start + i + 1;
            html += '<div class="d-flex align-items-center px-3 py-3 border-bottom">'
                + '<div class="text-muted fw-bold me-3" style="min-width:24px;font-size:0.85rem;">' + num + '</div>'
                + '<div class="flex-grow-1">'
                +   '<div class="fw-bold" style="font-size:0.92rem;">' + (x.name||'') + '</div>'
                +   '<div class="text-muted small">NISN ' + (x.nisn||'-') + '</div>'
                + '</div>'
                + '<div class="text-end ms-2">'
                +   '<div class="small text-muted mb-1"><i class="bi bi-mortarboard me-1"></i>' + (x.jurusan||'-') + '</div>'
                +   '<div class="small text-muted mb-1"><i class="bi bi-calendar me-1"></i>' + (x.tahun||'-') + '</div>'
                +   statusLabel(x.status)
                + '</div>'
                + '</div>';
        });
    }
    document.getElementById('mobileListContainer').innerHTML = html;

    // Paging info
    document.getElementById('mobilePagingInfo').textContent =
        mobileFiltered.length > 0
        ? 'Menampilkan ' + (start+1) + ' sampai ' + end + ' dari ' + mobileFiltered.length + ' entri'
        : 'Tidak ada entri';

    // Paging buttons
    var btns = '';
    if (totalPages > 1) {
        btns += '<button class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="goPage(1)" ' + (mobilePage==1?'disabled':'') + '>Pertama</button>';
        btns += '<button class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="goPage(' + (mobilePage-1) + ')" ' + (mobilePage==1?'disabled':'') + '>Sebelumnya</button>';
        var lo = Math.max(1, mobilePage-1), hi = Math.min(totalPages, lo+2);
        for (var p = lo; p <= hi; p++) {
            btns += '<button class="btn btn-sm ' + (p==mobilePage?'btn-primary':'btn-outline-secondary') + ' px-2 py-1" onclick="goPage(' + p + ')">' + p + '</button>';
        }
        btns += '<button class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="goPage(' + (mobilePage+1) + ')" ' + (mobilePage==totalPages?'disabled':'') + '>Selanjutnya</button>';
        btns += '<button class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="goPage(' + totalPages + ')" ' + (mobilePage==totalPages?'disabled':'') + '>Terakhir</button>';
    }
    document.getElementById('mobilePagingBtns').innerHTML = btns;
}

function goPage(p) {
    var pageSize = parseInt(document.getElementById('mobilePageSize').value) || 10;
    var totalPages = Math.max(1, Math.ceil(mobileFiltered.length / pageSize));
    mobilePage = Math.max(1, Math.min(p, totalPages));
    renderMobileList();
}

// Initialize
renderMobileList();
</script>

