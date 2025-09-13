<?php
class User {
    private $conn;
    private $table_name = "users";

    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Authenticate User
   public function login() {
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email", $this->email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($this->password, $user['password'])) {
        return $user;
    }
    return false;
}
}
?>
