<?php

function deleteUser($conn, $id){
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}