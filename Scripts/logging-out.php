<?php

session_start();

$_SESSION["loggedIn"] = false;
$_SESSION["user"] = null;

header("Location: /sms");