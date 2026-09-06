<?php

function deleteUser($pdo, $email){
    $stmt = $pdo->prepare("DELETE FROM user WHERE email = :email;");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}