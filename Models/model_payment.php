<?php
class Payment {
    private $conn;
    private $table = "payment";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ✅ Insert new payment
    public function makePayment($booking_id, $user_id, $amount, $method) {
        $query = "INSERT INTO " . $this->table . " (booking_id, user_id, amount, method) 
                  VALUES (:booking_id, :user_id, :amount, :method)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":method", $method);

        return $stmt->execute();
    }

    // ✅ Get all payments by user
    public function getPaymentsByUser($user_id) {
        $query = "SELECT p.id, e.name AS event_name, p.amount, p.method, p.status, p.created_at
                  FROM " . $this->table . " p
                  JOIN booking b ON p.booking_id = b.id
                  JOIN events e ON b.event_id = e.id
                  WHERE p.user_id = :user_id
                  ORDER BY p.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
