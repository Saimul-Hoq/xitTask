<?php

function updateUserName($conn, $id, $name){

    $query = "UPDATE user SET name = ? WHERE id = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $id);
    $stmt->execute();
    $stmt->close();
}