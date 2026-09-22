<?php

    $host = "localhost";
    $dbName = "xit_task";
    $dbUsername = "saim";
    $dbPassword = "saim1234";

    $conn = new mysqli($host, $dbUsername, $dbPassword,$dbName);

    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

   
    
