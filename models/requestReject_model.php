<?php

function deleteRequest($conn, $id){
    $stmt = $conn->prepare("DELETE FROM request WHERE id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
}