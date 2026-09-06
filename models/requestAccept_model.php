<?php

function approveRequest($pdo, $email, $approvedBy){

    // 1. Get the specific request by email
    $stmt = $pdo->prepare("SELECT * FROM request WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $request = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$request) {
        return false; 
    }

    // 2. Insert into user table with approvedBy
    $query = "INSERT INTO user (email, password, name, mobile, address, avatar, role, approvedBy) VALUES (:email, :password, :name, :mobile, :address, :avatar, :role, :approvedBy);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $request["email"]);
    $stmt->bindParam(":password", $request["password"]);
    $stmt->bindParam(":name", $request["name"]);
    $stmt->bindParam(":mobile", $request["mobile"]);
    $stmt->bindParam(":address", $request["address"]);
    $stmt->bindParam(":avatar", $request["avatar"]);
    $stmt->bindParam(":role", $request["role"], PDO::PARAM_INT);
    $stmt->bindParam(":approvedBy", $approvedBy);
    $stmt->execute();

    // 3. Delete the request
    $stmt = $pdo->prepare("DELETE FROM request WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return true;
}