<?php

function signupInputEmpty($firstNameVar, $lastNameVar, $emailIDVar, $addressIDVar, $usernameIDVar, $passwordIDVar)
{
    $outcome = null;

    if (empty($firstNameVar) || empty($lastNameVar) || empty($emailIDVar) || empty($addressIDVar) || empty($usernameIDVar) || empty($passwordIDVar)) {
        $outcome = true;
    } else {
        $outcome = false;
    }
    return $outcome;
}

function invalidUsername($usernameIDVar)
{
    $outcome = null;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $usernameIDVar)) {
        $outcome = true;
    } else {
        $outcome = false;
    }
    return $outcome;
}

function invalidEmail($emailIDVar)
{
    $outcome = null;

    if (!filter_var($emailIDVar, FILTER_VALIDATE_EMAIL)) {
        $outcome = true;
    } else {
        $outcome = false;
    }
    return $outcome;
}

function duplicateUsername($conn, $usernameIDVar)
{

    $sqlVar = "SELECT * FROM user WHERE username = ?;";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sqlVar)) {
        header("location: ../UserRegistration/signup.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "s", $usernameIDVar);
    mysqli_stmt_execute($statement);

    $outcomedata = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($outcomedata)) {
        return $row;
    } else {
        $outcome = false;
        return $outcome;
    }

    mysqli_stmt_close($statement);
}


function createUserAcc($conn, $usernameIDVar, $firstNameVar, $lastNameVar, $passwordIDVar, $emailIDVar, $addressIDVar)
{

    $sqlVar = "INSERT INTO user(username,firstName,lastName,pwd,email,userAddress) VALUES (?,?,?,?,?,?);";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sqlVar)) {
        header("location: ../UserRegistration/signup.php?error=statementfailed");
        exit();
    }

    //Hashing the password
    $hashP = password_hash($passwordIDVar, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "ssssss", $usernameIDVar, $firstNameVar, $lastNameVar, $hashP, $emailIDVar, $addressIDVar);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../UserRegistration/signup.php?error=noerrors");
    exit();
}

function LoginInputEmpty($usernameIDVar, $passwordIDVar)
{
    $outcome = null;

    if (empty($usernameIDVar) || empty($passwordIDVar)) {
        $outcome = true;
    } else {
        $outcome = false;
    }
    return $outcome;
}

function userLogin($conn, $usernameIDVar, $passwordIDVar)
{

    $existingUsername = duplicateUsername($conn, $usernameIDVar);

    if ($existingUsername === false) {
        header("location: ../UserRegistration/login.php?error=invalidloginwronginput");
        exit();
    }
    $pwdcheck = $existingUsername["pwd"];
    $checkPassword = password_verify($passwordIDVar, $pwdcheck);


    if ($checkPassword === false) {
        header("location: ../UserRegistration/login.php?error=invalidloginrightinput");
        exit();
    } else if ($checkPassword === true) {
        session_start();
        $_SESSION["sessUsername"] = $existingUsername["username"];
        $_SESSION["sessPwd"] = $existingUsername["pwd"];
        header("location: ../index.php");
        exit();
    }
}
