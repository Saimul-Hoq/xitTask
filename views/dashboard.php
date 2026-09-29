
<?php
    if(!isset($_SESSION["id"])){
        header("Location: /projects/xitTask/");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/user_model.php");
    $user = getUser($conn, $_SESSION["id"]);
    if (!$user) {
        session_destroy();
        header("Location: /projects/xitTask/");
        exit();
    }
    $errors = $_SESSION["errors"] ?? [];
    $currentEditForm = $_SESSION["editForm"] ?? "";
    unset($_SESSION["errors"], $_SESSION["editForm"]); 
    
?>

<section id="profile" class="card">
    <div class="side-panel">
        <h4 class="side-panel-heading">BUSINESS SETTINGS</h4>

        <div class="link-container">
            <button onclick="myAccountFunc(this)" id="my-account" class="btn-icon bg-optionSelected" >My Account</button>
            <button onclick="editAccountFunc(this)" id="edit-account" class="btn-icon">Edit Account</button>
        </div>
        
    </div>
    <div class="main-panel">
        <div id="main-upper">
            <h1 id="sidepanel-heading">My Account</h1>

            <h2 id="profile-details-heading" class="text-light">Profile Details</h2>
            
            <div id="profile-photo-section">
                <div class="profile-image">
                    <img src="/projects/xitTask/uploads/<?= htmlspecialchars($user["avatar"]) ?>" alt="Profile Picture">
                </div>
                <div class="change-avatar-part">
                    <button onclick="openEditAvatar(this); editAccountFunc(this)" id="edit-avatar-btn" class="btn-icon">Change Avatar</button>
                    
                    <input readonly name="avatar" id="edit-avatar" type="file" accept="image/*" class="input hidden" placeholder="Enter your profile photo" />

                    <p id="edit-avatar-error"><?php echo htmlspecialchars($errors["avatar"] ?? "") ?></p>
                </div>
                

                <button id="delete-avatar-btn" class="btn-icon">Delete Avatar</button>
            </div>

            <h2 id="business-profile-heading" class="text-light">Business Profile</h2>

            <div id="business-info">
                <div class="info-field">
                    <p>Business Name</p>
                    <input readonly id="edit-name" name="name" type="text" value="<?php echo htmlspecialchars($user["name"] ?? "") ?>" class="input" placeholder="Enter new name" />
                </div>

                <div class="info-field">
                    <p>Business Id</p>
                    <input readonly id="edit-id" name="id" type="text" value="<?php echo htmlspecialchars($user["id"] ?? "") ?>" class="input"/>
                </div>

                <div class="info-field">
                    <p>Location</p>
                    <input readonly id="edit-adress" name="address" type="text" value="<?php echo htmlspecialchars($user["address"] ?? "") ?>" class="input" placeholder="Enter new address" />
                </div>
            </div>

            <div class="email-info-heading">
                <h2 class="text-light">Email</h2>
                <p class="text-md text-gray">This contact will be shown to others publicly, so choose it carefully.</p>
            </div>

            <div class="email-input">
                <input readonly id="edit-email" name="email" type="text" value="<?php echo htmlspecialchars($user["email"] ?? "") ?>" class="input"/>
            </div>

            <div class="email-info-heading">
                <h2 class="text-light">Password</h2>
                <p class="text-md text-gray">You can set a permanent password if you don't want to use temporary login codes.</p>
            </div>


            <div id="password-info">
                <button onclick="openEditPassword(this); editAccountFunc(this)"  id="edit-password-btn" class="btn-icon">Set new password</button>

                <div id="edit-password-fields" class="hidden">
                    <div class="info-field">
                        <p>Current Password</p>
                        <input readonly id="edit-currentPassword" name="currentPassword" type="text" class="input" placeholder="Enter current password" />
                    </div>

                    <div class="info-field">
                        <p>New Password</p>
                        <input readonly id="edit-newPassword" name="newPassword" type="text"  class="input" placeholder="Enter new password"/>
                    </div>

                    <div class="info-field">
                        <p>Confirm Password</p>
                        <input readonly id="edit-confirmPassword" name="confirmPassword" type="text"  class="input" placeholder="Confirm password"/>
                    </div>
                </div>
            </div>


            <div class="email-info-heading">
                <h2 class="text-light">Mobile Number</h2>
                <p class="text-md text-gray">Mobile Number must not be registered before</p>
            </div>

            <div id="edit-mobile-part" class="email-input">
                <input readonly id="edit-mobile" name="mobile" type="text" value="<?php echo htmlspecialchars($user["mobile"] ?? "") ?>" class="input"/>
            </div>
        </div>
        

        <section id="submit-part" class="hidden">
            <div class="btn-container">
                <button type="button" id="submit-cancel-btn" class="btn-icon">Cancel</button>
                <button type="submit" id="submit-btn" class="btn-icon">Submit</button>
            </div>
        </section>

    </div>
</section>

<p id="jsEditForm"><?php echo $currentEditForm ?></p>
<script src="/projects/xitTask/js/dashboard.js"></script>
<script src="/projects/xitTask/js/passwordField.js"></script>

<?php exit() ?>

<section>
    <article class="card" id="profile-block">
        <div class="top">
            <div class="top-left">
                <h3><?php echo htmlspecialchars($user["name"]) ?></h3>
                <p><?php 
                    if($user["role"]===1) {echo "Admin";}
                    elseif($user["role"]===2) {echo "User";}
                ?></p>
            </div>
            <div class="top-right">
                <img src="/projects/xitTask/uploads/<?= htmlspecialchars($user["avatar"]) ?>" alt="Profile Picture">
                <button onclick="openEditAvatarForm(this)" id="profile-editAvatar-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
            </div>
        </div>
        <hr>
        <div class="middle">
            <div class="middle-left">
                    <div class="info-field">
                    <p><span class="text-bold">Name: </span> <?php echo htmlspecialchars($user["name"]??"") ?> </p>
                    <button onclick="openEditNameForm(this)" id="profile-editName-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                    
                </div>

                

                <div class="info-field">
                    <p><span class="text-bold">Email: </span>  <?php echo htmlspecialchars($user["email"] ?? "") ?> </p>
                </div>

                <div class="info-field">
                    <p><span class="text-bold">Mobile: </span>  <?php echo htmlspecialchars($user["mobile"] ?? "") ?> </p>
                    <button onclick="openEditMobileForm(this)" id="profile-editMobile-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="middle-right">
                
                <div class="info-field">
                    <p><span class="text-bold">Address: </span>  <?php echo htmlspecialchars($user["address"] ?? "") ?> </p>
                    <button onclick="openEditAddressForm(this)" id="profile-editAddress-btn" class="btn-icon"><i class="fa-solid fa-pen-to-square"></i></button>
                </div>

                <div class="info-field">
                    <p><span class="text-bold">Register Date: </span> <?php echo htmlspecialchars($user["registerDate"] ? date("j F, Y", strtotime($user["registerDate"])) : "") ?></p>
                    <!-- <button class="btn-icon"><i class="fa-solid fa-angle-right text-xl   "></i></button> -->
                </div>
                

                <div class="info-field" id="change-password">
                    <button onclick="openEditPasswordForm(this)" id="profile-editPassword-btn" class="btn-icon">Password<i class="fa-solid fa-pen-to-square"></i></button>
                </div>

            </div>
        </div>
    </article>

</section>

<form id="editName-form" class="edit-form" action="/projects/xitTask/" method="post">
    <label class="label text-xl">New Name: </label>
    
    <input id="edit-name" name="name" type="text" value="<?php echo htmlspecialchars($user["name"] ?? "") ?>" class="input" placeholder="Enter new name" />

    <p id="edit-name-error"><?php echo htmlspecialchars($errors["name"] ?? "") ?></p>

    <input type="hidden" name="action" value="name">
    <input type="hidden" name="controller" value="user">

    
    <div class="btn-container">
        <button onclick="closeEditNameForm(this)" id="editName-cancel-btn" type="button" class="btn btn-neutral cancel-btn">Cancel</button>
        <button id="editName-save-btn" type="submit" class="btn btn-primary save-btn">Save</button>
    </div>
</form>

<form id="editPassword-form" class="edit-form" action="/projects/xitTask/" method="post">
    <label class="label text-xl">Current Password: </label>
    
    <!-- <input id="edit-currentPassword" name="currentPassword" type="password" class="input" placeholder="Enter current password" /> -->

    <div class="input-wrapper">
        <input id="edit-currentPassword" name="currentPassword" type="password" class="input" placeholder="Enter current password" />
        <i class="fa-solid fa-eye eye-open eye" onclick="toggleCurrentPassword(this)"></i>
        <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleCurrentPassword(this)"></i>
    </div>

    <p id="edit-currentPassword-error"><?php echo htmlspecialchars($errors["currentPassword"] ?? "") ?></p>

    <label class="label text-xl">New Password: </label>
    
    <!-- <input id="edit-newPassword" name="newPassword" type="password" class="input" placeholder="Enter new password" /> -->

    <div class="input-wrapper">
        <input id="edit-newPassword" name="newPassword" type="password" class="input" placeholder="Enter new password" />
        <i class="fa-solid fa-eye eye-open eye" onclick="toggleNewPassword(this)"></i>
        <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleNewPassword(this)"></i>
    </div>

    <p id="edit-newPassword-error"><?php echo htmlspecialchars($errors["newPassword"] ?? "") ?></p>

    <label class="label text-xl">Confirm New Password: </label>
    
    <!-- <input id="update-confirmPassword" name="confirmPassword" type="password" class="input" placeholder="Confirm new password" /> -->

    <div class="input-wrapper">
        <input id="edit-confirmPassword" name="confirmPassword" type="password" class="input" placeholder="Confirm new password" />
        <i class="fa-solid fa-eye eye-open eye" onclick="toggleConfirmPassword(this)"></i>
        <i class="fa-solid fa-eye-slash eye-close hidden eye" onclick="toggleConfirmPassword(this)"></i>
    </div>

    <p id="edit-confirmPassword-error"><?php echo htmlspecialchars($errors["confirmPassword"] ?? "") ?></p>

    <input type="hidden" name="action" value="password">
    <input type="hidden" name="controller" value="user">


    <div class="btn-container">
        <button onclick="closeEditPasswordForm(this)" id="editPassword-cancel-btn" type="button" class="btn btn-neutral cancel-btn">Cancel</button>
        <button id="editPassword-save-btn" type="submit" class="btn btn-primary save-btn">Save</button>
    </div>
</form>

<form id="editMobile-form" class="edit-form" action="/projects/xitTask/" method="post">
    <label class="label text-xl">New Mobile: </label>
    
    <input id="edit-mobile" name="mobile" type="text" value="<?php echo htmlspecialchars($user["mobile"] ?? "") ?>" class="input" placeholder="Enter new mobile number" />

    <p id="edit-mobile-error"><?php echo htmlspecialchars($errors["mobile"] ?? "") ?></p>

    <input type="hidden" name="action" value="mobile">
    <input type="hidden" name="controller" value="user">


    <div class="btn-container">
        <button onclick="closeEditMobileForm(this)" id="editMobile-cancel-btn" type="button" class="btn btn-neutral cancel-btn">Cancel</button>
        <button id="editMobile-save-btn" type="submit" class="btn btn-primary save-btn">Save</button>
    </div>
</form>

<form id="editAddress-form" class="edit-form" action="/projects/xitTask/" method="post">
    <label class="label text-xl">New Address: </label>
    
    <input id="edit-address" name="address" type="text" value="<?php echo htmlspecialchars($user["address"] ?? "") ?>" class="input" placeholder="Enter new address" />

    <p id="edit-address-error"><?php echo htmlspecialchars($errors["address"] ?? "") ?></p>

    <input type="hidden" name="action" value="address">
    <input type="hidden" name="controller" value="user">


    <div class="btn-container">
        <button onclick="closeEditAddressForm(this)" id="editAddress-cancel-btn" type="button" class="btn btn-neutral cancel-btn">Cancel</button>
        <button id="editAddress-save-btn" type="submit" class="btn btn-primary save-btn">Save</button>
    </div>
</form> 


<form id="editAvatar-form" class="edit-form" action="/projects/xitTask/" method="post" enctype="multipart/form-data">
    <label class="label text-xl">New Profile Photo: </label>
    
    <input name="avatar" id="edit-avatar" type="file" accept="image/*" class="input" placeholder="Enter your profile photo" />

    <p id="edit-avatar-error"><?php echo htmlspecialchars($errors["avatar"] ?? "") ?></p>

    <input type="hidden" name="action" value="avatar">
    <input type="hidden" name="controller" value="user">


    <div class="btn-container">
        <button onclick="closeEditAvatarForm(this)" id="editAvatar-cancel-btn" type="button" class="btn btn-neutral cancel-btn">Cancel</button>
        <button id="editAvatar-save-btn" type="submit" class="btn btn-primary save-btn">Save</button>
    </div>
</form> 

