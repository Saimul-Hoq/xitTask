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