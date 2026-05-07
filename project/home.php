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
    <title>Home - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('home'); ?>

        <main class="shop-main">
            <div class="hero-section">
                <h2>Complete Scout Gear Collection</h2>
                <p>Premium uniforms, equipment, and accessories for every Scout adventure</p>
            </div>

            <div class="products-grid-home">
                <?php foreach ($products as $product): ?>
                    <div class="product-card-home" data-product-card>
                        <img src="<?php echo e($product['image_url']); ?>" alt="<?php echo e($product['name']); ?>" class="product-image">
                        <h3><?php echo e($product['name']); ?></h3>
                        <p class="price-box"><?php echo e(number_format((float) $product['price'], 2)); ?> $</p>
                        <button class="product-name" onclick="addToCart(<?php echo (int) $product['id']; ?>, '<?php echo e($product['name']); ?>', <?php echo (float) $product['price']; ?>)">Add to Cart</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <section class="customize-section">
                <h2>Create Your Custom Scout Order</h2>
                <p>Design your perfect scout uniform with custom colors, sizes, names, numbers, and badges.</p>
                <button class="btn-start-customize" onclick="window.location.href='customize.php'">Start Customizing Now</button>
            </section>

            <section class="featured-section">
                <h3>Why Choose Scout Shop?</h3>
                <div class="featured-grid">
                    <div class="featured-item"><span>OK</span><h4>Sustainable Materials</h4><p>Eco-friendly uniforms</p></div>
                    <div class="featured-item"><span>OK</span><h4>Fast Shipping</h4><p>Quick delivery</p></div>
                    <div class="featured-item"><span>OK</span><h4>Custom Design</h4><p>Personalize your order</p></div>
                    <div class="featured-item"><span>OK</span><h4>Best Quality</h4><p>Premium materials</p></div>
                </div>
            </section>
        </main>
    </div>

    <?php renderShopScripts(); ?>
</body>
</html>
