<?php
// insert.php
// Receives form data from index.php and inserts a new user

include "session.php";
check_login();

include "setup_database.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $address = trim((string)($_POST['address'] ?? ''));
    $course = trim((string)($_POST['course'] ?? ''));

    // Basic validation
    if ($name === "" || $email === "" || $phone === "" || $address === "" || $course === "") {
        $_SESSION['flash_error'] = "All fields are required.";
        header("Location: index.php");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash_error'] = "Invalid email address.";
        header("Location: index.php");
        exit();
    }
    if (!preg_match('/^\d{10}$/', $phone)) {
        $_SESSION['flash_error'] = "Phone must be exactly 10 digits.";
        header("Location: index.php");
        exit();
    }

    // Simple (beginner) insert
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);
    $course = mysqli_real_escape_string($conn, $course);

    $sql = "INSERT INTO users (name, email, phone, address, course)
            VALUES ('$name', '$email', '$phone', '$address', '$course')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    }

    $_SESSION['flash_error'] = "Error inserting record.";
    header("Location: index.php");
    exit();
}
?>

