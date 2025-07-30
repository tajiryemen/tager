<?php
require_once '../includes/functions.php';
if(!isAdmin()){ header('Location: ../login.php'); exit; }
$totalUsers = $mysqli->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$totalAds = $mysqli->query("SELECT COUNT(*) FROM ads")->fetch_row()[0];
$totalReports = $mysqli->query("SELECT COUNT(*) FROM reports")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>لوحة التحكم</header>
<p>المستخدمون: <?=$totalUsers?></p>
<p>الإعلانات: <?=$totalAds?></p>
<p>البلاغات: <?=$totalReports?></p>
<ul>
<li><a href="manage_ads.php">إدارة الإعلانات</a></li>
<li><a href="manage_users.php">إدارة المستخدمين</a></li>
<li><a href="manage_reports.php">إدارة البلاغات</a></li>
</ul>
</body>
</html>
