<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: view_login.php");
    exit();
}

require_once "../controllers/PaymentController.php";
$controller = new PaymentController();
$user_id = $_SESSION['user_id'];

$message = "";

//  Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];

    if ($controller->makePayment($booking_id, $user_id, $amount, $method)) {
        $message = "✅ Payment successful!";
    } else {
        $message = "❌ Payment failed!";
    }
}

//  Get Approved Bookings
$approvedBookings = $controller->getApprovedBookings($user_id);

//  Get Payment History
$paymentHistory = $controller->getPaymentHistory($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment</title>
  <link rel="stylesheet" href="../CSS/customer_dashboard1.css?v=1.3">
</head>
<body>

<header>
    <h1> EventSphere    Welcome, <?= htmlspecialchars($_SESSION['fullname']); ?> </h1>
    <nav>
        <a href="Customer_view.php">Dashboard</a>
        <a href="event_booking.php">Event Booking</a>
        <a href="my_booking.php">My Bookings</a>
        <a href="payment.php" class="active">Payment</a>
        <a href="view_profile.php">Profile</a>
        <a href="../controllers/logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Make Payment</h2>
    <?php if ($message): ?>
        <p><strong><?= $message ?></strong></p>
    <?php endif; ?>

    <?php if (count($approvedBookings) > 0): ?>
        <form method="POST">
            <label for="booking">Select Booking:</label>
            <select name="booking_id" required>
                <?php foreach ($approvedBookings as $booking): ?>
                    <option value="<?= $booking['id'] ?>">
                        <?= htmlspecialchars($booking['event_name']) ?> 
                        - $<?= number_format($booking['total_price'], 2) ?> 
                        (<?= $booking['quantity'] ?> People)
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Payment Method:</label>
            <select name="method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Mobile Banking">Mobile Banking</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select><br><br>

            <input type="hidden" name="amount" value="<?= $booking['total_price'] ?>">
            <button type="submit">Pay Now</button>
        </form>
    <?php else: ?>
        <p>No approved bookings available for payment.</p>
    <?php endif; ?>

    <h2>Payment History</h2>
    <?php if (count($paymentHistory) > 0): ?>
    <div class="table-container">
    <table class="payment-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paymentHistory as $payment): ?>
                <tr>
                    <td><?= $payment['id'] ?></td>
                    <td><?= htmlspecialchars($payment['event_name']) ?></td>
                    <td>$<?= number_format($payment['amount'], 2) ?></td>
                    <td><?= $payment['method'] ?></td>
                    <td class="<?= strtolower($payment['status']) ?>">
                        <?= $payment['status'] ?>
                    </td>
                    <td><?= $payment['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <?php else: ?>
        <p>No payment history found.</p>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
</footer>

</body>
</html>
