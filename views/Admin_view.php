<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: view_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - EventSphere</title>
  <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="admin_manage.php">Admin Manage</a>
      <a href="admin_view_manage.php">Manage Events</a>
      <a href="admin_manage_booking.php">Manage Bookings</a>
      <a href="admin_manage_users.php">Manage Users</a>
      <a href="../controllers/admin_payment_controller.php">Manage Payments</a>
      <a href="../controllers/logout.php">Logout</a>
    </nav>
  </header>

  <main>
    <h2>Welcome, <?php echo $_SESSION['admin_name']; ?> 👋</h2>
    <p>You are logged in as an Admin.</p>
  </main>
   <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
