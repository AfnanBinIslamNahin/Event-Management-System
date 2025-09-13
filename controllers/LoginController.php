<?php
require_once "../config/database.php";
require_once "../models/model_login.php";   // User model
require_once "../models/admin.php";   // Admin model

class LoginController {
    private $db;
    private $user;
    private $admin;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        $this->admin = new Admin($this->db);
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];

        // ✅ First check if admin
        $this->admin->email = $email;
        $this->admin->password = $password;
        $adminResult = $this->admin->login();

        if ($adminResult) {
            session_start();
            $_SESSION['admin_id'] = $adminResult['id'];
            $_SESSION['admin_name'] = $adminResult['full_name'];
            header("Location: ../views/admin_view.php");
            exit();
        }

        // ✅ If not admin, check as customer
        $this->user->email = $email;
        $this->user->password = $password;
        $userResult = $this->user->login();

        if ($userResult) {
            session_start();
            $_SESSION['user_id'] = $userResult['id'];
            $_SESSION['fullname'] = $userResult['fullname'];
            header("Location: ../views/Customer_view.php");
            exit();
        }

        // ❌ If no match
        return "❌ Invalid email or password!";
    }
}
?>
