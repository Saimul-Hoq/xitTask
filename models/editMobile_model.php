<?php

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