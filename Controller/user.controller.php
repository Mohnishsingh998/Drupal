<?php
  require '../config/dbconfig.php';
  session_start();
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$userId = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    require '../views/profile.view.php';

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>