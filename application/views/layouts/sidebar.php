<aside class="col-md-3 col-lg-2 sidebar p-0 offcanvas-md offcanvas-start" tabindex="-1" id="mainSidebar" aria-labelledby="mainSidebarLabel" style="background-color: var(--sidebar-bg) !important;" data-bs-theme="dark">
    <div class="offcanvas-header d-md-none border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
        <div class="brand p-0 mb-0 d-flex align-items-center gap-2 w-100">
            <i class="bi bi-mortarboard-fill brand-icon fs-3"></i>
            <div class="brand-text text-white fw-bold">
                MAN 1 MAGELANG
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#mainSidebar" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body flex-column p-0">
        <div class="brand d-none d-md-flex">
            <i class="bi bi-mortarboard-fill brand-icon"></i>
            <div class="brand-text">
                MAN 1 MAGELANG
                <small class="d-block">Alumni & Tracer Study</small>
            </div>
        </div>

        <nav class="nav flex-column mt-3 w-100">
            <?php $r = $current_user['role_slug']; ?>
            
            <p class="nav-section-title">Menu Utama</p>
            <a class="nav-link" href="<?=site_url('dashboard')?>">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>

            <?php if($r !== 'alumni'): ?>
                <a class="nav-link" href="<?=site_url('alumni')?>"><i class="bi bi-people-fill"></i> Data Alumni</a>
                <a class="nav-link" href="<?=site_url('tracer')?>"><i class="bi bi-clipboard-data-fill"></i> Data Tracer Study</a>
                <a class="nav-link" href="<?=site_url('legalisir')?>"><i class="bi bi-file-earmark-check-fill"></i> Legalisir</a>
                <a class="nav-link" href="<?=site_url('laporan')?>"><i class="bi bi-printer-fill"></i> Laporan</a>
                
                <?php if($r === 'super_admin'): ?>
                    <p class="nav-section-title mt-3">Master Data</p>
                    <a class="nav-link" href="<?=site_url('users')?>"><i class="bi bi-person-badge-fill"></i> Manajemen User</a>
                    <a class="nav-link" href="<?=site_url('master/index/jurusan')?>"><i class="bi bi-bookmark-fill"></i> Master Jurusan</a>
                    <a class="nav-link" href="<?=site_url('master/index/tahun')?>"><i class="bi bi-calendar-event-fill"></i> Tahun Lulus</a>
                    <a class="nav-link" href="<?=site_url('tracer/questions')?>"><i class="bi bi-question-square-fill"></i> Pertanyaan Tracer</a>
                <?php endif; ?>
                
            <?php else: ?>
                <a class="nav-link" href="<?=site_url('alumni/profile')?>"><i class="bi bi-person-lines-fill"></i> Lengkapi Profil</a>
                <a class="nav-link" href="<?=site_url('tracer')?>"><i class="bi bi-clipboard2-check-fill"></i> Isi Tracer Study</a>
                <a class="nav-link" href="<?=site_url('legalisir/create')?>"><i class="bi bi-file-earmark-plus-fill"></i> Ajukan Legalisir</a>
                <a class="nav-link" href="<?=site_url('legalisir')?>"><i class="bi bi-clock-history"></i> Riwayat Legalisir</a>
            <?php endif; ?>

            <p class="nav-section-title mt-3">Lainnya</p>
            <a class="nav-link text-white-50" href="<?=site_url('logout')?>">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
        </nav>
    </div>
</aside>

<main class="col-12 col-md-9 col-lg-10 main">
    <div class="topbar">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-dark d-md-none p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainSidebar" aria-controls="mainSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h4 class="mb-0 fw-bold d-none d-md-block"><?= html_escape($title) ?></h4>
        </div>
        
        <div class="d-flex align-items-center gap-4">
            <div class="position-relative">
                <i class="bi bi-bell fs-5 text-muted"></i>
                <?php if(isset($notification_count) && $notification_count > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                    <?= $notification_count ?>
                </span>
                <?php endif; ?>
            </div>
            
            <div class="dropdown">
                <div class="d-flex align-items-center gap-2 cursor-pointer dropdown-toggle" role="button" data-bs-toggle="dropdown" style="cursor: pointer;">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                        <?= strtoupper(substr($current_user['name'], 0, 1)) ?>
                    </div>
                    <div class="d-none d-sm-block text-end">
                        <div class="fw-bold" style="font-size: 0.9rem;"><?= html_escape($current_user['name']) ?></div>
                        <div class="text-muted" style="font-size: 0.75rem;"><?= ucwords(str_replace('_', ' ', $current_user['role_slug'])) ?></div>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item" href="<?= site_url('alumni/profile') ?>"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content-area">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
