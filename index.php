<?php
require_once 'includes/functions.php';
$query = "SELECT a.*, c.name AS city, (SELECT image_path FROM ad_images WHERE ad_id=a.id LIMIT 1) AS main_image FROM ads a JOIN cities c ON a.city_id=c.id ORDER BY a.created_at DESC LIMIT 20";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>تاجر - الإعلانات الحديثة</title>
</head>
<body>
<header>آخر الإعلانات</header>
<div class="cards">
<?php while($ad = $result->fetch_assoc()): ?>
<div class="card">
<img src="uploads/<?=htmlspecialchars($ad['main_image'])?>" alt="">
<h3><?=htmlspecialchars($ad['title'])?></h3>
<p>السعر: <?=htmlspecialchars($ad['price'])?></p>
<p>المدينة: <?=htmlspecialchars($ad['city'])?></p>
<a href="ad_details.php?id=<?=$ad['id']?>">تفاصيل</a>
</div>
<?php endwhile; ?>
</div>
</body>
</html>
