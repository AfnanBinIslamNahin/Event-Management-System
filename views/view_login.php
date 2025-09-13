<?php
require_once "../controllers/LoginController.php";

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new LoginController();
    $message = $controller->login($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - EventSphere</title>
  <link rel="stylesheet" href="../CSS/Login.css?v=1.2">
</head>
<body>
  <!-- Navbar -->
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="../HTML/Home_Page.html">Home</a>
      <a href="../HTML/About.html">About</a>
      <a href="../HTML/Services.html">Services</a>
      <a href="../HTML/Contact.html">Contact</a>
      <a href="../views/view_login.php" class="active">Login</a>
    </nav>
  </header>

  <!-- Login Form -->
  <div class="login-container">
    <form method="POST" class="login-box">
      <h2>Login</h2>
      <?php if ($message) echo "<p class='error'>$message</p>"; ?>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="btn">Login</button>
      <p class="signup-text">Don’t have an account? <a href="register_signup.php">Sign Up</a></p>
    </form>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>
</body>
</html>
