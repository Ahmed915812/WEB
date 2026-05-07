<?php
require_once __DIR__ . '/partials.php';
requireLogin();

$user = currentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profile - Scout Shop</title>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo"><a href="home.php">Scout Shop</a></div>
            <nav class="navbar-menu">
                <a href="home.php" class="nav-link">Home</a>
                <?php if (isAdmin()): ?><a href="../admin/index.php" class="nav-link">Admin</a><?php endif; ?>
                <a href="logout.php" class="nav-link logout-btn">Logout</a>
            </nav>
        </div>
    </header>

    <main class="form-container">
        <div class="form-card">
            <h1>My Profile</h1>
            <div class="user-info">
                <p><strong>Name:</strong> <?php echo e($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo e($user['email']); ?></p>
                <p><strong>Role:</strong> <?php echo e($user['role']); ?></p>
            </div>
            <div class="form-footer">
                <a class="btn btn-primary" href="products.php">Continue Shopping</a>
            </div>
        </div>
    </main>
</body>
</html>
