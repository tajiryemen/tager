<?php
session_start();
require_once 'includes/functions.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $desc  = sanitize($_POST['description'] ?? '');
    $price = sanitize($_POST['price'] ?? '');
    if ($title && $desc && $price !== '') {
        if (add_ad($title, $desc, $price)) {
            header('Location: ads.php');
            exit;
        } else {
            $error = 'Failed to add ad';
        }
    } else {
        $error = 'All fields required';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Ad</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Add Advertisement</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Title: <input type="text" name="title"></label><br>
        <label>Description:<br><textarea name="description"></textarea></label><br>
        <label>Price: <input type="text" name="price"></label><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
