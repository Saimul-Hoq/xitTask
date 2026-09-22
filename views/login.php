<?php

    // session_start();
    $errors = $_SESSION['errors'] ?? [];
    $oldEmail = $_SESSION['oldEmail'] ?? '';

    unset($_SESSION['errors'], $_SESSION['oldEmail']);

    $BASE_PATH = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

?>
 <form class="" action="./controllers/auth_controller.php" method="post">

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
        

        <p class="text-center text-lg">Don't have an account? <a href="/projects/xitTask/signup">signup</a> </p>
    </div>
    

</form>
<script src="../js/login.js"></script>