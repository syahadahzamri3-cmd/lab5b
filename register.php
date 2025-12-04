<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
     <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Registration</h2>
    <form action="register_process.php" method="post">
        <label>Matric:<br>
            <input type="text" name="matric" maxlength="10" required>
        </label><br><br>

        <label>Name:<br>
            <input type="text" name="name" maxlength="100" required>
        </label><br><br>

        <label>Password:<br>
            <input type="password" name="password" maxlength="255" required>
        </label><br><br>

        <label>Role:<br>
            <select name="role" required>
                <option value="">Please Select</option>
                <option value="student">student</option>
                <option value="lecturer">lecturer</option>
                <option value="admin">admin</option>
            </select>
        </label><br><br>

        <button type="submit">Submit</button>
    </form>
    <p><a href="login.php">Login here if you already have an account</a></p>
</body>
</html>
