<?php

function getAllUsers($conn){

    $query = "SELECT * FROM user WHERE role = 2 ORDER BY registerDate DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}