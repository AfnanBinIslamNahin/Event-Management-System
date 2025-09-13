<?php
require_once "../config/database.php";
require_once "../models/admin_event.php";

class admin_event_controller {
    private $db;
    private $event;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->event = new Event($this->db);
    }

    public function getAllEvents() {
        return $this->event->getEvents();
    }

    public function addEvent($data, $file) {
        $this->event->name = $data['name'];
        $this->event->base_price = $data['base_price'];

        // Upload image
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($file["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($file["image"]["tmp_name"], $targetFilePath)) {
            $this->event->image = $fileName;
        } else {
            $this->event->image = null;
        }

        return $this->event->create();
    }

    public function editEvent($data, $file) {
        $this->event->id = $data['id'];
        $this->event->name = $data['name'];
        $this->event->base_price = $data['base_price'];

        if (!empty($file["image"]["name"])) {
            $fileName = time() . "_" . basename($file["image"]["name"]);
            $targetFilePath = "../uploads/" . $fileName;
            move_uploaded_file($file["image"]["tmp_name"], $targetFilePath);
            $this->event->image = $fileName;
        } else {
            $this->event->image = $data['old_image'];
        }

        return $this->event->update();
    }

    public function deleteEvent($id) {
        $this->event->id = $id;
        return $this->event->delete();
    }
}
?>
