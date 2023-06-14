 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="forgotpass.css">
  <title>DeAd-Forgot Password</title>
</head>
<body>
<div class="wrapper">
  <div class="form-container">
    <form action="forgot_pwd.php" method="POST">
      <h2>Forgot Password</h2>

      <div class="input-field">
        <input type="email" name="email" required id="email">
        <i></i>
        <label for="email">Email</label>
      </div>

      <button type="submit" class="btn">send</button>
      <?php

      if(isset($_GET['error'])){
        if($_GET['error'] == 1){
          echo "<p class='error'>The email was not sent. Error message: " . "</p>";
        }

      }

      else if(isset($_GET['success'])){
        if($_GET['success'] == 1){
          echo "<p class='success'>Email sent!</p>";
          //add a delay
            header("Refresh: 1; url=code_verification.html");
        }
      }




      ?>
    </form>
  </div>

</div>
</body>
</html>