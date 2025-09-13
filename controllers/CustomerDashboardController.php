<?php
session_start();

class CustomerDashboardController {
    public function __construct() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
             header("Location: ../views/view_login.php");
            exit();
        }
    }

    public function getUserName() {
        return $_SESSION['fullname']; // stored at login
    }
}
?>
