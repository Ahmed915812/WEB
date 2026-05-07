<?php
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/contact.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name !== '' && $email !== '' && $message !== '') {
    $stmt = mysqli_prepare($connection, 'INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $message);
    mysqli_stmt_execute($stmt);
    header('Location: ../frontend/contact.php?sent=1');
    exit;
}

header('Location: ../frontend/contact.php?error=1');
exit;
?>
