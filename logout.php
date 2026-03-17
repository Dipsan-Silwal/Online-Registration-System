<?php
// logout.php
// Destroy the session and redirect to login page

session_start();

// Clear all session variables
$_SESSION = [];

// Remove the session cookie (important in some browsers)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destroy the session data on server
session_destroy();

header("Location: login.php");
exit();
?>