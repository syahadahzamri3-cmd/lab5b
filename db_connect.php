<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = ''; // your MySQL password
$db   = 'Lab_5b';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>
