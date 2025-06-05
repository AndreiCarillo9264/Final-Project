<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
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
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/images/img_brand.png" alt="Brand Icon" style="height: 40px;"></a>
            <button class="btn btn-link menu-toggle-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#userMenuOffcanvas" aria-controls="userMenuOffcanvas">
                <img src="../assets/images/icon_menu.png" alt="Menu">
            </button>
        </div>
    </nav>
    <div class="offcanvas offcanvas-end custom-offcanvas" tabindex="-1" id="userMenuOffcanvas" aria-labelledby="userMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="userMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="">Profile</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="">Report</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="#" id="exportButton"><span class="nav-label" onclick="window.location.href='../backend/api/export-to-sheet.php'">Export to Google Sheets</span></a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logoutButton">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="home-page">
        <div class="contents">
            <div class="left-container">
                <h1>Smart Tracking for</h1>
                <h1>Smarter Production</h1>
                <h3>the smarter way to keep your inventory and production on track</h3>
            </div>
            <div class="right-container">
                <div class="brand-logo">
                    <img src="../assets/images/img_brand.png" alt="Brand Logo">
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/logout.js"></script>
</html>