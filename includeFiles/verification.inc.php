<?php

if (isset($_POST["verification"])) {
    require_once 'db.inc.php';
    session_start();
    // if user logged in
    if (isset($_SESSION["sessUsername"]) && $_SESSION["sessUsername"] == "admin") {
        $verified = "INSERT INTO listing (verified) VALUES ('verified')";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $verified)) {
            header("location: ../UserRegistration/signup.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_execute($statement);
        header("location: ../../verification.php");
        exit();
    }
}
