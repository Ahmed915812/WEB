<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/orders_db.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Please login before checkout.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$payload = json_decode(file_get_contents('php://input'), true);
$items = $payload['items'] ?? [];

try {
    $orderId = createOrder((int) $_SESSION['user_id'], $items);
    echo json_encode(['success' => true, 'order_id' => $orderId]);
} catch (Throwable $error) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $error->getMessage()]);
}
?>
