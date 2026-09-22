<?php
    if(isset($_SESSION["page"])){
        include(__DIR__.$_SESSION['page']);
    }
    else{
        include(__DIR__."/views/login.php");
    }
?>