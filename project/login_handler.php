<?php
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (loginUser($email, $password)) {
    header(isAdmin() ? 'Location: ../admin/index.php' : 'Location: ../frontend/home.php');
    exit;
}

$_SESSION['login_error'] = 'Invalid email or password.';
header('Location: ../frontend/login.php');
exit;
?>
