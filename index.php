<?php

    session_start();
    include(__DIR__."/config/database.php");
    include(__DIR__."/controller.php");
    include(__DIR__."/router.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php 
        include(__DIR__."/includes/headContent.php");
    ?>
</head>
<body>
    <header>
        <?php include(__DIR__."/header.php") ?>
    </header>
    <main>
        <?php include(__DIR__."/body.php") ?>
    </main>
</body>
</html>