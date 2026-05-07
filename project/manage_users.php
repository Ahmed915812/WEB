<?php
require_once __DIR__ . '/admin_partial.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['action'] ?? '') === 'delete') {
        deleteUser((int) $_POST['user_id']);
    } else {
        updateUserRole((int) $_POST['user_id'], $_POST['role'] ?? 'user');
    }
    header('Location: manage_users.php');
    exit;
}

$users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Manage Users - Scout Shop</title>
</head>
<body>
    <?php adminHeader('users'); ?>
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <form method="post">
                        <td><?php echo (int) $user['id']; ?><input type="hidden" name="user_id" value="<?php echo (int) $user['id']; ?>"></td>
                        <td><?php echo e($user['name']); ?></td>
                        <td><?php echo e($user['email']); ?></td>
                        <td>
                            <select name="role">
                                <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>user</option>
                                <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>admin</option>
                            </select>
                        </td>
                        <td><?php echo e($user['created_at']); ?></td>
                        <td>
                            <button class="btn btn-secondary" type="submit">Save</button>
                            <?php if ($user['role'] !== 'admin'): ?>
                                <button class="btn btn-danger" name="action" value="delete" type="submit">Delete</button>
                            <?php endif; ?>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php adminFooter(); ?>
</body>
</html>
