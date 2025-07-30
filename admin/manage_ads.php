<?php
session_start();
require_once '../includes/functions.php';

if (!is_logged_in()) {
    header('Location: ../login.php');
    exit;
}

$ads = get_ads();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Ads</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Ads</h1>
    <ul>
    <?php foreach ($ads as $ad): ?>
        <li><?php echo htmlspecialchars($ad['title']); ?> - <?php echo htmlspecialchars($ad['price']); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
