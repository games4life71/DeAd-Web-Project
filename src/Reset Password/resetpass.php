<?php
session_start();
if (!$_SESSION['is_logged_in']) {
    header('Location: ../Login_Module/login.php');
}
?>


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

            <button type="submit" class="btn">reset</button>
            <!--        TODO handle the errors from the php script -->
        </form>
    </div>

</div>
</body>
</html>