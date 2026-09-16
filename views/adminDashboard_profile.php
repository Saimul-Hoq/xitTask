<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../views/login.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/admin_model.php");
    $user = getUser($conn, $_SESSION["id"]);
    $errors = $_SESSION["errors"] ?? [];
    $currentEditForm = $_SESSION["editForm"] ?? "";
    unset($_SESSION["errors"], $_SESSION["editForm"]); 
    
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
    <!-- <link rel="stylesheet" href="../css/dashboard.css"> -->
    <link rel="stylesheet" href="../css/adminDashboard_profile.css">
    <link rel="stylesheet" href="../css/navbar.css">


</head>
<body>
    <?php include "../includes/navbar.php" ?>
    <div class="body-content">

        <form id="editPassword-form" class="edit-form" action="../controllers/user_controller.php" method="post">
            <div class="info-field">
                <label class="label text-xl">Current Password: </label>
            
                
                <div class="input-wrapper">
                   <input id="edit-currentPassword" name="currentPassword" type="password" class="input" placeholder="Enter current password" />
                    <i class="fa-solid fa-eye eye-open eye" onclick="toggleCurrentPassword(this)"></i>
                    <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleCurrentPassword(this)"></i>
                </div>

                <p id="edit-currentPassword-error"><?php echo htmlspecialchars($errors["currentPassword"] ?? "") ?></p>
            </div>
           
            <div class="info-field">
                <label class="label text-xl">New Password: </label>
            
               
                <div class="input-wrapper">
                   <input id="edit-newPassword" name="newPassword" type="password" class="input" placeholder="Enter new password" />
                    <i class="fa-solid fa-eye eye-open eye" onclick="toggleNewPassword(this)"></i>
                    <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleNewPassword(this)"></i>
                </div>

                <p id="edit-newPassword-error"><?php echo htmlspecialchars($errors["newPassword"] ?? "") ?></p>
            </div>
            
            <div class="info-field">
                <label class="label text-xl">Confirm New Password: </label>
            
               

                <div class="input-wrapper">
                   <input id="edit-confirmPassword" name="confirmPassword" type="password" class="input" placeholder="Confirm new password" />
                    <i class="fa-solid fa-eye eye-open eye" onclick="toggleConfirmPassword(this)"></i>
                    <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleConfirmPassword(this)"></i>
                </div>

                <p id="edit-confirmPassword-error"><?php echo htmlspecialchars($errors["confirmPassword"] ?? "") ?></p>
            </div>
          

            <input type="hidden" name="action" value="password">

            <button id="editPassword-save-btn" type="submit" class="btn btn-primary">Save</button>
           
        </form>

    </div>
   <script src="../js/passwordField.js"></script>
   <script src="../js/navbar.js"></script>

</body>
</html>