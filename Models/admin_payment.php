<?php
class admin_payment {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all completed payments
    public function getCompletedPayments() {
        $sql = "
            SELECT p.id AS payment_id, 
                   u.fullname AS customer_name, 
                   e.name,
                   p.amount, 
                   p.method, 
                   p.status, 
                   p.created_at
            FROM payment p
            JOIN users u ON p.user_id = u.id
            JOIN booking b ON p.booking_id = b.id
            JOIN events e ON b.event_id = e.id
            WHERE p.status = 'Completed'
            ORDER BY p.created_at DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
