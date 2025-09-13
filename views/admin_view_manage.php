<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once "../controllers/admin_event_controller.php";
$controller = new admin_event_controller();

// Handle form actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $controller->addEvent($_POST, $_FILES);
    } elseif (isset($_POST['edit'])) {
        $controller->editEvent($_POST, $_FILES);
    } elseif (isset($_POST['delete'])) {
        $controller->deleteEvent($_POST['id']);
    }
}

$events = $controller->getAllEvents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Events - Admin</title>
  <link rel="stylesheet" href="../CSS/admin_manage.css?v=1.2">
</head>
<body>
<header>
  <h1> EventSphere</h1>
  <nav>
    

    <a href="admin_view.php">Dashboard</a>
    <a href="manage_events.php" class="active">Manage Events</a>
      <a href="admin_manage_booking.php">Manage Bookings</a>
      <a href="admin_manage_users.php">Manage Users</a>
      <a href="../controllers/admin_payment_controller.php">Manage Payments</a>
      <a href="../controllers/logout.php">Logout</a>
  </nav>
</header>

<main>
  <h2>Add Event Category</h2>
  <form method="POST" enctype="multipart/form-data" class="event-form">
    <input type="text" name="name" placeholder="Event Name" required>
    <input type="number" name="base_price" placeholder="Base Price" step="0.01" required>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit" name="add">Add Event</button>
  </form>

  <h2>Existing Events</h2>
  <table>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Base Price</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <td><img src="../uploads/<?= $row['image'] ?>" width="100"></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>$<?= htmlspecialchars($row['base_price']) ?></td>
        <td>
          <!-- Edit Form -->
          <form method="POST" enctype="multipart/form-data" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="old_image" value="<?= $row['image'] ?>">
            <input type="text" name="name" value="<?= $row['name'] ?>" required>
            <input type="number" name="base_price" value="<?= $row['base_price'] ?>" step="0.01" required>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="edit">Update</button>
          </form>

          <!-- Delete Form -->
          <form method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="delete" onclick="return confirm('Delete this event?')">Delete</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</main>

<footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
