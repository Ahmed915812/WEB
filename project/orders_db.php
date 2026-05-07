<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/products_db.php';

function createOrder($userId, $items) {
    global $connection;

    if (empty($items)) {
        throw new Exception('Cart is empty.');
    }

    mysqli_begin_transaction($connection);

    try {
        $total = 0;
        $preparedItems = [];

        foreach ($items as $item) {
            $productId = (int) ($item['id'] ?? 0);
            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            $product = getProductById($productId);

            if (!$product) {
                throw new Exception('One of the products is no longer available.');
            }

            $subtotal = (float) $product['price'] * $quantity;
            $total += $subtotal;

            $preparedItems[] = [
                'product_id' => (int) $product['id'],
                'product_name' => $product['name'],
                'unit_price' => (float) $product['price'],
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        $stmt = mysqli_prepare($connection, 'INSERT INTO orders (user_id, total, status) VALUES (?, ?, "pending")');
        mysqli_stmt_bind_param($stmt, 'id', $userId, $total);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($connection);

        $stmt = mysqli_prepare($connection, 'INSERT INTO order_items (order_id, product_id, product_name, unit_price, quantity, subtotal) VALUES (?, ?, ?, ?, ?, ?)');

        foreach ($preparedItems as $item) {
            mysqli_stmt_bind_param(
                $stmt,
                'iisdis',
                $orderId,
                $item['product_id'],
                $item['product_name'],
                $item['unit_price'],
                $item['quantity'],
                $item['subtotal']
            );
            mysqli_stmt_execute($stmt);
        }

        mysqli_commit($connection);
        return $orderId;
    } catch (Throwable $error) {
        mysqli_rollback($connection);
        throw $error;
    }
}
?>
