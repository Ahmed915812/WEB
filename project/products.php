<?php
require_once __DIR__ . '/../backend/products_db.php';
require_once __DIR__ . '/partials.php';

$products = getActiveProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scout-shop.css">
    <title>Products - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('products', 'Search products...'); ?>

        <main class="shop-main">
            <div class="hero-section">
                <h2>Scout Products</h2>
                <p>Products are loaded from the PHP/MySQL backend.</p>
            </div>

            <div class="products-grid-home">
                <?php foreach ($products as $product): ?>
                    <div class="product-card-home" data-product-card>
                        <img src="<?php echo e($product['image_url']); ?>" alt="<?php echo e($product['name']); ?>" class="product-image">
                        <h3><?php echo e($product['name']); ?></h3>
                        <p><?php echo e($product['category']); ?> - Stock: <?php echo (int) $product['stock']; ?></p>
                        <p class="price-box"><?php echo e(number_format((float) $product['price'], 2)); ?> $</p>
                        <button class="product-name" onclick="addToCart(<?php echo (int) $product['id']; ?>, '<?php echo e($product['name']); ?>', <?php echo (float) $product['price']; ?>)">Add to Cart</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <?php renderShopScripts(); ?>
</body>
</html>
