<?php
$host = 'localhost';
$db   = 'tager_db';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Database connection error: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
?>
