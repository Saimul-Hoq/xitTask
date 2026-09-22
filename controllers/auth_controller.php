<?php
session_start();

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/auth_model.php");
$BASE_PATH = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$BASE_PATH = $BASE_PATH."/..";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'logout') {
    $_SESSION = [];
    session_destroy();

    header('Location: '.$BASE_PATH."/");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: '.$BASE_PATH."/signup");
    exit;
}

if(($_POST["action"]??"") === "login"){


    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $errors = [];

    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    if ($password === '') {
        $errors['password'] = 'Password is required.';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['oldEmail'] = $email;

        header('Location: '.$BASE_PATH."/");
        exit;
    }

    $user = getUserFromRequest($conn, $email);
    if ($user) {
        $errors["email"] = "Waiting for admin approval";
        // $errors["password"] = "Email or password incorrect";

        $_SESSION['errors'] = $errors;
        $_SESSION['oldEmail'] = $email;

        header('Location: '.$BASE_PATH."/");
        exit;
    }
   

    $user = getUser($conn, $email);

    if (!$user || !password_verify($password, $user["password"])) {
        $errors["email"] = "Email or password incorrect";
        // $errors["password"] = "Email or password incorrect";

        $_SESSION['errors'] = $errors;
        $_SESSION['oldEmail'] = $email;

        header('Location: '.$BASE_PATH."/");
        exit;
    }

   


    session_regenerate_id(true);
    $_SESSION['email'] = $user['email'];
    $_SESSION['id'] = $user['id'];


    if($user["role"]===1){
        header('Location: '.$BASE_PATH.'/admin/userList');
    }
    else{
        header('Location: '.$BASE_PATH.'/user');
    }
    exit;
}
elseif(($_POST["action"]??"") === "signup"){

    $id = generateId();
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
    } elseif (emailExists($conn, $email)) {
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
    } elseif (mobileExists($conn, $mobile)) {
        $errors["mobile"] = "Mobile number is already registered.";
    }

    // --- Address ---
    if ($address === "") {
        $errors["address"] = "Address is required.";
    }

    // --- Avatar (optional) ---
    function isAvatarInvalid(&$errors, &$avatarFilename, $id, $avatarTmpPath, $avatarUploadError){

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
        $avatarFilename = "user_" . $id . "." . $ext;

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
        isAvatarInvalid($errors, $avatarFileName, $id, $avatarTmpPath, $avatarUploadError);
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

    createSignupRequest($conn, $id, $email, $hashedPassword, $name, $mobile, $address, $avatarFileName, 2);


    unset($_SESSION["oldName"], $_SESSION["oldEmail"], $_SESSION["oldMobile"], 
    $_SESSION["oldAddress"]);

    header('Location: ../views/signup.php?status=success');
    exit;
}
else{
    header('Location: ../views/login.php');
    exit;
}

