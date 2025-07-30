<?php
session_start();
require_once __DIR__ . '/db.php';

function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_admin_login() {
    if (!is_admin_logged_in()) {
        header('Location: dashboard.php');
        exit;
    }
}
?>
