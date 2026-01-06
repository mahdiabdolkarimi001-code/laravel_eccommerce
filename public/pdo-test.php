<?php
// روشن کردن خطاها
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'my-laravel';
$port = 3306 ;
$db   = 'gallant_williamson';
$user = 'root';
$pass = 'EWmSoTvs6TWVIGNLirkwFveZ';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO(
        $dsn,
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT            => 5,
        ]
    );

    echo "✅ اتصال به دیتابیس برقرار شد";
} catch (PDOException $e) {
    echo "❌ اتصال برقرار نشد<br><br>";
    echo "<strong>خطا:</strong><br>";
    echo nl2br($e->getMessage());
}
