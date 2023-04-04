<?php
include_once '../header.php';
?>


<section class="Login Form">
    <h2> Login below! </h2>
    <div class="Login Form" id="login_form">
        <form action="../includeFiles/login.inc.php" method="post">
            <input type="text" name="username_ID" size="25" placeholder="Please enter your username"><br><br>
            <input type="password" name="password_ID" size="25" placeholder="Please enter your password"><br><br>
            <button type="submit" name="submit">Login</button>
        </form>

        <!-- Show error messages on page, not just in URL. Refer to login.inc.php page -->
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p><br>You're missing something! Please fill in all fields :)</p>";
            } else if ($_GET["error"] == "invalidlogin") {
                echo "<p><br>Incorrect login details. Please try again </p>";
            }
        }
        ?>
    </div>
</section>


<?php
include_once '../footer.php';
?>