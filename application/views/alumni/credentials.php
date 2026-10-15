<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Akun Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .print-btn {
            display: block;
            margin: 0 auto 20px;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background: #fff;
            border: 2px dashed #ccc;
            border-radius: 10px;
            width: 300px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            page-break-inside: avoid;
        }
        .card-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .info-group {
            margin-bottom: 10px;
        }
        .info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .credentials-box {
            background-color: #f1f8ff;
            border: 1px solid #cce5ff;
            border-radius: 5px;
            padding: 10px;
            margin-top: 15px;
        }
        .credentials-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .credentials-box strong {
            font-size: 16px;
        }
        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }
            .print-btn {
                display: none;
            }
            .card {
                border-style: solid;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()">🖨️ Cetak PDF / Print</button>

    <div class="container">
        <?php foreach($alumni as $a): ?>
        <div class="card">
            <h3 class="card-title">Kredensial Login Alumni</h3>
            
            <div class="info-group">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value"><?= html_escape($a['name']) ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">NISN</div>
                <div class="info-value"><?= html_escape($a['nisn']) ?></div>
            </div>

            <div class="credentials-box">
                <p>Username: <strong><?= html_escape($a['username']) ?></strong></p>
                <p>Password: <strong><?= html_escape($a['nisn']) ?></strong></p>
            </div>
            
            <div style="text-align:center; margin-top:10px; font-size:11px; color:#888;">
                Gunakan kredensial ini untuk login ke Sistem Tracer Study MAN 1 Magelang.
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
