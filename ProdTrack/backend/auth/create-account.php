<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);
require "../config/connection.php";

$errors = [];

if (isset($_POST['createAccountButton'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $emailOrUserID = trim($_POST['emailOrUserID']);
    $password = $_POST['password'];

    if (empty($firstName)) {
        $errors['firstName'] = "First Name is required!";
    }
    if (empty($lastName)) {
        $errors['lastName'] = "Last Name is required!";
    }
    if (empty($emailOrUserID)) {
        $errors['emailOrUserID'] = "Email or ID is required!";
    } elseif (!filter_var($emailOrUserID, FILTER_VALIDATE_EMAIL)) {
        $errors['emailOrUserID'] = "Invalid email or ID format!";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required!";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long!";
    }

    if (count($errors) === 0) {
        $checkQuery = "SELECT id FROM users WHERE emailOrUserID = ?";
        $checkStmt = $connection->prepare($checkQuery);
        if ($checkStmt === false) {
            $errors['database'] = "Database error: " . $connection->error;
        } else {
            $checkStmt->bind_param("s", $emailOrUserID);
            $checkStmt->execute();
            $checkStmt->store_result();
            if ($checkStmt->num_rows > 0) {
                $errors['emailOrUserID'] = "This email or ID is already in used.";
            }
        }
    }
    if (count($errors) === 0) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (firstName, lastName, emailOrUserID, passwordHash) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssss", $firstName, $lastName, $emailOrUserID, $passwordHash);

            if ($stmt->execute()) {
                header("Location: ../../pages/login.php");
                exit();
            } else {
                $errors['database'] = "Database error: " . $stmt->error;
            }
        } else {
            $errors['database'] = "Database error: " . $connection->error;
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../pages/create-account.php");
        exit();
    }
}
?>