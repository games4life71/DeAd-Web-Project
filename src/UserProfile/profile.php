<!DOCTYPE html>
<?php
session_start(); //start the session
if (!isset($_SESSION['is_logged_in'])) {
    $_SESSION['is_logged_in'] = false;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <li><a href="../Login_Module/login.html">Login</a></li>
        <li><a href="../About/about.html">About Us</a></li>
        <li><a href="../Contact/contact.html">Contact</a></li>
        <li><a href="../FAQ/faq.html">FAQ</a></li>
    </ul>
</header>

<div class="info_wrapper">
    <div class="blocks_wrapper">

        <div class="block">

            <div class="left_info">
                <?php
                if( $_SESSION['is_logged_in']){
                    echo '<p>'."Username:" .$_SESSION['username']. '</p>' ;
                    echo '<p>'."First name:" .$_SESSION['fname']. '</p>' ;
                    echo '<p>'."Last name:" .$_SESSION['lname']. '</p>' ;
                    echo '<p>'."Email:" .$_SESSION['email']. '</p>' ;
                }
                else
                {
                    echo '<div class="block">
                <a href="../Login_Module/login.html"><h2 class="block-title">Login into your account</h2></a>
            </div>';
                }

                ?>

            </div>
        </div>

        <div class="line">
            <hr>
        </div>

        <div class="block">
            <div class="right_block">

                <a href="logout.php"><h1>Logout</h1></a>
                <a><h1>Change Password</h1></a>
                <a><h1>Change Info</h1></a>
                <a><h1>Logout</h1></a>

            </div>
        </div>

    </div>


</div>

</body>
</html>