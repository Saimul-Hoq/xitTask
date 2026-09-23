<?php

if (!isset($_SESSION["id"])) {
    header("Location: /projects/xitTask/");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once(__DIR__."/../models/admin_model.php");

    if(($_POST["action"]??"") === "accept"){
        $id = trim($_POST["id"] ?? "");
        $adminId = $_SESSION["id"];

        approveRequest($conn, $id, $adminId);
        header('Location: /projects/xitTask/admin/requests');
        exit();
    }
    elseif(($_POST["action"]??"") === "reject"){
        
        $id = trim($_POST["id"] ?? "");

        function deleteAvatarFile($id) {
            $dir = __DIR__ ."/../uploads/"; 
            foreach (glob($dir . "user_" . $id . ".*") as $file) {
                unlink($file);
            }
        }

        deleteRequest($conn, $id);
        deleteAvatarFile($id);


        header('Location: /projects/xitTask/admin/requests');
        exit();
    }
    elseif(($_POST["action"]??"") === "delete"){

        $id = trim($_POST["id"] ?? "");

        function deleteAvatarFile($id) {
            $dir = __DIR__ ."/../uploads/"; 
            foreach (glob($dir . "user_" . $id . ".*") as $file) {
                unlink($file);
            }
        }

        deleteUser($conn, $id);
        deleteAvatarFile($id);


        header('Location: /projects/xitTask/admin/userList');
        exit();
    }
    elseif(($_POST["action"]??"") === "password"){

        $currentPassword = trim($_POST["currentPassword"] ?? "");
        $newPassword = trim($_POST["newPassword"] ?? "");
        $confirmPassword = trim($_POST["confirmPassword"] ?? "");

        $errors = [];
        $user = getUser($conn, $_SESSION["id"]);
        $location = "Location: /projects/xitTask/admin/profile";
       

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
    else{
        header("Location: /projects/xitTask/");
        exit();
    }
}
