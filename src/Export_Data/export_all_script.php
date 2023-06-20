<?php
session_start(); //start the session
$username = $_SESSION['username'];
$user_id = $_SESSION['id'];
$sorted = $_POST['sorted'];
$format = $_POST['format'];

print_r($_POST);


