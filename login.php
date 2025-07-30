<?php
require_once 'includes/functions.php';
$error = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $phone = sanitizeInput($_POST['phone']);
    $pass  = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id,password,is_admin FROM users WHERE phone=?");
    $stmt->bind_param('s',$phone);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if($user && password_verify($pass,$user['password'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['is_admin']=$user['is_admin'];
        header('Location: profile.php'); exit;
    } else {
        $error = 'بيانات غير صحيحة';
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
<header>تسجيل الدخول</header>
<form method="post">
<p style="color:red;"><?=$error?></p>
<input type="text" name="phone" placeholder="رقم الجوال" required>
<input type="password" name="password" placeholder="كلمة المرور" required>
<button type="submit">دخول</button>
</form>
</body>
</html>
