<?php

$host = 'localhost';
$db = 'Application_01';
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // Log error (don't expose to user)
    error_log("DB Error: " . $e->getMessage());
    die("Database connection failed.");
}