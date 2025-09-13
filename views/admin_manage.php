<?php
require_once __DIR__ . '/../controllers/admin_manage_controller.php';
$controller = new admin_manage_controller();

// Handle Add Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $controller->addAdmin($_POST);
    header("Location: admin_manage.php");
    exit();
}

// Handle Update Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $controller->updateAdmin($_POST);
    header("Location: admin_manage.php");
    exit();
}

// Handle Delete Admin
if (isset($_GET['delete'])) {
    $controller->deleteAdmin($_GET['delete']);
    header("Location: admin_manage.php");
    exit();
}

$admins = $controller->getAllAdmins();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Admins</title>
    <link rel="stylesheet" href="../CSS/admin_user.css?v=1.2">
</head>
<body>
    <header>
       <h1> EventSphere</h1>
        <nav>
            <a href="admin_view.php">Back</a>
        </nav>
    </header>

<h2>Manage Admins</h2>
    <div class="container">
        <!-- Add Admin Form -->
        <div class="form-box">
            <h2>Add Admin</h2>
            <form method="POST">
                <label>Full Name</label>
                <input type="text" name="full_name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button type="submit" name="add">Add Admin</button>
            </form>
        </div>

        <!-- Admins Table -->
        <div class="table-box">
            <h2>All Admins</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $admins->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['full_name']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td>
                            <!-- Update -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <input type="text" name="full_name" value="<?= htmlspecialchars($row['full_name']); ?>" required>
                                <input type="email" name="email" value="<?= htmlspecialchars($row['email']); ?>" required>
                                <button type="submit" name="update">Update</button>
                            </form>
                            <!-- Delete -->
                            <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete this admin?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 EventSphere | All Rights Reserved</p>
    </footer>
</body>
</html>
