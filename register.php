<?php
require_once 'includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = sanitizeInput($_POST['name']);
    $phone = sanitizeInput($_POST['phone']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $exists = $mysqli->query("SELECT id FROM users WHERE phone='$phone'")->num_rows;
    if($exists){
        $error='الرقم مسجل مسبقا';
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (name,phone,password,is_admin) VALUES (?,?,?,0)");
        $stmt->bind_param('sss',$name,$phone,$pass);
        $stmt->execute();
        header('Location: login.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>تسجيل جديد</header>
<form method="post">
<p style="color:red;"><?=$error?></p>
<input type="text" name="name" placeholder="الاسم" required>
<input type="text" name="phone" placeholder="رقم الجوال" required>
<input type="password" name="password" placeholder="كلمة المرور" required>
<button type="submit">تسجيل</button>
</form>
</body>
</html>
