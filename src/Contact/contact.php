<?php
session_start(); //start the session
if (!isset($_SESSION['is_logged_in'])) {
    $_SESSION['is_logged_in'] = false;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="contact.css">
    <title>Contact</title>
</head>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <?php
        if($_SESSION['is_logged_in'])
        {
            echo '<li><a href="../UserProfile/profile.php">Profile</a></li>';
        }
        else
        {
            echo'<li><a href="../Login_Module/login.php">Login</a></li>';
        }
        ?>
        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="../FAQ/faq.php">FAQ</a> </li>
    </ul>
</header>

<div class="contact_text">
    <h1 id="big_text">CONTACT US </h1>

</div>

<div class="contact_info">
    <div class="address">
        <img src="../assets/Contact/address.png" alt="adress_img">
        <h2>ADDRESS </h2>
        <p> 1234, ABC Street, XYZ City, 123456 </p>
        <p> 1234, ABC Street, XYZ City, 123456 </p>
    </div>

    <div class="phone">
        <img src="../assets/Contact/phone.png" alt="phone_img">
        <h2>PHONE</h2>
        <p> Romania : +40 312 345 678 </p>
        <p> International : +1 123 456 7890 </p>
    </div>

    <div class="email">
        <img src="../assets/Contact/email.png" alt="email_img">
        <h2>EMAIL</h2>
        <p> admin@detentionadmin.com</p>
        <p> admin@detentionadmin.com </p>
    </div>

</div>

</body>
</html>