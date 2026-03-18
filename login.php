<?php
include "session.php";

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

$admin_username = "";
$admin_password = "";


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim((string)$_POST['username']) : '';
    $password = isset($_POST['password']) ? trim((string)$_POST['password']) : '';

    if ($username == $admin_username && $password == $admin_password) {
        // Correct login
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['login_time'] = time();
        $_SESSION['last_activity'] = time();
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Registration System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page-wrapper">
    <header class="main-header">
        <h1>Online Registration Management System</h1>
    </header>

    <main class="content">
        <div class="form-card">
            <h2>Admin Login</h2>

            <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>

            <form action="login.php" method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username">
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password">
                </div>

                <button type="submit" class="btn btn-login">Login</button>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> Registration System | BSc CSIT Web Technology Project</p>
    </footer>
</div>
</body>
</html>

