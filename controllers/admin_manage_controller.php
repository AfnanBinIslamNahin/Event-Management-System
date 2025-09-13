<?php

require_once "../config/database.php";
require_once "../models/admin_manage.php";

class admin_manage_controller {
    private $db;
    private $admin;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->admin = new admin_manage($this->db);
    }

    public function getAllAdmins() {
        return $this->admin->getAllAdmins();
    }

    public function addAdmin($data) {
        $this->admin->full_name = $data['full_name'];
        $this->admin->email = $data['email'];
        $this->admin->password = $data['password'];

        return $this->admin->addAdmin();
    }

    public function updateAdmin($data) {
        $this->admin->id = $data['id'];
        $this->admin->full_name = $data['full_name'];
        $this->admin->email = $data['email'];

        return $this->admin->updateAdmin();
    }

    public function deleteAdmin($id) {
        $this->admin->id = $id;
        return $this->admin->deleteAdmin();
    }
}
?>
