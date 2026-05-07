<?php
require_once __DIR__ . '/partials.php';

$sent = isset($_GET['sent']);
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scout-shop.css">
    <link rel="stylesheet" href="style.css">
    <title>Customize - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('customize'); ?>

        <main class="shop-main">
            <div class="customize-container">
                <h2>Customize Your Scout Gear</h2>
                <?php if ($sent): ?><div class="success-message">Custom order saved in the backend.</div><?php endif; ?>
                <?php if ($error): ?><div class="error-message">Please choose a product and size.</div><?php endif; ?>

                <form action="../backend/custom_order_handler.php" method="post" class="customize-panel" style="display: block;">
                    <div class="customize-content">
                        <div class="customize-preview">
                            <h3>Custom Order</h3>
                            <div class="preview-image">Scout</div>
                        </div>

                        <div class="customize-options">
                            <div class="customize-group">
                                <label>Product:</label>
                                <select id="customProduct" name="product" onchange="updateCustomTotal()" required>
                                    <option value="">Select Product</option>
                                    <option value="T-Shirt" data-price="12">T-Shirt</option>
                                    <option value="Jacket" data-price="25">Jacket</option>
                                    <option value="Pants" data-price="15">Pants</option>
                                </select>
                            </div>

                            <div class="customize-group">
                                <label>Color:</label>
                                <select name="color">
                                    <option>Red</option>
                                    <option>Blue</option>
                                    <option>White</option>
                                    <option>Gold</option>
                                    <option>Green</option>
                                    <option>Black</option>
                                </select>
                            </div>

                            <div class="customize-group">
                                <label>Size:</label>
                                <select name="size" required>
                                    <option value="">Select Size</option>
                                    <option>XS</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                </select>
                            </div>

                            <div class="customize-group">
                                <label>Add Logo:</label>
                                <input type="text" name="logos" placeholder="Scout Badge, Name, Troop Number">
                            </div>

                            <div class="customize-group">
                                <label>Quantity:</label>
                                <input type="number" id="customQuantity" name="quantity" min="1" max="10" value="1" onchange="updateCustomTotal()">
                            </div>

                            <div class="price-section">
                                <p>Total: <span id="customTotalLabel">$0.00</span></p>
                            </div>
                            <input type="hidden" id="customTotal" name="total" value="0">

                            <button class="add-to-cart-btn" type="submit">Save Custom Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php renderShopScripts(); ?>
    <script>
        function updateCustomTotal() {
            const select = document.getElementById('customProduct');
            const selected = select.options[select.selectedIndex];
            const price = Number(selected.dataset.price || 0);
            const quantity = Number(document.getElementById('customQuantity').value || 1);
            const total = price * quantity;
            document.getElementById('customTotal').value = total.toFixed(2);
            document.getElementById('customTotalLabel').textContent = '$' + total.toFixed(2);
        }
    </script>
</body>
</html>
