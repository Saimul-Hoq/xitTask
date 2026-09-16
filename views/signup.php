<?php
    session_start();
    $errors = $_SESSION["errors"] ?? [];
    $oldEmail = $_SESSION["oldEmail"] ?? "";
    $oldName = $_SESSION["oldName"] ?? "";
    $oldMobile = $_SESSION["oldMobile"] ?? "";
    $oldAddress = $_SESSION["oldAddress"] ?? "";
    $showSuccess = isset($_GET['status']) && $_GET['status'] === 'success';

    unset($_SESSION["errors"], $_SESSION["oldEmail"], $_SESSION["oldName"], $_SESSION["oldMobile"], $_SESSION["oldAddress"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xitTask|signup</title>
     <link rel="shortcut icon" href="../assets/xit_logo.png" type="image/x-icon">
    
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    
    
    <form id="signup-form" action="../controllers/auth_controller.php" method="post" enctype="multipart/form-data">
    <fieldset id="fieldset">
        <h4 class="text-center">Register Your Account</h4>
        <hr>
        <div class="field-area">
            <div class="left">
                <div class="field">
                    <label class="label">Name: </label> <br>
                    
                    <input name="name" id="signup-name" type="text" class="input" placeholder="Enter your name" value="<?php echo htmlspecialchars($oldName) ?>"/>

                    <p id="signup-name-error"><?php echo htmlspecialchars($errors["name"] ?? "") ?></p>
                </div>
               
                <div class="field">
                    <label class="label">Email: </label> <br>
                   
                    <input name="email" id="signup-email" type="text" class="input" placeholder="Enter your email" value="<?php echo htmlspecialchars($oldEmail) ?>"/>

                    <p id="signup-email-error"><?php echo htmlspecialchars($errors["email"] ?? "") ?></p>
                </div>
               
                <div class="field">
                    <label class="label">Password: </label> <br>
                    
                    <input name="password" id="signup-password" type="password" class="input" placeholder="Enter your password" />

                    <p id="signup-password-error"><?php echo htmlspecialchars($errors["password"] ?? "") ?></p>
                </div>
               
            </div>
            <div class="right">
                <div class="field">
                    <label class="label">Phone Number: </label> <br>
                    
                    <input name="mobile" id="signup-mobile" type="text" class="input" placeholder="01XXXXXXXXX" value="<?php echo htmlspecialchars($oldMobile) ?>"/>

                    <p id="signup-mobile-error"><?php echo htmlspecialchars($errors["mobile"] ?? "") ?></p>
                </div>
               
                <div class="field">
                    <label class="label">Avatar: </label> <br>
                   
                    <input name="avatar" id="signup-avatar" type="file" accept="image/*" class="input" placeholder="Enter your profile photo (optional)" />

                    <p id="signup-avatar-error"><?php echo htmlspecialchars($errors["avatar"] ?? "") ?></p>
                </div>
               
                <div class="field">
                    <label class="label">Address: </label> <br>
                   
                    <input name="address" id="signup-address" type="text" class="input" placeholder="Enter your address" value="<?php echo htmlspecialchars($oldAddress) ?>"/>

                    <p id="signup-address-error"><?php echo htmlspecialchars($errors["address"] ?? "") ?></p>
                </div>
                <input type="hidden" name="action" value="signup">

            </div>
        </div>
        <div class="btn-area">
            <a id="signup-back-btn" class="btn btn-neutral" href="./login.php">Back</a>
           

            <button id="signup-register-btn" type="submit" id="signup-register-btn" class="btn btn-primary">Register</button>
        </div>
    </fieldset>
    </form>
   

  

    <fieldset id="successPopup">
        <p>Your account is waiting for admin's approval. Before login please wait until admin approves.</p>
        <h4 id="status" class="hidden"><?php echo $showSuccess?"true":"false" ?></h4>
        <a href="./login.php" class="btn-icon">Ok</a>
    </fieldset>

    <script type="module" src="../js/signup.js"></script>
</body>
</html>