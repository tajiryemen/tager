<?php
require_once 'includes/functions.php';
$where = [];
if(isset($_GET['category'])) $where[] = 'a.category_id='.(int)$_GET['category'];
if(isset($_GET['city'])) $where[] = 'a.city_id='.(int)$_GET['city'];
if(isset($_GET['min_price'])) $where[] = 'a.price>='.(float)$_GET['min_price'];
if(isset($_GET['max_price'])) $where[] = 'a.price<='.(float)$_GET['max_price'];
$whereSql = $where ? 'WHERE '.implode(' AND ',$where) : '';
$sql = "SELECT a.*, c.name AS city, (SELECT image_path FROM ad_images WHERE ad_id=a.id LIMIT 1) AS main_image FROM ads a JOIN cities c ON a.city_id=c.id $whereSql ORDER BY a.created_at DESC";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>البحث في الإعلانات</header>
<div class="cards">
<?php while($ad=$result->fetch_assoc()): ?>
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
