<?php
// switch ($_SESSION['pageId'] ?? 1) {
//     case 1: case 2:
//         include (__DIR__.'/controllers/auth_controller.php');
//         break;
//     case 3:
//         include (__DIR__.'/controllers/user_controller.php');
//         break;
//     case 4: case 5: case 6:
//         include (__DIR__.'/controllers/admin_controller.php');
//         break;
// }

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