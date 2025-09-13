<?php
require_once "../controllers/profileController.php";

$controller = new profileController();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $controller->updateProfile($_POST);
}

$user = $controller->getProfile();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - EventSphere</title>
  <link rel="stylesheet" href="../CSS/profile.css">
</head>
<body>

  <!-- Navbar -->
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="Customer_view.php">Dashboard</a>
      <a href="event_booking.php">Event Booking</a>
      <a href="my_booking.php">My Bookings</a>
      <a href="view_profile.php" class="active">Profile</a>
      <a href="payment.php">Payment</a>
      <a href="../controllers/logout.php">Logout</a>
    </nav>
  </header>

  <!-- Profile Form -->
  <div class="profile-container">
    <form method="POST" class="profile-box">
      <h2>My Profile</h2>
      <?php if ($message) echo "<p class='msg'>$message</p>"; ?>

      <div class="input-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
      </div>

      <div class="input-group">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
      </div>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>

      <div class="input-group">
        <label for="password">New Password (leave blank if unchanged)</label>
        <input type="password" name="password">
      </div>

      <button type="submit" class="btn">Update Profile</button>
    </form>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
