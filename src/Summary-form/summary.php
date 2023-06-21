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
    <link rel="stylesheet" href="summary.css">
    <title>Summary</title>
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
<form class="summary" action="save_summary.php" method="POST">

    <div class="form-header">
        <h1>Summary of the visit</h1>
    </div>
    <?php
    //session_start();
    //make a call to retrieve appointment
    $url_with_id = "http://localhost/src/Summary-Form/retrieve_visit.php" . "?visit_id=" . $_GET['visit_id'];
    $curl = curl_init($url_with_id);

    if(isset($_SESSION['token']))
    {
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$_SESSION['token']));
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPGET, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);

    //print_r($response);

    //print_r($response);

    //print_r($response);


    $GLOBALS['visit_date'] = $response['date'];
    $GLOBALS['visit_nature'] = $response['visit_nature'];
    $visit_start = intval($response['visit_start']);
    $visit_end = intval($response['visit_end']);

    $difference = $visit_end - $visit_start;
    $GLOBALS['visit_time'] = $difference;
    //print_r($GLOBALS['visit_time']);

    $GLOBALS['visit_time'] = $visit_start . " - " . $visit_end;


    $GLOBALS['visit_time'] = $visit_start . " - " . $visit_end;


    //send the appointment id to the next page
    echo "<input type='hidden' name='appointment_id' value='" . $response['appointment_id'] . "'>";
    //echo "<input type='hidden' name='prisoner_id' value='" . $response['inmate_id'] . "'>";
    ?>

    <div class="form-body">
        <div class="form-body">
            <div class="horizontal-group">
                <!--<div class="form-group left">
                  <label for="firstname" class="label-title">First name </label>
                  <input type="text" id="firstname" class="form-input" placeholder="enter your first name" required="required" />
                </div>
                <div class="form-group right">
                  <label for="lastname" class="label-title">Last name</label>
                  <input type="text" id="lastname" class="form-input" placeholder="enter your last name" />
                </div>-->
                <!--              TODO parse the visit id  -->

                <div class="form-group left">
                    <label class="label-title">The nature of the visit: </label>
                    <div class="input-group">
                        <?php
                        if($GLOBALS['visit_nature'] == "parental")

                            echo "<label><input type='radio' name='visit_nature' value='parental' checked='checked'>Parental</label>";
                        else
                            echo "<label><input type='radio' name='visit_nature' value='parental'>Parental</label>";

                        if($GLOBALS['visit_nature'] == "friendship")
                            echo "<label><input type='radio' name='visit_nature' value='friendship' checked='checked'>Friendship</label>";
                        else
                            echo "<label><input type='radio' name='visit_nature' value='friendship'>Friendship</label>";

                        if($GLOBALS['visit_nature'] == "lawyer")
                            echo "<label><input type='radio' name='visit_nature' value='lawyership' checked='checked'>Lawyer</label>";
                        else
                            echo "<label><input type='radio' name='visit_nature' value='lawyership'>Lawyer</label>";


//                        if($GLOBALS['visit_nature'] == "friendship")
//                            echo "<label><input type='radio' name='visit_nature' value='Friendship' checked='checked'>Friendship</label>";
//                        else
//                            echo "<label><input type='radio' name='visit_nature' value='Friendship'>Friendship</label>";
//                        if($GLOBALS['visit_nature'] == "lawyer")
//                            echo "<label>><input type='radio' name='visit_nature' value='Lawyer' checked='checked'>Lawyer</label";
//                        else
//                            echo "<label><input type='radio' name='visit_nature' value='Lawyer'>Lawyer</label>";

                        ?>

                    </div>
                </div>

                <div class="form-group right">
                    <label class="label-title">Witnesses: </label>
                    <div class="input-group">

                        <label for="police" >
                            <input type="radio" name="witnesses" value="relative" id="police"> Police Guard</label>
                        <label for="police">
                            <input type="radio" name="witnesses" value="legal_gurdian" id="legal_gurdian"> Legal
                            Guardian</label>
                        <label for="doctor">
                            <input type="radio" name="witnesses" value="doctor" id="doctor" > Doctor</label>
                        <label for="nurse">
                            <input type="radio" name="witnesses" value="nurse" id="nurse"  >Nurse</label>
                    </div>
                </div>


                <div class="form-group right">
                    <label class="label-title" for="prisoner_health">Prisoner's health: </label>
                    <select class="form-input" id="prisoner_health" name="prisoner_health" required="required">
                        <option value="good" name="prisoner_health">Good</option>
                        <option value="ok" name="prisoner_health">Ok</option>
                        <option value="bad" name="prisoner_health">Bad</option>
                    </select>
                </div>

                <div class="form-group right">
                    <label for="date" class="label-title">Visit date:</label>
                    <?php
                    echo "<input type='date' id='date' name='visit_date' class='form-input' value='" . $GLOBALS['visit_date'] . "' required='required'>";
                    ?>
<!--                    <input type="date" id="date" name="visit_date" class="form-input" required="required">-->
                </div>

                <div class="form-group right">
                    <label for="time" class="label-title">Hours (max 5) </label>

                    <input type="range" min="0" max="5" step="1"  id="time" name="visit_hours" class="form-input" onChange="change();" value="<?php echo $GLOBALS['visit_time']; ?>"

                    <input type="range" min="0" max="5" step="1" value="0" id="time" name="visit_hours" class="form-input" onChange="change();"

                    <input type="range" min="0" max="5" step="1" value="0" id="time" name="visit_hours" class="form-input" onChange="change();"

                           style="height:28px;width:78%;padding:0;">
                </div>

                <div class="form-group left">
                    <label for="offered" class="label-title"> Objects/data offered by the convict</label>
                    <input type="text" id="offered" name="objectsFrom" class="form-input"
                           placeholder="please enter here"
                           required="required"/>
                </div>

                <div class="form-group right">
                    <label for="provided" class="label-title">Objects/data provided to the convict</label>
                    <input type="text" id="provided" name="objectsTo" class="form-input" placeholder="please enter here"
                           required="required"/>
                </div>

                <div class="form-group">
                    <label for="sum" class="label-title">Summary</label>
                    <textarea id="sum" class="form-input" name="summary" rows="6" cols="50"
                              style="height:auto; resize: none;"></textarea>
                </div>
            </div>
        </div>


        <div class="form-footer">
            <div class="button-center">
                <button type="submit" class="btn">Submit</button>
            </div>
        </div>
    </div>
</form>

</body>
</html>