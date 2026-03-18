<?php

include "session.php";
check_login();

include "setup_database.php";
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Management - Registration System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page-wrapper">
    <!-- Header and Navigation -->
    <header class="main-header">
        <h1>Online Registration Management System</h1>
        <nav class="nav-bar">
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main class="content">
        <?php if (!empty($_SESSION['flash_error'])) : ?>
            <section class="small-info">
                <p class="error-message"><?php echo htmlspecialchars((string)$_SESSION['flash_error']); ?></p>
            </section>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <!-- Registration Form -->
        <section class="form-card">
            <h2>Register New User</h2>
            <form action="insert.php" method="post">
                <div class="form-flex">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="tel" name="phone" inputmode="numeric" pattern="\d{10}" maxlength="10" required>
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" required>
                    </div>

                    <div class="form-group">
                        <label>Course:</label>
                        <input type="text" name="course" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-register">Register</button>
            </form>
        </section>

        <!-- Registered Users Table -->
        <section class="table-card">
            <h2>Registered Users</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                <td><?php echo htmlspecialchars($row['course']); ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this record?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No users found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; <?php echo date("Y"); ?> Registration System | BSc CSIT Web Technology Project</p>
    </footer>
</div>
</body>
</html>

