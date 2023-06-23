<?php
//session_start();
//if (!$_SESSION['is_logged_in']) {
//    header('Location: ../Login_Module/login.php');
//}
//?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resetpass.css">
    <title>DeAd-Reset Password</title>
</head>
<body>
<div class="wrapper">
    <div class="form-container">
        <form action="resetpwd.php" method="POST">
            <h2>Reset Password</h2>
            <div class="input-field">
                <input type="password" name="currentPass" required id="currentPass">
                <i></i>
                <label for="currentPass">Current Password</label>
            </div>
            <div class="input-field">
                <input type="password" name="newPass" required id="newPass">
                <i></i>
                <label for="newPass">New Password</label>
            </div>
            <div class="input-field">
                <input type="password" name="confirmNewPass" required id="confirmNewPass">
                <i></i>
                <label for="confirmNewPass">Confirm New Password</label>
            </div>

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    echo '<p class="error"  style="font-size: 15px;  color: red;  padding: 4px; ">Passwords do not match !</p>';
                } else if ($_GET['error'] == 2) {
                    echo '<p class="error"  style="font-size: 15px;  color: red;  padding: 4px; ">Current Password is incorrect !</p>';
                } else if ($_GET['error'] == 3) {
                    echo '<p class="error"  style="font-size: 13px;  color: red;  padding: 3px; ">New password cannot be the same as current password !</p>';
                }
                else if ($_GET['error'] == 4)
                {
                    if(isset($_GET['strength']))
                    {
                        if($_GET['strength'] == 0)
                        {
                            echo '<p class="error"  style="font-size: 13px;  color: red;  padding: 3px; ">Password is not strong!!</p>';
                        }
                        else if($_GET['strength'] == 1)
                        {
                            echo '<p class="error"  style="font-size: 13px;  color: red;  padding: 3px; ">Try using upper letters</p>';
                        }
                        else if($_GET['strength'] == 2)
                        {
                            echo '<p class="error"  style="font-size: 13px;  color: red;  padding: 3px; ">Try using some digits !</p>';
                        }
                    }
                }
            }
            ?>


            <button type="submit" class="btn">reset</button>

        </form>
    </div>

</div>
</body>
</html>