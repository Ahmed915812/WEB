<?php
require_once __DIR__ . '/partials.php';

if (isLoggedIn()) {
    header('Location: home.php');
    exit;
}

$error = $_SESSION['login_error'] ?? '';
$success = $_SESSION['register_success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['register_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - Scout Shop</title>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo"><a href="home.php">Scout Shop</a></div>
            <nav class="navbar-menu">
                <a href="home.php" class="nav-link">Home</a>
                <a href="register.php" class="nav-link register-btn">Register</a>
            </nav>
        </div>
    </header>

    <main class="form-container">
        <div class="form-card">
            <h1>Login</h1>
            <?php if ($error): ?><div class="error-message"><?php echo e($error); ?></div><?php endif; ?>
            <?php if ($success): ?><div class="success-message"><?php echo e($success); ?></div><?php endif; ?>
            <form action="../backend/login_handler.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
            <div class="demo-info">
                <p><strong>Admin:</strong> <code>admin@scoutshop.com</code> / <code>admin123</code></p>
                <p><strong>User:</strong> <code>user@scoutshop.com</code> / <code>user123</code></p>
            </div>
        </div>
    </main>
</body>
</html>
