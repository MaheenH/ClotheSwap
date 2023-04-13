<?php
include_once '../header.php';
?>

<?php
require_once '../includeFiles/db.inc.php';
$chatID = $_GET['chat'];
$sql = "SELECT * FROM messages WHERE ChatID = $chatID";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../messaging/chat.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($statement);

$sql = "SELECT Username1,Username2 FROM chats WHERE ChatID = $chatID";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../messaging/chat.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$chat = mysqli_fetch_array($result); 
mysqli_stmt_close($statement);
$user1 = $chat['Username1'];
$user2 = $chat['Username2'];

if(isset($_SESSION["sessUsername"])){
    if($_SESSION["sessUsername"] == $user1){
        if ($messages !== false && count($messages) > 0) {
            foreach ($messages as $m) {
                if($m['sentBy'] != $user1){
                ?>
                    <div class = message>
                        <div class="message user-1">
                        <div class="message-content">
                            <?php echo $m['Message'] ?>
                        </div>
                        </div>
                    </div>
                <?php
                }
                else{
                ?>
                    <div class = message>
                        <div class="message user-2">
                        <div class="message-content">
                            <?php echo $m['Message'] ?>
                        </div>
                        </div>
                    </div>
                <?php
                }
            }
        }
        else{
            ?>
            <h1>There are no messages yet, send a message below to get started!</h1>
        <?php
        }
        ?>

        <div class="chatbox">
        <form action="../includeFiles/sendChat.inc.php" method="post">
            <input type="text" class ="input" name="message" size="250" placeholder="Chat here"><br><br>
            <input type="hidden" name="chatID" value="<?php echo $chatID ?>">
            <button type="submit" class ="send" name="submit" value="submit">Send</button>
        </form>
        </div>

        <?php
    }
    else if($_SESSION["sessUsername"] == $user2){
        if ($messages !== false && count($messages) > 0) {
            foreach ($messages as $m) {
                if($m['sentBy'] == $user1){
                ?>
                    <div class = message>
                        <div class="message user-2">
                        <div class="message-content">
                            <?php echo $m['Message'] ?>
                        </div>
                        </div>
                    </div>
                <?php
                }
                else{
                ?>
                    <div class = message>
                        <div class="message user-1">
                        <div class="message-content">
                            <?php echo $m['Message'] ?>
                        </div>
                        </div>
                    </div>
                <?php
                }
            }
        }
        else{
            ?>
            <h1>There are no messages yet, send a message below to get started!</h1>
        <?php
        }
        ?>

        <div class="chatbox">
        <form action="../includeFiles/sendChat.inc.php" method="post">
            <input type="text" class ="input" name="message" size="250" placeholder="Chat here"><br><br>
            <input type="hidden" name="chatID" value="<?php echo $chatID ?>">
            <button type="submit" class ="send" name="submit" value="submit">Send</button>
        </form>
        </div>

        <?php
    }
    else{
    ?>
        <h1>You are not authorized to view this chat!</h1>
    <?php
    }
}
else{
?>

<h1>Please log in to view this chat!</h1>

<?php 
}
?>

<?php
include_once '../footer.php';
?>

<style>

.message {
  display: flex;
  flex-direction: column;
  max-width: 100%;
  margin-bottom: 10px;
  padding: 20px;
}

.message-content {
  padding: 10px;
  border-radius: 10px;
  font-size: 16px;
  line-height: 1.4;
}

.user-1 .message-content {
  background-color: #f2f2f2;
  align-self: flex-start;
}

.user-2 .message-content {
  background-color: #4CAF50;
  color: white;
  align-self: flex-end;
}

.chatbox {
position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f2f2f2;
  padding: 20px;
  border-top: 1px solid #ccc;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.input {
  flex-grow: 1; 
  margin-right: 10px;
}

.send {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.user1m {
position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f2f2f2;
  padding: 20px;
  border-top: 1px solid #ccc;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.user2m {
position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f2f2f2;
  padding: 20px;
  border-top: 1px solid #ccc;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>