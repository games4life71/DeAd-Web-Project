<?php
//start the session
session_start();
$config = require '../../config.php';
$username = $_SESSION['username'];
$config = require '../../config.php';

//$id=$_SESSION['id'];

require '../Utils/DbConnection.php';
$conn = DbConnection::getInstance()->getConnection();


$name = $_POST['name'];
$surname = $_POST['surname'];
$secondary_email = $_POST['secondary_email'];

//verify if the email is valid
if (!filter_var($secondary_email, FILTER_VALIDATE_EMAIL)) {
    header("Location: change_info.php?error=3");
    exit();
} else if ($secondary_email == $_SESSION['email']) {
    header("Location: change_info.php?error=4");
    exit();
} else if ($secondary_email == $_SESSION['secondary_email']) {
    header("Location: change_info.php?error=5");
    exit();
} else if ($secondary_email == null) {
    header("Location: change_info.php?error=6");
    exit();
}

//verify if the name and surname contain only letters
if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    header("Location: change_info.php?error=1&username=$username&em");
    exit();
} else if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
    header("Location: change_info.php?error=2");
    exit();
}

$stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, secondary_email = ?  WHERE username = ?");
$stmt->bind_param("ssss", $name, $surname, $secondary_email, $username);
$stmt->execute();

//set the session variables
$_SESSION['fname'] = $name;
$_SESSION['lname'] = $surname;
$_SESSION['secondary_email'] = $secondary_email;

$error_code = $stmt->errno;
$stmt->close();
if ($error_code != 0) {
    header("Location: change_info.php?error=7");
} else {
    header("Location:profile.php");
}
exit();






