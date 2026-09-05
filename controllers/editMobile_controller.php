<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/editMobile_model.php");

$mobile = trim($_POST["mobile"] ?? "");
$errors = [];

if ($mobile === "") {
    $errors["mobile"] = "Mobile number is required.";
} elseif (!preg_match('/^01[0-9]{9}$/', $mobile)) {
    $errors["mobile"] = "Invalid Mobile Number";
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["editForm"] = "mobile";
    header("Location: ../views/dashboard.php");
    exit();
}

$currentMobile = getUserMobile($pdo, $_SESSION["email"]);

if ($mobile === $currentMobile) {
    header("Location: ../views/dashboard.php");
    exit();
}

if (isMobileExists($pdo, $mobile, $_SESSION["email"])) {
    $errors["mobile"] = "Phone Number already in use.";
    $_SESSION["errors"] = $errors;
    $_SESSION["editForm"] = "mobile";
    header("Location: ../views/dashboard.php");
    exit();
}

editMobile($pdo, $_SESSION["email"], $mobile);

header("Location: ../views/dashboard.php");
exit();