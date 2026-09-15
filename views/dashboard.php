<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../views/login.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/user_model.php");
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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-start">
            <h3>Profile</h3>
        </div>
        <div class="navbar-end">
           <a class="btn-ghost text-bold" href="../controllers/auth_controller.php?action=logout">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>
    <div class="body-content">
        <fieldset class="profile-block">
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
                        <button id="profile-editName-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                        
                    </div>

                    <div class="info-field">
                        <p><span class="text-bold">Password: </span>*****</p>
                        <button id="profile-editPassword-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                    </div>

                    <div class="info-field">
                        <p><span class="text-bold">Email: </span>  <?php echo htmlspecialchars($user["email"] ?? "") ?> </p>
                    </div>
                </div>
                <div class="middle-right">
                     <div class="info-field">
                        <p><span class="text-bold">Mobile: </span>  <?php echo htmlspecialchars($user["mobile"] ?? "") ?> </p>
                        <button id="profile-editMobile-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                    </div>

                    <div class="info-field">
                      <p><span class="text-bold">Register Date: </span> <?php echo htmlspecialchars($user["registerDate"] ? date("j F, Y", strtotime($user["registerDate"])) : "") ?></p>
                        <!-- <button class="btn-icon"><i class="fa-solid fa-angle-right text-xl   "></i></button> -->
                    </div>
                    <div class="info-field">
                        <p><span class="text-bold">Address: </span>  <?php echo htmlspecialchars($user["address"] ?? "") ?> </p>
                        <button id="profile-editAddress-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                    </div>
                </div>
            </div>
        </fieldset>

        <form id="editName-form" class="edit-form" action="../controllers/user_controller.php" method="post">
            <label class="label text-xl">New Name: </label>
           
            <input id="edit-name" name="name" type="text" value="<?php echo htmlspecialchars($user["name"] ?? "") ?>" class="input" placeholder="Enter new name" />

            <p id="edit-name-error"><?php echo htmlspecialchars($errors["name"] ?? "") ?></p>

            <input type="hidden" name="action" value="name">
            
            <div class="btn-container">
                <button id="editName-cancel-btn" type="button" class="btn btn-neutral">Cancel</button>
                <button id="editName-save-btn" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        <form id="editPassword-form" class="edit-form" action="../controllers/user_controller.php" method="post">
            <label class="label text-xl">Current Password: </label>
           
            <input id="edit-currentPassword" name="currentPassword" type="password" class="input" placeholder="Enter current password" />

            <p id="edit-currentPassword-error"><?php echo htmlspecialchars($errors["currentPassword"] ?? "") ?></p>

            <label class="label text-xl">New Password: </label>
            
            <input id="edit-newPassword" name="newPassword" type="password" class="input" placeholder="Enter new password" />

            <p id="edit-newPassword-error"><?php echo htmlspecialchars($errors["newPassword"] ?? "") ?></p>

            <label class="label text-xl">Confirm New Password: </label>
           
            <input id="update-confirmPassword" name="confirmPassword" type="password" class="input" placeholder="Confirm new password" />

            <p id="edit-confirmPassword-error"><?php echo htmlspecialchars($errors["confirmPassword"] ?? "") ?></p>

            <input type="hidden" name="action" value="password">

            <div class="btn-container">
                <button id="editPassword-cancel-btn" type="button" class="btn btn-neutral">Cancel</button>
                <button id="editPassword-save-btn" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <form id="editMobile-form" class="edit-form" action="../controllers/user_controller.php" method="post">
            <label class="label text-xl">New Mobile: </label>
           
            <input id="edit-mobile" name="mobile" type="text" value="<?php echo htmlspecialchars($user["mobile"] ?? "") ?>" class="input" placeholder="Enter new mobile number" />

            <p id="edit-mobile-error"><?php echo htmlspecialchars($errors["mobile"] ?? "") ?></p>

            <input type="hidden" name="action" value="mobile">

            <div class="btn-container">
                <button id="editMobile-cancel-btn" type="button" class="btn btn-neutral">Cancel</button>
                <button id="editMobile-save-btn" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        <form id="editAddress-form" class="edit-form" action="../controllers/user_controller.php" method="post">
            <label class="label text-xl">New Address: </label>
           
            <input id="edit-address" name="address" type="text" value="<?php echo htmlspecialchars($user["address"] ?? "") ?>" class="input" placeholder="Enter new address" />

            <p id="edit-address-error"><?php echo htmlspecialchars($errors["address"] ?? "") ?></p>

            <input type="hidden" name="action" value="address">

            <div class="btn-container">
                <button id="editAddress-cancel-btn" type="button" class="btn btn-neutral">Cancel</button>
                <button id="editAddress-save-btn" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form> 
    </div>
    <p id="jsEditForm"><?php echo $currentEditForm ?></p>
   <script type="module" src="../js/dashboard.js"></script>
</body>
</html>