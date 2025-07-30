<?php
require_once 'includes/functions.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $mysqli->prepare("SELECT a.*, u.phone, c.name AS city FROM ads a JOIN users u ON a.user_id=u.id JOIN cities c ON a.city_id=c.id WHERE a.id=? LIMIT 1");
$stmt->bind_param('i',$id);
$stmt->execute();
$ad = $stmt->get_result()->fetch_assoc();
$images = $mysqli->query("SELECT image_path FROM ad_images WHERE ad_id={$id}");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><?=htmlspecialchars($ad['title'])?></header>
<div class="card">
<?php while($img = $images->fetch_assoc()): ?>
<img src="uploads/<?=htmlspecialchars($img['image_path'])?>" alt="">
<?php endwhile; ?>
<p><?=nl2br(htmlspecialchars($ad['description']))?></p>
<p>السعر: <?=htmlspecialchars($ad['price'])?></p>
<p>المدينة: <?=htmlspecialchars($ad['city'])?></p>
<p>تاريخ: <?=formatDate($ad['created_at'])?></p>
<p>الهاتف: <?=htmlspecialchars($ad['phone'])?></p>
<form method="post" action="report.php?id=<?=$ad['id']?>">
<button type="submit">إبلاغ</button>
</form>
</div>
</body>
</html>
