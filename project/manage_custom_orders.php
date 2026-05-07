<?php
require_once __DIR__ . '/admin_partial.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateCustomOrderStatus((int) $_POST['order_id'], $_POST['status'] ?? 'pending');
    header('Location: manage_custom_orders.php');
    exit;
}

$orders = getCustomOrders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Custom Orders - Scout Shop</title>
</head>
<body>
    <?php adminHeader('custom'); ?>
    <h1>Custom Orders</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Customer</th><th>Product</th><th>Details</th><th>Total</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?php echo (int) $order['id']; ?></td>
                    <td><?php echo e($order['customer_name'] ?: 'Guest'); ?><br><small><?php echo e($order['customer_email'] ?: 'No login'); ?></small></td>
                    <td><?php echo e($order['product']); ?></td>
                    <td>Color: <?php echo e($order['color']); ?><br>Size: <?php echo e($order['size']); ?><br>Logos: <?php echo e($order['logos']); ?><br>Qty: <?php echo (int) $order['quantity']; ?></td>
                    <td>$<?php echo e(number_format((float) $order['total'], 2)); ?></td>
                    <td>
                        <form method="post" class="inline-form">
                            <input type="hidden" name="order_id" value="<?php echo (int) $order['id']; ?>">
                            <select name="status">
                                <?php foreach (['pending', 'completed', 'cancelled'] as $status): ?>
                                    <option value="<?php echo e($status); ?>" <?php echo $order['status'] === $status ? 'selected' : ''; ?>><?php echo e($status); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-secondary" type="submit">Save</button>
                        </form>
                    </td>
                    <td><?php echo e($order['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php adminFooter(); ?>
</body>
</html>
