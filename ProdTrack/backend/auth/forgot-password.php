<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

require "../config/connection.php";

$errors = [];

if (isset($_POST['changePassword'])) {
    $emailOrUserID = trim($_POST['emailOrUserID']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($emailOrUserID)) {
        $errors['emailOrUserID'] = "Email or ID is required!";
    }
    if (empty($newPassword)) {
        $errors['newPassword'] = "New Password is required!";
    } elseif (strlen($newPassword) < 8) {
        $errors['newPassword'] = "Password must be at least 8 characters long!";
    }
    if (empty($confirmPassword)) {
        $errors['confirmPassword'] = "Please confirm your password!";
    } elseif ($newPassword !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords do not match!";
    }

    if (count($errors) === 0) {
        $query = "SELECT id, passwordHash FROM users WHERE emailOrUserID = ?";
        $stmt = $connection->prepare($query);

        if ($stmt === false) {
            $errors['database'] = "Database error: " . $connection->error;
        } else {
            $stmt->bind_param("s", $emailOrUserID);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 0) {
                $errors['emailOrUserID'] = "No account found with this Email or ID!";
            } else {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE users SET passwordHash = ? WHERE emailOrUserID = ?";
                $updateStmt = $connection->prepare($updateQuery);

                if ($updateStmt === false) {
                    $errors['database'] = "Database error: " . $connection->error;
                } else {
                    $updateStmt->bind_param("ss", $newPasswordHash, $emailOrUserID);
                    if ($updateStmt->execute()) {
                        $_SESSION['success'] = "Your password has been successfully updated.";
                        header("Location: ../../pages/login.php");
                        exit();
                    } else {
                        $errors['database'] = "Failed to update password: " . $updateStmt->error;
                    }
                }
            }
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../pages/forgot-password.php");
        exit();
    }
}
?>