<?php
require_once __DIR__ . '/db.php';

function dashboardStats() {
    global $connection;

    $stats = [];
    $queries = [
        'users' => 'SELECT COUNT(*) AS total FROM users',
        'products' => 'SELECT COUNT(*) AS total FROM products WHERE is_active = 1',
        'orders' => 'SELECT COUNT(*) AS total FROM orders',
        'messages' => 'SELECT COUNT(*) AS total FROM contact_messages',
        'custom_orders' => 'SELECT COUNT(*) AS total FROM custom_orders',
    ];

    foreach ($queries as $key => $sql) {
        $result = mysqli_query($connection, $sql);
        $stats[$key] = (int) mysqli_fetch_assoc($result)['total'];
    }

    return $stats;
}

function getAllProducts() {
    global $connection;
    $result = mysqli_query($connection, 'SELECT * FROM products ORDER BY is_active DESC, id ASC');
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function saveProduct($data) {
    global $connection;

    $id = (int) ($data['id'] ?? 0);
    $name = trim($data['name'] ?? '');
    $description = trim($data['description'] ?? '');
    $price = (float) ($data['price'] ?? 0);
    $imageUrl = trim($data['image_url'] ?? '');
    $category = trim($data['category'] ?? 'Gear');
    $stock = (int) ($data['stock'] ?? 0);
    $isActive = isset($data['is_active']) ? 1 : 0;

    if ($id > 0) {
        $stmt = mysqli_prepare($connection, 'UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, category = ?, stock = ?, is_active = ? WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'ssdssiii', $name, $description, $price, $imageUrl, $category, $stock, $isActive, $id);
        return mysqli_stmt_execute($stmt);
    }

    $stmt = mysqli_prepare($connection, 'INSERT INTO products (name, description, price, image_url, category, stock, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssdssii', $name, $description, $price, $imageUrl, $category, $stock, $isActive);
    return mysqli_stmt_execute($stmt);
}

function deleteProduct($id) {
    global $connection;
    $stmt = mysqli_prepare($connection, 'UPDATE products SET is_active = 0 WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}

function getAllOrders() {
    global $connection;
    $sql = 'SELECT orders.*, users.name AS customer_name, users.email AS customer_email
            FROM orders
            JOIN users ON users.id = orders.user_id
            ORDER BY orders.created_at DESC';
    $result = mysqli_query($connection, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getOrderItems($orderId) {
    global $connection;
    $stmt = mysqli_prepare($connection, 'SELECT * FROM order_items WHERE order_id = ? ORDER BY id ASC');
    mysqli_stmt_bind_param($stmt, 'i', $orderId);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
}

function updateOrderStatus($orderId, $status) {
    global $connection;
    $allowed = ['pending', 'completed', 'cancelled'];
    if (!in_array($status, $allowed, true)) {
        return false;
    }

    $stmt = mysqli_prepare($connection, 'UPDATE orders SET status = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $orderId);
    return mysqli_stmt_execute($stmt);
}

function getAllUsers() {
    global $connection;
    $result = mysqli_query($connection, 'SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC');
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function updateUserRole($userId, $role) {
    global $connection;
    $role = $role === 'admin' ? 'admin' : 'user';
    $stmt = mysqli_prepare($connection, 'UPDATE users SET role = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $role, $userId);
    return mysqli_stmt_execute($stmt);
}

function deleteUser($userId) {
    global $connection;
    $stmt = mysqli_prepare($connection, 'DELETE FROM users WHERE id = ? AND role != "admin"');
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    return mysqli_stmt_execute($stmt);
}

function getContactMessages() {
    global $connection;
    $result = mysqli_query($connection, 'SELECT * FROM contact_messages ORDER BY created_at DESC');
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getCustomOrders() {
    global $connection;
    $sql = 'SELECT custom_orders.*, users.name AS customer_name, users.email AS customer_email
            FROM custom_orders
            LEFT JOIN users ON users.id = custom_orders.user_id
            ORDER BY custom_orders.created_at DESC';
    $result = mysqli_query($connection, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function updateCustomOrderStatus($orderId, $status) {
    global $connection;
    $allowed = ['pending', 'completed', 'cancelled'];
    if (!in_array($status, $allowed, true)) {
        return false;
    }

    $stmt = mysqli_prepare($connection, 'UPDATE custom_orders SET status = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $orderId);
    return mysqli_stmt_execute($stmt);
}
?>
