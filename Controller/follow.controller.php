<?php
require '../config/dbconfig.php';
session_start();

$userId = $_SESSION['user_id'];        // follower
$targetId = $_POST['user_id'];         // following

if ($userId == $targetId) {
    die("Cannot follow yourself");
}

// check existing follow
$stmt = $pdo->prepare("
    SELECT id FROM follows 
    WHERE follower_id = ? AND following_id = ?
");
$stmt->execute([$userId, $targetId]);

if ($stmt->rowCount() > 0) {
    // UNFOLLOW
    $pdo->prepare("
        DELETE FROM follows 
        WHERE follower_id = ? AND following_id = ?
    ")->execute([$userId, $targetId]);

    $pdo->prepare("
        UPDATE users SET follow_count = follow_count - 1 WHERE id = ?
    ")->execute([$targetId]);

    $pdo->prepare("
        UPDATE users SET following_count = following_count - 1 WHERE id = ?
    ")->execute([$userId]);

} else {
    //  FOLLOW
    $pdo->prepare("
        INSERT INTO follows (follower_id, following_id)
        VALUES (?, ?)
    ")->execute([$userId, $targetId]);

    $pdo->prepare("
        UPDATE users SET follow_count = follow_count + 1 WHERE id = ?
    ")->execute([$targetId]);

    $pdo->prepare("
        UPDATE users SET following_count = following_count + 1 WHERE id = ?
    ")->execute([$userId]);
}

header("Location: ../Controller/feed.controller.php");
exit;