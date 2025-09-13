<?php
require_once "../config/database.php";
require_once "../Models/admin_manage_users.php";

class admin_manage_users_controller {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function getUsers() {
        return $this->userModel->getAllUsers();
    }

    public function addUser($data) {
        $fullname = $data['fullname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->userModel->addUser($fullname, $email, $phone, $password);
    }

    public function deleteUser($id) {
        return $this->userModel->deleteUser($id);
    }

    public function getUserById($id) {
        return $this->userModel->getUserById($id);
    }

    public function updateUser($id, $data) {
        $fullname = $data['fullname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->userModel->updateUser($id, $fullname, $email, $phone, $password);
    }
}
?>
