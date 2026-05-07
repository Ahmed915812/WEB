<?php
require_once __DIR__ . '/admin_partial.php';
$messages = getContactMessages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style.css">
    <title>Messages - Scout Shop</title>
</head>
<body>
    <?php adminHeader('messages'); ?>
    <h1>Contact Messages</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td>#<?php echo (int) $message['id']; ?></td>
                    <td><?php echo e($message['name']); ?></td>
                    <td><?php echo e($message['email']); ?></td>
                    <td><?php echo nl2br(e($message['message'])); ?></td>
                    <td><?php echo e($message['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php adminFooter(); ?>
</body>
</html>
