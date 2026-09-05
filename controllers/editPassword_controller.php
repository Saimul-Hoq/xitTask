<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../controllers/logout_controller.php");
    exit();
}

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/editPassword_model.php");

$currentPassword = trim($_POST["currentPassword"] ?? "");
$newPassword = trim($_POST["newPassword"] ?? "");
$confirmPassword = trim($_POST["confirmPassword"] ?? "");

$errors = [];

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
    header("Location: ../views/dashboard.php");
    exit();
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
editUserPassword($pdo, $_SESSION["email"], $hashedPassword);

header("Location: ../views/dashboard.php");
exit();