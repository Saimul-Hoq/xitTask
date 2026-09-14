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

function approveRequest($conn, $id, $approvedBy){

    // 1. Get the specific request by id
    $stmt = $conn->prepare("SELECT * FROM request WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $request = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$request) {
        return false;
    }

    // 2. Insert into user table with approvedBy
    $query = "INSERT INTO user (id, email, password, name, mobile, address, avatar, role, approvedBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssssssis",
        $id,
        $request["email"],
        $request["password"],
        $request["name"],
        $request["mobile"],
        $request["address"],
        $request["avatar"],
        $request["role"],
        $approvedBy
    );
    $stmt->execute();
    $stmt->close();

    // 3. Delete the request
    $stmt = $conn->prepare("DELETE FROM request WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();

    return true;
}


function deleteRequest($conn, $id){
    $stmt = $conn->prepare("DELETE FROM request WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}


function deleteUser($conn, $id){
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}


function getAllRequests($conn){

    $query = "SELECT * FROM request ORDER BY registerDate ASC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


function getAllUsers($conn){

    $query = "SELECT * FROM user WHERE role = 2 ORDER BY registerDate DESC;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}