<?php

if (!isset($_SESSION["id"])){
    header("Location: /projects/xitTask/");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once(__DIR__."/../models/user_model.php");
    $id = $_SESSION["id"];

    if($_POST["action"]??"" == "deleteAvatar"){

        $dir = __DIR__ . "/../uploads/avatars/";

       
        foreach (glob($dir . "user_" . $id . ".*") as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        updateUserAvatar($conn, $id, "default.png");
        header("Location: /projects/xitTask/user/editProfile");
        exit();
    }

    
    $name = trim($_POST["name"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $currentPassword = null;
    $newPassword = null;
    $confirmPassword = null;
    $_SESSION["openPassword"] = "false";
    $_SESSION["openAvatar"] = "false";

    if(isset($_POST["currentPassword"])){
        $currentPassword = trim($_POST["currentPassword"] ?? "");
        $newPassword = trim($_POST["newPassword"] ?? "");
        $confirmPassword = trim($_POST["confirmPassword"] ?? "");
        $_SESSION["openPassword"] = "true";
    }


    $avatarTmpPath = $_FILES["avatar"]["tmp_name"] ?? "";
    $avatarUploadError = $_FILES["avatar"]["error"] ?? UPLOAD_ERR_NO_FILE;
    $avatarProvided = $avatarUploadError !== UPLOAD_ERR_NO_FILE;
    $newAvatarFilename = "";
    
    
    //Password Check
    if(isset($_POST["currentPassword"])){
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
    }

    //Name check
    if ($name === "") {
        $errors["name"] = "Name is required.";
    } 
    elseif (strlen($name) > 20) {
        $errors["name"] = "Name must be under 20 characters.";
    }
    elseif(strlen($name)<2){
        $errors["name"] = "Name must be more than 1 characters.";
    }

    //Mobile Check
    if ($mobile === "") {
        $errors["mobile"] = "Mobile number is required.";
    } elseif (!preg_match('/^01[0-9]{9}$/', $mobile)) {
        $errors["mobile"] = "Invalid Mobile Number";
    }
    if(!isset($errors["mobile"])){
        $currentMobile = getUserMobile($conn, $_SESSION["id"]);

        if ($mobile !== $currentMobile && isMobileExists($conn, $mobile, $_SESSION["id"])) {
            $errors["mobile"] = "Phone Number already in use.";
        }
    }

    //Address Check
    if ($address === "") {
        $errors["address"] = "Address is required.";
    } elseif (strlen($address) > 255) {
        $errors["address"] = "Address must be under 255 characters.";
    }

    //Avatar Check
    if(isset($_FILES["avatar"])){
        $_SESSION["openAvatar"] = "true";

        if(!$avatarProvided){
            $errors["avatar"] = "Please upload a avatar";
        }
    }

    
    //Error Exists
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
       
        header("Location: /projects/xitTask/user/editProfile");
        exit();
    }

    //Avatar Part
    if(isset($_FILES["avatar"])){
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

        function deleteAvatarFile($avatarFilename){
            $path = __DIR__ . "/../uploads/" . $avatarFilename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        

        if (isAvatarInvalid($errors, $newAvatarFilename, $id, $avatarTmpPath, $avatarUploadError)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["openAvatar"] = "true";
            header('Location: /projects/xitTask/user/editProfile');
            exit;
        }

        $currentUser = getUser($conn, $id);
        $currentAvatar = $currentUser["avatar"];

        if ($currentAvatar !== $newAvatarFilename && $currentAvatar !== "default.png") {
            deleteAvatarFile($currentAvatar);
        }

        if (!saveAvatarFile($avatarTmpPath, $newAvatarFilename)) {
            $errors["avatar"] = "Failed to save avatar.";

            $_SESSION["errors"] = $errors;
            $_SESSION["openAvatar"] = "true";
            header('Location: /projects/xitTask/user/editProfile');
            exit;
        }

        updateUserAvatar($conn, $id, $newAvatarFilename);
    }
   


    //Database Update
    updateUserName($conn, $_SESSION["id"], $name);
    editMobile($conn, $_SESSION["id"], $mobile);
    editAddress($conn, $_SESSION["id"], $address);
    if(isset($_POST["currentPassword"])){
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        editUserPassword($conn, $_SESSION["id"], $hashedPassword);
    }

    session_regenerate_id(true);

    header('Location: /projects/xitTask/user/editProfile');
    exit;

}
else{
    header("Location: /projects/xitTask/");
    exit();
}
