<?php
    require_once '../config/dbconfig.php';
    class userModel{
      private $pdo;
      private $table = 'users';

      private function __construct(){
        // use the existing PDO
        global $pdo;
        $this->pdo = $pdo;
      }

      private function create($username ,$password,$email,$about,$profilurl){
        
      }
    }
?>