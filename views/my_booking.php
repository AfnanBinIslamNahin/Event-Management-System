<?php
session_start(); // Start session here

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../controllers/admin_manage_booking.php";

$controller = new admin_manage_booking();

//  Corrected method call
$bookings = $controller->getUserBookings($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings - EventSphere</title>
  <link rel="stylesheet" href="../CSS/my_booking.css?v=1.2">
</head>
<body>

  <!-- Navbar -->
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="Customer_view.php">Dashboard</a>
      <a href="event_booking.php">Event Booking</a>
      <a href="my_booking.php" class="active">My Bookings</a>
      <a href="view_profile.php">Profile</a>
      <a href="payment.php">Payment</a>
       <a href="../controllers/logout.php">Logout</a>
    </nav>
  </header>

  <!-- My Bookings -->
  <main>
    <h2>Bookings Overview</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Event</th>
            <th>Location</th>
            <th>Date</th>
            <th>People</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>

        <?php if (!empty($bookings)): ?>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $booking['id'] ?></td>
                    <td><?= htmlspecialchars($booking['event_name']) ?></td>
                    <td><?= htmlspecialchars($booking['location']) ?></td>
                    <td><?= htmlspecialchars($booking['event_date']) ?></td>
                    <td><?= $booking['quantity'] ?></td>
                    <td>$<?= number_format($booking['base_price'] * $booking['quantity'], 2) ?></td>
                    <td>
                        <?php if ($booking['status'] == "Pending"): ?>
                            <span style="color: orange; font-weight: bold;">⏳ Pending</span>
                        <?php elseif ($booking['status'] == "Approved"): ?>
                            <span style="color: green; font-weight: bold;">✅ Approved</span>
                        <?php else: ?>
                            <span style="color: red; font-weight: bold;">❌ Rejected</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No bookings found.</td>
            </tr>
        <?php endif; ?>
    </table>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
