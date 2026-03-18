<?php if (isset($_SESSION['user_id'])): ?>
<div class="top-bar">
    <div class="right-actions">

        <!-- Logout -->
        <form action="../Controller/logout.controller.php" method="POST">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
        <!-- create the post button -->
        <form action="../views/post.view.php" method="POST">
            <button type="submit" class="post-btn">Create Post</button>
        </form>
        <!-- GO back to Profile -->
         <?php if (!empty($showprofile)): ?>
            <a href="../Controller/user.controller.php" class="profile-btn">Go To Profile</a>
        <?php endif; ?>
        <!-- Feed button -->
        <?php if (!empty($showFeed)): ?>
            <a href="../Controller/feed.controller.php" class="feed-btn">Feed</a>
        <?php endif; ?>

    </div>
</div>
<?php endif; ?>