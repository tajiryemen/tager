<?php
require_once 'includes/functions.php';
if(!isLoggedIn()) { header('Location: login.php'); exit; }

$cities = $mysqli->query("SELECT id,name FROM cities");
$cats = $mysqli->query("SELECT id,name FROM categories");

if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = sanitizeInput($_POST['title']);
    $desc  = sanitizeInput($_POST['description']);
    $price = floatval($_POST['price']);
    $city  = intval($_POST['city']);
    $cat   = intval($_POST['category']);
    $stmt = $mysqli->prepare("INSERT INTO ads (user_id,title,description,price,city_id,category_id,created_at) VALUES (?,?,?,?,?,?,NOW())");
    $stmt->bind_param('issdii', $_SESSION['user_id'], $title, $desc, $price, $city, $cat);
    $stmt->execute();
    $ad_id = $stmt->insert_id;
    if(!is_dir('uploads')) mkdir('uploads');
    foreach($_FILES['images']['tmp_name'] as $key=>$tmp){
        if($tmp){
            $name = time().'_'.$key.'.jpg';
            move_uploaded_file($tmp, 'uploads/'.$name);
            $mysqli->query("INSERT INTO ad_images (ad_id,image_path) VALUES ($ad_id,'$name')");
        }
    }
    header('Location: ad_details.php?id='.$ad_id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<script src="js/scripts.js"></script>
</head>
<body>
<header>إضافة إعلان</header>
<form method="post" enctype="multipart/form-data">
<input type="text" name="title" placeholder="العنوان" required>
<textarea name="description" placeholder="الوصف" required></textarea>
<input type="number" name="price" placeholder="السعر" required>
<select name="city" required>
<?php while($c=$cities->fetch_assoc()): ?>
<option value="<?=$c['id']?>"><?=$c['name']?></option>
<?php endwhile; ?>
</select>
<select name="category" required>
<?php while($c=$cats->fetch_assoc()): ?>
<option value="<?=$c['id']?>"><?=$c['name']?></option>
<?php endwhile; ?>
</select>
<input type="file" name="images[]" multiple onchange="previewImages(this, document.getElementById('preview'))">
<div id="preview"></div>
<button type="submit">حفظ</button>
</form>
</body>
</html>
