<?php

if (isset($_POST["submit"])) {
    $usernameIDVar = $_POST["username_ID"];
    $passwordIDVar = $_POST["password_ID"];

    require_once 'db.inc.php';
    require_once 'regFunctions.inc.php';

    //checking for empty fields in login page
    if (LoginInputEmpty($usernameIDVar, $passwordIDVar) !== false) {
        header("location: ../../UserRegistration/login.php?error=emptyinput");
        exit();
    }

    userLogin($conn, $usernameIDVar, $passwordIDVar);
}
//Else redirecting user back to the login page.
else {
    header("location: ../../UserRegistration/login.php");
    exit();
}
