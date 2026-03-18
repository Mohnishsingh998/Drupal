<?php
require '../config/dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$userId = $_SESSION['user_id'];

try {
    //  Logged-in user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Feed
    $stmt = $pdo->prepare("
        SELECT 
            p.id,
            p.user_id,
            p.image_url,
            p.caption,
            p.likes_count,
            p.comments_count,
            p.created_at,
            
            u.fullname,
            u.profile_url
            
        FROM posts p
        JOIN users u ON p.user_id = u.id
        WHERE p.user_id IN (
            SELECT following_id FROM follows WHERE follower_id = ?
        )
        OR p.user_id = ?
        ORDER BY p.created_at DESC
    ");

    $stmt->execute([$userId, $userId]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($posts as &$post) {

        // Comments
        $stmt = $pdo->prepare("
            SELECT c.comment, u.fullname
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = ?
            ORDER BY c.created_at DESC
        ");
        $stmt->execute([$post['id']]);
        $post['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Like status
        $stmt = $pdo->prepare("
            SELECT id FROM likes 
            WHERE user_id = ? AND post_id = ?
        ");
        $stmt->execute([$userId, $post['id']]);
        $post['liked_by_user'] = $stmt->rowCount() > 0;

        // Follow status (for post owner)
        if ($post['user_id'] != $userId) {
            $stmt = $pdo->prepare("
                SELECT id FROM follows 
                WHERE follower_id = ? AND following_id = ?
            ");
            $stmt->execute([$userId, $post['user_id']]);
            $post['is_following'] = $stmt->rowCount() > 0;
        } else {
            $post['is_following'] = null;
        }

       
        
    }
         // for getting suggestions for users
        $stmt = $pdo->prepare("
        SELECT id, fullname, profile_url
        FROM users
        WHERE id != ?
        AND id NOT IN (
            SELECT following_id FROM follows WHERE follower_id = ?
        )
        LIMIT 5
    ");

    $stmt->execute([$userId, $userId]);
    $suggestedUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $searchQuery = $_GET['q'] ?? '';
    $searchResults = [];

    if ($searchQuery !== '') {
        $stmt = $pdo->prepare("
            SELECT id, fullname, profile_url
            FROM users
            WHERE fullname LIKE ?
            AND id != ?
            LIMIT 10
        ");
        $stmt->execute(["%$searchQuery%", $userId]);
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    require '../views/feed.view.php';

} catch (PDOException $e) {
    echo $e->getMessage();
}