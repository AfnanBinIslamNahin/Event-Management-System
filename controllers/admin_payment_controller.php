<?php
require_once "../config/database.php";  // Your database connection file
require_once "../Models/admin_payment.php";

class admin_payment_controller {
    private $paymentModel;

    public function __construct($db) {
        $this->paymentModel = new admin_payment($db);
    }

    public function showPayments() {
        $payment = $this->paymentModel->getCompletedPayments();
        require_once __DIR__ . '/../views/admin_manage_payment.php';
    }
}

// Initialize controller
$db = (new Database())->getConnection();
$controller = new admin_payment_controller($db);
$controller->showPayments();   // ✅ Call once, view handles output
