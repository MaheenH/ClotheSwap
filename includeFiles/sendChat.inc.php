<?php
require_once 'db.inc.php';
session_start();

if (isset($_POST["submit"])) {
    $chatID = $_POST['chatID'];
    if($_POST['message'] != ""){
        $message = $_POST['message'];
        date_default_timezone_set('America/Edmonton');
        $date = date('m/d/Y', time());
        $sentBy = $_SESSION["sessUsername"];
        
        $sql= "INSERT INTO messages(DateSent, Message, sentBy, ChatID) VALUES ('$date','$message','$sentBy','$chatID');";
        mysqli_query($conn, $sql);

        $listingID = mysqli_insert_id($conn);

        header("location: ../messaging/chat.php?chat=$chatID");
    }
    header("location: ../messaging/chat.php?chat=$chatID");
}