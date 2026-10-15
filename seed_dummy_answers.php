<?php
$host = 'localhost';
$db   = 'manstudy';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all alumni
    $alumniList = $pdo->query("SELECT id FROM alumni")->fetchAll(PDO::FETCH_ASSOC);
    if (!$alumniList) {
        die("Belum ada alumni di database.");
    }

    // Clear existing tracer answers
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    $pdo->exec("TRUNCATE TABLE jawaban");
    $pdo->exec("TRUNCATE TABLE tracer");
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

    // Get questions mapped by key
    $qStmt = $pdo->query("SELECT * FROM pertanyaan");
    $questions = [];
    while($q = $qStmt->fetch(PDO::FETCH_ASSOC)) {
        if ($q['question_key']) {
            $questions[$q['question_key']] = $q;
        }
    }

    $ptnNames = ['Universitas Gadjah Mada', 'Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Diponegoro', 'Universitas Sebelas Maret'];
    $ptsNames = ['Universitas Muhammadiyah Magelang', 'Universitas Islam Indonesia', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Atma Jaya', 'Bina Nusantara'];
    $majors = ['Teknik Informatika', 'Manajemen', 'Akuntansi', 'Ilmu Hukum', 'Ilmu Komunikasi', 'Pendidikan Agama Islam'];

    foreach ($alumniList as $alumni) {
        $aid = $alumni['id'];
        
        // Create tracer record
        $stmt = $pdo->prepare("INSERT INTO tracer (alumni_id, status, submitted_at) VALUES (?, 'submitted', NOW() - INTERVAL FLOOR(RAND() * 30) DAY)");
        $stmt->execute([$aid]);
        $tid = $pdo->lastInsertId();

        $answers = [];

        // Determine activity (Majority education)
        $rand = rand(1, 100);
        if ($rand <= 70) {
            $activity = 'Melanjutkan Pendidikan';
        } else if ($rand <= 85) {
            $activity = 'Bekerja';
        } else if ($rand <= 95) {
            $activity = 'Berwirausaha';
        } else {
            $activity = 'Sedang Mencari Pekerjaan';
        }

        $answers['activity'] = $activity;

        if ($activity === 'Melanjutkan Pendidikan') {
            $is_ptn = rand(1, 100) <= 60; // 60% PTN, 40% PTS
            $answers['uni_type'] = $is_ptn ? 'Perguruan Tinggi Negeri (PTN)' : 'Perguruan Tinggi Swasta (PTS)';
            $answers['uni_name'] = $is_ptn ? $ptnNames[array_rand($ptnNames)] : $ptsNames[array_rand($ptsNames)];
            $answers['uni_faculty'] = 'Fakultas ' . (rand(1,2)==1 ? 'Teknik' : 'Ekonomi');
            $answers['uni_major'] = $majors[array_rand($majors)];
            $answers['uni_level'] = 'S1';
            
            if ($is_ptn) {
                $paths = ['SNBP', 'SNBT', 'Seleksi Mandiri'];
                $answers['uni_path_ptn'] = $paths[array_rand($paths)];
            } else {
                $paths = ['Reguler', 'Beasiswa'];
                $answers['uni_path_pts'] = $paths[array_rand($paths)];
            }
            
            $answers['uni_year'] = '2023';
            $answers['uni_status'] = 'Aktif';
            
            $hasBeasiswa = rand(1, 100) <= 30;
            $answers['uni_scholarship'] = $hasBeasiswa ? 'Ya' : 'Tidak';
            if ($hasBeasiswa) {
                $answers['uni_scholarship_name'] = 'KIP Kuliah';
            }
        } elseif ($activity === 'Bekerja') {
            $answers['job_company'] = 'PT Maju Jaya';
            $industries = ['Pendidikan', 'Teknologi', 'Manufaktur', 'Perdagangan', 'Jasa'];
            $answers['job_industry'] = $industries[array_rand($industries)];
            $answers['job_position'] = 'Staff';
            $answers['job_status'] = 'Tetap';
            $answers['job_province'] = 'Jawa Tengah';
            $answers['job_city'] = 'Magelang';
            $salaries = ['< Rp2 Juta', 'Rp2–4 Juta', 'Rp4–6 Juta'];
            $answers['job_salary'] = $salaries[array_rand($salaries)];
            $wait_times = ['< 3 Bulan', '3–6 Bulan'];
            $answers['job_wait_time'] = $wait_times[array_rand($wait_times)];
            $relevances = ['Sangat Sesuai', 'Sesuai', 'Kurang Sesuai'];
            $answers['job_relevance'] = $relevances[array_rand($relevances)];
        } elseif ($activity === 'Berwirausaha') {
            $answers['biz_name'] = 'Kedai Mantap';
            $fields = ['Kuliner', 'Fashion', 'Jasa', 'Perdagangan'];
            $answers['biz_field'] = $fields[array_rand($fields)];
            $answers['biz_duration'] = '1–3 Tahun';
            $answers['biz_employees'] = rand(1, 5);
            $turnovers = ['< Rp5 Juta', 'Rp5–10 Juta'];
            $answers['biz_turnover'] = $turnovers[array_rand($turnovers)];
        } elseif ($activity === 'Sedang Mencari Pekerjaan') {
            $answers['seek_duration'] = '< 3 Bulan';
            $fields = ['Teknologi', 'Perdagangan'];
            $answers['seek_field'] = $fields[array_rand($fields)];
            $answers['seek_method'] = 'Portal Lowongan Online (JobStreet, LinkedIn, dll)';
            $answers['seek_obstacle'] = 'Persaingan Ketat';
            $answers['seek_training'] = 'Ya';
        }

        // Always add evaluation
        $answers['eval_relevance'] = rand(3, 5);
        $answers['eval_teacher'] = rand(4, 5);
        $answers['eval_facility'] = rand(3, 5);
        $answers['eval_admin'] = rand(3, 5);
        $answers['eval_prep'] = rand(4, 5);
        $answers['eval_satisfaction'] = rand(4, 5);
        $answers['feedback'] = 'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!';

        // Insert answers
        $insertStmt = $pdo->prepare("INSERT INTO jawaban (tracer_id, pertanyaan_id, answer) VALUES (?, ?, ?)");
        foreach ($answers as $key => $val) {
            if (isset($questions[$key])) {
                $qid = $questions[$key]['id'];
                $insertStmt->execute([$tid, $qid, (string)$val]);
            }
        }
    }

    echo "Successfully generated tracer data for " . count($alumniList) . " alumni.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
