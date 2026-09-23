<?php

    // $BASE_PATH = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $request = explode('?', $_SERVER["REQUEST_URI"], 2);
    $url = $request[0];
    

    switch($url){
        case "/projects/xitTask/":
            if(!isset($_SESSION['id'])){
                $pageId = 1;
                $pageName = "login";
                $page = "/views/login.php";
                include(__DIR__."/cssLinks/loginCss.php");
            }
            else{
                if($_SESSION["role"]===1){
                   header("Location: /projects/xitTask/admin/userList");
                   exit();
                }
                else{
                   header("Location: /projects/xitTask/user");
                   exit();
                }
            }
            
            break;
        case "/projects/xitTask/signup":
            $pageId = 2;
            $pageName = "signup";
            $page = "/views/signup.php";
            include(__DIR__."/cssLinks/signupCss.php");
            break;
        case "/projects/xitTask/user":
            $pageId = 3;
            $pageName = "User Dashboard";
            $page = "/views/dashboard.php";
            include(__DIR__."/cssLinks/dashboardCss.php");
            break;
        case "/projects/xitTask/admin/userList":
            $pageId = 4;
            $pageName = "admin|User List";
            $page = "/views/adminDashboard_userList.php";
            include(__DIR__."/cssLinks/adminUserListCss.php");
            break;
        case "/projects/xitTask/admin/requests":
            $pageId = 5;
            $pageName = "admin|requests";
            $page = "/views/adminDashboard_requests.php";
            include(__DIR__."/cssLinks/adminUserListCss.php");
            break;
        case "/projects/xitTask/admin/profile":
            $pageId = 6;
            $pageName = "admin|profile";
            $page = "/views/adminDashboard_profile.php";
            include(__DIR__."/cssLinks/adminProfileCss.php");
            break;
        case "/projects/xitTask/logout":
            include(__DIR__."/controllers/logout_controller.php");
            exit;
        default:
            header("Location: /projects/xitTask/");
            exit;
    }

    $_SESSION["pageId"] = $pageId;
    $_SESSION["pageName"] = $pageName;
    $_SESSION["page"] = $page;
    $_SESSION["status"] = $request[1];

?>