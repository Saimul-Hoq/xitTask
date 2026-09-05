<?php
session_start();

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/signup_model.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/signup.php');
    exit;
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$mobile = trim($_POST["mobile"] ?? "");
$address = trim($_POST["address"] ?? "");

$_SESSION["oldName"] = $name;
$_SESSION["oldEmail"] = $email;
$_SESSION["oldMobile"] = $mobile;
$_SESSION["oldAddress"] = $address;

$errors = [];

// --- Name ---
if ($name === "") {
    $errors["name"] = "Name is required.";
} elseif (!(strlen($name) > 1 && strlen($name) <= 20)) {
    $errors["name"] = "Name must be between 2 and 20 characters.";
} elseif (!preg_match('/^[a-zA-Z ]+$/', $name)) {
    $errors["name"] = "Name cannot contain special characters.";
}

// --- Email ---
if ($email === "") {
    $errors["email"] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format.";
} elseif (emailExists($pdo, $email)) {
    $errors["email"] = "Email is already registered.";
}

// --- Password ---
if ($password === "") {
    $errors["password"] = "Password is required.";
} elseif (strlen($password) < 4) {
    $errors["password"] = "Password must be at least 4 characters.";
}

// --- Mobile ---
if ($mobile === "") {
    $errors["mobile"] = "Mobile number is required.";
} elseif (!preg_match('/^01[0-9]{9}$/', $mobile)) {
    $errors["mobile"] = "Invalid Phone Number";
} elseif (mobileExists($pdo, $mobile)) {
    $errors["mobile"] = "Mobile number is already registered.";
}

// --- Address ---
if ($address === "") {
    $errors["address"] = "Address is required.";
}

// --- Avatar (optional) ---
function isAvatarInvalid(&$errors, &$avatarFilename, $email, $avatarTmpPath, $avatarUploadError){

    if ($avatarUploadError !== UPLOAD_ERR_OK) {
        $errors["avatar"] = "Error uploading avatar.";
        return true;
    }

    $realMime = mime_content_type($avatarTmpPath);
    $allowedMimes = [
        "image/jpeg" => "jpg",
        "image/png"  => "png",
        "image/webp" => "webp",
    ];

    if (!array_key_exists($realMime, $allowedMimes)) {
        $errors["avatar"] = "Invalid file type.";
        return true;
    }

    if (filesize($avatarTmpPath) > 2 * 1024 * 1024) {
        $errors["avatar"] = "File too large. File must be within 2MB.";
        return true;
    }

    $ext = $allowedMimes[$realMime];
    $avatarFilename = "user_" . $email . "." . $ext;

    return false;
}

function saveAvatarFile($avatarTmpPath, $avatarFilename){
    $destination = __DIR__ . "/../uploads/" . $avatarFilename;
    return move_uploaded_file($avatarTmpPath, $destination);
}


$avatarTmpPath = $_FILES["avatar"]["tmp_name"] ?? "";
$avatarUploadError = $_FILES["avatar"]["error"] ?? UPLOAD_ERR_NO_FILE;
$avatarProvided = $avatarUploadError !== UPLOAD_ERR_NO_FILE;

$avatarFileName = "default.png";

if ($avatarProvided) {
    isAvatarInvalid($errors, $avatarFileName, $email, $avatarTmpPath, $avatarUploadError);
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    header('Location: ../views/signup.php');
    exit;
}

if ($avatarProvided) {
    if (!saveAvatarFile($avatarTmpPath, $avatarFileName)) {
        $_SESSION["errors"] = ["avatar" => "Failed to save avatar. Please try again."];
        header('Location: ../views/signup.php');
        exit;
    }
}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

createSignupRequest($pdo, $email, $hashedPassword, $name, $mobile, $address, $avatarFileName, 2);



header('Location: ../views/login.php');
exit;