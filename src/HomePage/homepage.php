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
        if ($_SESSION['is_logged_in']) {
            echo '<li><a href="../UserProfile/profile.php">Profile</a></li>';
        } else {
            echo '<li><a href="../Login_Module/login.php">Login</a></li>';
        }
        ?>

        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="../Contact/contact.php">Contact</a></li>
        <li><a href="../FAQ/faq.php">FAQ</a></li>
    </ul>
</header>

<div class="container">
    <div class="left-side">
        <?php
        echo '<h1 class="large-title" >WELCOME TO OUR WEBSITE ! </h1>';
        if (!$_SESSION['is_logged_in']) {

            echo '<h2 class="small-title">How we can help you</h2>';
            echo '<p class="text">Our platform is designed to streamline the visitation process for 
                individuals visiting loved ones in correctional facilities. 
                With our platform, you can easily request and manage visitation 
                appointments, ensuring a smooth and organized experience.</p>';
        }else {

            if (isset($_SESSION['function'])) {

                if ($_SESSION['function'] == 'user') {
                    echo '<h2 class="small-title">How we can help you</h2>';
                    echo '<p class="text">Our user-friendly web application is designed to streamline 
                    the visitation process for individuals visiting loved ones in correctional 
                    facilities. With our platform, you can easily request and manage visitation 
                    appointments, ensuring a smooth and organized experience.</p>';
                    echo '
            <a href="../Appointment/appointment.php">
            <button class="oval-button">CREATE APPOINTMENTS</button>
        </a>
        <a href="../User_Visit/uservisit.php">
            <button class="oval-button">SEE APPOINTMENTS</button>
        </a>';
                } else {
                    echo '<h2 class="small-title">Welcome to the administrator\'s homepage!</h2>';
                    echo '<p class="text">This dedicated platform for managing visits in correctional 
                        facilities provides you with the necessary tools for efficient and 
                        secure visitation management. You have full control over the visitation 
                        process, reviewing and approving visitor requests, monitoring visit details, 
                        and generating statistical reports.</p>';
                    echo '
            <a href="../Search_page/search.php">
            <button class="oval-button">ADMIN PANEL</button><br>
            
        </a>';
                    echo '
            <a href="../Export_Data/export_all.php">
            <button class="oval-button">EXPORT PANEL</button>
        </a>';
                    echo '
            <a href="../Add_Inmate/addinmate.php">
            <button class="oval-button">ADD INMATE</button>
        </a>';
                }
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
                echo '<a class="block-title_welcome" id="username" href="../UserProfile/profile.php" >' . $_SESSION['username'] . ' </a>';
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