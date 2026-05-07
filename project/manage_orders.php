<?php
require_once __DIR__ . '/admin_partial.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateOrderStatus((int) $_POST['order_id'], $_POST['status'] ?? 'pending');
    header('Location: manage_orders.php');
    exit;
}

$orders = getAllOrders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Manage Orders - Scout Shop</title>
</head>
<body>
    <?php adminHeader('orders'); ?>
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?php echo (int) $order['id']; ?></td>
                    <td><?php echo e($order['customer_name']); ?><br><small><?php echo e($order['customer_email']); ?></small></td>
                    <td>
                        <?php foreach (getOrderItems((int) $order['id']) as $item): ?>
                            <div><?php echo e($item['product_name']); ?> x <?php echo (int) $item['quantity']; ?> = $<?php echo e(number_format((float) $item['subtotal'], 2)); ?></div>
                        <?php endforeach; ?>
                    </td>
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
