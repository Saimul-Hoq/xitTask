<?php

function updateUserName($pdo, $email, $name){

    $query = "UPDATE user SET name = :name WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}