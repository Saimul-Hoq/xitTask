<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: /projects/xitTask/");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/admin_model.php");
    $user = getUser($conn, $_SESSION["id"]);
    $errors = $_SESSION["errors"] ?? [];
    $currentEditForm = $_SESSION["editForm"] ?? "";
    unset($_SESSION["errors"], $_SESSION["editForm"]); 
    
?>

<section>
    <form id="editPassword-form" class="edit-form" action="/projects/xitTask/" method="post">
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
        <input type="hidden" name="controller" value="admin">


        <button id="editPassword-save-btn" type="submit" class="btn btn-primary">Save</button>
        
    </form>
</section>


<script src="/projects/xitTask/js/passwordField.js"></script>
<script src="/projects/xitTask/js/navbar.js"></script>