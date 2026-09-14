<?php

function getUser($conn, $id){

    $query = "SELECT * FROM user WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

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

function getUserMobile($conn, $id){

    $query = "SELECT mobile FROM user WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result ? $result["mobile"] : null;
}

function isMobileExists($conn, $mobile, $id){

    $query = "SELECT id FROM user WHERE mobile = ? AND id != ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $mobile, $id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result !== null;
}

function editMobile($conn, $id, $mobile){

    $query = "UPDATE user SET mobile = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $mobile, $id);
    $stmt->execute();
    $stmt->close();
}


function updateUserName($conn, $id, $name){

    $query = "UPDATE user SET name = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $id);
    $stmt->execute();
    $stmt->close();
}


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

