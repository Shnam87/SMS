<?php

require_once __DIR__ ."/../Classes/Template.php";

Template::header("Registering");
?>

<h2>Register here:</h2>

<form action="/sms/Scripts/registering.php" method="post">
    <input type="text" class="registering-field" required name="username" placeholder="Username" autofocus> <br>
    <input type="password" class="registering-field" required name="password" placeholder="Password"> <br>
    <input type="submit" class="btn-register" value="Register"> <br>
</form>

<?php    

Template::footer();
?>
