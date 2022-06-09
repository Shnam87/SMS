<?php

require_once __DIR__ ."/../Classes/Template.php";
// require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$googleLoginButton = '<a href="' . $google_client->createAuthUrl() . '"> <button class="google-btn"> </button> </a>';

Template::header("Logging In ...");
?>

<h2>Login with your username here:</h2>

<form action="/sms/Scripts/logging-in.php" method="post">
    <input type="text" class="login-field" required name="username" placeholder="Username" autofocus> <br>
    <input type="password" class="login-field" required name="password" placeholder="Password"> <br>
    <input type="submit" class="btn-login" value="login"> <br>
</form>

<h2>Or login with your google account here:</h2>
<?= $googleLoginButton ?>

<?php    

Template::footer();
?>
