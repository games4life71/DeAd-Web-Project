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
    <link rel="stylesheet" href="export_all.css">
    <title>Export data</title>
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

<form class="export" action="export_all_script.php" method="post" enctype="multipart/form-data">
    <div class="form-header">
        <h1>Export</h1>
    </div>

    <div class="form-body">
        <div class="form-group">
            <label class="label-title" for="persons">Export data for: </label>
            <select class="form-input" id="persons" name="persons">
                <option name="persons" value="inmates">Inmates</option>
                <option name="persons" value="users">Users</option>
                <option name="persons" value="all">All Appointments</option>
            </select>
        </div>


        <label class="label-title">Sort By:</label>
        <div class="form-group">
            <label for="alphabetically">
                <input type="radio" name="sorted" value="alphabetically" id="alphabetically"> Alphabetically</label>
            <label for="date_created">
                <input type="radio" name="sorted" value="date_created" id="date_created"> Date created</label>
        </div>


        <label class="label-title">Format: </label>
        <div class="form-group">
            <label>
                <input type="radio" name="format" value="json">JSON</label>
            <label>
                <input type="radio" name="format" value="csv">CSV</label>
            <label>
                <input type="radio" name="format" value="html">HTML</label>

        </div>

    </div>

    <div class="form-footer">
        <h1></h1>
        <button type="submit" name="export" class="btn">Export</button>
    </div>
    <br>

</form>

</body>
</html>



