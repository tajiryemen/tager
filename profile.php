<?php
require_once 'includes/functions.php';
if(!isLoggedIn()) { header('Location: login.php'); exit; }
$userId = $_SESSION['user_id'];
$ads = $mysqli->query("SELECT a.*, c.name AS city FROM ads a JOIN cities c ON a.city_id=c.id WHERE a.user_id=$userId ORDER BY a.created_at DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<script src="js/scripts.js"></script>
</head>
<body>
<header>الملف الشخصي</header>
<a href="add_ad.php">إضافة إعلان جديد</a>
<div class="cards">
<?php while($ad = $ads->fetch_assoc()): ?>
<div class="card">
<h3><?=htmlspecialchars($ad['title'])?></h3>
<p>السعر: <?=htmlspecialchars($ad['price'])?></p>
<p>المدينة: <?=htmlspecialchars($ad['city'])?></p>
<a href="ad_details.php?id=<?=$ad['id']?>">عرض</a> |
<a href="edit_ad.php?id=<?=$ad['id']?>">تعديل</a> |
<a href="delete_ad.php?id=<?=$ad['id']?>" onclick="return confirmDelete();">حذف</a>
</div>
<?php endwhile; ?>
</div>
</body>
</html>
