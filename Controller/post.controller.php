<?php
require '../config/cloudnarycinfig.php';
require '../config/dbconfig.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!isset($_SESSION['user_id'])) {
          die("User not logged in");
      }
      if (!isset($_FILES['postimage'])) {
           die("File not received");
      }
      $file = $_FILES['postimage'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = ['jpg', 'jpeg', 'png'];

      if (!in_array($fileActualExt, $allowed)) {
          die("Invalid file type");
      }
      $file = $_FILES['postimage'];

      $postToUpload = $file['tmp_name'];
      $uploaded_post_url = uploadToCloudnary($postToUpload);

      $caption = $_POST['caption'];
      $user_id = $_SESSION['user_id'];

      $stmt = $pdo->prepare("INSERT INTO posts (user_id, image_url, caption) VALUES (?,?,?)");
      $succses1 =  $stmt->execute([$user_id,$uploaded_post_url,$caption]);
      // if($succses1){
      //   echo "Post Table Updated Succesgly";
      // }
      $stmt = $pdo->prepare("UPDATE users SET post_count = post_count + 1 WHERE id = ?");
      $succses2 =  $stmt->execute([$user_id]);
      // if($succses2){
      //   echo "user Table Updated Succesgly";
      // }
      header("Location: ../Controller/feed.controller.php");
      exit;
}
