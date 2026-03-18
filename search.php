<?php
// search.php
// Allows searching users by name or email

include "session.php";
check_login();

include "setup_database.php";

// Get search keyword from form
$keyword = "";
if (isset($_GET['keyword'])) {
    $keyword = trim((string)$_GET['keyword']);
}

if ($keyword !== "") {
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $sql = "SELECT * FROM users
            WHERE name LIKE '%$keyword%'
               OR email LIKE '%$keyword%'
            ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
} else {
    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Users - Registration System</title>
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
        <!-- Search Form -->
        <section class="form-card">
            <h2>Search Registered Users</h2>
            <form action="search.php" method="get">
                <div class="form-group">
                    <label>Search by Name or Email:</label>
                    <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Enter name or email">
                </div>
                <button type="submit" class="btn btn-search">Search</button>
                <a href="search.php" class="btn btn-secondary">Clear</a>
            </form>
        </section>

        <!-- Search Results Table -->
        <section class="table-card">
            <h2>Search Results</h2>
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
                    <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                <td><?php echo htmlspecialchars($row['course']); ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                                       class="btn btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this record?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No records found.</td>
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

