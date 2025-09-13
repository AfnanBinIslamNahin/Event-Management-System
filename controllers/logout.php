<?php
// controllers/logout.php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: ../views/view_login.php");
exit();
?>
