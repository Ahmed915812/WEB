<?php
require_once __DIR__ . '/partials.php';

if (isLoggedIn()) {
    header('Location: home.php');
    exit;
}

$error = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register - Scout Shop</title>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo"><a href="home.php">Scout Shop</a></div>
            <nav class="navbar-menu">
                <a href="home.php" class="nav-link">Home</a>
                <a href="login.php" class="nav-link register-btn">Login</a>
            </nav>
        </div>
    </header>

    <main class="form-container">
        <div class="form-card">
            <h1>Create Account</h1>
            <?php if ($error): ?><div class="error-message"><?php echo e($error); ?></div><?php endif; ?>
            <form action="../backend/register_handler.php" method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button class="btn btn-primary" type="submit">Register</button>
            </form>
        </div>
    </main>
</body>
</html>
