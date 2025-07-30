<?php
session_start();
require_once 'includes/functions.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Profile</h1>
    <p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p><a href="add_ad.php">Add Ad</a></p>
    <p><a href="ads.php">View Ads</a></p>
</body>
</html>
