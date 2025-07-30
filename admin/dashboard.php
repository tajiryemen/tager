<?php
require_once '../includes/functions.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ? AND is_admin = 1 LIMIT 1');
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $admin = $stmt->fetch();
    if ($admin) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = 'Invalid credentials';
    }
}

if (!is_admin_logged_in()) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
    </head>
    <body>
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
        <form method="post">
            <label>Username: <input type="text" name="username"></label><br>
            <label>Password: <input type="password" name="password"></label><br>
            <button type="submit">Login</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Logged in - display dashboard stats
$adsCount = $pdo->query('SELECT COUNT(*) FROM ads')->fetchColumn();
$usersCount = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Total Ads: <?php echo $adsCount; ?></p>
    <p>Total Users: <?php echo $usersCount; ?></p>
    <p><a href="manage_ads.php">Manage Ads</a></p>
</body>
</html>
