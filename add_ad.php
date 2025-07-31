<?php
session_start();
require_once 'includes/functions.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$categories = get_categories();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $desc  = sanitize($_POST['description'] ?? '');
    $price = sanitize($_POST['price'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    if ($title && $desc && $price !== '' && $category_id) {
        if (add_ad($title, $desc, $price, $category_id)) {
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
        <label>Category:
            <select name="category_id">
                <option value="">Select category</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Title: <input type="text" name="title"></label><br>
        <label>Description:<br><textarea name="description"></textarea></label><br>
        <label>Price: <input type="text" name="price"></label><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
