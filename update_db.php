<?php
$host = 'localhost';
$db   = 'manstudy';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS `login_attempts` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `ip_address` varchar(45) NOT NULL,
      `login` varchar(100) NOT NULL,
      `time` int(11) unsigned DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    echo "Table login_attempts checked/created.\n";
    
    $stmt = $pdo->query("SHOW COLUMNS FROM `users` LIKE 'force_change_password'");
    if($stmt->rowCount() == 0) {
        $pdo->exec("ALTER TABLE `users` ADD `force_change_password` TINYINT(1) DEFAULT 0 AFTER `password`");
        echo "Column force_change_password added.\n";
    } else {
        echo "Column force_change_password already exists.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
