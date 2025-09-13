<?php
require_once "../controllers/admin_manage_booking.php";

$controller = new admin_manage_booking();

// Handle Approve / Reject
if (isset($_GET['action']) && isset($_GET['id'])) {
    $status = ($_GET['action'] == 'approve') ? 'Approved' : 'Rejected';
    $controller->updateStatus($_GET['id'], $status);
    header("Location: admin_manage_booking.php"); // Refresh page
    exit();
}

// Fetch all bookings
$bookings = $controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Bookings</title>
  <link rel="stylesheet" href="../CSS/admin.css?v=1.2">
</head>
<body>
<header>
    <h1>EventSphere</h1>
    <nav>
        

         <a href="admin_view.php">Dashboard</a>
        <a href="admin_view_manage.php">Manage Events</a>
      <a href="admin_manage_booking.php" class= "active">Manage Bookings</a>
      <a href="admin_manage_users.php">Manage Users</a>
      <a href="../controllers/admin_payment_controller.php">Manage Payments</a>
      <a href="../controllers/logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>All Bookings</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Event</th>
            <th>Location</th>
            <th>Date</th>
            <th>People</th>
            <th>Price (Base)</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['id'] ?></td>
                <td><?= htmlspecialchars($booking['fullname']) ?></td>
                <td><?= htmlspecialchars($booking['email']) ?></td>
                <td><?= htmlspecialchars($booking['event_name']) ?></td>
                <td><?= htmlspecialchars($booking['location']) ?></td>
                <td><?= htmlspecialchars($booking['event_date']) ?></td>
                <td><?= $booking['quantity'] ?></td>
                <td>$<?= number_format($booking['base_price'], 2) ?></td>
                <td><?= $booking['status'] ?></td>
                <td>
                    <?php if ($booking['status'] == "Pending"): ?>
                        <a href="?action=approve&id=<?= $booking['id'] ?>">✅ Approve</a> | 
                        <a href="?action=reject&id=<?= $booking['id'] ?>">❌ Reject</a>
                    <?php else: ?>
                        <?= $booking['status'] ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
<footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
