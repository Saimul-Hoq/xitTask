<?php
    session_start();
    $errors = $_SESSION["errors"] ?? [];
    $oldEmail = $_SESSION["oldEmail"] ?? "";
    $oldName = $_SESSION["oldName"] ?? "";
    $oldMobile = $_SESSION["oldMobile"] ?? "";
    $oldAddress = $_SESSION["oldAddress"] ?? "";

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
    
    
    <form action="../controllers/signup_controller.php" method="post" enctype="multipart/form-data">
        <h4 class="text-center">Register Your Account</h4>
        <hr>
        <div class="field-area">
            <div class="left">
                <div class="field">
                     <label class="label text-xl">Name: </label> <br>
                    <p id="signup-name-error"><?php echo $errors["name"] ?? "" ?></p>
                    <input name="name" id="signup-name" type="text" class="input" placeholder="Enter your name" value="<?php echo htmlspecialchars($oldName) ?>"/>
                </div>
               
                <div class="field">
                    <label class="label text-xl">Email: </label> <br>
                    <p id="signup-email-error"><?php echo $errors["email"] ?? "" ?></p>
                    <input name="email" id="signup-email" type="text" class="input" placeholder="Enter your email" value="<?php echo htmlspecialchars($oldEmail) ?>"/>
                </div>
               
                <div class="field">
                    <label class="label text-xl">Password: </label> <br>
                    <p id="signup-password-error"><?php echo $errors["password"] ?? "" ?></p>
                    <input name="password" id="signup-password" type="password" class="input" placeholder="Enter your password" />
                </div>
               
            </div>
            <div class="right">
                <div class="field">
                    <label class="label text-xl">Phone Number: </label> <br>
                    <p id="signup-mobile-error"><?php echo $errors["mobile"] ?? "" ?></p>
                    <input name="mobile" id="signup-mobile" type="text" class="input" placeholder="01XXXXXXXXX" value="<?php echo htmlspecialchars($oldMobile) ?>"/>
                </div>
               
                <div class="field">
                    <label class="label text-xl">Avatar: </label> <br>
                    <p id="signup-avatar-error"><?php echo $errors["avatar"] ?? "" ?></p>
                    <input name="avatar" id="signup-avatar" type="file" accept="image/*" class="input" placeholder="Enter your profile photo (optional)" />
                </div>
               
                <div class="field">
                    <label class="label text-xl">Address: </label> <br>
                    <p id="signup-address-error"><?php echo $errors["address"] ?? "" ?></p>
                    <input name="address" id="signup-address" type="text" class="input" placeholder="Enter your address" value="<?php echo htmlspecialchars($oldAddress) ?>"/>
                </div>
               
            </div>
        </div>
        <div class="btn-area">
            <a class="btn btn-neutral" href="./login.php">Back</a>

            <button type="submit" id="signup-register-btn" class="btn btn-primary text-xl">Register</button>
        </div>
    </form>
</body>
</html>