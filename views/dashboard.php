<?php
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: ../controllers/logout_controller.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../controllers/getUser_controller.php");
    $user = getCurrentUser($pdo, $_SESSION["email"]);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xit|User Dashboard</title>
     <link rel="shortcut icon" href="../assets/xit_logo.png" type="image/x-icon">
    
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-start">
            <h3>Profile</h3>
        </div>
        <div class="navbar-end">
            <a class="btn-ghost text-xl" href="../controllers/logout_controller.php">Logout   <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>
    <div class="body-content">
        <fieldset id="profile-block">
            <div class="top">
                <div class="top-left">
                    <h3><?php echo htmlspecialchars($user["name"]) ?></h3>
                    <p><?php 
                        if($user["role"]===1) {echo "Admin";}
                        elseif($user["role"]===2) {echo "User";}
                    ?></p>
                </div>
                <div class="top-right">
                    <img src="../uploads/<?= htmlspecialchars($user["avatar"]) ?>" alt="Profile Picture">
                </div>
            </div>
            <hr>
            <div class="middle">
                <div class="middle-left">
                     <div class="info-field">
                        <p><span class="text-bold">Name: </span> <?php echo htmlspecialchars($user["name"]??"") ?> </p>
                        <button id="profile-changeName-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square text-md"></i></button>
                        
                    </div>

                    <div class="info-field">
                        <p><span class="text-bold">Password: </span>*****</p>
                        <button id="profile-changePassword-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square text-md"></i></button>
                    </div>

                    <div class="info-field">
                        <p><span class="text-bold">Email: </span>  <?php echo htmlspecialchars($user["email"] ?? "") ?> </p>
                    </div>
                </div>
                <div class="middle-right">
                     <div class="info-field">
                        <p><span class="text-bold">Mobile: </span>  <?php echo htmlspecialchars($user["mobile"] ?? "") ?> </p>
                        <button id="profile-changeMobile-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square text-md   "></i></button>
                    </div>

                    <div class="info-field">
                      <p><span class="text-bold">Register Date: </span> <?php echo htmlspecialchars($user["registerDate"] ? date("j F, Y", strtotime($user["registerDate"])) : "") ?></p>
                        <!-- <button class="btn-icon"><i class="fa-solid fa-angle-right text-xl   "></i></button> -->
                    </div>
                    <div class="info-field">
                        <p><span class="text-bold">Address: </span>  <?php echo htmlspecialchars($user["address"] ?? "") ?> </p>
                        <button id="profile-changeAddress-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square text-md"></i></button>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
   
</body>
</html>