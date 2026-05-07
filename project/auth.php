<?php
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loginUser($email, $password) {
    global $connection;

    $stmt = mysqli_prepare($connection, 'SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        return false;
    }

    $storedPassword = $user['password'];
    $passwordMatches = password_verify($password, $storedPassword) || hash_equals($storedPassword, $password);

    if (!$passwordMatches) {
        return false;
    }

    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    return true;
}

function registerUser($name, $email, $password) {
    global $connection;

    $stmt = mysqli_prepare($connection, 'SELECT id FROM users WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($result)) {
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';
    $stmt = mysqli_prepare($connection, 'INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $hashedPassword, $role);

    return mysqli_stmt_execute($stmt);
}

function logoutUser() {
    $_SESSION = [];
    session_destroy();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../frontend/login.php');
        exit;
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        header('Location: ../frontend/login.php');
        exit;
    }
}

function currentUser() {
    if (!isLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['name'],
        'email' => $_SESSION['email'],
        'role' => $_SESSION['role'],
    ];
}
?>
