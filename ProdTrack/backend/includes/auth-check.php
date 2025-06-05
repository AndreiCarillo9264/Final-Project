<?php
    session_start([
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'use_strict_mode' => true,
    ]);

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    exit();
    }

    $loggedInName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : $_SESSION['email_or_id'];
?>