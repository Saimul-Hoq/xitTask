<?php

function getAllUsers($pdo){

    $query = "SELECT * FROM user WHERE role = 2 ORDER BY registerDate DESC;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}