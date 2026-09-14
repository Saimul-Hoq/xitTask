<?php
session_start();

if (!isset($_SESSION["id"]) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: ../views/login.php");
    exit();
}


require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/user_model.php");

if(($_POST["action"]??"") === "password"){

    $currentPassword = trim($_POST["currentPassword"] ?? "");
    $newPassword = trim($_POST["newPassword"] ?? "");
    $confirmPassword = trim($_POST["confirmPassword"] ?? "");

    $errors = [];
    $user = getUser($conn, $_SESSION["id"]);
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
        $errors["newPassword"] = "New password must be at least 4 characters.";
    }

    if ($confirmPassword === "") {
        $errors["confirmPassword"] = "Please confirm your new password.";
    } elseif ($newPassword !== "" && $newPassword !== $confirmPassword) {
        $errors["confirmPassword"] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $password = getUserPassword($conn, $_SESSION["id"]);

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
    editUserPassword($conn, $_SESSION["id"], $hashedPassword);

    session_regenerate_id(true);
    header($location);

    exit();
}
elseif(($_POST["action"]??"") === "name"){

    $name = trim($_POST["name"] ?? "");
    $errors = [];

    if ($name === "") {
        $errors["name"] = "Name is required.";
    } 
    elseif (strlen($name) > 20) {
        $errors["name"] = "Name must be under 20 characters.";
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

    updateUserName($conn, $_SESSION["id"], $name);

    header("Location: ../views/dashboard.php");
    exit();
}
elseif(($_POST["action"]?? "") === "mobile"){

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

    $currentMobile = getUserMobile($conn, $_SESSION["id"]);

    if ($mobile === $currentMobile) {
        header("Location: ../views/dashboard.php");
        exit();
    }

    if (isMobileExists($conn, $mobile, $_SESSION["id"])) {
        $errors["mobile"] = "Phone Number already in use.";
        $_SESSION["errors"] = $errors;
        $_SESSION["editForm"] = "mobile";
        header("Location: ../views/dashboard.php");
        exit();
    }

    editMobile($conn, $_SESSION["id"], $mobile);

    header("Location: ../views/dashboard.php");
    exit();
}
elseif(($_POST["action"] === "address")){
        
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

    $currentAddress = getAddress($conn, $_SESSION["id"]);

    if ($address === $currentAddress) {
        header("Location: ../views/dashboard.php");
        exit();
    }

    editAddress($conn, $_SESSION["id"], $address);

    header("Location: ../views/dashboard.php");
    exit();
}
else{
    header("Location: ../views/login.php");
    exit();
}
