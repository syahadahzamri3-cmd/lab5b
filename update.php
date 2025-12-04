<?php
session_start();
if (!isset($_SESSION['user'])) header('Location: login.php');
require 'db_connect.php';

if (!isset($_GET['matric'])) header('Location: users.php');
$matric = $_GET['matric'];

$stmt = $mysqli->prepare("SELECT matric, name, role FROM users WHERE matric=?");
$stmt->bind_param("s", $matric);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows !== 1) header('Location: users.php');
$user = $res->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Update User</h2>
<form action="update_process.php" method="post">
    <input type="hidden" name="matric" value="<?= $user['matric'] ?>">
    <label>Matric:<br><input type="text" name="matric_new" value="<?= $user['matric'] ?>" maxlength="10" required></label><br><br>
    <label>Name:<br><input type="text" name="name" value="<?= $user['name'] ?>" maxlength="100" required></label><br><br>
    <label>Password (leave blank to keep current):<br><input type="password" name="password"></label><br><br>
    <label>Role:<br>
        <select name="role" required>
            <option value="student" <?= $user['role']=='student'?'selected':'' ?>>student</option>
            <option value="lecturer" <?= $user['role']=='lecturer'?'selected':'' ?>>lecturer</option>
            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>admin</option>
        </select>
    </label><br><br>
    <button type="submit">Update</button>
</form>
<p><a href="users.php">Back</a></p>
</body>
</html>
