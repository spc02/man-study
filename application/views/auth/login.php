<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Masuk | Sistem Informasi Alumni MAN 1 Magelang</title>
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
            padding: 2rem 0;
            z-index: 1;
        }

        .brand-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .brand-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 10px 15px -3px rgba(11, 94, 54, 0.3);
        }

        .brand-text h1 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            color: var(--primary-color);
            letter-spacing: 0.5px;
        }

        .brand-text p {
            font-size: 0.75rem;
            margin: 0;
            color: var(--text-muted);
            font-weight: 500;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 2.5rem;
            line-height: 1.6;
            max-width: 450px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-info h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-info p {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(11, 94, 54, 0.15);
            position: relative;
            overflow: hidden;
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

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider:not(:empty)::before {
            margin-right: 1rem;
        }

        .divider:not(:empty)::after {
            margin-left: 1rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        a.text-primary-custom:hover {
            color: #084c2a !important;
            text-decoration: underline;
        }

        /* Footer styling */
        .footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1.5rem 0;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .footer-feature {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .footer-feature i {
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        @media (max-width: 991px) {
            .hero-section {
                display: none;
            }
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
        <div class="w-100">
            <div class="row align-items-center justify-content-center justify-content-lg-between g-5">
            
            <!-- Left Side: Hero Section -->
            <div class="col-lg-6 hero-section">
                <div class="brand-logo-container">
                    <div class="brand-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="brand-text">
                        <h1>MAN 1 MAGELANG</h1>
                        <p>Mendidik, Membina, Menginspirasi</p>
                    </div>
                </div>

                <p class="text-uppercase fw-bold text-muted mb-2 tracking-wider" style="letter-spacing: 2px;">Sistem Informasi</p>
                <h1 class="hero-title">Alumni &<br>Tracer Study</h1>
                <p class="hero-subtitle">Satu Sistem untuk Alumni yang Terhubung, Data yang Akurat, Masa Depan yang Lebih Baik.</p>

                <div class="row g-3 pe-lg-5">
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="stat-info">
                                <h4>2.450+</h4>
                                <p>Alumni Terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <div class="stat-info">
                                <h4>15+</h4>
                                <p>Angkatan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-check-fill"></i>
                            </div>
                            <div class="stat-info">
                                <h4>1.230+</h4>
                                <p>Legalisir Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Integrasi</h4>
                                <p>Data Akurat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 mx-auto mx-lg-0">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3" style="background: rgba(26, 135, 84, 0.1);">
                            <i class="bi bi-shield-lock text-primary-custom" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1">Selamat Datang</h2>
                        <p class="text-muted">Silakan masuk untuk melanjutkan</p>
                    </div>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i> <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?= form_open('login') ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">Email atau NISN</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-transparent px-3">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" name="identity" placeholder="Masukkan email atau NISN" value="<?= set_value('identity') ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-transparent px-3">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-0" name="password" id="password" placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary border-start-0 border text-muted px-3 toggle-password" type="button" style="border-color: #e2e8f0; background: white;">
                                    <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-dark small fw-medium" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            <a href="#" class="text-primary-custom small fw-semibold text-decoration-none">Lupa Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm">MASUK</button>
                    <?= form_close() ?>


                </div>
            </div>
        </div>
        </div>
    </div>



    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle functionality
        document.querySelector('.toggle-password').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>
</html>
