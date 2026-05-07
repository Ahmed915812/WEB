<?php
/**
 * PROFILE HANDLER
 * 
 * This file handles profile update form submissions from frontend/profile.php
 * It validates inputs, updates the user, and redirects accordingly.
 */

require 'auth.php';
require 'user_db.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: ../frontend/login.php");
    exit;
}

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate: name and email must be provided
    if (empty($name) || empty($email)) {
        $_SESSION['profile_error'] = "Name and email are required";
        header("Location: ../frontend/profile.php");
        exit;
    }

    // If password is provided, check that both passwords match
    if (!empty($password) && $password !== $confirm_password) {
        $_SESSION['profile_error'] = "Passwords do not match";
        header("Location: ../frontend/profile.php");
        exit;
    }

    // Try to update user
    if (updateUser($_SESSION['user_id'], $name, $email, $password)) {
        // Update successful! Refresh user data in session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['profile_success'] = "Profile updated successfully!";
        header("Location: ../frontend/profile.php");
        exit;
    } else {
        $_SESSION['profile_error'] = "Failed to update profile";
        header("Location: ../frontend/profile.php");
        exit;
    }
}

// If no POST data, redirect to profile page
header("Location: ../frontend/profile.php");
exit;
?>
