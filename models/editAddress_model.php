<?php

function getAddress($conn, $id){

    $query = "SELECT address FROM user WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result ? $result["address"] : null;
}

function editAddress($conn, $id, $address){

    $query = "UPDATE user SET address = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $address, $id);
    $stmt->execute();
    $stmt->close();
}