<?php

session_set_cookie_params(0);    //session cookie willend when browser is closed
session_start();

function check_login(): void
{
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit();
    }

    
    $timeout_in_seconds = 60; // it will log out after 1 minute
    $now = time();

    if (isset($_SESSION['last_activity']) && ($now - (int)$_SESSION['last_activity']) > $timeout_in_seconds) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    $_SESSION['last_activity'] = $now;
}

