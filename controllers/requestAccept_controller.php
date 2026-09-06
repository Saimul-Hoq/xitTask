<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/adminDashboard_requests.php');
    exit();
}
if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/requestAccept_model.php");


$email = trim($_POST["email"] ?? "");
$adminEmail = $_SESSION["email"];

approveRequest($pdo, $email, $adminEmail);
header('Location: ../views/adminDashboard_requests.php');
exit();