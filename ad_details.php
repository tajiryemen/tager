<?php
session_start();
require_once 'includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
$ad = get_ad($id);
if (!$ad) {
    die('Ad not found');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($ad['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($ad['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($ad['description'])); ?></p>
    <p>Price: <?php echo htmlspecialchars($ad['price']); ?></p>
</body>
</html>
