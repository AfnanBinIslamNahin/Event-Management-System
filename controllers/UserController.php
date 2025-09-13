<?php

require_once "../config/database.php";
require_once "../models/User.php";

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function signup($data) {
         // Check password match
        if ($data['password'] !== $data['confirm_password']) {
            return "❌ Password and Confirm Password do not match!";
        }
        $this->user->fullname = $data['fullname'];
        $this->user->phone    = $data['phone'];
        $this->user->email    = $data['email'];
        $this->user->password = $data['password'];

        if ($this->user->register()) {
            header("Location: ../views/success.php");
            exit();
        } else {
            return "Error: Could not register user!";
        }
    }
}
?>
