<?php
require_once "../config/database.php";
require_once "../models/model_payment.php";
require_once "../models/admin_manage_booking.php"; // to fetch approved bookings


class PaymentController {
    private $db;
    private $payment;
    private $booking;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->payment = new Payment($this->db);
        $this->booking = new Booking($this->db);
    }

    // ✅ Show all approved bookings for this customer
    public function getApprovedBookings($user_id) {
        $query = "SELECT b.id, e.name AS event_name, e.base_price, b.quantity, (e.base_price * b.quantity) AS total_price
                  FROM booking b
                  JOIN events e ON b.event_id = e.id
                  WHERE b.user_id = :user_id AND b.status = 'Approved'";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Handle Payment
    public function makePayment($booking_id, $user_id, $amount, $method) {
        return $this->payment->makePayment($booking_id, $user_id, $amount, $method);
    }

    // ✅ Get payment history
    public function getPaymentHistory($user_id) {
        return $this->payment->getPaymentsByUser($user_id);
    }
}
?>
