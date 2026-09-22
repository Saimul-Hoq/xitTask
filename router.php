<?php

    $BASE_PATH = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $request = explode('?', $_SERVER["REQUEST_URI"], 2);
    $url = $request[0];

    switch($url){
        case $BASE_PATH."/":
            $pageId = 1;
            $pageName = "login";
            $page = "/views/login.php";
            break;
        case $BASE_PATH."/signup":
            $pageId = 2;
            $pageName = "signup";
            $page = "/views/signup.php";
            break;
        case $BASE_PATH."/user":
            $pageId = 3;
            $pageName = "User Dashboard";
            $page = "/views/dashboard.php";
            break;
        case $BASE_PATH."/admin/userList":
            $pageId = 4;
            $pageName = "admin|User List";
            $page = "/views/adminDashboard_userList.php";
            break;
        case $BASE_PATH."/admin/requests":
            $pageId = 5;
            $pageName = "admin|requests";
            $page = "/views/adminDashboard_requests.php";
            break;
        case $BASE_PATH."/admin/profile":
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