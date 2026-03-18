<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feed Section</title>
    <link rel="stylesheet" href="../public/assests/feed.view.css">
</head>
<body>

<?php
$showFeed = false;
$showprofile = true;
require '../views/navbar.php'; 
?>

<div class="container">

    <div class="suggested-users">

        <form method="GET" class="search-box">
            <input 
                type="text" 
                name="q" 
                placeholder="Search users..." 
                value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
            >
            <button type="submit">Search</button>
        </form>

        <?php if (!empty($searchResults)): ?>
            <div class="search-results">
                <?php foreach ($searchResults as $u): ?>
                    <div class="suggested-user">
                        <img src="<?= htmlspecialchars($u['profile_url']) ?>" class="avatar">
                        <span><?= htmlspecialchars($u['fullname']) ?></span>
                        <form action="../Controller/follow.controller.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                            <button type="submit">Follow</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($_GET['q'])): ?>
            <p>No users found</p>
        <?php endif; ?>

    </div>

    <div class="feed-container">

        <?php if (!empty($posts)): ?>

            <?php foreach ($posts as $post): ?>
                <div class="post">

                    <div class="post-header">
                        <img src="<?= htmlspecialchars($post['profile_url']) ?>" class="avatar">
                        <strong><?= htmlspecialchars($post['fullname']) ?></strong>

                        <?php if ($post['user_id'] != $_SESSION['user_id']): ?>
                            <form action="../Controller/follow.controller.php" method="POST">
                                <input type="hidden" name="user_id" value="<?= $post['user_id'] ?>">
                                <button class="follow-btn">
                                    <?= $post['is_following'] ? 'Unfollow' : 'Follow' ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="post-image">
                        <img src="<?= htmlspecialchars($post['image_url']) ?>">
                    </div>

                    <div class="post-content">

                        <p><?= htmlspecialchars($post['caption']) ?></p>

                        <form action="../Controller/like.controller.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button class="like-btn">
                                <?= $post['liked_by_user'] ? '❤️' : '🤍' ?>
                                <?= $post['likes_count'] ?>
                            </button>
                        </form>

                        <div class="comments">
                            <?php foreach ($post['comments'] as $c): ?>
                                <p>
                                    <strong><?= htmlspecialchars($c['fullname']) ?>:</strong>
                                    <?= htmlspecialchars($c['comment']) ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                        <form action="../Controller/comment.controller.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="text" name="comment" placeholder="Add a comment..." required>
                            <button type="submit">Post</button>
                        </form>

                        <small>
                            <?= date("d M Y, h:i A", strtotime($post['created_at'])) ?>
                        </small>

                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p class="no-posts">Follow users to see posts</p>
        <?php endif; ?>

    </div>

</div>

</body>
</html>