<?php

function getUser($conn, $email){

    $query = "SELECT * FROM user WHERE email = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}



function generateId(){
    $data = random_bytes(16);

    // Set version to 0100 (UUID v4)
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    // Set variant to 10xx
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function emailExists($conn, $email){

    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userResult = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("SELECT email FROM request WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $requestResult = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($userResult || $requestResult) {
        return true;
    }
    return false;
}

function mobileExists($conn, $mobile){

    $stmt = $conn->prepare("SELECT mobile FROM user WHERE mobile = ?;");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $userResult = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("SELECT mobile FROM request WHERE mobile = ?;");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $requestResult = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($userResult || $requestResult) {
        return true;
    }
    return false;
}

function createSignupRequest($conn, $id, $email, $password, $name, $mobile, $address, $avatar, $role){

    $query = "INSERT INTO request (id, email, password, name, mobile, address, avatar, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssssssi",
        $id,
        $email,
        $password,
        $name,
        $mobile,
        $address,
        $avatar,
        $role
    );
    $stmt->execute();
    $stmt->close();
}

