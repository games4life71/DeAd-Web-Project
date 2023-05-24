<?php

//get the value from the form

    session_start(); //we need to start session in order to access it through CI
    session_destroy();
    header("Location: ../HomePage/homepage.php");
    $_SESSION['username'] = null;
    $_SESSION['is_logged_in'] = false;
    $_SESSION['email'] = null;
    $_SESSION['fname'] = null;
    $_SESSION['lname'] = null;

    //cleat the cookie

