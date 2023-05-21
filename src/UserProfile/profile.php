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
    <link rel="stylesheet" href="profile.css">
    <style>
        :root {
            --darkblue: #32435f;
            --lightblue: #85abef;
            --offpink: #a67f78;
            --capuccino: #8f8681;
            --offwhite: #e1dcd9;
            --lightcapuccino: #cccbc9;
        }
    </style>
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


<div class="container">
    <div class="left-side">
        <table>
            <tbody>
            <?php
            $username = $_SESSION['username'];
            $name = $_SESSION['fname'];
            $surname = $_SESSION['lname'];
            $email = $_SESSION['email'];
            $secondary_email = $_SESSION['secondary_email'];

           echo" 
            <tr>
                <td class = 'default'><b>Username</b></td>
                <td class = 'default'>:</td>
                <td style='color: var(--darkblue);' >$username</td>
            <tr>
                <td class = 'default'><b>Name</b></td>
                <td class = 'default'>:</td>
                <td style='color: var(--darkblue);'>$name</td>
            </tr>
            <tr>
                <td class = 'default'><b>Surname</b></td>
                <td class = 'default'>:</td>
                <td style='color: var(--darkblue);' >$surname</td>
            <tr>
                <td class = 'default'><b>Email</b></td>
                <td class = 'default' >:</td>
                <td style='color: var(--darkblue);' >$email</td>
            </tr>
            <tr>
                <td class = 'default'><b>Secondary email</b></td>
                <td class = 'default' >:</td>
                <td style='color: var(--darkblue);' >$secondary_email</td>
            </tr>

           ";

           ?>

            </tbody>
        </table>
    </div>
    <div class="middle"></div>
    <div class="right-side">
        <div class="right-url">

            <div class="url">
                <a href="#" class="active">Profile</a>

            </div>
            <div class="url">
                <a href="logout.php">Logout</a>

            </div>
            <div class="url">
                <a href="../Reset%20Password/resetpass.php">Change Password</a>

            </div>
            <div class="url">
                <a href="change_info.php">Change Info</a>

            </div>
        </div>

    </div>
</div>



</body>
</html>