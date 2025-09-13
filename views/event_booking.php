<?php
require_once "../controllers/BookingController.php";
$controller = new BookingController();
$events = $controller->getAllEvents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Event - Customer</title>

<link rel="stylesheet" href="../CSS/booking1.css">

</head>
<body>
<header>
  <h1>EventSphere</h1>
  <nav>
    <a href="Customer_view.php">Dashboard</a>
    <a href="event_booking.php" class="active">Event Booking</a>
    <a href="my_booking.php">My Bookings</a>
    <a href="view_profile.php">Profile</a>
    <a href="payment.php">Payment</a>
   <a href="../controllers/logout.php">Logout</a>
  </nav>
</header>

<main>
  <h2>Available Event Categories</h2>
   <div class="event-list">
  <?php foreach($events as $event): ?>
    <div class="event-card">
      <img src="../uploads/<?php echo $event['image']; ?>" alt="<?php echo $event['name']; ?>">
      <h3><?php echo $event['name']; ?></h3>
      <p>Base Price: $<?php echo $event['base_price']; ?></p>
      <a href="booking_form.php?event_id=<?php echo $event['id']; ?>" class="btn">Book Now</a>
    </div>
  <?php endforeach; ?>
</div>

</main>

<footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>

</body>
</html>
