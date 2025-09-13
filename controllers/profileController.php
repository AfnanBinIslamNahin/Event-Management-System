<?php
require_once "../config/database.php";
require_once "../models/model_profile.php";

class profileController {
    private $db;
    private $user;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../views/view_login.php");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function getProfile() {
        return $this->user->getUserById($_SESSION['user_id']);
    }

    public function updateProfile($data) {
        $this->user->id = $_SESSION['user_id'];
        $this->user->fullname = $data['fullname'];
        $this->user->phone = $data['phone'];
        $this->user->email = $data['email'];
        $this->user->password = !empty($data['password']) ? $data['password'] : null;

        if ($this->user->updateProfile()) {
            return "✅ Profile updated successfully!";
        } else {
            return "❌ Error updating profile.";
        }
    }
}
?>
