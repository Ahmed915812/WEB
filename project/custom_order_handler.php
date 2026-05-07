<?php
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/customize.php');
    exit;
}

$userId = isLoggedIn() ? (int) $_SESSION['user_id'] : null;
$product = trim($_POST['product'] ?? '');
$color = trim($_POST['color'] ?? '');
$size = trim($_POST['size'] ?? '');
$logos = trim($_POST['logos'] ?? '');
$quantity = max(1, (int) ($_POST['quantity'] ?? 1));
$total = (float) ($_POST['total'] ?? 0);

if ($product === '' || $size === '') {
    header('Location: ../frontend/customize.php?error=1');
    exit;
}

$stmt = mysqli_prepare($connection, 'INSERT INTO custom_orders (user_id, product, color, size, logos, quantity, total) VALUES (?, ?, ?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'issssid', $userId, $product, $color, $size, $logos, $quantity, $total);
mysqli_stmt_execute($stmt);

header('Location: ../frontend/customize.php?sent=1');
exit;
?>
