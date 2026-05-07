<?php
require_once __DIR__ . '/admin_partial.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['action'] ?? '') === 'delete') {
        deleteProduct((int) $_POST['id']);
    } else {
        saveProduct($_POST);
    }
    header('Location: manage_products.php');
    exit;
}

$products = getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Manage Products - Scout Shop</title>
</head>
<body>
    <?php adminHeader('products'); ?>
    <h1>Manage Products</h1>

    <div class="form-card wide-card">
        <h2>Add Product</h2>
        <form method="post" class="admin-form-grid">
            <input type="hidden" name="id" value="0">
            <div class="form-group"><label>Name</label><input name="name" required></div>
            <div class="form-group"><label>Price</label><input name="price" type="number" min="0" step="0.01" required></div>
            <div class="form-group"><label>Image URL</label><input name="image_url" placeholder="../product.png" required></div>
            <div class="form-group"><label>Category</label><input name="category" value="Gear" required></div>
            <div class="form-group"><label>Stock</label><input name="stock" type="number" min="0" value="10" required></div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="2"></textarea></div>
            <label class="checkbox-line"><input type="checkbox" name="is_active" checked> Active</label>
            <button class="btn btn-primary" type="submit">Save Product</button>
        </form>
    </div>

    <table>
        <thead>
            <tr><th>ID</th><th>Product</th><th>Price</th><th>Category</th><th>Stock</th><th>Status</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <form method="post">
                        <td>
                            <?php echo (int) $product['id']; ?>
                            <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                        </td>
                        <td>
                            <input name="name" value="<?php echo e($product['name']); ?>" required>
                            <textarea name="description" rows="2"><?php echo e($product['description']); ?></textarea>
                            <input name="image_url" value="<?php echo e($product['image_url']); ?>" required>
                        </td>
                        <td><input name="price" type="number" min="0" step="0.01" value="<?php echo e($product['price']); ?>" required></td>
                        <td><input name="category" value="<?php echo e($product['category']); ?>" required></td>
                        <td><input name="stock" type="number" min="0" value="<?php echo (int) $product['stock']; ?>" required></td>
                        <td><label><input type="checkbox" name="is_active" <?php echo $product['is_active'] ? 'checked' : ''; ?>> Active</label></td>
                        <td>
                            <button class="btn btn-secondary" type="submit">Update</button>
                            <button class="btn btn-danger" name="action" value="delete" type="submit">Hide</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php adminFooter(); ?>
</body>
</html>
