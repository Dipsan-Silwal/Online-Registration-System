<?php

session_set_cookie_params(0);    //session cookie will end when browser is closed
session_start();

function check_login(): void
{
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit();
    }

    $timeout_in_seconds = 30; 
    $now = time();

    if (isset($_SESSION['login_time']) && ($now - (int)$_SESSION['login_time']) > $timeout_in_seconds) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

