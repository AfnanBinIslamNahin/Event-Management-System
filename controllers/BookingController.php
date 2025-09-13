<?php
require_once "../config/database.php";
require_once "../models/Booking.php";

class BookingController {
    private $db;
    private $booking;

    public function __construct() {
        // Start session safely
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Redirect to login if user not logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../views/view_login.php");
            exit();
        }

        // Database connection
        $database = new Database();
        $this->db = $database->getConnection();
        $this->booking = new Booking($this->db);
    }

    // Fetch all events
    public function getAllEvents() {
        $query = "SELECT * FROM events";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch bookings for specific user
    public function getUserBookings($user_id) {
        return $this->booking->getBookingsByUser($user_id);
    }
}
?>
