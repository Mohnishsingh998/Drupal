<?php
require '../config/dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}

$userId = $_SESSION['user_id'];
$postId = $_POST['post_id'] ?? null;

if (!$postId) {
    die("Invalid request");
}

// check if already liked
$stmt = $pdo->prepare("SELECT id FROM likes WHERE user_id = ? AND post_id = ?");
$stmt->execute([$userId, $postId]);

if ($stmt->rowCount() > 0) {
    // UNLIKE
    $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?")
        ->execute([$userId, $postId]);

    $pdo->prepare("UPDATE posts SET likes_count = likes_count - 1 WHERE id = ?")
        ->execute([$postId]);

} else {
    // LIKE
    $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)")
        ->execute([$userId, $postId]);

    $pdo->prepare("UPDATE posts SET likes_count = likes_count + 1 WHERE id = ?")
        ->execute([$postId]);
}

header("Location: ../Controller/feed.controller.php");
exit;