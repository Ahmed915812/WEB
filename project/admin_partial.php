<?php
require_once __DIR__ . '/../backend/auth.php';
require_once __DIR__ . '/../backend/admin_db.php';

requireAdmin();

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function adminHeader($active = 'dashboard') {
    $links = [
        'dashboard' => ['Dashboard', 'index.php'],
        'products' => ['Products', 'manage_products.php'],
        'orders' => ['Orders', 'manage_orders.php'],
        'custom' => ['Custom Orders', 'manage_custom_orders.php'],
        'users' => ['Users', 'manage_users.php'],
        'messages' => ['Messages', 'messages.php'],
    ];
    ?>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo"><a href="index.php">Scout Admin</a></div>
            <nav class="navbar-menu">
                <a href="../frontend/home.php" class="nav-link">Store</a>
                <a href="../frontend/logout.php" class="nav-link logout-btn">Logout</a>
            </nav>
        </div>
    </header>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h3>Admin</h3>
            <?php foreach ($links as $key => $link): ?>
                <a class="<?php echo $active === $key ? 'active' : ''; ?>" href="<?php echo e($link[1]); ?>"><?php echo e($link[0]); ?></a>
            <?php endforeach; ?>
        </aside>
        <main class="admin-content">
    <?php
}

function adminFooter() {
    echo '</main></div>';
}
?>
