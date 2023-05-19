<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../Login_Module/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="change-info.css">
</head>
<body>
<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <li><a href="../Login_Module/login.php">Login</a></li>
        <li><a href="../About/about.html">About Us</a></li>
        <li><a href="../Contact/contact.html">Contact</a></li>
        <li><a href="../FAQ/faq.html">FAQ</a></li>
    </ul>
</header>
<section>
    <aside>
        <h1>Details</h1>
        <h2>Please enter your new information</h2>
        <form action="change_info_logic.php" method="POST">
            <!--<input type="text" name="name" id="name" placeholder="Name" />-->
            <?php
            if (isset($_SESSION['fname'])) {
                $fname = $_SESSION['fname'];

                echo "<input type='text' name='name' value='$fname'>";
            } else {
                echo "<input type='text' name='name' id='name' placeholder='Name' />";
            }
            ?>
           <!-- <input type="text" name="surname" id="surname" placeholder="Surname" />-->
            <?php
            if (isset($_SESSION['lname'])) {
                $lname = $_SESSION['lname'];

                echo "<input type='text' name='surname' value='$lname'>";
            } else {
                echo "<input type='text' name='surname' id='surname' placeholder='Surname' />";
            }
            ?>
            <input type="text" name="secondary_email" id="secondary_email" placeholder="Add secondary email" />
            <button type="submit" name="submit">Enter</button>
        </form>
    </aside>
</section>
</body>
</html>
