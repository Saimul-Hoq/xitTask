<?php

function getAllRequests($conn){

    $query = "SELECT * FROM request ORDER BY registerDate ASC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}