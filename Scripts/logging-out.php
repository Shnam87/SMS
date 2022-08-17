<?php

session_start();

session_destroy();
/*
$_SESSION["loggedIn"] = false;
$_SESSION["user"] = null;
*/
header("Location: /sms");