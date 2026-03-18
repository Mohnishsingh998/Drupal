<?php
require '../config/dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

header('Content-Type: application/json');

$userId = $_SESSION['user_id'];
$query = trim($_GET['q'] ?? '');

if ($query === '') {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, fullname, profile_url
    FROM users
    WHERE fullname LIKE ?
    AND id != ?
    LIMIT 10
");

$stmt->execute(["%$query%", $userId]);

$searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($searchResults);
exit;