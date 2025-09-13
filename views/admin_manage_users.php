<?php

require_once "../controllers/admin_manage_users_controller.php";

$controller = new admin_manage_users_controller();

// Handle Add
if (isset($_POST['add'])) {
    $controller->addUser($_POST);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $controller->deleteUser($_GET['delete']);
    header("Location: admin_manage_users.php");
    exit();
}

// Handle Update
if (isset($_POST['update'])) {
    $controller->updateUser($_POST['id'], $_POST);
}

// Get All Users
$users = $controller->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Admin</title>
  <link rel="stylesheet" href="../CSS/user_manage.css?v=1.2">
</head>
<body>
<header>
  <h1>EventSphere</h1>
  <nav>
      <a href="admin_view.php">Dashboard</a>
      
       <a href="admin_view_manage.php">Manage Events</a>
      <a href="admin_manage_booking.php">Manage Bookings</a>
      <a href="admin_manage_users.php"class="active">Manage Users</a>
      <a href="../controllers/admin_payment_controller.php">Manage Payments</a>
       <a href="../controllers/logout.php">Logout</a>
  </nav>
</header>

<main>
  <h2>All Users</h2>
  <table border="1" cellpadding="10" cellspacing="0">
      <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Created At</th>
          <th>Actions</th>
      </tr>
      <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)) : ?>
          <tr>
              <td><?= $row['id']; ?></td>
              <td><?= $row['fullname']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['phone']; ?></td>
              <td><?= $row['created_at']; ?></td>
              <td>
                  <a href="admin_manage_users.php?edit=<?= $row['id']; ?>">Edit</a> | 
                  <a href="admin_manage_users.php?delete=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
          </tr>
      <?php endwhile; ?>
  </table>

  <hr>
 <h2 class="form-title"><?= isset($_GET['edit']) ? "Edit User" : "Add User" ?></h2>

  <?php 
  $editData = null;
  if (isset($_GET['edit'])) {
      $editData = $controller->getUserById($_GET['edit']);
  }
  ?>
  <form method="post" class="user-form">
    <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id']; ?>">
    <?php endif; ?>

    <label>Full Name:</label>
    <input type="text" name="fullname" value="<?= $editData['fullname'] ?? ''; ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $editData['email'] ?? ''; ?>" required><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= $editData['phone'] ?? ''; ?>" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit" name="<?= $editData ? 'update' : 'add'; ?>">
        <?= $editData ? 'Update User' : 'Add User'; ?>
    </button>
</form>

</main>

<footer>
   <p>&copy; 2025 EventSphere | All Rights Reserved</p>

</footer>
</body>
</html>
