<?php
// update_process.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric_old = $_POST['matric'];          // original matric (hidden field)
    $matric_new = trim($_POST['matric_new']); // new matric (could be changed)
    $name = trim($_POST['name']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Update password as well
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE users SET matric=?, name=?, password=?, role=? WHERE matric=?");
        $stmt->bind_param("sssss", $matric_new, $name, $hash, $role, $matric_old);
    } else {
        // Keep current password
        $stmt = $mysqli->prepare("UPDATE users SET matric=?, name=?, role=? WHERE matric=?");
        $stmt->bind_param("ssss", $matric_new, $name, $role, $matric_old);
    }

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: users.php?msg=updated');
        exit;
    } else {
        $err = $mysqli->error;
        $stmt->close();
        die("Error updating user: $err <br><a href='users.php'>Back</a>");
    }
} else {
    header('Location: users.php');
    exit;
}
