<?php
require 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Check if user exists
    $check = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", [$username]);
    if (pg_num_rows($check) > 0) {
        $error = "Username already taken.";
    } else {
        $insert = pg_query_params($conn, "INSERT INTO users (username, password) VALUES ($1, $2)", [$username, $password]);
        if ($insert) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Sign Up</title></head>
<body>
<h2>Sign Up</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Sign Up</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
