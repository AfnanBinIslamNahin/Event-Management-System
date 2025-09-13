<?php
require_once "../controllers/CustomerDashboardController.php";

$controller = new CustomerDashboardController();
$fullname = $controller->getUserName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard - EventSphere</title>
  <link rel="stylesheet" href="../CSS/customer_dashboard.css?v=1.3">
</head>
<body>

  <!-- Navbar -->
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="event_booking.php">Event Booking</a>
      <a href="my_booking.php">My Bookings</a>
      <a href="view_profile.php">Profile</a>
      <a href="payment.php">Payment</a>
      <a href="../controllers/logout.php">Logout</a>
    </nav>
  </header>

  <!-- Dashboard Content -->
  <div class="dashboard-container">
    <div class="dashboard-box">
      <h2>Welcome, <?php echo htmlspecialchars($fullname); ?> 👋</h2>
      <p>You are successfully logged in to your customer dashboard.</p>
    </div>
  </div>



  <div class="slideshow-container">
    <div class="slides">
      <img src="../IMAGE/wedding1.jpg" class="active">
      <img src="../IMAGE/corporate2.jpg">
      <img src="../IMAGE/birthday4.jpg">
      <img src="../IMAGE/wedding3.png">
      <img src="../IMAGE/wedding6.jpg">
    </div>
    <div class="dots"></div>
  </div>

  <script>
    const slides = document.querySelector(".slides");
    const images = document.querySelectorAll(".slides img");
    const dotsContainer = document.querySelector(".dots");

    let index = 0;
    const total = images.length;

    // Create dots dynamically
    for (let i = 0; i < total; i++) {
      const dot = document.createElement("span");
      if (i === 0) dot.classList.add("active");
      dotsContainer.appendChild(dot);
    }
    const dots = document.querySelectorAll(".dots span");

    function showSlide() {
      index = (index + 1) % total;
      slides.style.transform = `translateX(-${index * 100}%)`;

      dots.forEach(dot => dot.classList.remove("active"));
      dots[index].classList.add("active");
    }

    setInterval(showSlide, 1700); // auto change every second
  </script>
  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
