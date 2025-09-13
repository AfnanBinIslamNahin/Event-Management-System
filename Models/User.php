<?php
class User {
    private $conn;
    private $table_name = "users";

    public $fullname;
    public $phone;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register User
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (fullname, phone, email, password)
                  VALUES(:fullname, :phone, :email, :password)";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->phone    = htmlspecialchars(strip_tags($this->phone));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // bind values
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
