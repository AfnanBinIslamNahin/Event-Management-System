<?php
require_once "../controllers/UserController.php";

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UserController();
    $message = $controller->signup($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - EventSphere</title>
  <link rel="stylesheet" href="../CSS/Sign_up.css">
  <style>
    /* small helper for checkbox layout */
    .show-password {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 6px;
      font-size: 0.95rem;
      color: #444;
    }
    .show-password input[type="checkbox"] {
      width: 16px;
      height: 16px;
    }
    /* optional: cursor on label */
    .show-password label { cursor: pointer; user-select: none; }
  </style>
</head>
<body>
  <header>
    <h1>EventSphere</h1>
    <nav>
      <a href="../HTML/Home_Page.html">Home</a>
      <a href="../HTML/about.html">About</a>
      <a href="../HTML/services.html">Services</a>
      <a href="../HTML/contact.html">Contact</a>
      <a href="../views/view_login.php">Login</a>
    </nav>
  </header>

  <div class="signup-container">
    <form method="POST" class="signup-box" novalidate>
      <h2>Create Account</h2>
      <?php if ($message) echo "<p class='error'>" . htmlspecialchars($message) . "</p>"; ?>

      <div class="input-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required>
      </div>

      <div class="input-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required>
      </div>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="input-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
      </div>

      <!-- Show Password checkbox -->
      <div class="show-password">
        <input type="checkbox" id="showPassword" />
        <label for="showPassword">Show password</label>
      </div>

      <button type="submit" class="btn">Sign Up</button>
      <p class="login-text">Already have an account? <a href="../views/view_login.php">Login</a></p>
    </form>
  </div>

  <footer>
    <p>&copy; 2025 EventSphere | All Rights Reserved</p>
  </footer>

  <!-- Script placed at end, using DOMContentLoaded to be safe -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const showCheckbox = document.getElementById('showPassword');
      const pwd = document.getElementById('password');
      const confirmPwd = document.getElementById('confirm_password');

      if (!showCheckbox || !pwd || !confirmPwd) {
        // Safety: if elements missing, do nothing and log
        console.warn('Show-password elements not found.');
        return;
      }

      showCheckbox.addEventListener('change', function () {
        const newType = this.checked ? 'text' : 'password';
        try {
          pwd.type = newType;
          confirmPwd.type = newType;
        } catch (e) {
          console.error('Toggle password failed:', e);
        }
      });
    });
  </script>
</body>
</html>
