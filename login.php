<?php
// login.php
// Simple admin login using PHP sessions

session_start();

// If already logged in, go directly to main page
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

// Simple hard-coded admin credentials
$admin_username = "admin";
$admin_password = "admin123";

$error = "";
$old_username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = isset($_POST['username']) ? trim((string)$_POST['username']) : "";
    $password = isset($_POST['password']) ? trim((string)$_POST['password']) : "";
    $old_username = $username;

    // Check credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Correct login – store in session
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Wrong login
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
        <h1>Simple Online Registration Management System</h1>
        <nav class="nav-bar">
            <span>Admin Login</span>
        </nav>
    </header>

    <main class="content">
        <div class="form-card">
            <h2>Admin Login</h2>

            <?php if (!empty($error)) : ?>
                <p class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($old_username, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
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

