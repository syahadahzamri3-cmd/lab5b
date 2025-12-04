<?php
session_start();
$msg = '';
if (isset($_GET['msg']) && $_GET['msg'] === 'registered') $msg = 'Registration successful, please login.';
if (isset($_GET['error'])) $msg = $_GET['error'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Login</h2>
    <?php if($msg) echo "<p>$msg</p>"; ?>
    <form action="login_process.php" method="post">
        <label>Matric:<br><input type="text" name="matric" required></label><br><br>
        <label>Password:<br><input type="password" name="password" required></label><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Not registered? <a href="register.php">Register here</a></p>
</body>
</html>
