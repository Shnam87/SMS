<?php

require_once __DIR__ . "/../Classes/Template.php";
// require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$googleLoginButton = '<a href="' . $google_client->createAuthUrl() . '"> <button class="google-btn"> </button> </a>';

Template::header("Login / Register");

?>

<main class="login-page-main">

    <section class="login-section">
        <h2 class="login-page-h2">Already a member?</h2>
        <h3></h3>
        <h3>Login with your username:</h3>
        <form action="/sms/Scripts/logging-in.php" method="post">
            <input type="text" id="username" class="login-field" required name="username" placeholder="Username" autofocus> <br>
            <input type="password" id="password" class="login-field" required name="password" placeholder="Password"> <br>
            <input type="submit" class="btn-login" value="login">
        </form>
        <?php if (isset($_GET["error"]) && $_GET["error"] == "wrong_login") : ?>
            <h3 class="error-msg">Username or password is incorrect</h3>
        <?php endif ; ?>
        <h3 class="g-login-text">Or with a google account:</h3>
        <?= $googleLoginButton ?>
    </section>

    <hr class="login-hr">

    <section class="register-section">
        <h2 class="login-page-h2">New here?</h2>
        <h3>Become a member in one click</h3>
        <form action="/sms/Scripts/registering.php" method="post">
            <input type="text" id="username" class="registering-field" required name="username" placeholder="Username" autofocus> <br>
            <input type="password" id="password" class="registering-field" required name="password" placeholder="Password"> <br>
            <input type="password" id="password" class="registering-field" required name="confirm-password" placeholder="Confirm password"> <br>
            <input type="submit" class="btn-register" value="Register">
        </form>
        <?php if (isset($_GET["error"]) && $_GET["error"] == "username_taken") : ?>
            <h3 class="error-msg">This Username is already taken, choose a another one</h3>
        <?php endif ; ?>
    </section>

</main>

<?php

Template::footer();
?>