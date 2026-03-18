<?php
require '../config/dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}

$userId = $_SESSION['user_id'];
$postId = $_POST['post_id'] ?? null;
$comment = trim($_POST['comment'] ?? '');

if (!$postId || $comment === '') {
    die("Invalid input");
}

// insert comment
$pdo->prepare("
    INSERT INTO comments (user_id, post_id, comment)
    VALUES (?, ?, ?)
")->execute([$userId, $postId, $comment]);

// update count
$pdo->prepare("
    UPDATE posts SET comments_count = comments_count + 1 WHERE id = ?
")->execute([$postId]);

header("Location: ../Controller/feed.controller.php");
exit;
