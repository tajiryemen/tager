<?php
require_once '../includes/functions.php';
require_admin_login();

// Approve ad
if (isset($_GET['approve'])) {
    $stmt = $pdo->prepare('UPDATE ads SET approved = 1 WHERE id = ?');
    $stmt->execute([$_GET['approve']]);
    header('Location: manage_ads.php');
    exit;
}

// Delete ad
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM ads WHERE id = ?');
    $stmt->execute([$_GET['delete']]);
    header('Location: manage_ads.php');
    exit;
}

// Edit ad
if (isset($_POST['edit_id'])) {
    $stmt = $pdo->prepare('UPDATE ads SET title = ?, description = ? WHERE id = ?');
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['edit_id']]);
    header('Location: manage_ads.php');
    exit;
}

$ads = $pdo->query('SELECT * FROM ads ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Ads</title>
</head>
<body>
    <h1>Manage Ads</h1>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Approved</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($ads as $ad): ?>
        <tr>
            <td><?php echo $ad['id']; ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="edit_id" value="<?php echo $ad['id']; ?>">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($ad['title']); ?>">
            </td>
            <td>
                    <input type="text" name="description" value="<?php echo htmlspecialchars($ad['description']); ?>">
            </td>
            <td><?php echo $ad['approved'] ? 'Yes' : 'No'; ?></td>
            <td>
                    <button type="submit">Save</button>
                </form>
                <?php if (!$ad['approved']): ?>
                    <a href="?approve=<?php echo $ad['id']; ?>">Approve</a>
                <?php endif; ?>
                <a href="?delete=<?php echo $ad['id']; ?>" onclick="return confirm('Delete this ad?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
