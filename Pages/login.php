<?php

require_once __DIR__ . "/../Classes/Template.php";
// require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$googleLoginButton = '<a href="' . $google_client->createAuthUrl() . '"> <button class="google-btn"> </button> </a>';

Template::header("Login / Register");
?>

<main class="login-page-main">
    <div class="section-wrapper">
        <h2 class="login-h2">Login</h2>
        <h3 class="login-h3">Welcome back!</h3>
        <div class="login-wrapper">
            <?php if (isset($_GET["error"]) && $_GET["error"] == "wrong_login") : ?>
                <h3 class="login-error-msg">Incorrect username and/or password. Try again.</h3>
            <?php endif ; ?>
            <form action="/sms/Scripts/logging-in.php" method="post">
                <input type="text" id="username" class="login-input" required name="username" placeholder="Username" autofocus> <br>
                <input type="password" id="password" class="login-input" required name="password" placeholder="Password"> <br>
                <input type="submit" class="login-btn" value="Login">
            </form>
        </div>
        
        <h3 class="g-login-text">Or use Google:</h3>
        <?= $googleLoginButton ?>
    </div>
    <div class="section-wrapper">
        <h2 class="login-h2">Register</h2>
        <h3 class="login-h3">Let's get you connected.</h3>
        <?php if (isset($_GET["error"]) && $_GET["error"] == "username_taken") : ?>
                <h3 class="login-error-msg">That username is already taken. Try another.</h3>
            <?php endif ; ?>
        <div class="login-wrapper">
            <form action="/sms/Scripts/registering.php" method="post">
                <input type="text" id="username" class="login-input" required name="username" placeholder="Username" autofocus> <br>
                <input type="password" id="password" class="login-input" required name="password" placeholder="Password"> <br>
                <input type="password" id="password" class="login-input" required name="confirm-password" placeholder="Confirm password"> <br>
                <input type="submit" class="login-btn" value="Register">
            </form>  
        </div>
    </div>
</main>

<?php

Template::footer();
?>