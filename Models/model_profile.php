<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $fullname;
    public $phone;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get user by ID
    public function getUserById($id) {
        $query = "SELECT id, fullname, phone, email FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile
    public function updateProfile() {
        $query = "UPDATE " . $this->table_name . " 
                  SET fullname = :fullname, phone = :phone, email = :email " . 
                  (!empty($this->password) ? ", password = :password " : "") . 
                  " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        if (!empty($this->password)) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
        }

        return $stmt->execute();
    }
}
?>
