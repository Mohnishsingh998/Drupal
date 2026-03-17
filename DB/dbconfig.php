<?php
$host = 'localhost';
$db = 'test';       
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected with database successfully.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>