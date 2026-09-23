<?php
    if(isset($_SESSION["pageId"])){
        $pageId = $_SESSION["pageId"];
        switch($pageId){
            case 3:
                include(__DIR__."/includes/userNavbar.php");
                break;
            case 4: case 5: case 6:
                include(__DIR__."/includes/navbar.php");
                break;
        }
    }
?>