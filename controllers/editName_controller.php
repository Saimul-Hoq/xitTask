<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/editName_model.php");

$name = trim($_POST["name"] ?? "");
$errors = [];

if ($name === "") {
    $errors["name"] = "Name is required.";
} 
elseif (strlen($name) > 100) {
    $errors["name"] = "Name must be under 100 characters.";
}
elseif(strlen($name)<2){
    $errors["name"] = "Name must be more than 1 characters.";
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["editForm"] = "name";
    header("Location: ../views/dashboard.php");
    exit();
}

updateUserName($pdo, $_SESSION["email"], $name);

header("Location: ../views/dashboard.php");
exit();