<?php
include_once '../header.php';
?>


<section class="Signup Form">
    <h2> Sign up below! </h2>
    <div class="Signup Form" id="signup_form">
        <form action="../includeFiles/signup.inc.php" method="post">
            <input type="text" name="first_name" size="25" placeholder="Please enter your first name"><br><br>
            <input type="text" name="last_name" size="25" placeholder="Please enter your last name"><br><br>
            <input type="text" name="email_ID" size="25" placeholder="Please enter your email"><br><br>
            <input type="text" name="address_ID" size="25" placeholder="Please enter your address"><br><br>
            <input type="text" name="username_ID" size="25" placeholder="Please enter your username"><br><br>
            <input type="password" name="password_ID" size="25" placeholder="Please enter your password"><br><br>
            <button type="submit" name="submit_button">Sign Up</button>
        </form>

        <!-- Show error messages on page, not just in URL. Refer to signup.inc.php page -->
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p><br>You're missing something! Please fill in all fields :)</p>";
            } else if ($_GET["error"] == "invalidusername") {
                echo "<p><br>Please choose an username that only has numbers and/or letters</p>";
            } else if ($_GET["error"] == "usernamealreadyexists") {
                echo "<p><br>Username already exists! Please choose a different username </p>";
            } else if ($_GET["error"] == "statementfailed") {
                echo "<p><br>Something went wrong :( Please try again</p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p><br>Invalid email. Please enter a valid email address</p>";
            } else if ($_GET["error"] == "noerrors") {
                echo "<p><br>You've signed up! Enjoy your shopping</p>";
            }
        }
        ?>

    </div>

</section>


<?php
include_once '../footer.php';
?>