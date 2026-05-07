<?php
require_once __DIR__ . '/db.php';

function getActiveProducts() {
    global $connection;

    $result = mysqli_query($connection, 'SELECT * FROM products WHERE is_active = 1 ORDER BY id ASC');
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductById($id) {
    global $connection;

    $stmt = mysqli_prepare($connection, 'SELECT * FROM products WHERE id = ? AND is_active = 1 LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}
?>
