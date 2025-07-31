<?php
require_once __DIR__ . '/db.php';

function sanitize(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function register_user(string $username, string $password): bool {
    $pdo = get_db_connection();
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    return $stmt->execute([$username, $hash]);
}

function login_user(string $username, string $password): bool {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function logout(): void {
    session_unset();
    session_destroy();
}

function add_ad(string $title, string $description, string $price, int $category_id): bool {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('INSERT INTO ads (user_id, category_id, title, description, price) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([
        $_SESSION['user_id'],
        $category_id,
        $title,
        $description,
        $price
    ]);
}

function get_ads(?int $category_id = null): array {
    $pdo = get_db_connection();
    if ($category_id) {
        $stmt = $pdo->prepare('SELECT * FROM ads WHERE category_id = ? ORDER BY created_at DESC');
        $stmt->execute([$category_id]);
    } else {
        $stmt = $pdo->query('SELECT * FROM ads ORDER BY created_at DESC');
    }
    return $stmt->fetchAll();
}

function get_ad(int $id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('SELECT * FROM ads WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function get_categories(): array {
    $pdo = get_db_connection();
    $stmt = $pdo->query('SELECT * FROM categories ORDER BY name');
    return $stmt->fetchAll();
}

function get_category(int $id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}
?>
