<?php
session_start(); // start the session
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
    <link rel="stylesheet" href="addstyle.css">
    <title>Add an inmate</title>
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

<form class="visit" action="save_inmate.php" method="post" enctype="multipart/form-data">
    <div class="form-header">
        <h1>Add an inmate</h1>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<p class="message success">The prisoner was successfully added!</p>';
        } else if (isset($_GET['success']) && $_GET['success'] == 0) {
            echo '<p class="message error">The prisoner could not be added!</p>';
        }
        ?>

    </div>

    <div class="form-body">
        <div class="horizontal-group">
            <div class="form-group left">
                <label for="firstname" class="label-title">First name of the prisoner</label>
                <input type="text" id="firstname" name="firstname" class="form-input" placeholder="Enter the first name" pattern="[A-Za-z]+" title="Please enter a valid first name (letters only)" required>
            </div>

            <div class="form-group right">
                <label for="lastname" class="label-title">Last name of the prisoner</label>
                <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Enter the last name" pattern="[A-Za-z]+" title="Please enter a valid last name (letters only)" required>
            </div>

            <div class="form-group right">
                <label for="sentencedate" class="label-title">Sentence start date</label>
                <input type="date" id="sentencedate" name="sentencedate" class="form-input" required>
            </div>

            <div class="form-group left">
                <label for="sentenceduration" class="label-title">Sentence duration (in days)</label>
                <input type="number" id="sentenceduration" name="sentenceduration" class="form-input" placeholder="Enter the sentence duration" min="1" step="1" required>
            </div>

            <div class="form-group left">
                <label for="sentencecategory" class="label-title">Sentence category</label>
                <input type="text" id="sentencecategory" name="sentencecategory" class="form-input" placeholder="Enter the sentence category" pattern="[a-zA-Z0-9\s]+" required>
            </div>

            <div class="button-center">
                <button type="submit" class="btn">Add</button>
            </div>
        </div>
    </div>

    <div class="form-footer">
    </div>
</form>

</body>
</html>