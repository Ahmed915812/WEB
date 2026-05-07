<?php require_once __DIR__ . '/partials.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scout-shop.css">
    <title>Activities - Scout Shop</title>
</head>
<body>
    <div class="shop-container">
        <?php renderShopHeader('activities', 'Search activities...'); ?>
        <main class="shop-main">
            <h2 style="color: white; text-align: center; margin-bottom: 40px;">Scout Activities</h2>
            <div class="activities-container">
                <div class="activity-section">
                    <div class="activity-header"><div class="activity-title-box outdoor">Outdoor Activities</div></div>
                    <div class="activity-content-detailed">
                        <div class="activity-item"><h4>Campfire Building</h4><p>Learning safety and techniques for starting and maintaining a fire.</p></div>
                        <div class="activity-item"><h4>Hiking and Scavenger Hunt</h4><p>Exploring nature while finding specific items or locations.</p></div>
                        <div class="activity-item"><h4>Tent Pitching Races</h4><p>Speed-based challenges for setting up and taking down campsites.</p></div>
                    </div>
                </div>
                <div class="activity-section">
                    <div class="activity-header"><div class="activity-title-box indoor">Indoor Activities</div></div>
                    <div class="activity-content-detailed">
                        <div class="activity-item"><h4>Knot-tying Relay Races</h4><p>Competitive games focused on scout hitches and bends.</p></div>
                        <div class="activity-item"><h4>First Aid Skill Stations</h4><p>Hands-on practice for bandaging and emergency response.</p></div>
                        <div class="activity-item"><h4>Map and Compass Orienteering</h4><p>Learning to read coordinates and navigate using a compass.</p></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php renderShopScripts(); ?>
</body>
</html>
