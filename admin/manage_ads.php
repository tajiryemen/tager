<?php
require_once '../includes/functions.php';
if(!isAdmin()){ header('Location: ../login.php'); exit; }
$ads = $mysqli->query("SELECT a.*, u.name AS user, c.name AS category FROM ads a JOIN users u ON a.user_id=u.id JOIN categories c ON a.category_id=c.id ORDER BY a.created_at DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<script src="../js/scripts.js"></script>
</head>
<body>
<header>إدارة الإعلانات</header>
<table border="1" width="100%">
<tr><th>العنوان</th><th>المستخدم</th><th>القسم</th><th>إجراءات</th></tr>
<?php while($ad=$ads->fetch_assoc()): ?>
<tr>
<td><?=htmlspecialchars($ad['title'])?></td>
<td><?=htmlspecialchars($ad['user'])?></td>
<td><?=htmlspecialchars($ad['category'])?></td>
<td>
<a href="../ad_details.php?id=<?=$ad['id']?>">عرض</a> |
<a href="delete_ad.php?id=<?=$ad['id']?>" onclick="return confirmDelete();">حذف</a> |
<a href="feature_ad.php?id=<?=$ad['id']?>">تمييز</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
