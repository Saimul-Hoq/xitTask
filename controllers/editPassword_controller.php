<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/login.php');
    exit;
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/editPassword_model.php");
require_once(__DIR__."/../models/getUser_model.php");


$currentPassword = trim($_POST["currentPassword"] ?? "");
$newPassword = trim($_POST["newPassword"] ?? "");
$confirmPassword = trim($_POST["confirmPassword"] ?? "");

$errors = [];
$user = getUser($pdo, $_SESSION["email"]);
$location = "";
if($user["role"]===1){
    $location = "Location: ../views/adminDashboard_profile.php";
}
else{
    $location = "Location: ../views/dashboard.php";
}

if ($currentPassword === "") {
    $errors["currentPassword"] = "Current password is required.";
}

if ($newPassword === "") {
    $errors["newPassword"] = "New password is required.";
} elseif (strlen($newPassword) < 4) {
    $errors["newPassword"] = "New password must be at least 8 characters.";
}

if ($confirmPassword === "") {
    $errors["confirmPassword"] = "Please confirm your new password.";
} elseif ($newPassword !== "" && $newPassword !== $confirmPassword) {
    $errors["confirmPassword"] = "Passwords do not match.";
}

if (empty($errors)) {
    $password = getUserPassword($pdo, $_SESSION["email"]);

    if ($password === null || !password_verify($currentPassword, $password)) {
        $errors["currentPassword"] = "Current password is incorrect.";
    }
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["editForm"] = "password";
    header($location);
    exit();
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
editUserPassword($pdo, $_SESSION["email"], $hashedPassword);

session_regenerate_id(true);
header($location);

exit();