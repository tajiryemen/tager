<?php
session_start();
require_once 'includes/functions.php';

$category_id = (int)($_GET['category'] ?? 0);
$category = $category_id ? get_category($category_id) : null;
$ads = get_ads($category_id ?: null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ads</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ads<?php echo $category ? ' - ' . htmlspecialchars($category['name']) : ''; ?></h1>
    <ul>
    <?php foreach ($ads as $ad): ?>
        <li><a href="ad_details.php?id=<?php echo $ad['id']; ?>"><?php echo htmlspecialchars($ad['title']); ?></a></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
