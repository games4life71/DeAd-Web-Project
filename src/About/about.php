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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
  <link rel = "stylesheet" href = "../NavBar/navstyle.css">
  <link rel = "stylesheet" href = "about.css">
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
    <li><a href="about.php">About Us</a></li>
    <li><a href="../Contact/contact.php">Contact</a></li>
    <li><a href="../FAQ/faq.php">FAQ</a> </li>
  </ul>
</header>



<div class="about-section">
  <h1 id ="about_title">About Us</h1>
  <div class ="about_text">
    <p>At Detention Admin, we are dedicated to revolutionizing the visitation experience for
        correctional facilities. We understand the importance of maintaining connections with
        loved ones during challenging times, and our mission is to provide a seamless and secure
        platform for visitation management.</p>
    <p>Our team is made up of 3 members : Dogaru Stefan-Adrian, Jitca Diana, Munteanu Lucian.
        We are all students at the University of "Alexandru Ioan Cuza" at Iasi, Romania.
        We are all in our 2nd year of college and majoring in Computer Science. </p>
  </div>

</div>



</body>
</html>