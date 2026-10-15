<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registrasi | Sistem Informasi Alumni MAN 1 Magelang</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-color: #0b5e36; /* Dark green */
            --secondary-color: #1a8754; /* Lighter green */
            --bg-color: #e8f3ec; /* Very light green background */
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            background-image: radial-gradient(circle at top right, #d1e8d8 0%, transparent 40%),
                              radial-gradient(circle at bottom left, #c4dfcd 0%, transparent 40%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        /* Abstract shapes for background */
        .bg-shape-1 {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 50%;
            height: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0.05;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
        }

        .bg-shape-2 {
            position: absolute;
            bottom: -10%;
            left: -5%;
            width: 40%;
            height: 40%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0.08;
            border-radius: 50%;
            filter: blur(50px);
            z-index: -1;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            z-index: 1;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(11, 94, 54, 0.15);
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 600px;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .form-control {
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(26, 135, 84, 0.1);
        }

        .input-group-text {
            background: white;
            border-color: #e2e8f0;
            color: #94a3b8;
            border-radius: 10px;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--secondary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #084c2a;
            border-color: #084c2a;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(11, 94, 54, 0.3);
        }
        
        .btn-outline-secondary {
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        @media (max-width: 991px) {
            .login-card {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shape-1"></div>
    <div class="bg-shape-2"></div>

    <div class="main-wrapper container">
        <div class="login-card">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3" style="background: rgba(26, 135, 84, 0.1);">
                    <i class="bi bi-person-plus text-primary" style="font-size: 2.5rem; color: var(--primary-color) !important;"></i>
                </div>
                <h2 class="fw-bold text-dark mb-1">Registrasi Alumni</h2>
                <p class="text-muted">Lengkapi form berikut untuk mendaftar</p>
            </div>

            <?=validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-triangle me-2"></i>','<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= form_open('register') ?>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">NISN</label>
                        <input type="text" class="form-control" name="nisn" placeholder="10 Digit NISN" value="<?= set_value('nisn') ?>" required minlength="10" maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" placeholder="Sesuai Ijazah" value="<?= set_value('name') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email aktif" value="<?= set_value('email') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">No. WhatsApp</label>
                        <input type="text" class="form-control" name="phone" placeholder="Contoh: 08123456789" value="<?= set_value('phone') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Minimal 8 karakter" required minlength="8">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" required minlength="8">
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <button type="submit" class="btn btn-primary w-100 shadow-sm">DAFTAR SEKARANG</button>
                    <a href="<?= site_url('login') ?>" class="btn btn-outline-secondary w-100">KEMBALI KE LOGIN</a>
                </div>
            <?= form_close() ?>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('form').on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var btn = $(this).find('button[type="submit"]');
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
            }
        });
    </script>
</body>
</html>
