<?php
require_once __DIR__ . '/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/register.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if ($name === '' || $email === '' || $password === '') {
    $_SESSION['register_error'] = 'Please fill in all required fields.';
    header('Location: ../frontend/register.php');
    exit;
}

if ($password !== $confirmPassword) {
    $_SESSION['register_error'] = 'Passwords do not match.';
    header('Location: ../frontend/register.php');
    exit;
}

if (!registerUser($name, $email, $password)) {
    $_SESSION['register_error'] = 'This email is already registered.';
    header('Location: ../frontend/register.php');
    exit;
}

$_SESSION['register_success'] = 'Account created. You can login now.';
header('Location: ../frontend/login.php');
exit;
?>
