<?php
class Admin {
    private $conn;
    private $table_name = "admins";

    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check admin login
    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE email = :email AND password = MD5(:password) LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
