<?php
require_once __DIR__ . '/partials.php';

$sent = isset($_GET['sent']);
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scout-shop.css">
    <link rel="stylesheet" href="style.css">
    <title>Contact Us - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('contact'); ?>

        <main class="shop-main">
            <div class="contact-section">
                <h2>Contact Us</h2>
                <?php if ($sent): ?><div class="success-message">Message sent to the PHP backend.</div><?php endif; ?>
                <?php if ($error): ?><div class="error-message">Please fill all contact fields.</div><?php endif; ?>

                <div class="contact-content">
                    <div class="contact-info">
                        <div class="contact-item"><h3>Phone</h3><p>+20 1000121314</p></div>
                        <div class="contact-item"><h3>Email</h3><p>troop@scouts.eg</p></div>
                        <div class="contact-item"><h3>Instagram</h3><p>@ProltisScouts</p></div>
                    </div>

                    <div class="contact-form">
                        <h3>Send us a Message</h3>
                        <form action="../backend/contact_handler.php" method="post">
                            <input type="text" name="name" placeholder="Your Name" required>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
                            <button type="submit" class="submit-contact-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php renderShopScripts(); ?>
</body>
</html>
