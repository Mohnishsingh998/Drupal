<?php
require '../config/dbconfig.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sentemail = trim($_POST['email'] ?? '');
    $sentpassword = $_POST['password'] ?? '';

    if ($sentemail === '' || $sentpassword === '') {
        die("All fields are required");
    }

    if (!filter_var($sentemail, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$sentemail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        die("Something went wrong");
    }
    
    if ($user && password_verify($sentpassword, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: user.controller.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>