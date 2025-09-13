<?php
class UserModel {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all users
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Add new user
    public function addUser($fullname, $email, $phone, $password) {
        $query = "INSERT INTO " . $this->table . " (fullname, email, phone, password) VALUES (:fullname, :email, :phone, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password); // hash before calling
        return $stmt->execute();
    }

    // Delete user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Get user by ID
    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user
    public function updateUser($id, $fullname, $email, $phone, $password) {
        $query = "UPDATE " . $this->table . " 
                  SET fullname = :fullname, email = :email, phone = :phone, password = :password 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
