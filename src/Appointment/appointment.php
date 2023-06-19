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
    <link rel="stylesheet" href="appstyle.css">
    <title>Make an appointment</title>
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
        <li><a href="../FAQ/faq.php">FAQ</a></li>
    </ul>
</header>

<form class="visit" action="save_appointment.php" method="post" enctype="multipart/form-data">
    <div class="form-header">
        <h1>Make an appointment</h1>
    </div>

    <div class="form-body">
        <div class="horizontal-group">
            <div class="form-group left">
                <label for="firstname" class="label-title">First name of the prisoner </label>
                <input type="text" id="firstname" name="firstname" class="form-input" placeholder="enter the first name"/>
            </div>

            <div class="form-group right">
                <label for="lastname" class="label-title">Last name of the prisoner</label>
                <input type="text" id="lastname" name="lastname" class="form-input" placeholder="enter the last name"/>
            </div>

            <div class="form-group left">
                <label class="label-title">Relationship with the prisoner:</label>
                <div class="input-group">
                    <label for="relative">
                        <input type="radio" name="relationship" value="relative" id="relative"> Relative</label>
                    <label for="legal_gurdian">
                        <input type="radio" name="relationship" value="legal_gurdian" id="legal_gurdian"> Legal Guardian</label>
                    <label for="lawyer">
                        <input type="radio" name="relationship" value="lawyer" id="lawyer"> Lawyer</label>
                    <label for="friend">
                        <input type="radio" name="relationship" value="friend" id="friend"> Friend</label>
                </div>
            </div>

            <div class="form-group left">
                <label class="label-title">The nature of the visit: </label>
                <div class="input-group">
                    <label>
                        <input type="radio" name="visit_nature" value="parental">Parental</label>
                    <label>
                        <input type="radio" name="visit_nature" value="friendship">Friendship</label>
                    <label>
                        <input type="radio" name="visit_nature" value="lawyer">Lawyership</label>
<!--                        <input type="radio" name="visit_nature" value="lawyership">Lawyership</label>-->
<!--                        <input type="radio" name="visit_nature" value="lawyership">Lawyership</label>-->
                </div>
            </div>

            <div class="form-group right">
                <label class="label-title" for="level">Source of Income: </label>
                <select class="form-input" id="level" name="source_of_income">
                    <option name="source_of_income" value="employed">Employed</option>
                    <option name="source_of_income" value="self-employed">Self-employed</option>
                    <option name="source_of_income" value="unemployed">Unemployed</option>
                </select>
            </div>

            <div class="form-group right">
                <label class="label-title">Photo:</label>
                <input id="image" type="file" name="profile_photo" required="required" placeholder="Photo">
            </div>

            <div class="form-group left">
                <label for="date" class="label-title">Date:</label>
                <input type="date" name="date" id="date" class="form-input" required="required">
            </div>

            <div class="form-group right">
                <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 1)
                    {
                        //the inmate already has a visit at that time
                        echo "<div class='form-group'><p class='error'>The inmate already has a visit at that time</p></div>";
                    }
                }

                ?>
                <label for="time-start" class="label-title">Visit time start-end(max 5h) </label>
                <label for="time-end" class="label-title"></label>
                <!--<input type="range" min="1" max="5" step="1"  value="0" id="time" class="form-input" onChange="change();" style="height:28px;width:78%;padding:0;">-->
                <input type="time" id="time-start" name="visit_time_start" min="09:00" max="18:00"
                       class="form-input"
                       style="height:28px;width:78%;padding:0;" required>
                <input type="time" id="time-end" name="visit_time_end" min="09:00" max="18:00" class="form-input"
                       style="height:28px;width:78%;padding:0;" required>

            </div>

            <div class="button-center">
                <button type="submit" class="btn">Submit</button>
            </div>

            <?php
            if(isset($_GET['error']))
            {
                if($_GET['error'] == 1 )
                {
                    //invalid inmate name
                    echo "<p class='error'>Invalid inmate name !</p>";
                }

                elseif ($_GET['error'] == 2)
                {
                    //invalid inmate name
                    echo "<p class='error'>Invalid file type  !</p>";
                }
            }
            ?>

        </div>


    </div>

    <div class="form-footer">

    </div>
</form>

</body>
</html>


