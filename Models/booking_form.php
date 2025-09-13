<?php
class Booking {
    private $conn;
    private $table = "booking";

    public $id;
    public $user_id;
    public $event_id;
    public $location;
    public $event_date;
    public $quantity;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createBooking() {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, event_id, location, event_date, quantity, status) 
                  VALUES (:user_id, :event_id, :location, :event_date, :quantity, 'Pending')";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":event_id", $this->event_id);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":event_date", $this->event_date);
        $stmt->bindParam(":quantity", $this->quantity);

        return $stmt->execute();
    }
// ✅ Get bookings for a specific user
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

    public function getUserBookings($user_id) {
        $query = "SELECT b.*, e.name as event_name, e.price 
                  FROM " . $this->table . " b
                  JOIN events e ON b.event_id = e.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
