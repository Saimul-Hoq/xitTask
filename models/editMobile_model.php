<?php

function getUserMobile($pdo, $email){

    $query = "SELECT mobile FROM user WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result["mobile"] : null;
}

function isMobileExists($pdo, $mobile, $email){

    $query = "SELECT id FROM user WHERE mobile = :mobile AND email != :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":mobile", $mobile);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}

function editMobile($pdo, $email, $mobile){

    $query = "UPDATE user SET mobile = :mobile WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":mobile", $mobile);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}