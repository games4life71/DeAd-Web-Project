<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-sign-in.css">
    <title>DeAd-SignUp</title>
</head>
<body>
<div class="wrapper">
    <div class="form-container" id="sign-up">
        <form action="register.php" method="POST">
            <h2>Sign Up</h2>

            <div class="input-field-sign-up">
                <i></i>
                <?php
                if (isset($_GET['fname'])) {
                    $fname = $_GET['fname'];

                    echo "<input type='text' name='fname' value='$fname' required id='first-name'>";
                    echo "<label for='first-name'>First Name</label>";
                } else {
                    echo "<input type='text' name='fname' required id='first-name'>";
                    echo "<label for='first-name'>First Name</label>";
                }
                ?>

            </div>
            <div class="input-field-sign-up">
                <i></i>
                <?php
                if (isset($_GET['lname'])) {
                    $lname = $_GET['lname'];
                    echo "<input type='text' name='lname' value='$lname' required id='last-name'>";
                    echo "<label for='first-name'>Last Name</label>";
                } else {
                    echo "<input type='text' name='lname' required id='last-name'>";
                    echo "<label for='first-name'>Last Name</label>";
                }
                ?>
            </div>

            <div class="input-field-sign-up">
                <i></i>
                <?php
                if (isset($_GET['username'])) {
                    $username = $_GET['username'];
                    echo "<input type='text' name='fname' value='$username' required id='username'>";
                    echo "<label for='username'>Username</label>";
                } else {
                    echo "<input type='text' name='username' required id='username'>";
                    echo "<label for='username'>Username</label>";
                }
                ?>

            </div>
            <div class="input-field-sign-up">

                <i></i>
                <?php
                if (isset($_GET['email'])) {
                    $email = $_GET['email'];
                    echo "<input type='text' name='fname' value='$email' required id='email'>";
                    echo "<label for='email'>Email</label>";
                } else {
                    echo "<input type='text' name='email' required id='email'>";
                    echo "<label for='email'>Email</label>";
                }
                ?>
            </div>
            <div class="input-field-sign-up">
                <input type="password" name="password" required id="password">
                <i></i>
                <label for="password">Password</label>
            </div>
            <div class="input-field-sign-up">
                <input type="password" name="password2" required id="confirm-password">
                <i></i>
                <label for="confirm-password">Confirm Password</label>
            </div>

            <?php

            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    echo '<p class="error">Username or email already exists</p>';
                } else if ($_GET['error'] == 2) {
                    echo '<p class="error">Passwords do not match</p>';
                }

            }
            else if (isset($_GET['strength'])) {

                if($_GET['strength'] == 0)
                {
                    echo'<p class="error">Warning ! Very weak password .</p>';
                }
                else if($_GET['strength'] == 1)
                {
                    echo'<p class="error">Password must contain a number and be longer</p>';
                }
                else if($_GET['strength'] == 2)
                {
                    echo'<p class="error">Password must contain a number !</p>';
                }

                else
                {
                    echo'<p class="error" style ="color: green;">Password is strong  !</p>';
                }


            }
            ?>
            <button type="submit" class="btn">register</button>
            <div class="link">
                <p>You already have an account?<a href="login.php" class="signin-link"> Sign in</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>