<?php
// delete.php
// Deletes a user record from the database

include "session.php";
check_login();

include "setup_database.php";

// Check if ID is provided in query string
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
} else {
    // If no ID, go back to main page
    header("Location: index.php");
    exit();
}
?>

