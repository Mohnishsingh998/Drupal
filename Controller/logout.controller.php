<?php
    session_start();

    session_unset();

    session_destroy();

    // redirect to login
    header("Location: ../views/login.view.php");
    exit;
?>