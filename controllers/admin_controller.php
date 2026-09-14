<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST'  || !isset($_SESSION["email"])) {
    header("Location: ../views/login.php");
    exit();
}


require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/admin_model.php");

if(($_POST["action"]??"") === "accept"){
    $id = trim($_POST["id"] ?? "");
    $adminId = $_SESSION["id"];

    approveRequest($conn, $id, $adminId);
    header('Location: ../views/adminDashboard_requests.php');
    exit();
}
elseif(($_POST["action"]??"") === "reject"){
    
    $id = trim($_POST["id"] ?? "");

    function deleteAvatarFile($id) {
        $dir = __DIR__ ."/../uploads/"; 
        foreach (glob($dir . "user_" . $id . ".*") as $file) {
            unlink($file);
        }
    }

    deleteRequest($conn, $id);
    deleteAvatarFile($id);


    header('Location: ../views/adminDashboard_requests.php');
    exit();
}
elseif(($_POST["action"]??"") === "delete"){

    $id = trim($_POST["id"] ?? "");

    function deleteAvatarFile($id) {
        $dir = __DIR__ ."/../uploads/"; 
        foreach (glob($dir . "user_" . $id . ".*") as $file) {
            unlink($file);
        }
    }

    deleteUser($conn, $id);
    deleteAvatarFile($id);


    header('Location: ../views/adminDashboard_userList.php');
    exit();
}
else{
    header("Location: ../views/login.php");
    exit();
}