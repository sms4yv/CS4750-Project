<?php
//https://stackoverflow.com/questions/3512507/proper-way-to-logout-from-a-session-in-php
//used this to learn how to make sure that hte session variables are unset
//https://www.studentstutorial.com/php/login-logout-with-session
session_start();


unset($_SESSION["name"]);

session_destroy();
header("Location: login.php");
?>