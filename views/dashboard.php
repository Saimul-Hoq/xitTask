
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
    <h1 id="mainHeading">Account Settings</h1>
    <div class="side-panel">
        <h4 class="side-panel-heading">BUSINESS SETTINGS</h4>

        <div class="link-container">
            <a href="/projects/xitTask/user" id="my-account" class="btn-icon bg-optionSelected" >My Account</a>
            <a href="/projects/xitTask/user/editProfile" id="edit-account" class="btn-icon">Edit Account</a>
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
                
                <div class="username">
                    <h1><?php echo htmlspecialchars($user["name"]??"") ?></h1>
                    <p class="text-gray">User</p>
                </div>
            </div>

            <h2 id="business-profile-heading" class="text-light">Business Profile</h2>

            <div id="business-info">
                <div class="info-field">
                    <p>Business Name</p>
                    <input readonly id="edit-name" name="name" type="text" value="<?php echo htmlspecialchars($user["name"] ?? "") ?>" class="input"/>
                </div>

                <div class="info-field">
                    <p>Business Id</p>
                    <input readonly id="edit-id" name="id" type="text" value="<?php echo htmlspecialchars($user["id"] ?? "") ?>" class="input"/>
                </div>

                <div class="info-field">
                    <p>Location</p>
                    <input readonly id="edit-adress" name="address" type="text" value="<?php echo htmlspecialchars($user["address"] ?? "") ?>" class="input"/>
                </div>
            </div>
            <div id="contact-info">
                <div class="info-field">
                    <p>Email</p>
                    <input readonly id="edit-email" name="email" type="text" value="<?php echo htmlspecialchars($user["email"] ?? "") ?>" class="input"/>
                </div>
                <div class="info-field">
                    <p>Mobile Number</p>
                    <input readonly id="edit-mobile" name="mobile" type="text" value="<?php echo htmlspecialchars($user["mobile"] ?? "") ?>" class="input"/>
                </div>
            </div>

          
        </div>

    </div>
</section>

