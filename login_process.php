<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT matric, name, password, role FROM users WHERE matric=?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            header('Location: users.php');
            exit;
        } else {
            header('Location: login.php?error=Invalid username or password');
            exit;
        }
    } else {
        header('Location: login.php?error=Invalid username or password');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
