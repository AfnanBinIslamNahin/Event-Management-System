<?php
class Booking {
    private $conn;
    private $table_name = "bookings";

    public $user_id;
    public $event_type;
    public $event_date;
    public $guests;
    public $special_request;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new booking
    public function createBooking() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, event_type, event_date, guests, special_request)
                  VALUES (:user_id, :event_type, :event_date, :guests, :special_request)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":event_type", $this->event_type);
        $stmt->bindParam(":event_date", $this->event_date);
        $stmt->bindParam(":guests", $this->guests);
        $stmt->bindParam(":special_request", $this->special_request);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Get all bookings of a user
public function getBookingsByUser($user_id) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY event_date DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt;
}

}
?>
