<?php

function deleteRequest($pdo, $email){
    $stmt = $pdo->prepare("DELETE FROM request WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}