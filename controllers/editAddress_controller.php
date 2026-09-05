<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/editAddress_model.php");

$address = trim($_POST["address"] ?? "");
$errors = [];

if ($address === "") {
    $errors["address"] = "Address is required.";
} elseif (strlen($address) > 255) {
    $errors["address"] = "Address must be under 255 characters.";
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["editForm"] = "address";
    header("Location: ../views/dashboard.php");
    exit();
}

$currentAddress = getAddress($pdo, $_SESSION["email"]);

if ($address === $currentAddress) {
    header("Location: ../views/dashboard.php");
    exit();
}

editAddress($pdo, $_SESSION["email"], $address);

header("Location: ../views/dashboard.php");
exit();