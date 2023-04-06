<?php

//Checking to see if the user actually signed up.
if (isset($_POST["submit_button"])) {
    echo "User has signed up!";

    //error handling

    $firstNameVar = $_POST["first_name"];
    $lastNameVar = $_POST["last_name"];
    $emailIDVar = $_POST["email_ID"];
    $addressIDVar = $_POST["address_ID"];
    $usernameIDVar = $_POST["username_ID"];
    $passwordIDVar = $_POST["password_ID"];

    require_once 'db.inc.php';
    require_once 'regFunctions.inc.php';

    //checking for empty fields in signup page
    if (signupInputEmpty($firstNameVar, $lastNameVar, $emailIDVar, $addressIDVar, $usernameIDVar, $passwordIDVar) !== false) {
        header("location: ../UserRegistration/signup.php?error=emptyinput");
        exit();
    }

    //checking for invalid username in signup page
    if (invalidUsername($usernameIDVar) !== false) {
        header("location: ../UserRegistration/signup.php?error=invalidusername");
        exit();
    }

    //checking to see if username already exists in database
    if (duplicateUsername($conn, $usernameIDVar) !== false) {
        header("location: ../UserRegistration/signup.php?error=usernamealreadyexists");
        exit();
    }

    //checking for invalid email in signup page
    if (invalidEmail($emailIDVar) !== false) {
        header("location: ../UserRegistration/signup.php?error=invalidemail");
        exit();
    }

    //Create an account for the user if all of the conditions above have been met
    createUserAcc($conn, $usernameIDVar, $firstNameVar, $lastNameVar, $passwordIDVar, $emailIDVar, $addressIDVar);
}

//Else redirecting user back to the signup page.
else {
    header("location: ../UserRegistration/signup.php");
    exit();
}
