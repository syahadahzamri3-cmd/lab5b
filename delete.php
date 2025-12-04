<?php
// delete.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require 'db_connect.php';

if (!isset($_GET['matric'])) {
    header('Location: users.php');
    exit;
}

$matric = $_GET['matric'];

// Optional: prevent deleting yourself
if ($_SESSION['user']['matric'] === $matric) {
    header('Location: users.php?error=Cannot delete your own account.');
    exit;
}

$stmt = $mysqli->prepare("DELETE FROM users WHERE matric=?");
$stmt->bind_param("s", $matric);

if ($stmt->execute()) {
    $stmt->close();
    header('Location: users.php?msg=deleted');
    exit;
} else {
    $err = $mysqli->error;
    $stmt->close();
    die("Error deleting user: $err <br><a href='users.php'>Back</a>");
}
