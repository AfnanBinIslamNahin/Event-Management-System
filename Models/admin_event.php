<?php
class Event {
    private $conn;
    private $table_name = "events";

    public $id;
    public $name;
    public $image;
    public $base_price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all events
    public function getEvents() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
     public function getEventById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Add new event
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, image, base_price) VALUES (:name, :image, :base_price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":base_price", $this->base_price);
        return $stmt->execute();
    }

    // Update event
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, image = :image, base_price = :base_price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":base_price", $this->base_price);
        return $stmt->execute();
    }

    // Delete event
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
