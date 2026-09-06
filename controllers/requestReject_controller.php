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
require_once(__DIR__."/../models/requestReject_model.php");


$email = trim($_POST["email"] ?? "");

function deleteAvatarFile($email) {
    $dir = __DIR__ ."/../uploads/"; 
    foreach (glob($dir . "user_" . $email . ".*") as $file) {
        unlink($file);
    }
}

deleteRequest($pdo, $email);
deleteAvatarFile($email);


header('Location: ../views/adminDashboard_requests.php');
exit();