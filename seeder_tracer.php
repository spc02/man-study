<?php
$host = 'localhost';
$db   = 'manstudy';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Add columns if they don't exist
    $cols = [
        'category' => 'VARCHAR(100) NULL', 
        'parent_id' => 'INT UNSIGNED NULL', 
        'parent_value' => 'VARCHAR(255) NULL', 
        'question_key' => 'VARCHAR(50) UNIQUE NULL'
    ];
    foreach ($cols as $col => $def) {
        $stmt = $pdo->query("SHOW COLUMNS FROM `pertanyaan` LIKE '$col'");
        if($stmt->rowCount() == 0) {
            $pdo->exec("ALTER TABLE `pertanyaan` ADD `$col` $def");
        }
    }

    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    $pdo->exec("TRUNCATE TABLE `jawaban`");
    $pdo->exec("TRUNCATE TABLE `pertanyaan`");
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

    $questions = [
        // KATEGORI 1 - Status Alumni
        ['q' => 'Apa aktivitas utama Anda saat ini?', 'type' => 'radio', 'opts' => 'Melanjutkan Pendidikan|Bekerja|Berwirausaha|Sedang Mencari Pekerjaan|Belum Bekerja|Lainnya', 'order' => 1, 'cat' => 'Status Alumni', 'pid' => null, 'pval' => null, 'key' => 'activity'],

        // KATEGORI 2 - Pendidikan Lanjutan (parent_id = 1, parent_value = 'Melanjutkan Pendidikan')
        ['q' => 'Jenis Perguruan Tinggi', 'type' => 'select', 'opts' => 'Perguruan Tinggi Negeri (PTN)|Perguruan Tinggi Swasta (PTS)|Perguruan Tinggi Kedinasan|Perguruan Tinggi Luar Negeri|Pesantren|Lainnya', 'order' => 2, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_type'],
        ['q' => 'Nama Perguruan Tinggi', 'type' => 'text', 'opts' => null, 'order' => 3, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_name'],
        ['q' => 'Fakultas', 'type' => 'text', 'opts' => null, 'order' => 4, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_faculty'],
        ['q' => 'Program Studi', 'type' => 'text', 'opts' => null, 'order' => 5, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_major'],
        ['q' => 'Jenjang Pendidikan', 'type' => 'radio', 'opts' => 'D3|D4|S1|S2', 'order' => 6, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_level'],
        ['q' => 'Jalur Masuk (PTN)', 'type' => 'select', 'opts' => 'SNBP|SNBT|Seleksi Mandiri|Jalur Prestasi|Jalur Internasional|Lainnya', 'order' => 7, 'cat' => 'Pendidikan Lanjutan', 'pid' => 2, 'pval' => 'Perguruan Tinggi Negeri (PTN)', 'key' => 'uni_path_ptn'],
        ['q' => 'Jalur Masuk (PTS)', 'type' => 'select', 'opts' => 'Reguler|Beasiswa|Transfer|Prestasi|Lainnya', 'order' => 8, 'cat' => 'Pendidikan Lanjutan', 'pid' => 2, 'pval' => 'Perguruan Tinggi Swasta (PTS)', 'key' => 'uni_path_pts'],
        ['q' => 'Jalur Masuk (Kedinasan)', 'type' => 'select', 'opts' => 'Seleksi Nasional|Jalur Prestasi|Lainnya', 'order' => 9, 'cat' => 'Pendidikan Lanjutan', 'pid' => 2, 'pval' => 'Perguruan Tinggi Kedinasan', 'key' => 'uni_path_kedinasan'],
        ['q' => 'Tahun Masuk Kuliah', 'type' => 'number', 'opts' => null, 'order' => 10, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_year'],
        ['q' => 'Status Kuliah', 'type' => 'select', 'opts' => 'Aktif|Cuti|Lulus|Mengundurkan Diri', 'order' => 11, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_status'],
        ['q' => 'Apakah menerima beasiswa?', 'type' => 'radio', 'opts' => 'Ya|Tidak', 'order' => 12, 'cat' => 'Pendidikan Lanjutan', 'pid' => 1, 'pval' => 'Melanjutkan Pendidikan', 'key' => 'uni_scholarship'],
        ['q' => 'Nama Beasiswa', 'type' => 'text', 'opts' => null, 'order' => 13, 'cat' => 'Pendidikan Lanjutan', 'pid' => 12, 'pval' => 'Ya', 'key' => 'uni_scholarship_name'],

        // KATEGORI 3 - Pekerjaan (parent_id = 1, parent_value = 'Bekerja')
        ['q' => 'Nama Instansi / Perusahaan', 'type' => 'text', 'opts' => null, 'order' => 14, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_company'],
        ['q' => 'Bidang Industri', 'type' => 'select', 'opts' => 'Pendidikan|Pemerintahan|Perbankan|Teknologi|Manufaktur|Kesehatan|Perdagangan|Jasa|Lainnya', 'order' => 15, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_industry'],
        ['q' => 'Jabatan', 'type' => 'text', 'opts' => null, 'order' => 16, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_position'],
        ['q' => 'Status Pekerjaan', 'type' => 'select', 'opts' => 'Tetap|Kontrak|Magang|Freelance', 'order' => 17, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_status'],
        ['q' => 'Lokasi Bekerja (Provinsi)', 'type' => 'text', 'opts' => null, 'order' => 18, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_province'],
        ['q' => 'Lokasi Bekerja (Kabupaten/Kota)', 'type' => 'text', 'opts' => null, 'order' => 19, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_city'],
        ['q' => 'Rentang Gaji Pertama', 'type' => 'select', 'opts' => '< Rp2 Juta|Rp2–4 Juta|Rp4–6 Juta|Rp6–8 Juta|> Rp8 Juta', 'order' => 20, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_salary'],
        ['q' => 'Berapa lama memperoleh pekerjaan pertama setelah lulus?', 'type' => 'select', 'opts' => '< 3 Bulan|3–6 Bulan|6–12 Bulan|> 1 Tahun', 'order' => 21, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_wait_time'],
        ['q' => 'Apakah pekerjaan Anda sesuai jurusan?', 'type' => 'select', 'opts' => 'Sangat Sesuai|Sesuai|Kurang Sesuai|Tidak Sesuai', 'order' => 22, 'cat' => 'Pekerjaan', 'pid' => 1, 'pval' => 'Bekerja', 'key' => 'job_relevance'],

        // KATEGORI 4 - Wirausaha (parent_id = 1, parent_value = 'Berwirausaha')
        ['q' => 'Nama Usaha', 'type' => 'text', 'opts' => null, 'order' => 23, 'cat' => 'Wirausaha', 'pid' => 1, 'pval' => 'Berwirausaha', 'key' => 'biz_name'],
        ['q' => 'Bidang Usaha', 'type' => 'select', 'opts' => 'Kuliner|Fashion|Teknologi|Pertanian|Jasa|Perdagangan|Lainnya', 'order' => 24, 'cat' => 'Wirausaha', 'pid' => 1, 'pval' => 'Berwirausaha', 'key' => 'biz_field'],
        ['q' => 'Lama Menjalankan Usaha', 'type' => 'select', 'opts' => '< 1 Tahun|1–3 Tahun|> 3 Tahun', 'order' => 25, 'cat' => 'Wirausaha', 'pid' => 1, 'pval' => 'Berwirausaha', 'key' => 'biz_duration'],
        ['q' => 'Jumlah Karyawan', 'type' => 'number', 'opts' => null, 'order' => 26, 'cat' => 'Wirausaha', 'pid' => 1, 'pval' => 'Berwirausaha', 'key' => 'biz_employees'],
        ['q' => 'Omzet per Bulan', 'type' => 'select', 'opts' => '< Rp5 Juta|Rp5–10 Juta|Rp10–25 Juta|> Rp25 Juta', 'order' => 27, 'cat' => 'Wirausaha', 'pid' => 1, 'pval' => 'Berwirausaha', 'key' => 'biz_turnover'],

        // KATEGORI 5 - Mencari Pekerjaan (parent_id = 1, parent_value = 'Sedang Mencari Pekerjaan')
        ['q' => 'Sudah berapa lama Anda aktif mencari pekerjaan?', 'type' => 'select', 'opts' => '< 3 Bulan|3–6 Bulan|6–12 Bulan|> 1 Tahun', 'order' => 28, 'cat' => 'Mencari Pekerjaan', 'pid' => 1, 'pval' => 'Sedang Mencari Pekerjaan', 'key' => 'seek_duration'],
        ['q' => 'Bidang pekerjaan yang Anda tuju?', 'type' => 'select', 'opts' => 'Pendidikan|Pemerintahan|Perbankan|Teknologi|Manufaktur|Kesehatan|Perdagangan|Jasa|Lainnya', 'order' => 29, 'cat' => 'Mencari Pekerjaan', 'pid' => 1, 'pval' => 'Sedang Mencari Pekerjaan', 'key' => 'seek_field'],
        ['q' => 'Cara yang digunakan dalam mencari pekerjaan?', 'type' => 'checkbox', 'opts' => 'Portal Lowongan Online (JobStreet, LinkedIn, dll)|Media Sosial|Relasi / Kenalan|Langsung ke Perusahaan|Bursa Kerja Sekolah / Campus Hiring|Lainnya', 'order' => 30, 'cat' => 'Mencari Pekerjaan', 'pid' => 1, 'pval' => 'Sedang Mencari Pekerjaan', 'key' => 'seek_method'],
        ['q' => 'Apa hambatan utama dalam mencari pekerjaan?', 'type' => 'select', 'opts' => 'Kurang Pengalaman|Kurang Keterampilan / Skill|Persaingan Ketat|Lokasi|Gaji Tidak Sesuai Harapan|Belum Ada Lowongan yang Cocok|Lainnya', 'order' => 31, 'cat' => 'Mencari Pekerjaan', 'pid' => 1, 'pval' => 'Sedang Mencari Pekerjaan', 'key' => 'seek_obstacle'],
        ['q' => 'Apakah Anda sedang mengikuti pelatihan / kursus sambil mencari kerja?', 'type' => 'radio', 'opts' => 'Ya|Tidak', 'order' => 32, 'cat' => 'Mencari Pekerjaan', 'pid' => 1, 'pval' => 'Sedang Mencari Pekerjaan', 'key' => 'seek_training'],

        // KATEGORI 6 - Belum Bekerja (parent_id = 1, parent_value = 'Belum Bekerja')
        ['q' => 'Apa alasan utama Anda belum bekerja atau melanjutkan pendidikan?', 'type' => 'select', 'opts' => 'Merawat Keluarga|Kondisi Kesehatan|Belum Ada Motivasi|Sedang Mempersiapkan Diri|Faktor Ekonomi|Lainnya', 'order' => 33, 'cat' => 'Belum Bekerja', 'pid' => 1, 'pval' => 'Belum Bekerja', 'key' => 'idle_reason'],
        ['q' => 'Apa rencana Anda dalam waktu 6 bulan ke depan?', 'type' => 'radio', 'opts' => 'Mencari Pekerjaan|Melanjutkan Pendidikan|Berwirausaha|Mengikuti Pelatihan / Kursus|Belum Ada Rencana', 'order' => 34, 'cat' => 'Belum Bekerja', 'pid' => 1, 'pval' => 'Belum Bekerja', 'key' => 'idle_plan'],
        ['q' => 'Apakah ada kegiatan yang Anda lakukan saat ini?', 'type' => 'textarea', 'opts' => null, 'order' => 35, 'cat' => 'Belum Bekerja', 'pid' => 1, 'pval' => 'Belum Bekerja', 'key' => 'idle_activity'],

        // KATEGORI 7 - Lainnya (parent_id = 1, parent_value = 'Lainnya')
        ['q' => 'Jelaskan aktivitas utama Anda saat ini', 'type' => 'textarea', 'opts' => null, 'order' => 36, 'cat' => 'Lainnya', 'pid' => 1, 'pval' => 'Lainnya', 'key' => 'other_activity'],
        ['q' => 'Apakah aktivitas tersebut memberikan penghasilan?', 'type' => 'radio', 'opts' => 'Ya|Tidak', 'order' => 37, 'cat' => 'Lainnya', 'pid' => 1, 'pval' => 'Lainnya', 'key' => 'other_income'],

        // KATEGORI 8 - Evaluasi Sekolah (no parent, always shown)
        ['q' => 'Seberapa relevan materi pembelajaran dengan aktivitas saat ini?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 38, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_relevance'],
        ['q' => 'Kualitas guru selama belajar di MAN 1 Magelang?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 39, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_teacher'],
        ['q' => 'Kualitas fasilitas sekolah?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 40, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_facility'],
        ['q' => 'Pelayanan administrasi sekolah?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 41, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_admin'],
        ['q' => 'Seberapa besar sekolah membantu persiapan dunia kerja/kuliah?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 42, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_prep'],
        ['q' => 'Seberapa puas Anda menjadi alumni MAN 1 Magelang?', 'type' => 'radio', 'opts' => '1|2|3|4|5', 'order' => 43, 'cat' => 'Evaluasi Sekolah', 'pid' => null, 'pval' => null, 'key' => 'eval_satisfaction'],

        // KATEGORI 9 - Masukan Alumni (no parent, always shown)
        ['q' => 'Apa saran Anda agar MAN 1 Magelang menjadi lebih baik?', 'type' => 'textarea', 'opts' => null, 'order' => 44, 'cat' => 'Masukan Alumni', 'pid' => null, 'pval' => null, 'key' => 'feedback'],
    ];

    $stmt = $pdo->prepare("INSERT INTO `pertanyaan` (`id`, `question`, `type`, `options`, `sort_order`, `category`, `parent_id`, `parent_value`, `question_key`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($questions as $i => $q) {
        $stmt->execute([$i+1, $q['q'], $q['type'], $q['opts'], $q['order'], $q['cat'], $q['pid'], $q['pval'], $q['key']]);
    }
    echo "Seed done.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
