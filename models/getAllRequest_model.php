<?php

function getAllRequests($pdo){

    $query = "SELECT * FROM request;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}