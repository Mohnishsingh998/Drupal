<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../public/assests/profile.view.css">
</head>
<body>
<?php if ($user): ?>
<?php 
    $showFeed = true;
    $showprofile = false;
    require '../views/navbar.php'; 
?>
<div class="container">
    <div class="profile-card">
        <img src="<?= htmlspecialchars($user['profile_url']) ?>" alt="Profile">
        <h2><?= htmlspecialchars($user['fullname']) ?></h2>
        <p class="email"><?= htmlspecialchars($user['email']) ?></p>
        <div class="stats">
            <div>
                <strong><?= htmlspecialchars($user['follow_count'] ?? 0) ?></strong>
                <span>Followers</span>
            </div>
            <div>
                <strong><?= htmlspecialchars($user['following_count'] ?? 0) ?></strong>
                <span>Following</span>
            </div>
            <div>
                <strong><?= htmlspecialchars($user['post_count'] ?? 0) ?></strong>
                <span>Posts</span>
            </div>
        </div>
        <p class="bio"><?= htmlspecialchars($user['bio']) ?></p>
        <small>Joined: <?= htmlspecialchars($user['created_at']) ?></small>
    </div>
</div>
<?php else: ?>
    <p class="error">User not found</p>
<?php endif; ?>

</body>
</html>