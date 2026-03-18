<?php
require '../config/dbconfig.php';
require '../config/cloudnarycinfig.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['name'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    $about = $_POST['bio'] ?? '';
    if ($username === '' || $email === '' || $password === '') {
        die("All required fields must be filled");
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if (!isset($_FILES['profileimage'])) {
        die("File not received");
    }
    $file = $_FILES['profileimage'];
    if ($file['error'] !== 0) {
        die("Upload error: " . $file['error']);
    }
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $follow_count = 0 ;
    $following_count = 0 ;
    $post_count = 0;
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($fileActualExt, $allowed)) {
        die("Invalid file type");
    }
    if ($fileSize > 2 * 1024 * 1024) {
        die("File too large");
    }
    $imageUrl = uploadToCloudnary($fileTmpName);
    $stmt = $pdo->prepare("
        INSERT INTO users (fullname, email, password, bio, profile_url, follow_count, following_count,post_count)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $success = $stmt->execute([
        $username,
        $email,
        $hashedPassword,
        $about,
        $imageUrl,
        $follow_count,
        $following_count,
        $post_count
    ]);
    if ($success) {
        echo "User registered successfully";
        header('Location: ../views/login.view.php');
        exit();
    } else {
        echo "Database error";
    }
}
?>