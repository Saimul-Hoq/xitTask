<?php

function getUserPassword($pdo, $email){

    $query = "SELECT password FROM user WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result["password"] : null;
}

function editUserPassword($pdo, $email, $hashedPassword){

    $query = "UPDATE user SET password = :password WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}