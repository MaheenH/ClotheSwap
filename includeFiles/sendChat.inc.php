<?php
require_once 'db.inc.php';
session_start();

if (isset($_POST["submit"])) {
    $chatID = $_POST['chatID'];
    if($_POST['message'] != ""){
        $messageID = rand();
        $message = $_POST['message'];
        date_default_timezone_set('America/Edmonton');
        $date = date('m/d/Y', time());
        $sentBy = $_SESSION["sessUsername"];
        
        $sqlVar = "INSERT INTO messages(MessageID, DateSent, Message, sentBy, ChatID) VALUES (?,?,?,?,?);";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlVar)) {
            header("location: ../messaging/chat.php?error=statementfailed");
            exit();
        }

        mysqli_stmt_bind_param($statement, "sssss", $messageID, $date, $message, $sentBy, $chatID);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        header("location: ../messaging/chat.php?chat=$chatID");
    }
    header("location: ../messaging/chat.php?chat=$chatID");
}