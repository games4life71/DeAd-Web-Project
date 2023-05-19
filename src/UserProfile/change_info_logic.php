<?php
//start the session
session_start();
$config = require '../../config.php';
$username = $_SESSION['username'];
$config = require '../../config.php';

//$id=$_SESSION['id'];
$conn = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

/*$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();*/


$name = $_POST['name'];
$surname = $_POST['surname'];
$secondary_email = $_POST['secondary_email'];


//verify if the name and surname contain only letters
if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    header("Location: change_info.php?error=1&username=$username&em");
    exit();
} else if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
    header("Location: change_info.php?error=2");
    exit();
}

$stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ? WHERE username = ?");
$stmt->bind_param("sss", $name, $surname, $username);
$stmt->execute();
$result = $stmt->get_result();
//set the session variables
$_SESSION['fname'] = $name;
$_SESSION['lname'] = $surname;
$_SESSION['secondary_email'] = $secondary_email;

echo $result;
if ($result) {
    header("Location: profile.php");
    exit;
} else {
    echo "Failed";
}

$stmt->close();
$conn->close();




