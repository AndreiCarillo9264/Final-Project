<?php
    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
    unset($_SESSION['errors']);
    $userType = isset($_GET['type']) && in_array($_GET['type'], ['user', 'admin']) 
        ? $_GET['type'] : 'user';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProdTrack</title>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../assets/images/img_brand.png" alt="Brand Icon" style="height: 40px;"></a>
        </div>
    </nav>
    <div class="login-page">
        <div class="contents">
            <div class="login-container">
                <h1>Sign In</h1>
                <div class="underline"></div>
                <?php if (!empty($errors)): ?>
                    <div class="error-message">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form action="../backend/auth/auth-login.php" method="post" novalidate>
                    <div class="input-box">
                        <input type="hidden" name="user_type" value="<?php echo htmlspecialchars($userType); ?>">
                        <div class="input-email">
                            <label for="emailOrUserID">Email or ID</label>
                            <input type="text" id="emailOrUserID" name="emailOrUserID" placeholder="Enter your Email or ID">
                        </div>
                        <div class="input-password">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your Password">
                        </div>
                    </div>
                    <div class="input-remember-me">
                        <input type="checkbox" name="rememberMe" id="rememberMe" name="rememberMe">
                        <label for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" name="loginButton">Log In</button>
                </form>
                <div class="link-button">
                    <p>Don't have an account yet? <a href="create-account.php" class="register">Register here</a></p>
                    <p><a href="forgot-password.php" class="forgot-password">Forgot Password</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>