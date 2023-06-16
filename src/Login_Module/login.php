<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-sign-in.css">
    <title>DeAd-SignIn</title>
</head>
<body>
<div class="wrapper">
        <div class="form-container">
            <form action="login_script.php" method="POST">
                <h2>Login</h2>
                <div class="input-field">
                    <i></i>
                    <?php
                    if(isset($_GET['username'])){
                        $username = $_GET['username'];
                        echo "<input type='text' name='username' value='$username' required id='username'>";
                    }
                    else{
                        echo "<input type='text' name='username' required id='username'>";
                        echo "<label for='username'>Username</label>";
                    }

                    ?>

                </div>
                <div class="input-field">
                    <input type="password" name ="password"  required id="password">
                    <i></i>
                    <label for="password">Password</label>
                </div>
                <?php
                //ig

                   if(isset($_GET['error'])){
                       if($_GET['error'] == 1){
                           echo '<p class="error">Invalid username or password</p>';
                       }
                   }

                ?>

                <div class="forgot-pass">
                    <a href="../Forgot%20Password/forgotpass.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">login</button>
                <div class="link">
                    <p>Don't have an account?<a href="sign-up.php" class="signup-link"> Sign up</a></p>
                </div>
            </form>
        </div>

</div>
</body>
</html>