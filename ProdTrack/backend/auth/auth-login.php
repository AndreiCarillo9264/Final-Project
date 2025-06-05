<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

require "../config/connection.php";

$errors = [];

if (isset($_POST['loginButton'])) {
    $emailOrUserID = trim($_POST['emailOrUserID']);
    $password = $_POST['password'];
    $userType = $_POST['user_type'] ?? 'user';

    if (empty($emailOrUserID)) {
        $errors['emailOrUserID'] = "Email or ID is required!";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required!";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE emailOrUserID = ?";
        $stmt = $connection->prepare($query);

        if ($stmt === false) {
            $errors['database'] = "Database error: " . $connection->error;
        } else {
            $stmt->bind_param("s", $emailOrUserID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['passwordHash'])) {

                    if ($userType === 'admin' && $user['role'] !== 'admin') {
                        $errors['access'] = "You do not have permission to log in as an admin.";
                    } else {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['first_name'] = $user['firstName'];
                        $_SESSION['last_name'] = $user['lastName'];
                        $_SESSION['email_or_id'] = $user['emailOrUserID'];
                        $_SESSION['user_type'] = $user['role'];

                        if ($userType === 'admin') {
                            header("Location: ../../pages/admin-dashboard.php");
                        } else {
                            header("Location: ../../pages/home.php");
                        }
                        exit();
                    }
                } else {
                    $errors['password'] = "Incorrect password!";
                }
            } else {
                $errors['emailOrUserID'] = "No account found with this email or ID!";
            }
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../pages/login.php?type=" . $userType);
        exit();
    }
}
?>