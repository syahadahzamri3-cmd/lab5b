<?php
session_start();
if (!isset($_SESSION['user'])) header('Location: login.php');
require 'db_connect.php';

$result = $mysqli->query("SELECT matric, name, role FROM users ORDER BY name ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Users List</h2>
<p>Welcome <?= $_SESSION['user']['name'] ?> (<?= $_SESSION['user']['role'] ?>) | <a href="logout.php">Logout</a></p>

<table border="1" cellpadding="6">
<tr>
    <th>Matric</th>
    <th>Name</th>
    <th>Role</th>
    <th>Action</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['matric'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['role'] ?></td>
    <td>
        <a href="update.php?matric=<?= $row['matric'] ?>">Update</a> |
        <a href="delete.php?matric=<?= $row['matric'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
<p><a href="register.php">Add new user</a></p>
</body>
</html>
