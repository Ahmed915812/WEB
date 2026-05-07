<?php
require_once __DIR__ . '/admin_partial.php';
$stats = dashboardStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Admin Dashboard - Scout Shop</title>
</head>
<body>
    <?php adminHeader('dashboard'); ?>
    <h1>Scout Shop Dashboard</h1>
    <div class="stats-grid">
        <div class="stat-card"><strong><?php echo (int) $stats['users']; ?></strong><span>Users</span></div>
        <div class="stat-card"><strong><?php echo (int) $stats['products']; ?></strong><span>Active Products</span></div>
        <div class="stat-card"><strong><?php echo (int) $stats['orders']; ?></strong><span>Orders</span></div>
        <div class="stat-card"><strong><?php echo (int) $stats['custom_orders']; ?></strong><span>Custom Orders</span></div>
        <div class="stat-card"><strong><?php echo (int) $stats['messages']; ?></strong><span>Messages</span></div>
    </div>
    <div class="demo-info">
        <p>Use this admin panel to manage Scout Shop products, checkout orders, custom uniform requests, users, and contact messages.</p>
    </div>
    <?php adminFooter(); ?>
</body>
</html>
