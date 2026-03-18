<?php
include "session.php";
check_login();

include "setup_database.php";

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$course = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $address = trim((string)($_POST['address'] ?? ''));
    $course = trim((string)($_POST['course'] ?? ''));

    // Basic validation
    if ($name === "" || $email === "" || $phone === "" || $address === "" || $course === "") {
        $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $message = "Phone must be exactly 10 digits.";
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $address = mysqli_real_escape_string($conn, $address);
        $course = mysqli_real_escape_string($conn, $course);

        $sql = "UPDATE users
                SET name='$name', email='$email', phone='$phone', address='$address', course='$course'
                WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit();
        }
        $message = "Error updating record.";
    }
} else {
    // If not posting, we are opening the page to edit a record
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $course = $row['course'];
        } else {
            $message = "Record not found.";
        }
    } else {
        $message = "No user ID provided.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit User - Registration System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page-wrapper">
    <header class="main-header">
        <h1>Simple Online Registration Management System</h1>
        <nav class="nav-bar">
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="content">
        <section class="form-card">
            <h2>Edit User</h2>

            <?php if (!empty($message)) : ?>
                <p class="info-message"><?php echo $message; ?></p>
            <?php endif; ?>

            <?php if (!empty($id) && empty($message)) : ?>
                <form action="update.php" method="post">
                    <!-- Hidden field to store the ID -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-flex">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="tel" name="phone" inputmode="numeric" pattern="\d{10}" maxlength="10" value="<?php echo htmlspecialchars($phone); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Course:</label>
                            <input type="text" name="course" value="<?php echo htmlspecialchars($course); ?>" required>
                        </div>
                    </div>

                    <button type="submit" name="update" class="btn btn-edit">Save Changes</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            <?php endif; ?>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> Registration System | BSc CSIT Web Technology Project</p>
    </footer>
</div>
</body>
</html>

