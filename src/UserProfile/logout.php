<?php

//get the value from the form
$logout = $_POST['logout'];


if($logout == 'logout'){
    session_start(); //we need to start session in order to access it through CI
    session_destroy();
    header("Location: ../HomePage/homepage.php");
    $_SESSION['username'] = null;
    $_SESSION['is_logged_in'] = false;
    //cleat the cookie

}