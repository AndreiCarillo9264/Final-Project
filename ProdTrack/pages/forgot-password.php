<?php
    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
    unset($_SESSION['errors']);

    if (isset($_SESSION['user_id'])) {
        header("Location: home.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProdTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/images/img_brand.png" alt="Brand Icon" style="height: 40px;"></a>
        </div>
    </nav>
    <div class="forgot-password-page">
        <div class="contents">
            <div class="forgot-password-container">
                <h1>Forgot Password</h1>
                <div class="underline"></div>
                <?php if (!empty($errors)): ?>
                    <div class="error-message">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="../backend/auth/forgot-password.php" method="post" novalidate>
                    <div class="input-box">
                        <div class="input-email">
                            <label for="emailOrUserID">Email or ID</label>
                            <input type="text" id="emailOrUserID" name="emailOrUserID" placeholder="Enter your Email or ID">
                        </div>
                        <div class="input-new-password">
                            <label for="newPassword">New Password</label>
                            <input type="password" id="newPassword" name="newPassword" placeholder="Enter your New Password">
                        </div>
                        <div class="none">
                            <label for="none">None</label>
                            <input type="text" id="none" placeholder="">
                        </div>
                        <div class="input-confirm-password">
                            <label for="confirmPassword">Confrim Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your New Password">
                        </div>
                    </div>
                    <button type="submit" name="changePassword">Change Password</button>
                </form>
                <div class="link-button">
                    <p>Remember already? <a href="login.php" class="login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>