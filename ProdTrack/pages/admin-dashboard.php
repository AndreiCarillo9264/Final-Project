<?php require_once '../backend/includes/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProdTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/images/img_brand.png" alt="Brand Icon" style="height: 40px;"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#Home">HOME</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#ContactUs">CONTACT US</a>
                    </li>
                    <li class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, <?php echo htmlspecialchars($loggedInName); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="#" class="dropdown-item" id="profileButton"><span class="nav-label">Profile</span></a></li>
                            <li><a href="#" class="dropdown-item" id="settingsButton"><span class="nav-label">Settings</span></a></li>
                            <li><a href="#" class="dropdown-item" id="exportButton"><span class="nav-label" onclick="window.location.href='../backend/api/export-to-sheet.php'">Export to Google Sheets</span></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item" id="logoutButton"><span class="nav-label">Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="admin-dashboard-page">
        <div class="contents">
            <img src="../assets/images/img_inventory.png" alt="Inventory List" class="inventory-list">
            <img src="../assets/images/img_graph.png" alt="Product Graph" class="product-graph">
        </div>
    </div>
    <script src="../assets/js/logout.js"></script>
</body>
</html>