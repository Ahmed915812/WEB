<?php
require_once __DIR__ . '/partials.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scout-shop.css">
    <title>Parents Portal - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('parents'); ?>
        <main class="shop-main">
            <div class="parents-portal">
                <h2>Parents Portal</h2>
                <p>Welcome, <?php echo e($_SESSION['name']); ?>. Here you can follow scout updates and use quick actions.</p>
                <div class="portal-sections">
                    <div class="portal-section"><h3>Scout Progress Tracking</h3><p>Monitor badge progress and achievements.</p><button class="portal-btn">View Progress</button></div>
                    <div class="portal-section"><h3>Activity Calendar</h3><p>Stay updated with meetings and events.</p><button class="portal-btn">View Calendar</button></div>
                    <div class="portal-section"><h3>Communication Hub</h3><p>Connect with troop leaders and parents.</p><button class="portal-btn">Open Hub</button></div>
                    <div class="portal-section"><h3>Gear Recommendations</h3><p>Get personalized gear suggestions.</p><button class="portal-btn">Get Recommendations</button></div>
                </div>
            </div>
        </main>
    </div>
    <?php renderShopScripts(); ?>
</body>
</html>
