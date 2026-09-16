<?php

    session_start();
    $errors = $_SESSION['errors'] ?? [];
    $oldEmail = $_SESSION['oldEmail'] ?? '';

    unset($_SESSION['errors'], $_SESSION['oldEmail']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xitTask|login</title>
    <link rel="shortcut icon" href="../assets/xit_logo.png" type="image/x-icon">
    
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    
    <br>
    <br>
    <form class="" action="../controllers/auth_controller.php" method="post">

        <div class="stack">
            <h3 class="text-center">Login To Your Account</h3>
            <br>
            <hr>
        </div>
       

        <div class="stack">
            <label class="label">Email: </label>
            <input id="login-email" name="email" type="text" value="<?php echo htmlspecialchars($oldEmail) ?>" class="input" placeholder="<?php echo htmlspecialchars($errors["email"] ?? "Enter you email") ?>" />
            <p id="login-email-error"><?php echo htmlspecialchars($errors["email"] ?? "") ?></p>
        </div>
        
        <div class="stack">
            <label class="label">Password: </label>
            
            <div class="input-wrapper">
                <input id="login-password" name="password" type="password" class="input" placeholder="Enter your password"  />
                <i onclick="eyeOpenFn(this)" id="eye-open" class="fa-solid fa-eye "></i>
                <i onclick="eyeCloseFn(this)" id="eye-close" class="fa-solid fa-eye-slash  hidden"></i>
            </div>
            
            <p id="login-password-error"><?php echo htmlspecialchars($errors["password"] ?? "") ?></p>
        </div>
       

        <input type="hidden" name="action" value="login">

        <div class="stack btn-container">
            <button type="submit" id="login-btn" class="btn btn-primary text-xl">Login</button>
            <p class="text-center text-lg">Don't have an account? <a href="./signup.php">signup</a> </p>
        </div>
       

    </form>
    <script src="../js/login.js"></script>
</body>
</html>