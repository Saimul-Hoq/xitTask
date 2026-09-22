<?php

    $request = explode('?', $_SERVER["REQUEST_URI"], 2);
    $url = $request[0];

    switch($url){
        case "/login":
            $pageId = 1;
            $pageName = "login";
            $page = "/views/login.php";
            break;
        case "/signup":
            $pageId = 2;
            $pageName = "signup";
            $page = "/views/signup.php";
            break;
        case "/user":
            $pageId = 3;
            $pageName = "User Dashboard";
            $page = "/views/dashboard.php";
            break;
        case "/admin/userList":
            $pageId = 4;
            $pageName = "admin|User List";
            $page = "/views/adminDashboard_userList.php";
            break;
        case "/admin/requests":
            $pageId = 5;
            $pageName = "admin|requests";
            $page = "/views/adminDashboard_requests.php";
            break;
        case "/admin/profile":
            $pageId = 6;
            $pageName = "admin|profile";
            $page = "/views/adminDashboard_profile.php";
            break;
        default:
            $pageId = 1;
            $pageName = "login";
            $page = "/views/login.php";
            break;

    }

    $_SESSION["pageId"] = $pageId;
    $_SESSION["pageName"] = $pageName;
    $_SESSION["page"] = $page;

?>