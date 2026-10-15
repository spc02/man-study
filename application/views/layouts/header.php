<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= html_escape($title) ?> | MAN 1 Magelang</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    
    <style>
        :root {
            --primary: #198754;
            --primary-dark: #0b5e36;
            --sidebar-bg: #0b5e36;
            --sidebar-hover: #198754;
            --sidebar-active: #11683d;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--sidebar-bg) !important;
        }
        
        @media (min-width: 768px) {
            .sidebar {
                height: 100vh;
                position: sticky;
                top: 0;
                z-index: 10;
                overflow-y: auto;
                box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            }
        }

        .sidebar .brand {
            padding: 1.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }
        
        .sidebar .brand-icon {
            color: #fbd341;
            font-size: 1.8rem;
        }

        .sidebar .brand-text {
            color: white;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }

        .sidebar .brand-text small {
            font-size: 0.75rem;
            font-weight: 400;
            color: #bbf7d0;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #86efac;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 1rem 1rem 0.5rem 1rem;
            margin: 0;
        }

        .sidebar .nav-link {
            color: #e2e8f0;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin: 2px 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .sidebar .nav-link.active, .sidebar .nav-link[href="<?=current_url()?>"] {
            background: var(--sidebar-active);
            color: white;
            font-weight: 600;
        }

        /* Main Content */
        .main {
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .content-area {
            padding: 2rem;
            flex: 1;
        }

        /* Cards & Utilities */
        .card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .badge-soft-primary { background: #e0e7ff; color: #4338ca; }
        .badge-soft-success { background: #dcfce7; color: #15803d; }
        .badge-soft-warning { background: #fef9c3; color: #a16207; }
        .badge-soft-danger { background: #fee2e2; color: #b91c1c; }
        
        /* Stats Icon container */
        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Responsive Tables for Mobile */
        @media (max-width: 767.98px) {
            /* Content area: keep horizontal padding for breathing room */
            .content-area {
                padding: 1rem 1rem 2rem 1rem !important;
            }

            /* Topbar */
            .topbar {
                padding: 0.75rem 1rem !important;
            }

            /* Cards: keep radius but reduce shadow, allow full width */
            .card {
                border-radius: 12px !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
                margin-bottom: 1rem !important;
            }

            /* Card header: stack title + buttons */
            .card-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.6rem;
                padding: 0.875rem 1rem !important;
            }
            .card-header > div { width: 100%; }

            /* Table-card: strip card-body padding only when wrapping a table */
            .card-body:has(> .table-responsive),
            .card-body:has(> table) {
                padding: 0 !important;
            }

            /* Hide table-responsive overflow on mobile */
            .table-responsive {
                overflow: visible !important;
            }

            /* Table → Card rows */
            table.table {
                display: block;
                width: 100%;
                background: transparent;
            }
            table.table thead {
                display: none;
            }
            table.table tbody {
                display: block;
            }
            table.table tr {
                display: block;
                background: #fff;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #f1f5f9;
            }
            table.table tr:last-child {
                border-bottom: none;
            }
            table.table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: none;
                border-bottom: 1px solid #f8fafc;
                padding: 0.5rem 0;
                text-align: right;
                font-size: 0.875rem;
                word-break: break-word;
            }
            table.table td:last-child {
                border-bottom: 0;
                padding-bottom: 0;
            }
            table.table td::before {
                content: attr(data-label);
                font-weight: 600;
                text-align: left;
                min-width: 40%;
                max-width: 45%;
                margin-right: 0.5rem;
                color: var(--text-muted);
                flex-shrink: 0;
            }

            /* DataTables controls */
            .dt-container > .row {
                margin: 0;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #f1f5f9;
            }
            .dt-length, .dt-search {
                width: 100% !important;
                margin-bottom: 0.25rem;
            }
            .dt-search label { width: 100%; }
            .dt-search input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 0.25rem;
                display: block;
            }
            .dt-paging {
                display: flex;
                justify-content: center;
                padding: 0.75rem 1rem;
                border-top: 1px solid #f1f5f9;
            }
            .dt-info {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
                color: var(--text-muted);
            }

            /* Form improvements on mobile */
            .form-control, .form-select {
                font-size: 1rem;
            }

            /* Stat cards: 2 per row */
            .col-sm-6.col-xl-3 {
                width: 50% !important;
            }
            .row.g-4 .col-sm-6 { padding: 0.35rem !important; }

            /* Button full-width in action areas */
            .btn.w-100-mobile { width: 100% !important; }
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
<div class="row g-0">
