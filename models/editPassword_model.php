<?php

function getUserPassword($conn, $id){

    $query = "SELECT password FROM user WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result ? $result["password"] : null;
}

function editUserPassword($conn, $id, $hashedPassword){

    $query = "UPDATE user SET password = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $hashedPassword, $id);
    $stmt->execute();
    $stmt->close();
}