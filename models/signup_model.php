<?php

function emailExists($pdo, $email){

    $stmt = $pdo->prepare("SELECT email FROM user WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $userResult = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT email FROM request WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $requestResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userResult || $requestResult) {
        return true;
    }
    return false;
}

function mobileExists($pdo, $mobile){

    $stmt = $pdo->prepare("SELECT mobile FROM user WHERE mobile = :mobile;");
    $stmt->bindParam(":mobile", $mobile);
    $stmt->execute();
    $userResult = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT mobile FROM request WHERE mobile = :mobile;");
    $stmt->bindParam(":mobile", $mobile);
    $stmt->execute();
    $requestResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userResult || $requestResult) {
        return true;
    }
    return false;
}

function createSignupRequest($pdo, $email, $password, $name, $mobile, $address, $avatar, $role){

    $query = "INSERT INTO request (email, password, name, mobile, address, avatar, role) VALUES (:email, :password, :name, :mobile, :address, :avatar, :role);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":mobile", $mobile);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":avatar", $avatar);
    $stmt->bindParam(":role", $role, PDO::PARAM_INT);
    $stmt->execute();
}