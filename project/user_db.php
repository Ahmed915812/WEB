<?php
/**
 * WEEK 3 - USER DATABASE FUNCTIONS
 * 
 * This file contains functions for user profile management:
 * - getUserById($id) - Get user data by ID
 * - updateUser($id, $name, $email, $password) - Update user information
 * 
 * Use these functions in profile page to display and update user information.
 */

// Make database connection available in this file
require 'db.php';

/**
 * GET USER BY ID
 * 
 * @param int $id - The user ID to look up
 * @return array|null - Returns user data if found, NULL if not found
 * 
 * This function retrieves a user's information from the database.
 */
function getUserById($id) {
    global $connection;
    
    // SELECT user information WHERE id matches
    $query = "SELECT id, name, email, role FROM users WHERE id = '$id' LIMIT 1";
    
    // Execute the query
    $result = mysqli_query($connection, $query);
    
    // Check if user was found
    if (mysqli_num_rows($result) === 0) {
        return null;
    }
    
    // Return user data as associative array
    return mysqli_fetch_assoc($result);
}

/**
 * UPDATE USER
 * 
 * @param int $id - The user ID to update
 * @param string $name - The new name (or existing if not changing)
 * @param string $email - The new email (or existing if not changing)
 * @param string $password - The new password (or empty to keep existing)
 * @return bool - TRUE if update successful, FALSE if failed
 * 
 * This function updates a user's profile information.
 * If password is empty, the existing password is kept.
 */
function updateUser($id, $name, $email, $password = '') {
    global $connection;
    
    // Build the UPDATE query

    
    // Start with name and email in the UPDATE query
    $query = "UPDATE users SET name = '$name', email = '$email'";
    
    // Only update password if a new password was provided
    if (!empty($password)) {
        // Store the password as plain text (not hashed)
        // NOTE: In production, you should ALWAYS hash passwords for security!
        // Add password to the UPDATE query
        $query .= ", password = '$password'";
    }
    
    // Complete the query with WHERE clause
    $query .= " WHERE id = '$id'";
    
    // Execute the update query
    if (mysqli_query($connection, $query)) {
        return true;
    }
    
    return false;
}

?>
