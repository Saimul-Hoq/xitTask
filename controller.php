<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $controller = $_POST["controller"]??"auth";
    switch($controller){
        case "user":
            include (__DIR__.'/controllers/user_controller.php');
            break;
        case "auth":
            include (__DIR__.'/controllers/auth_controller.php');
            break;
        case "admin":
            include (__DIR__.'/controllers/admin_controller.php');
            break;
    }

}