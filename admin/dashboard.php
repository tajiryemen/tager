<?php
session_start();
require_once '../includes/functions.php';

if (!is_logged_in()) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p><a href="manage_ads.php">Manage Ads</a></p>
    <p><a href="../index.php">Home</a></p>
</body>
</html>
