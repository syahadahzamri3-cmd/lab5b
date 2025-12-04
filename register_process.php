<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $matric, $name, $hash, $role);

    if ($stmt->execute()) {
        header("Location: login.php?msg=registered");
        exit;
    } else {
        die("Error: " . $mysqli->error);
    }
} else {
    header('Location: register.php');
    exit;
}
