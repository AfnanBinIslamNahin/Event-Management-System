<?php
require_once "../config/database.php";
require_once "../models/admin_manage_booking.php";

class admin_manage_booking {
    private $db;
    private $booking;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->booking = new Booking($this->db);
    }

    // ✅ Show all bookings
    public function index() {
        return $this->booking->getAllBookings();
    }

    // ✅ Approve / Reject
    public function updateStatus($id, $status) {
        return $this->booking->updateStatus($id, $status);
    }
    // ✅ For customer
    public function getUserBookings($user_id) {
        return $this->booking->getBookingsByUser($user_id);
    }
}
?>
