<?php

if (!isset($_SESSION["id"])){
    header("Location: /projects/xitTask/");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once(__DIR__."/../models/user_model.php");

    if(($_POST["action"]??"") === "password"){

        $currentPassword = trim($_POST["currentPassword"] ?? "");
        $newPassword = trim($_POST["newPassword"] ?? "");
        $confirmPassword = trim($_POST["confirmPassword"] ?? "");

        $errors = [];
        $user = getUser($conn, $_SESSION["id"]);
        $location = "";
        if($user["role"]===1){
            $location = "Location: /projects/xitTask/admin/profile";
        }
        else{
            $location = "Location: /projects/xitTask/user";
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
            header("Location: /projects/xitTask/user");
            exit();
        }

        updateUserName($conn, $_SESSION["id"], $name);

        header("Location: /projects/xitTask/user");
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
            header("Location: /projects/xitTask/user");
            exit();
        }

        $currentMobile = getUserMobile($conn, $_SESSION["id"]);

        if ($mobile === $currentMobile) {
            header("Location: /projects/xitTask/user");
            exit();
        }

        if (isMobileExists($conn, $mobile, $_SESSION["id"])) {
            $errors["mobile"] = "Phone Number already in use.";
            $_SESSION["errors"] = $errors;
            $_SESSION["editForm"] = "mobile";
            header("Location: /projects/xitTask/user");
            exit();
        }

        editMobile($conn, $_SESSION["id"], $mobile);

        header("Location: /projects/xitTask/user");
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
            header("Location: /projects/xitTask/user");
            exit();
        }

        $currentAddress = getAddress($conn, $_SESSION["id"]);

        if ($address === $currentAddress) {
            header("Location: /projects/xitTask/user");
            exit();
        }

        editAddress($conn, $_SESSION["id"], $address);

        header("Location: /projects/xitTask/user");
        exit();
    }
    elseif (($_POST["action"] ?? "") === "avatar") {

        $id = $_SESSION["id"] ?? "";

       

        $errors = [];

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


    

        $avatarTmpPath = $_FILES["avatar"]["tmp_name"] ?? "";
        $avatarUploadError = $_FILES["avatar"]["error"] ?? UPLOAD_ERR_NO_FILE;
        $avatarProvided = $avatarUploadError !== UPLOAD_ERR_NO_FILE;

        $newAvatarFilename = "";

        if(!$avatarProvided){
            $errors["avatar"] = "Please upload a avatar";
            $_SESSION["errors"] = $errors;
            $_SESSION["editForm"] = "avatar";
            header('Location: /projects/xitTask/user');
            exit;
        }

        if (isAvatarInvalid($errors, $newAvatarFilename, $id, $avatarTmpPath, $avatarUploadError)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["editForm"] = "avatar";
            header('Location: /projects/xitTask/user');
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
            $_SESSION["editForm"] = "avatar";

            header("Location: /projects/xitTask/user");
            exit;
        }

        updateUserAvatar($conn, $id, $newAvatarFilename);

    

        header('Location: /projects/xitTask/user');
        exit;
    }
    else{
        header("Location: /projects/xitTask/");
    }

}
