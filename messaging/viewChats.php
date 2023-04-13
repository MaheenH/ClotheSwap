<?php
include_once '../header.php';
?>
<?php
require_once '../includeFiles/db.inc.php';
if(!isset($_SESSION)) { 
    session_start(); 
} 
$user1 = $_SESSION["sessUsername"];
$sql = "SELECT * FROM chats WHERE Username1 = '$user1' OR Username2 = '$user1'";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../messaging/chat.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$chats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($statement);
if ($chats !== false && count($chats) > 0) {
    foreach ($chats as $c) {
        $chatID = $c['ChatID'];
        if($user1 == $c['Username1']){
            $otherUser = $c['Username2'];
        }
        else{
            $otherUser = $c['Username1'];
        }
        ?>
        <a href="chat.php?chat=<?php echo $chatID ?>"><h2>Chat from user <?php echo $otherUser ?></h2></a>
        <?php
    }
}
else{
?>
    <h1>You've received no messages!</h1>
<?php
}
?>
<?php
include_once '../footer.php';
?>