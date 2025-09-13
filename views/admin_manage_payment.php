<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Payments</title>
    <link rel="stylesheet" href="../CSS/admin_payment.css?v=1.2">
</head>
<body>

<header>
    <h1>EventSphere</h1>
    <nav>
           <a href="../views/admin_view.php">Dashboard</a>
    <a href="../views/admin_view_manage.php">Manage Events</a>
      <a href="../views/admin_manage_booking.php" >Manage Bookings</a>
      <a href="../views/admin_manage_users.php">Manage Users</a>
      <a href="../controllers/admin_payment_controller.php " class= "active">Manage Payments</a>
    <a href="../controllers/logout.php">Logout</a>
    </nav>
</header>

<main>

    <h2>Completed Payments</h2>

    <div class="table-container">
        <?php if (count($payment) > 0): ?>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer Name</th>
                        <th>Event</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payment as $payment): ?>
                        <tr>
                            <td><?= htmlspecialchars($payment['payment_id']) ?></td>
                            <td><?= htmlspecialchars($payment['customer_name']) ?></td>
                            <td><?= htmlspecialchars($payment['name']) ?></td>
                            <td>$<?= number_format($payment['amount'], 2) ?></td>
                            <td><?= htmlspecialchars($payment['method']) ?></td>
                            <td class="completed"><?= htmlspecialchars($payment['status']) ?></td>
                            <td><?= htmlspecialchars($payment['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No completed payments found.</p>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
</footer>

</body>
</html>
