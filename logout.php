<?php
// logout.php
// Destroy the session and redirect to login page

session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit();
?>

