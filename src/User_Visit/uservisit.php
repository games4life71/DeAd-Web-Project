<!DOCTYPE html>
<html lang="en">
<?php


session_start();
//redirect to retrieve_appointment.php  to retrieve the appointments
//header('Location: retrieve_appointments.php');

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <link rel="stylesheet" href="uservisitstyle.css">
    <title>User Visit</title>
</head>

<body>

<header class="header">
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <?php
        if(isset($_SESSION['is_logged_in']))
        {
            if($_SESSION['is_logged_in'])
            {
                echo '<li><a href="../UserProfile/profile.php">Profile</a></li>';
            }
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


<form class="visit" action="#" method="post">
    <div class="form-header">
        <h1>Your Current Appointments</h1>
    </div>

    <div class="form-body">
        <div class="horizontal-group">
            <ol class="visitor-list">


                <?php
                //use curl to make a request to the api
                $url = "http://localhost/src/User_Visit/retrieve_appointments.php" . "?id=" . $_SESSION['id'];
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                //set the parameter id

                curl_setopt($curl, CURLOPT_HTTPGET, true);
                $curl_response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($curl_response, true);
                //parse the response
                //if there are no appointments, display a message
                if (empty($response)) {
                    //button to create an appointment
                    echo '<div class="button-center">';
                    echo '<h2>You have no appointments</h2>';
                    echo '<a href="../Appointment/appointment.php" style="color:  #5c4b4b">Create an appointment</a>';
                    echo '</div>';
                    exit();
                }
                foreach ($response as $appointment) {
                    echo '<li>';
                    echo '<div class="visitor-info">';
                    echo '<strong>Visitor:</strong> ' . $appointment['visitor_name'] . '<br>';
                    echo '<strong>Date:</strong> ' . $appointment['date'] . '<br>';
                    echo '<strong>Visited:</strong> ' . $appointment['inmate_name'];
                    echo '</div>';
                    echo '<div class="edit-button">';
                    $visit_href= "../Summary-form/summary.php?visit_id=".$appointment['appointment_id'];
                    echo '<a href='.$visit_href.'>Make a summary</a>';
                    echo '</div>';
                    echo '</li>';
                }

                ?>
            </ol>

        </div>


    </div>

    <div class="form-footer">

    </div>
</form>

</body>

</html>