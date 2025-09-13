<?php
session_start();
require_once "../config/database.php";
require_once "../models/booking_form.php";
require_once "../models/admin_event.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    die("❌ Invalid Event.");
}

$database = new Database();
$db = $database->getConnection();

$eventModel = new Event($db);
$event = $eventModel->getEventById($event_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingModel = new Booking($db);
    $bookingModel->user_id = $_SESSION['user_id'];
    $bookingModel->event_id = $event_id;
    $bookingModel->location = $_POST['location'];
    $bookingModel->event_date = $_POST['event_date'];
    $bookingModel->quantity = $_POST['quantity'];

    if ($bookingModel->createBooking()) {
        echo "<script>alert('✅ Booking successful!'); window.location='event_booking.php';</script>";
    } else {
        echo "<p style='color:red;'>❌ Failed to book event. Try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Event</title>
    <link rel="stylesheet" href="../CSS/booking_form1.css">
</head>
<body>
<header>
    <h1>EventSphere</h1>
    <nav>
      <a href="Customer_view.php">Dashboard</a>
      <a href="event_booking.php">Event Booking</a>
      <a href="my_booking.php" >My Bookings</a>
      <a href="view_profile.php">Profile</a>
      <a href="payment.php">Payment</a>
      <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Book: <?php echo $event['name']; ?></h2>
    <form method="POST" class="booking-form">
        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Date:</label>
        <input type="date" name="event_date" required>

        <label>Number of People:</label>
        <input type="number" name="quantity" min="1" required>

        <button type="submit">Confirm Booking</button>
    </form>
</main>
<footer>
    <p>&copy; 2025 EventSphere. All rights reserved.</p>
</body>
</html>
