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
    <h3>Login To Your Account</h3>
    <br>
    <br>
    <form class="" action="../controllers/auth_controller.php" method="post">

        <label class="label text-xl">Email: </label>
        <input id="login-email" name="email" type="text" value="<?php echo htmlspecialchars($oldEmail) ?>" class="input" placeholder="<?php echo htmlspecialchars($errors["email"] ?? "Enter you email") ?>" />
        <p id="login-email-error"><?php echo htmlspecialchars($errors["email"] ?? "") ?></p>

        <label class="label  text-xl">Password: </label>
        <input id="login-password" name="password" type="password" class="input" placeholder="Enter your password" />
        <p id="login-password-error"><?php echo htmlspecialchars($errors["password"] ?? "") ?></p>

        <input type="hidden" name="action" value="login">

        <button type="submit" id="login-btn" class="btn btn-primary text-xl">Login</button>
        <p class="text-center">Don't have an account? <a href="./signup.php">signup</a> </p>

    </form>
</body>
</html>