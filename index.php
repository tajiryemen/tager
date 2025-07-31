<?php
session_start();
require_once 'includes/functions.php';

$categories = get_categories();
$ads = get_ads();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tager - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to Tager</h1>
    <?php if (is_logged_in()): ?>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> |
        <a href="profile.php">Profile</a> |
        <a href="add_ad.php">Post Ad</a> |
        <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
    <?php endif; ?>

    <h2>Categories</h2>
    <ul>
    <?php foreach ($categories as $cat): ?>
        <li><a href="ads.php?category=<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></a></li>
    <?php endforeach; ?>
    </ul>

    <h2>Latest Ads</h2>
    <ul>
    <?php foreach ($ads as $ad): ?>
        <li><a href="ad_details.php?id=<?php echo $ad['id']; ?>">
            <?php echo htmlspecialchars($ad['title']); ?> - <?php echo htmlspecialchars($ad['price']); ?>
        </a></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
