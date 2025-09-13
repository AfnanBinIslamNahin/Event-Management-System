<?php
class admin_manage {
    private $conn;
    private $table = "admins";

    public $id;
    public $full_name;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all admins
    public function getAllAdmins() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Add new admin with MD5 hashed password
    public function addAdmin() {
        $query = "INSERT INTO " . $this->table . " (full_name, email, password) 
                  VALUES (:full_name, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // ✅ Hash password using MD5
        $this->password = md5($this->password);

        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        return $stmt->execute();
    }

    // Update admin (password is NOT changed here)
    public function updateAdmin() {
        $query = "UPDATE " . $this->table . " 
                  SET full_name=:full_name, email=:email 
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Delete admin
    public function deleteAdmin() {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
