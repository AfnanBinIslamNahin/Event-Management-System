<?php
class Booking {
    private $conn;
    private $table = "booking";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ✅ Get all bookings with event + user details
    public function getAllBookings() {
        $query = "SELECT b.id, u.fullname, u.email, e.name AS event_name, e.base_price, 
                         b.location, b.event_date, b.quantity, b.status, b.created_at
                  FROM " . $this->table . " b
                  JOIN users u ON b.user_id = u.id
                  JOIN events e ON b.event_id = e.id
                  ORDER BY b.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Update booking status (Approve / Reject)
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
////////////////////////////////////////////////////
     public function getBookingsByUser($user_id) {
        $query = "SELECT b.id, e.name AS event_name, e.base_price, 
                         b.location, b.event_date, b.quantity, b.status, b.created_at
                  FROM " . $this->table . " b
                  JOIN events e ON b.event_id = e.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
