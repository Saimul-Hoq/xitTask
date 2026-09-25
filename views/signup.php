<?php
    session_start();
    $errors = $_SESSION["errors"] ?? [];
    $oldEmail = $_SESSION["oldEmail"] ?? "";
    $oldName = $_SESSION["oldName"] ?? "";
    $oldMobile = $_SESSION["oldMobile"] ?? "";
    $oldAddress = $_SESSION["oldAddress"] ?? "";
    $showSuccess = isset($_SESSION['status']) && $_SESSION['status'] === 'success';

    unset($_SESSION["errors"], $_SESSION["oldEmail"], $_SESSION["oldName"], $_SESSION["oldMobile"], $_SESSION["oldAddress"]);
?>


<section>
    <form id="signup-form" action="/projects/xitTask/" method="post" enctype="multipart/form-data">
        <h4 class="text-center">Register Your Account</h4>
        <hr>
        <div id="signup-field-area">
            <div class="signup-left">
                <div class="signup-field">
                    <label class="label">Name: </label> <br>
                    
                    <input name="name" id="signup-name" type="text" class="input signup-input" placeholder="Enter your name" value="<?php echo htmlspecialchars($oldName) ?>"/>

                    <p id="signup-name-error"><?php echo htmlspecialchars($errors["name"] ?? "") ?></p>
                </div>
                
                <div class="signup-field">
                    <label class="label">Email: </label> <br>
                    
                    <input name="email" id="signup-email" type="text" class="input signup-input" placeholder="Enter your email" value="<?php echo htmlspecialchars($oldEmail) ?>"/>

                    <p id="signup-email-error"><?php echo htmlspecialchars($errors["email"] ?? "") ?></p>
                </div>
                
                <div class="signup-field">
                    <label class="label">Password: </label> <br>
                    
                    <input name="password" id="signup-password" type="password" class="input signup-input" placeholder="Enter your password" />

                    <p id="signup-password-error"><?php echo htmlspecialchars($errors["password"] ?? "") ?></p>
                </div>
                
            </div>
            <div class="signup-right">
                <div class="signup-field">
                    <label class="label">Phone Number: </label> <br>
                    
                    <input name="mobile" id="signup-mobile" type="text" class="input signup-input" placeholder="01XXXXXXXXX" value="<?php echo htmlspecialchars($oldMobile) ?>"/>

                    <p id="signup-mobile-error"><?php echo htmlspecialchars($errors["mobile"] ?? "") ?></p>
                </div>
                
                <div class="signup-field">
                    <label class="label">Avatar: </label> <br>
                    
                    <input name="avatar" id="signup-avatar" type="file" accept="image/*" class="input signup-input" placeholder="Enter your profile photo (optional)" />

                    <p id="signup-avatar-error"><?php echo htmlspecialchars($errors["avatar"] ?? "") ?></p>
                </div>
                
                <div class="signup-field">
                    <label class="label">Address: </label> <br>
                    
                    <input name="address" id="signup-address" type="text" class="input signup-input" placeholder="Enter your address" value="<?php echo htmlspecialchars($oldAddress) ?>"/>

                    <p id="signup-address-error"><?php echo htmlspecialchars($errors["address"] ?? "") ?></p>
                </div>
                <input type="hidden" name="action" value="signup">

            </div>
        </div>
        <div class="signup-btn-area">
            <a id="signup-back-btn" class="btn signup-btn btn-neutral" href="/projects/xitTask/">Back</a>
            

            <button id="signup-register-btn" type="submit" id="signup-register-btn" class="btn signup-btn btn-primary">Register</button>
        </div>
    </form>
</section>




<fieldset id="successPopup">
    <p>Your account is waiting for admin's approval. Before login please wait until admin approves.</p>
    <h4 id="status" class="hidden"><?php echo $showSuccess?"true":"false" ?></h4>
    <a href="/projects/xitTask/" class="btn-icon">Ok</a>
</fieldset>


<script type="module" src="/projects/xitTask/js/signup.js"></script>