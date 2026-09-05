<?php

function getAddress($pdo, $email){

    $query = "SELECT address FROM user WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result["address"] : null;
}

function editAddress($pdo, $email, $address){

    $query = "UPDATE user SET address = :address WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}