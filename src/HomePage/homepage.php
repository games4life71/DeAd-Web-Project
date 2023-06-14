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
    <link rel="stylesheet" href="homepage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <title>Homepage</title>
</head>
<body>

<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
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

        <li><a href="../About/about.html">About Us</a></li>
        <li><a href="../Contact/contact.html">Contact</a></li>
        <li><a href="../FAQ/faq.html">FAQ</a></li>
    </ul>
</header>

<div class="container">
    <div class="left-side">
        <h1 class="large-title">APPOINTMENT VISIT</h1>
        <h2 class="small-title">How we can help you</h2>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor tincidunt aliquam.
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        <?php

        if(isset($_SESSION['function'])) {

            if ($_SESSION['function'] == 'user') {
                echo '
            <a href="../Appointment/appointment.php">
            <button class="oval-button">CREATE APPOINTMENTS</button>
        </a>
        <a href="../User_Visit/uservisit.php">
            <button class="oval-button">SEE APPOINTMENTS</button>
        </a>';
            } else {
                echo '
            <a href="../Admin_Visit/adminvisit.html">
            <button class="oval-button">ADMIN APPOINTMENTS</button>
        </a>';
            }
        }

        ?>

    </div>
    <div class="middle"></div>
    <div class="right-side">
        <div class="block_welcome">

            <?php
            if ($_SESSION['is_logged_in']) {

                echo '<h2 class="block-title_welcome">Welcome,&nbsp;</h2>';
                echo '<a class="block-title_welcome" id="username" href="../UserProfile/profile.php" >'.$_SESSION['username'] . ' </a>';
                if ($_SESSION['function'] == 'admin') {
                    //display admin block
                   //TODO make it look good

                }

            } else {
                echo '<div class="block">
                <a href="../Login_Module/login.php"><h2 class="block-title">Login into your account</h2></a>
            </div>';
            }
            ?>


            <!--                <h2 class="block-title_welcome">Welcome, Username</h2>-->
        </div>

    </div>
</div>


</body>
</html>