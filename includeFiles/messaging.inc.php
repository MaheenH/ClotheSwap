<?php

if (isset($_POST["submit"])) {
    require_once 'db.inc.php';

    // if user logged in
    if (isset($_SESSION["sessUsername"])) {
        $user1 = $_SESSION["sessUsername"];
        $user2 = $_POST["sellerName"];
        $sql = "SELECT ChatID FROM chats WHERE (Username1 = $user1 AND Username2 = $user2) OR (Username2 = $user1 AND Username1 = $user2)";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location: ../messaging/chat.php?error=statementfailed");
            exit();
        }
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $chat = mysqli_fetch_array($result); 
        mysqli_stmt_close($statement);
        if($chat == null){
            // create new chat
            $sqlVar = "INSERT INTO chats(ChatID, Username1, Username2) VALUES (?,?,?);";
            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sqlVar)) {
                header("location: ../UserRegistration/signup.php?error=statementfailed");
                exit();
            }

            $chatID = rand();
            mysqli_stmt_bind_param($statement, $chatID, $user1, $user2);
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);

            header("location: ../messaging/chat.php?chat=$chatID");
        }
        else{
            header("location: ../messaging/chat.php?chat=$chat[ChatID]");
        }
        }
    else{
        header("location: ../UserRegistration/login.php");
        exit();
    }

}