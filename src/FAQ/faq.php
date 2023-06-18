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
    <link rel="stylesheet" href="faqstyle.css">
    <title>FAQ</title>
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
        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="../Contact/contact.php">Contact</a></li>
        <li><a href="faq.php">FAQ</a></li>
    </ul>
</header>

<h2>Frequently Asked Questions</h2>

<!--<div style="visibility: hidden; position: absolute; width: 0; height: 0;">
    <svg xmlns="http://www.w3.org/2000/svg">
        <symbol viewBox="0 0 24 24" id="expand-more">
            <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
        </symbol>
        <symbol viewBox="0 0 24 24" id="close">
            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
        </symbol>
    </svg>
</div>-->

<details>
    <summary>
        How can I request an appointment for an inmate?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>To request a visitation appointment, you can log in to your user account on the detention
        admin system and click on 'Create Appointment'. Follow the prompts
        to submit your request, providing necessary details such as your relationship to the
        inmate and preferred visitation date and time.</p>
</details>

<details>

    <summary>
        What are the approved items that can be brought during a visit?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>The approved items allowed during a visit can vary depending on the facility's policies and
        security regulations. Generally, personal identification documents, a limited amount of
        money for vending machines, and certain necessary
        medications are permitted. </p>
</details>

<details>
    <summary>
        What should I do if I need support with the detention admin system?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>If you experience technical difficulties or require support with the detention
        admin system, you can reach out to the system's support team. The contact
        information for support is provided on the "Contact" page. Be sure to include detailed information
        about the issue you are facing,
        such as error messages or specific steps that led to the problem, to help the support team
        assist you more effectively.</p>
</details>

<details>
    <summary>
        How can I update my personal contact information in the detention administration system?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>To update your personal contact information, log in to your user account on the
        detention administration system. Look for the "Profile"
        section, where you should find options to edit your contact details such as your
        name, surname or adding a second email adress. Make the necessary changes and save
        your updated information.</p>
</details>

<details>
    <summary>
        How can I reset my password if I've forgotten it?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>If you've forgotten your password, you can easily reset it by following these steps: </p>
        <ol>
            <li>Go to the login page of the detention admin system.</li>
            <li>Click on the "Forgot Password" link.</li>
            <li>Enter your email address and click on the "Reset Password" button.</li>
            <li>Check your email inbox for a message with a code to reset your password.</li>
            <li>Come back to detention admin system and follow the prompts to create a new password.</li>
        </ol>
</details>

<details>
    <summary>
        How can I change my password?
        <svg class="control-icon control-icon-expand" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" />--></svg>
        <svg class="control-icon control-icon-close" width="24" height="24">
            <!--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" />--></svg>
    </summary>
    <p>If you want to change your password, you can easily do it by following these steps: </p>
    <ol>
        <li>Go to the "Profile" page of the detention admin system.</li>
        <li>Click on the "Change Password" link.</li>
        <li>Enter your current password.</li>
        <li>Enter your new password and re-enter for confirmation.</li>
        <li>Click the "Reset" button.</li>
    </ol>
</details>
</body>
</html>