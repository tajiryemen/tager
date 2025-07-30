<?php
session_start();
require_once 'includes/functions.php';

$ads = get_ads();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ads</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ads</h1>
    <ul>
    <?php foreach ($ads as $ad): ?>
        <li><a href="ad_details.php?id=<?php echo $ad['id']; ?>"><?php echo htmlspecialchars($ad['title']); ?></a></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
