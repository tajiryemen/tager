<?php
session_start();
require_once __DIR__ . '/db.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function sanitizeInput($input) {
    global $mysqli;
    return htmlspecialchars(trim($mysqli->real_escape_string($input)), ENT_QUOTES, 'UTF-8');
}

function formatDate($timestamp) {
    return date('Y-m-d H:i', strtotime($timestamp));
}
?>
